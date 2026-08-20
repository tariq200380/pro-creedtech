<?php
/**
 * Creed Tech - Security, Sanitization, Output Encoding & Upload Validation Helpers
 */

/**
 * In-Memory Request-Level Cache for Site Settings JSON
 */
if (!function_exists('creed_get_site_settings')) {
    function creed_get_site_settings() {
        static $cached = null;
        if ($cached !== null) {
            return $cached;
        }
        $settingsPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'site_settings.json';
        if (file_exists($settingsPath)) {
            $data = json_decode(@file_get_contents($settingsPath), true);
            $cached = is_array($data) ? $data : [];
        } else {
            $cached = [];
        }
        return $cached;
    }
}

/**
 * Safe Automatic Static Asset Versioning / Cache Busting
 * Appends ?v=<filemtime> for local assets without duplicate query strings or PHP warnings.
 */
if (!function_exists('creed_asset_url')) {
    function creed_asset_url($relativePath) {
        $relativePath = (string)$relativePath;
        $cleanPath = ltrim($relativePath, '/');
        if ($cleanPath === '' || str_starts_with($cleanPath, 'http://') || str_starts_with($cleanPath, 'https://') || str_starts_with($cleanPath, '//') || str_starts_with($cleanPath, 'data:')) {
            return $relativePath;
        }
        $fullPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $cleanPath);
        if (file_exists($fullPath) && is_file($fullPath)) {
            $mtime = @filemtime($fullPath);
            if ($mtime !== false) {
                $separator = (strpos($relativePath, '?') !== false) ? '&' : '?';
                return $relativePath . $separator . 'v=' . $mtime;
            }
        }
        return $relativePath;
    }
}

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

/**
 * Lightweight Server-Side Form Rate Limiting & Abuse Prevention
 *
 * @param string $action Action namespace (e.g. 'contact_form', 'newsletter')
 * @param int $maxRequests Maximum submissions allowed in the window (default 5)
 * @param int $windowSeconds Window duration in seconds (default 60)
 * @param string|null $ip Client IP address
 * @return array ['allowed' => bool, 'retry_after' => int, 'remaining' => int]
 */
if (!function_exists('check_form_rate_limit')) {
    function check_form_rate_limit($action, $maxRequests = 5, $windowSeconds = 60, $ip = null) {
        if ($ip === null) {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        }

        $rateLimitDir = __DIR__ . '/../data';
        if (!is_dir($rateLimitDir)) {
            @mkdir($rateLimitDir, 0755, true);
        }
        $rateLimitFile = $rateLimitDir . '/form_rate_limits.json';

        $records = [];
        if (file_exists($rateLimitFile)) {
            $records = @json_decode(@file_get_contents($rateLimitFile), true) ?: [];
        }

        $now = time();
        $key = md5($action . ':' . trim((string)$ip));

        // Purge expired entries for this key
        $userTimestamps = isset($records[$key]) && is_array($records[$key]) ? $records[$key] : [];
        $userTimestamps = array_values(array_filter($userTimestamps, function($ts) use ($now, $windowSeconds) {
            return ($now - (int)$ts) < $windowSeconds;
        }));

        if (count($userTimestamps) >= $maxRequests) {
            $oldestInWindow = min($userTimestamps);
            $retryAfter = max(1, $windowSeconds - ($now - $oldestInWindow));
            return [
                'allowed'     => false,
                'retry_after' => $retryAfter,
                'remaining'   => 0
            ];
        }

        $userTimestamps[] = $now;
        $records[$key] = $userTimestamps;

        // Clean up other dead keys (older than 24h) to keep file compact
        foreach ($records as $k => $tsList) {
            if ($k !== $key && is_array($tsList)) {
                $filtered = array_filter($tsList, function($ts) use ($now) {
                    return ($now - (int)$ts) < 86400;
                });
                if (empty($filtered)) {
                    unset($records[$k]);
                } else {
                    $records[$k] = array_values($filtered);
                }
            }
        }

        @file_put_contents($rateLimitFile, json_encode($records), LOCK_EX);

        return [
            'allowed'     => true,
            'retry_after' => 0,
            'remaining'   => max(0, $maxRequests - count($userTimestamps))
        ];
    }
}

