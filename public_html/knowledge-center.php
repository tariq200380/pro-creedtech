<?php
$page_title = "Enterprise Knowledge Center & Tech Intelligence | Creed Tech";
$page_description = "Curated technical research, engineering blueprints, system architecture patterns, and enterprise technology analysis from Creed Tech.";
$active_page = "knowledge-center";

// Load live verified news cache
$liveNewsCache = json_decode(@file_get_contents(__DIR__ . '/data/live_news_cache.json'), true) ?: [];
$breakingNews  = $liveNewsCache['breaking_news'] ?? [];
$brandWires    = $liveNewsCache['brand_wires'] ?? [];
$regionalWires = $liveNewsCache['regional_wires'] ?? [];

include __DIR__ . '/includes/header.php';
?>

<style>
/* Modern Knowledge Center Design System - Fluid High-Res Studio */
.kc-page {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  color: #0F172A;
  background: #FAFAFC;
  overflow-x: hidden;
  width: 100%;
}

/* 1. Hero Section (Desktop Spacious & Grand) */
.kc-hero-section {
  width: 100%;
  background: #070D1E;
  color: #fff;
  padding: 5rem 0 5.5rem;
  position: relative;
  overflow: hidden;
  border-bottom: 1px solid #1F2937;
}

.kc-container {
  width: 100%;
  max-width: 1440px;
  margin: 0 auto;
  padding: 0 24px;
  box-sizing: border-box;
}

@media (max-width: 768px) {
  .kc-container {
    padding: 0 16px;
  }
  .kc-hero-section {
    padding: 2.75rem 0 3rem;
  }
}

/* 3-Column Studio Grid */
.kc-reader-grid {
  display: grid;
  grid-template-columns: 240px minmax(0, 1fr) 300px;
  gap: 24px;
  align-items: start;
  width: 100%;
}

.kc-overview-grid {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 300px;
  gap: 28px;
  align-items: start;
  width: 100%;
}

/* Responsive Structural Grids */
.kc-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 2rem;
  align-items: center;
  width: 100%;
}

.kc-news-grid {
  display: grid;
  grid-template-columns: 7.5fr 4.5fr;
  gap: 2rem;
  align-items: start;
  width: 100%;
}

.kc-wire-card-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 2rem;
  align-items: stretch;
  width: 100%;
}

.kc-dontmiss-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  width: 100%;
}

.kc-prod-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 24px;
  align-items: center;
  width: 100%;
}

.kc-procon-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  width: 100%;
}

.kc-modal-form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  width: 100%;
}

/* Image Box Containers with True 16:9 Landscape Proportions (Zero Padding / Full Cover Fit) */
.kc-main-news-visual {
  position: relative;
  width: 100%;
  aspect-ratio: 16 / 9;
  border-radius: 12px;
  background: #0B1120;
  overflow: hidden;
}
.kc-wire-visual {
  position: relative;
  width: 100%;
  height: 100%;
  min-height: 260px;
  aspect-ratio: 16 / 9;
  border-radius: 12px;
  overflow: hidden;
  background: #0F172A;
}
.kc-reg-visual {
  position: relative;
  width: 100%;
  height: 100%;
  min-height: 260px;
  aspect-ratio: 16 / 9;
  border-radius: 12px;
  overflow: hidden;
  background: #064E3B;
}
.kc-main-news-visual img,
.kc-wire-visual img,
.kc-reg-visual img,
#wireImg,
#regImg {
  display: block !important;
  width: 100% !important;
  height: 100% !important;
  min-width: 100% !important;
  min-height: 100% !important;
  max-width: none !important;
  max-height: none !important;
  object-fit: cover !important;
  object-position: center !important;
  border-radius: 12px !important;
  margin: 0 !important;
  padding: 0 !important;
}

