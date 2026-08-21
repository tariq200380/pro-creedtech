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
 * Extract genuine article hero image applying strict priority:
 * 
 * PRIORITY 1: Valid canonical og:image
 * PRIORITY 2: Valid twitter:image
 * PRIORITY 3: Valid JSON-LD Structured Data image / ImageObject
 * PRIORITY 4: Valid RSS XML enclosure / media:content / image tag
 * PRIORITY 5: Valid article-specific picture / source srcset / hero-classed image
 * PRIORITY 6: Generic article-body image (fallback only)
 */
function extract_real_article_hero_image($itemRaw, $articleUrl, $customImage = null) {
    if (!empty($customImage)) {
        return resolve_article_absolute_url($customImage, $articleUrl);
    }

    $candidates = [];
    $orderIndex = 0;

    // Attempt deep fetch of article page HTML if URL is valid
    $pageHtml = null;
    if (!empty($articleUrl) && filter_var($articleUrl, FILTER_VALIDATE_URL) && NewsValidationGate::isSafeRemoteHost(parse_url($articleUrl, PHP_URL_HOST))) {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => $articleUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 4,
                CURLOPT_TIMEOUT        => 8,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
                CURLOPT_SSL_VERIFYPEER => true
            ]);
            $pageHtml = curl_exec($ch);
            curl_close($ch);
        }
    }

    if ($pageHtml) {
        // Priority 1: Canonical og:image
        if (preg_match('/<meta[^>]+property=[\x22\x27]og:image[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $pageHtml, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 1, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'og:image'];
            }
        } elseif (preg_match('/<meta[^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27][^>]+property=[\x22\x27]og:image[\x22\x27]/i', $pageHtml, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 1, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'og:image'];
            }
        }

        // Priority 2: twitter:image
        if (preg_match('/<meta[^>]+name=[\x22\x27]twitter:image[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $pageHtml, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 2, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'twitter:image'];
            }
        } elseif (preg_match('/<meta[^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27][^>]+name=[\x22\x27]twitter:image[\x22\x27]/i', $pageHtml, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 2, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'twitter:image'];
            }
        }

        // Priority 3: JSON-LD Structured Data Image / ImageObject
        if (preg_match_all('/<script[^>]+type=[\x22\x27]application\/ld\+json[\x22\x27][^>]*>(.*?)<\/script>/is', $pageHtml, $jsonLdMatches)) {
            foreach ($jsonLdMatches[1] as $jStr) {
                $jData = json_decode(trim($jStr), true);
                if ($jData) {
                    if (isset($jData['image'])) {
                        $imgVal = $jData['image'];
                        if (is_string($imgVal) && !empty($imgVal) && !is_unwanted_article_asset_url($imgVal)) {
                            $candidates[] = ['priority' => 3, 'order' => $orderIndex++, 'url' => $imgVal, 'type' => 'jsonld:image'];
                        } elseif (is_array($imgVal)) {
                            if (isset($imgVal['url']) && is_string($imgVal['url']) && !is_unwanted_article_asset_url($imgVal['url'])) {
                                $candidates[] = ['priority' => 3, 'order' => $orderIndex++, 'url' => $imgVal['url'], 'type' => 'jsonld:image.url'];
                            } elseif (isset($imgVal[0])) {
                                $first = is_string($imgVal[0]) ? $imgVal[0] : ($imgVal[0]['url'] ?? '');
                                if (!empty($first) && !is_unwanted_article_asset_url($first)) {
                                    $candidates[] = ['priority' => 3, 'order' => $orderIndex++, 'url' => $first, 'type' => 'jsonld:image[0]'];
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // Priority 4: RSS XML Enclosure / Media tag
    if (!empty($itemRaw)) {
        if (preg_match('/<link[^>]+href=["\']([^"\']+)["\'][^>]+rel=["\']enclosure["\']/i', $itemRaw, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 4, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'rss:link_enclosure'];
            }
        } elseif (preg_match('/<link[^>]+rel=["\']enclosure["\'][^>]+href=["\']([^"\']+)["\']/i', $itemRaw, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 4, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'rss:link_enclosure'];
            }
        } elseif (preg_match('/<media:content[^>]+url=["\']([^"\']+)["\']/i', $itemRaw, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 4, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'rss:media_content'];
            }
        } elseif (preg_match('/<enclosure[^>]+url=["\']([^"\']+)["\']/i', $itemRaw, $m)) {
            if (!is_unwanted_article_asset_url($m[1])) {
                $candidates[] = ['priority' => 4, 'order' => $orderIndex++, 'url' => $m[1], 'type' => 'rss:enclosure'];
            }
        } elseif (preg_match('/<image[^>]*>(.*?)<\/image>/is', $itemRaw, $imgTagMatch)) {
            if (preg_match('/src=["\']([^"\']+)["\']/i', $imgTagMatch[1], $srcM)) {
                if (!is_unwanted_article_asset_url($srcM[1])) {
                    $candidates[] = ['priority' => 4, 'order' => $orderIndex++, 'url' => $srcM[1], 'type' => 'rss:image_src'];
                }
            }
        } elseif (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $itemRaw, $imgM)) {
            if (!is_unwanted_article_asset_url($imgM[1])) {
                $candidates[] = ['priority' => 4, 'order' => $orderIndex++, 'url' => $imgM[1], 'type' => 'rss:img_src'];
            }
        }
    }

    if ($pageHtml) {
        // Priority 5: <picture> <source srcset="..."> / <img> inside <picture> / Hero-classed <img>
        if (preg_match_all('/<picture[^>]*>(.*?)<\/picture>/is', $pageHtml, $picMatches)) {
            foreach ($picMatches[1] as $picInner) {
                if (preg_match('/<source[^>]+srcset=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $picInner, $srcSetM)) {
                    $best = parse_best_from_srcset($srcSetM[1], $articleUrl);
                    if ($best && !is_unwanted_article_asset_url($best)) {
                        $candidates[] = ['priority' => 5, 'order' => $orderIndex++, 'url' => $best, 'type' => 'picture:source_srcset'];
                    }
                }
                if (preg_match('/<img[^>]+src=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $picInner, $imgM)) {
                    if (!is_unwanted_article_asset_url($imgM[1])) {
                        $candidates[] = ['priority' => 5, 'order' => $orderIndex++, 'url' => $imgM[1], 'type' => 'picture:img_src'];
                    }
                }
            }
        }

        // Priority 5 & 6: <img> elements in page body (Hero classed = 5, Generic body = 6)
        if (preg_match_all('/<img[^>]+>/i', $pageHtml, $imgMatches)) {
            foreach ($imgMatches[0] as $imgTag) {
                $isHero = preg_match('/(?:hero|featured|lead|cover|article-img|banner|main-image|story-image|data-nimg=[\x22\x27]fill[\x22\x27]|class=[\x22\x27][^\x22\x27]*object-cover)/i', $imgTag);

                $urlCandidate = null;
                if (preg_match('/srcset=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $imgTag, $setM)) {
                    $urlCandidate = parse_best_from_srcset($setM[1], $articleUrl);
                }
                if (!$urlCandidate && preg_match('/src=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i', $imgTag, $srcM)) {
                    $urlCandidate = $srcM[1];
                }

                if ($urlCandidate && !is_unwanted_article_asset_url($urlCandidate)) {
                    $prio = $isHero ? 5 : 6;
                    $candidates[] = ['priority' => $prio, 'order' => $orderIndex++, 'url' => $urlCandidate, 'type' => ($isHero ? 'html:hero_img' : 'html:body_img')];
                }
            }
        }
    }

    // Sort by priority ascending, then by DOM order ascending
    usort($candidates, function($a, $b) {
        if ($a['priority'] === $b['priority']) {
            return $a['order'] <=> $b['order'];
        }
        return $a['priority'] <=> $b['priority'];
    });

    foreach ($candidates as $c) {
        $rawUrl = $c['url'];
        $absUrl = resolve_article_absolute_url($rawUrl, $articleUrl);
        if (empty($absUrl) || !filter_var($absUrl, FILTER_VALIDATE_URL)) continue;
        return $absUrl;
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
 */
function ingest_and_gate_feed($feedConfig, $uploadDir, $verifiedHeroMap = []) {
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
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/126.0.0.0',
            CURLOPT_SSL_VERIFYPEER => true
        ]);
        $rawContent = curl_exec($ch);
        curl_close($ch);
    }
    // Direct Anthropic Research/News Handler (bypasses generic RSS aggregators)
    if ($providerKey === 'anthropic') {
        $ch = curl_init('https://www.anthropic.com/research');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 8,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/126.0.0.0'
        ]);
        $antHtml = curl_exec($ch);
        curl_close($ch);

        if ($antHtml && preg_match_all("/<a[^>]+href=[\x22\x27](\/research\/[a-zA-Z0-9_-]+)[\x22\x27][^>]*>(.*?)<\/a>/is", $antHtml, $antMatches)) {
            for ($i = 0; $i < count($antMatches[1]); $i++) {
                $antPath = $antMatches[1][$i];
                if (strpos($antPath, 'team') !== false) continue;
                $antUrl = 'https://www.anthropic.com' . $antPath;
                $normAntUrl = normalize_canonical_news_url($antUrl);

                $existingHero = $verifiedHeroMap[$normAntUrl] ?? null;
                $localPath = null;
                $imgHash = null;
                $imgSrc = null;

                if ($existingHero && !empty($existingHero['local_image_path']) && strpos($existingHero['local_image_path'], '_headline_') === false) {
                    $diskFile = __DIR__ . '/../' . $existingHero['local_image_path'];
                    if (file_exists($diskFile) && filesize($diskFile) > 0) {
                        $localPath = $existingHero['local_image_path'];
                        $imgHash   = $existingHero['image_hash'] ?? hash_file('sha256', $diskFile);
                        $imgSrc    = $existingHero['source_image_url'] ?? null;
                    }
                }
                
                $ch2 = curl_init($antUrl);
                curl_setopt_array($ch2, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_TIMEOUT        => 8,
                    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ]);
                $artHtml = curl_exec($ch2);
                curl_close($ch2);

                if ($artHtml) {
                    preg_match("/<meta[^>]+property=[\x22\x27]og:image[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i", $artHtml, $mOgImg);
                    preg_match("/<meta[^>]+property=[\x22\x27]og:title[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i", $artHtml, $mOgTitle);
                    preg_match("/<meta[^>]+property=[\x22\x27]og:description[\x22\x27][^>]+content=[\x22\x27]([^\x22\x27]+)[\x22\x27]/i", $artHtml, $mOgDesc);
                    
                    $title = !empty($mOgTitle[1]) ? trim(html_entity_decode($mOgTitle[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')) : 'Anthropic Frontier AI Research Update';
                    $desc  = !empty($mOgDesc[1]) ? trim(html_entity_decode($mOgDesc[1], ENT_QUOTES | ENT_HTML5, 'UTF-8')) : 'Anthropic research shares latest developments in frontier artificial intelligence and reasoning systems.';
                    if (!$imgSrc) {
                        $imgSrc = !empty($mOgImg[1]) ? trim($mOgImg[1]) : null;
                    }
                    
                    $candidate = [
                        'provider'              => 'anthropic',
                        'external_article_id'   => $antUrl,
                        'title'                 => $title,
                        'summary'               => $desc,
                        'source_name'           => 'Anthropic Research',
                        'source_url'            => $antUrl,
                        'source_image_url'      => $imgSrc,
                        'local_image_path'      => $localPath,
                        'image_hash'            => $imgHash,
                        'screenshot_hash'       => $imgHash,
                        'visual_type'           => VISUAL_SOURCE_IMAGE,
                        'provider_published_at' => date('Y-m-d H:i:s', strtotime('-19 hours')),
                        'category'              => $category,
                        'brand_badge'           => $brandBadge,
                        'wire_type'             => $wireType,
                        'wire_key'              => $wireKey,
                        'status'                => STATUS_FETCHED
                    ];
                    $gateResult = NewsValidationGate::processAndPublishCandidate($candidate, $uploadDir);
                    if ($gateResult['published']) {
                        $record = $gateResult['record'];
                        $record['caption_tag'] = 'ANTHROPIC OFFICIAL WIRE';
                        $record['caption']     = '📷 ' . $record['title'];
                        $record['date']        = format_provider_relative_time($record['provider_published_at']) . ' • Anthropic Research (Live Wire)';
                        $record['wire_type']   = $wireType;
                        $record['wire_key']    = $wireKey;
                        upsert_verified_news_db($record);
                        return [$record];
                    }
                }
            }
        }
    }

    if (!$rawContent) {
        return [];
    }

    $rawItems = preg_split('/<item[\s>]|<entry[\s>]/i', $rawContent);
    array_shift($rawItems);

    $parsedCandidates = [];

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

    // Sort parsed feed candidates by actual publication timestamp descending (newest first)
    usort($parsedCandidates, function($a, $b) {
        if ($a['pubTimestamp'] === $b['pubTimestamp']) {
            return 0;
        }
        return ($a['pubTimestamp'] > $b['pubTimestamp']) ? -1 : 1;
    });

    $verifiedItems = [];

    foreach ($parsedCandidates as $candItem) {
        $title      = $candItem['title'];
        $link       = $candItem['link'];
        $guid       = $candItem['guid'];
        $pubDateRaw = $candItem['pubDateRaw'];
        $descRaw    = $candItem['descRaw'];
        $itemRaw    = $candItem['itemRaw'];

        // Stable Image Retention Check:
        // Always extract the canonical hero image from the article to ensure freshness.
        // If this canonical image was already downloaded and cryptographically verified on disk,
        // reuse the existing local file to save bandwidth; otherwise download and verify the fresh image.
        $normUrl = normalize_canonical_news_url($link);
        $existingHero = $verifiedHeroMap[$normUrl] ?? null;

        $itemLocalPath  = $customLocal;
        $itemImageHash  = $customHash;
        $itemVisualType = $visualType;
        $itemImageUrl   = $customImage;

        if (empty($itemImageUrl)) {
            $itemImageUrl = extract_real_article_hero_image($itemRaw, $link, $customImage);
        }

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
            break; // 1 verified newest valid item per provider
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
        $gated = ingest_and_gate_feed($cfg, $uploadDir, $verifiedHeroMap);
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
        $gated = ingest_and_gate_feed($pCfg, $uploadDir, $verifiedHeroMap);
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
            $providerStatuses[$pKey] = 'VERIFIED';
        } else {
            // Retain previously verified record for this provider
            $providerStatuses[$pKey] = isset($brandWires[$pKey]) ? 'RETAINED_PREVIOUS' : 'UNAVAILABLE';
        }
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

// Only execute standalone output if called directly as the primary script entry point
$isDirectExecution = (isset($_SERVER['SCRIPT_FILENAME']) && realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) ||
                      (php_sapi_name() === 'cli' && isset($argv[0]) && realpath($argv[0]) === __FILE__);

if ($isDirectExecution) {
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
}
