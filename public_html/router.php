<?php
/**
 * Creed Tech - Authoritative PHP Development Server Router & Security Filter
 */

require_once __DIR__ . '/includes/security_headers.php';

// Dynamic response gzip compression for PHP development server
$acceptEnc = $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '';
if (str_contains($acceptEnc, 'gzip') && extension_loaded('zlib') && php_sapi_name() === 'cli-server') {
    ob_start();
    register_shutdown_function(function() {
        if (ob_get_level() > 0) {
            $content = ob_get_clean();
            if (!empty($content) && !headers_sent() && http_response_code() !== 304 && strlen($content) > 256) {
                $gzipped = gzencode($content, 6);
                header('Content-Encoding: gzip');
                header('Vary: Accept-Encoding');
                header('Content-Length: ' . strlen($gzipped));
                echo $gzipped;
                return;
            }
            echo $content;
        }
    });
}

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH) ?? '/';

// 1. Strict Path Traversal & Hidden File Protection
if (str_contains($path, '..') || str_contains($path, "\0") || preg_match('#(^|/)\.#', $path)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    die("HTTP 403 Forbidden: Invalid path.\n");
}

// 2. Sensitive Directory & Private File Extension Blocking
$blockedPatterns = [
    '#^/data(/|$)#i',
    '#^/logs(/|$)#i',
    '#^/backups(/|$)#i',
    '#^/scripts(/|$)#i',
    '#^/tests(/|$)#i',
    '#^/cron(/|$)#i',
    '#(\.(json|sql|log|env|backup|old|orig|save|tmp|lock|ps1|sh|yml|yaml|ini|md|htaccess|git)|\.bak(_.*)?|~)$#i'
];

foreach ($blockedPatterns as $pattern) {
    if (preg_match($pattern, $path)) {
        http_response_code(403);
        header('Content-Type: text/plain; charset=utf-8');
        die("HTTP 403 Forbidden: Access to private system resources is denied.\n");
    }
}

// 3. Prevent PHP/script execution inside uploads folder
if (preg_match('#^/uploads/.*\.php#i', $path) || preg_match('#^/uploads/.*\.phtml#i', $path)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    die("HTTP 403 Forbidden: Direct script execution in upload directory is prohibited.\n");
}

$docRoot = __DIR__;
$cleanPath = rtrim($path, '/');
if (empty($cleanPath)) {
    $cleanPath = '/Home';
}

$filePath = $docRoot . $cleanPath;

// Dynamic XML Sitemap Generation Route
if ($cleanPath === '/sitemap.xml' || $path === '/sitemap.xml') {
    require $docRoot . '/sitemap.php';
    exit;
}

// 4. Serve legitimate static assets (CSS, JS, images, fonts, media) with Cache-Control, ETag, and Gzip
if ($cleanPath !== '/' && file_exists($docRoot . $path) && !is_dir($docRoot . $path)) {
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if ($ext !== 'php') {
        $realFile = realpath($docRoot . $path);
        if ($realFile && str_starts_with($realFile, realpath($docRoot))) {
            $mimetypes = [
                'webp'  => 'image/webp',
                'avif'  => 'image/avif',
                'png'   => 'image/png',
                'jpg'   => 'image/jpeg',
                'jpeg'  => 'image/jpeg',
                'gif'   => 'image/gif',
                'svg'   => 'image/svg+xml',
                'ico'   => 'image/x-icon',
                'css'   => 'text/css; charset=utf-8',
                'js'    => 'application/javascript; charset=utf-8',
                'mjs'   => 'application/javascript; charset=utf-8',
                'woff2' => 'font/woff2',
                'woff'  => 'font/woff',
                'ttf'   => 'font/ttf',
                'eot'   => 'application/vnd.ms-fontobject',
                'otf'   => 'font/otf',
                'json'  => 'application/json; charset=utf-8',
                'xml'   => 'application/xml; charset=utf-8',
                'txt'   => 'text/plain; charset=utf-8'
            ];

            $mime = $mimetypes[$ext] ?? (function_exists('mime_content_type') ? @mime_content_type($realFile) : null) ?: 'application/octet-stream';
            $mtime = filemtime($realFile);
            $size = filesize($realFile);
            $etag = sprintf('"%x-%x"', $mtime, $size);

            header('Content-Type: ' . $mime);
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s GMT', $mtime));
            header('ETag: ' . $etag);
            header('Vary: Accept-Encoding');

            // Static asset caching headers
            if (in_array($ext, ['webp', 'avif', 'png', 'jpg', 'jpeg', 'gif', 'ico', 'svg', 'woff2', 'woff', 'ttf', 'eot', 'otf'])) {
                header('Cache-Control: public, max-age=31536000, immutable');
                header('Expires: ' . gmdate('D, d M Y H:i:s GMT', time() + 31536000));
            } elseif (in_array($ext, ['css', 'js', 'mjs'])) {
                header('Cache-Control: public, max-age=2592000, stale-while-revalidate=86400');
                header('Expires: ' . gmdate('D, d M Y H:i:s GMT', time() + 2592000));
            }

            // HTTP 304 Not Modified validation
            $ifNoneMatch = $_SERVER['HTTP_IF_NONE_MATCH'] ?? '';
            $ifModifiedSince = $_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '';
            if (($ifNoneMatch && trim($ifNoneMatch) === $etag) || ($ifModifiedSince && strtotime($ifModifiedSince) >= $mtime)) {
                http_response_code(304);
                exit;
            }

            // Gzip compression for compressible text assets
            $acceptEncoding = $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '';
            $compressible = in_array($ext, ['css', 'js', 'mjs', 'svg', 'json', 'xml', 'txt']) && $size > 256;
            if ($compressible && str_contains($acceptEncoding, 'gzip') && extension_loaded('zlib')) {
                $content = file_get_contents($realFile);
                $gzipped = gzencode($content, 6);
                header('Content-Encoding: gzip');
                header('Content-Length: ' . strlen($gzipped));
                echo $gzipped;
                exit;
            }

            header('Content-Length: ' . $size);
            readfile($realFile);
            exit;
        }
    }
}

