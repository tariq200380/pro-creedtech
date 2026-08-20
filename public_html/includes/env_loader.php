<?php
/**
 * Creed Tech - Environment & Central Configuration Loader
 */

if (!function_exists('creed_load_env')) {
    function creed_load_env() {
        static $loaded = false;
        if ($loaded) {
            return;
        }
        $loaded = true;

        $envFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
        if (!file_exists($envFile) || !is_readable($envFile)) {
            return;
        }

        $lines = @file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) return;

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            list($key, $val) = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val);

            // Strip quotes if present
            if ((str_starts_with($val, '"') && str_ends_with($val, '"')) ||
                (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
                $val = substr($val, 1, -1);
            }

            if (getenv($key) === false) {
                putenv("{$key}={$val}");
                $_ENV[$key] = $val;
                $_SERVER[$key] = $val;
            }
        }
    }
}

if (!function_exists('creed_env')) {
    function creed_env($key, $default = null) {
        $val = getenv($key);
        if ($val !== false) return $val;
        if (isset($_ENV[$key])) return $_ENV[$key];
        if (isset($_SERVER[$key])) return $_SERVER[$key];
        return $default;
    }
}

// Auto-load environment on include
creed_load_env();
