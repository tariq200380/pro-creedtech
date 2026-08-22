<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/security_helpers.php';

// Rate Limiting Protection (Max 5 submissions per 60 seconds per IP)
$rateLimit = check_form_rate_limit('newsletter_form', 5, 60);
if (!$rateLimit['allowed']) {
    http_response_code(429);
    echo json_encode([
        'success'     => false,
        'message'     => 'Too many subscription requests. Please wait ' . $rateLimit['retry_after'] . ' seconds before trying again.',
        'retry_after' => $rateLimit['retry_after']
    ]);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? $_POST;

$email = trim($data['email'] ?? '');
$source = trim($data['source'] ?? 'Global Footer');

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please provide a valid email address.'
    ]);
    exit;
}

// Save to JSON storage file
$dataFile = __DIR__ . '/../data/subscribers.json';
if (!is_dir(dirname($dataFile))) {
    mkdir(dirname($dataFile), 0777, true);
}
$subscribers = [];
if (file_exists($dataFile)) {
    $subscribers = json_decode(file_get_contents($dataFile), true) ?? [];
}

// Add new subscriber if not already present
$exists = false;
foreach ($subscribers as $s) {
    if (strtolower($s['email']) === strtolower($email)) {
        $exists = true;
        break;
    }
}
if (!$exists) {
    $newSub = [
        'id' => time(),
        'email' => $email,
        'source' => $source,
        'status' => 'ACTIVE',
        'date' => date('M d, Y')
    ];
    array_unshift($subscribers, $newSub);
    file_put_contents($dataFile, json_encode($subscribers, JSON_PRETTY_PRINT));
}

// Also insert to DB if connected
$connect = creed_db();
if ($connect instanceof mysqli) {
    try {
        $stmt = mysqli_prepare($connect, "INSERT IGNORE INTO newsletter_subscribers (email, source, status) VALUES (?, ?, 'active')");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $source);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } catch (Exception $e) {}
}

echo json_encode([
    'success' => true,
    'message' => '✓ Successfully subscribed to enterprise tech insights!'
]);
exit;
