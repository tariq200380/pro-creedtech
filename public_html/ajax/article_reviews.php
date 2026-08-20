<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';

$dataFile = __DIR__ . '/../data/article_reviews.json';
if (!is_dir(dirname($dataFile))) {
    mkdir(dirname($dataFile), 0777, true);
}

$reviews = [];
if (file_exists($dataFile)) {
    $reviews = json_decode(file_get_contents($dataFile), true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawInput = file_get_contents('php://input');
    $jsonData = json_decode($rawInput, true);

    $action = $jsonData['action'] ?? $_POST['action'] ?? 'create';

    // Administrative actions require authentication and CSRF token
    if ($action === 'update_status' || $action === 'delete') {
        require_once __DIR__ . '/../includes/auth_guard.php';
        $token = $jsonData['csrf_token'] ?? $_POST['csrf_token'] ?? '';
        if (!validate_csrf_token($token)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Forbidden: Invalid or missing CSRF security token.']);
            exit;
        }
    }
    if ($action === 'update_status') {
        $revId = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $newStatus = strtoupper(trim($jsonData['status'] ?? $_POST['status'] ?? 'APPROVED'));
        
        $found = false;
        foreach ($reviews as &$r) {
            if ($r['id'] === $revId) {
                $r['status'] = $newStatus;
                $found = true;
                break;
            }
        }
        unset($r);

        if ($found) {
            file_put_contents($dataFile, json_encode($reviews, JSON_PRETTY_PRINT));
            echo json_encode(['success' => true, 'message' => "Review status updated to {$newStatus}.", 'reviews' => $reviews]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Review not found.']);
        }
        exit;
    }

    // 2. ADMIN ACTION: DELETE REVIEW
    if ($action === 'delete') {
        $revId = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $filtered = array_values(array_filter($reviews, function($r) use ($revId) {
            return intval($r['id']) !== $revId;
        }));

        file_put_contents($dataFile, json_encode($filtered, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'Review deleted permanently.', 'reviews' => $filtered]);
        exit;
    }

    // 3. PUBLIC USER SUBMISSION (STRICTLY PENDING)
    $name = trim($jsonData['name'] ?? $_POST['name'] ?? '');
    $role = trim($jsonData['role'] ?? $_POST['role'] ?? 'Verified Software Engineer');
    $rating = intval($jsonData['rating'] ?? $_POST['rating'] ?? 5);
    $title = trim($jsonData['title'] ?? $_POST['title'] ?? 'Enterprise Feedback');
    $comment = trim($jsonData['comment'] ?? $_POST['comment'] ?? '');
    $articleId = intval($jsonData['article_id'] ?? $_POST['article_id'] ?? 1);

    if (empty($name) || empty($comment)) {
        echo json_encode(['success' => false, 'message' => 'Please provide both your name and review comments.']);
        exit;
    }

    $avatarPool = [
        'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80',
        'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=180&auto=format&fit=crop&q=80'
    ];
    $chosenAvatar = $avatarPool[array_rand($avatarPool)];

    $productId = trim($jsonData['product_id'] ?? $_POST['product_id'] ?? '');
    $productName = trim($jsonData['product_name'] ?? $_POST['product_name'] ?? '');

    $newReview = [
        'id' => time() . rand(100, 999),
        'article_id' => $articleId,
        'product_id' => $productId,
        'product_name' => $productName,
        'name' => $name,
        'role' => $role ?: 'Verified Senior Engineer',
        'avatar' => $chosenAvatar,
        'rating' => min(5, max(1, $rating)),
        'status' => 'PENDING', // NEVER LIVE BY DEFAULT
        'date' => date('M d, Y'),
        'title' => $title ?: 'In-Depth Evaluation Feedback',
        'comment' => $comment,
        'helpful' => 1
    ];

    array_unshift($reviews, $newReview);
    file_put_contents($dataFile, json_encode($reviews, JSON_PRETTY_PRINT));

    echo json_encode([
        'success' => true,
        'message' => 'Your review has been submitted for moderation and will go live after admin approval.',
        'status' => 'PENDING'
    ]);
    exit;

} else {
    // GET REQUEST
    $artId = intval($_GET['article_id'] ?? 0);
    $isAdmin = !empty($_GET['admin']) || !empty($_GET['all']);

    if ($isAdmin) {
        // Return all reviews for admin moderation
        echo json_encode([
            'success' => true,
            'reviews' => $reviews
        ]);
        exit;
    }

    // STRICT PUBLIC FILTER: ONLY reviews with status === 'APPROVED'
    $approvedReviews = array_values(array_filter($reviews, function($r) use ($artId) {
        $isApproved = strtoupper(trim($r['status'] ?? '')) === 'APPROVED';
        if ($artId > 0) {
            return $isApproved && intval($r['article_id'] ?? 1) === $artId;
        }
        return $isApproved;
    }));

    echo json_encode([
        'success' => true,
        'reviews' => $approvedReviews
    ]);
    exit;
}
