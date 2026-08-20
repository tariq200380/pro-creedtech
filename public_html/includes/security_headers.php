<?php
/**
 * Creed Tech - Central Security Headers & Safe Runtime Initialization
 */

// 1. Automatic Gzip Compression for Dynamic Responses (where supported and output buffer is available)
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
    if (ob_get_level() === 0 && !headers_sent() && php_sapi_name() !== 'cli') {
        ob_start('ob_gzhandler');
    }
}

if (!headers_sent()) {
    // 2. Core Frame & Injection Defenses
    header("X-Frame-Options: DENY");
    header("X-Content-Type-Options: nosniff");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()");
    header("Cross-Origin-Opener-Policy: same-origin-allow-popups");

    // 3. Content Security Policy (allows necessary CDNs for Tailwind, SweetAlert, Bootstrap Icons, Fonts)
    $csp = "default-src 'self'; " .
           "script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdn.jsdelivr.net; " .
           "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; " .
           "font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net data:; " .
           "img-src 'self' data: https: blob:; " .
           "connect-src 'self' https:; " .
           "frame-ancestors 'none'; " .
           "object-src 'none'; " .
           "base-uri 'self'; " .
           "form-action 'self';";
    header("Content-Security-Policy: {$csp}");

    // 4. Strict Transport Security on HTTPS only
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    if ($isHttps) {
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }

    // 5. Dynamic Endpoint Cache Control (protect dynamic PHP & API routes from stale caching)
    $reqUri = $_SERVER['REQUEST_URI'] ?? '';
    $reqPath = parse_url($reqUri, PHP_URL_PATH) ?? '';
    if (str_starts_with($reqPath, '/admin') || 
        str_starts_with($reqPath, '/ajax') || 
        str_starts_with($reqPath, '/login') || 
        str_starts_with($reqPath, '/logout') || 
        str_starts_with($reqPath, '/cron') || 
        str_starts_with($reqPath, '/edit_panel')) {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}

// 6. Production Error Configuration
$appDebug = getenv('APP_DEBUG');
if ($appDebug === 'true' || $appDebug === '1') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
}
