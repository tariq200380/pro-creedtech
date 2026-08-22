<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/security_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Rate Limiting Protection (Max 5 submissions per 60 seconds per IP)
$rateLimit = check_form_rate_limit('contact_form', 5, 60);
if (!$rateLimit['allowed']) {
    http_response_code(429);
    echo json_encode([
        'success'     => false,
        'message'     => 'Too many requests. Please wait ' . $rateLimit['retry_after'] . ' seconds before submitting again.',
        'retry_after' => $rateLimit['retry_after']
    ]);
    exit;
}

// Support both JSON input and form POST
$rawInput = file_get_contents('php://input');
$jsonData = json_decode($rawInput, true);

if (is_array($jsonData)) {
    $fullName = trim($jsonData['fullName'] ?? '');
    $email = trim($jsonData['workEmail'] ?? ($jsonData['email'] ?? ''));
    $company = trim($jsonData['company'] ?? '');
    $phone = trim($jsonData['phone'] ?? '');
    $service = trim($jsonData['service'] ?? 'Software Development');
    $message = trim($jsonData['projectDetails'] ?? ($jsonData['message'] ?? ''));
    $needNda = !empty($jsonData['needNda']) ? 1 : 0;
} else {
    $fullName = trim($_POST['fullName'] ?? (($_POST['fname'] ?? '') . ' ' . ($_POST['lname'] ?? '')));
    $email = trim($_POST['workEmail'] ?? ($_POST['email'] ?? ''));
    $company = trim($_POST['company'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? 'Software Development');
    $message = trim($_POST['projectDetails'] ?? ($_POST['message'] ?? ''));
    $needNda = !empty($_POST['needNda']) ? 1 : 0;
}

if (empty($fullName) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields (Name, Work Email, and Project Details).']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid work email address.']);
    exit;
}

// If it's a career registration, route directly to Talent Pool data/job_applicants.json
if (stripos($service, 'career') !== false || stripos($service, 'applicant') !== false || stripos($service, 'alert') !== false || !empty($jsonData['specialty'])) {
    $appFile = __DIR__ . '/../data/job_applicants.json';
    if (!is_dir(dirname($appFile))) {
        mkdir(dirname($appFile), 0777, true);
    }
    $applicants = [];
    if (file_exists($appFile)) {
        $applicants = json_decode(file_get_contents($appFile), true) ?? [];
    }
    $newApplicant = [
        'id' => time() * 1000,
        'fullName' => $fullName,
        'email' => $email,
        'specialty' => $jsonData['specialty'] ?? (trim(str_ireplace('Career Registration:', '', $service)) ?: 'Engineering'),
        'portfolioUrl' => $jsonData['portfolioUrl'] ?? (preg_match('/https?:\/\/[^\s]+/', $message, $m) ? $m[0] : 'https://github.com'),
        'status' => 'PENDING',
        'date' => date('M d, Y'),
        'notes' => 'Registered via Careers form.'
    ];
    array_unshift($applicants, $newApplicant);
    file_put_contents($appFile, json_encode($applicants, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true, 'message' => 'Candidate registered successfully in Talent Pool!']);
    exit;
}

// Save to JSON storage file for guaranteed persistence
$dataFile = __DIR__ . '/../data/inquiries.json';
if (!is_dir(dirname($dataFile))) {
    mkdir(dirname($dataFile), 0777, true);
}
$inquiries = [];
if (file_exists($dataFile)) {
    $inquiries = json_decode(file_get_contents($dataFile), true) ?? [];
}

$newInquiry = [
    'id' => time(),
    'name' => $fullName,
    'email' => $email,
    'company' => $company ?: 'N/A',
    'phone' => $phone ?: 'N/A',
    'service' => $service,
    'message' => $message,
    'needNda' => (bool)$needNda,
    'status' => 'NEW',
    'date' => date('M d, Y'),
    'type' => (stripos($service, 'team') !== false || stripos($service, 'pod') !== false) ? 'vision' : 'contact'
];
array_unshift($inquiries, $newInquiry);
file_put_contents($dataFile, json_encode($inquiries, JSON_PRETTY_PRINT));

// Store in DB if available
$connect = creed_db();
if (!empty($connect)) {
    try {
        @$connect->query("CREATE TABLE IF NOT EXISTS contact_inquiries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            company VARCHAR(255) DEFAULT NULL,
            phone VARCHAR(100) DEFAULT NULL,
            service VARCHAR(100) DEFAULT NULL,
            project_details TEXT NOT NULL,
            need_nda TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $stmt = $connect->prepare("INSERT INTO contact_inquiries (full_name, email, company, phone, service, project_details, need_nda) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssssssi", $fullName, $email, $company, $phone, $service, $message, $needNda);
            $stmt->execute();
        }
    } catch (Exception $e) {}
}

echo json_encode([
    'success' => true,
    'message' => 'Thank you! Your inquiry has been received. Our solutions architects will review your scope and contact you within 24 business hours.'
]);
exit;?>
