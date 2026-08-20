<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

$id = validate_int_id($_GET['id'] ?? 0) ?? 0;
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_submit'])) { 
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        creed_audit_log('CSRF_REJECTED', 'STORY', $id, 'FAILURE');
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
            creed_audit_log('UPLOAD_REJECTED', 'STORY', $id, 'FAILURE', ['error' => $uploadResult['error']]);
        } else {
            $newImageName = $uploadResult['filename'];
            creed_audit_log('UPLOAD_ACCEPTED', 'STORY', $id, 'SUCCESS', ['filename' => $newImageName]);
        }
    }

    if (empty($error)) {
        if ($connect instanceof mysqli) {
            if ($newImageName !== null) {
                $stmtOld = mysqli_prepare($connect, "SELECT `blog_image` FROM `stories` WHERE `id` = ? LIMIT 1");
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

                $stmtUp = mysqli_prepare($connect, "UPDATE `stories` SET `blog_image` = ?, `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "sssi", $newImageName, $title, $detail, $id);
                    mysqli_stmt_execute($stmtUp);
                    mysqli_stmt_close($stmtUp);
                    creed_audit_log('UPDATE', 'STORY', $id, 'SUCCESS');
                }
            } else {
                $stmtUp = mysqli_prepare($connect, "UPDATE `stories` SET `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "ssi", $title, $detail, $id);
                    mysqli_stmt_execute($stmtUp);
                    mysqli_stmt_close($stmtUp);
                    creed_audit_log('UPDATE', 'STORY', $id, 'SUCCESS');
                }
            }
        }
        header("Location: stories.php?action=saved");
        exit;
    }
}

// Fetch the existing entry
$image = '';
$title = '';
$detail = '';
if ($connect instanceof mysqli && $id > 0) {
    $stmtFetch = mysqli_prepare($connect, "SELECT * FROM `stories` WHERE `id` = ? LIMIT 1");
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
  <title>Edit Story | Creed Tech Admin</title>
  <link href="assets/img/mono.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.min.css" rel="stylesheet">
  <link href="assets/css/insert-style.min.css" rel="stylesheet">
  <link href="assets/css/dashboard.min.css" rel="stylesheet">
</head>
<body style="background:#F8FAFC;">
  <header id="header" class="fixed-top" style="background:#0F172A;padding:12px 24px;">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo me-auto me-lg-0"><a href="Home"><img src="Creed-Tech-Logo-Clean.png" style="height:36px;"></a></h1>
      <nav id="navbar" class="navbar" style="display:flex;align-items:center;gap:16px;">
        <a class="nav-link text-white" href="Home" target="_blank">View Site ↗</a>
        <a class="nav-link text-white" href="edit_panel">Dashboard</a>
        <?php include __DIR__ . '/includes/admin_top_bar.php'; ?>
      </nav>
    </div>
  </header>
  <section style="margin-top: 100px;max-width:800px;margin-left:auto;margin-right:auto;padding:24px;background:#fff;border-radius:8px;border:1px solid #E2E8F0;">
    <h2 style="font-size:1.5rem;font-weight:700;color:#0F172A;margin-bottom:20px;">Edit Story #<?php echo e($id); ?></h2>
    <?php if (!empty($error)) : ?>
      <div style="padding:10px;background:#FEF2F2;color:#991B1B;border-radius:4px;margin-bottom:12px;">
        <?php foreach ($error as $err) echo e($err) . '<br>'; ?>
      </div>
    <?php endif; ?>
    <form action="stories_edit.php?id=<?php echo e($id); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <div class="mb-3">
        <label style="font-weight:600;display:block;margin-bottom:6px;">Current Image</label>
        <?php if (!empty($image)): ?>
          <img src="uploads/<?php echo e($image);?>" style="max-height:120px;border-radius:4px;margin-bottom:8px;display:block;">
        <?php endif; ?>
        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
      </div>
      <div class="mb-3">
        <label style="font-weight:600;display:block;margin-bottom:6px;">Heading</label>
        <input class="form-control" type="text" name="title" value="<?php echo e($title);?>" required>
      </div>
      <div class="mb-3">
        <label style="font-weight:600;display:block;margin-bottom:6px;">Detail</label>
        <textarea class="form-control" name="detail" rows="8" required><?php echo e($detail);?></textarea>
      </div>
      <button class="btn btn-primary" type="submit" name="update_submit">Update Story</button>
      <a href="stories.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </section>
</body>
</html>
