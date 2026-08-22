<?php
/**
 * Creed Tech - Administrative Video Delete Handler
 */

require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    die("HTTP 405 Method Not Allowed. Deletions must be submitted via POST with CSRF token.\n");
}

if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    creed_audit_log('CSRF_REJECTED', 'VIDEO', $_POST['id'] ?? null, 'FAILURE');
    http_response_code(403);
    die("HTTP 403 Forbidden: Invalid security token.\n");
}

$id = validate_int_id($_POST['id'] ?? 0);

$connect = creed_db();
if ($id && $connect instanceof mysqli) {
    $folder = __DIR__ . "/uploads/";
    $stmt = mysqli_prepare($connect, "SELECT `blog_image` FROM `video` WHERE `id` = ? LIMIT 1");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($res)) {
            $deleteimage = $row['blog_image'];
            if (!empty($deleteimage) && file_exists($folder . $deleteimage) && !is_dir($folder . $deleteimage)) {
                @unlink($folder . $deleteimage);
            }
        }
        mysqli_stmt_close($stmt);
    }

    $stmtDel = mysqli_prepare($connect, "DELETE FROM `video` WHERE `id` = ?");
    if ($stmtDel) {
        mysqli_stmt_bind_param($stmtDel, "i", $id);
        mysqli_stmt_execute($stmtDel);
        mysqli_stmt_close($stmtDel);
        creed_audit_log('DELETE', 'VIDEO', $id, 'SUCCESS');
    }
}

header("Location: video.php?deleted=1");
exit;