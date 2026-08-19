<?php
/**
 * Creed Tech - Security, Sanitization, Output Encoding & Upload Validation Helpers
 */

/**
 * Safe HTML Output Encoding (Prevents Reflected and Stored XSS)
 */
if (!function_exists('e')) {
    function e($value) {
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

/**
 * Validate and cast Positive Integer ID
 */
if (!function_exists('validate_int_id')) {
    function validate_int_id($val, $min = 1, $max = PHP_INT_MAX) {
        $filtered = filter_var($val, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => $min, 'max_range' => $max]
        ]);
        return ($filtered !== false) ? (int)$filtered : null;
    }
}

/**
 * Validate email address format strictly
 */
if (!function_exists('validate_safe_email')) {
    function validate_safe_email($email) {
        $email = trim((string)$email);
        if (strlen($email) > 254) return false;
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? strtolower($email) : false;
    }
}

/**
 * Validate string against allowed values (Server-Side Allowlist)
 */
if (!function_exists('validate_allowlist')) {
    function validate_allowlist($val, array $allowed, $default = null) {
        $trimmed = trim((string)$val);
        return in_array($trimmed, $allowed, true) ? $trimmed : $default;
    }
}

/**
 * Clean and Sanitize Rich-Text HTML (Preserving safe layout, stripping scripts & event handlers)
 */
if (!function_exists('clean_rich_text')) {
    function clean_rich_text($html) {
        if (!is_string($html) || trim($html) === '') return '';

        // 1. Remove dangerous blocks completely
        $cleaned = preg_replace('/<(script|style|iframe|object|embed|applet|meta|link|base)[^>]*>.*?<\/\1>/si', '', $html);
        $cleaned = preg_replace('/<(script|style|iframe|object|embed|applet|meta|link|base)[^>]*>/si', '', $cleaned);

        // 2. Strip inline event handlers (onload, onerror, onclick, onmouseover, etc.)
        $cleaned = preg_replace('/\s*on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/si', '', $cleaned);

        // 3. Strip javascript: and vbscript: URIs
        $cleaned = preg_replace('/\b(href|src|data)\s*=\s*["\']\s*(javascript|vbscript|data):[^"\']*["\']/si', '$1="#"', $cleaned);

        // 4. Strip dangerous attributes
        $cleaned = preg_replace('/\s*(formaction|action|background|dynsrc|lowsrc)\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/si', '', $cleaned);

        return trim($cleaned);
    }
}

/**
 * Secure Admin Image Upload Handler
 * Enforces MIME inspection via finfo, image dimension bounds, random filename, and strict extension allowlist.
 */
if (!function_exists('secure_upload_image')) {
    function secure_upload_image($fileInput, $targetDirectory, $maxBytes = 5242880) {
        if (!isset($fileInput) || !is_array($fileInput)) {
            return ['success' => false, 'error' => 'No file uploaded or invalid file payload.'];
        }

        if ($fileInput['error'] !== UPLOAD_ERR_OK) {
            $errMap = [
                UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the server maximum size limit.',
                UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the form size limit.',
                UPLOAD_ERR_PARTIAL    => 'The file was only partially uploaded.',
                UPLOAD_ERR_NO_FILE    => 'No file was selected.',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder on server.',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
                UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload.'
            ];
            return ['success' => false, 'error' => $errMap[$fileInput['error']] ?? 'File upload error code: ' . $fileInput['error']];
        }

        $tmpName = $fileInput['tmp_name'];
        if (!is_uploaded_file($tmpName)) {
            return ['success' => false, 'error' => 'Potential file upload attack: Not an authorized uploaded file.'];
        }

        // 1. File Size Verification (Max 5MB)
        $fileSize = filesize($tmpName);
        if ($fileSize <= 0 || $fileSize > $maxBytes) {
            return ['success' => false, 'error' => 'File size exceeds maximum permitted limit (5 MB).'];
        }

        // 2. MIME Type Inspection via finfo (never trust client header)
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        $allowedMimes = [
            'image/jpeg' => 'jpg',
            'image/pjpeg'=> 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($allowedMimes[$mimeType])) {
            return ['success' => false, 'error' => 'Unauthorized file format. Only JPEG, PNG, and WebP images are permitted.'];
        }

        // 3. Genuine Image Decoding & Dimension Bounds Verification
        $imageInfo = @getimagesize($tmpName);
        if ($imageInfo === false) {
            return ['success' => false, 'error' => 'File content corrupted or not a valid raster image.'];
        }

        $width = $imageInfo[0] ?? 0;
        $height = $imageInfo[1] ?? 0;
        if ($width < 10 || $height < 10 || $width > 5000 || $height > 5000) {
            return ['success' => false, 'error' => 'Image dimensions outside allowable operational limits (10x10 to 5000x5000).'];
        }

        // 4. Random Safe Filename Generation (Zero original filename leakage)
        $ext = $allowedMimes[$mimeType];
        $randomHex = bin2hex(random_bytes(16));
        $finalFilename = 'upload_' . $randomHex . '.' . $ext;

        if (!is_dir($targetDirectory)) {
            @mkdir($targetDirectory, 0755, true);
        }

        $destinationPath = rtrim($targetDirectory, '/\\') . DIRECTORY_SEPARATOR . $finalFilename;

        // 5. Atomic Move
        if (!move_uploaded_file($tmpName, $destinationPath)) {
            return ['success' => false, 'error' => 'Failed to persist uploaded asset to destination storage.'];
        }

        @chmod($destinationPath, 0644);

        return [
            'success'   => true,
            'filename'  => $finalFilename,
            'filepath'  => $destinationPath,
            'mime'      => $mimeType,
            'width'     => $width,
            'height'    => $height,
            'size'      => $fileSize
        ];
    }
}