.kc-reader-main {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 14px;
  padding: 20px 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

@media (min-width: 640px) {
  .kc-reader-main {
    padding: 36px 42px;
  }
}

@media (max-width: 1200px) {
  .kc-reader-grid {
    grid-template-columns: 210px minmax(0, 1fr) 260px;
    gap: 16px;
  }
  .kc-overview-grid {
    grid-template-columns: minmax(0, 1fr) 260px;
    gap: 20px;
  }
}

@media (max-width: 1024px) {
  .kc-hero-grid,
  .kc-news-grid,
  .kc-wire-card-grid,
  .kc-dontmiss-grid,
  .kc-prod-grid,
  .kc-procon-grid {
    grid-template-columns: 1fr !important;
    gap: 1.5rem !important;
  }
}

@media (max-width: 960px) {
  .kc-reader-grid {
    grid-template-columns: 1fr;
  }
  .kc-overview-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 640px) {
  .kc-modal-form-grid {
    grid-template-columns: 1fr !important;
  }
}

/* Sidebar & Navigation Styles */
.kc-sidebar-item {
  display: flex;
  flex-direction: column;
  gap: 3px;
  padding: 10px 12px;
  border-radius: 8px;
  border: 1px solid #E2E8F0;
  background: #FFFFFF;
  cursor: pointer;
  transition: all 0.15s ease;
  text-align: left;
  width: 100%;
  box-sizing: border-box;
}
.kc-sidebar-item:hover {
  background: #F1F5F9;
  border-color: #CBD5E1;
}
.kc-sidebar-item.active {
  background: #EFF6FF;
  border-color: #0052FF;
  box-shadow: 0 2px 6px rgba(0, 82, 255, 0.12);
}
.kc-sidebar-item.active h5 {
  color: #0052FF !important;
}

/* Audio Player */
.spd-btn {
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.15s ease;
}

/* Topic / Wire Tabs */
.tab-active {
  background: #0052FF !important;
  color: #FFFFFF !important;
  box-shadow: 0 4px 10px rgba(0, 82, 255, 0.3) !important;
}

/* Pros and Cons */
.pro-con-card {
  border-radius: 8px;
  padding: 16px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
</style>

<div class="kc-page" style="width:100%;text-align:left;">
  
  <!-- ================= 1. HERO SECTION: LIVE TELEMETRY & BREAKING TECH HEADLINES ================= -->
  <section class="kc-hero-section">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 20% 40%, rgba(0, 102, 255, 0.25) 0%, transparent 60%), radial-gradient(circle at 80% 60%, rgba(255, 107, 0, 0.15) 0%, transparent 55%);"></div>
    <div style="position:absolute;inset:0;opacity:0.15;pointer-events:none;background-image:linear-gradient(to right, rgba(0, 150, 255, 0.2) 1px, transparent 1px), linear-gradient(to bottom, rgba(0, 150, 255, 0.2) 1px, transparent 1px);background-size:40px 40px;"></div>

    <div class="kc-container" style="position:relative;z-index:10;">
      <div class="kc-hero-grid">
        
        <!-- Left Telemetry Visuals -->
        <div style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.12);border-radius:1rem;padding:1.75rem 2rem;backdrop-filter:blur(12px);box-shadow:0 20px 40px -15px rgba(0,0,0,0.6);">
          
          <div style="margin-bottom:1.25rem;padding-bottom:1.25rem;border-bottom:1px solid rgba(255,255,255,0.12);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
              <span style="font-size:0.75rem;font-weight:800;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.06em;">Visitors</span>
              <div style="display:flex;align-items:center;gap:8px;font-size:0.75rem;color:#22D3EE;font-family:monospace;">
                <span>48 hours</span>
                <span style="color:#6B7280;">|</span>
                <span>48 hrs</span>
                <span style="color:#fff;font-weight:800;font-size:0.8rem;background:rgba(37,99,235,0.4);padding:2px 8px;border-radius:3px;border:1px solid rgba(37,99,235,0.6);">78 M</span>
              </div>
            </div>

            <!-- SVG Waveform Graph -->
            <div style="width:100%;height:4.5rem;position:relative;">
              <svg style="width:100%;height:100%;" viewBox="0 0 400 80" fill="none">
                <path d="M0 40 Q50 10 100 40 T200 40 T300 40 T400 30" stroke="#00A3FF" stroke-width="2.5" stroke-linecap="round" />
                <path d="M0 50 Q60 25 120 50 T240 50 T360 45 T400 40" stroke="#0066FF" stroke-width="1.75" stroke-opacity="0.5" />
                <circle cx="100" cy="40" r="5" fill="#00A3FF" opacity="0.6">
                  <animate attributeName="r" values="3;6;3" dur="2s" repeatCount="indefinite"/>
                  <animate attributeName="opacity" values="0.8;0.2;0.8" dur="2s" repeatCount="indefinite"/>
                </circle>
                <circle cx="100" cy="40" r="3" fill="#FFFFFF" />
                <circle cx="300" cy="40" r="3" fill="#00A3FF" />
              </svg>
            </div>
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;align-items:center;">
            <div>
              <span style="font-size:11px;color:#9CA3AF;font-weight:700;display:block;margin-bottom:4px;text-transform:uppercase;letter-spacing:0.04em;">/Icce Visitors</span>
              <span style="font-size:1.85rem;font-weight:800;color:#fff;letter-spacing:-0.03em;display:block;line-height:1;">142</span>
              <span style="font-size:0.75rem;color:#9CA3AF;font-weight:500;margin-top:4px;display:block;">Top Articles</span>
            </div>

            <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;">
              <div style="text-align:right;">
                <span style="font-size:0.75rem;color:#9CA3AF;display:block;font-weight:700;text-transform:uppercase;">Top Articles</span>
                <span style="font-size:1.65rem;font-weight:800;color:#22D3EE;line-height:1.2;">73%</span>
              </div>
              <div style="width:2.5rem;height:2.5rem;border-radius:0;border:3px solid rgba(34,211,238,0.25);border-top-color:#22D3EE;border-right-color:#22D3EE;display:flex;align-items:center;justify-content:center;">
                <div style="width:7px;height:7px;background:#22D3EE;"></div>
              </div>
            </div>
          </div>

        </div>

        <!-- Right Editorial Headlines -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.25rem;">
          <div style="display:inline-flex;align-items:center;gap:8px;align-self:flex-start;padding:4px 12px;background:rgba(0,163,255,0.12);border:1px solid rgba(0,163,255,0.3);border-radius:4px;">
            <span style="width:6px;height:6px;background:#00A3FF;border-radius:50%;"></span>
            <span style="font-size:11px;font-weight:800;color:#00A3FF;text-transform:uppercase;letter-spacing:0.08em;">FLAGSHIP RESEARCH &amp; BENCHMARKS</span>
          </div>

          <h1 style="font-size:clamp(1.4rem, 2.6vw, 2.1rem);font-weight:800;color:#fff;letter-spacing:-0.03em;line-height:1.2;margin:0;">
            Enterprise Knowledge Center &amp; Tech Intelligence
          </h1>

          <div style="display:flex;flex-direction:column;gap:1rem;">
            <div style="display:flex;flex-direction:column;gap:6px;">
              <a href="blog_detail?id=1" onclick="openDynamicArticle(1, event)" style="font-size:clamp(1.25rem, 2.2vw, 1.65rem);font-weight:800;color:#fff;letter-spacing:-0.02em;line-height:1.3;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#22D3EE'" onmouseout="this.style.color='#fff'">
                The 7 Best Enterprise AI &amp; Cloud Laptops for Senior Engineers &amp; Architects
              </a>
            </div>

            <div style="display:flex;flex-direction:column;gap:6px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.12);">
              <a href="blog_detail?id=2" onclick="openDynamicArticle(2, event)" style="font-size:clamp(0.95rem, 1.5vw, 1.2rem);font-weight:600;color:#D1D5DB;letter-spacing:-0.01em;line-height:1.45;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#22D3EE'" onmouseout="this.style.color='#D1D5DB'">
                Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI
              </a>
            </div>
          </div>

          <div style="padding-top:0.25rem;">
            <span style="font-size:0.9rem;font-weight:800;letter-spacing:0.12em;color:#22D3EE;text-transform:uppercase;text-shadow:0 0 10px rgba(0,163,255,0.35);display:inline-flex;align-items:center;gap:6px;">
              ⚡ AI WRITING ASSISTANT &bull; VERIFIED INTELLIGENCE
            </span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ================= 2. LATEST IT & BUSINESS NEWS SECTION ================= -->
  <section style="width:100%;padding:3.5rem 0;background:#F8FAFC;border-bottom:1px solid #E2E8F0;">
    <div class="kc-container">
      
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;padding-bottom:1rem;border-bottom:2px solid #E2E8F0;">
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
          <span style="background:#EF4444;color:#fff;font-size:10px;font-weight:800;padding:4px 8px;border-radius:2px;letter-spacing:0.08em;text-transform:uppercase;">LIVE BREAKING NEWS</span>
          <h2 style="font-size:clamp(1.3rem,2.5vw,1.65rem);font-weight:800;color:#0F172A;margin:0;letter-spacing:-0.02em;">Latest IT &amp; Business Intelligence</h2>
        </div>
        <span style="font-size:11.5px;color:#64748B;font-family:monospace;font-weight:600;">⚡ REAL-TIME ENTERPRISE RSS SYNC</span>
      </div>

      <div class="kc-news-grid">
        
        <!-- Left Main Breaking Card (Interactive) -->
        <?php 
          $mainItem = !empty($breakingNews) ? $breakingNews[0] : [
            'tag' => 'GOOGLE AI & DEVICES',
            'date' => 'Google The Keyword (Live RSS)',
            'source' => 'Google The Keyword',
            'title' => 'Tap into the power of Gemini in Chrome on Android.',
            'desc' => 'Gemini in Chrome is now available to all Android users in the U.S.',
            'link' => 'https://blog.google/products-and-platforms/products/chrome/gemini-in-chrome-android-auto-browse/',
            'img' => 'uploads/live_news/google_gemini_chrome_hero.png'
          ];
        ?>
        <div id="mainNewsCard" style="background:#fff;border:1px solid #E2E8F0;border-radius:1rem;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);display:flex;flex-direction:column;width:100%;">
          <div class="kc-main-news-visual">
            <img id="mainNewsImg" src="<?= htmlspecialchars($mainItem['img'] ?? 'uploads/live_news/google_gemini_chrome_hero.png') ?>" alt="<?= htmlspecialchars(!empty($mainItem['title']) ? $mainItem['title'] : 'Tech News Intelligence') ?>" width="800" height="450" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
            <span id="mainNewsTag" style="position:absolute;top:1rem;left:1rem;background:#0052FF;color:#fff;font-size:10.5px;font-weight:700;padding:4px 10px;border-radius:2px;text-transform:uppercase;letter-spacing:0.05em;"><?= htmlspecialchars($mainItem['tag'] ?? 'GOOGLE AI & DEVICES') ?></span>
          </div>
          <div style="padding:1.5rem;">
            <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:#64748B;margin-bottom:8px;flex-wrap:wrap;">
              <span id="mainNewsDate"><?= htmlspecialchars($mainItem['date'] ?? '') ?></span>
              <span>•</span>
              <span id="mainNewsSource"><?= htmlspecialchars($mainItem['source'] ?? 'Google The Keyword (Live RSS)') ?></span>
            </div>
            <h3 id="mainNewsTitle" style="font-size:clamp(1.2rem,2.2vw,1.5rem);font-weight:800;color:#0F172A;line-height:1.35;margin:0 0 10px;"><?= htmlspecialchars($mainItem['title'] ?? '') ?></h3>
            <p id="mainNewsDesc" style="font-size:0.92rem;color:#475569;line-height:1.65;margin:0 0 16px;"><?= htmlspecialchars($mainItem['desc'] ?? '') ?></p>
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
              <a id="mainNewsLink" href="<?= htmlspecialchars($mainItem['link'] ?? '#') ?>" target="_blank" rel="noopener noreferrer" style="font-size:13px;font-weight:700;color:#0052FF;text-decoration:none;">Read Full Wire &rarr;</a>
              <span style="font-size:11px;color:#94A3B8;font-family:monospace;">VERIFIED BY LABS</span>
            </div>
          </div>
        </div>

        <!-- Right 6 Stacked Stories (Clickable to switch left card) -->
        <div id="sideNewsContainer" style="display:flex;flex-direction:column;gap:0.75rem;width:100%;">
          <?php 
            $providerBadges = [
              'apple'        => ['color' => '#0284C7', 'label' => '🍎 APPLE • HARDWARE & SILICON'],
              'openai'       => ['color' => '#7C3AED', 'label' => '🤖 OPENAI • AI REASONING'],
              'nvidia'       => ['color' => '#059669', 'label' => '⚡ NVIDIA • ACCELERATED AI'],
              'anthropic'    => ['color' => '#D97706', 'label' => '🧠 ANTHROPIC • SAFETY RESEARCH'],
              'google'       => ['color' => '#0052FF', 'label' => '🌐 GOOGLE • AI & DEVICES'],
              'meta'         => ['color' => '#0081FB', 'label' => '♾️ META • OPEN SOURCE AI'],
              'microsoft'    => ['color' => '#00A4EF', 'label' => '🪟 MICROSOFT • CLOUD & COPILOT'],
              'intel'        => ['color' => '#0071C5', 'label' => '🔷 INTEL • NEXT-GEN SILICON'],
              'dawn'         => ['color' => '#059669', 'label' => '🇵🇰 DAWN • TECH & SCIENCE'],
              'brecorder'    => ['color' => '#0284C7', 'label' => '🇵🇰 B-RECORDER • FINTECH'],
              'propakistani' => ['color' => '#D97706', 'label' => '🇵🇰 PROPAKISTANI • DIGITAL ECOSYSTEM'],
              'tribune'      => ['color' => '#DC2626', 'label' => '🇵🇰 TRIBUNE • AEROSPACE & TECH']
            ];
            for ($i = 1; $i < min(7, count($breakingNews)); $i++): 
              $s = $breakingNews[$i];
              $pKey = strtolower($s['provider'] ?? '');
              $pBadge = $providerBadges[$pKey] ?? ['color' => '#475569', 'label' => strtoupper($pKey)];
          ?>
          <div onclick="switchMainNews(<?= $i ?>)" style="background:#fff;border:1px solid #E2E8F0;border-radius:0.65rem;padding:0.75rem 0.9rem;cursor:pointer;transition:all 0.2s;box-shadow:0 1px 3px rgba(0,0,0,0.04);width:100%;box-sizing:border-box;" onmouseover="this.style.borderColor='#0052FF';this.style.transform='translateY(-1px)'" onmouseout="this.style.borderColor='#E2E8F0';this.style.transform='none'">
            <div style="display:flex;gap:0.75rem;align-items:center;">
              <div style="width:3.75rem;height:3.75rem;border-radius:6px;overflow:hidden;background:#0B1120;flex-shrink:0;">
                <img src="<?= htmlspecialchars($s['img'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars(!empty($s['title']) ? $s['title'] : 'Enterprise Tech News Story') ?>" width="60" height="60" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
              </div>
              <div style="flex:1;min-width:0;">
                <span style="font-size:9.5px;font-weight:800;color:<?= $pBadge['color'] ?>;text-transform:uppercase;letter-spacing:0.04em;display:block;margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= $pBadge['label'] ?></span>
                <h4 style="font-size:0.84rem;font-weight:700;color:#0F172A;line-height:1.3;margin:0 0 2px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;"><?= htmlspecialchars($s['title'] ?? '') ?></h4>
                <span style="font-size:10.5px;color:#64748B;"><?= htmlspecialchars($s['date'] ?? '') ?></span>
              </div>
            </div>
          </div>
          <?php endfor; ?>
        </div>

      </div>

    </div>
  </section>

  <!-- ================= 3. BRAND TECH WIRE SECTION ================= -->
  <section style="width:100%;padding:3.5rem 0;background:#fff;border-bottom:1px solid #E2E8F0;">
    <div class="kc-container">
      
      <div style="text-align:center;max-width:48rem;margin:0 auto 2rem;">
        <div style="display:inline-flex;align-items:center;gap:6px;background:#EFF6FF;border:1px solid #BFDBFE;padding:4px 10px;border-radius:20px;margin-bottom:8px;">
          <span style="width:6px;height:6px;border-radius:50%;background:#10B981;"></span>
          <span style="font-size:10.5px;font-weight:700;color:#1E40AF;text-transform:uppercase;letter-spacing:0.06em;">LIVE 8-PROVIDER OFFICIAL RSS WIRE</span>
        </div>
        <h2 style="font-size:clamp(1.4rem,2.8vw,2.15rem);font-weight:700;color:#0F172A;letter-spacing:-0.02em;margin:0;">Frontier AI &amp; Enterprise Tech Wires</h2>
      </div>

      <!-- 8 Verified Provider Tabs -->
      <div id="intlWireTabsContainer" style="display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:8px;margin-bottom:2rem;">
        <button type="button" onclick="selectWireBrand('google')" data-provider="google" id="wireBtn-google" class="wire-tab-btn tab-active" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#0052FF;color:#fff;">
          <span>🌐</span> Google
        </button>
        <button type="button" onclick="selectWireBrand('apple')" data-provider="apple" id="wireBtn-apple" class="wire-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>🍎</span> Apple
        </button>
        <button type="button" onclick="selectWireBrand('nvidia')" data-provider="nvidia" id="wireBtn-nvidia" class="wire-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>⚡</span> NVIDIA
        </button>
        <button type="button" onclick="selectWireBrand('anthropic')" data-provider="anthropic" id="wireBtn-anthropic" class="wire-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>🧠</span> Anthropic
        </button>
        <button type="button" onclick="selectWireBrand('openai')" data-provider="openai" id="wireBtn-openai" class="wire-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>🤖</span> OpenAI
        </button>
        <button type="button" onclick="selectWireBrand('meta')" data-provider="meta" id="wireBtn-meta" class="wire-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>♾️</span> Meta
        </button>
        <button type="button" onclick="selectWireBrand('microsoft')" data-provider="microsoft" id="wireBtn-microsoft" class="wire-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>🪟</span> Microsoft
        </button>
        <button type="button" onclick="selectWireBrand('intel')" data-provider="intel" id="wireBtn-intel" class="wire-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#F1F5F9;color:#475569;">
          <span>🔷</span> Intel
        </button>
      </div>

      <?php $gw = $brandWires['google'] ?? []; ?>
      <!-- Selected Brand Story Showcase Card -->
      <div class="kc-wire-card-grid" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:1rem;padding:1.5rem;">
        <div id="wireVisualContainer" class="kc-wire-visual">
          <img id="wireImg" src="<?= htmlspecialchars($gw['img'] ?? 'uploads/live_news/google_gemini_chrome_hero.png') ?>" alt="<?= htmlspecialchars(!empty($gw['title']) ? $gw['title'] : 'Global Tech Wire Story') ?>" width="600" height="340" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
          <div style="position:absolute;top:12px;right:12px;z-index:3;">
            <span id="wireBrandBadge" style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.95);backdrop-filter:blur(8px);color:#0F172A;font-size:11px;font-weight:800;padding:4px 10px;border-radius:20px;box-shadow:0 4px 12px rgba(0,0,0,0.25);">
              <?= htmlspecialchars($gw['brandBadge'] ?? '🌐 GOOGLE') ?>
            </span>
          </div>
        </div>
        <div>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;flex-wrap:wrap;">
            <span id="wireCat" style="background:#DBEAFE;color:#1E40AF;font-size:10px;font-weight:800;padding:3px 8px;border-radius:3px;text-transform:uppercase;"><?= htmlspecialchars($gw['cat'] ?? 'GOOGLE AI & DEVICES') ?></span>
            <span id="wireDate" style="font-size:12px;color:#64748B;"><?= htmlspecialchars($gw['date'] ?? '') ?></span>
          </div>
          <h3 id="wireTitle" style="font-size:clamp(1.2rem,2.2vw,1.45rem);font-weight:800;color:#0F172A;line-height:1.35;margin:0 0 10px;"><?= htmlspecialchars($gw['title'] ?? '') ?></h3>
          <p id="wireSummary" style="font-size:0.92rem;color:#475569;line-height:1.65;margin:0 0 16px;"><?= htmlspecialchars($gw['summary'] ?? '') ?></p>
          <a id="wireSourceBtn" href="<?= htmlspecialchars($gw['link'] ?? '#') ?>" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:700;color:#0052FF;text-decoration:none;">Read Original on <span id="wireSourceName"><?= htmlspecialchars($gw['source'] ?? 'Google The Keyword') ?></span> &rarr;</a>
        </div>
      </div>

    </div>
  </section>

  <!-- ================= 4. PAKISTAN & REGIONAL TECH ECOSYSTEM WIRE SECTION ================= -->
  <section style="width:100%;padding:3.5rem 0;background:#F8FAFC;border-bottom:1px solid #E2E8F0;">
    <div class="kc-container">
      
      <div style="text-align:center;max-width:48rem;margin:0 auto 2rem;">
        <div style="display:inline-flex;align-items:center;gap:6px;background:#ECFDF5;border:1px solid #A7F3D0;padding:4px 10px;border-radius:20px;margin-bottom:8px;">
          <span style="width:6px;height:6px;border-radius:50%;background:#059669;"></span>
          <span style="font-size:10.5px;font-weight:700;color:#065F46;text-transform:uppercase;letter-spacing:0.06em;">LIVE PAKISTANI MEDIA RSS SYNC</span>
        </div>
        <h2 style="font-size:clamp(1.4rem,2.8vw,2.15rem);font-weight:700;color:#0F172A;letter-spacing:-0.02em;margin:0;">Pakistan &amp; Regional Tech Ecosystem</h2>
      </div>

      <!-- 4 Real Pakistani Tabs -->
      <div id="pakWireTabsContainer" style="display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:8px;margin-bottom:2rem;">
        <button type="button" onclick="selectRegionalTab('dawn')" data-provider="dawn" id="regBtn-dawn" class="reg-tab-btn tab-active" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#059669;color:#fff;box-shadow:0 4px 6px -1px rgba(5,150,105,0.3);">
          <span>🇵🇰</span> Dawn Sci-Tech
        </button>
        <button type="button" onclick="selectRegionalTab('brecorder')" data-provider="brecorder" id="regBtn-brecorder" class="reg-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#fff;color:#475569;border:1px solid #CBD5E1;">
          <span>📈</span> Business Recorder
        </button>
        <button type="button" onclick="selectRegionalTab('propakistani')" data-provider="propakistani" id="regBtn-propakistani" class="reg-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#fff;color:#475569;border:1px solid #CBD5E1;">
          <span>📱</span> ProPakistani
        </button>
        <button type="button" onclick="selectRegionalTab('tribune')" data-provider="tribune" id="regBtn-tribune" class="reg-tab-btn" style="display:flex;align-items:center;gap:6px;padding:7px 16px;border-radius:6px;border:none;cursor:pointer;font-weight:700;font-size:12px;background:#fff;color:#475569;border:1px solid #CBD5E1;">
          <span>🚀</span> The Express Tribune
        </button>
      </div>

      <?php $dw = $regionalWires['dawn'] ?? []; ?>
      <!-- Selected Regional Story Card -->
      <div class="kc-wire-card-grid" style="background:#fff;border:1px solid #E2E8F0;border-radius:1rem;padding:1.5rem;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
        <div id="regVisualContainer" class="kc-reg-visual">
          <img id="regImg" src="<?= htmlspecialchars($dw['image'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars(!empty($dw['title']) ? $dw['title'] : 'Regional Tech Wire Story') ?>" width="600" height="340" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
          <div style="position:absolute;top:12px;right:12px;z-index:3;">
            <span id="regBrandBadge" style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.95);backdrop-filter:blur(8px);color:#065F46;font-size:11px;font-weight:800;padding:4px 10px;border-radius:20px;box-shadow:0 4px 12px rgba(0,0,0,0.25);">
              <?= htmlspecialchars($dw['brandBadge'] ?? '🇵🇰 DAWN TECH') ?>
            </span>
          </div>
        </div>
        <div>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;flex-wrap:wrap;">
            <span id="regCat" style="background:#D1FAE5;color:#065F46;font-size:10px;font-weight:800;padding:3px 8px;border-radius:3px;text-transform:uppercase;"><?= htmlspecialchars($dw['category'] ?? 'PAKISTAN TECH & SCIENCE') ?></span>
            <span id="regDate" style="font-size:12px;color:#64748B;"><?= htmlspecialchars($dw['date'] ?? '') ?></span>
          </div>
          <h3 id="regTitle" style="font-size:clamp(1.2rem,2.2vw,1.45rem);font-weight:800;color:#0F172A;line-height:1.35;margin:0 0 10px;"><?= htmlspecialchars($dw['title'] ?? '') ?></h3>
          <p id="regSummary" style="font-size:0.92rem;color:#475569;line-height:1.65;margin:0 0 16px;"><?= htmlspecialchars($dw['summary'] ?? '') ?></p>
          <a id="regSourceBtn" href="<?= htmlspecialchars($dw['sourceUrl'] ?? '#') ?>" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:700;color:#059669;text-decoration:none;">Read Original on <span id="regSourceName"><?= htmlspecialchars($dw['sourceName'] ?? 'Dawn Sci-Tech') ?></span> &rarr;</a>
        </div>
      </div>

    </div>
  </section>


  <!-- ================= 5. MAIN EDITORIAL & DYNAMIC STUDIO READER SECTION ================= -->
  <section style="width:100%;padding:3rem 0 3.5rem;">
    <div class="kc-container">
      
      <!-- ========================================================================= -->
      <!-- VIEW A: DYNAMIC 3-COLUMN STUDIO READER (Shown when an article is active)  -->
      <!-- ========================================================================= -->
      <div id="kcReaderLayout" style="display:none;">
        
        <!-- Breadcrumb / Return Navigation Bar -->
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;padding-bottom:18px;margin-bottom:28px;border-bottom:2px solid #E2E8F0;">
          <div style="display:flex;align-items:center;gap:10px;font-size:13px;color:#64748B;">
            <button onclick="closeDynamicArticle()" style="padding:8px 18px;background:#0F172A;color:#FFFFFF;border:none;border-radius:6px;font-size:12.5px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 2px 6px rgba(0,0,0,0.15);transition:background 0.2s;" onmouseover="this.style.background='#1E293B'" onmouseout="this.style.background='#0F172A'">
              &larr; Back to Grid Overview
            </button>
            <span>/</span>
            <span id="readerBreadcrumbCat" style="color:#0052FF;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;">HARDWARE &amp; AI</span>
          </div>
          <button onclick="shareActiveArticle('copy')" style="padding:7px 14px;background:#FFFFFF;border:1px solid #CBD5E1;border-radius:6px;font-size:12px;font-weight:700;color:#334155;cursor:pointer;">
            🔗 Copy Direct Link
          </button>
        </div>

        <!-- Responsive 3-Column Studio Grid -->
        <div class="kc-reader-grid">
          
          <!-- COLUMN 1: LEFT NAVIGATOR (Sticky) -->
          <aside style="position:sticky;top:85px;display:flex;flex-direction:column;gap:16px;max-height:85vh;overflow-y:auto;padding-right:4px;">
            <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:10px;padding:16px;box-shadow:0 1px 3px rgba(0,0,0,0.02);">
              <div style="font-size:11px;font-weight:800;color:#0052FF;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">
                📚 ALL ARTICLES &amp; BLUEPRINTS
              </div>
              <input type="text" oninput="filterSidebarArticles(this.value)" placeholder="Search articles..." style="width:100%;padding:8px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:12px;box-sizing:border-box;outline:none;background:#F8FAFC;">
            </div>

            <div style="display:flex;flex-direction:column;gap:8px;" id="sidebarArticlesList">
              <!-- Populated via JS -->
            </div>

            <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:10px;padding:16px;box-shadow:0 1px 3px rgba(0,0,0,0.02);">
              <div style="font-size:11px;font-weight:800;color:#EF4444;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">
                ⚡ BREAKING BRAND WIRES
              </div>
              <div style="display:flex;flex-direction:column;gap:6px;" id="sidebarBrandWiresList">
                <?php 
                  $sbBrands = ['google' => '🌐', 'anthropic' => '🧠', 'openai' => '🤖', 'nvidia' => '⚡', 'microsoft' => '🪟'];
                  foreach ($sbBrands as $sbKey => $sbIcon):
                    $sbItem = $brandWires[$sbKey] ?? [];
                    $sbTitle = $sbItem['title'] ?? ucfirst($sbKey);
                    $sbCat = $sbItem['cat'] ?? ($sbItem['source'] ?? (strtoupper($sbKey) . ' WIRE'));
                ?>
                <button type="button" onclick="selectWireBrand('<?= $sbKey ?>')" class="kc-sidebar-item" style="border:none;padding:8px 10px;text-align:left;width:100%;cursor:pointer;">
                  <span style="color:#0052FF;font-weight:700;font-size:12px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:block;"><?= $sbIcon ?> <?= htmlspecialchars($sbTitle) ?></span>
                  <span style="font-size:10.5px;color:#64748B;display:block;"><?= htmlspecialchars($sbCat) ?></span>
                </button>
                <?php endforeach; ?>
              </div>
            </div>
          </aside>

          <!-- COLUMN 2: EXPANSIVE CENTER READING STUDIO -->
          <main class="kc-reader-main">
            
            <div style="margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid #E2E8F0;">
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;flex-wrap:wrap;">
                <span id="readerCatBadge" style="background:#EF4444;color:#fff;font-size:10px;font-weight:800;padding:3px 10px;border-radius:3px;text-transform:uppercase;">
                  LABS BENCHMARK
                </span>
                <span style="font-size:12px;color:#64748B;">•</span>
                <span id="readerDate" style="font-size:12px;color:#64748B;">Aug 16, 2026</span>
                <span style="font-size:12px;color:#64748B;">•</span>
                <span id="readerReadTime" style="font-size:12px;color:#64748B;font-weight:600;">⏱️ 18 min read</span>
              </div>

              <h2 id="readerTitle" style="font-size:clamp(1.85rem, 3vw, 2.5rem);font-weight:800;color:#0F172A;line-height:1.25;margin:0 0 16px;letter-spacing:-0.02em;">
                Article Title
              </h2>

              <div style="display:flex;align-items:center;gap:12px;">
                <div style="width:42px;height:42px;border-radius:50%;background:#0052FF;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:15px;box-shadow:0 2px 6px rgba(0,82,255,0.3);">
                  CT
                </div>
                <div>
                  <div id="readerAuthor" style="font-size:14px;font-weight:700;color:#0F172A;">Dr. Sarah Jenkins</div>
                  <div style="font-size:12px;color:#64748B;">Senior Hardware Benchmarking &amp; Architecture Lead</div>
                </div>
              </div>
            </div>

            <!-- Editors Note -->
            <div id="readerEditorsNoteBox" style="background:#FFF5F5;border-left:5px solid #E11D48;padding:16px 20px;border-radius:0 8px 8px 0;margin-bottom:24px;">
              <div style="font-size:11px;font-weight:800;color:#E11D48;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">
                EDITORS' NOTE &amp; LABS METHODOLOGY
              </div>
              <p id="readerEditorsNote" style="font-size:13.5px;color:#334155;line-height:1.65;margin:0;font-style:italic;">
                Editors note text...
              </p>
            </div>

            <!-- Intro Paragraphs -->
            <div id="readerIntroParagraphs" style="font-size:15px;color:#334155;line-height:1.8;margin-bottom:28px;">
              <!-- Injected via JS -->
            </div>

            <!-- Audio Player -->
            <div style="background:#0F172A;color:#fff;border-radius:10px;padding:20px 24px;margin-bottom:28px;border:1px solid #1E293B;">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;flex-wrap:wrap;gap:6px;">
                <span style="font-size:13.5px;font-weight:700;color:#F8FAFC;">🎧 Audio Briefing Podcast &amp; Teardown</span>
                <span style="font-size:11px;color:#94A3B8;font-family:monospace;">Studio 96kHz Master</span>
              </div>

              <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
                <audio id="readerAudioPlayer" src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" preload="metadata"></audio>
                <button id="readerPlayBtn" onclick="toggleReaderAudio()" style="width:40px;height:40px;border-radius:50%;background:#0052FF;color:#fff;border:none;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,82,255,0.4);">
                  ▶
                </button>
                <div style="flex:1;min-width:180px;display:flex;flex-direction:column;gap:3px;">
                  <input type="range" id="readerScrubber" min="0" max="100" value="0" style="width:100%;cursor:pointer;accent-color:#0052FF;" oninput="seekReaderAudio(this.value)">
                  <div style="display:flex;justify-content:space-between;font-size:11px;color:#94A3B8;font-family:monospace;">
                    <span id="readerCurTime">00:00</span>
                    <span id="readerDurTime">12:15</span>
                  </div>
                </div>
                <div style="display:flex;align-items:center;gap:6px;">
                  <button onclick="setReaderSpeed(1.0)" class="spd-btn" id="readerSpd-1" style="background:#0052FF;color:#fff;border:1px solid #0052FF;">1.0x</button>
                  <button onclick="setReaderSpeed(1.5)" class="spd-btn" id="readerSpd-15" style="background:#1E293B;color:#94A3B8;border:1px solid #334155;">1.5x</button>
                  <button onclick="setReaderSpeed(2.0)" class="spd-btn" id="readerSpd-2" style="background:#1E293B;color:#94A3B8;border:1px solid #334155;">2.0x</button>
                </div>
              </div>
            </div>

            <!-- Video Embed -->
            <div style="background:#000;border-radius:10px;overflow:hidden;margin-bottom:32px;position:relative;padding-bottom:56.25%;height:0;">
              <iframe id="readerVideoIframe" style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;" src="https://www.youtube.com/embed/dQw4w9WgXcQ?controls=1" allowfullscreen></iframe>
            </div>

            <!-- Products Breakdown -->
            <div id="readerProductsContainer" style="display:flex;flex-direction:column;gap:32px;">
              <!-- Populated via JS -->
            </div>

            <!-- DEDICATED POST-SPECIFIC REVIEWS & PEER DISCUSSION SECTION -->
            <section id="postReviewsSection" style="margin-top:40px;padding-top:32px;border-top:2px solid #F1F5F9;">
              
              <!-- Header with Add Review Button -->
              <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid #E2E8F0;">
                <div>
                  <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                    <span style="font-size:10px;font-weight:800;color:#0052FF;background:#EFF6FF;padding:3px 8px;border-radius:3px;text-transform:uppercase;letter-spacing:0.06em;">VERIFIED PEER REVIEWS</span>
                    <span style="font-size:12px;color:#64748B;">•</span>
                    <span style="font-size:12.5px;color:#059669;font-weight:700;">★★★★★ 5.0 / 5.0 (Peer Rated)</span>
                  </div>
                  <h3 style="font-size:1.35rem;font-weight:800;color:#0F172A;margin:0;">
                    Peer Reviews on this Research Post
                  </h3>
                </div>

                <button onclick="openAddReviewModal()" style="padding:9px 18px;background:#0052FF;color:#FFFFFF;border:none;border-radius:6px;font-size:12.5px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:6px;box-shadow:0 2px 8px rgba(0,82,255,0.25);transition:all 0.2s;" onmouseover="this.style.background='#0043CC'" onmouseout="this.style.background='#0052FF'">
                  ✍️ Add Review
                </button>
              </div>

              <!-- 3 Top Verified Reviews for THIS Post -->
              <div id="postReviewsList" style="display:flex;flex-direction:column;gap:16px;">
                <!-- Populated dynamically via JS for the active post -->
              </div>

            </section>

          </main>

          <!-- COLUMN 3: RIGHT SIDEBAR (In Reader Mode) -->
          <aside style="display:flex;flex-direction:column;gap:2rem;text-align:left;">
            <!-- WIDGET 1: TOP STORIES -->
            <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
                <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Top Stories</h4>
                <div style="display:flex;align-items:center;gap:6px;">
                  <button type="button" onclick="prevTopStories()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">‹</button>
                  <button type="button" onclick="nextTopStories()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">›</button>
                </div>
              </div>

              <div class="sidebar-top-stories-list" style="display:flex;flex-direction:column;gap:1rem;transition:opacity 0.25s ease;">
                
                <a href="blog_detail?id=1" onclick="openDynamicArticle(1, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;">
                  <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#1E293B;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                    💻
                  </div>
                  <div>
                    <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">The 7 Best Enterprise AI &amp; Cloud Laptops in 2026</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">15-Aug-2026</span>
                  </div>
                </a>

                <a href="blog_detail?id=2" onclick="openDynamicArticle(2, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
                  <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                    🤖
                  </div>
                  <div>
                    <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Artificial Intelligence Development: Modern AI Foundations</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">18-Aug-2026</span>
                  </div>
                </a>

                <a href="blog_detail?id=3" onclick="openDynamicArticle(3, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
                  <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#0F766E;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                    📈
                  </div>
                  <div>
                    <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Growth &amp; High-Throughput Cloud Scaling</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2026</span>
                  </div>
                </a>

              </div>
            </div>

            <!-- WIDGET 2: SPECIAL FEATURE (WATCH NOW VIDEO MODAL) -->
            <div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
              <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#4ADE80,#22D3EE,#3B82F6);"></div>
              <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
              <p style="font-size:12.5px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Watch our exclusive video briefings &amp; live architecture teardowns.</p>
              <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
            </div>

            <!-- WIDGET 3: NEWEST VIDEOS -->
            <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
                <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Newest Videos</h4>
                <div style="display:flex;align-items:center;gap:6px;">
                  <button type="button" onclick="prevVideos()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">‹</button>
                  <button type="button" onclick="nextVideos()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">›</button>
                </div>
              </div>

              <div class="sidebar-videos-list" style="display:flex;flex-direction:column;gap:1rem;transition:opacity 0.25s ease;">
                
                <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                  <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                    ▶
                  </div>
                  <div>
                    <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">WHAT ARE SOCIAL ADVERTISING?</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2024</span>
                  </div>
                </div>

                <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                  <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                    ▶
                  </div>
                  <div>
                    <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">ENTERPRISE AI ARCHITECTURE</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">18-Apr-2024</span>
                  </div>
                </div>

                <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                  <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                    ▶
                  </div>
                  <div>
                    <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">HYBRID CLOUD DEVOPS TEARDOWN</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">12-May-2024</span>
                  </div>
                </div>

              </div>
            </div>

            <!-- WIDGET 4: SPECIAL FEATURE 2 -->
            <div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
              <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#FB923C,#EF4444,#EC4899);"></div>
              <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
              <p style="font-size:12.5px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Explore our high-throughput AI infrastructure benchmarks.</p>
              <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
            </div>

            <!-- WIDGET 5: UPCOMING EVENTS -->
            <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
                <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Upcoming Events</h4>
                <div style="display:flex;align-items:center;gap:6px;">
                  <button type="button" onclick="prevEvents()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">‹</button>
                  <button type="button" onclick="nextEvents()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">›</button>
                </div>
              </div>

              <div class="sidebar-events-list" style="display:flex;flex-direction:column;gap:1rem;transition:opacity 0.25s ease;">
                
                <div onclick="openEventModal('International Conference on World Cloud Architecture')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                  <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">13</span>
                    <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">APR</span>
                  </div>
                  <div>
                    <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Conference on World Cloud Architecture</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2026</span>
                  </div>
                </div>

                <div onclick="openEventModal('Global AI & Autonomous Agents Summit 2026')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                  <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">28</span>
                    <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">MAY</span>
                  </div>
                  <div>
                    <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Global AI &amp; Autonomous Agents Summit 2026</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">28-May-2026</span>
                  </div>
                </div>

                <div onclick="openEventModal('Enterprise Cybersecurity & Threat Modeling Workshop')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                  <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                    <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">15</span>
                    <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">JUN</span>
                  </div>
                  <div>
                    <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Enterprise Cybersecurity &amp; Threat Modeling Workshop</h5>
                    <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">15-Jun-2026</span>
                  </div>
                </div>

              </div>
            </div>
          </aside>

        </div>

      </div>


      <!-- ========================================================================= -->
      <!-- VIEW B: DEFAULT OVERVIEW GRID (Don't Miss, Topic Filters, What's Trending) -->
      <!-- ========================================================================= -->
      <div id="kcOverviewLayout" class="kc-overview-grid">
        
        <!-- LEFT 1FR COLUMN (Don't Miss, Topics, Trending) -->
        <div style="display:flex;flex-direction:column;gap:3rem;text-align:left;">
          
          <!-- DON'T MISS SECTION -->
          <div>
            <div style="border-bottom:2px solid #030712;padding-bottom:0.5rem;margin-bottom:1.5rem;display:inline-block;">
              <h3 style="font-size:1.35rem;font-weight:800;color:#030712;margin:0;">Don't Miss</h3>
            </div>

            <div class="kc-dontmiss-grid">
              
              <!-- Card 1 -->
              <a href="blog_detail?id=2" onclick="openDynamicArticle(2, event)" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'">
                <div style="width:100%;height:13rem;background:linear-gradient(135deg,#111827,#1E293B,#000);display:flex;align-items:center;justify-content:center;padding:1rem;text-align:center;">
                  <div>
                    <div style="width:3.5rem;height:3.5rem;margin:0 auto 0.5rem;border-radius:8px;background:rgba(37,99,235,0.3);border:1px solid rgba(96,165,250,0.4);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                      🤖
                    </div>
                    <span style="font-size:11.5px;font-family:monospace;color:#67E8F9;letter-spacing:0.05em;">AI RESEARCH ARCHIVE</span>
                  </div>
                </div>
                <div style="padding:1.25rem;">
                  <h4 style="font-size:1rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI Research</h4>
                </div>
              </a>

              <!-- Card 2 -->
              <a href="blog_detail?id=3" onclick="openDynamicArticle(3, event)" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.05);transition:all 0.2s;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'">
                <div style="width:100%;height:13rem;background:linear-gradient(135deg,#064E3B,#134E4A,#0F172A);display:flex;align-items:center;justify-content:center;padding:1rem;text-align:center;">
                  <div>
                    <div style="width:3.5rem;height:3.5rem;margin:0 auto 0.5rem;border-radius:8px;background:rgba(16,185,129,0.3);border:1px solid rgba(52,211,153,0.4);display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                      ⚡
                    </div>
                    <span style="font-size:11.5px;font-family:monospace;color:#6EE7B7;letter-spacing:0.05em;">CLOUD ORCHESTRATION</span>
                  </div>
                </div>
                <div style="padding:1.25rem;">
                  <h4 style="font-size:1rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Cloud Native Microservices Architecture: A Deep Dive into Kubernetes</h4>
                </div>
              </a>

            </div>
          </div>

          <!-- TOPIC DIRECTORY & FILTER SECTION (SEPARATE SECTION) -->
          <div style="background:#FFFFFF;border:1px solid #E5E7EB;border-radius:1rem;padding:1.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #F1F5F9;">
              <div>
                <span style="font-size:10.5px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:2px;">CATEGORY DIRECTORY</span>
                <h3 style="font-size:1.25rem;font-weight:800;color:#0F172A;margin:0;">Discover Articles by Topic</h3>
              </div>
              
              <!-- Topic Pills Filter Row -->
              <div style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;">
                <button onclick="filterTopic('ALL')" id="topicBtn-ALL" style="padding:6px 14px;font-size:12px;font-weight:700;border:none;cursor:pointer;border-radius:4px;background:#0052FF;color:#fff;transition:all 0.15s;">ALL</button>
                <button onclick="filterTopic('SEO')" id="topicBtn-SEO" style="padding:6px 14px;font-size:12px;font-weight:600;border:none;cursor:pointer;border-radius:4px;background:#F1F5F9;color:#475569;transition:all 0.15s;">SEO</button>
                <button onclick="filterTopic('Hosting')" id="topicBtn-Hosting" style="padding:6px 14px;font-size:12px;font-weight:600;border:none;cursor:pointer;border-radius:4px;background:#F1F5F9;color:#475569;transition:all 0.15s;">Hosting</button>
                <button onclick="filterTopic('Social')" id="topicBtn-Social" style="padding:6px 14px;font-size:12px;font-weight:600;border:none;cursor:pointer;border-radius:4px;background:#F1F5F9;color:#475569;transition:all 0.15s;">Social</button>
                <button onclick="filterTopic('AI & Cloud')" id="topicBtn-AI & Cloud" style="padding:6px 14px;font-size:12px;font-weight:600;border:none;cursor:pointer;border-radius:4px;background:#F1F5F9;color:#475569;transition:all 0.15s;">AI &amp; Cloud</button>
                <button onclick="filterTopic('DevOps')" id="topicBtn-DevOps" style="padding:6px 14px;font-size:12px;font-weight:600;border:none;cursor:pointer;border-radius:4px;background:#F1F5F9;color:#475569;transition:all 0.15s;">DevOps</button>
              </div>
            </div>

            <!-- Topic Cards Grid (Filtered Strictly by topicBtn) -->
            <div id="topicCardsGrid" style="display:grid;grid-template-columns:repeat(auto-fill, minmax(230px, 1fr));gap:1.25rem;">
              
              <!-- Hosting Cards -->
              <a href="blog_detail?id=3" onclick="openDynamicArticle(3, event)" class="topic-card-item" data-topic="Hosting" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#92400E,#7C2D12,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;text-transform:uppercase;font-weight:700;">CLOUD HOSTING</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Cloud Native Microservices Architecture &amp; Hosting</h5>
                </div>
              </a>

              <a href="blog_detail?id=3" onclick="openDynamicArticle(3, event)" class="topic-card-item" data-topic="Hosting" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#78350F,#451A03,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;text-transform:uppercase;font-weight:700;">INFRASTRUCTURE</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">High-Throughput Kubernetes Clusters &amp; Global Edge</h5>
                </div>
              </a>

              <!-- AI & Cloud Cards -->
              <a href="blog_detail?id=1" onclick="openDynamicArticle(1, event)" class="topic-card-item" data-topic="AI & Cloud" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#1E293B,#0F172A,#000);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#38BDF8;text-transform:uppercase;font-weight:700;">AI HARDWARE</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">The 7 Best Enterprise AI &amp; Cloud Laptops</h5>
                </div>
              </a>

              <a href="blog_detail?id=2" onclick="openDynamicArticle(2, event)" class="topic-card-item" data-topic="AI & Cloud" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#312E81,#1E1B4B,#0F172A);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#A5B4FC;text-transform:uppercase;font-weight:700;">NEURAL ARCHITECTURE</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Early Perceptrons &amp; Symbolic Reasoning in LLMs</h5>
                </div>
              </a>

              <!-- SEO Cards -->
              <a href="blog_detail?id=1" onclick="openDynamicArticle(1, event)" class="topic-card-item" data-topic="SEO" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#047857,#064E3B,#06281E);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#6EE7B7;text-transform:uppercase;font-weight:700;">TECHNICAL SEO</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Enterprise Technical SEO &amp; Core Web Vitals</h5>
                </div>
              </a>

              <!-- Social Cards -->
              <a href="blog_detail?id=2" onclick="openDynamicArticle(2, event)" class="topic-card-item" data-topic="Social" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#BE123C,#881337,#4C0519);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDA4AF;text-transform:uppercase;font-weight:700;">DIGITAL SOCIAL</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Social Engineering Defense &amp; Enterprise Trust</h5>
                </div>
              </a>

              <!-- DevOps Cards -->
              <a href="blog_detail?id=3" onclick="openDynamicArticle(3, event)" class="topic-card-item" data-topic="DevOps" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#4338CA,#312E81,#1E1B4B);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#C7D2FE;text-transform:uppercase;font-weight:700;">GITOPS &amp; K8S</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Automated CI/CD GitOps with ArgoCD &amp; Helm</h5>
                </div>
              </a>

            </div>
          </div>

          <!-- WHAT'S TRENDING SECTION (PERMANENT & SEPARATE, NEVER FILTERED) -->
          <div style="background:#FFFFFF;border:1px solid #E5E7EB;border-radius:1rem;padding:1.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.04);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #F1F5F9;">
              <div>
                <span style="font-size:10.5px;font-weight:700;color:#EF4444;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:2px;">🔥 VIRAL INTELLIGENCE</span>
                <h3 style="font-size:1.25rem;font-weight:800;color:#0F172A;margin:0;">What's Trending Across Labs</h3>
              </div>
              <span style="font-size:11.5px;color:#64748B;font-family:monospace;">UPDATED HOURLY</span>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(230px, 1fr));gap:1.25rem;">
              
              <!-- Trending 1 -->
              <a href="blog_detail?id=2" onclick="openDynamicArticle(2, event)" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#0F172A,#111827,#000);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#67E8F9;font-weight:700;">HISTORICAL AI</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Artificial Intelligence Development from 1950 to 1965: Foundations</h5>
                </div>
              </a>

              <!-- Trending 2 -->
              <a href="blog_detail?id=1" onclick="openDynamicArticle(1, event)" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;display:flex;flex-direction:column;justify-content:space-between;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#EFF6FF,#EEF2FF);border-bottom:1px solid #E5E7EB;display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <svg style="width:3.2rem;height:3.2rem;color:#3B82F6;" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="1.5">
                    <circle cx="12" cy="12" r="3" />
                    <path d="M12 3v6M12 15v6M3 12h6M15 12h6M5.6 5.6l4.2 4.2M14.2 14.2l4.2 4.2M5.6 18.4l4.2-4.2M14.2 9.8l4.2-4.2" />
                  </svg>
                </div>
                <div style="padding:1rem;">
                  <span style="font-size:10px;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:4px;">TRENDING</span>
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Autonomous Multi-Agent AI Workflows</h5>
                </div>
              </a>

              <!-- Trending 3 -->
              <a href="blog_detail?id=3" onclick="openDynamicArticle(3, event)" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#064E3B,#134E4A,#0F172A);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#6EE7B7;font-weight:700;">CLOUD DEVOPS</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">Distributed Microservices &amp; Envoy Routing</h5>
                </div>
              </a>

              <!-- Trending 4 -->
              <a href="blog_detail?id=1" onclick="openDynamicArticle(1, event)" style="text-decoration:none;background:#fff;border-radius:0.75rem;border:1px solid #E5E7EB;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.04);transition:all 0.2s;">
                <div style="width:100%;height:9rem;background:linear-gradient(135deg,#B45309,#7C2D12,#1C1917);display:flex;align-items:center;justify-content:center;padding:0.75rem;">
                  <span style="font-size:11px;font-family:monospace;color:#FDE68A;font-weight:700;">HARDWARE SPECS</span>
                </div>
                <div style="padding:1rem;">
                  <h5 style="font-size:0.9rem;font-weight:700;color:#111827;line-height:1.4;margin:0;">The 7 Best Enterprise AI &amp; Cloud Laptops</h5>
                </div>
              </a>

            </div>
          </div>

        </div>

        <!-- RIGHT 340PX SIDEBAR (Overview Mode) -->
        <aside style="display:flex;flex-direction:column;gap:2rem;text-align:left;">
          <!-- WIDGET 1: TOP STORIES -->
          <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
              <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Top Stories</h4>
              <div style="display:flex;align-items:center;gap:6px;">
                <button type="button" onclick="prevTopStories()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">‹</button>
                <button type="button" onclick="nextTopStories()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">›</button>
              </div>
            </div>

            <div class="sidebar-top-stories-list" style="display:flex;flex-direction:column;gap:1rem;transition:opacity 0.25s ease;">
              
              <a href="blog_detail?id=1" onclick="openDynamicArticle(1, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#1E293B;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                  💻
                </div>
                <div>
                  <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">The 7 Best Enterprise AI &amp; Cloud Laptops in 2026</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">15-Aug-2026</span>
                </div>
              </a>

              <a href="blog_detail?id=2" onclick="openDynamicArticle(2, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                  🤖
                </div>
                <div>
                  <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Artificial Intelligence Development: Modern AI Foundations</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">18-Aug-2026</span>
                </div>
              </a>

              <a href="blog_detail?id=3" onclick="openDynamicArticle(3, event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;padding-top:0.5rem;border-top:1px solid #F9FAFB;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#0F766E;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">
                  📈
                </div>
                <div>
                  <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Growth &amp; High-Throughput Cloud Scaling</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2026</span>
                </div>
              </a>

            </div>
          </div>

          <!-- WIDGET 2: SPECIAL FEATURE (WATCH NOW VIDEO MODAL) -->
          <div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
            <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#4ADE80,#22D3EE,#3B82F6);"></div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
            <p style="font-size:12.5px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Watch our exclusive video briefings &amp; live architecture teardowns.</p>
            <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
          </div>

          <!-- WIDGET 3: NEWEST VIDEOS -->
          <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
              <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Newest Videos</h4>
              <div style="display:flex;align-items:center;gap:6px;">
                <button type="button" onclick="prevVideos()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">‹</button>
                <button type="button" onclick="nextVideos()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">›</button>
              </div>
            </div>

            <div class="sidebar-videos-list" style="display:flex;flex-direction:column;gap:1rem;transition:opacity 0.25s ease;">
              
              <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                  ▶
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">WHAT ARE SOCIAL ADVERTISING?</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2024</span>
                </div>
              </div>

              <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                  ▶
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">ENTERPRISE AI ARCHITECTURE</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">18-Apr-2024</span>
                </div>
              </div>

              <div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">
                <div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                  ▶
                </div>
                <div>
                  <h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">HYBRID CLOUD DEVOPS TEARDOWN</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">12-May-2024</span>
                </div>
              </div>

            </div>
          </div>

          <!-- WIDGET 4: SPECIAL FEATURE 2 -->
          <div style="background:#0B1120;color:#fff;border-radius:1rem;padding:1.5rem;position:relative;overflow:hidden;border:1px solid #1F2937;box-shadow:0 10px 15px -3px rgba(0,0,0,0.3);">
            <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(to right,#FB923C,#EF4444,#EC4899);"></div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Special Feature</span>
            <p style="font-size:12.5px;color:#D1D5DB;line-height:1.6;margin:0 0 1.25rem;">Explore our high-throughput AI infrastructure benchmarks.</p>
            <button onclick="openVideoModal()" style="padding:8px 20px;background:#E53935;color:#fff;font-weight:700;font-size:12px;border:none;cursor:pointer;border-radius:2px;box-shadow:0 4px 6px -1px rgba(229,57,53,0.4);transition:background 0.2s;" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='#E53935'">Watch Now</button>
          </div>

          <!-- WIDGET 5: UPCOMING EVENTS -->
          <div style="background:#fff;border-radius:1rem;border:1px solid #E5E7EB;padding:1.25rem;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:1px solid #F3F4F6;">
              <h4 style="font-size:0.875rem;font-weight:800;color:#030712;text-transform:uppercase;margin:0;">Upcoming Events</h4>
              <div style="display:flex;align-items:center;gap:6px;">
                <button type="button" onclick="prevEvents()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">‹</button>
                <button type="button" onclick="nextEvents()" style="width:1.6rem;height:1.6rem;background:#F1F5F9;border:1px solid #CBD5E1;border-radius:4px;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:13px;color:#1E293B;transition:background 0.15s;" onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">›</button>
              </div>
            </div>

            <div class="sidebar-events-list" style="display:flex;flex-direction:column;gap:1rem;transition:opacity 0.25s ease;">
              
              <div onclick="openEventModal('International Conference on World Cloud Architecture')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                  <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">13</span>
                  <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">APR</span>
                </div>
                <div>
                  <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">International Conference on World Cloud Architecture</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">25-Apr-2026</span>
                </div>
              </div>

              <div onclick="openEventModal('Global AI & Autonomous Agents Summit 2026')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                  <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">28</span>
                  <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">MAY</span>
                </div>
                <div>
                  <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Global AI &amp; Autonomous Agents Summit 2026</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">28-May-2026</span>
                </div>
              </div>

              <div onclick="openEventModal('Enterprise Cybersecurity & Threat Modeling Workshop')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">
                <div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">
                  <span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">15</span>
                  <span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">JUN</span>
                </div>
                <div>
                  <h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">Enterprise Cybersecurity &amp; Threat Modeling Workshop</h5>
                  <span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">15-Jun-2026</span>
                </div>
              </div>

            </div>
          </div>
        </aside>

      </div>

    </div>
  </section>

  <!-- ================= 6. DRIBBLE-STYLE 3D STACKED BADGE TESTIMONIALS SECTION ================= -->
  <section style="width:100%;background:#F8F9FB;padding:2.75rem 0 3.25rem;border-top:1px solid #E5E7EB;position:relative;overflow:hidden;" id="reviewCarouselSection">
    
    <!-- Subtle Background Ambient Glow / Grid -->
    <div style="position:absolute;inset:0;background-image:radial-gradient(#E2E8F0 1px, transparent 1px);background-size:28px 28px;opacity:0.45;pointer-events:none;"></div>

    <div class="kc-container" style="max-width:64rem;position:relative;z-index:2;">
      
      <!-- Section Header on a Single Line with Compact Spacing -->
      <div style="text-align:center;margin-bottom:1.5rem;">
        <span style="font-family:'Plus Jakarta Sans',Inter,-apple-system,BlinkMacSystemFont,sans-serif;font-size:11px;font-weight:500;color:#64748B;text-transform:uppercase;letter-spacing:0.18em;display:block;margin-bottom:6px;">
          Testimonials
        </span>
        <h2 style="font-family:'Plus Jakarta Sans',Inter,-apple-system,BlinkMacSystemFont,sans-serif;font-size:clamp(1.25rem,2.2vw,1.65rem);font-weight:400;color:#0F172A;letter-spacing:-0.01em;margin:0 auto 6px;line-height:1.2;text-transform:uppercase;white-space:nowrap;">
          Trusted by Founders • Backed by Results
        </h2>
        <p style="font-family:'Plus Jakarta Sans',Inter,-apple-system,BlinkMacSystemFont,sans-serif;font-size:13.5px;color:#64748B;margin:0;font-weight:400;">
          Results that speak through founder voices.
        </p>
      </div>

      <!-- 3D Badge Lanyard Card Deck Wrapper (Significantly Larger Design) -->
      <div style="position:relative;max-width:820px;margin:0 auto;padding-top:24px;perspective:1400px;" id="badgeDeckWrapper">
        
        <!-- Top Lanyard Badge Clip Strap Holder -->
        <div style="position:absolute;top:0;left:50%;transform:translateX(-50%);width:96px;height:46px;background:linear-gradient(180deg, #E2E8F0 0%, #CBD5E1 100%);border-radius:10px 10px 0 0;box-shadow:0 4px 10px rgba(0,0,0,0.08);z-index:30;display:flex;flex-direction:column;align-items:center;justify-content:center;">
          <div style="width:62px;height:18px;background:rgba(255,255,255,0.9);border-radius:4px;border:1px solid #CBD5E1;box-shadow:inset 0 1px 3px rgba(0,0,0,0.1);"></div>
          <div style="width:22px;height:4px;background:#94A3B8;border-radius:2px;margin-top:4px;"></div>
        </div>

        <!-- The 3D Stacked Cards Deck Container (Significantly Enlarged) -->
        <div id="deckCardsContainer" style="position:relative;width:100%;height:390px;cursor:pointer;transform-style:preserve-3d;" onclick="nextDeckCard()" title="Click to view next review">
          <!-- 3 Stacked Cards Injected via JS -->
        </div>

        <!-- Interactive Progress Dots & Controls -->
        <div style="display:flex;align-items:center;justify-content:center;gap:16px;margin-top:24px;">
          <button onclick="prevDeckCard(event)" style="width:36px;height:36px;border-radius:50%;background:#FFFFFF;border:1px solid #E2E8F0;color:#0F172A;font-weight:400;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 5px rgba(0,0,0,0.06);transition:all 0.15s;" onmouseover="this.style.background='#F1F5F9'" onmouseout="this.style.background='#FFFFFF'">‹</button>
          
          <div style="display:flex;align-items:center;gap:8px;" id="deckProgressDots">
            <!-- Dots injected via JS -->
          </div>

          <button onclick="nextDeckCard(event)" style="width:36px;height:36px;border-radius:50%;background:#FFFFFF;border:1px solid #E2E8F0;color:#0F172A;font-weight:400;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 5px rgba(0,0,0,0.06);transition:all 0.15s;" onmouseover="this.style.background='#F1F5F9'" onmouseout="this.style.background='#FFFFFF'">›</button>
        </div>

      </div>

    </div>
  </section>

</div>

<!-- ================= 7. VIDEO & EVENT MODALS ================= -->
<div id="videoModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.8);z-index:9999;align-items:center;justify-content:center;padding:1rem;">
  <div style="background:#000;border:1px solid #374151;max-width:56rem;width:100%;position:relative;border-radius:4px;overflow:hidden;">
    <button onclick="closeVideoModal()" style="position:absolute;top:1rem;right:1rem;background:rgba(0,0,0,0.7);color:#fff;border:none;padding:6px 12px;font-weight:700;cursor:pointer;z-index:10;">✕ Close</button>
    <div style="position:relative;padding-bottom:56.25%;height:0;">
      <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" style="position:absolute;top:0;left:0;width:100%;height:100%;border:none;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  </div>
</div>

<div id="eventModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:9999;align-items:center;justify-content:center;padding:1rem;">
  <div style="background:#fff;border:1px solid #E5E7EB;max-width:32rem;width:100%;padding:2rem;position:relative;border-radius:4px;text-align:left;">
    <button onclick="closeEventModal()" style="position:absolute;top:1rem;right:1rem;background:transparent;border:none;font-size:1.25rem;font-weight:700;cursor:pointer;">✕</button>
    <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 6px;">Register for Event</h3>
    <p id="modalEventTitle" style="font-size:13px;color:#0052FF;font-weight:600;margin:0 0 1.5rem;">Event Title</p>
    <form onsubmit="handleEventRegister(event)" style="display:flex;flex-direction:column;gap:1rem;">
      <div>
        <label style="display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:4px;">Full Name</label>
        <input type="text" required placeholder="Your name" style="width:100%;padding:8px 12px;border:1px solid #D1D5DB;font-size:13px;box-sizing:border-box;">
      </div>
      <div>
        <label style="display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:4px;">Corporate Email</label>
        <input type="email" required placeholder="you@company.com" style="width:100%;padding:8px 12px;border:1px solid #D1D5DB;font-size:13px;box-sizing:border-box;">
      </div>
      <button type="submit" style="padding:10px;background:#0052FF;color:#fff;font-weight:700;font-size:13px;border:none;cursor:pointer;border-radius:2px;margin-top:0.5rem;">Confirm Free Registration &rarr;</button>
    </form>
  </div>
</div>

<!-- ================= ADD PEER REVIEW MODAL ================= -->
<div id="addReviewModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);z-index:9999;align-items:center;justify-content:center;padding:1rem;backdrop-filter:blur(4px);">
  <div style="background:#FFFFFF;border:1px solid #E2E8F0;max-width:34rem;width:100%;padding:28px;position:relative;border-radius:12px;text-align:left;box-shadow:0 20px 25px -5px rgba(0,0,0,0.2);">
    <button onclick="closeAddReviewModal()" style="position:absolute;top:16px;right:16px;background:#F1F5F9;border:none;width:32px;height:32px;border-radius:50%;font-size:15px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#475569;">✕</button>
    
    <div style="margin-bottom:18px;">
      <span style="font-size:10.5px;font-weight:800;color:#0052FF;text-transform:uppercase;letter-spacing:0.06em;">COMMUNITY FEEDBACK</span>
      <h3 style="font-size:1.35rem;font-weight:800;color:#0F172A;margin:4px 0 4px;">Write a Verified Peer Review</h3>
      <p id="modalArticleTargetTitle" style="font-size:12px;color:#64748B;margin:0;">Post: The 7 Best Enterprise AI &amp; Cloud Laptops</p>
    </div>

    <form onsubmit="handlePostReviewSubmit(event)" style="display:flex;flex-direction:column;gap:14px;">
      <div class="kc-modal-form-grid">
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Your Full Name *</label>
          <input type="text" id="revInputName" required placeholder="e.g. Alex Morgan" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:12.5px;box-sizing:border-box;outline:none;">
        </div>
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Role &amp; Company *</label>
          <input type="text" id="revInputRole" required placeholder="e.g. Senior Architect @ CloudNet" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:12.5px;box-sizing:border-box;outline:none;">
        </div>
      </div>

      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Star Rating</label>
        <select id="revInputRating" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:12.5px;box-sizing:border-box;outline:none;background:#fff;">
          <option value="5">★★★★★ (5/5) Exceptional &amp; Authoritative</option>
          <option value="4">★★★★☆ (4/5) Very Good Benchmark</option>
          <option value="3">★★★☆☆ (3/5) Average Analysis</option>
          <option value="2">★★☆☆☆ (2/5) Needs Improvement</option>
          <option value="1">★☆☆☆☆ (1/5) Poor</option>
        </select>
      </div>

      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Review Headline / Key Takeaway *</label>
        <input type="text" id="revInputTitle" required placeholder="e.g. Accurate memory benchmarks for Llama-3 workloads" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:12.5px;box-sizing:border-box;outline:none;">
      </div>

      <div>
        <label style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:4px;">Detailed Review &amp; Architectural Insights *</label>
        <textarea id="revInputComment" required rows="4" placeholder="Share your real-world hardware, cloud, or system architecture experience regarding this article..." style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:12.5px;box-sizing:border-box;outline:none;resize:vertical;font-family:inherit;"></textarea>
      </div>

      <button type="submit" id="revSubmitBtn" style="padding:11px;background:#0052FF;color:#fff;font-weight:700;font-size:13px;border:none;cursor:pointer;border-radius:6px;margin-top:4px;display:flex;align-items:center;justify-content:center;gap:6px;box-shadow:0 2px 8px rgba(0,82,255,0.3);">
        Post Verified Review &rarr;
      </button>
    </form>
  </div>
</div>

<!-- ================= 8. JAVASCRIPT CONTROLLERS ================= -->
<?php
$loadedDynamicArticles = [];
$articlesJsonPath = __DIR__ . '/data/articles.json';
if (file_exists($articlesJsonPath)) {
    $loadedDynamicArticles = @json_decode(@file_get_contents($articlesJsonPath), true) ?: [];
}
?>
<script>
window.CREED_KC_INIT = {
  dynamicArticles: <?= json_encode($loadedDynamicArticles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,
  wireData: <?= json_encode(!empty($brandWires) ? $brandWires : new stdClass(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,
  mainNewsList: <?= json_encode(!empty($breakingNews) ? $breakingNews : [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,
  regionalData: <?= json_encode(!empty($regionalWires) ? $regionalWires : new stdClass(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
};
</script>
<script src="assets/js/knowledge-center.js?v=<?= @filemtime(__DIR__ . '/assets/js/knowledge-center.js') ?>" defer></script>

<?php include __DIR__ . '/includes/footer.php'; ?>
