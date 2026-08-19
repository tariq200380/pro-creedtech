<?php
/**
 * Creed Tech - Central Security Headers & Safe Runtime Initialization
 */

if (!headers_sent()) {
    // 1. Core Frame & Injection Defenses
    header("X-Frame-Options: DENY");
    header("X-Content-Type-Options: nosniff");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()");
    header("Cross-Origin-Opener-Policy: same-origin-allow-popups");

    // 2. Content Security Policy (allows necessary CDNs for Tailwind, SweetAlert, Bootstrap Icons, Fonts)
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

    // 3. Strict Transport Security on HTTPS only
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    if ($isHttps) {
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }
}

// 4. Production Error Configuration
$appDebug = getenv('APP_DEBUG');
if ($appDebug === 'true' || $appDebug === '1') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
}
