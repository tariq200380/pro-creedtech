<?php
/**
 * Creed Tech - Database Connection & Helper Functions
 */

require_once __DIR__ . '/env_loader.php';

if (!defined('DB_HOST')) define('DB_HOST', creed_env('DB_HOST', '127.0.0.1'));
if (!defined('DB_PORT')) define('DB_PORT', (int)creed_env('DB_PORT', 3306));
if (!defined('DB_USER')) define('DB_USER', creed_env('DB_USER', 'root'));
if (!defined('DB_PASS')) define('DB_PASS', creed_env('DB_PASS', ''));
if (!defined('DB_NAME')) define('DB_NAME', creed_env('DB_NAME', 'creed_tech'));

// Suppress raw error display for visitors, log instead
mysqli_report(MYSQLI_REPORT_OFF);

// Fast non-blocking socket reachability probe to prevent Windows TCP SYN timeout stalling (fails in < 30ms if MySQL daemon is stopped)
$connect = false;
$probe = @stream_socket_client('tcp://' . DB_HOST . ':' . DB_PORT, $errno, $errstr, 0.03, STREAM_CLIENT_CONNECT);
if ($probe) {
    fclose($probe);
    $connect = mysqli_init();
    if ($connect) {
        mysqli_options($connect, MYSQLI_OPT_CONNECT_TIMEOUT, 1);
        $connSuccess = @mysqli_real_connect($connect, DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if (!$connSuccess) {
            $connect = false;
            error_log("Database connection error: " . mysqli_connect_error());
        } else {
            mysqli_set_charset($connect, "utf8mb4");
        }
    }
}

/**
 * Helper to safely fetch rows with prepared statements
 */
function creed_query($sql, $params = [], $types = "") {
    global $connect;
    if (!$connect) return [];
    
    if (empty($params)) {
        $stmt = @mysqli_prepare($connect, $sql);
        if (!$stmt) {
            $result = @mysqli_query($connect, $sql);
            if (!$result) return [];
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
        @mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            mysqli_stmt_close($stmt);
            return [];
        }
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $rows;
    }
    
    $stmt = @mysqli_prepare($connect, $sql);
    if (!$stmt) return [];
    
    if (!empty($types) && !empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    @mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        mysqli_stmt_close($stmt);
        return [];
    }
    
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $rows;
}

/**
 * Helper for INSERT/UPDATE/DELETE queries
 */
function creed_execute($sql, $params = [], $types = "") {
    global $connect;
    if (!$connect) return false;
    
    $stmt = @mysqli_prepare($connect, $sql);
    if (!$stmt) return false;
    
    if (!empty($types) && !empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    $success = @mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $success;
}
