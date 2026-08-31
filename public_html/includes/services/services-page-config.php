<?php
/**
 * Creed Tech - Services Page Head Configuration & JSON-LD Schema
 */

require_once dirname(__DIR__) . '/env_loader.php';
require_once dirname(__DIR__) . '/security_helpers.php';

$siteBaseUrl = rtrim(creed_env('CANONICAL_BASE_URL', 'https://creed-tech.com'), '/');
if (empty($siteBaseUrl) || str_contains($siteBaseUrl, 'localhost')) {
    $siteBaseUrl = 'https://creed-tech.com';
}

$page_title = "Enterprise Services & Engineering Capabilities | Creed Tech";
$page_description = "Explore Creed Tech services for software development, UI/UX, mobile apps, cloud infrastructure, databases, web development, AI automation and digital growth.";
$active_page = "services";
$canonical_url = $siteBaseUrl . '/services';
$extra_head_tags = '<link rel="preload" as="image" href="images/services-hero-bg.webp" type="image/webp" fetchpriority="high">' . "\n" .
    '  <link rel="stylesheet" href="' . htmlspecialchars(creed_asset_url('assets/css/services.css')) . '">';

$schema_json = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => $siteBaseUrl . '/'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Services',
                    'item' => $canonical_url
                ]
            ]
        ],
        [
            '@type' => 'ItemList',
            'name' => 'Creed Tech Services',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Software Development',
                    'url' => $canonical_url . '#software-development'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'UI/UX Design',
                    'url' => $canonical_url . '#ui-ux-design'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => 'Mobile Application',
                    'url' => $canonical_url . '#mobile-application'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 4,
                    'name' => 'Cloud Infrastructure',
                    'url' => $canonical_url . '#cloud-infrastructure'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 5,
                    'name' => 'Database Management',
                    'url' => $canonical_url . '#database-management'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 6,
                    'name' => 'Web Development',
                    'url' => $canonical_url . '#web-development'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 7,
                    'name' => 'AI & Automation',
                    'url' => $canonical_url . '#ai-automation'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 8,
                    'name' => 'Digital Growth',
                    'url' => $canonical_url . '#digital-growth'
                ]
            ]
        ]
    ]
];
