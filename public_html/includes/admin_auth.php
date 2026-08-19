<?php
/**
 * Creed Tech - Admin Authentication & Password Hashing Service
 */

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/csrf.php';

$authLogFile = __DIR__ . '/../data/security_audit.log';
$rateLimitFile = __DIR__ . '/../data/login_rate_limits.json';
$adminStoreFile = dirname(__DIR__, 2) . '/data/admin_store.json';

/**
 * Log security events with sensitive parameter redaction
 */
function log_security_event($event, $details = []) {
    global $authLogFile;
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    
    // Redact password or token fields
    $safeDetails = [];
    foreach ($details as $k => $v) {
        if (preg_match('/(password|token|hash|secret|auth)/i', $k)) {
            $safeDetails[$k] = '[REDACTED]';
        } else {
            $safeDetails[$k] = $v;
        }
    }

    $logEntry = [
        'timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
        'event'     => $event,
        'ip'        => $ip,
        'details'   => $safeDetails
    ];

    @file_put_contents($authLogFile, json_encode($logEntry, JSON_UNESCAPED_SLASHES) . "\n", FILE_APPEND | LOCK_EX);
}

/**
 * Check if IP or Account is rate limited (max 5 failed attempts in 15 mins)
 */
function check_login_rate_limit($email, $ip = null) {
    global $rateLimitFile;
    if ($ip === null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }

    $emailKey = strtolower(trim($email));
    $ipKey = trim($ip);

    if (!file_exists($rateLimitFile)) {
        return ['allowed' => true, 'remaining' => 5];
    }

    $data = @json_decode(@file_get_contents($rateLimitFile), true);
    if (!is_array($data)) return ['allowed' => true, 'remaining' => 5];

    $now = time();
    $window = 900; // 15 minutes

    $emailAttempts = array_filter($data['emails'][$emailKey] ?? [], fn($t) => ($now - $t) < $window);
    $ipAttempts = array_filter($data['ips'][$ipKey] ?? [], fn($t) => ($now - $t) < $window);

    $count = max(count($emailAttempts), count($ipAttempts));
    if ($count >= 5) {
        return ['allowed' => false, 'remaining' => 0, 'retry_after' => $window - ($now - min(array_merge($emailAttempts, $ipAttempts)))];
    }

    return ['allowed' => true, 'remaining' => 5 - $count];
}

/**
 * Record a failed login attempt
 */
function record_failed_login($email, $ip = null) {
    global $rateLimitFile;
    if ($ip === null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }

    $emailKey = strtolower(trim($email));
    $ipKey = trim($ip);
    $now = time();
    $window = 900;

    $data = file_exists($rateLimitFile) ? (@json_decode(@file_get_contents($rateLimitFile), true) ?: []) : [];
    if (!isset($data['emails'])) $data['emails'] = [];
    if (!isset($data['ips'])) $data['ips'] = [];

    $data['emails'][$emailKey] = array_values(array_filter($data['emails'][$emailKey] ?? [], fn($t) => ($now - $t) < $window));
    $data['ips'][$ipKey] = array_values(array_filter($data['ips'][$ipKey] ?? [], fn($t) => ($now - $t) < $window));

    $data['emails'][$emailKey][] = $now;
    $data['ips'][$ipKey][] = $now;

    @file_put_contents($rateLimitFile, json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);
    log_security_event('LOGIN_FAILED', ['email' => $emailKey]);
}

/**
 * Clear rate limit records after successful login
 */
function clear_login_rate_limit($email, $ip = null) {
    global $rateLimitFile;
    if ($ip === null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }

    $emailKey = strtolower(trim($email));
    $ipKey = trim($ip);

    if (!file_exists($rateLimitFile)) return;

    $data = @json_decode(@file_get_contents($rateLimitFile), true);
    if (!is_array($data)) return;

    unset($data['emails'][$emailKey]);
    unset($data['ips'][$ipKey]);

    @file_put_contents($rateLimitFile, json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);
}

/**
/**
 * Fetch Admin User from database or secure local store
 */
function get_or_init_admin_user($email) {
    global $connect, $adminStoreFile;
    $email = strtolower(trim($email));

    // Try database first if available
    if ($connect instanceof mysqli) {
        // Check if admin exists in database
        $stmt = @mysqli_prepare($connect, "SELECT `id`, `email`, `password_hash`, `role`, `status` FROM `admin_users` WHERE `email` = ? AND `status` = 'ACTIVE' LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($res)) {
                mysqli_stmt_close($stmt);
                return $row;
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Secure fallback local file store (protected from web access)
    $store = file_exists($adminStoreFile) ? (@json_decode(@file_get_contents($adminStoreFile), true) ?: []) : [];
    if (isset($store[$email])) {
        return $store[$email];
    }

    return null;
}

/**
 * Authenticate Administrator Credentials
 */
function authenticate_admin($email, $password) {
    global $connect;

    $rateCheck = check_login_rate_limit($email);
    if (!$rateCheck['allowed']) {
        return [
            'success' => false,
            'error'   => 'Too many failed attempts. Account temporarily locked. Please try again in 15 minutes.'
        ];
    }

    $admin = get_or_init_admin_user($email);
    if (!$admin || $admin['status'] !== 'ACTIVE') {
        record_failed_login($email);
        return [
            'success' => false,
            'error'   => 'Invalid administrator email or password.'
        ];
    }

    if (!password_verify($password, $admin['password_hash'])) {
        record_failed_login($email);
        return [
            'success' => false,
            'error'   => 'Invalid administrator email or password.'
        ];
    }

    // Check if password needs rehash
    $algo = defined('PASSWORD_ARGON2ID') ? PASSWORD_ARGON2ID : PASSWORD_DEFAULT;
    if (password_needs_rehash($admin['password_hash'], $algo)) {
        $newHash = password_hash($password, $algo);
        if ($connect instanceof mysqli) {
            $stmt = @mysqli_prepare($connect, "UPDATE `admin_users` SET `password_hash` = ? WHERE `id` = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "si", $newHash, $admin['id']);
                @mysqli_stmt_execute($stmt);
                @mysqli_stmt_close($stmt);
            }
        }
    }

    // Login successful: clear rate limits
    clear_login_rate_limit($email);
    log_security_event('LOGIN_SUCCESS', ['email' => $admin['email'], 'user_id' => $admin['id']]);

    // Regenerate session ID and store user session
    if (session_status() === PHP_SESSION_ACTIVE) {
        @session_regenerate_id(true);
    }
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_user_id']   = $admin['id'];
    $_SESSION['admin_email']     = $admin['email'];
    $_SESSION['admin_role']      = $admin['role'];
    $_SESSION['last_activity']   = time();
    $_SESSION['created_at']      = time();

    return [
        'success' => true,
        'user'    => $admin
    ];
}
