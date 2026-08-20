<?php
/**
 * Creed Tech - Administrative Knowledge Center News Editorial Drafts Service
 * Provides isolated draft creation, editing, previewing, publishing, and deletion
 * without modifying original read-only Live News records.
 */

if (!headers_sent()) {
    header('Content-Type: application/json; charset=utf-8');
}

require_once __DIR__ . '/../includes/auth_guard.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/security_helpers.php';
require_once __DIR__ . '/../includes/audit_logger.php';

$draftsStoreFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'knowledge_drafts.json';
$liveNewsCacheFile = __DIR__ . '/../data/live_news_cache.json';
$publicArticlesFile = __DIR__ . '/../data/articles.json';

function get_all_local_drafts() {
    global $draftsStoreFile;
    if (!file_exists($draftsStoreFile)) return [];
    $data = @json_decode(@file_get_contents($draftsStoreFile), true);
    return is_array($data) ? $data : [];
}

function save_all_local_drafts(array $drafts) {
    global $draftsStoreFile;
    $dir = dirname($draftsStoreFile);
    if (!is_dir($dir)) {
        @mkdir($dir, 0750, true);
    }
    $tmp = $draftsStoreFile . '.' . bin2hex(random_bytes(6)) . '.tmp';
    @file_put_contents($tmp, json_encode($drafts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
    @rename($tmp, $draftsStoreFile);
}

function sync_published_articles_cache() {
    global $publicArticlesFile;
    $drafts = get_all_local_drafts();
    $articles = [];
    if (file_exists($publicArticlesFile)) {
        $articles = @json_decode(@file_get_contents($publicArticlesFile), true) ?: [];
    }

    // Filter out previous news_editorial drafts from public articles
    $filtered = array_filter($articles, function($a) {
        return empty($a['article_origin']) || $a['article_origin'] !== 'news_editorial';
    });

    // Add all currently PUBLISHED news editorial drafts
    foreach ($drafts as $d) {
        if (($d['status'] ?? 'DRAFT') === 'PUBLISHED') {
            $coverImg = '';
            if (($d['cover_image_type'] ?? '') === 'verified_source_image') {
                $coverImg = $d['source_image_url'] ?? '';
            } elseif (($d['cover_image_type'] ?? '') === 'editorial_upload') {
                $coverImg = $d['cover_image_path'] ?? '';
            }

            $filtered[] = [
                'id'                      => (int)$d['id'],
                'slug'                    => $d['slug'] ?? ('news-editorial-' . $d['id']),
                'title'                   => $d['custom_title'] ?: $d['source_title'],
                'category'                => $d['category'] ?? 'ENTERPRISE TECH & AI INTELLIGENCE',
                'date'                    => date('M d, Y', strtotime($d['published_at'] ?? 'now')),
                'read_time'               => $d['read_time'] ?? '6 min read',
                'views'                   => $d['views'] ?? '1,200',
                'shares'                  => '150',
                'rating'                  => '4.8',
                'author'                  => $d['author'] ?? 'Creed Tech Editorial Team',
                'editors_note'            => $d['custom_excerpt'] ?? '',
                'article_origin'          => 'news_editorial',
                'source_provider'         => $d['source_provider'] ?? '',
                'source_external_article_id'=> $d['source_external_article_id'] ?? '',
                'source_url'              => $d['source_url'] ?? '',
                'source_title'            => $d['source_title'] ?? '',
                'source_published_at'     => $d['source_published_at'] ?? '',
                'source_image_url'        => $d['source_image_url'] ?? '',
                'cover_image'             => $coverImg,
                'intro_paragraphs'        => array_filter(explode("\n\n", str_replace("\r\n", "\n", $d['custom_body'] ?? ''))),
                'custom_body_html'        => clean_rich_text($d['custom_body'] ?? ''),
                'tags'                    => $d['tags'] ?? []
            ];
        }
    }

    $tmp = $publicArticlesFile . '.' . bin2hex(random_bytes(6)) . '.tmp';
    @file_put_contents($tmp, json_encode(array_values($filtered), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), LOCK_EX);
    @rename($tmp, $publicArticlesFile);
}

function get_all_canonical_news_items() {
    global $liveNewsCacheFile;
    if (!file_exists($liveNewsCacheFile)) return [];
    $raw = @json_decode(@file_get_contents($liveNewsCacheFile), true);
    if (!is_array($raw)) return [];

    $items = [];
    $seen = [];

    // 1. Check breaking_news array
    if (!empty($raw['breaking_news']) && is_array($raw['breaking_news'])) {
        foreach ($raw['breaking_news'] as $item) {
            $key = strtolower($item['provider'] ?? '') . '|' . ($item['external_id'] ?? $item['link'] ?? '');
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $items[] = [
                    'provider'              => $item['provider'] ?? 'wire',
                    'external_id'           => $item['external_id'] ?? $item['link'] ?? '',
                    'tag'                   => $item['tag'] ?? 'TECH WIRE',
                    'date'                  => $item['date'] ?? '',
                    'source'                => $item['source'] ?? $item['provider'] ?? 'Official Feed',
                    'title'                 => $item['title'] ?? '',
                    'desc'                  => $item['desc'] ?? $item['summary'] ?? '',
                    'link'                  => $item['link'] ?? '',
                    'img'                   => $item['img'] ?? $item['image'] ?? '',
                    'provider_published_at' => $item['provider_published_at'] ?? ''
                ];
            }
        }
    }

    // 2. Check brand_wires map (Google, Apple, Nvidia, Anthropic, OpenAI)
    if (!empty($raw['brand_wires']) && is_array($raw['brand_wires'])) {
        foreach ($raw['brand_wires'] as $provKey => $item) {
            $key = strtolower($provKey) . '|' . ($item['link'] ?? '');
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $items[] = [
                    'provider'              => $provKey,
                    'external_id'           => $item['link'] ?? '',
                    'tag'                   => $item['cat'] ?? $item['captionTag'] ?? 'BRAND WIRE',
                    'date'                  => $item['date'] ?? '',
                    'source'                => $item['source'] ?? $provKey,
                    'title'                 => $item['title'] ?? '',
                    'desc'                  => $item['summary'] ?? '',
                    'link'                  => $item['link'] ?? '',
                    'img'                   => $item['img'] ?? '',
                    'provider_published_at' => ''
                ];
            }
        }
    }

    // 3. Check regional_wires map (Dawn, B-Recorder, ProPakistani, Tribune)
    if (!empty($raw['regional_wires']) && is_array($raw['regional_wires'])) {
        foreach ($raw['regional_wires'] as $regKey => $item) {
            $key = strtolower($regKey) . '|' . ($item['sourceUrl'] ?? $item['link'] ?? '');
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $items[] = [
                    'provider'              => $regKey,
                    'external_id'           => $item['sourceUrl'] ?? $item['link'] ?? '',
                    'tag'                   => $item['category'] ?? $item['captionTag'] ?? 'REGIONAL WIRE',
                    'date'                  => $item['date'] ?? '',
                    'source'                => $item['sourceName'] ?? $item['source'] ?? $regKey,
                    'title'                 => $item['title'] ?? '',
                    'desc'                  => $item['summary'] ?? '',
                    'link'                  => $item['sourceUrl'] ?? $item['link'] ?? '',
                    'img'                   => $item['image'] ?? $item['img'] ?? '',
                    'provider_published_at' => ''
                ];
            }
        }
    }

    return $items;
}

