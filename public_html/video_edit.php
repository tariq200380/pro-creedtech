<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

/**
 * Isolated Video Keynote Edit Image Optimizer
 * Proportionally resizes raster images (JPEG, PNG, WebP) and encodes to WebP without upscaling.
 *
 * @param string $sourcePath Absolute filesystem path of source image
 * @param int $maxWidth Maximum width constraint (default 1600)
 * @param int $maxHeight Maximum height constraint (default 1200)
 * @param int $quality WebP compression quality (default 82)
 * @return array ['success' => bool, 'filepath' => string, 'filename' => string, 'width' => int, 'height' => int, 'size' => int] | ['success' => false, 'error' => string]
 */
function optimize_video_edit_image($sourcePath, $maxWidth = 1600, $maxHeight = 1200, $quality = 82) {
    if (!is_string($sourcePath) || !file_exists($sourcePath) || !is_file($sourcePath)) {
        return ['success' => false, 'error' => 'Source image file does not exist.'];
    }

    if (!extension_loaded('gd') || !function_exists('imagewebp')) {
        return ['success' => false, 'error' => 'GD extension with WebP support is unavailable.'];
    }

    $imageInfo = @getimagesize($sourcePath);
    if ($imageInfo === false) {
        return ['success' => false, 'error' => 'Invalid or unreadable raster image payload.'];
    }

    $origWidth  = (int)($imageInfo[0] ?? 0);
    $origHeight = (int)($imageInfo[1] ?? 0);
    $mimeType   = $imageInfo['mime'] ?? '';

    if ($origWidth <= 0 || $origHeight <= 0) {
        return ['success' => false, 'error' => 'Image dimensions cannot be zero.'];
    }

    // 1. Create source image resource based on MIME type
    $srcImg = null;
    switch ($mimeType) {
        case 'image/jpeg':
        case 'image/pjpeg':
            if (function_exists('imagecreatefromjpeg')) {
                $srcImg = @imagecreatefromjpeg($sourcePath);
            }
            break;
        case 'image/png':
            if (function_exists('imagecreatefrompng')) {
                $srcImg = @imagecreatefrompng($sourcePath);
            }
            break;
        case 'image/webp':
            if (function_exists('imagecreatefromwebp')) {
                $srcImg = @imagecreatefromwebp($sourcePath);
            }
            break;
        default:
            return ['success' => false, 'error' => 'Unsupported image MIME format: ' . $mimeType];
    }

    if (!$srcImg) {
        return ['success' => false, 'error' => 'Failed to initialize GD image resource from source.'];
    }

    // 2. Calculate proportional dimensions (Never upscale)
    $targetWidth  = $origWidth;
    $targetHeight = $origHeight;

    if ($origWidth > $maxWidth || $origHeight > $maxHeight) {
        $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
        $targetWidth  = max(1, (int)round($origWidth * $ratio));
        $targetHeight = max(1, (int)round($origHeight * $ratio));
    }

    // 3. Create destination canvas and preserve alpha channel transparency
    $dstImg = imagecreatetruecolor($targetWidth, $targetHeight);
    if (!$dstImg) {
        imagedestroy($srcImg);
        return ['success' => false, 'error' => 'Failed to allocate destination truecolor canvas.'];
    }

    imagealphablending($dstImg, false);
    imagesavealpha($dstImg, true);
    $transparentColor = imagecolorallocatealpha($dstImg, 0, 0, 0, 127);
    imagefilledrectangle($dstImg, 0, 0, $targetWidth, $targetHeight, $transparentColor);

    // 4. Resample with high quality interpolation
    if (!imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $targetWidth, $targetHeight, $origWidth, $origHeight)) {
        imagedestroy($srcImg);
        imagedestroy($dstImg);
        return ['success' => false, 'error' => 'Failed to resample and scale image canvas.'];
    }

    // 5. Generate collision-safe WebP destination path
    $targetDir = dirname($sourcePath);
    $randomHex = bin2hex(random_bytes(16));
    $destFilename = 'upload_' . $randomHex . '.webp';
    $destPath = rtrim($targetDir, '/\\') . DIRECTORY_SEPARATOR . $destFilename;

    // 6. Encode to WebP
    $encodeSuccess = @imagewebp($dstImg, $destPath, $quality);

    // 7. Cleanup GD resources immediately
    imagedestroy($srcImg);
    imagedestroy($dstImg);

    if (!$encodeSuccess || !file_exists($destPath) || filesize($destPath) <= 0) {
        if (file_exists($destPath)) {
            @unlink($destPath);
        }
        return ['success' => false, 'error' => 'WebP encoding failed or produced empty file.'];
    }

    @chmod($destPath, 0644);

    return [
        'success'  => true,
        'filepath' => $destPath,
        'filename' => $destFilename,
        'width'    => $targetWidth,
        'height'   => $targetHeight,
        'size'     => (int)filesize($destPath)
    ];
}

