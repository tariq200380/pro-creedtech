<?php
/**
 * Creed Tech - Global Header
 * News Bar: Fixed stationary orange badge in center, with fast animated rotating news text
 */
require_once __DIR__ . '/security_headers.php';
require_once __DIR__ . '/security_helpers.php';

$siteSettings = creed_get_site_settings();
$headerConfig = $siteSettings['header'] ?? [];

$headerLogoUrl = !empty($headerConfig['logo_url']) ? $headerConfig['logo_url'] : 'Creed-Tech-Logo-Clean.webp';
$headerCtaText = !empty($headerConfig['cta_text']) ? $headerConfig['cta_text'] : 'Get Started';
$headerCtaUrl  = !empty($headerConfig['cta_url']) ? $headerConfig['cta_url'] : 'get-started';

$defaultNavLinks = [
  ['label' => 'Home', 'url' => '/', 'active_key' => 'home'],
  ['label' => 'Services', 'url' => 'services', 'active_key' => 'services'],
  ['label' => 'Knowledge Center', 'url' => 'knowledge-center', 'active_key' => 'knowledge-center'],
  ['label' => 'Portfolio', 'url' => 'portfolio', 'active_key' => 'portfolio'],
  ['label' => 'About', 'url' => 'about', 'active_key' => 'about'],
  ['label' => 'Contact', 'url' => 'contact', 'active_key' => 'contact'],
];
$headerNavLinks = (!empty($headerConfig['nav_links']) && is_array($headerConfig['nav_links'])) ? $headerConfig['nav_links'] : $defaultNavLinks;

if (!isset($page_title)) $page_title = "CREED TECH | Enterprise IT Intelligence & Custom Software Engineering";
if (!isset($page_description)) $page_description = "Enterprise IT solutions, custom software engineering, AI workflow orchestration, cloud modernization, and real-time tech industry intelligence.";
if (!isset($active_page)) $active_page = "home";

// Canonical URL Resolution
if (!isset($canonical_url) || empty($canonical_url)) {
    require_once __DIR__ . '/env_loader.php';
    $baseUrl = rtrim(creed_env('CANONICAL_BASE_URL', 'https://creed-tech.com'), '/');
    if (empty($baseUrl) || str_contains($baseUrl, 'localhost')) {
        $baseUrl = 'https://creed-tech.com';
    }
    
    if ($active_page === 'home') {
        $canonical_url = $baseUrl . '/';
    } elseif (!empty($active_page)) {
        $canonical_url = $baseUrl . '/' . $active_page;
    } else {
        $reqUri = $_SERVER['REQUEST_URI'] ?? '';
        $reqPath = parse_url($reqUri, PHP_URL_PATH) ?? '';
        $cleanRoute = trim(preg_replace('/\.php$/i', '', ltrim($reqPath, '/')));
        if (empty($cleanRoute) || strtolower($cleanRoute) === 'home' || strtolower($cleanRoute) === 'index') {
            $canonical_url = $baseUrl . '/';
        } else {
            $canonical_url = $baseUrl . '/' . $cleanRoute;
        }
    }
}

