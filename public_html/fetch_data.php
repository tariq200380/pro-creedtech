<?php
/**
 * Creed Tech - Legacy Article Data Fetcher (Hardened with Prepared Statements)
 */

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action'])) {
    http_response_code(400);
    exit;
}

$output = '';

$connect = creed_db();
if ($connect instanceof mysqli) {
    $categories = [];
    if (!empty($_POST['category']) && is_array($_POST['category'])) {
        foreach ($_POST['category'] as $cat) {
            $cleaned = trim((string)$cat);
            if (!empty($cleaned)) {
                $categories[] = $cleaned;
            }
        }
    }

    if (!empty($categories)) {
        $placeholders = implode(',', array_fill(0, count($categories), '?'));
        $sql = "SELECT `id`, `title`, `blog_image` FROM `article` WHERE `product_status` = '1' AND `product_category` IN ($placeholders) ORDER BY `id` DESC";
        $stmt = mysqli_prepare($connect, $sql);
        if ($stmt) {
            $types = str_repeat('s', count($categories));
            mysqli_stmt_bind_param($stmt, $types, ...$categories);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
    } else {
        $sql = "SELECT `id`, `title`, `blog_image` FROM `article` WHERE `product_status` = '1' ORDER BY `id` DESC";
        $stmt = mysqli_prepare($connect, $sql);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
    }

    if (!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $artId = intval($row['id']);
            $artTitle = htmlspecialchars($row['title'] ?? '', ENT_QUOTES, 'UTF-8');
            $artImage = htmlspecialchars($row['blog_image'] ?? '', ENT_QUOTES, 'UTF-8');

            $output .= '<div class="main_blog mt-3">'
                . '<img src="uploads/' . $artImage . '" alt="' . $artTitle . '">'
                . '<a href="article_detail?id=' . $artId . '"><h6 class="mt-3">' . $artTitle . '</h6></a>'
                . '</div><br />';
        }
        if (isset($stmt) && $stmt) {
            mysqli_stmt_close($stmt);
        }
    } else {
        $output = '<h3>No Data Found</h3>';
    }
} else {
    $output = '<h3>No Data Found</h3>';
}

echo $output;
exit;

