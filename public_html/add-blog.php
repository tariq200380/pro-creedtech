<?php
/**
 * Creed Tech - Administrative Add Blog Handler
 */

require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_submit'])) {
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        creed_audit_log('CSRF_REJECTED', 'BLOG', null, 'FAILURE');
        die("HTTP 403 Forbidden: Invalid security token.\n");
    }

    $title    = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $detail   = clean_rich_text($_POST['detail'] ?? '');

    $folder = __DIR__ . "/uploads/";
    $savedFilename = '';

    if (!empty($_FILES['image']['tmp_name'])) {
        $uploadResult = secure_upload_image($_FILES['image'], $folder, 5242880);
        if (!$uploadResult['success']) {
            $error[] = $uploadResult['error'];
            creed_audit_log('UPLOAD_REJECTED', 'BLOG', null, 'FAILURE', ['error' => $uploadResult['error']]);
        } else {
            $savedFilename = $uploadResult['filename'];
            creed_audit_log('UPLOAD_ACCEPTED', 'BLOG', null, 'SUCCESS', ['filename' => $savedFilename]);
        }
    }

    if (empty($error)) {
        if ($connect instanceof mysqli) {
            $stmt = mysqli_prepare($connect, "INSERT INTO `blog` (`blog_image`, `title`, `category`, `detail`) VALUES (?, ?, ?, ?)");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $savedFilename, $title, $category, $detail);
                if (mysqli_stmt_execute($stmt)) {
                    $insertId = mysqli_insert_id($connect);
                    creed_audit_log('CREATE', 'BLOG', $insertId, 'SUCCESS');
                }
                mysqli_stmt_close($stmt);
            }
        }
        header("Location: blog-insert.php?action=saved");
        exit;
    }
}

if (!empty($error)) {
    foreach ($error as $err) {
        echo '<div style="color:red;padding:10px;">' . e($err) . '</div>';
    }
}
