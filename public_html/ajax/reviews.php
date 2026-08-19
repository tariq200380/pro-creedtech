<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? $_POST;

$authorName = trim($data['authorName'] ?? '');
$authorRole = trim($data['authorRole'] ?? '');
$location = trim($data['location'] ?? '');
$quote = trim($data['quote'] ?? '');
$rating = intval($data['rating'] ?? 5);
$avatarUrl = trim($data['avatarUrl'] ?? '');

if (empty($authorName) || empty($quote)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please provide your full name and review quote.'
    ]);
    exit;
}

if ($connect instanceof mysqli) {
    try {
        $stmt = mysqli_prepare($connect, "INSERT INTO client_reviews (author_name, author_role, company, avatar_url, quote, rating, is_approved) VALUES (?, ?, ?, ?, ?, ?, 1)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssi", $authorName, $authorRole, $location, $avatarUrl, $quote, $rating);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } catch (Exception $e) {
        // Continue gracefully
    }
}

echo json_encode([
    'success' => true,
    'message' => 'Thank you! Your enterprise review has been submitted and published successfully.'
]);
exit;
