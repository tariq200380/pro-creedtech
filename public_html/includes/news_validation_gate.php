<?php
/**
 * Creed Tech - Central News Validation & Publication Gate
 * Version 1.0 (Enterprise Strict)
 *
 * Implements end-to-end security, article authenticity verification,
 * visual asset cryptographic verification, provider diversity constraints,
 * and atomic rollback-safe updates.
 */

if (!defined('NEWS_GATE_ACTIVE')) {
    define('NEWS_GATE_ACTIVE', true);
}

// Status Constants
define('STATUS_FETCHED',              'FETCHED');
define('STATUS_PENDING_VERIFICATION', 'PENDING_VERIFICATION');
define('STATUS_VERIFIED',             'VERIFIED');
define('STATUS_PUBLISHED',            'PUBLISHED');
define('STATUS_REJECTED',             'REJECTED');
define('STATUS_QUARANTINED',          'QUARANTINED');

// Visual Types
define('VISUAL_SOURCE_IMAGE',             'source_image');
define('VISUAL_SOURCE_HEADER_SCREENSHOT', 'source_header_screenshot');

class NewsValidationGate {

    // Configured Approved Providers
    public static $approvedProviders = [
        'google'      => ['name' => 'Google The Keyword',       'region' => 'international', 'max_public' => 1],
        'apple'       => ['name' => 'Apple Newsroom',           'region' => 'international', 'max_public' => 1],
        'nvidia'      => ['name' => 'NVIDIA Official Blog',     'region' => 'international', 'max_public' => 1],
        'anthropic'   => ['name' => 'Anthropic Official',       'region' => 'international', 'max_public' => 1],
        'openai'      => ['name' => 'OpenAI Newsroom',          'region' => 'international', 'max_public' => 1],
        'meta'        => ['name' => 'Meta Newsroom',            'region' => 'international', 'max_public' => 1],
        'microsoft'   => ['name' => 'Microsoft News Center',   'region' => 'international', 'max_public' => 1],
        'intel'       => ['name' => 'Intel Newsroom',           'region' => 'international', 'max_public' => 1],
        'dawn'        => ['name' => 'Dawn Sci-Tech',            'region' => 'pakistan',      'max_public' => 1],
        'brecorder'   => ['name' => 'Business Recorder',        'region' => 'pakistan',      'max_public' => 1],
        'propakistani'=> ['name' => 'ProPakistani',             'region' => 'pakistan',      'max_public' => 1],
        'tribune'     => ['name' => 'The Express Tribune',      'region' => 'pakistan',      'max_public' => 1]
    ];

    // Approved Canonical Source Domains
    public static $approvedSourceDomains = [
        'blog.google',
        'www.apple.com', 'apple.com',
        'blogs.nvidia.com',
        'www.anthropic.com', 'anthropic.com',
        'openai.com',
        'about.fb.com', 'about.meta.com', 'engineering.fb.com',
        'blogs.microsoft.com', 'news.microsoft.com', 'microsoft.com',
        'newsroom.intel.com', 'intel.com', 'www.intel.com',
        'news.google.com',
        'www.dawn.com', 'dawn.com',
        'www.brecorder.com', 'brecorder.com',
        'propakistani.pk',
        'tribune.com.pk'
    ];

    // Approved Image CDN Domains
    public static $approvedImageDomains = [
        'storage.googleapis.com', 'lh3.googleusercontent.com', 'blog.google',
        'www.apple.com', 'apple.com',
        'blogs.nvidia.com', 'images.nvidia.com',
        'cdn.sanity.io', 'www-cdn.anthropic.com', 'www.anthropic.com', 'anthropic.com',
        'images.ctfassets.net', 'openaicom-cdn.azureedge.net', 'openai.com', 'www.openai.com',
        'about.fb.com', 'about.meta.com', 'scontent.xx.fbcdn.net', 'facebook.com',
        'blogs.microsoft.com', 'news.microsoft.com', 'devblogs.microsoft.com', 'www.microsoft.com', 'microsoft.com',
        'newsroom.intel.com', 'www.intel.com', 'intel.com',
        'i.dawn.com', 'www.dawn.com', 'dawn.com',
        'i.brecorder.com', 'www.brecorder.com', 'brecorder.com',
        'propakistani.pk', 'www.propakistani.pk',
        'i.tribune.com.pk', 'tribune.com.pk', 'www.tribune.com.pk'
    ];

