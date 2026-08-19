<?php
/**
 * Creed Tech - Administrative Structured Security Audit Logger
 */

if (!function_exists('creed_audit_log')) {
    function creed_audit_log($action, $entityType = 'SYSTEM', $entityId = null, $result = 'SUCCESS', $context = []) {
        $logFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'security_audit.log';
        $logDir = dirname($logFile);
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0750, true);
        }

        // Generate or reuse request correlation ID
        static $correlationId = null;
        if ($correlationId === null) {
            $correlationId = bin2hex(random_bytes(8));
        }

        $adminId = $_SESSION['admin_user_id'] ?? $_SESSION['admin_id'] ?? 0;
        $adminEmail = $_SESSION['admin_email'] ?? 'ANONYMOUS';

        // Safely extract client IP
        $clientIp = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        if (str_contains($clientIp, ',')) {
            $parts = explode(',', $clientIp);
            $clientIp = trim($parts[0]);
        }

        // Redact any sensitive keys if present in context
        $safeContext = [];
        if (is_array($context)) {
            foreach ($context as $k => $v) {
                if (preg_match('/(password|hash|token|secret|cookie|sess|auth|card|cvv)/i', $k)) {
                    $safeContext[$k] = '[REDACTED]';
                } elseif (is_scalar($v)) {
                    $safeContext[$k] = (string)$v;
                }
            }
        }

        $record = [
            'timestamp'      => gmdate('Y-m-d\TH:i:s\Z'),
            'correlation_id' => $correlationId,
            'admin_id'       => $adminId,
            'admin_email'    => $adminEmail,
            'ip'             => $clientIp,
            'action'         => strtoupper($action),
            'entity_type'    => strtoupper($entityType),
            'entity_id'      => $entityId,
            'result'         => strtoupper($result),
            'context'        => $safeContext
        ];

        // Safe log rotation if file exceeds 10MB
        if (file_exists($logFile) && filesize($logFile) > 10485760) {
            @rename($logFile, $logFile . '.' . date('Ymd_His') . '.bak');
        }

        @file_put_contents($logFile, json_encode($record, JSON_UNESCAPED_SLASHES) . "\n", FILE_APPEND | LOCK_EX);
    }
}
