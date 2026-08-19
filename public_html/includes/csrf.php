<?php
/**
 * Creed Tech - Central Cryptographic CSRF Protection Helper
 */

if (!defined('CREED_CSRF_ACTIVE')) {
    define('CREED_CSRF_ACTIVE', true);
}

if (session_status() === PHP_SESSION_NONE) {
    // Ensure session is started if not already
    if (!headers_sent()) {
        session_start();
    }
}

/**
 * Generate or retrieve the cryptographically secure CSRF token for the session
 */
function get_csrf_token() {
    if (empty($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token']) || strlen($_SESSION['csrf_token']) < 32) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function generate_csrf_token() {
    return get_csrf_token();
}

/**
 * Render a hidden HTML CSRF input field
 */
function csrf_field() {
    $token = htmlspecialchars(get_csrf_token(), ENT_QUOTES, 'UTF-8');
    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

/**
 * Validate a submitted CSRF token
 */
function validate_csrf_token($submittedToken = null) {
    if ($submittedToken === null) {
        $submittedToken = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? $_SERVER['HTTP_X_XSRF_TOKEN'] ?? null;
        if ($submittedToken === null) {
            $rawInput = @file_get_contents('php://input');
            if (!empty($rawInput)) {
                $jsonData = @json_decode($rawInput, true);
                if (is_array($jsonData) && isset($jsonData['csrf_token'])) {
                    $submittedToken = $jsonData['csrf_token'];
                }
            }
        }
    }

    $sessionToken = $_SESSION['csrf_token'] ?? '';
    if (empty($sessionToken) || empty($submittedToken) || !is_string($submittedToken)) {
        return false;
    }

    return hash_equals($sessionToken, $submittedToken);
}

/**
 * Enforce CSRF check for state-mutating requests (POST, PUT, PATCH, DELETE)
 */
function require_csrf_token() {
    $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
        if (!validate_csrf_token()) {
            http_response_code(403);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'success' => false,
                'message' => 'Forbidden: Invalid or missing CSRF security token. Please refresh the page and try again.'
            ], JSON_UNESCAPED_SLASHES);
            exit;
        }
    }
}