// 1. Route Dispatcher
$rawInput = file_get_contents('php://input');
$jsonData = @json_decode($rawInput, true) ?: [];
$action = $_POST['action'] ?? $jsonData['action'] ?? $_GET['action'] ?? '';

// GET ACTIONS
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'list_feed_with_draft_status') {
        $canonicalItems = get_all_canonical_news_items();
        $drafts = get_all_local_drafts();
        
        // Build fast lookup by source key
        $draftMap = [];
        foreach ($drafts as $d) {
            $key = strtolower($d['source_provider'] ?? '') . '|' . ($d['source_external_article_id'] ?? '');
            $draftMap[$key] = [
                'draft_id'     => $d['id'],
                'status'       => $d['status'] ?? 'DRAFT',
                'custom_title' => $d['custom_title'] ?? '',
                'updated_at'   => $d['updated_at'] ?? ''
            ];
        }

        echo json_encode([
            'success'            => true,
            'canonical_records'  => $canonicalItems,
            'count'              => count($canonicalItems),
            'draft_map'          => $draftMap
        ]);
        exit;
    }

    if ($action === 'list_drafts') {
        $drafts = get_all_local_drafts();
        echo json_encode([
            'success' => true,
            'drafts'  => array_values($drafts)
        ]);
        exit;
    }

    if ($action === 'get_draft') {
        $id = validate_int_id($_GET['id'] ?? 0);
        $drafts = get_all_local_drafts();
        if ($id && isset($drafts[$id])) {
            echo json_encode(['success' => true, 'draft' => $drafts[$id]]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Knowledge draft not found.']);
        }
        exit;
    }
}

