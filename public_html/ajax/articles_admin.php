<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/auth_guard.php';
require_once __DIR__ . '/../includes/db.php';

$articlesFile = __DIR__ . '/../data/articles.json';
if (!is_dir(dirname($articlesFile))) {
    mkdir(dirname($articlesFile), 0755, true);
}

$articles = [];
if (file_exists($articlesFile)) {
    $articles = json_decode(file_get_contents($articlesFile), true) ?? [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rawInput = file_get_contents('php://input');
    $jsonData = json_decode($rawInput, true);

    $token = $jsonData['csrf_token'] ?? $_POST['csrf_token'] ?? '';
    if (!validate_csrf_token($token)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden: Invalid or missing CSRF security token.']);
        exit;
    }

    $action = $jsonData['action'] ?? $_POST['action'] ?? 'save_article';

    // 1. SAVE / UPDATE ARTICLE
    if ($action === 'save_article' || $action === 'create_article') {
        $id = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $title = trim($jsonData['title'] ?? $_POST['title'] ?? '');
        $category = trim($jsonData['category'] ?? $_POST['category'] ?? 'HARDWARE & WORKSTATIONS');
        $author = trim($jsonData['author'] ?? $_POST['author'] ?? 'Dr. Sarah Jenkins (Chief Systems Architect)');
        $readTime = trim($jsonData['read_time'] ?? $_POST['read_time'] ?? '12 min read');
        $audioUrl = trim($jsonData['audio_url'] ?? $_POST['audio_url'] ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3');
        $videoUrl = trim($jsonData['video_url'] ?? $_POST['video_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ');
        $editorsNote = trim($jsonData['editors_note'] ?? $_POST['editors_note'] ?? '');
        
        $pros = is_array($jsonData['pros'] ?? null) ? $jsonData['pros'] : [
            'Field-leading efficiency and low thermal acoustic output',
            'Generous unified memory bandwidth for local AI weights',
            'Factory-calibrated OLED display with 100% color fidelity'
        ];

        $cons = is_array($jsonData['cons'] ?? null) ? $jsonData['cons'] : [
            'Premium pricing on top-tier RAM configurations',
            'Requires USB-C / Thunderbolt dongles for legacy peripherals'
        ];

        $buyLinks = is_array($jsonData['buy_links'] ?? null) ? $jsonData['buy_links'] : [
            [ 'store' => 'Amazon', 'price' => '$899 at Amazon', 'color' => '#FF9900', 'url' => 'https://amazon.com' ],
            [ 'store' => 'Direct Store', 'price' => '$1,299 Official', 'color' => '#0052FF', 'url' => 'https://creed-tech.com' ]
        ];

        $specs = is_array($jsonData['specs'] ?? null) ? $jsonData['specs'] : [
            'Processor (CPU)' => 'Snapdragon X Elite / Intel Core Ultra 9',
            'RAM' => '32GB to 128GB Unified LPDDR5X',
            'Storage' => '2TB PCIe Gen4 NVMe SSD',
            'Display' => '14.5\" 3.2K OLED 120Hz Touch'
        ];

        if (empty($title)) {
            echo json_encode(['success' => false, 'message' => 'Article title cannot be empty.']);
            exit;
        }

        $passedProducts = (isset($jsonData['products']) && is_array($jsonData['products']) && count($jsonData['products']) > 0) 
            ? $jsonData['products'] 
            : [
                [
                    'rank' => '01',
                    'badge' => 'EDITOR’S CHOICE: ABSOLUTE BEST',
                    'name' => 'NextGen M4 Silicon Architecture Platform',
                    'rating' => '9.8 / 10',
                    'category' => 'Systems',
                    'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=800&auto=format&fit=crop',
                    'description' => 'Unrivaled single-thread throughput with next-gen neural acceleration engine delivering sub-millisecond local tensor inference.',
                    'pros' => $pros,
                    'cons' => $cons,
                    'specs' => $specs,
                    'buy_links' => $buyLinks
                ]
            ];

        if ($id > 0) {
            // Update
            $found = false;
            foreach ($articles as &$art) {
                if (intval($art['id']) === $id) {
                    $art['title'] = $title;
                    $art['category'] = $category;
                    $art['author'] = $author;
                    $art['read_time'] = $readTime;
                    $art['audio_url'] = $audioUrl;
                    $art['video_url'] = $videoUrl;
                    $art['editors_note'] = $editorsNote;
                    $art['products'] = $passedProducts;
                    $art['updated_at'] = date('Y-m-d H:i:s');
                    $found = true;
                    break;
                }
            }
            unset($art);
        } else {
            // Create
            $newId = count($articles) > 0 ? (max(array_column($articles, 'id')) + 1) : 1;
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
            $newArticle = [
                'id' => $newId,
                'slug' => $slug . '-' . time(),
                'title' => $title,
                'category' => $category,
                'author' => $author,
                'date' => date('M d, Y'),
                'read_time' => $readTime,
                'audio_url' => $audioUrl,
                'video_url' => $videoUrl,
                'summary' => substr(strip_tags($editorsNote ?: $title), 0, 180) . '...',
                'editors_note' => $editorsNote,
                'views' => 100,
                'products' => $passedProducts,
                'created_at' => date('Y-m-d H:i:s')
            ];
            array_unshift($articles, $newArticle);
        }

        file_put_contents($articlesFile, json_encode($articles, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'Article saved successfully!', 'articles' => $articles]);
        exit;
    }

    // 2. DELETE ARTICLE
    if ($action === 'delete_article') {
        $id = intval($jsonData['id'] ?? $_POST['id'] ?? 0);
        $articles = array_values(array_filter($articles, function($a) use ($id) {
            return intval($a['id']) !== $id;
        }));
        file_put_contents($articlesFile, json_encode($articles, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true, 'message' => 'Article removed successfully.', 'articles' => $articles]);
        exit;
    }

} else {
    // GET REQUEST
    $category = $_GET['category'] ?? 'all';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id > 0) {
        foreach ($articles as $art) {
            if (intval($art['id']) === $id) {
                echo json_encode(['success' => true, 'article' => $art]);
                exit;
            }
        }
        echo json_encode(['success' => false, 'message' => 'Article not found.']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'count' => count($articles),
        'articles' => $articles
    ]);
    exit;
}
