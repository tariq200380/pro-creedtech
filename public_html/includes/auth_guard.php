<?php
/**
 * Creed Tech - Central Server-Side Administrative Authentication Guard
 */

if (!defined('CREED_AUTH_GUARD_ACTIVE')) {
    define('CREED_AUTH_GUARD_ACTIVE', true);
}

// 1. Central Secure Session Bootstrap
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    ini_set('session.use_only_cookies', '1');
    ini_set('session.use_strict_mode', '1');

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? '') == 443;
    
    session_name('CREED_ADMIN_SESSID');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'domain'   => '',
        'secure'   => $isHttps,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    session_start();
}

// Prevent browser and proxy caching of any protected administrative response
if (!headers_sent()) {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private');
    header('Pragma: no-cache');
}

require_once __DIR__ . '/security_headers.php';
require_once __DIR__ . '/security_helpers.php';
require_once __DIR__ . '/csrf.php';

// Helper to check if current request is AJAX / JSON
function is_ajax_request() {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = parse_url($uri, PHP_URL_PATH) ?? '';
    return str_starts_with($path, '/ajax/') ||
           (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
           (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) ||
           (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false);
}

// 2. Validate Session Authenticity & Timeouts
$isAuthenticated = false;

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && !empty($_SESSION['admin_user_id'])) {
    $now = time();
    $inactivityLimit = 900;    // 15 minutes
    $absoluteLimit   = 14400;  // 4 hours

    $lastActivity = $_SESSION['last_activity'] ?? 0;
    $createdAt    = $_SESSION['created_at'] ?? 0;

    if (($now - $lastActivity) > $inactivityLimit || ($now - $createdAt) > $absoluteLimit) {
        // Session expired
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        @session_destroy();
        $isAuthenticated = false;
    } else {
        // Valid active session: refresh activity timer
        $_SESSION['last_activity'] = $now;
        $isAuthenticated = true;
    }
}

// 3. Handle Unauthenticated Requests
if (!$isAuthenticated) {
    if (is_ajax_request()) {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => false,
            'error'   => 'Unauthorized. Valid administrator session required.'
        ], JSON_PRETTY_PRINT);
        exit;
    } else {
        $requestedUrl = $_SERVER['REQUEST_URI'] ?? 'edit_panel.php';
        $cleanPath = parse_url($requestedUrl, PHP_URL_PATH) ?? '';
        $base = basename($cleanPath);
        $redirectParam = ($base !== 'login' && $base !== 'login.php' && !empty($requestedUrl)) ? '?redirect=' . urlencode($requestedUrl) : '';
        header('Location: login.php' . $redirectParam);
        exit;
    }
}

// 4. Role Authorization (Admin role required)
if (($_SESSION['admin_role'] ?? '') !== 'super_admin' && ($_SESSION['admin_role'] ?? '') !== 'admin') {
    http_response_code(403);
    if (is_ajax_request()) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'error' => 'Forbidden: Insufficient privileges.'], JSON_PRETTY_PRINT);
    } else {
        echo '<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body style="font-family:sans-serif;text-align:center;padding:50px;"><h2>403 Forbidden</h2><p>Your account does not have administrative privileges.</p></body></html>';
    }
    exit;
}

// 5. Automatic CSRF Protection on Mutating Requests
require_csrf_token();