// POST STATE-CHANGING ACTIONS (Require CSRF)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? $jsonData['csrf_token'] ?? '';
    if (!validate_csrf_token($token)) {
        creed_audit_log('CSRF_REJECTED', 'KNOWLEDGE_DRAFT', null, 'FAILURE', ['action' => $action]);
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Security token validation failed.']);
        exit;
    }

    // 1. REFRESH TECH WIRE FEEDS (Authenticated Admin + CSRF Protected)
    if ($action === 'refresh_tech_wire_feeds') {
        require_once __DIR__ . '/live_tech_news.php';

        try {
            $syncResult = sync_all_verified_feeds(true);
            if (empty($syncResult) || !is_array($syncResult)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Feed synchronization returned empty or invalid response.'
                ]);
                exit;
            }

            creed_audit_log('NEWS_FEEDS_REFRESHED', 'TECH_WIRE', null, 'SUCCESS', [
                'pakistani_articles'     => $syncResult['counts']['pakistani_articles'] ?? 0,
                'international_articles' => $syncResult['counts']['international_articles'] ?? 0
            ]);

            echo json_encode([
                'success'           => true,
                'message'           => 'Feed refreshed successfully',
                'timestamp'         => $syncResult['timestamp'] ?? gmdate('Y-m-d\TH:i:s\Z'),
                'counts'            => $syncResult['counts'] ?? [],
                'provider_statuses' => $syncResult['provider_statuses'] ?? []
            ]);
        } catch (Throwable $e) {
            creed_audit_log('NEWS_FEEDS_REFRESH_FAILED', 'TECH_WIRE', null, 'FAILURE', [
                'error' => $e->getMessage()
            ]);
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Failed to refresh feeds: ' . $e->getMessage()
            ]);
        }
        exit;
    }

    // 2. CREATE OR OPEN DRAFT FROM LIVE NEWS REFERENCE
    if ($action === 'create_or_open_draft') {
        $provider = strtolower(trim((string)($_POST['provider'] ?? $jsonData['provider'] ?? '')));
        $externalId = trim((string)($_POST['external_id'] ?? $jsonData['external_id'] ?? ''));
        $sourceTitle = trim((string)($_POST['title'] ?? $jsonData['title'] ?? ''));
        $sourceUrl = trim((string)($_POST['link'] ?? $jsonData['link'] ?? ''));
        $sourceImg = trim((string)($_POST['img'] ?? $jsonData['img'] ?? ''));
        $sourcePub = trim((string)($_POST['pub_date'] ?? $jsonData['pub_date'] ?? ''));
        $sourceSummary = trim((string)($_POST['summary'] ?? $jsonData['summary'] ?? ''));

        if (empty($provider) || empty($externalId)) {
            echo json_encode(['success' => false, 'error' => 'Missing provider or external_article_id source identifier.']);
            exit;
        }

        $drafts = get_all_local_drafts();

        // Check for existing draft to prevent duplicates
        foreach ($drafts as $existingId => $d) {
            if (($d['source_provider'] ?? '') === $provider && ($d['source_external_article_id'] ?? '') === $externalId) {
                echo json_encode([
                    'success'  => true,
                    'is_new'   => false,
                    'draft_id' => $existingId,
                    'draft'    => $d,
                    'message'  => 'Existing Knowledge draft opened successfully.'
                ]);
                exit;
            }
        }

        // Create new separate Knowledge Draft
        $newId = (int)(time() . rand(100, 999));
        $slug = preg_replace('/[^a-z0-9\-]+/', '-', strtolower($sourceTitle));
        $slug = trim(substr($slug, 0, 80), '-');

        $newDraft = [
            'id'                          => $newId,
            'article_origin'              => 'news_editorial',
            'source_provider'             => $provider,
            'source_external_article_id'  => $externalId,
            'source_url'                  => $sourceUrl,
            'source_title'                => $sourceTitle,
            'source_published_at'         => $sourcePub,
            'source_image_url'            => $sourceImg,
            'source_summary_reference'    => $sourceSummary,
            'custom_title'                => '',
            'slug'                        => $slug,
            'custom_excerpt'              => '',
            'custom_body'                 => '', // Body starts empty for original writing
            'category'                    => 'ENTERPRISE TECH & AI INTELLIGENCE',
            'tags'                        => [$provider, 'Technology', 'Analysis'],
            'author'                      => $_SESSION['admin_email'] ?? 'Lead Architect',
            'cover_image_type'            => 'verified_source_image',
            'cover_image_path'            => '',
            'seo_title'                   => '',
            'seo_description'             => '',
            'status'                      => 'DRAFT',
            'is_featured'                 => false,
            'created_at'                  => gmdate('Y-m-d\TH:i:s\Z'),
            'updated_at'                  => gmdate('Y-m-d\TH:i:s\Z'),
            'published_at'                => null
        ];

        $drafts[$newId] = $newDraft;
        save_all_local_drafts($drafts);

        creed_audit_log('CREATE_DRAFT', 'KNOWLEDGE_DRAFT', $newId, 'SUCCESS', ['provider' => $provider, 'source_title' => $sourceTitle]);

        echo json_encode([
            'success'  => true,
            'is_new'   => true,
            'draft_id' => $newId,
            'draft'    => $newDraft,
            'message'  => 'New Knowledge draft created from source reference.'
        ]);
        exit;
    }

    // 3. SAVE DRAFT
    if ($action === 'save_draft') {
        $id = validate_int_id($_POST['id'] ?? $jsonData['id'] ?? 0);
        $drafts = get_all_local_drafts();

        if (!$id || !isset($drafts[$id])) {
            echo json_encode(['success' => false, 'error' => 'Knowledge draft does not exist.']);
            exit;
        }

        $customTitle   = trim((string)($_POST['custom_title'] ?? $jsonData['custom_title'] ?? ''));
        $slug          = trim((string)($_POST['slug'] ?? $jsonData['slug'] ?? ''));
        $customExcerpt = trim((string)($_POST['custom_excerpt'] ?? $jsonData['custom_excerpt'] ?? ''));
        $customBody    = (string)($_POST['custom_body'] ?? $jsonData['custom_body'] ?? '');
        $category      = trim((string)($_POST['category'] ?? $jsonData['category'] ?? 'ENTERPRISE TECH & AI INTELLIGENCE'));
        $author        = trim((string)($_POST['author'] ?? $jsonData['author'] ?? 'Lead Architect'));
        $coverType     = validate_allowlist($_POST['cover_image_type'] ?? $jsonData['cover_image_type'] ?? 'verified_source_image', ['verified_source_image', 'editorial_upload', 'none'], 'verified_source_image');
        $seoTitle      = trim((string)($_POST['seo_title'] ?? $jsonData['seo_title'] ?? ''));
        $seoDesc       = trim((string)($_POST['seo_description'] ?? $jsonData['seo_description'] ?? ''));
        $tags          = is_array($_POST['tags'] ?? $jsonData['tags'] ?? null) ? ($_POST['tags'] ?? $jsonData['tags']) : [];

        // Handle optional editorial image upload
        $coverPath = $drafts[$id]['cover_image_path'] ?? '';
        if ($coverType === 'editorial_upload' && !empty($_FILES['editorial_image']['tmp_name'])) {
            $uploadRes = secure_upload_image($_FILES['editorial_image'], __DIR__ . '/../uploads/', 5242880);
            if ($uploadRes['success']) {
                $coverPath = 'uploads/' . $uploadRes['filename'];
                creed_audit_log('UPLOAD_ACCEPTED', 'KNOWLEDGE_DRAFT', $id, 'SUCCESS', ['filename' => $uploadRes['filename']]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Cover image upload failed: ' . $uploadRes['error']]);
                exit;
            }
        }

        $drafts[$id]['custom_title']       = $customTitle;
        $drafts[$id]['slug']               = $slug ?: ('article-' . $id);
        $drafts[$id]['custom_excerpt']     = $customExcerpt;
        $drafts[$id]['custom_body']        = $customBody;
        $drafts[$id]['category']           = $category;
        $drafts[$id]['author']             = $author;
        $drafts[$id]['cover_image_type']   = $coverType;
        $drafts[$id]['cover_image_path']   = $coverPath;
        $drafts[$id]['seo_title']          = $seoTitle;
        $drafts[$id]['seo_description']    = $seoDesc;
        $drafts[$id]['tags']               = $tags;
        $drafts[$id]['updated_at']         = gmdate('Y-m-d\TH:i:s\Z');

        save_all_local_drafts($drafts);

        if (($drafts[$id]['status'] ?? '') === 'PUBLISHED') {
            sync_published_articles_cache();
        }

        creed_audit_log('SAVE_DRAFT', 'KNOWLEDGE_DRAFT', $id, 'SUCCESS');

        echo json_encode([
            'success' => true,
            'draft'   => $drafts[$id],
            'message' => 'Knowledge draft saved successfully.'
        ]);
        exit;
    }

    // 4. PUBLISH DRAFT
    if ($action === 'publish_draft') {
        $id = validate_int_id($_POST['id'] ?? $jsonData['id'] ?? 0);
        $drafts = get_all_local_drafts();

        if (!$id || !isset($drafts[$id])) {
            echo json_encode(['success' => false, 'error' => 'Knowledge draft does not exist.']);
            exit;
        }

        if (empty(trim($drafts[$id]['custom_title'] ?? '')) && empty(trim($drafts[$id]['source_title'] ?? ''))) {
            echo json_encode(['success' => false, 'error' => 'Article title cannot be empty.']);
            exit;
        }

        $drafts[$id]['status']       = 'PUBLISHED';
        $drafts[$id]['published_at'] = gmdate('Y-m-d\TH:i:s\Z');
        $drafts[$id]['updated_at']   = gmdate('Y-m-d\TH:i:s\Z');

        save_all_local_drafts($drafts);
        sync_published_articles_cache();

        creed_audit_log('PUBLISH', 'KNOWLEDGE_ARTICLE', $id, 'SUCCESS');

        echo json_encode([
            'success' => true,
            'draft'   => $drafts[$id],
            'message' => 'Article published to Knowledge Center successfully.'
        ]);
        exit;
    }

    // 5. UNPUBLISH DRAFT
    if ($action === 'unpublish_draft') {
        $id = validate_int_id($_POST['id'] ?? $jsonData['id'] ?? 0);
        $drafts = get_all_local_drafts();

        if (!$id || !isset($drafts[$id])) {
            echo json_encode(['success' => false, 'error' => 'Knowledge draft does not exist.']);
            exit;
        }

        $drafts[$id]['status']     = 'DRAFT';
        $drafts[$id]['updated_at'] = gmdate('Y-m-d\TH:i:s\Z');

        save_all_local_drafts($drafts);
        sync_published_articles_cache();

        creed_audit_log('UNPUBLISH', 'KNOWLEDGE_ARTICLE', $id, 'SUCCESS');

        echo json_encode([
            'success' => true,
            'draft'   => $drafts[$id],
            'message' => 'Article unpublished and reverted to draft status.'
        ]);
        exit;
    }

    // 6. DELETE DRAFT (Deletes only the independent draft, never the source news)
    if ($action === 'delete_draft') {
        $id = validate_int_id($_POST['id'] ?? $jsonData['id'] ?? 0);
        $drafts = get_all_local_drafts();

        if (!$id || !isset($drafts[$id])) {
            echo json_encode(['success' => false, 'error' => 'Knowledge draft does not exist.']);
            exit;
        }

        unset($drafts[$id]);
        save_all_local_drafts($drafts);
        sync_published_articles_cache();

        creed_audit_log('DELETE', 'KNOWLEDGE_DRAFT', $id, 'SUCCESS');

        echo json_encode([
            'success' => true,
            'message' => 'Knowledge draft deleted successfully. (Source Live News record remained untouched).'
        ]);
        exit;
    }
}

http_response_code(400);
echo json_encode(['success' => false, 'error' => 'Invalid action or unsupported request method.']);
exit;