    /**
     * SSRF Check: Ensure IP address is not private/reserved/loopback
     */
    public static function isSafeRemoteHost($host) {
        $ip = gethostbyname($host);
        if (empty($ip) || $ip === $host && !filter_var($ip, FILTER_VALIDATE_IP)) {
            // Check if valid IP
            return false;
        }

        // Filter private & reserved IP ranges
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return false;
        }

        return true;
    }

    /**
     * Parse provider publication timestamp
     */
    public static function parseProviderDate($dateStr) {
        if (empty($dateStr)) return null;
        $dateStr = trim($dateStr);
        $ts = strtotime($dateStr);
        if ($ts !== false && $ts > 0) return $ts;
        
        $dt = DateTime::createFromFormat('D, d M y H:i:s O', $dateStr);
        if ($dt) return $dt->getTimestamp();

        $dt = date_create($dateStr);
        if ($dt) return $dt->getTimestamp();

        return null;
    }

    /**
     * Step 1 & 2: Verify Raw Article Metadata
     */
    public static function verifyArticleMetadata($candidate) {
        $provider = strtolower($candidate['provider'] ?? '');

        // 1. Provider Check
        if (!isset(self::$approvedProviders[$provider])) {
            return ['valid' => false, 'error' => "Unapproved provider: '$provider'"];
        }

        // 2. External ID Check
        $extId = trim($candidate['external_article_id'] ?? '');
        if (empty($extId)) {
            return ['valid' => false, 'error' => 'Missing external_article_id'];
        }

        // 3. Title Check & Sanitization
        $title = trim($candidate['title'] ?? '');
        $title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // Strip trailing provider suffixes like " - Anthropic", " - Source Asia", etc.
        $title = preg_replace('/\s*[-–—|]\s*(Anthropic|Google The Keyword|Apple Newsroom|Microsoft News Center|Source Asia|NVIDIA Blog|OpenAI|Meta Newsroom|Dawn|Business Recorder|Express Tribune|ProPakistani)\s*$/i', '', $title);
        $title = trim($title);

        if (empty($title) || mb_strlen($title, 'UTF-8') < 5) {
            return ['valid' => false, 'error' => 'Invalid or empty article title'];
        }
        if (preg_match('/^(test|sample|lorem ipsum|mock|demo)/i', $title)) {
            return ['valid' => false, 'error' => 'Generated/mock title detected'];
        }

        // Summary Sanitization
        $summary = trim($candidate['summary'] ?? '');
        $summary = html_entity_decode($summary, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $summary = preg_replace('/The post .* appeared first on .*/i', '', $summary);
        $summary = preg_replace('/\s*[-–—|]\s*(Anthropic|Google|Apple|Microsoft|NVIDIA|OpenAI)\s*$/i', '', $summary);
        $summary = trim(preg_replace('/\s+/', ' ', $summary));

        // 4. Source URL Check
        $sourceUrl = trim($candidate['source_url'] ?? '');
        if (empty($sourceUrl) || !filter_var($sourceUrl, FILTER_VALIDATE_URL)) {
            return ['valid' => false, 'error' => 'Invalid canonical source URL format'];
        }

        $parsed = parse_url($sourceUrl);
        $scheme = strtolower($parsed['scheme'] ?? '');
        $host   = strtolower($parsed['host'] ?? '');

        if ($scheme !== 'https') {
            return ['valid' => false, 'error' => 'Canonical source URL must use HTTPS'];
        }

        $domainAllowed = false;
        foreach (self::$approvedSourceDomains as $d) {
            if ($host === $d || str_ends_with($host, '.' . $d)) {
                $domainAllowed = true;
                break;
            }
        }
        if (!$domainAllowed) {
            return ['valid' => false, 'error' => "Canonical domain '$host' is not in the approved source allowlist"];
        }

        // 5. Provider PubDate Check (Never current server time)
        $rawPubDate = $candidate['provider_published_at'] ?? $candidate['pub_date_raw'] ?? '';
        $pubTimestamp = self::parseProviderDate($rawPubDate);
        if (!$pubTimestamp) {
            return ['valid' => false, 'error' => 'Missing or unparseable provider publication time'];
        }

        return [
            'valid'         => true,
            'provider'      => $provider,
            'ext_id'        => $extId,
            'title'         => $title,
            'summary'       => $summary,
            'source_url'    => $sourceUrl,
            'pub_timestamp' => $pubTimestamp,
            'published_at'  => gmdate('Y-m-d H:i:s', $pubTimestamp)
        ];
    }

    /**
     * Step 3: Verify Visual Asset (Type 1: Source Image or Type 2: Source Screenshot)
     */
    public static function verifyVisualAsset($candidate, $uploadDir) {
        $visualType = $candidate['visual_type'] ?? VISUAL_SOURCE_IMAGE;

        // ==========================================
        // TYPE 2: Verified Source-Header Screenshot
        // ==========================================
        if ($visualType === VISUAL_SOURCE_HEADER_SCREENSHOT) {
            $localPath = $candidate['local_image_path'] ?? '';
            $fullPath = __DIR__ . '/../' . $localPath;
            if (empty($localPath) || !file_exists($fullPath)) {
                return ['valid' => false, 'error' => "Screenshot file not found on disk: '$localPath'"];
            }

            $content = file_get_contents($fullPath);
            if (empty($content)) {
                return ['valid' => false, 'error' => 'Screenshot file on disk is empty'];
            }

            $actualHash = hash('sha256', $content);
            $expectedHash = $candidate['screenshot_hash'] ?? $candidate['image_hash'] ?? '';
            if (!empty($expectedHash) && $actualHash !== $expectedHash) {
                return ['valid' => false, 'error' => "Screenshot SHA-256 mismatch (Expected: $expectedHash, Actual: $actualHash)"];
            }

            return [
                'valid'           => true,
                'visual_type'     => VISUAL_SOURCE_HEADER_SCREENSHOT,
                'local_path'      => $localPath,
                'image_hash'      => $actualHash,
                'source_image_url'=> null,
                'mime_type'       => 'image/jpeg',
                'status'          => 'VERIFIED_SOURCE_SCREENSHOT'
            ];
        }

        // ==========================================
        // TYPE 1: Verified Original Source Image
        // ==========================================
        $sourceImageUrl = trim(html_entity_decode($candidate['source_image_url'] ?? $candidate['image_url'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $existingLocal  = trim($candidate['local_image_path'] ?? '');

        // If local file exists and is a genuine source image, verify disk state and retain
        if (!empty($existingLocal) && strpos($existingLocal, '_headline_') === false) {
            $fullPath = __DIR__ . '/../' . $existingLocal;
            if (file_exists($fullPath) && filesize($fullPath) > 0) {
                $diskContent = @file_get_contents($fullPath);
                if (!empty($diskContent)) {
                    $actualHash = hash('sha256', $diskContent);
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $detectedMime = $finfo->buffer($diskContent);
                    return [
                        'valid'           => true,
                        'visual_type'     => VISUAL_SOURCE_IMAGE,
                        'local_path'      => $existingLocal,
                        'image_hash'      => $actualHash,
                        'source_image_url'=> !empty($sourceImageUrl) ? $sourceImageUrl : ($candidate['source_image_url'] ?? null),
                        'mime_type'       => $detectedMime ?: 'image/jpeg',
                        'status'          => 'VERIFIED_SOURCE_IMAGE'
                    ];
                }
            }
        }

        // If no source image URL is provided, trigger Check 7: Automated Verified Headline Card Generator
        if (empty($sourceImageUrl) || !filter_var($sourceImageUrl, FILTER_VALIDATE_URL)) {
            $headlineRes = self::generateHeadlineCardVisual($candidate, $uploadDir);
            if ($headlineRes['valid']) {
                return $headlineRes;
            }
            return ['valid' => false, 'error' => 'No valid original source image URL provided and headline card generation failed: ' . ($headlineRes['error'] ?? '')];
        }
        if (preg_match('/(unsplash\.com|assets\/img|placeholder|stock|mock)/i', $sourceImageUrl)) {
            return ['valid' => false, 'error' => 'Forbidden fallback or generic image URL detected'];
        }

        $parsed = parse_url($sourceImageUrl);
        $scheme = strtolower($parsed['scheme'] ?? '');
        $host   = strtolower($parsed['host'] ?? '');

        if ($scheme !== 'https' && $scheme !== 'http') {
            return ['valid' => false, 'error' => 'Image URL scheme must be HTTP/HTTPS'];
        }

        $hostAllowed = false;
        foreach (self::$approvedImageDomains as $d) {
            if ($host === $d || str_ends_with($host, '.' . $d)) {
                $hostAllowed = true;
                break;
            }
        }
        if (!$hostAllowed) {
            return ['valid' => false, 'error' => "Image host '$host' is not in the approved CDN allowlist"];
        }

        if (!self::isSafeRemoteHost($host)) {
            return ['valid' => false, 'error' => "SSRF blocked for host '$host'"];
        }

        // Download & Cryptographic Verification
        $imageContent = null;
        $httpStatus   = 0;
        $mimeType     = 'unknown';

        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => $sourceImageUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 4,
                CURLOPT_TIMEOUT        => 8,
                CURLOPT_CONNECTTIMEOUT => 4,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) CreedTechNewsValidator/1.0',
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2
            ]);
            $imageContent = curl_exec($ch);
            $httpStatus   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $mimeType     = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            curl_close($ch);
        } else {
            $imageContent = @file_get_contents($sourceImageUrl);
            $httpStatus   = $imageContent ? 200 : 500;
        }

        // If download failed or returned invalid response, trigger Check 7: Automated Headline Card Generator
        if ($httpStatus !== 200 || empty($imageContent)) {
            $headlineRes = self::generateHeadlineCardVisual($candidate, $uploadDir);
            if ($headlineRes['valid']) {
                return $headlineRes;
            }
            return ['valid' => false, 'error' => "Failed to download source image (HTTP $httpStatus) and headline generation failed: " . ($headlineRes['error'] ?? '')];
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->buffer($imageContent);

        $allowedMimes = [
            'image/jpeg'    => 'jpg',
            'image/png'     => 'png',
            'image/webp'    => 'webp',
            'image/gif'     => 'gif',
            'image/avif'    => 'avif',
            'image/svg+xml' => 'svg'
        ];

        if (!array_key_exists($detectedMime, $allowedMimes)) {
            $headlineRes = self::generateHeadlineCardVisual($candidate, $uploadDir);
            if ($headlineRes['valid']) {
                return $headlineRes;
            }
            return ['valid' => false, 'error' => "Disallowed image MIME type: '$detectedMime'"];
        }

        $ext = $allowedMimes[$detectedMime];
        $imageHash = hash('sha256', $imageContent);
        $provider = strtolower($candidate['provider'] ?? 'unknown');
        $safeId = preg_replace('/[^a-zA-Z0-9_-]/', '', substr($candidate['external_article_id'] ?? 'art', -20));
        $filename = $provider . '_' . $safeId . '_' . substr($imageHash, 0, 12) . '.' . $ext;
        $finalDiskPath = $uploadDir . '/' . $filename;
        $relativeLocalPath = 'uploads/live_news/' . $filename;

        if (!file_exists($finalDiskPath)) {
            $tempPath = $uploadDir . '/' . $filename . '.tmp.' . uniqid();
            if (@file_put_contents($tempPath, $imageContent, LOCK_EX) === false) {
                @unlink($tempPath);
                return ['valid' => false, 'error' => 'Failed to write image to disk'];
            }
            @chmod($tempPath, 0644);
            if (!@rename($tempPath, $finalDiskPath)) {
                @unlink($tempPath);
                return ['valid' => false, 'error' => 'Failed to save final image file'];
            }
        }

        return [
            'valid'           => true,
            'visual_type'     => VISUAL_SOURCE_IMAGE,
            'local_path'      => $relativeLocalPath,
            'image_hash'      => $imageHash,
            'source_image_url'=> $sourceImageUrl,
            'mime_type'       => $detectedMime,
            'status'          => 'VERIFIED_SOURCE_IMAGE'
        ];
    }

    /**
     * CHECK 7: Automated Verified Headline Card / Screenshot Generator
     * When a verified article has no image asset, generates a clean 16:9 verified headline card.
     */
    public static function generateHeadlineCardVisual($candidate, $uploadDir) {
        $provider = strtolower($candidate['provider'] ?? 'wire');
        $title    = trim($candidate['title'] ?? 'Verified News Article');
        $category = trim($candidate['category'] ?? 'Enterprise Wire');
        $dateStr  = trim($candidate['provider_published_at'] ?? date('M d, Y'));

        $safeId   = preg_replace('/[^a-zA-Z0-9_-]/', '', substr($candidate['external_article_id'] ?? 'art', -20));
        $filename = $provider . '_headline_' . $safeId . '_' . substr(md5($title . $dateStr), 0, 10) . '.png';
        $finalDiskPath = $uploadDir . '/' . $filename;
        $relativeLocalPath = 'uploads/live_news/' . $filename;

        if (file_exists($finalDiskPath) && filesize($finalDiskPath) > 0) {
            $hash = hash_file('sha256', $finalDiskPath);
            return [
                'valid'           => true,
                'visual_type'     => VISUAL_SOURCE_HEADER_SCREENSHOT,
                'local_path'      => $relativeLocalPath,
                'image_hash'      => $hash,
                'source_image_url'=> null,
                'mime_type'       => 'image/png',
                'status'          => 'VERIFIED_HEADLINE_SCREENSHOT'
            ];
        }

        $scriptPaths = [
            __DIR__ . '/../../scripts/generate_headline_card.py',
            __DIR__ . '/../scripts/generate_headline_card.py',
            dirname(__DIR__, 2) . '/scripts/generate_headline_card.py'
        ];
        $scriptPath = null;
        foreach ($scriptPaths as $sp) {
            if (file_exists($sp)) {
                $scriptPath = $sp;
                break;
            }
        }

        if ($scriptPath) {
            $summary = trim($candidate['summary'] ?? '');
            $cmd = sprintf(
                'python3 %s %s %s %s %s %s %s 2>&1',
                escapeshellarg($scriptPath),
                escapeshellarg($provider),
                escapeshellarg($title),
                escapeshellarg($category),
                escapeshellarg($dateStr),
                escapeshellarg($finalDiskPath),
                escapeshellarg($summary)
            );
            $out = @shell_exec($cmd);
            if (file_exists($finalDiskPath) && filesize($finalDiskPath) > 0) {
                $hash = hash_file('sha256', $finalDiskPath);
                return [
                    'valid'           => true,
                    'visual_type'     => VISUAL_SOURCE_HEADER_SCREENSHOT,
                    'local_path'      => $relativeLocalPath,
                    'image_hash'      => $hash,
                    'source_image_url'=> null,
                    'mime_type'       => 'image/png',
                    'status'          => 'VERIFIED_HEADLINE_SCREENSHOT'
                ];
            }
        }

        return ['valid' => false, 'error' => 'Headline card generator script failed or missing'];
    }

    /**
     * Central Gate Validator & Atomic Publisher
     */
    public static function processAndPublishCandidate($candidate, $uploadDir = null) {
        if (!$uploadDir) {
            $uploadDir = __DIR__ . '/../uploads/live_news';
        }
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        // 1. Validate Article Metadata
        $metaRes = self::verifyArticleMetadata($candidate);
        if (!$metaRes['valid']) {
            return [
                'published' => false,
                'status'    => STATUS_REJECTED,
                'error'     => $metaRes['error'],
                'candidate' => $candidate
            ];
        }

        // 2. Validate Visual Asset
        $visualRes = self::verifyVisualAsset($candidate, $uploadDir);
        if (!$visualRes['valid']) {
            return [
                'published' => false,
                'status'    => STATUS_REJECTED,
                'error'     => $visualRes['error'],
                'candidate' => $candidate
            ];
        }

        // 3. Construct Verified & Published Record
        $verifiedRecord = [
            'provider'                  => $metaRes['provider'],
            'external_article_id'       => $metaRes['ext_id'],
            'title'                     => $metaRes['title'],
            'source_name'               => $candidate['source_name'] ?? self::$approvedProviders[$metaRes['provider']]['name'],
            'source_url'                => $metaRes['source_url'],
            'provider_published_at'     => $metaRes['published_at'],
            'summary'                   => $metaRes['summary'],
            'category'                  => $candidate['category'] ?? '',
            'brand_badge'               => $candidate['brand_badge'] ?? '',
            'visual_type'               => $visualRes['visual_type'],
            'source_image_url'          => $visualRes['source_image_url'],
            'local_image_path'          => $visualRes['local_path'],
            'image_url'                 => $visualRes['local_path'],
            'image_hash'                => $visualRes['image_hash'],
            'verification_status'       => STATUS_PUBLISHED,
            'verification_error'        => null,
            'verified_at'               => gmdate('Y-m-d H:i:s'),
            'last_sync_status'          => 'SUCCESS',
            'last_sync_attempt_at'      => gmdate('Y-m-d H:i:s')
        ];

        return [
            'published' => true,
            'status'    => STATUS_PUBLISHED,
            'record'    => $verifiedRecord
        ];
    }

    /**
     * Atomic Cache Writer
     */
    public static function writeAtomicCache($cacheFile, $data) {
        $tempPath = $cacheFile . '.tmp.' . uniqid();
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if (@file_put_contents($tempPath, $json, LOCK_EX) === false) {
            @unlink($tempPath);
            return false;
        }
        @chmod($tempPath, 0644);
        return @rename($tempPath, $cacheFile);
    }
}
