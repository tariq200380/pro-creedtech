<?php
/**
 * Creed Tech - Automated Cron Job for Live News & Image Ingestion
 * Usage via CLI: php public_html/cron/import_news.php [--force]
 * Usage via Web: https://example.com/cron/import_news.php?key=cron_secret
 */

if (php_sapi_name() !== 'cli') {
    header('Content-Type: application/json; charset=utf-8');
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
} else {
    echo json_encode([
        'status'    => 'success',
        'timestamp' => date('Y-m-d H:i:s'),
        'message'   => 'Live news feeds and images successfully synchronized.'
    ], JSON_PRETTY_PRINT);
}
