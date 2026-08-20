<?php
/**
 * Creed Tech - Dynamic Auto-Sync XML Sitemap Generator
 * Automatically synchronizes static canonical pages and published Knowledge Center articles.
 */

// Set authoritative XML headers
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex, follow');

// Core Static Indexable Pages
$staticPages = [
    [
        'loc'        => 'https://creed-tech.com/',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'daily',
        'priority'   => '1.0'
    ],
    [
        'loc'        => 'https://creed-tech.com/services',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'weekly',
        'priority'   => '0.9'
    ],
    [
        'loc'        => 'https://creed-tech.com/knowledge-center',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'daily',
        'priority'   => '0.9'
    ],
    [
        'loc'        => 'https://creed-tech.com/portfolio',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'weekly',
        'priority'   => '0.8'
    ],
    [
        'loc'        => 'https://creed-tech.com/about',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.8'
    ],
    [
        'loc'        => 'https://creed-tech.com/contact',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.8'
    ],
    [
        'loc'        => 'https://creed-tech.com/careers',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'weekly',
        'priority'   => '0.7'
    ],
    [
        'loc'        => 'https://creed-tech.com/get-started',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.7'
    ],
    [
        'loc'        => 'https://creed-tech.com/software-development',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.7'
    ],
    [
        'loc'        => 'https://creed-tech.com/qa',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.7'
    ],
    [
        'loc'        => 'https://creed-tech.com/security',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.7'
    ],
    [
        'loc'        => 'https://creed-tech.com/security-iso-27001',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.6'
    ],
    [
        'loc'        => 'https://creed-tech.com/security-gdpr',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.6'
    ],
    [
        'loc'        => 'https://creed-tech.com/security-soc-2',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.6'
    ],
    [
        'loc'        => 'https://creed-tech.com/security-pci-dss',
        'lastmod'    => '2026-08-20',
        'changefreq' => 'monthly',
        'priority'   => '0.6'
    ]
];

// Load Published Dynamic Articles
$articlesFile = __DIR__ . '/data/articles.json';
$dynamicArticles = [];

if (file_exists($articlesFile)) {
    $raw = @file_get_contents($articlesFile);
    if ($raw !== false) {
        $parsed = json_decode($raw, true);
        if (is_array($parsed)) {
            foreach ($parsed as $art) {
                if (!is_array($art)) continue;
                $artId = intval($art['id'] ?? 0);
                $title = trim($art['title'] ?? '');
                
                // Only include legitimate published articles with valid ID & title
                if ($artId > 0 && !empty($title)) {
                    // Extract reliable last modification / publication timestamp
                    $dateStr = $art['updated_at'] ?? $art['created_at'] ?? $art['date'] ?? '';
                    $ts = !empty($dateStr) ? strtotime($dateStr) : false;
                    $lastmod = ($ts && $ts > 0) ? date('Y-m-d', $ts) : date('Y-m-d');
                    
                    $dynamicArticles[] = [
                        'loc'        => 'https://creed-tech.com/blog_detail?id=' . $artId,
                        'lastmod'    => $lastmod,
                        'changefreq' => 'weekly',
                        'priority'   => '0.8'
                    ];
                }
            }
        }
    }
}

// Begin XML Output
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// 1. Render Static Canonical Pages
echo "  <!-- 1. Core Platform Pages & Verticals -->\n";
foreach ($staticPages as $page) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($page['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
    echo "    <lastmod>" . htmlspecialchars($page['lastmod'], ENT_XML1, 'UTF-8') . "</lastmod>\n";
    echo "    <changefreq>" . htmlspecialchars($page['changefreq'], ENT_XML1, 'UTF-8') . "</changefreq>\n";
    echo "    <priority>" . htmlspecialchars($page['priority'], ENT_XML1, 'UTF-8') . "</priority>\n";
    echo "  </url>\n";
}

// 2. Render Dynamic Published Articles
if (!empty($dynamicArticles)) {
    echo "  <!-- 2. Dynamic Published Knowledge Center Articles -->\n";
    foreach ($dynamicArticles as $art) {
        echo "  <url>\n";
        echo "    <loc>" . htmlspecialchars($art['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
        echo "    <lastmod>" . htmlspecialchars($art['lastmod'], ENT_XML1, 'UTF-8') . "</lastmod>\n";
        echo "    <changefreq>" . htmlspecialchars($art['changefreq'], ENT_XML1, 'UTF-8') . "</changefreq>\n";
        echo "    <priority>" . htmlspecialchars($art['priority'], ENT_XML1, 'UTF-8') . "</priority>\n";
        echo "  </url>\n";
    }
}

echo '</urlset>' . "\n";
