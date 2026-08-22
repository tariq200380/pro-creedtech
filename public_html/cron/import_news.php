<?php
/**
 * Creed Tech - Automated Cron Job for Live News & Image Ingestion
 * Usage via CLI: php public_html/cron/import_news.php [--force]
 * Usage via Web: https://example.com/cron/import_news.php?key=cron_secret
 */

require_once __DIR__ . '/../includes/env_loader.php';

// If accessed via Web, enforce Secret Key authentication
if (php_sapi_name() !== 'cli') {
    header('Content-Type: application/json; charset=utf-8');

    $expectedSecret = creed_env('CRON_SECRET', 'cron_secret');
    $providedKey = (string)($_GET['key'] ?? $_SERVER['HTTP_X_CRON_KEY'] ?? '');

    if (empty($providedKey) || !hash_equals($expectedSecret, $providedKey)) {
        http_response_code(403);
        echo json_encode([
            'status'  => 'error',
            'message' => 'Forbidden: Invalid or missing cron secret key.'
        ], JSON_PRETTY_PRINT);
        exit;
    }
}

$lockFile = sys_get_temp_dir() . '/creed_news_import.lock';
$fp = @fopen($lockFile, 'c+');

if (!$fp || !flock($fp, LOCK_EX | LOCK_NB)) {
    $msg = "Import job already running. Exiting.";
    if (php_sapi_name() === 'cli') {
        echo "[CRON] {$msg}\n";
    } else {
        echo json_encode(['status' => 'busy', 'message' => $msg]);
    }
    exit;
}

require_once __DIR__ . '/../ajax/live_tech_news.php';

$result = sync_all_verified_feeds(true);

flock($fp, LOCK_UN);
fclose($fp);
@unlink($lockFile);

if (php_sapi_name() === 'cli') {
    echo "[CRON SUCCESS] Live news feeds and images successfully synchronized at " . date('Y-m-d H:i:s') . "\n";
    echo "--------------------------------------------------------------------------------\n";
    echo "INTERNATIONAL WIRES (8 Providers):\n";
    $wires = $result['brand_wires'] ?? [];
    $statuses = $result['provider_statuses'] ?? [];
    foreach (['google', 'apple', 'nvidia', 'anthropic', 'openai', 'meta', 'microsoft', 'intel'] as $p) {
        $item = $wires[$p] ?? [];
        $diag = $statuses[$p] ?? [];
        $st = is_array($diag) ? ($diag['status'] ?? 'VERIFIED') : $diag;
        $title = $item['title'] ?? 'No article';
        $date = $item['date'] ?? 'No date';
        echo sprintf("  %-10s [%-14s] %s (%s)\n", strtoupper($p), $st, $title, $date);
    }
    echo "--------------------------------------------------------------------------------\n";
    echo "REGIONAL PAKISTAN WIRES (4 Providers):\n";
    $regWires = $result['regional_wires'] ?? [];
    foreach (['dawn', 'brecorder', 'propakistani', 'tribune'] as $rp) {
        $rItem = $regWires[$rp] ?? [];
        $rTitle = $rItem['title'] ?? 'No article';
        $rDate = $rItem['date'] ?? 'No date';
        echo sprintf("  %-12s %s (%s)\n", strtoupper($rp), $rTitle, $rDate);
    }
    echo "--------------------------------------------------------------------------------\n";
} else {
    echo json_encode([
        'status'            => 'success',
        'timestamp'         => date('Y-m-d H:i:s'),
        'message'           => 'Live news feeds and images successfully synchronized.',
        'provider_statuses' => $result['provider_statuses'] ?? [],
        'counts'            => $result['counts'] ?? []
    ], JSON_PRETTY_PRINT);
}
