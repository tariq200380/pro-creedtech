<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

$id = validate_int_id($_GET['id'] ?? 0) ?? 0;
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_submit'])) { 
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        creed_audit_log('CSRF_REJECTED', 'ARTICLE', $id, 'FAILURE');
        die("HTTP 403 Forbidden: Invalid security token.\n");
    }

    $title  = trim($_POST['title'] ?? '');
    $detail = clean_rich_text($_POST['detail'] ?? '');
    $folder = __DIR__ . "/uploads/";
    $newImageName = null;

    if (!empty($_FILES['image']['tmp_name'])) {
        $uploadResult = secure_upload_image($_FILES['image'], $folder, 5242880);
        if (!$uploadResult['success']) {
            $error[] = $uploadResult['error'];
            creed_audit_log('UPLOAD_REJECTED', 'ARTICLE', $id, 'FAILURE', ['error' => $uploadResult['error']]);
        } else {
            $newImageName = $uploadResult['filename'];
            creed_audit_log('UPLOAD_ACCEPTED', 'ARTICLE', $id, 'SUCCESS', ['filename' => $newImageName]);
        }
    }

    if (empty($error)) {
        if ($connect instanceof mysqli) {
            if ($newImageName !== null) {
                $stmtOld = mysqli_prepare($connect, "SELECT `blog_image` FROM `article` WHERE `id` = ? LIMIT 1");
                if ($stmtOld) {
                    mysqli_stmt_bind_param($stmtOld, "i", $id);
                    mysqli_stmt_execute($stmtOld);
                    $resOld = mysqli_stmt_get_result($stmtOld);
                    if ($rowOld = mysqli_fetch_assoc($resOld)) {
                        $deleteimage = $rowOld['blog_image'];
                        if (!empty($deleteimage) && file_exists($folder . $deleteimage) && !is_dir($folder . $deleteimage)) {
                            @unlink($folder . $deleteimage);
                        }
                    }
                    mysqli_stmt_close($stmtOld);
                }

                $stmtUp = mysqli_prepare($connect, "UPDATE `article` SET `blog_image` = ?, `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "sssi", $newImageName, $title, $detail, $id);
                    mysqli_stmt_execute($stmtUp);
                    mysqli_stmt_close($stmtUp);
                    creed_audit_log('UPDATE', 'ARTICLE', $id, 'SUCCESS');
                }
            } else {
                $stmtUp = mysqli_prepare($connect, "UPDATE `article` SET `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "ssi", $title, $detail, $id);
                    mysqli_stmt_execute($stmtUp);
                    mysqli_stmt_close($stmtUp);
                    creed_audit_log('UPDATE', 'ARTICLE', $id, 'SUCCESS');
                }
            }
        }
        header("Location: article.php?action=saved");
        exit;
    }
}

// Fetch the existing entry
$image = '';
$title = '';
$detail = '';
if ($connect instanceof mysqli && $id > 0) {
    $stmtFetch = mysqli_prepare($connect, "SELECT * FROM `article` WHERE `id` = ? LIMIT 1");
    if ($stmtFetch) {
        mysqli_stmt_bind_param($stmtFetch, "i", $id);
        mysqli_stmt_execute($stmtFetch);
        $resFetch = mysqli_stmt_get_result($stmtFetch);
        if ($rowFetch = mysqli_fetch_assoc($resFetch)) {
            $image  = $rowFetch['blog_image'] ?? '';
            $title  = $rowFetch['title'] ?? '';
            $detail = $rowFetch['detail'] ?? '';
        }
        mysqli_stmt_close($stmtFetch);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Edit Article | Creed Tech Admin</title>
  <link rel="stylesheet" href="assets/css/style.min.css">
  <link rel="stylesheet" href="assets/css/insert-style.min.css">
  <link rel="stylesheet" href="assets/css/dashboard.min.css">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#F8FAFC;">
  <div style="max-width:800px;margin:40px auto;padding:24px;background:#fff;border-radius:8px;border:1px solid #E2E8F0;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);">
    <h2 style="font-size:1.5rem;font-weight:700;color:#0F172A;margin-bottom:20px;">Edit Article #<?php echo e($id); ?></h2>

    <?php if (!empty($error)): ?>
      <?php foreach ($error as $err): ?>
        <div style="padding:10px;background:#FEF2F2;color:#991B1B;border-radius:4px;margin-bottom:12px;"><?php echo e($err); ?></div>
      <?php endforeach; ?>
    <?php endif; ?>

    <form action="article_edit.php?id=<?php echo e($id); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <div style="margin-bottom:16px;">
        <label style="display:block;font-weight:600;margin-bottom:6px;color:#334155;">Title:</label>
        <input type="text" name="title" value="<?php echo e($title); ?>" required style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;">
      </div>

      <div style="margin-bottom:16px;">
        <label style="display:block;font-weight:600;margin-bottom:6px;color:#334155;">Article Image:</label>
        <?php if (!empty($image)): ?>
          <div style="margin-bottom:8px;"><img src="uploads/<?php echo e($image); ?>" style="max-height:100px;border-radius:4px;"></div>
        <?php endif; ?>
        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" style="width:100%;">
      </div>

      <div style="margin-bottom:20px;">
        <label style="display:block;font-weight:600;margin-bottom:6px;color:#334155;">Content Detail:</label>
        <textarea name="detail" rows="8" style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:4px;"><?php echo e($detail); ?></textarea>
      </div>

      <div style="display:flex;gap:12px;">
        <button type="submit" name="update_submit" style="padding:10px 20px;background:#0052FF;color:#fff;border:none;border-radius:4px;font-weight:600;cursor:pointer;">Update Article</button>
        <a href="article.php" style="padding:10px 20px;background:#E2E8F0;color:#334155;border-radius:4px;text-decoration:none;font-weight:600;">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
