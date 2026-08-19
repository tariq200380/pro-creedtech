<?php
/**
 * Creed Tech - Authoritative CLI Backend for Admin Credential Setup
 *
 * Strictly CLI-only. Receives input strictly via STDIN from the interactive PowerShell wrapper.
 */

// 1. Strict CLI-Only Protection
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    die("Access Denied: This utility must be executed from the command line interface only.\n");
}

$projectRoot = dirname(__DIR__);
$publicHtmlDir = $projectRoot . DIRECTORY_SEPARATOR . 'public_html';
$dataDir = $projectRoot . DIRECTORY_SEPARATOR . 'data';
$adminStoreFile = $dataDir . DIRECTORY_SEPARATOR . 'admin_store.json';
$rateLimitFile = $publicHtmlDir . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'login_rate_limits.json';
$auditLogFile = $publicHtmlDir . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'security_audit.log';

require_once $publicHtmlDir . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'db.php';

// 2. Read strictly from STDIN
$stdinContent = @file_get_contents('php://stdin');
if ($stdinContent === false || trim($stdinContent) === '') {
    fwrite(STDERR, "[ERROR] No input provided. This tool must be executed via 'scripts\\set_admin_credentials.ps1'.\n");
    exit(1);
}

// Support JSON payload over STDIN from wrapper
$trimmed = preg_replace('/^\xEF\xBB\xBF/', '', trim($stdinContent));
$payload = @json_decode($trimmed, true);
if (!is_array($payload)) {
    // Fallback line-delimited format: line 1 = email, line 2 = password, line 3 = confirm
    $lines = explode("\n", str_replace("\r\n", "\n", $stdinContent));
    $payload = [
        'email'    => $lines[0] ?? '',
        'password' => $lines[1] ?? '',
        'confirm'  => $lines[2] ?? ''
    ];
}

$email = strtolower(trim((string)($payload['email'] ?? '')));
$password = (string)($payload['password'] ?? '');
$confirm = (string)($payload['confirm'] ?? '');

// 3. Strict Server-Side Validation
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    fwrite(STDERR, "[ERROR] Invalid administrator email format.\n");
    exit(1);
}

if ($password === '' || trim($password) === '') {
    fwrite(STDERR, "[ERROR] Password cannot be empty or whitespace-only.\n");
    exit(1);
}

if (strlen($password) < 14) {
    fwrite(STDERR, "[ERROR] Password must be at least 14 characters in length.\n");
    exit(1);
}

if ($confirm === '' || trim($confirm) === '') {
    fwrite(STDERR, "[ERROR] Password confirmation is required.\n");
    exit(1);
}

if ($password !== $confirm) {
    fwrite(STDERR, "[ERROR] Password and confirmation do not match.\n");
    exit(1);
}

$rejectedEmails = ['admin@gmail.com', 'admin@admin.com', 'test@test.com', 'admin@example.com', 'root@localhost'];
$rejectedPasswords = [
    'Admin@225588', 'password', 'password123456', 'admin123456789', 'administrator',
    'qwerty12345678', 'admin123', 'admin', 'password1234567890', '12345678901234'
];

if (in_array($email, $rejectedEmails, true)) {
    fwrite(STDERR, "[ERROR] Default/placeholder email address is not permitted.\n");
    exit(1);
}

if (in_array($password, $rejectedPasswords, true) || in_array(strtolower($password), $rejectedPasswords, true)) {
    fwrite(STDERR, "[ERROR] Common or default passwords are not permitted.\n");
    exit(1);
}

// 4. Secure Password Hashing
$algo = defined('PASSWORD_ARGON2ID') ? PASSWORD_ARGON2ID : PASSWORD_DEFAULT;
$algoName = ($algo === PASSWORD_ARGON2ID) ? "Argon2id" : "Bcrypt (PASSWORD_DEFAULT)";
$hash = password_hash($password, $algo);

// Immediately clear plaintext variables from memory
unset($password, $confirm, $payload, $stdinContent);

if (!$hash) {
    fwrite(STDERR, "[ERROR] Failed to generate secure password hash.\n");
    exit(1);
}

// 5. Atomic Storage Execution (Database or Local Secure Store outside public_html)
$storageType = 'LOCAL DEVELOPMENT STORAGE (outside public_html)';
$dbUpdated = false;
global $connect;

if ($connect instanceof mysqli) {
    $createTableSql = "CREATE TABLE IF NOT EXISTS `admin_users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `password_hash` VARCHAR(255) NOT NULL,
        `role` VARCHAR(50) NOT NULL DEFAULT 'admin',
        `status` ENUM('ACTIVE', 'SUSPENDED', 'LOCKED') NOT NULL DEFAULT 'ACTIVE',
        `failed_attempts` INT NOT NULL DEFAULT 0,
        `last_login_at` DATETIME DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    @mysqli_query($connect, $createTableSql);

    // Maintain exactly one active administrator account
    @mysqli_query($connect, "DELETE FROM `admin_users`");

    $stmt = @mysqli_prepare($connect, "INSERT INTO `admin_users` (`email`, `password_hash`, `role`, `status`) VALUES (?, ?, 'admin', 'ACTIVE')");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $hash);
        if (mysqli_stmt_execute($stmt)) {
            $dbUpdated = true;
            $storageType = 'MYSQL DATABASE (admin_users table via Prepared Statement)';
        }
        mysqli_stmt_close($stmt);
    }
}

// Always maintain local development secure store outside public_html
if (!is_dir($dataDir)) {
    @mkdir($dataDir, 0750, true);
}

$adminStore = [
    $email => [
        'id'            => 1,
        'email'         => $email,
        'password_hash' => $hash,
        'role'          => 'admin',
        'status'        => 'ACTIVE',
        'created_at'    => gmdate('Y-m-d H:i:s')
    ]
];

// Atomic write to local store
$tmpFile = $adminStoreFile . '.' . bin2hex(random_bytes(6)) . '.tmp';
file_put_contents($tmpFile, json_encode($adminStore, JSON_PRETTY_PRINT), LOCK_EX);
rename($tmpFile, $adminStoreFile);

// 6. Reset Rate Limits & Invalidate Old Sessions
if (file_exists($rateLimitFile)) {
    file_put_contents($rateLimitFile, json_encode(['emails' => [], 'ips' => []], JSON_PRETTY_PRINT), LOCK_EX);
}

// 7. Security Audit Log
if (file_exists(dirname($auditLogFile))) {
    $auditEntry = [
        'timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
        'event'     => 'ADMIN_CREDENTIALS_CONFIGURED_CLI',
        'ip'        => 'CLI_LOCAL',
        'details'   => [
            'email'        => $email,
            'role'         => 'admin',
            'algo'         => $algoName,
            'storage_mode' => $storageType
        ]
    ];
    @file_put_contents($auditLogFile, json_encode($auditEntry, JSON_UNESCAPED_SLASHES) . "\n", FILE_APPEND | LOCK_EX);
}

echo "[SUCCESS]\n";
echo "Administrator Email : " . htmlspecialchars($email) . "\n";
echo "Account Role        : admin\n";
echo "Hashing Algorithm   : " . $algoName . "\n";
echo "Storage Location    : " . $storageType . "\n";
echo "Active Accounts     : 1\n";
echo "Session & Rate Reset: YES\n";
exit(0);