$id = validate_int_id($_GET['id'] ?? 0) ?? 0;
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_submit'])) { 
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        creed_audit_log('CSRF_REJECTED', 'VIDEO', $id, 'FAILURE');
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
            creed_audit_log('UPLOAD_REJECTED', 'VIDEO', $id, 'FAILURE', ['error' => $uploadResult['error']]);
        } else {
            $newImageName = $uploadResult['filename'];

            // Attempt isolated Video Edit WebP auto-optimization
            $optimizedResult = optimize_video_edit_image($uploadResult['filepath'], 1600, 1200, 82);
            if (
                $optimizedResult['success'] &&
                !empty($optimizedResult['filename']) &&
                !empty($optimizedResult['filepath']) &&
                file_exists($optimizedResult['filepath']) &&
                filesize($optimizedResult['filepath']) > 0
            ) {
                $newImageName = $optimizedResult['filename'];

                // Delete original uploaded raw file ONLY after verified successful WebP generation
                if (
                    !empty($uploadResult['filepath']) &&
                    file_exists($uploadResult['filepath']) &&
                    !is_dir($uploadResult['filepath']) &&
                    $optimizedResult['filepath'] !== $uploadResult['filepath']
                ) {
                    @unlink($uploadResult['filepath']);
                }

                creed_audit_log('UPLOAD_ACCEPTED', 'VIDEO', $id, 'SUCCESS', [
                    'original_filename'  => $uploadResult['filename'],
                    'optimized_filename' => $optimizedResult['filename']
                ]);
            } else {
                creed_audit_log('UPLOAD_ACCEPTED', 'VIDEO', $id, 'SUCCESS', [
                    'filename'           => $uploadResult['filename'],
                    'optimizer_fallback' => $optimizedResult['error'] ?? 'Optimizer failed'
                ]);
            }
        }
    }

    if (empty($error)) {
        if ($connect instanceof mysqli) {
            if ($newImageName !== null) {
                $deleteimage = '';
                $stmtOld = mysqli_prepare($connect, "SELECT `blog_image` FROM `video` WHERE `id` = ? LIMIT 1");
                if ($stmtOld) {
                    mysqli_stmt_bind_param($stmtOld, "i", $id);
                    mysqli_stmt_execute($stmtOld);
                    $resOld = mysqli_stmt_get_result($stmtOld);
                    if ($rowOld = mysqli_fetch_assoc($resOld)) {
                        $deleteimage = $rowOld['blog_image'] ?? '';
                    }
                    mysqli_stmt_close($stmtOld);
                }

                $stmtUp = mysqli_prepare($connect, "UPDATE `video` SET `blog_image` = ?, `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "sssi", $newImageName, $title, $detail, $id);
                    if (mysqli_stmt_execute($stmtUp)) {
                        creed_audit_log('UPDATE', 'VIDEO', $id, 'SUCCESS');

                        if (
                            !empty($deleteimage) &&
                            $deleteimage !== $newImageName &&
                            file_exists($folder . $deleteimage) &&
                            !is_dir($folder . $deleteimage)
                        ) {
                            @unlink($folder . $deleteimage);
                        }
                    }
                    mysqli_stmt_close($stmtUp);
                }
            } else {
                $stmtUp = mysqli_prepare($connect, "UPDATE `video` SET `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "ssi", $title, $detail, $id);
                    if (mysqli_stmt_execute($stmtUp)) {
                        creed_audit_log('UPDATE', 'VIDEO', $id, 'SUCCESS');
                    }
                    mysqli_stmt_close($stmtUp);
                }
            }
        }
        header("Location: video.php?action=saved");
        exit;
    }
}

// Fetch the existing entry
$image = '';
$title = '';
$detail = '';
if ($connect instanceof mysqli && $id > 0) {
    $stmtFetch = mysqli_prepare($connect, "SELECT * FROM `video` WHERE `id` = ? LIMIT 1");
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
  <title>Edit Video | Creed Tech Admin</title>
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
    <h2 style="font-size:1.5rem;font-weight:700;color:#0F172A;margin-bottom:20px;">Edit Video #<?php echo e($id); ?></h2>
    <?php if (!empty($error)) : ?>
      <div style="padding:10px;background:#FEF2F2;color:#991B1B;border-radius:4px;margin-bottom:12px;">
        <?php foreach ($error as $err) echo e($err) . '<br>'; ?>
      </div>
    <?php endif; ?>
    <form action="video_edit.php?id=<?php echo e($id); ?>" method="POST" enctype="multipart/form-data">
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
        <label style="font-weight:600;display:block;margin-bottom:6px;">Detail / Embed Code</label>
        <textarea class="form-control" name="detail" rows="8" required><?php echo e($detail);?></textarea>
      </div>
      <button class="btn btn-primary" type="submit" name="update_submit">Update Video</button>
      <a href="video.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </section>
</body>
</html>
