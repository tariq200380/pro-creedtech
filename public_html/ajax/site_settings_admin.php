<?php
/**
 * Creed Tech - Website Settings Admin Handler
 * Provides secure endpoints to get and update frontend website settings.
 */

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/auth_guard.php';
require_once __DIR__ . '/../includes/csrf.php';

$settingsFile = __DIR__ . '/../data/site_settings.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($settingsFile)) {
        $data = json_decode(@file_get_contents($settingsFile), true) ?: [];
        echo json_encode(['success' => true, 'settings' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Settings file not found.']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawInput = @file_get_contents('php://input');
    $payload = @json_decode($rawInput, true);

    if (!is_array($payload)) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON payload.']);
        exit;
    }

    $current = file_exists($settingsFile) ? (json_decode(file_get_contents($settingsFile), true) ?: []) : [];

    // Merge updated settings
    if (isset($payload['general'])) {
        $current['general'] = array_merge($current['general'] ?? [], $payload['general']);
    }
    if (isset($payload['announcement_bar'])) {
        $current['announcement_bar'] = array_merge($current['announcement_bar'] ?? [], $payload['announcement_bar']);
    }
    if (isset($payload['hero_section'])) {
        $current['hero_section'] = array_merge($current['hero_section'] ?? [], $payload['hero_section']);
    }
    if (isset($payload['footer'])) {
        $current['footer'] = array_merge($current['footer'] ?? [], $payload['footer']);
    }
    if (isset($payload['seo'])) {
        $current['seo'] = array_merge($current['seo'] ?? [], $payload['seo']);
    }
    if (isset($payload['custom_sections'])) {
        $current['custom_sections'] = $payload['custom_sections'];
    }

    $saved = @file_put_contents($settingsFile, json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

    if ($saved !== false) {
        echo json_encode(['success' => true, 'message' => 'Website settings saved successfully!', 'settings' => $current]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to write settings to disk. Please check folder permissions.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Unsupported request method.']);
