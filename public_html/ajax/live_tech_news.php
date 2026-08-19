<?php
/**
 * Creed Tech - Multi-Provider Live News & Image Ingestion Engine
 * Version 6.0 - Protected by Central NewsValidationGate
 *
 * Implements strict publication gating, provider diversity, and atomic updates.
 */

if (php_sapi_name() !== 'cli' && !headers_sent()) {
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Cache-Control: no-cache, no-store, must-revalidate');
}

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/news_validation_gate.php';

$cacheFile = __DIR__ . '/../data/live_news_cache.json';
$logFile   = __DIR__ . '/../data/live_news_sync.log';
$uploadDir = __DIR__ . '/../uploads/live_news';

if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
}

/**
 * Diagnostic logger with secret redaction
 */
function log_news_diagnostic($entry) {
    global $logFile;
    $timestamp = gmdate('Y-m-d\TH:i:s\Z');
    
    $safeEntry = [
        'timestamp'            => $timestamp,
        'provider'             => $entry['provider'] ?? 'unknown',
        'external_article_id'  => $entry['external_article_id'] ?? 'unknown',
        'detected_image_field' => $entry['detected_image_field'] ?? 'none',
        'source_image_url'     => preg_replace('/(api[-_]?key|token|auth|secret)=[^&]+/i', '$1=REDACTED', $entry['source_image_url'] ?? ''),
        'http_status'          => $entry['http_status'] ?? 0,
        'mime_type'            => $entry['mime_type'] ?? 'unknown',
        'saved_path'           => $entry['saved_path'] ?? null,
        'database_result'      => $entry['database_result'] ?? 'skipped',
        'cache_result'         => $entry['cache_result'] ?? 'not_updated',
        'status'               => $entry['status'] ?? 'info',
        'message'              => $entry['message'] ?? ''
    ];
    
    $logLine = json_encode($safeEntry, JSON_UNESCAPED_SLASHES) . "\n";
    @file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
}

/**
 * Upsert verified article record in MySQL database
 */
function upsert_verified_news_db($article) {
    global $conn;
    if (!isset($conn) || !$conn instanceof mysqli) {
        return false;
    }

    $provider           = $conn->real_escape_string($article['provider']);
    $externalArticleId  = $conn->real_escape_string($article['external_article_id']);
    $wireType           = $conn->real_escape_string($article['wire_type'] ?? 'general');
    $wireKey            = $conn->real_escape_string($article['wire_key'] ?? $article['provider']);
    $category           = $conn->real_escape_string($article['category'] ?? '');
    $brandBadge         = $conn->real_escape_string($article['brand_badge'] ?? '');
    $captionTag         = $conn->real_escape_string($article['caption_tag'] ?? '');
    $caption            = $conn->real_escape_string($article['caption'] ?? '');
    $title              = $conn->real_escape_string($article['title']);
    $summary            = $conn->real_escape_string($article['summary'] ?? '');
    $sourceName         = $conn->real_escape_string($article['source_name'] ?? '');
    $sourceUrl          = $conn->real_escape_string($article['source_url'] ?? '');
    $sourceImageUrl     = !empty($article['source_image_url']) ? "'" . $conn->real_escape_string($article['source_image_url']) . "'" : "NULL";
    $imageUrl           = $conn->real_escape_string($article['image_url'] ?? '');
    $localImagePath     = $conn->real_escape_string($article['local_image_path'] ?? '');
    $imageHash          = $conn->real_escape_string($article['image_hash'] ?? '');
    $imageUpdatedAt     = !empty($article['image_updated_at']) ? "'" . $conn->real_escape_string($article['image_updated_at']) . "'" : "NOW()";
    $visualType         = $conn->real_escape_string($article['visual_type'] ?? 'source_image');
    $verStatus          = $conn->real_escape_string($article['verification_status'] ?? 'PUBLISHED');

    $sql = "INSERT INTO `live_news` (
        `provider`, `external_article_id`, `wire_type`, `wire_key`, `category`, `brand_badge`,
        `caption_tag`, `caption`, `title`, `summary`, `source_name`, `source_url`,
        `source_image_url`, `image_url`, `local_image_path`, `image_hash`, `image_updated_at`,
        `visual_type`, `verification_status`, `verified_at`, `created_at`, `updated_at`
    ) VALUES (
        '$provider', '$externalArticleId', '$wireType', '$wireKey', '$category', '$brandBadge',
        '$captionTag', '$caption', '$title', '$summary', '$sourceName', '$sourceUrl',
        $sourceImageUrl, '$imageUrl', '$localImagePath', '$imageHash', $imageUpdatedAt,
        '$visualType', '$verStatus', NOW(), NOW(), NOW()
    ) ON DUPLICATE KEY UPDATE
        `category` = VALUES(`category`),
        `brand_badge` = VALUES(`brand_badge`),
        `caption_tag` = VALUES(`caption_tag`),
        `caption` = VALUES(`caption`),
        `title` = VALUES(`title`),
        `summary` = VALUES(`summary`),
        `source_name` = VALUES(`source_name`),
        `source_url` = VALUES(`source_url`),
        `source_image_url` = VALUES(`source_image_url`),
        `image_url` = VALUES(`image_url`),
        `local_image_path` = VALUES(`local_image_path`),
        `image_hash` = VALUES(`image_hash`),
        `image_updated_at` = VALUES(`image_updated_at`),
        `visual_type` = VALUES(`visual_type`),
        `verification_status` = VALUES(`verification_status`),
        `verified_at` = NOW(),
        `updated_at` = NOW()";

    return @$conn->query($sql);
}

