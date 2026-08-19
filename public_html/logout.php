<?php
/**
 * Creed Tech - Secure Administrative POST-Only Logout Handler
 */

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_name('CREED_ADMIN_SESSID');
    session_start();
}

// Ensure no-store / private cache headers
if (!headers_sent()) {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private');
    header('Pragma: no-cache');
}

require_once __DIR__ . '/includes/csrf.php';

// 1. Check if user is authenticated
$isAuthenticated = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

if (!$isAuthenticated) {
    header('Location: login.php');
    exit;
}

// 2. Reject GET or non-POST requests with HTTP 405 Method Not Allowed
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(405);
    header('Allow: POST');
    header('Content-Type: text/plain; charset=utf-8');
    die("HTTP 405 Method Not Allowed: Administrative logout must be submitted via POST with a valid CSRF token.\n");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit;
}

// 3. Validate CSRF Token
$token = $_POST['csrf_token'] ?? '';
if (!validate_csrf_token($token)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    die("HTTP 403 Forbidden: Invalid or missing CSRF token during logout request.\n");
}

// 4. Perform Complete Secure Session Destruction
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

@session_destroy();

// 5. Redirect cleanly to login page
header('Location: login.php?logged_out=1');
exit;
