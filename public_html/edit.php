<?php 
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

/**
 * Isolated Knowledge Blog Edit Image Optimizer
 * Proportionally resizes raster images (JPEG, PNG, WebP) and encodes to WebP without upscaling.
 *
 * @param string $sourcePath Absolute filesystem path of source image
 * @param int $maxWidth Maximum width constraint (default 1600)
 * @param int $maxHeight Maximum height constraint (default 1200)
 * @param int $quality WebP compression quality (default 82)
 * @return array ['success' => bool, 'filepath' => string, 'filename' => string, 'width' => int, 'height' => int, 'size' => int] | ['success' => false, 'error' => string]
 */
function optimize_blog_edit_image($sourcePath, $maxWidth = 1600, $maxHeight = 1200, $quality = 82) {
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

$id = (int)($_GET['id'] ?? 0);
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_submit'])) { 
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        die("HTTP 403 Forbidden: Invalid or missing CSRF security token.\n");
    }

    $title  = trim($_POST['title'] ?? '');
    $detail = trim($_POST['detail'] ?? '');

    $folder = __DIR__ . "/uploads/";
    $newImageName = null;

    if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadResult = secure_upload_image($_FILES['image'], $folder);
        if (!$uploadResult['success']) {
            $error[] = $uploadResult['error'];
            if (function_exists('creed_audit_log')) {
                creed_audit_log('UPLOAD_REJECTED', 'BLOG', $id, 'FAILURE', ['error' => $uploadResult['error']]);
            }
        } else {
            $newImageName = $uploadResult['filename'];

            // Attempt isolated Blog Edit WebP auto-optimization
            $optimizedResult = optimize_blog_edit_image($uploadResult['filepath'], 1600, 1200, 82);
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
                    $optimizedResult['filepath'] !== $uploadResult['filepath']
                ) {
                    @unlink($uploadResult['filepath']);
                }

                if (function_exists('creed_audit_log')) {
                    creed_audit_log('UPLOAD_ACCEPTED', 'BLOG', $id, 'SUCCESS', [
                        'original_filename'  => $uploadResult['filename'],
                        'optimized_filename' => $optimizedResult['filename']
                    ]);
                }
            } else {
                if (function_exists('creed_audit_log')) {
                    creed_audit_log('UPLOAD_ACCEPTED', 'BLOG', $id, 'SUCCESS', [
                        'filename'           => $uploadResult['filename'],
                        'optimizer_fallback' => $optimizedResult['error'] ?? 'Optimizer failed'
                    ]);
                }
            }
        }
    }

    if (empty($error)) {
        if ($newImageName !== null) {
            if ($connect instanceof mysqli) {
                $deleteimage = '';
                $stmtOld = mysqli_prepare($connect, "SELECT `blog_image` FROM `blog` WHERE `id` = ? LIMIT 1");
                if ($stmtOld) {
                    mysqli_stmt_bind_param($stmtOld, "i", $id);
                    mysqli_stmt_execute($stmtOld);
                    $resOld = mysqli_stmt_get_result($stmtOld);
                    if ($rowOld = mysqli_fetch_assoc($resOld)) {
                        $deleteimage = $rowOld['blog_image'] ?? '';
                    }
                    mysqli_stmt_close($stmtOld);
                }

                $stmtUp = mysqli_prepare($connect, "UPDATE `blog` SET `blog_image` = ?, `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "sssi", $newImageName, $title, $detail, $id);
                    if (mysqli_stmt_execute($stmtUp)) {
                        if (function_exists('creed_audit_log')) {
                            creed_audit_log('UPDATE', 'BLOG', $id, 'SUCCESS');
                        }

                        if (
                            !empty($deleteimage) &&
                            $deleteimage !== $newImageName &&
                            file_exists($folder . $deleteimage) &&
                            !is_dir($folder . $deleteimage)
                        ) {
                            @unlink($folder . $deleteimage);
                        }
                    } else {
                        // DB UPDATE failed: Clean up newly created image asset so it does not become orphaned on disk
                        if (
                            !empty($newImageName) &&
                            $newImageName !== $deleteimage &&
                            file_exists($folder . $newImageName) &&
                            !is_dir($folder . $newImageName)
                        ) {
                            @unlink($folder . $newImageName);
                        }
                        if (function_exists('creed_audit_log')) {
                            creed_audit_log('UPDATE_FAILED', 'BLOG', $id, 'FAILURE', ['error' => mysqli_stmt_error($stmtUp)]);
                        }
                    }
                    mysqli_stmt_close($stmtUp);
                } else {
                    if (
                        !empty($newImageName) &&
                        $newImageName !== $deleteimage &&
                        file_exists($folder . $newImageName) &&
                        !is_dir($folder . $newImageName)
                    ) {
                        @unlink($folder . $newImageName);
                    }
                    if (function_exists('creed_audit_log')) {
                        creed_audit_log('UPDATE_FAILED', 'BLOG', $id, 'FAILURE', ['error' => mysqli_error($connect)]);
                    }
                }
            }
        } else {
            if ($connect instanceof mysqli) {
                $stmtUp = mysqli_prepare($connect, "UPDATE `blog` SET `title` = ?, `detail` = ? WHERE `id` = ?");
                if ($stmtUp) {
                    mysqli_stmt_bind_param($stmtUp, "ssi", $title, $detail, $id);
                    if (mysqli_stmt_execute($stmtUp)) {
                        if (function_exists('creed_audit_log')) {
                            creed_audit_log('UPDATE', 'BLOG', $id, 'SUCCESS');
                        }
                    }
                    mysqli_stmt_close($stmtUp);
                }
            }
        }
        header("Location: edit_panel.php?updated=1");
        exit;
    }
}
?>

