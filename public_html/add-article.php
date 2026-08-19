<?php
/**
 * Creed Tech - Administrative Add Article Handler
 */

require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_submit'])) {
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        creed_audit_log('CSRF_REJECTED', 'ARTICLE', null, 'FAILURE');
        die("HTTP 403 Forbidden: Invalid security token.\n");
    }

    $title            = trim($_POST['title'] ?? '');
    $product_category = trim($_POST['product_category'] ?? '');
    $product_status   = validate_allowlist($_POST['product_status'] ?? '1', ['0', '1'], '1');
    $detail           = clean_rich_text($_POST['detail'] ?? '');

    $folder = __DIR__ . "/uploads/";
    $savedFilename = '';

    if (!empty($_FILES['image']['tmp_name'])) {
        $uploadResult = secure_upload_image($_FILES['image'], $folder, 5242880);
        if (!$uploadResult['success']) {
            $error[] = $uploadResult['error'];
            creed_audit_log('UPLOAD_REJECTED', 'ARTICLE', null, 'FAILURE', ['error' => $uploadResult['error']]);
        } else {
            $savedFilename = $uploadResult['filename'];
            creed_audit_log('UPLOAD_ACCEPTED', 'ARTICLE', null, 'SUCCESS', ['filename' => $savedFilename]);
        }
    }

    if (empty($error)) {
        if ($connect instanceof mysqli) {
            $stmt = mysqli_prepare($connect, "INSERT INTO `article` (`blog_image`, `title`, `product_category`, `product_status`, `detail`) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $savedFilename, $title, $product_category, $product_status, $detail);
                if (mysqli_stmt_execute($stmt)) {
                    $insertId = mysqli_insert_id($connect);
                    creed_audit_log('CREATE', 'ARTICLE', $insertId, 'SUCCESS');
                }
                mysqli_stmt_close($stmt);
            }
        }
        header("Location: article-insert.php?action=saved");
        exit;
    }
}

if (!empty($error)) {
    foreach ($error as $err) {
        echo '<div style="color:red;padding:10px;">' . e($err) . '</div>';
    }
}