// 5. Clean URL mappings for admin and public routes
$mappings = [
    '/sitemap.xml'       => '/sitemap.php',
    '/admin'             => '/admin.php',
    '/edit_panel'        => '/edit_panel.php',
    '/login'             => '/login.php',
    '/logout'            => '/logout.php',
    '/Home'              => '/Home.php',
    '/home'              => '/Home.php',
    '/about'             => '/about.php',
    '/services'          => '/services.php',
    '/contact'           => '/contact.php',
    '/portfolio'         => '/portfolio.php',
    '/knowledge-center'  => '/knowledge-center.php',
    '/careers'           => '/careers.php',
    '/blog'              => '/blog.php',
    '/blog-insert'       => '/blog-insert.php',
    '/article-insert'    => '/article-insert.php',
    '/add-article'       => '/add-article.php',
    '/add-blog'          => '/add-blog.php',
    '/edit'              => '/edit.php',
    '/delete'            => '/delete.php',
    '/article_edit'      => '/article_edit.php',
    '/article_delete'    => '/article_delete.php',
    '/events_edit'       => '/events_edit.php',
    '/events_delete'     => '/events_delete.php',
    '/stories_edit'      => '/stories_edit.php',
    '/stories_delete'    => '/stories_delete.php',
    '/trending_edit'     => '/trending_edit.php',
    '/trending_delete'   => '/trending_delete.php',
    '/video_edit'        => '/video_edit.php',
    '/video_delete'      => '/video_delete.php',
    '/article'           => '/article.php',
    '/events'            => '/events.php',
    '/stories'           => '/stories.php',
    '/trending'          => '/trending.php',
    '/video'             => '/video.php',
    '/Dont_Missing'      => '/Dont_Missing.php',
    '/blog_detail'       => '/blog_detail.php',
    '/article_detail'    => '/article_detail.php',
    '/trending_detail'   => '/trending_detail.php',
    '/qa'                => '/qa.php',
    '/ui-ux'             => '/ui-ux.php',
    '/software-development' => '/software-development.php',
    '/database'          => '/database.php',
    '/404'               => '/404.php'
];

if (isset($mappings[$cleanPath])) {
    $targetFile = $docRoot . $mappings[$cleanPath];
    if (file_exists($targetFile)) {
        require $targetFile;
        exit;
    }
}

// 6. Direct .php file execution
if (file_exists($filePath . '.php')) {
    require $filePath . '.php';
    exit;
}

// 7. Exact PHP file requested directly
if (file_exists($filePath) && is_file($filePath)) {
    require $filePath;
    exit;
}

// 8. Fallback to 404 (Proper HTTP 404 Status Code Delivery & Soft-404 Prevention)
if (file_exists($docRoot . '/404.php')) {
    http_response_code(404);
    require $docRoot . '/404.php';
    exit;
}

return false;