// Open Graph Resolution
if (!isset($og_title)) $og_title = $page_title;
if (!isset($og_description)) $og_description = $page_description;
if (!isset($og_url)) $og_url = $canonical_url;
if (!isset($og_type)) $og_type = 'website';
if (!isset($og_image) || empty($og_image)) {
    $og_image = 'https://creed-tech.com/Creed-Tech-Logo-Clean.webp';
} elseif (!str_starts_with($og_image, 'http://') && !str_starts_with($og_image, 'https://')) {
    $og_image = 'https://creed-tech.com/' . ltrim($og_image, '/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">

  <!-- Open Graph Social Metadata -->
  <meta property="og:site_name" content="Creed Tech">
  <meta property="og:title" content="<?php echo htmlspecialchars($og_title); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($og_description); ?>">
  <meta property="og:url" content="<?php echo htmlspecialchars($og_url); ?>">
  <meta property="og:type" content="<?php echo htmlspecialchars($og_type); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">

  <!-- Twitter / X Card Social Metadata -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@Creedtech3">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($og_title); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($og_description); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">

  <?php if (isset($extra_head_tags)) echo $extra_head_tags . "\n"; ?>

  <!-- Structured Data: Organization & WebSite (Schema.org JSON-LD) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Creed Tech",
    "url": "https://creed-tech.com/",
    "logo": "https://creed-tech.com/Creed-Tech-Logo-Clean.webp",
    "description": "Enterprise IT solutions, custom software engineering, AI workflow orchestration, cloud modernization, and real-time tech industry intelligence.",
    "email": "<?= htmlspecialchars($siteSettings['general']['contact_email'] ?? 'info@creed-tech.com') ?>",
    "telephone": "<?= htmlspecialchars($siteSettings['general']['contact_phone'] ?? '+92 309 8307115') ?>",
    "sameAs": [
      "https://linkedin.com/company/creedtech",
      "https://x.com/Creedtech3",
      "https://github.com/creed-tech",
      "https://facebook.com/creedtechnology",
      "https://instagram.com/creed.technologiess"
    ]
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Creed Tech",
    "url": "https://creed-tech.com/",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://creed-tech.com/knowledge-center?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>
  <?php if (isset($schema_json) && !empty($schema_json)): ?>
  <script type="application/ld+json">
  <?= is_array($schema_json) ? json_encode($schema_json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : $schema_json ?>
  </script>
  <?php endif; ?>
  
  <link rel="icon" href="Creed-Tech-Logo-Clean.webp">
  
  <!-- Local Production Stylesheets with Automatic Cache Busting -->
  <link rel="stylesheet" href="<?= creed_asset_url('assets/css/tailwind.min.css') ?>">
  <link rel="stylesheet" href="<?= creed_asset_url('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') ?>">
  
  <!-- Bulletproof Button & Component Styles (Immune to Tailwind class gaps) -->
  <style>
    /* ================= UNIVERSAL BUTTON DESIGN SYSTEM ================= */
    .btn-blue {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      background-color: #0052FF !important;
      color: #FFFFFF !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      line-height: 1 !important;
      height: 40px !important;
      padding: 0 20px !important;
      border-radius: 4px !important;
      border: 1px solid transparent !important;
      cursor: pointer !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      transition: all 0.2s ease-in-out !important;
      box-shadow: 0 1px 3px rgba(0, 82, 255, 0.2) !important;
    }
    .btn-blue:hover {
      background-color: #0042D0 !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 10px rgba(0, 82, 255, 0.3) !important;
      color: #FFFFFF !important;
    }

    .btn-blue-sm {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      background-color: #0052FF !important;
      color: #FFFFFF !important;
      font-size: 12.5px !important;
      font-weight: 600 !important;
      line-height: 1 !important;
      height: 36px !important;
      padding: 0 16px !important;
      border-radius: 4px !important;
      border: 1px solid transparent !important;
      cursor: pointer !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      transition: all 0.2s ease-in-out !important;
    }
    .btn-blue-sm:hover {
      background-color: #0042D0 !important;
      transform: translateY(-1px) !important;
      color: #FFFFFF !important;
    }

    .btn-orange {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      background-color: #FF6B00 !important;
      color: #FFFFFF !important;
      font-size: 13.5px !important;
      font-weight: 600 !important;
      line-height: 1 !important;
      height: 42px !important;
      padding: 0 22px !important;
      border-radius: 4px !important;
      border: 1px solid transparent !important;
      cursor: pointer !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      transition: all 0.2s ease-in-out !important;
      box-shadow: 0 2px 6px rgba(255, 107, 0, 0.25) !important;
    }
    .btn-orange:hover {
      background-color: #E05D00 !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 12px rgba(255, 107, 0, 0.35) !important;
      color: #FFFFFF !important;
    }

    .btn-dark {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 6px !important;
      background-color: #111827 !important;
      color: #FFFFFF !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      line-height: 1 !important;
      height: 42px !important;
      padding: 0 20px !important;
      border-radius: 4px !important;
      border: 1px solid #374151 !important;
      cursor: pointer !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      transition: all 0.2s ease-in-out !important;
    }
    .btn-dark:hover {
      background-color: #0052FF !important;
      border-color: #0052FF !important;
      transform: translateY(-1px) !important;
      color: #FFFFFF !important;
    }

    .how-tab-btn {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 13px !important;
      font-weight: 600 !important;
      line-height: 1 !important;
      height: 42px !important;
      min-height: 42px !important;
      width: 100% !important;
      min-width: 175px !important;
      padding: 0 16px !important;
      border-radius: 6px !important;
      cursor: pointer !important;
      border: 1px solid transparent !important;
      text-align: center !important;
      white-space: nowrap !important;
      transition: all 0.2s ease-in-out !important;
      box-sizing: border-box !important;
    }
    @media (min-width: 640px) {
      .how-tab-btn {
        width: 185px !important;
      }
    }

    .btn-tab-active {
      background-color: #FF6B00 !important;
      color: #FFFFFF !important;
      border-color: #FF6B00 !important;
      box-shadow: 0 2px 8px rgba(255, 107, 0, 0.3) !important;
    }
    .btn-tab-inactive {
      background-color: #1A2234 !important;
      color: #D1D5DB !important;
      border-color: #2D3748 !important;
    }
    .btn-tab-inactive:hover {
      background-color: #232E46 !important;
      color: #FFFFFF !important;
      border-color: #4A5568 !important;
    }

    /* Unbreakable 100% Continuous Seamless Horizontal Marquee */
    @keyframes infinitePartnerScroll {
      0% { transform: translate3d(0, 0, 0); }
      100% { transform: translate3d(-50%, 0, 0); }
    }
    .partner-marquee-track,
    .marquee-track {
      display: flex;
      width: max-content;
      animation: infinitePartnerScroll 20s linear infinite;
      will-change: transform;
    }
    .partner-marquee-track:hover,
    .marquee-track:hover {
      animation-play-state: paused;
    }

    /* Fixed Orange Badge + Animated News Line Transitions */
    .news-text-active {
      transform: translateX(0);
      opacity: 1;
      transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
    }
    .news-text-out {
      transform: translateX(-120%);
      opacity: 0;
      transition: transform 0.35s cubic-bezier(0.7, 0, 0.84, 0), opacity 0.35s ease;
    }
    .news-text-in-prep {
      transform: translateX(120%);
      opacity: 0;
      transition: none !important;
    }

    /* Continuous Vertical Reviews Marquee: Left Col DOWN, Right Col UP */
    @keyframes scrollDownContinuous {
      0% { transform: translate3d(0, -50%, 0); }
      100% { transform: translate3d(0, 0%, 0); }
    }
    @keyframes scrollUpContinuous {
      0% { transform: translate3d(0, 0%, 0); }
      100% { transform: translate3d(0, -50%, 0); }
    }
    .reviews-col-down {
      display: flex;
      flex-direction: column;
      gap: 16px;
      animation: scrollDownContinuous 20s linear infinite;
      will-change: transform;
    }
    .reviews-col-up {
      display: flex;
      flex-direction: column;
      gap: 16px;
      animation: scrollUpContinuous 20s linear infinite;
      will-change: transform;
    }
    .reviews-col-down:hover,
    .reviews-col-up:hover {
      animation-play-state: paused;
    }
  </style>
</head>
<body class="bg-white text-[#3E3E3E] font-sans antialiased flex flex-col min-h-screen">

  <!-- ================= STICKY GLOBAL HEADER CONTAINER (Top News Bar + Navbar) ================= -->
  <div class="sticky top-0 z-50 w-full relative shadow-xs">

    <!-- 1. NEWS BAR: Stationary Orange Badge, Responsive Animated News Text -->
    <div class="bg-[#070D1E] text-gray-200 text-xs py-1.5 sm:py-2 px-3 sm:px-4 border-b border-gray-800/80 tracking-wide font-sans select-none">
      <div class="max-w-7xl mx-auto flex items-center justify-between sm:justify-center gap-2 sm:gap-3 h-7">
        
        <!-- FIXED STATIONARY ORANGE BADGE (Never Moves) -->
        <span class="px-2.5 py-0.5 bg-[#FF6B00] text-white text-[10px] sm:text-[10.5px] font-extrabold uppercase tracking-widest rounded-[2px] shrink-0 z-10 shadow-xs flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
          <span>LIVE</span>
        </span>

        <!-- ANIMATED MOVING NEWS TEXT CONTAINER -->
        <div class="relative overflow-hidden h-6 flex items-center flex-1 min-w-0 max-w-lg sm:max-w-xl md:max-w-2xl">
          <div id="animatedNewsBox" class="news-text-active flex items-center gap-2 truncate w-full text-left">
            <span id="animatedNewsText" class="text-gray-300 font-medium truncate text-[11px] sm:text-xs">
              Creed Tech recognized as Leading Enterprise Systems & Cloud Modernization Provider.
            </span>
            <a id="animatedNewsLink" href="knowledge-center" class="text-[#38BDF8] hover:text-white font-bold transition-colors inline-flex items-center gap-1 text-[11px] sm:text-xs shrink-0 ml-1">
              <span>Explore</span> <span class="text-[#FF6B00]">&rarr;</span>
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- 2. MAIN HEADER (Light Gray Background) -->
    <header class="w-full h-16 max-h-16 bg-[#F4F6F8] border-b border-[#E5E8EB] flex items-center shadow-xs">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex items-center justify-between h-full">
        
        <!-- Logo -->
        <div class="flex items-center justify-start shrink-0">
          <a href="/" class="inline-flex items-center" aria-label="CREED TECH">
            <img 
              src="<?= htmlspecialchars($headerLogoUrl) ?>" 
              alt="CREED TECH Logo" 
              class="h-10 sm:h-11 w-auto object-contain block mix-blend-multiply transition-transform hover:scale-105"
              width="180"
              height="44"
              decoding="async"
              fetchpriority="high"
            />
          </a>
        </div>

        <!-- Navigation Links (Desktop) -->
        <nav class="hidden lg:flex items-center justify-center gap-8 h-full">
          <?php foreach ($headerNavLinks as $hNav):
            $hLabel = htmlspecialchars($hNav['label'] ?? '');
            $hRawUrl = $hNav['url'] ?? '#';
            $hUrl   = htmlspecialchars(($hRawUrl === 'Home' || $hRawUrl === 'home') ? '/' : $hRawUrl);
            $hKey   = strtolower(trim($hNav['active_key'] ?? $hNav['label'] ?? ''));
            $isHActive = ($active_page === $hKey || $active_page === strtolower($hNav['url'] ?? '') || ($active_page === 'home' && ($hNav['url'] === 'Home' || $hNav['url'] === '/' || $hKey === 'home')));
          ?>
          <a href="<?= $hUrl ?>" class="relative h-full flex items-center text-sm font-medium transition-colors hover:text-[#0052FF] <?= $isHActive ? 'text-[#0052FF] font-semibold' : 'text-[#1A1A1A]/80' ?>">
            <?= $hLabel ?>
            <?php if ($isHActive): ?><span class="absolute bottom-0 left-0 w-full h-[2px] bg-[#0052FF]"></span><?php endif; ?>
          </a>
          <?php endforeach; ?>
        </nav>

        <!-- Desktop CTA Button -->
        <div class="hidden lg:flex shrink-0">
          <a href="<?= htmlspecialchars($headerCtaUrl) ?>" class="btn-blue-sm">
            <?= htmlspecialchars($headerCtaText) ?>
          </a>
        </div>

        <!-- Mobile Toggle Button (Switches between Hamburger ☰ and Close ✕ with smooth morph) -->
        <div class="lg:hidden flex items-center shrink-0">
          <button
            type="button"
            id="toggleMobileMenuBtn"
            onclick="toggleMobileMenu()"
            class="text-[#1A1A1A] p-2 rounded-lg hover:bg-gray-200/70 hover:text-[#0052FF] transition-colors focus:outline-none cursor-pointer flex items-center justify-center relative w-10 h-10 select-none"
            aria-label="Toggle navigation menu"
          >
            <!-- Hamburger Icon (Closed state) -->
            <svg id="hamburgerIcon" class="w-6 h-6 transition-all duration-300 transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="4" y1="12" x2="20" y2="12"></line>
              <line x1="4" y1="6" x2="20" y2="6"></line>
              <line x1="4" y1="18" x2="20" y2="18"></line>
            </svg>
            <!-- Close ✕ Icon (Open state) -->
            <svg id="closeIcon" class="w-6 h-6 absolute transition-all duration-300 transform opacity-0 rotate-90 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>

      </div>
    </header>

    <!-- ================= MOBILE DROPDOWN MENU (Ultra Smooth Absolute Overlay) ================= -->
    <style>
      @media (min-width: 1024px) {
        #mobileDropdownMenu {
          display: none !important;
        }
      }
      #mobileDropdownMenu {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        width: 100%;
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        background: #F4F6F8;
        border-bottom: 0px solid transparent;
        box-shadow: none;
        transition: max-height 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease, visibility 0.25s ease;
      }
      #mobileDropdownMenu.is-open {
        max-height: 85vh;
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
        border-bottom: 1px solid #E5E8EB;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.06);
      }
      #mobileDropdownInner {
        transform: translateY(-8px);
        opacity: 0.8;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s ease;
      }
      #mobileDropdownMenu.is-open #mobileDropdownInner {
        transform: translateY(0);
        opacity: 1;
      }
      .mobile-nav-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.65rem 0.85rem;
        border-radius: 0.5rem;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
      }
      .mobile-nav-link:active {
        transform: scale(0.98);
      }
    </style>

    <div id="mobileDropdownMenu" class="lg:hidden w-full bg-[#F4F6F8]">
      <div id="mobileDropdownInner" class="px-4 py-3 max-h-[80vh] overflow-y-auto">
        <ul class="flex flex-col space-y-1 mb-3">
          <?php foreach ($headerNavLinks as $hNav):
            $hLabel = htmlspecialchars($hNav['label'] ?? '');
            $hRawUrl = $hNav['url'] ?? '#';
            $hUrl   = htmlspecialchars(($hRawUrl === 'Home' || $hRawUrl === 'home') ? '/' : $hRawUrl);
            $hKey   = strtolower(trim($hNav['active_key'] ?? $hNav['label'] ?? ''));
            $isHActive = ($active_page === $hKey || $active_page === strtolower($hNav['url'] ?? '') || ($active_page === 'home' && ($hNav['url'] === 'Home' || $hNav['url'] === '/' || $hKey === 'home')));
          ?>
          <li>
            <a href="<?= $hUrl ?>" onclick="closeMobileMenu()" class="mobile-nav-link group <?= $isHActive ? 'bg-[#0052FF] text-white shadow-xs' : 'text-gray-700 hover:bg-[#EAEFF6] hover:text-[#0052FF]' ?>">
              <span><?= $hLabel ?></span>
              <span class="text-xs transition-transform duration-200 group-hover:translate-x-0.5">&rarr;</span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="pt-2 border-t border-gray-200/80">
          <a href="<?= htmlspecialchars($headerCtaUrl) ?>" onclick="closeMobileMenu()" class="btn-blue w-full justify-center text-center shadow-xs py-2 text-xs font-bold uppercase tracking-wider">
            <?= htmlspecialchars($headerCtaText) ?>
          </a>
        </div>
      </div>
    </div>

  </div>

  <script>
    function toggleMobileMenu() {
      var menu = document.getElementById("mobileDropdownMenu");
      var hamb = document.getElementById("hamburgerIcon");
      var close = document.getElementById("closeIcon");
      if (!menu) return;
      var isOpen = menu.classList.contains("is-open");
      if (isOpen) {
        menu.classList.remove("is-open");
        if (hamb) {
          hamb.classList.remove("opacity-0", "rotate-90");
          hamb.classList.add("opacity-100", "rotate-0");
        }
        if (close) {
          close.classList.remove("opacity-100", "rotate-0");
          close.classList.add("opacity-0", "rotate-90");
        }
      } else {
        menu.classList.add("is-open");
        if (hamb) {
          hamb.classList.remove("opacity-100", "rotate-0");
          hamb.classList.add("opacity-0", "rotate-90");
        }
        if (close) {
          close.classList.remove("opacity-0", "rotate-90");
          close.classList.add("opacity-100", "rotate-0");
        }
      }
    }

    function closeMobileMenu() {
      var menu = document.getElementById("mobileDropdownMenu");
      var hamb = document.getElementById("hamburgerIcon");
      var close = document.getElementById("closeIcon");
      if (menu) menu.classList.remove("is-open");
      if (hamb) {
        hamb.classList.remove("opacity-0", "rotate-90");
        hamb.classList.add("opacity-100", "rotate-0");
      }
      if (close) {
        close.classList.remove("opacity-100", "rotate-0");
        close.classList.add("opacity-0", "rotate-90");
      }
    }

    // Close mobile menu when clicking outside
    document.addEventListener("click", function(e) {
      var menu = document.getElementById("mobileDropdownMenu");
      var btn = document.getElementById("toggleMobileMenuBtn");
      if (menu && menu.classList.contains("is-open")) {
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
          closeMobileMenu();
        }
      }
    });
  </script>

  <!-- News Ticker JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const newsLines = [
        {
          text: "Creed Tech recognized as Leading Enterprise Systems & Cloud Modernization Provider.",
          linkText: "Explore",
          linkUrl: "knowledge-center"
        },
        {
          text: "High-Throughput Global Settlement Engine achieves 120,000 TPS with sub-10ms latency.",
          linkText: "Case Study",
          linkUrl: "portfolio"
        },
        {
          text: "SOC 2 Type II and ISO 27001 Aligned Dedicated Engineering Pods Available.",
          linkText: "Security Center",
          linkUrl: "security"
        },
        {
          text: "Private On-Premise Vector RAG pipelines deployed for Fortune 500 Healthcare.",
          linkText: "AI Solutions",
          linkUrl: "services"
        }
      ];

      let currentIndex = 0;
      const newsBox = document.getElementById("animatedNewsBox");
      const newsText = document.getElementById("animatedNewsText");
      const newsLink = document.getElementById("animatedNewsLink");

      function slideNextNews() {
        if (!newsBox || !newsText || !newsLink) return;

        // 1. Fast Slide Out to Left
        newsBox.className = "news-text-out flex items-center gap-2 truncate w-full text-left";

        setTimeout(() => {
          // 2. Next item data
          currentIndex = (currentIndex + 1) % newsLines.length;
          const item = newsLines[currentIndex];
          newsText.textContent = item.text;
          newsLink.href = item.linkUrl;
          newsLink.innerHTML = `<span>${item.linkText}</span> <span class="text-[#FF6B00]">&rarr;</span>`;

          // 3. Teleport to Right (no transition)
          newsBox.className = "news-text-in-prep flex items-center gap-2 truncate w-full text-left";

          // Force reflow
          void newsBox.offsetWidth;

          // 4. Fast Slide In to Center
          requestAnimationFrame(() => {
            newsBox.className = "news-text-active flex items-center gap-2 truncate w-full text-left";
          });
        }, 350);
      }

      // Pause for 4 seconds between news headlines
      setInterval(slideNextNews, 4400);
    });
  </script>

  <!-- ========================================================================= -->
  <!-- UNIVERSAL LUXURY NOTIFICATION MODAL & TOAST DIALOG                        -->
  <!-- ========================================================================= -->
  <div id="creedCustomAlertModal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,0.75);z-index:999999;align-items:center;justify-content:center;padding:20px;backdrop-filter:blur(6px);animation:creedFadeIn 0.2s ease-out;">
    <div style="background:#fff;border-radius:16px;max-width:460px;width:100%;box-shadow:0 25px 50px -12px rgba(0,0,0,0.4);border:1px solid #E2E8F0;overflow:hidden;text-align:center;animation:creedPopIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
      <div id="creedAlertHeaderBar" style="background:#0F172A;padding:24px 20px 20px;color:#fff;">
        <div id="creedAlertIcon" style="width:54px;height:54px;border-radius:50%;margin:0 auto 12px;display:flex;align-items:center;justify-content:center;font-size:26px;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
          ✓
        </div>
        <h3 id="creedAlertTitle" style="font-size:1.25rem;font-weight:800;color:#fff;margin:0;line-height:1.3;">
          Submission Received
        </h3>
      </div>
      <div style="padding:24px 28px;">
        <p id="creedAlertMessage" style="font-size:14px;color:#475569;line-height:1.65;margin:0 0 24px;">
          Your request has been securely processed.
        </p>
        <button id="creedAlertBtn" onclick="closeCustomAlert()" style="width:100%;padding:12px;background:#0052FF;color:#fff;font-size:14px;font-weight:700;border:none;border-radius:8px;cursor:pointer;transition:background 0.2s;box-shadow:0 4px 12px rgba(0,82,255,0.3);" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
          Continue
        </button>
      </div>
    </div>
  </div>

  <style>
    @keyframes creedFadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes creedPopIn { from { transform: scale(0.92); opacity: 0; } to { transform: scale(1); opacity: 1; } }
  </style>

  <script>
    var _creedAlertCallback = null;
    function showCustomAlert(options) {
      options = options || {};
      var title = options.title || 'Notification';
      var msg = options.message || 'Operation completed successfully.';
      var type = options.type || 'success';
      var btnText = options.buttonText || 'Understood';
      _creedAlertCallback = options.onConfirm || null;

      var modal = document.getElementById('creedCustomAlertModal');
      var titleEl = document.getElementById('creedAlertTitle');
      var msgEl = document.getElementById('creedAlertMessage');
      var btnEl = document.getElementById('creedAlertBtn');
      var iconEl = document.getElementById('creedAlertIcon');
      var headerEl = document.getElementById('creedAlertHeaderBar');

      if (!modal || !titleEl || !msgEl || !btnEl || !iconEl || !headerEl) {
        alert(title + '\n\n' + msg);
        return;
      }

      titleEl.textContent = title;
      msgEl.innerHTML = msg;
      btnEl.textContent = btnText;

      if (type === 'success') {
        iconEl.innerHTML = '✓';
        iconEl.style.background = '#10B981';
        iconEl.style.color = '#fff';
        headerEl.style.background = 'linear-gradient(135deg, #0F172A 0%, #1E293B 100%)';
        btnEl.style.background = '#0052FF';
      } else if (type === 'pending' || type === 'warning') {
        iconEl.innerHTML = '⏳';
        iconEl.style.background = '#F59E0B';
        iconEl.style.color = '#fff';
        headerEl.style.background = 'linear-gradient(135deg, #1E1B4B 0%, #312E81 100%)';
        btnEl.style.background = '#4F46E5';
      } else if (type === 'error') {
        iconEl.innerHTML = '✕';
        iconEl.style.background = '#EF4444';
        iconEl.style.color = '#fff';
        headerEl.style.background = 'linear-gradient(135deg, #450A0A 0%, #7F1D1D 100%)';
        btnEl.style.background = '#DC2626';
      } else {
        iconEl.innerHTML = 'ℹ️';
        iconEl.style.background = '#0284C7';
        iconEl.style.color = '#fff';
        headerEl.style.background = '#0F172A';
        btnEl.style.background = '#0052FF';
      }

      modal.style.display = 'flex';
    }

    function closeCustomAlert() {
      var modal = document.getElementById('creedCustomAlertModal');
      if (modal) modal.style.display = 'none';
      if (typeof _creedAlertCallback === 'function') {
        _creedAlertCallback();
        _creedAlertCallback = null;
      }
    }
  </script>
