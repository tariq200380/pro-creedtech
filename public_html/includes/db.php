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

// Global handles for legacy backward compatibility
global $connect, $conn;

/**
 * Lazy Database Connection Singleton
 *
 * Establishes a database connection ONLY when called.
 * Returns a mysqli connection instance or false on failure.
 *
 * @return mysqli|false
 */
function creed_db() {
    static $connection = null;
    static $attempted = false;

    if ($connection instanceof mysqli) {
        if (@mysqli_ping($connection)) {
            return $connection;
        }
        $connection = null;
        $attempted = false;
    }

    if ($attempted) {
        return $connection ?: false;
    }
    $attempted = true;

    // Suppress raw error display for visitors, log instead
    mysqli_report(MYSQLI_REPORT_OFF);

    // Fast socket probe before blocking mysqli connection attempt (0.03s timeout)
    $probe = @stream_socket_client('tcp://' . DB_HOST . ':' . DB_PORT, $errno, $errstr, 0.03, STREAM_CLIENT_CONNECT);
    if ($probe) {
        fclose($probe);
        $connObj = mysqli_init();
        if ($connObj) {
            mysqli_options($connObj, MYSQLI_OPT_CONNECT_TIMEOUT, 1);
            $connSuccess = @mysqli_real_connect($connObj, DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
            if ($connSuccess) {
                mysqli_set_charset($connObj, "utf8mb4");
                $connection = $connObj;
            } else {
                $connection = false;
                error_log("Database connection error: " . mysqli_connect_error());
            }
        }
    } else {
        $connection = false;
    }

    // Keep global variables synchronized if code accesses $connect or $conn
    global $connect, $conn;
    $connect = $connection;
    $conn = $connection;

    return $connection;
}

/**
 * Backward compatibility alias for creed_db()
 */
function creed_get_db_connection() {
    return creed_db();
}

/**
 * Helper to safely fetch rows with prepared statements
 */
function creed_query($sql, $params = [], $types = "") {
    $db = creed_db();
    if (!$db) return [];
    
    if (empty($params)) {
        $stmt = @mysqli_prepare($db, $sql);
        if (!$stmt) {
            $result = @mysqli_query($db, $sql);
            if (!$result) return [];
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysqli_free_result($result);
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
    
    $stmt = @mysqli_prepare($db, $sql);
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
    $db = creed_db();
    if (!$db) return false;
    
    $stmt = @mysqli_prepare($db, $sql);
    if (!$stmt) return false;
    
    if (!empty($types) && !empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    $success = @mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $success;
}
