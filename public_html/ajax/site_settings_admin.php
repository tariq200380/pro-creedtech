<?php
/**
 * Creed Tech - Website Settings Admin Handler
 * Provides secure endpoints to get and update frontend website settings.
 */

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/auth_guard.php';
require_once __DIR__ . '/../includes/csrf.php';

$settingsFile = __DIR__ . '/../data/site_settings.json';
$portfolioFile = __DIR__ . '/../data/portfolio_projects.json';
$aboutFile = __DIR__ . '/../data/about_page_settings.json';
$contactFile = __DIR__ . '/../data/contact_page_settings.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $settingsData = file_exists($settingsFile) ? (json_decode(@file_get_contents($settingsFile), true) ?: []) : [];
    $portfolioData = file_exists($portfolioFile) ? (json_decode(@file_get_contents($portfolioFile), true) ?: []) : [];
    $aboutData = file_exists($aboutFile) ? (json_decode(@file_get_contents($aboutFile), true) ?: []) : [];
    $contactData = file_exists($contactFile) ? (json_decode(@file_get_contents($contactFile), true) ?: []) : [];
    
    $settingsData['portfolio'] = $portfolioData;
    $settingsData['about_page'] = $aboutData;
    $settingsData['contact_page'] = $contactData;
    echo json_encode(['success' => true, 'settings' => $settingsData]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawInput = @file_get_contents('php://input');
    $payload = @json_decode($rawInput, true);
    if (!is_array($payload)) {
        $payload = !empty($_POST) && is_array($_POST) ? $_POST : [];
    }

    $token = $payload['csrf_token'] ?? $_POST['csrf_token'] ?? '';
    if (!validate_csrf_token($token)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden: Invalid or missing CSRF security token.']);
        exit;
    }

    if (empty($payload)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Empty or invalid settings payload.']);
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
    if (isset($payload['header'])) {
        $current['header'] = array_merge($current['header'] ?? [], $payload['header']);
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

    // Save site_settings.json
    $savedSettings = @file_put_contents($settingsFile, json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

    // If portfolio payload is present, save portfolio_projects.json
    if (isset($payload['portfolio']) && is_array($payload['portfolio'])) {
        @file_put_contents($portfolioFile, json_encode($payload['portfolio'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        $current['portfolio'] = $payload['portfolio'];
    }

    // If about_page payload is present, save about_page_settings.json
    if (isset($payload['about_page']) && is_array($payload['about_page'])) {
        @file_put_contents($aboutFile, json_encode($payload['about_page'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        $current['about_page'] = $payload['about_page'];
    }

    // If contact_page payload is present, save contact_page_settings.json
    if (isset($payload['contact_page']) && is_array($payload['contact_page'])) {
        @file_put_contents($contactFile, json_encode($payload['contact_page'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        $current['contact_page'] = $payload['contact_page'];
    }

    if ($savedSettings !== false) {
        echo json_encode(['success' => true, 'message' => 'Website, Portfolio, About & Contact settings saved successfully!', 'settings' => $current]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to write settings to disk. Please check folder permissions.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Unsupported request method.']);