/**
 * Format relative time strictly from provider publication timestamp
 */
function format_provider_relative_time($pubDateStr) {
    $pubTimestamp = NewsValidationGate::parseProviderDate($pubDateStr);
    if (!$pubTimestamp) {
        return 'Recently Published';
    }
    
    $now = time();
    $diff = $now - $pubTimestamp;
    
    if ($diff < 60 && $diff >= 0) {
        return 'Just Now';
    } elseif ($diff < 3600 && $diff >= 60) {
        $mins = max(1, floor($diff / 60));
        return $mins . ' min' . ($mins > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400 && $diff >= 3600) {
        $hours = floor($diff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 604800 && $diff >= 86400) {
        $days = floor($diff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        return date('M j, Y', $pubTimestamp);
    }
}

/**
 * Ingest feed with strict Central NewsValidationGate verification
 */
function ingest_and_gate_feed($feedConfig, $uploadDir) {
    $url          = $feedConfig['url'];
    $providerKey  = $feedConfig['provider'];
    $sourceName   = $feedConfig['source_name'];
    $brandBadge   = $feedConfig['brand_badge'];
    $category     = $feedConfig['category'];
    $wireType     = $feedConfig['wire_type'] ?? 'general';
    $wireKey      = $feedConfig['wire_key'] ?? $providerKey;
    $customImage  = $feedConfig['custom_image'] ?? null;
    $customLocal  = $feedConfig['custom_local'] ?? null;
    $customHash   = $feedConfig['custom_hash'] ?? null;
    $visualType   = $feedConfig['visual_type'] ?? VISUAL_SOURCE_IMAGE;

    $rawContent = null;
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            CURLOPT_SSL_VERIFYPEER => true
        ]);
        $rawContent = curl_exec($ch);
        curl_close($ch);
    }
    if (!$rawContent && NewsValidationGate::isSafeRemoteHost(parse_url($url, PHP_URL_HOST))) {
        $rawContent = @file_get_contents($url);
    }

    if (!$rawContent) {
        return [];
    }

    $rawItems = preg_split('/<item[\s>]|<entry[\s>]/i', $rawContent);
    array_shift($rawItems);

    $verifiedItems = [];

    foreach ($rawItems as $itemRaw) {
        $title = '';
        if (preg_match('/<title[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/title>/is', $itemRaw, $m)) {
            $title = trim(strip_tags($m[1]));
        }

        $link = '';
        if (preg_match('/<link[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/link>/is', $itemRaw, $m)) {
            $link = trim($m[1]);
        } elseif (preg_match('/<link[^>]+href=["\']([^"\']+)["\']/i', $itemRaw, $m)) {
            $link = trim($m[1]);
        }

        $guid = '';
        if (preg_match('/<guid[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/guid>/is', $itemRaw, $m)) {
            $guid = trim($m[1]);
        } elseif (preg_match('/<id[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/id>/is', $itemRaw, $m)) {
            $guid = trim($m[1]);
        }
        if (empty($guid)) $guid = $link;

        $pubDateRaw = '';
        if (preg_match('/<pubDate>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/pubDate>/is', $itemRaw, $m)) {
            $pubDateRaw = trim($m[1]);
        } elseif (preg_match('/<updated>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/updated>/is', $itemRaw, $m)) {
            $pubDateRaw = trim($m[1]);
        } elseif (preg_match('/<published>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/published>/is', $itemRaw, $m)) {
            $pubDateRaw = trim($m[1]);
        }

        $descRaw = '';
        if (preg_match('/<description[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/description>/is', $itemRaw, $m)) {
            $descRaw = $m[1];
        } elseif (preg_match('/<summary[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/summary>/is', $itemRaw, $m)) {
            $descRaw = $m[1];
        } elseif (preg_match('/<content:encoded[^>]*>(?:<!\[CDATA\[)?(.*?)(?:\]\]>)?<\/content:encoded>/is', $itemRaw, $m)) {
            $descRaw = $m[1];
        }

        if (empty($title) || empty($link)) continue;

        // Image extraction
        $imageUrl = $customImage;
        if (empty($imageUrl) && !$customLocal) {
            if (preg_match('/<link[^>]+href=["\']([^"\']+)["\'][^>]+rel=["\']enclosure["\']/i', $itemRaw, $m)) {
                $imageUrl = trim($m[1]);
            } elseif (preg_match('/<link[^>]+rel=["\']enclosure["\'][^>]+href=["\']([^"\']+)["\']/i', $itemRaw, $m)) {
                $imageUrl = trim($m[1]);
            } elseif (preg_match('/<media:content[^>]+url=["\']([^"\']+)["\']/i', $itemRaw, $m)) {
                $imageUrl = trim($m[1]);
            } elseif (preg_match('/<enclosure[^>]+url=["\']([^"\']+)["\']/i', $itemRaw, $m)) {
                $imageUrl = trim($m[1]);
            } elseif (preg_match('/<image[^>]*>(.*?)<\/image>/is', $itemRaw, $imgTagMatch)) {
                if (preg_match('/src=["\']([^"\']+)["\']/i', $imgTagMatch[1], $srcM)) {
                    $imageUrl = trim($srcM[1]);
                }
            } elseif (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $itemRaw, $imgM)) {
                $imageUrl = trim($imgM[1]);
            }

            // Deep OpenGraph / Article Page scraping if RSS XML omits the image
            if (empty($imageUrl) && !empty($link) && NewsValidationGate::isSafeRemoteHost(parse_url($link, PHP_URL_HOST))) {
                $pageHtml = null;
                if (function_exists('curl_init')) {
                    $ch = curl_init();
                    curl_setopt_array($ch, [
                        CURLOPT_URL            => $link,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_MAXREDIRS      => 3,
                        CURLOPT_TIMEOUT        => 5,
                        CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
                        CURLOPT_SSL_VERIFYPEER => true
                    ]);
                    $pageHtml = curl_exec($ch);
                    curl_close($ch);
                }
                if ($pageHtml) {
                    if (preg_match('/<meta[^>]+property=[\x22\x27]og:image[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $pageHtml, $ogM)) {
                        $imageUrl = trim($ogM[1]);
                    } elseif (preg_match('/<meta[^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27][^>]+property=[\x22\x27]og:image[\x22\x27]/i', $pageHtml, $ogM)) {
                        $imageUrl = trim($ogM[1]);
                    } elseif (preg_match('/<meta[^>]+name=[\x22\x27]twitter:image[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $pageHtml, $twM)) {
                        $imageUrl = trim($twM[1]);
                    } elseif (preg_match('/<meta[^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27][^>]+name=[\x22\x27]twitter:image[\x22\x27]/i', $pageHtml, $twM)) {
                        $imageUrl = trim($twM[1]);
                    }
                }
            }
        }

        $cleanSummary = trim(strip_tags(html_entity_decode($descRaw, ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        $cleanSummary = preg_replace('/\s+/', ' ', $cleanSummary);
        if (mb_strlen($cleanSummary, 'UTF-8') > 240) {
            $cleanSummary = mb_substr($cleanSummary, 0, 237, 'UTF-8') . '...';
        }

        $candidate = [
            'provider'              => $providerKey,
            'external_article_id'   => $guid,
            'title'                 => $title,
            'summary'               => $cleanSummary,
            'source_name'           => $sourceName,
            'source_url'            => $link,
            'source_image_url'      => $imageUrl,
            'local_image_path'      => $customLocal,
            'image_hash'            => $customHash,
            'screenshot_hash'       => $customHash,
            'visual_type'           => $visualType,
            'provider_published_at' => $pubDateRaw,
            'category'              => $category,
            'brand_badge'           => $brandBadge,
            'wire_type'             => $wireType,
            'wire_key'              => $wireKey,
            'status'                => STATUS_FETCHED
        ];

        // Central Publication Gate Evaluation
        $gateResult = NewsValidationGate::processAndPublishCandidate($candidate, $uploadDir);
        if ($gateResult['published']) {
            $record = $gateResult['record'];
            $record['caption_tag'] = strtoupper($providerKey) . ' OFFICIAL WIRE';
            $record['caption']     = '📷 ' . $record['title'];
            $record['date']        = format_provider_relative_time($record['provider_published_at']) . ' • ' . $record['source_name'] . ' (Live RSS)';
            $record['wire_type']   = $wireType;
            $record['wire_key']    = $wireKey;

            upsert_verified_news_db($record);
            $verifiedItems[] = $record;
            break; // 1 verified item per provider
        } else {
            log_news_diagnostic([
                'provider'            => $providerKey,
                'external_article_id' => $guid,
                'status'              => STATUS_REJECTED,
                'message'             => 'Candidate rejected by gate: ' . $gateResult['error']
            ]);
        }
    }

    return $verifiedItems;
}

/**
 * Synchronize All Verified Feeds Through the Gate
 */
function sync_all_verified_feeds($forceRefresh = false) {
    global $cacheFile, $uploadDir;

    // 1. Pakistani Configs
    $pkFeedConfigs = [
        [
            'provider'    => 'dawn',
            'wire_key'    => 'dawn',
            'source_name' => 'Dawn Sci-Tech',
            'brand_badge' => '🇵🇰 DAWN TECH',
            'category'    => 'PAKISTAN TECH & SCIENCE',
            'wire_type'   => 'regional',
            'url'         => 'https://www.dawn.com/feeds/tech/'
        ],
        [
            'provider'    => 'brecorder',
            'wire_key'    => 'brecorder',
            'source_name' => 'Business Recorder',
            'brand_badge' => '🇵🇰 B-RECORDER',
            'category'    => 'PAKISTAN FINTECH & BUSINESS',
            'wire_type'   => 'regional',
            'url'         => 'https://www.brecorder.com/feeds/technology/'
        ],
        [
            'provider'    => 'propakistani',
            'wire_key'    => 'propakistani',
            'source_name' => 'ProPakistani',
            'brand_badge' => '🇵🇰 PROPAKISTANI',
            'category'    => 'PAKISTAN DIGITAL ECOSYSTEM',
            'wire_type'   => 'regional',
            'url'         => 'https://propakistani.pk/feed/'
        ],
        [
            'provider'    => 'tribune',
            'wire_key'    => 'tribune',
            'source_name' => 'The Express Tribune',
            'brand_badge' => '🇵🇰 TRIBUNE',
            'category'    => 'PAKISTAN AEROSPACE & TECH',
            'wire_type'   => 'regional',
            'url'         => 'https://tribune.com.pk/feed/technology'
        ]
    ];

    // 2. International Configs (5 Separate Providers)
    $intFeedConfigs = [
        'google' => [
            'provider'     => 'google',
            'wire_key'     => 'google',
            'source_name'  => 'Google The Keyword',
            'brand_badge'  => '🌐 GOOGLE',
            'category'     => 'GOOGLE AI & DEVICES',
            'wire_type'    => 'brand',
            'url'          => 'https://blog.google/rss/',
            'custom_local' => 'uploads/live_news/google_gemini_chrome_hero.png',
            'custom_hash'  => 'c89ee674172ee9322fde0b9faf33549966e3e8965fd9be9a94f27b6f4c81f719',
            'visual_type'  => VISUAL_SOURCE_HEADER_SCREENSHOT
        ],
        'apple' => [
            'provider'    => 'apple',
            'wire_key'    => 'apple',
            'source_name' => 'Apple Newsroom',
            'brand_badge' => '🍎 APPLE',
            'category'    => 'HARDWARE & SILICON',
            'wire_type'   => 'brand',
            'url'         => 'https://www.apple.com/newsroom/rss-feed.rss'
        ],
        'nvidia' => [
            'provider'    => 'nvidia',
            'wire_key'    => 'nvidia',
            'source_name' => 'NVIDIA Official Blog',
            'brand_badge' => '⚡ NVIDIA',
            'category'    => 'ACCELERATED COMPUTING & AI',
            'wire_type'   => 'brand',
            'url'         => 'https://blogs.nvidia.com/feed/'
        ],
        'anthropic' => [
            'provider'     => 'anthropic',
            'wire_key'     => 'anthropic',
            'source_name'  => 'Anthropic Official',
            'brand_badge'  => '🧠 ANTHROPIC',
            'category'     => 'FRONTIER AI & SAFETY',
            'wire_type'    => 'brand',
            'url'          => 'https://news.google.com/rss/search?q=when:7d+site:anthropic.com+OR+Anthropic+Claude&hl=en-US&gl=US&ceid=US:en',
            'custom_image' => 'https://www.anthropic.com/api/opengraph-illustration?name=Hand%20Quill&backgroundColor=heather'
        ],
        'openai' => [
            'provider'     => 'openai',
            'wire_key'     => 'openai',
            'source_name'  => 'OpenAI Newsroom',
            'brand_badge'  => '🤖 OPENAI',
            'category'     => 'GENERATIVE AI & REASONING',
            'wire_type'    => 'brand',
            'url'          => 'https://openai.com/news/rss.xml'
        ],
        'meta' => [
            'provider'     => 'meta',
            'wire_key'     => 'meta',
            'source_name'  => 'Meta Newsroom',
            'brand_badge'  => '♾️ META',
            'category'     => 'OPEN SOURCE AI & INFRASTRUCTURE',
            'wire_type'    => 'brand',
            'url'          => 'https://about.fb.com/news/feed/'
        ],
        'microsoft' => [
            'provider'     => 'microsoft',
            'wire_key'     => 'microsoft',
            'source_name'  => 'Microsoft News Center',
            'brand_badge'  => '🪟 MICROSOFT',
            'category'     => 'ENTERPRISE CLOUD & AI',
            'wire_type'    => 'brand',
            'url'          => 'https://news.microsoft.com/source/feed/'
        ],
        'intel' => [
            'provider'     => 'intel',
            'wire_key'     => 'intel',
            'source_name'  => 'Intel Newsroom',
            'brand_badge'  => '🔷 INTEL',
            'category'     => 'NEXT-GEN SILICON & SEMICONDUCTORS',
            'wire_type'    => 'brand',
            'url'          => 'https://newsroom.intel.com/feed/'
        ]
    ];

    // Ingest Pakistani Feeds
    $regionalWires = [];
    $regionalItems = [];
    foreach ($pkFeedConfigs as $cfg) {
        $gated = ingest_and_gate_feed($cfg, $uploadDir);
        if (!empty($gated)) {
            $art = $gated[0];
            $key = $cfg['wire_key'];
            $regionalWires[$key] = [
                'brandBadge' => $art['brand_badge'],
                'captionTag' => $art['caption_tag'],
                'category'   => $art['category'],
                'date'       => $art['date'],
                'title'      => $art['title'],
                'summary'    => $art['summary'],
                'sourceName' => $art['source_name'],
                'sourceUrl'  => $art['source_url'],
                'image'      => $art['image_url'],
                'caption'    => $art['caption']
            ];
            $regionalItems[] = $art;
        }
    }

    // Ingest International Feeds (Separately, 1 per provider)
    $brandWires = [];
    $breakingNews = [];
    $providerStatuses = [];

    foreach ($intFeedConfigs as $pKey => $pCfg) {
        $gated = ingest_and_gate_feed($pCfg, $uploadDir);
        if (!empty($gated)) {
            $art = $gated[0];
            $brandWires[$pKey] = [
                'brandBadge' => $art['brand_badge'],
                'captionTag' => strtoupper($pKey) . ' OFFICIAL WIRE',
                'cat'        => $art['category'],
                'date'       => $art['date'],
                'title'      => $art['title'],
                'summary'    => $art['summary'],
                'source'     => $art['source_name'],
                'link'       => $art['source_url'],
                'img'        => $art['image_url'],
                'caption'    => $art['caption']
            ];
            $breakingNews[] = [
                'provider'              => $pKey,
                'external_id'           => $art['external_article_id'],
                'tag'                   => $art['category'],
                'date'                  => $art['date'],
                'source'                => $art['source_name'],
                'title'                 => $art['title'],
                'desc'                  => $art['summary'],
                'link'                  => $art['source_url'],
                'img'                   => $art['image_url'],
                'provider_published_at' => $art['provider_published_at']
            ];
            $providerStatuses[$pKey] = 'VERIFIED';
        } else {
            $providerStatuses[$pKey] = 'RETAINED_PREVIOUS';
        }
    }

    usort($breakingNews, function($a, $b) {
        $ta = !empty($a['provider_published_at']) ? strtotime($a['provider_published_at']) : 0;
        $tb = !empty($b['provider_published_at']) ? strtotime($b['provider_published_at']) : 0;
        return $tb <=> $ta;
    });

    $feedData = [
        'status'            => 'success',
        'timestamp'         => gmdate('Y-m-d\TH:i:s\Z'),
        'gate_status'       => 'CENTRAL_GATE_ACTIVE',
        'provider_statuses' => $providerStatuses,
        'counts'            => [
            'pakistani_articles'     => count($regionalItems),
            'international_articles' => count($breakingNews),
            'providers'              => [
                'google'    => isset($brandWires['google']) ? 1 : 0,
                'apple'     => isset($brandWires['apple']) ? 1 : 0,
                'nvidia'    => isset($brandWires['nvidia']) ? 1 : 0,
                'anthropic' => isset($brandWires['anthropic']) ? 1 : 0,
                'openai'    => isset($brandWires['openai']) ? 1 : 0
            ]
        ],
        'brand_wires'       => $brandWires,
        'regional_wires'    => $regionalWires,
        'regional_items'    => $regionalItems,
        'breaking_news'     => $breakingNews
    ];

    NewsValidationGate::writeAtomicCache($cacheFile, $feedData);
    return $feedData;
}

// Check cache freshness (30-minute auto-refresh TTL)
$force = isset($_GET['refresh']) || isset($_GET['force']);
$cachedData = null;
$cacheMaxAge = 1800; // 30 minutes

if (file_exists($cacheFile)) {
    $mtime = @filemtime($cacheFile) ?: 0;
    $isStale = (time() - $mtime) > $cacheMaxAge;
    $raw = @file_get_contents($cacheFile);
    if ($raw) {
        $cachedData = @json_decode($raw, true);
    }
    if ($isStale) {
        $force = true;
    }
}

if (!$cachedData || $force) {
    $cachedData = sync_all_verified_feeds($force);
}

if (php_sapi_name() !== 'cli') {
    echo json_encode($cachedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
