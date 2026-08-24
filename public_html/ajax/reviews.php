<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/security_helpers.php';
require_once __DIR__ . '/../includes/csrf.php';

$reviewsFile = __DIR__ . '/../data/reviews.json';
if (!is_dir(dirname($reviewsFile))) {
    @mkdir(dirname($reviewsFile), 0755, true);
}

$reviews = [];
if (file_exists($reviewsFile)) {
    $reviews = @json_decode(@file_get_contents($reviewsFile), true) ?: [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Rate Limiting Protection (Max 5 submissions per 60 seconds per IP)
    $rateLimit = check_form_rate_limit('review_submission', 5, 60);
    if (!$rateLimit['allowed']) {
        http_response_code(429);
        echo json_encode([
            'success'     => false,
            'message'     => 'Too many review submissions. Please wait ' . $rateLimit['retry_after'] . ' seconds before trying again.',
            'retry_after' => $rateLimit['retry_after']
        ]);
        exit;
    }

    $raw = @file_get_contents('php://input');
    $data = @json_decode($raw, true) ?: $_POST;

    // 2. CSRF Token Verification
    $submittedCsrf = $data['csrf_token'] ?? $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!validate_csrf_token($submittedCsrf)) {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid or missing security token. Please refresh the page and try again.'
        ]);
        exit;
    }

    $authorName = trim(strip_tags((string)($data['authorName'] ?? '')));
    $authorRole = trim(strip_tags((string)($data['authorRole'] ?? '')));
    $location   = trim(strip_tags((string)($data['location'] ?? '')));
    $quote      = trim(strip_tags((string)($data['quote'] ?? '')));
    $rating     = intval($data['rating'] ?? 5);
    $avatarUrl  = trim(strip_tags((string)($data['avatarUrl'] ?? '')));

    if (empty($authorName) || empty($quote)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Please provide your full name and review quote.'
        ]);
        exit;
    }

    $rating = min(5, max(1, $rating));

    // 1. Insert to MySQL with is_approved = 0 (PENDING - never auto-approved)
    $connect = creed_db();
    if ($connect instanceof mysqli) {
        try {
            $stmt = mysqli_prepare($connect, "INSERT INTO client_reviews (author_name, author_role, company, avatar_url, quote, rating, is_approved) VALUES (?, ?, ?, ?, ?, ?, 0)");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssi", $authorName, $authorRole, $location, $avatarUrl, $quote, $rating);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        } catch (Exception $e) {
            // Continue gracefully
        }
    }

    // 2. Persist to local reviews.json with status = PENDING
    $newReview = [
        'id'         => (int)(time() . rand(100, 999)),
        'authorName' => $authorName,
        'authorRole' => $authorRole ?: 'Verified Client',
        'location'   => $location ?: 'Global',
        'rating'     => $rating,
        'quote'      => $quote,
        'avatarUrl'  => $avatarUrl,
        'date'       => date('M d, Y'),
        'status'     => 'PENDING', // PENDING EDITORIAL APPROVAL
        'is_approved'=> 0
    ];

    array_unshift($reviews, $newReview);
    @file_put_contents($reviewsFile, json_encode($reviews, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your review has been submitted for moderation and will go live after editorial approval.',
        'status'  => 'PENDING'
    ]);
    exit;
} else {
    // GET REQUEST
    $isAdmin = false;
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
        session_name('CREED_ADMIN_SESSID');
        @session_start();
    }
    if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        $isAdmin = !empty($_GET['admin']) || !empty($_GET['all']);
    }

    if ($isAdmin) {
        echo json_encode([
            'success' => true,
            'count'   => count($reviews),
            'reviews' => $reviews
        ]);
        exit;
    }

    // Public visitors ONLY receive approved / featured reviews
    $approvedReviews = array_values(array_filter($reviews, function($r) {
        $st = strtoupper(trim($r['status'] ?? ''));
        return !empty($r['is_approved']) || $st === 'APPROVED' || $st === 'FEATURED ON HOME';
    }));

    echo json_encode([
        'success' => true,
        'count'   => count($approvedReviews),
        'reviews' => $approvedReviews
    ]);
    exit;
}
