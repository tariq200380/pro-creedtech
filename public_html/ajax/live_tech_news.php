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
    $conn = creed_db();
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
 * Resolve relative URL to absolute URL against base
 */
function resolve_article_absolute_url($relativeUrl, $baseUrl) {
    if (empty($relativeUrl)) return '';
    $relativeUrl = trim(html_entity_decode($relativeUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    
    // Protocol-relative URL
    if (str_starts_with($relativeUrl, '//')) {
        return 'https:' . $relativeUrl;
    }
    
    // Already absolute HTTP/HTTPS URL
    if (preg_match('#^https?://#i', $relativeUrl)) {
        return $relativeUrl;
    }
    
    $parsedBase = parse_url($baseUrl);
    $scheme = $parsedBase['scheme'] ?? 'https';
    $host = $parsedBase['host'] ?? '';
    
    if (str_starts_with($relativeUrl, '/')) {
        return $scheme . '://' . $host . $relativeUrl;
    }
    
    $basePath = $parsedBase['path'] ?? '/';
    $dir = rtrim(dirname($basePath), '/');
    return $scheme . '://' . $host . $dir . '/' . $relativeUrl;
}

/**
 * Parse best high-resolution image candidate from srcset attribute
 */
function parse_best_from_srcset($srcsetStr, $baseUrl) {
    if (empty($srcsetStr)) return null;
    $parts = explode(',', $srcsetStr);
    $bestUrl = null;
    $bestWidth = 0;

    foreach ($parts as $part) {
        $part = trim($part);
        if (empty($part)) continue;
        $tokens = preg_split('/\s+/', $part);
        $u = $tokens[0] ?? '';
        $wStr = $tokens[1] ?? '';
        
        $width = 0;
        if (preg_match('/(\d+)w/i', $wStr, $wm)) {
            $width = (int)$wm[1];
        } elseif (preg_match('/(\d+)x/i', $wStr, $xm)) {
            $width = (int)$xm[1] * 800;
        }

        // We prefer high-resolution assets (between 1080w and 2560w)
        if ($width > 0) {
            if ($width >= 1080 && $width <= 2560 && $width > $bestWidth) {
                $bestWidth = $width;
                $bestUrl = $u;
            } elseif ($bestWidth === 0 && $width >= $bestWidth) {
                $bestWidth = $width;
                $bestUrl = $u;
            }
        } elseif (empty($bestUrl)) {
            $bestUrl = $u;
        }
    }

    return $bestUrl ? resolve_article_absolute_url($bestUrl, $baseUrl) : null;
}

/**
 * Filter out tracking pixels, icons, favicons, logos, and social composite cards
 */
function is_unwanted_article_asset_url($url) {
    if (empty($url)) return true;
    if (preg_match('/(\/logos\/|tribune-logo|site[-_]logo|header[-_]logo|nav[-_]logo|navbar[-_]logo|footer[-_]logo|social[-_]icon|share[-_]icon|\b(favicon|avatar|tracking|spinner|loader|placeholder|sprite|whatsapp|pixel)\b)/i', $url)) return true;
    if (preg_match('/(uhf\.microsoft\.com|RE1Mu3b|\/images\/microsoft\/|microsoft[-_]logo)/i', $url)) return true;
    if (preg_match('/[\/\._-]1x1\.(gif|png|jpg|webp)/i', $url)) return true;
    if (preg_match('/-seo-16x9-/i', $url)) return true; // Exclude social composite cards with white borders
    return false;
}

/**
 * Extract image candidate from RSS XML item (Step A)
 */
function extract_feed_item_image($itemRaw, $articleUrl) {
    if (empty($itemRaw)) return null;

    $candidates = [];

    // 1. <enclosure url="...">
    if (preg_match('/<enclosure[^>]+url=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $itemRaw, $m)) {
        $candidates[] = $m[1];
    }
    // 2. <link rel="enclosure" href="...">
    if (preg_match('/<link[^>]+(?:rel=[\x22\x27]enclosure[\x22\x27][^>]+href=[\x22\x27]([^\x22\x27]+)[\x22\x27]|href=[\x22\x27]([^\x22\x27]+)[\x22\x27][^>]+rel=[\x22\x27]enclosure[\x22\x27])/i', $itemRaw, $m)) {
        $candidates[] = !empty($m[1]) ? $m[1] : $m[2];
    }
    // 3. <media:content url="..."> or <media:thumbnail url="...">
    if (preg_match('/<media:(?:content|thumbnail)[^>]+url=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $itemRaw, $m)) {
        $candidates[] = $m[1];
    }
    // 4. <image><url>...</url></image> or <image src="...">
    if (preg_match('/<image[^>]*>(?:<url>([^<]+)<\/url>|[^<]*src=[\x22\x27]([^\x22\x27]+)[\x22\x27])/is', $itemRaw, $m)) {
        $candidates[] = !empty($m[1]) ? trim($m[1]) : trim($m[2]);
    }
    // 5. <img src="..."> in item description / content
    if (preg_match('/<img[^>]+src=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $itemRaw, $m)) {
        $candidates[] = $m[1];
    }

    foreach ($candidates as $cand) {
        $cand = trim(html_entity_decode($cand, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $abs = resolve_article_absolute_url($cand, $articleUrl);
        if (!empty($abs) && filter_var($abs, FILTER_VALIDATE_URL) && !is_unwanted_article_asset_url($abs)) {
            return $abs;
        }
    }

    return null;
}

/**
 * Extract image candidate from article page metadata (Step B fallback)
 * Priority: 1. og:image:secure_url -> 2. og:image -> 3. twitter:image -> 4. twitter:image:src
 */
function extract_article_page_meta_image($articleUrl) {
    if (empty($articleUrl) || !filter_var($articleUrl, FILTER_VALIDATE_URL)) {
        return null;
    }

    $host = parse_url($articleUrl, PHP_URL_HOST);
    if (empty($host) || !NewsValidationGate::isSafeRemoteHost($host)) {
        return null;
    }

    $pageHtml = null;
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $articleUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 4,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            CURLOPT_HTTPHEADER     => [
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.9'
            ],
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        ]);
        $pageHtml = curl_exec($ch);
        curl_close($ch);
    }

    if (empty($pageHtml)) {
        return null;
    }

    $metaCandidates = [];

    // Helper regex to match a meta tag with specific property/name
    $matchMeta = function($propName, $html) {
        if (preg_match('/<meta[^>]+(?:property|name)=[\x22\x27]' . preg_quote($propName, '/') . '[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $html, $m)) {
            return $m[1];
        }
        if (preg_match('/<meta[^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27][^>]+(?:property|name)=[\x22\x27]' . preg_quote($propName, '/') . '[\x22\x27]/i', $html, $m)) {
            return $m[1];
        }
        return null;
    };

    // Priority 1: og:image:secure_url
    $ogSec = $matchMeta('og:image:secure_url', $pageHtml);
    if ($ogSec) $metaCandidates[] = ['url' => $ogSec, 'type' => 'og:image:secure_url'];

    // Priority 2: og:image
    $ogImg = $matchMeta('og:image', $pageHtml);
    if ($ogImg) $metaCandidates[] = ['url' => $ogImg, 'type' => 'og:image'];

    // Priority 3: twitter:image
    $twImg = $matchMeta('twitter:image', $pageHtml);
    if ($twImg) $metaCandidates[] = ['url' => $twImg, 'type' => 'twitter:image'];

    // Priority 4: twitter:image:src
    $twSrc = $matchMeta('twitter:image:src', $pageHtml);
    if ($twSrc) $metaCandidates[] = ['url' => $twSrc, 'type' => 'twitter:image:src'];

    foreach ($metaCandidates as $cand) {
        $rawUrl = trim(html_entity_decode($cand['url'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        $absUrl = resolve_article_absolute_url($rawUrl, $articleUrl);
        if (!empty($absUrl) && filter_var($absUrl, FILTER_VALIDATE_URL) && !is_unwanted_article_asset_url($absUrl)) {
            return $absUrl;
        }
    }

    return null;
}

/**
 * Normalize canonical source URL for consistent identity across refreshes
 */
function normalize_canonical_news_url($url) {
    if (empty($url)) return '';
    $u = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $parts = parse_url($u);
    if (!$parts || empty($parts['host'])) return rtrim($u, '/');
    $scheme = strtolower($parts['scheme'] ?? 'https');
    $host   = strtolower($parts['host']);
    $path   = rtrim($parts['path'] ?? '', '/');
    $query  = !empty($parts['query']) ? '?' . $parts['query'] : '';
    return $scheme . '://' . $host . $path . $query;
}

/**
 * Ingest feed with strict Central NewsValidationGate verification & stable image retention
/**
 * Scrape dynamic Anthropic research and news articles from official pages
 */
function collect_anthropic_candidates() {
    $pages = ['https://www.anthropic.com/research', 'https://www.anthropic.com/news'];
    $candidates = [];
    $seen = [];

    foreach ($pages as $pUrl) {
        $ch = curl_init($pUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
        ]);
        $html = curl_exec($ch);
        curl_close($ch);

        if (!$html) continue;

        if (preg_match_all("/<a[^>]+href=[\x22\x27](\/(?:research|news)\/[a-zA-Z0-9_-]+)[\x22\x27][^>]*>/i", $html, $m)) {
            foreach ($m[1] as $path) {
                if (isset($seen[$path]) || $path === '/research' || $path === '/news' || strpos($path, 'team') !== false) continue;
                $seen[$path] = true;
                $fullUrl = 'https://www.anthropic.com' . $path;

                $ch2 = curl_init($fullUrl);
                curl_setopt_array($ch2, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT        => 6,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ]);
                $artHtml = curl_exec($ch2);
                curl_close($ch2);

                if (!$artHtml) continue;

                preg_match("/<meta[^>]+property=[\x22\x27]og:image[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i", $artHtml, $mOgImg);
                preg_match("/<meta[^>]+property=[\x22\x27]og:title[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i", $artHtml, $mOgTitle);
                preg_match("/<meta[^>]+property=[\x22\x27]og:description[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i", $artHtml, $mOgDesc);
                preg_match("/(?:datetime=[\x22\x27]([^\x22\x27]+)[\x22\x27]|>([A-Za-z]+ \d{1,2}, \d{4})<)/i", $artHtml, $mDate);

                $title   = !empty($mOgTitle[1]) ? trim(html_entity_decode($mOgTitle[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')) : '';
                $desc    = !empty($mOgDesc[1]) ? trim(html_entity_decode($mOgDesc[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')) : '';
                $img     = !empty($mOgImg[1]) ? trim(html_entity_decode($mOgImg[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')) : '';
                $dateRaw = !empty($mDate[1]) ? $mDate[1] : (!empty($mDate[2]) ? $mDate[2] : '');
                $timestamp = NewsValidationGate::parseProviderDate($dateRaw);

                if (!empty($title) && $timestamp) {
                    $candidates[] = [
                        'title'        => $title,
                        'link'         => $fullUrl,
                        'guid'         => $fullUrl,
                        'pubDateRaw'   => $dateRaw,
                        'pubTimestamp' => $timestamp,
                        'descRaw'      => $desc,
                        'itemRaw'      => $artHtml,
                        'ogImg'        => $img
                    ];
                }
                if (count($candidates) >= 12) break 2;
            }
        }
    }
    return $candidates;
}

/**
 * Gate and Ingest Feed: Ingests, parses, sorts candidates newest-first,
 * validates visual assets, and prevents downgrades.
 */
function ingest_and_gate_feed($feedConfig, $uploadDir, $verifiedHeroMap = [], $existingArticle = null) {
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

    $parsedCandidates = [];
    $fetchSuccess = false;

    if ($providerKey === 'anthropic') {
        $parsedCandidates = collect_anthropic_candidates();
        $fetchSuccess = !empty($parsedCandidates);
    } else {
        $rawContent = null;
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/126.0.0.0',
                CURLOPT_SSL_VERIFYPEER => true
            ]);
            $rawContent = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($httpCode === 200 && !empty($rawContent)) {
                $fetchSuccess = true;
            }
        }

        if ($rawContent) {
            $rawItems = preg_split('/<item[\s>]|<entry[\s>]/i', $rawContent);
            array_shift($rawItems);

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

                $pubTimestamp = NewsValidationGate::parseProviderDate($pubDateRaw);

                $parsedCandidates[] = [
                    'title'        => $title,
                    'link'         => $link,
                    'guid'         => $guid,
                    'pubDateRaw'   => $pubDateRaw,
                    'pubTimestamp' => $pubTimestamp ?: 0,
                    'descRaw'      => $descRaw,
                    'itemRaw'      => $itemRaw
                ];
            }
        }
    }

    // Sort parsed feed candidates strictly by publication timestamp descending (newest first)
    usort($parsedCandidates, function($a, $b) {
        return ($b['pubTimestamp'] <=> $a['pubTimestamp']);
    });

    $sourceNewestTimestamp = !empty($parsedCandidates[0]['pubTimestamp']) ? gmdate('Y-m-d\TH:i:s\Z', $parsedCandidates[0]['pubTimestamp']) : null;
    $sourceNewestTitle = !empty($parsedCandidates[0]['title']) ? $parsedCandidates[0]['title'] : null;

    $existingTimestamp = 0;
    if (!empty($existingArticle['provider_published_at'])) {
        $existingTimestamp = NewsValidationGate::parseProviderDate($existingArticle['provider_published_at']) ?: 0;
    } elseif (!empty($existingArticle['date'])) {
        $existingTimestamp = NewsValidationGate::parseProviderDate($existingArticle['date']) ?: 0;
    }

    $verifiedItems = [];
    $lastRejectionReason = '';
    $selectedStatus = 'STALE_FALLBACK';
    $selectedTimestamp = null;

    foreach ($parsedCandidates as $candItem) {
        $title      = $candItem['title'];
        $link       = $candItem['link'];
        $guid       = $candItem['guid'];
        $pubDateRaw = $candItem['pubDateRaw'];
        $pubTimestamp = $candItem['pubTimestamp'];
        $descRaw    = $candItem['descRaw'];
        $itemRaw    = $candItem['itemRaw'];

        // Guard against downgrading a newer cached article with an older article
        if ($existingTimestamp > 0 && $pubTimestamp > 0 && $pubTimestamp < ($existingTimestamp - 3600)) {
            $lastRejectionReason = "Candidate published at " . gmdate('Y-m-d H:i:s', $pubTimestamp) . " is older than cached article at " . gmdate('Y-m-d H:i:s', $existingTimestamp);
            continue;
        }

        $normUrl = normalize_canonical_news_url($link);
        $existingHero = $verifiedHeroMap[$normUrl] ?? null;

        $itemLocalPath  = $customLocal;
        $itemImageHash  = $customHash;
        $itemVisualType = $visualType;
        $itemImageUrl   = $customImage ?: ($candItem['ogImg'] ?? null);

        // STEP A: Extract candidate image from the feed item first
        if (empty($itemImageUrl)) {
            $feedImgCandidate = extract_feed_item_image($itemRaw, $link);
            if (!empty($feedImgCandidate)) {
                $itemImageUrl = $feedImgCandidate;
            }
        }

        // Check if existing verified hero on disk matches this article and image URL
        if (!empty($itemImageUrl) && $existingHero && !empty($existingHero['local_image_path']) && strpos($existingHero['local_image_path'], '_headline_') === false) {
            if (!empty($existingHero['source_image_url']) && $existingHero['source_image_url'] === $itemImageUrl) {
                $diskFile = __DIR__ . '/../' . $existingHero['local_image_path'];
                if (file_exists($diskFile) && filesize($diskFile) > 0) {
                    $itemLocalPath  = $existingHero['local_image_path'];
                    $itemImageHash  = $existingHero['image_hash'] ?? hash_file('sha256', $diskFile);
                    $itemVisualType = VISUAL_SOURCE_IMAGE;
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
            'source_image_url'      => $itemImageUrl,
            'local_image_path'      => $itemLocalPath,
            'image_hash'            => $itemImageHash,
            'screenshot_hash'       => $itemImageHash,
            'visual_type'           => $itemVisualType,
            'provider_published_at' => $pubDateRaw,
            'category'              => $category,
            'brand_badge'           => $brandBadge,
            'wire_type'             => $wireType,
            'wire_key'              => $wireKey,
            'status'                => STATUS_FETCHED
        ];

        // Central Publication Gate Evaluation for Step A
        $gateResult = NewsValidationGate::processAndPublishCandidate($candidate, $uploadDir);

        // STEP B: If Step A failed (no feed image or download/validation failed), try Article Page OG Image Fallback
        if (!$gateResult['published'] && empty($customImage)) {
            $ogImgCandidate = extract_article_page_meta_image($link);
            if (!empty($ogImgCandidate) && $ogImgCandidate !== $itemImageUrl) {
                $candidate['source_image_url'] = $ogImgCandidate;
                $candidate['local_image_path'] = null;
                $candidate['image_hash']       = null;

                // Re-check if this OG image matches existing disk cache for this article
                if ($existingHero && !empty($existingHero['local_image_path']) && !empty($existingHero['source_image_url']) && $existingHero['source_image_url'] === $ogImgCandidate) {
                    $diskFile = __DIR__ . '/../' . $existingHero['local_image_path'];
                    if (file_exists($diskFile) && filesize($diskFile) > 0) {
                        $candidate['local_image_path'] = $existingHero['local_image_path'];
                        $candidate['image_hash']       = $existingHero['image_hash'] ?? hash_file('sha256', $diskFile);
                    }
                }

                $gateResult = NewsValidationGate::processAndPublishCandidate($candidate, $uploadDir);
            }
        }

        // STEP C: If published, save and finish provider. If rejected, record reason and try next candidate.
        if ($gateResult['published']) {
            $record = $gateResult['record'];
            $record['caption_tag'] = strtoupper($providerKey) . ' OFFICIAL WIRE';
            $record['caption']     = '📷 ' . $record['title'];
            $record['date']        = format_provider_relative_time($record['provider_published_at']) . ' • ' . $record['source_name'] . ($providerKey === 'anthropic' ? ' (Live Wire)' : ' (Live RSS)');
            $record['wire_type']   = $wireType;
            $record['wire_key']    = $wireKey;

            upsert_verified_news_db($record);
            $verifiedItems[] = $record;
            $selectedTimestamp = gmdate('Y-m-d\TH:i:s\Z', $pubTimestamp);

            if (!empty($existingArticle) && ($existingArticle['title'] === $record['title'] || ($existingArticle['link'] ?? '') === $record['source_url'])) {
                $selectedStatus = 'NO_NEW_ARTICLE';
            } else {
                $selectedStatus = 'FRESH';
            }
            break; // 1 verified newest valid item per provider
        } else {
            $lastRejectionReason = $gateResult['error'] ?? 'Image validation failed';
            log_news_diagnostic([
                'provider'            => $providerKey,
                'external_article_id' => $guid,
                'source_image_url'    => $candidate['source_image_url'] ?? '',
                'status'              => STATUS_REJECTED,
                'message'             => 'Candidate rejected by gate: ' . $lastRejectionReason
            ]);
        }
    }

    if (empty($verifiedItems)) {
        if (!empty($existingArticle)) {
            $selectedStatus = !$fetchSuccess ? 'SOURCE_FETCH_FAILED' : 'NEW_ARTICLES_REJECTED';
            $cachedTitle = $existingArticle['title'] ?? 'Unknown';
            $cachedDate  = $existingArticle['date'] ?? 'Unknown';
            error_log("PROVIDER_STALE_FALLBACK provider={$providerKey} cached_title={$cachedTitle} cached_date={$cachedDate} reason=" . ($lastRejectionReason ?: (!$fetchSuccess ? 'Source fetch failed' : 'All candidates rejected')));
        } else {
            $selectedStatus = 'UNAVAILABLE';
        }
    }

    return [
        'items' => $verifiedItems,
        'diag'  => [
            'status'                          => $selectedStatus,
            'source_newest_timestamp'         => $sourceNewestTimestamp,
            'source_newest_title'             => $sourceNewestTitle,
            'selected_timestamp'              => $selectedTimestamp,
            'cached_timestamp'                => !empty($existingTimestamp) ? gmdate('Y-m-d\TH:i:s\Z', $existingTimestamp) : null,
            'last_successful_provider_fetch'  => $fetchSuccess ? gmdate('Y-m-d\TH:i:s\Z') : null,
            'last_successful_provider_update' => !empty($verifiedItems) ? gmdate('Y-m-d\TH:i:s\Z') : null,
            'reason'                          => $lastRejectionReason ?: null
        ]
    ];
}

/**
 * Synchronize All Verified Feeds Through the Gate
 */
function sync_all_verified_feeds($forceRefresh = false) {
    global $cacheFile, $uploadDir;

    // Load existing canonical cache if available to preserve verified items
    $existingCache = [];
    if (file_exists($cacheFile)) {
        $rawExisting = @file_get_contents($cacheFile);
        if ($rawExisting) {
            $parsed = @json_decode($rawExisting, true);
            if (is_array($parsed)) {
                $existingCache = $parsed;
            }
        }
    }

    $existingBrandWires    = (isset($existingCache['brand_wires']) && is_array($existingCache['brand_wires'])) ? $existingCache['brand_wires'] : [];
    $existingRegionalWires = (isset($existingCache['regional_wires']) && is_array($existingCache['regional_wires'])) ? $existingCache['regional_wires'] : [];
    $existingRegionalItems = (isset($existingCache['regional_items']) && is_array($existingCache['regional_items'])) ? $existingCache['regional_items'] : [];
    $existingBreakingNews  = (isset($existingCache['breaking_news']) && is_array($existingCache['breaking_news'])) ? $existingCache['breaking_news'] : [];

    // Build verified hero map from existing cache
    $verifiedHeroMap = [];
    foreach ($existingBrandWires as $p => $bw) {
        $u = $bw['link'] ?? '';
        $img = $bw['img'] ?? '';
        $srcImg = $bw['source_image_url'] ?? null;
        if (!empty($u) && !empty($img) && strpos($img, '_headline_') === false) {
            $full = __DIR__ . '/../' . $img;
            if (file_exists($full) && filesize($full) > 0) {
                $norm = normalize_canonical_news_url($u);
                $verifiedHeroMap[$norm] = [
                    'provider'         => $p,
                    'local_image_path' => $img,
                    'image_hash'       => hash_file('sha256', $full),
                    'source_image_url' => $srcImg,
                    'visual_type'      => VISUAL_SOURCE_IMAGE
                ];
            }
        }
    }
    foreach ($existingRegionalWires as $p => $rw) {
        $u = $rw['sourceUrl'] ?? '';
        $img = $rw['image'] ?? '';
        $srcImg = $rw['source_image_url'] ?? null;
        if (!empty($u) && !empty($img) && strpos($img, '_headline_') === false) {
            $full = __DIR__ . '/../' . $img;
            if (file_exists($full) && filesize($full) > 0) {
                $norm = normalize_canonical_news_url($u);
                $verifiedHeroMap[$norm] = [
                    'provider'         => $p,
                    'local_image_path' => $img,
                    'image_hash'       => hash_file('sha256', $full),
                    'source_image_url' => $srcImg,
                    'visual_type'      => VISUAL_SOURCE_IMAGE
                ];
            }
        }
    }
    foreach ($existingBreakingNews as $bn) {
        $u = $bn['link'] ?? '';
        $img = $bn['img'] ?? '';
        $srcImg = $bn['source_image_url'] ?? null;
        if (!empty($u) && !empty($img) && strpos($img, '_headline_') === false) {
            $full = __DIR__ . '/../' . $img;
            if (file_exists($full) && filesize($full) > 0) {
                $norm = normalize_canonical_news_url($u);
                if (!isset($verifiedHeroMap[$norm])) {
                    $verifiedHeroMap[$norm] = [
                        'provider'         => $bn['provider'] ?? '',
                        'local_image_path' => $img,
                        'image_hash'       => hash_file('sha256', $full),
                        'source_image_url' => $srcImg,
                        'visual_type'      => VISUAL_SOURCE_IMAGE
                    ];
                }
            }
        }
    }

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
            'url'         => 'https://www.brecorder.com/feeds/latest-news'
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

    // 2. International Configs (8 Separate Providers)
    $intFeedConfigs = [
        'google' => [
            'provider'     => 'google',
            'wire_key'     => 'google',
            'source_name'  => 'Google The Keyword',
            'brand_badge'  => '🌐 GOOGLE',
            'category'     => 'GOOGLE AI & DEVICES',
            'wire_type'    => 'brand',
            'url'          => 'https://blog.google/rss/'
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
            'source_name'  => 'Anthropic Research',
            'brand_badge'  => '🧠 ANTHROPIC',
            'category'     => 'FRONTIER AI & SCIENCE',
            'wire_type'    => 'brand',
            'url'          => 'https://news.google.com/rss/search?q=when:7d+site:anthropic.com+OR+Anthropic+Claude&hl=en-US&gl=US&ceid=US:en'
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
    $regionalWires = $existingRegionalWires;
    $regionalItemsMap = [];
    foreach ($existingRegionalItems as $item) {
        $k = ($item['provider'] ?? ($item['wire_key'] ?? 'pk'));
        $regionalItemsMap[$k] = $item;
    }

    foreach ($pkFeedConfigs as $cfg) {
        $key = $cfg['wire_key'];
        $existingReg = $regionalWires[$key] ?? null;
        $feedResult = ingest_and_gate_feed($cfg, $uploadDir, $verifiedHeroMap, $existingReg);
        $gated = $feedResult['items'] ?? [];
        if (!empty($gated)) {
            $art = $gated[0];
            $regionalWires[$key] = [
                'brandBadge'       => $art['brand_badge'],
                'captionTag'       => $art['caption_tag'],
                'category'         => $art['category'],
                'date'             => $art['date'],
                'title'            => $art['title'],
                'summary'          => $art['summary'],
                'sourceName'       => $art['source_name'],
                'sourceUrl'        => $art['source_url'],
                'source_image_url' => $art['source_image_url'] ?? null,
                'image'            => $art['image_url'],
                'caption'          => $art['caption']
            ];
            $regionalItemsMap[$key] = $art;
        }
    }
    $regionalItems = array_values($regionalItemsMap);

    // Ingest International Feeds (Separately, 1 per provider)
    $brandWires = $existingBrandWires;
    $breakingNewsMap = [];
    foreach ($existingBreakingNews as $bn) {
        $p = $bn['provider'] ?? '';
        if (!empty($p)) {
            $breakingNewsMap[$p] = $bn;
        }
    }
    $providerStatuses = [];

    foreach ($intFeedConfigs as $pKey => $pCfg) {
        $existingBrand = $brandWires[$pKey] ?? null;
        $feedResult = ingest_and_gate_feed($pCfg, $uploadDir, $verifiedHeroMap, $existingBrand);
        $gated = $feedResult['items'] ?? [];
        $diag = $feedResult['diag'] ?? [];

        if (!empty($gated)) {
            $art = $gated[0];
            $brandWires[$pKey] = [
                'brandBadge'       => $art['brand_badge'],
                'captionTag'       => strtoupper($pKey) . ' OFFICIAL WIRE',
                'cat'              => $art['category'],
                'date'             => $art['date'],
                'title'            => $art['title'],
                'summary'          => $art['summary'],
                'source'           => $art['source_name'],
                'link'             => $art['source_url'],
                'source_image_url' => $art['source_image_url'] ?? null,
                'img'              => $art['image_url'],
                'caption'          => $art['caption']
            ];
            $breakingNewsMap[$pKey] = [
                'provider'              => $pKey,
                'external_id'           => $art['external_article_id'],
                'tag'                   => $art['category'],
                'date'                  => $art['date'],
                'source'                => $art['source_name'],
                'title'                 => $art['title'],
                'desc'                  => $art['summary'],
                'link'                  => $art['source_url'],
                'source_image_url'      => $art['source_image_url'] ?? null,
                'img'                   => $art['image_url'],
                'provider_published_at' => $art['provider_published_at']
            ];
        }
        $providerStatuses[$pKey] = $diag;
    }

    $breakingNews = array_values($breakingNewsMap);

    usort($breakingNews, function($a, $b) {
        $ta = !empty($a['provider_published_at']) ? strtotime($a['provider_published_at']) : 0;
        $tb = !empty($b['provider_published_at']) ? strtotime($b['provider_published_at']) : 0;
        return $tb <=> $ta;
    });

    // Guard against total destructive overwrite: if everything is empty and existing cache had items, keep existing
    if (empty($brandWires) && empty($regionalWires) && empty($breakingNews) && !empty($existingCache)) {
        return $existingCache;
    }

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
                'openai'    => isset($brandWires['openai']) ? 1 : 0,
                'meta'      => isset($brandWires['meta']) ? 1 : 0,
                'microsoft' => isset($brandWires['microsoft']) ? 1 : 0,
                'intel'     => isset($brandWires['intel']) ? 1 : 0
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

// Only execute standalone output if called directly as the primary script entry point or AJAX endpoint
$isDirectExecution = (isset($_SERVER['REQUEST_URI']) && str_contains(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', 'live_tech_news.php')) ||
                      (isset($_SERVER['SCRIPT_FILENAME']) && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) ||
                      (php_sapi_name() === 'cli' && isset($argv[0]) && realpath($argv[0]) === __FILE__);

if ($isDirectExecution) {
    // Pure Cache-Only Delivery: Never trigger synchronous multi-provider sync during frontend requests
    $cachedData = null;

    if (file_exists($cacheFile) && is_readable($cacheFile)) {
        $raw = @file_get_contents($cacheFile);
        if ($raw) {
            $decoded = @json_decode($raw, true);
            if (is_array($decoded) && (!empty($decoded['brand_wires']) || !empty($decoded['regional_wires']) || !empty($decoded['breaking_news']))) {
                $cachedData = $decoded;
            }
        }
    }

    // Safe compatible empty fallback if cache is missing, empty, or unparseable
    if (!$cachedData) {
        $cachedData = [
            'status'            => 'empty',
            'timestamp'         => gmdate('Y-m-d\TH:i:s\Z'),
            'gate_status'       => 'CENTRAL_GATE_IDLE',
            'provider_statuses' => [],
            'counts'            => [
                'pakistani_articles'     => 0,
                'international_articles' => 0,
                'providers'              => [
                    'google'    => 0,
                    'apple'     => 0,
                    'nvidia'    => 0,
                    'anthropic' => 0,
                    'openai'    => 0,
                    'meta'      => 0,
                    'microsoft' => 0,
                    'intel'     => 0
                ]
            ],
            'brand_wires'       => [],
            'regional_wires'    => [],
            'regional_items'    => [],
            'breaking_news'     => []
        ];
    }

    if (php_sapi_name() !== 'cli') {
        header('Content-Type: application/json; charset=utf-8');
    }
    echo json_encode($cachedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
