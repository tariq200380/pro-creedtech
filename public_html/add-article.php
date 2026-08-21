<?php
/**
 * Creed Tech - Administrative Add Article Handler
 */

require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';
require_once __DIR__ . '/includes/audit_logger.php';

/**
 * Isolated Knowledge Article Image Optimizer
 * Proportionally resizes raster images (JPEG, PNG, WebP) and encodes to WebP without upscaling.
 *
 * @param string $sourcePath Absolute filesystem path of source image
 * @param int $maxWidth Maximum width constraint (default 1600)
 * @param int $maxHeight Maximum height constraint (default 1200)
 * @param int $quality WebP compression quality (default 82)
 * @return array ['success' => bool, 'filepath' => string, 'filename' => string, 'width' => int, 'height' => int, 'size' => int] | ['success' => false, 'error' => string]
 */
function optimize_article_image($sourcePath, $maxWidth = 1600, $maxHeight = 1200, $quality = 82) {
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

            // Attempt isolated Article WebP auto-optimization
            $optimizedResult = optimize_article_image($uploadResult['filepath'], 1600, 1200, 82);
            if ($optimizedResult['success']) {
                $savedFilename = $optimizedResult['filename'];

                // Delete original uploaded raw file ONLY after verified successful WebP generation
                if (
                    !empty($uploadResult['filepath']) &&
                    file_exists($uploadResult['filepath']) &&
                    !empty($optimizedResult['filepath']) &&
                    $optimizedResult['filepath'] !== $uploadResult['filepath'] &&
                    file_exists($optimizedResult['filepath']) &&
                    filesize($optimizedResult['filepath']) > 0
                ) {
                    @unlink($uploadResult['filepath']);
                }

                creed_audit_log('UPLOAD_ACCEPTED', 'ARTICLE', null, 'SUCCESS', [
                    'original_filename'  => $uploadResult['filename'],
                    'optimized_filename' => $optimizedResult['filename']
                ]);
            } else {
                creed_audit_log('UPLOAD_ACCEPTED', 'ARTICLE', null, 'SUCCESS', [
                    'filename'           => $uploadResult['filename'],
                    'optimizer_fallback' => $optimizedResult['error'] ?? 'Optimizer failed'
                ]);
            }
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