// Fetch the existing blog entry
$image = '';
$title = '';
$detail = '';
if ($connect instanceof mysqli) {
    $stmtFetch = mysqli_prepare($connect, "SELECT * FROM `blog` WHERE `id` = ? LIMIT 1");
    if ($stmtFetch) {
        mysqli_stmt_bind_param($stmtFetch, "i", $id);
        mysqli_stmt_execute($stmtFetch);
        $resFetch = mysqli_stmt_get_result($stmtFetch);
        if ($rowFetch = mysqli_fetch_assoc($resFetch)) {
            $image  = $rowFetch['blog_image'];
            $title  = $rowFetch['title'];
            $detail = $rowFetch['detail'];
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

  <title>CreedTech</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/mono.webp" rel="icon">
  <link href="assets/img/mono.webp" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <!-- Vendor CSS Files -->

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.min.css" rel="stylesheet">
  <link href="assets/css/insert-style.min.css" rel="stylesheet">
  <link href="assets/css/dashboard.min.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="/"><img src="assets/img/mono.webp" alt="CREED TECH Logo"></a></h1>
      

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link active" href="/">Home</a></li>
          <li><a class="nav-link" href="about">About</a></li>
          <li><a class="nav-link" href="services">Services</a></li>
          <li><a class="nav-link" href="portfolio">Portfolio</a></li>
          <li><a class="nav-link" href="contact">Contact</a></li>
          <li><a class="nav-link" href="blog">Blog</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
        <a style="margin-right:-4%;" class="Sign-in" href="logout.php">LOGOUT</a>
        <i class="bi bi-list mobile-nav-toggle"></i>
        
      </nav><!-- .navbar -->
          
    </div>
    
  </header><!-- #header -->
  <!-- #header -->
<section>
<div class="content">
    <?php if (!empty($error)) : ?>
      <div class="error" style="color:red;padding:10px;">
        <?php foreach ($error as $err) echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . '<br>'; ?>
      </div>
    <?php endif ?>
</div>
   
  <br />
  <h2 style="background: #CBCBCB; text-align: center;"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8');?> </h2><br />
  <form action="" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <div class="container" style="">

    <div class="row">
     
     <div class="col-md-3 col-lg-3 col-xl-3">
      
    <img style="box-shadow: 5px 10px 18px #EFF6F4; border-radius: 5px;" src="uploads/<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8');?>" height="200" width="100%" alt="Article Image Preview"><br><br>
        
    <input type="file" name="image" class="form-control"><br>
    </div>



 
</div>

</center>
  <div class="row">

      <div class="col-md-4 col-lg-4 col-xl-3" style="border: 1px solid #fa6800;">
      <label class="mt-3" style="font-weight: bold; float: left; color:#131e91;">Heading:</label>
      <input class="form-control mt-3" type="text" name="title" id = "title" value="<?php echo $title;?>">
  

   </div>
            

   <div class="col-md-7 col-lg-7 col-xl-7" style="border: 1px solid #fa6800; margin-left: 10px;">
      <label class="mt-3" style="font-weight: bold; float: left; color:#131e91;">Blog Detail:</label>
    
    <textarea class="form-control mt-3" name="detail" id = "detail" rows="4" cols="50">
      <?php  echo $row['detail']?>
      </textarea>
  </div>
  <br /><br /><br />
  <center><button name="update_submit" class="btn-primary mt-4" style="padding:8px;">Update </button></center>


</form>
</section>
<br /><br /><br />
<!-- ======= Footer ======= -->
  <footer id="footer" class="footer_index">
  

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>CreedTech</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="">Creed Tech</a>
      </div>
    </div>
  </footer><!-- End Footer -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js" defer></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js" defer></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js" defer></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.min.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
  $(".panel_icon").click(function(){
    $("#profile_section_mobile").slideToggle("slow");
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
  $(".close_icon").click(function(){
    $("#profile_section_mobile").slideToggle("slow");
  });
});
</script>
</body>
</html>
