<?php
/**
 * Creed Tech - Authoritative PHP Development Server Router & Security Filter
 */

require_once __DIR__ . '/includes/security_headers.php';

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
    '#\.(json|sql|log|env|bak|tmp|lock|ps1|sh|yml|yaml|ini|md|htaccess|git)$#i'
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

// 4. Serve legitimate static assets (CSS, JS, images, fonts, media)
if ($cleanPath !== '/' && file_exists($docRoot . $path) && !is_dir($docRoot . $path)) {
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    if ($ext !== 'php') {
        return false;
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
