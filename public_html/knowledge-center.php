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
  align-items: center;
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

/* Image Box Containers with True 16:9 Proportions (Zero Cut-offs / Zero Squishing) */
.kc-main-news-visual {
  position: relative;
  width: 100%;
  aspect-ratio: 16 / 9;
  min-height: 260px;
  background: #0B1120;
  overflow: hidden;
}
.kc-wire-visual {
  position: relative;
  width: 100%;
  aspect-ratio: 16 / 9;
  min-height: 260px;
  border-radius: 12px;
  overflow: hidden;
  background: #0F172A;
}
.kc-reg-visual {
  position: relative;
  width: 100%;
  aspect-ratio: 16 / 9;
  min-height: 260px;
  border-radius: 12px;
  overflow: hidden;
  background: #064E3B;
}
.kc-main-news-visual img,
.kc-wire-visual img,
.kc-reg-visual img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
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
            <img id="mainNewsImg" src="<?= htmlspecialchars($mainItem['img'] ?? 'uploads/live_news/google_gemini_chrome_hero.png') ?>" alt="<?= htmlspecialchars(!empty($mainItem['title']) ? $mainItem['title'] : 'Tech News Intelligence') ?>" style="width:100%;height:100%;object-fit:cover;object-position:center;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
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
                <img src="<?= htmlspecialchars($s['img'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars(!empty($s['title']) ? $s['title'] : 'Enterprise Tech News Story') ?>" style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
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
      <div class="kc-wire-card-grid" style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:1rem;padding:1.5rem sm:padding:2rem;">
        <div id="wireVisualContainer" class="kc-wire-visual">
          <img id="wireImg" src="<?= htmlspecialchars($gw['img'] ?? 'uploads/live_news/google_gemini_chrome_hero.png') ?>" alt="<?= htmlspecialchars(!empty($gw['title']) ? $gw['title'] : 'Global Tech Wire Story') ?>" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
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
      <div class="kc-wire-card-grid" style="background:#fff;border:1px solid #E2E8F0;border-radius:1rem;padding:1.5rem sm:padding:2rem;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
        <div id="regVisualContainer" class="kc-reg-visual">
          <img id="regImg" src="<?= htmlspecialchars($dw['image'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars(!empty($dw['title']) ? $dw['title'] : 'Regional Tech Wire Story') ?>" style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;" onerror="this.onerror=null;this.src='assets/img/hero_img.webp';">
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
              <div style="display:flex;flex-direction:column;gap:6px;">
                <button onclick="selectWireBrand('google')" class="kc-sidebar-item" style="border:none;padding:8px 10px;">
                  <span style="color:#0052FF;font-weight:700;font-size:12px;">🌐 Google Willow Chip</span>
                  <span style="font-size:10.5px;color:#64748B;">105 Qubits Milestone</span>
                </button>
                <button onclick="selectWireBrand('openai')" class="kc-sidebar-item" style="border:none;padding:8px 10px;">
                  <span style="color:#059669;font-weight:700;font-size:12px;">🤖 OpenAI Strawberry</span>
                  <span style="font-size:10.5px;color:#64748B;">Neural Inference</span>
                </button>
                <button onclick="selectWireBrand('nvidia')" class="kc-sidebar-item" style="border:none;padding:8px 10px;">
                  <span style="color:#D97706;font-weight:700;font-size:12px;">⚡ NVIDIA B200</span>
                  <span style="font-size:10.5px;color:#64748B;">NVLink 5 Superchips</span>
                </button>
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
<script>
// Articles Store for In-Place Dynamic Reading
var ARTICLES_STORE = [
  {
    id: 1,
    category: "HARDWARE & AI WORKSTATIONS",
    date: "Aug 16, 2026",
    read_time: "18 min read",
    views: "64,250",
    title: "The 7 Best Enterprise AI & Cloud Laptops for Senior Engineers & Architects",
    author: "Dr. Sarah Jenkins (Chief Systems Architect) & Marcus Vance (Senior Hardware Lead)",
    editors_note: "August 2026: With this comprehensive update, our hardware engineering squad has vetted dozens of flagship workstations specifically for local generative AI inference, multi-container Docker and Kubernetes orchestrations, and massive distributed compiler builds. We run continuous 24-hour thermal dissipation tests in Creed Tech Labs to ensure these machines maintain peak turbo frequencies without thermal throttling.",
    intro_paragraphs: [
      "Choosing an engineering workstation in 2026 is fundamentally different from selecting a standard consumer laptop. With enterprise software teams increasingly executing local neural fine-tuning, running quantized 70-billion-parameter foundation models completely offline, and managing complex multi-tier containerized microservices stacks, traditional ultrabooks with 16GB of soldered RAM simply crumble under memory pressure.",
      "In our labs over the past six months, we evaluated more than 25 workstations across seven critical hardware vectors: sustained memory bandwidth, zero-copy unified RAM pooling, sustained multi-core compilation times under heavy thermal loads, thermal acoustic dB output, display color accuracy for design fidelity, keyboard actuation ergonomics, and real-world unplugged battery longevity.",
      "Below, you will find our deep-dive architectural analysis, comprehensive laboratory benchmark comparisons, pros and cons breakdowns, and detailed product-by-product evaluations."
    ],
    video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
    audio_url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    products: [
      {
        id: "hp-omnibook",
        award: "Best Windows Laptop for Most People",
        name: "HP OmniBook 5 14 (Qualcomm Snapdragon X Elite / OLED)",
        rating: "4.0 Excellent",
        stars: 4,
        price: "$899",
        image: "https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Field-leading battery endurance (21 hours 14 minutes continuous execution)",
          "Aggressively priced starting at just $899 with 32GB LPDDR5X RAM",
          "Vivid 14.0-inch 2.8K (2880x1800) OLED 120Hz display with 100% DCI-P3 color gamut",
          "Whisper-quiet dual fans that remain below 24 dB under typical IDE workloads"
        ],
        cons: [
          "Plastic keyboard deck could benefit from additional internal structural stiffening",
          "Occasional x86 translation overhead on legacy, unoptimized Windows kernel-mode drivers"
        ],
        long_text: "<p>The HP OmniBook 5 14 marks a seismic transition in the Windows laptop ecosystem. Built around Qualcomm's 4nm Oryon CPU architecture, it eliminates the historical compromise between high-performance computing and true all-day battery life.</p>",
        specs: {
          "Processor (CPU)": "Qualcomm Snapdragon X Elite (12 Cores, up to 3.8 GHz Turbo)",
          "Neural Engine (NPU)": "Qualcomm Hexagon NPU (45 TOPS dedicated AI compute)",
          "Memory (RAM)": "32GB LPDDR5X-8448 MHz",
          "Storage (SSD)": "1TB PCIe Gen4 x4 NVMe M.2 2280 SSD"
        },
        buy_links: [
          { store: "Amazon", price: "$899 at Amazon", color: "#FF9900", url: "https://amazon.com" }
        ]
      },
      {
        id: "macbook-pro-16",
        award: "Best Workstation for AI Engineers",
        name: "Apple MacBook Pro 16\" (M3 Max / 128GB Unified Memory)",
        rating: "4.5 Exceptional",
        stars: 5,
        price: "$3,499",
        image: "https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Unrivaled 128GB Unified RAM running Llama-3-70B Q4_K_M completely in VRAM",
          "400 GB/s memory bandwidth obliterates standard GPU transfer bottlenecks",
          "Liquid Retina XDR Mini-LED display with 1600 nits peak HDR and 120Hz ProMotion"
        ],
        cons: [
          "Substantial financial investment starting above $3,400",
          "Unified RAM and SSD are fully integrated on-die and cannot be upgraded post-purchase"
        ],
        long_text: "<p>For AI researchers and distributed systems architects, the 16-inch MacBook Pro configured with the 16-core M3 Max and 128GB Unified Memory is nothing short of a computing revelation.</p>",
        specs: {
          "Processor (CPU)": "Apple M3 Max (16-Core: 12 Performance + 4 Efficiency)",
          "Graphics (GPU)": "40-Core GPU with Hardware Ray Tracing",
          "Unified Memory": "128GB Unified Memory (400 GB/s Bandwidth)",
          "Storage (SSD)": "4TB PCIe Gen4 SSD (7,400 MB/s Read)"
        },
        buy_links: [
          { store: "Apple Store", price: "$3,499 at Apple", color: "#000000", url: "https://apple.com" }
        ]
      }
    ]
  },
  {
    id: 2,
    category: "AI RESEARCH & HISTORY",
    date: "Aug 15, 2026",
    read_time: "12 min read",
    views: "42,100",
    title: "Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI Research",
    author: "Dr. Marcus Vance (Principal AI Fellow)",
    editors_note: "A deep historical and algorithmic exploration into the early Dartmouth workshops, symbolic logic, Perceptron neural primitives, and early compiler architectures.",
    intro_paragraphs: [
      "The epoch spanning 1950 to 1965 defined the fundamental computational principles of modern artificial intelligence. From Alan Turing's seminal 1950 paper 'Computing Machinery and Intelligence' introducing the imitation game to the 1956 Dartmouth Summer Research Project where John McCarthy coined the term 'Artificial Intelligence', this era established symbolic computation, heuristic search, and neural perceptrons.",
      "Understanding these mathematical foundations is essential for contemporary enterprise architects working with modern deep learning and sovereign model fine-tuning."
    ],
    video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
    audio_url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    products: [
      {
        id: "ai-perceptrons",
        award: "Historical Computing Benchmark",
        name: "Dartmouth Workshop & Rosenblatt Perceptron Mark I (1956-1960)",
        rating: "5.0 Landmark",
        stars: 5,
        price: "Historical Archive",
        image: "https://images.unsplash.com/photo-1677442136019-21780efad99a?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Established first single-layer artificial neural network weighting equations",
          "Formulated LISP programming language for symbolic knowledge representation"
        ],
        cons: [
          "Limited by 4KB magnetic-core hardware memory constraints"
        ],
        long_text: "<p>The Mark I Perceptron was the world's first hardware implementation of an artificial neural network.</p>",
        specs: {
          "Hardware Architecture": "IBM 704 Vacuum Tube Mainframe",
          "Memory Capacity": "4,096 36-bit words (Magnetic Core)",
          "Clock Speed": "40,000 instructions per second"
        },
        buy_links: []
      }
    ]
  },
  {
    id: 3,
    category: "CLOUD INFRASTRUCTURE",
    date: "Aug 14, 2026",
    read_time: "14 min read",
    views: "38,900",
    title: "Cloud Native Microservices Architecture: A Deep Dive into Kubernetes Orchestration",
    author: "Helena Rostova (VP of Cloud & SRE)",
    editors_note: "An executive blueprint on architecting self-healing, multi-tenant Kubernetes clusters with zero-trust eBPF service meshes, automatic pod horizontal scaling, and sub-10ms P99 latency guarantees.",
    intro_paragraphs: [
      "Modern enterprise systems require continuous 99.999% SLA availability. Moving beyond monolithic architectures to microservices requires robust service discovery, distributed tracing, and automated canary deployments.",
      "In this analysis, we evaluate the architectural tradeoffs between Envoy proxy service meshes, eBPF-based kernel routing with Cilium, and GitOps continuous delivery pipelines."
    ],
    video_url: "https://www.youtube.com/embed/dQw4w9WgXcQ",
    audio_url: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
    products: [
      {
        id: "k8s-blueprint",
        award: "Enterprise SRE Blueprint",
        name: "Creed Sovereign Multi-Region Kubernetes Topology (v1.31)",
        rating: "4.9 Enterprise Grade",
        stars: 5,
        price: "Open Architecture",
        image: "https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?q=80&w=1000&auto=format&fit=crop",
        pros: [
          "Sub-10ms P99 intra-cluster API latency across 5 global availability zones",
          "Automated Cilium eBPF packet routing bypassing iptables bottlenecks"
        ],
        cons: [
          "Requires advanced SRE expertise for custom eBPF kernel debugging"
        ],
        long_text: "<p>By leveraging eBPF in modern Linux kernels, network packets are routed directly at the network interface layer without incurring standard netfilter CPU overhead.</p>",
        specs: {
          "Service Mesh Layer": "Cilium eBPF (Kernel 6.8+)",
          "Ingress Gateway": "Envoy Gateway 1.30 with mTLS 1.3"
        },
        buy_links: []
      }
    ]
  }
];

<?php
$loadedDynamicArticles = [];
$articlesJsonPath = __DIR__ . '/data/articles.json';
if (file_exists($articlesJsonPath)) {
    $loadedDynamicArticles = @json_decode(@file_get_contents($articlesJsonPath), true) ?: [];
}
if (!empty($loadedDynamicArticles)):
?>
var DYNAMIC_JSON_ARTICLES = <?php echo json_encode($loadedDynamicArticles, JSON_UNESCAPED_SLASHES); ?>;
if (Array.isArray(DYNAMIC_JSON_ARTICLES) && DYNAMIC_JSON_ARTICLES.length > 0) {
  DYNAMIC_JSON_ARTICLES.forEach(function(dArt) {
    var existingIdx = ARTICLES_STORE.findIndex(function(a) { return a.id === dArt.id; });
    if (existingIdx >= 0) {
      ARTICLES_STORE[existingIdx] = Object.assign({}, ARTICLES_STORE[existingIdx], dArt);
    } else {
      ARTICLES_STORE.push(dArt);
    }
  });
}
<?php endif; ?>

// Fallback / Initial Post-Specific Reviews Data
var POST_REVIEWS_STORE = {
  1: [
    {
      name: "Dr. Marcus Vance",
      role: "Chief Technology Officer @ FinTech Global Frankfurt",
      avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 16, 2026",
      title: "M3 Max with 128GB RAM transformed our local LLM development",
      comment: "This in-depth benchmark matches our internal production findings exactly. Having 128GB of unified memory allows our engineering squads to run unquantized Llama-3-70B models directly on the laptop during transatlantic flights with zero cloud dependency. Outstanding review depth.",
      helpful: 34
    },
    {
      name: "David Thorne",
      role: "Principal Systems Engineer @ CloudNative US",
      avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 15, 2026",
      title: "21 hours real battery life while compiling Rust is unbelievable",
      comment: "Qualcomm Snapdragon X Elite has truly redefined what ARM on Windows can do. Zero fan noise during heavy code refactoring in VS Code and it easily lasted 2 full work days on a single charge.",
      helpful: 42
    },
    {
      name: "Elena Rostova",
      role: "Principal AI Systems Architect @ Neural Bio Labs",
      avatar: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 14, 2026",
      title: "ThinkPad P16 ECC memory saved our quantitative simulations",
      comment: "The ThinkPad P16 Gen 2 is indeed a heavy machine, but the 192GB ECC RAM configuration is the only setup that prevents silent data corruption during 14-hour Monte Carlo and financial risk simulations. Great inclusion of the acoustic dB levels as well.",
      helpful: 28
    }
  ],
  2: [
    {
      name: "Prof. Arthur Pendelton",
      role: "AI Research Fellow @ Oxford Institute of Data",
      avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 16, 2026",
      title: "Masterful historical breakdown of early symbolic vs neural paradigms",
      comment: "Rarely do modern tech publications trace contemporary Transformer architectures back to the Rosenblatt Perceptron and McCarthy's LISP with such mathematical precision. Excellent foundational reading for junior and senior AI fellows alike.",
      helpful: 39
    },
    {
      name: "Dr. Sarah Jenkins",
      role: "Chief Systems Architect @ FinEdge Global",
      avatar: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 15, 2026",
      title: "Essential context for modern LLM architecture designers",
      comment: "Understanding the hardware bottlenecks of the 1950s gives brilliant clarity to why modern matrix multiplication accelerators (TPUs/GPUs) are designed the way they are. The timeline diagrams are remarkably clear.",
      helpful: 27
    },
    {
      name: "Jonathan Anastas",
      role: "Ador Network Services / Chief Marketing Officer",
      avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 14, 2026",
      title: "A brilliant whitepaper our entire executive team enjoyed",
      comment: "Concise, authoritative, and historically rigorous. Helps our board understand how the last 70 years of computational milestones led to current sovereign enterprise models.",
      helpful: 18
    }
  ],
  3: [
    {
      name: "Alex Linetski",
      role: "Lead Cloud Infrastructure Engineer @ HiRefresh Agency",
      avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 16, 2026",
      title: "Cilium eBPF packet routing slashed our P99 API latency by 45%",
      comment: "We implemented Creed Tech's eBPF microservices blueprint directly in our EU cloud cluster. Bypassing iptables completely eliminated connection tracking bottlenecks under 100k concurrent WebSocket connections.",
      helpful: 46
    },
    {
      name: "Vlad Hryhoren",
      role: "VP of Site Reliability @ ScaledCore Systems",
      avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 15, 2026",
      title: "The cleanest zero-downtime canary deployment architecture we've seen",
      comment: "The automated Envoy routing with mTLS 1.3 encryption out of the box passed our external SOC 2 Type II audit with flying colors. A masterclass in Kubernetes production engineering.",
      helpful: 31
    },
    {
      name: "Liam Gallagher",
      role: "VP of Cloud Engineering @ DataScale Global",
      avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80",
      rating: 5,
      date: "Aug 14, 2026",
      title: "Robust multi-tenant isolation and automated pod autoscaling",
      comment: "This saved us weeks of trial and error configuring custom metrics horizontal pod autoscaling. Highly recommended for enterprise SRE teams.",
      helpful: 24
    }
  ]
};

var CURRENT_ACTIVE_ARTICLE_ID = 1;

// Sidebar Navigator Renderer
function renderSidebarNavigator() {
  var list = document.getElementById('sidebarArticlesList');
  if (!list) return;

  list.innerHTML = ARTICLES_STORE.map(function(art) {
    var isActive = (art.id === CURRENT_ACTIVE_ARTICLE_ID);
    return '<button onclick="openDynamicArticle(' + art.id + ', event)" class="kc-sidebar-item' + (isActive ? ' active' : '') + '">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;gap:4px;">' +
        '<span style="font-size:9.5px;font-weight:800;color:#0052FF;text-transform:uppercase;">' + (art.category.split('&')[0]) + '</span>' +
        '<span style="font-size:10.5px;color:#94A3B8;">' + art.read_time + '</span>' +
      '</div>' +
      '<h5 style="font-size:12px;font-weight:700;color:#0F172A;margin:2px 0 0;line-height:1.35;text-align:left;">' + art.title + '</h5>' +
    '</button>';
  }).join('');
}

function filterSidebarArticles(query) {
  var q = (query || '').toLowerCase().trim();
  var items = document.querySelectorAll('#sidebarArticlesList .kc-sidebar-item');
  items.forEach(function(item) {
    if (!q || item.textContent.toLowerCase().includes(q)) {
      item.style.display = 'flex';
    } else {
      item.style.display = 'none';
    }
  });
}

// Load & Render Post-Specific Reviews for Active Article
function loadPostReviews(articleId) {
  var list = document.getElementById('postReviewsList');
  if (!list) return;

  // Try fetching live reviews from backend API, or fallback to memory
  fetch('ajax/article_reviews.php?article_id=' + articleId)
    .then(function(res) { return res.json(); })
    .then(function(data) {
      var reviews = (data && data.reviews && data.reviews.length > 0) ? data.reviews : (POST_REVIEWS_STORE[articleId] || POST_REVIEWS_STORE[1]);
      renderPostReviewsHtml(reviews);
    })
    .catch(function() {
      var fallback = POST_REVIEWS_STORE[articleId] || POST_REVIEWS_STORE[1];
      renderPostReviewsHtml(fallback);
    });
}

function renderPostReviewsHtml(reviews) {
  var list = document.getElementById('postReviewsList');
  if (!list) return;

  if (!reviews || reviews.length === 0) {
    list.innerHTML = '<div style="padding:20px;background:#F8FAFC;border:1px dashed #CBD5E1;border-radius:8px;text-align:center;color:#64748B;font-size:13px;">No reviews submitted yet for this post. Be the first to add your peer review!</div>';
    return;
  }

  // Render top 3 reviews
  var top3 = reviews.slice(0, 3);
  list.innerHTML = top3.map(function(r) {
    var starCount = parseInt(r.rating || 5);
    var starsStr = '★★★★★'.substring(0, starCount) + '☆☆☆☆☆'.substring(0, 5 - starCount);
    var avatarImg = r.avatar || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80';

    return '<div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:10px;padding:20px;box-shadow:0 1px 3px rgba(0,0,0,0.02);">' +
      '<div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:10px;">' +
        '<div style="display:flex;align-items:center;gap:12px;">' +
          '<img src="' + avatarImg + '" alt="' + r.name + '" style="width:42px;height:42px;border-radius:50%;object-fit:cover;border:2px solid #E2E8F0;">' +
          '<div>' +
            '<div style="display:flex;align-items:center;gap:6px;">' +
              '<h4 style="font-size:13.5px;font-weight:800;color:#0F172A;margin:0;">' + r.name + '</h4>' +
              '<span style="background:#DCFCE7;color:#15803D;font-size:9.5px;font-weight:800;padding:1px 6px;border-radius:2px;">✓ VERIFIED ARCHITECT</span>' +
            '</div>' +
            '<span style="font-size:11.5px;color:#64748B;font-weight:500;">' + r.role + '</span>' +
          '</div>' +
        '</div>' +
        '<div style="text-align:right;">' +
          '<div style="color:#F59E0B;font-size:13px;letter-spacing:1px;">' + starsStr + '</div>' +
          '<span style="font-size:11px;color:#94A3B8;">' + (r.date || 'Aug 2026') + '</span>' +
        '</div>' +
      '</div>' +
      '<h5 style="font-size:13.5px;font-weight:700;color:#0F172A;margin:0 0 6px;line-height:1.35;">' + (r.title || 'In-Depth Evaluation') + '</h5>' +
      '<p style="font-size:13px;color:#475569;line-height:1.65;margin:0 0 10px;">' + r.comment + '</p>' +
      '<div style="display:flex;align-items:center;justify-content:space-between;padding-top:8px;border-top:1px solid #F8FAFC;font-size:11px;color:#94A3B8;">' +
        '<span>💡 Helpful: ' + (r.helpful || 12) + ' engineers found this constructive</span>' +
        '<button onclick="this.textContent=\'✓ Thank you\';this.style.color=\'#0052FF\';" style="background:transparent;border:none;color:#64748B;cursor:pointer;font-size:11px;font-weight:600;">Helpful?</button>' +
      '</div>' +
    '</div>';
  }).join('');
}

// Add Review Modal Controllers
function openAddReviewModal() {
  var activeArt = ARTICLES_STORE.find(function(a) { return a.id === CURRENT_ACTIVE_ARTICLE_ID; }) || ARTICLES_STORE[0];
  var titleEl = document.getElementById('modalArticleTargetTitle');
  if (titleEl) titleEl.textContent = 'Post: ' + activeArt.title;
  document.getElementById('addReviewModal').style.display = 'flex';
}

function closeAddReviewModal() {
  document.getElementById('addReviewModal').style.display = 'none';
}

function handlePostReviewSubmit(e) {
  e.preventDefault();
  var name = document.getElementById('revInputName').value.trim();
  var role = document.getElementById('revInputRole').value.trim();
  var rating = parseInt(document.getElementById('revInputRating').value || 5);
  var title = document.getElementById('revInputTitle').value.trim();
  var comment = document.getElementById('revInputComment').value.trim();

  var newRevObj = {
    article_id: CURRENT_ACTIVE_ARTICLE_ID,
    name: name,
    role: role,
    rating: rating,
    title: title,
    comment: comment,
    date: 'Just Now',
    helpful: 1
  };

  // Add to local store immediately for instant UI response
  if (!POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID]) {
    POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID] = [];
  }
  POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID].unshift(newRevObj);

  // Send to backend
  fetch('ajax/article_reviews.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(newRevObj)
  }).catch(function(err) { console.warn('Saved in memory:', err); });

  // Re-render post reviews
  renderPostReviewsHtml(POST_REVIEWS_STORE[CURRENT_ACTIVE_ARTICLE_ID]);

  // Reset & Close
  document.getElementById('revInputName').value = '';
  document.getElementById('revInputRole').value = '';
  document.getElementById('revInputTitle').value = '';
  document.getElementById('revInputComment').value = '';
  closeAddReviewModal();

  alert('✓ Thank you, ' + name + '! Your verified peer review has been posted successfully.');
}

// Open Dynamic Article In-Place
function openDynamicArticle(articleId, e) {
  if (e) e.preventDefault();

  var art = ARTICLES_STORE.find(function(a) { return a.id === parseInt(articleId); }) || ARTICLES_STORE[0];
  CURRENT_ACTIVE_ARTICLE_ID = art.id;

  // 1. Hide Overview Grid, Show Expansive 3-Column Reader Layout
  document.getElementById('kcOverviewLayout').style.display = 'none';
  document.getElementById('kcReaderLayout').style.display = 'block';

  // 2. Populate Breadcrumbs
  document.getElementById('readerBreadcrumbCat').textContent = art.category;

  // 3. Populate Header & Metadata
  document.getElementById('readerCatBadge').textContent = art.category;
  document.getElementById('readerDate').textContent = art.date;
  document.getElementById('readerReadTime').textContent = '⏱️ ' + art.read_time;
  document.getElementById('readerTitle').textContent = art.title;
  document.getElementById('readerAuthor').textContent = art.author;

  // 4. Populate Editors Note
  if (art.editors_note) {
    document.getElementById('readerEditorsNoteBox').style.display = 'block';
    document.getElementById('readerEditorsNote').textContent = art.editors_note;
  } else {
    document.getElementById('readerEditorsNoteBox').style.display = 'none';
  }

  // 5. Populate Intro Paragraphs & Source Attribution
  var introContainer = document.getElementById('readerIntroParagraphs');
  if (introContainer) {
    var sourceAttrHtml = '';
    if (art.article_origin === 'news_editorial' && art.source_provider) {
      sourceAttrHtml = '<div style="background:#F8FAFC;border:1px solid #E2E8F0;border-left:4px solid #0052FF;border-radius:6px;padding:14px 18px;margin:0 0 20px;">' +
        '<span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;">Source Attribution &amp; Reference</span>' +
        '<p style="font-size:13px;color:#334155;margin:4px 0 6px;">Based on technical news reported by <strong>' + (art.source_provider.toUpperCase()) + '</strong>: <em>"' + (art.source_title || '') + '"</em>.</p>' +
        '<a href="' + (art.source_url || '#') + '" target="_blank" rel="noopener noreferrer" style="font-size:12px;color:#0052FF;text-decoration:underline;font-weight:600;">Read Original Source Report ↗</a>' +
      '</div>';
    }

    var bodyHtml = '';
    if (art.custom_body_html) {
      bodyHtml = '<div style="font-size:15px;line-height:1.8;color:#334155;">' + art.custom_body_html + '</div>';
    } else if (art.intro_paragraphs && Array.isArray(art.intro_paragraphs)) {
      bodyHtml = art.intro_paragraphs.map(function(p) {
        return '<p style="margin:0 0 16px;line-height:1.8;">' + p + '</p>';
      }).join('');
    }
    introContainer.innerHTML = sourceAttrHtml + bodyHtml;
  }

  // 6. Populate Media (Audio & Video)
  var audioEl = document.getElementById('readerAudioPlayer');
  if (audioEl) {
    audioEl.src = art.audio_url || 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3';
    audioEl.pause();
    document.getElementById('readerPlayBtn').innerHTML = '▶';
  }
  var videoIframe = document.getElementById('readerVideoIframe');
  if (videoIframe) {
    videoIframe.src = art.video_url || 'https://www.youtube.com/embed/dQw4w9WgXcQ?controls=1';
  }

  // 7. Populate Products Breakdown Bento Cards
  var productsContainer = document.getElementById('readerProductsContainer');
  if (productsContainer) {
    if (art.products && art.products.length > 0) {
      productsContainer.innerHTML = art.products.map(function(prod) {
        var prosList = (prod.pros || []).map(function(pro) {
          return '<li style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#14532D;line-height:1.5;"><span style="color:#16A34A;font-weight:900;">+</span> <span>' + pro + '</span></li>';
        }).join('');

        var consList = (prod.cons || []).map(function(con) {
          return '<li style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#7F1D1D;line-height:1.5;"><span style="color:#DC2626;font-weight:900;">&minus;</span> <span>' + con + '</span></li>';
        }).join('');

        var buyBtns = (prod.buy_links || []).map(function(b) {
          return '<a href="' + (b.url || '#') + '" target="_blank" style="padding:9px 18px;background:' + (b.color || '#0052FF') + ';color:#fff;font-size:12px;font-weight:700;text-decoration:none;border-radius:4px;display:inline-flex;align-items:center;gap:6px;">' + (b.price || b.store) + ' &rarr;</a>';
        }).join(' ');

        var specsHtml = '';
        if (prod.specs) {
          var specRows = Object.keys(prod.specs).map(function(k) {
            return '<tr style="border-bottom:1px solid #F1F5F9;"><td style="padding:8px 12px;font-weight:700;color:#0F172A;width:35%;">' + k + '</td><td style="padding:8px 12px;color:#475569;">' + prod.specs[k] + '</td></tr>';
          }).join('');
          specsHtml = '<table style="width:100%;border-collapse:collapse;font-size:12.5px;margin-top:14px;background:#F8FAFC;border-radius:6px;border:1px solid #E2E8F0;"><tbody>' + specRows + '</tbody></table>';
        }

        return '<div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:12px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,0.02);">' +
          '<div class="kc-prod-grid" style="margin-bottom:20px;">' +
            '<div style="height:200px;border-radius:8px;overflow:hidden;background:#0B1120;">' +
              '<img src="' + prod.image + '" alt="' + prod.name + '" style="width:100%;height:100%;object-fit:cover;">' +
            '</div>' +
            '<div>' +
              '<span style="font-size:11px;font-weight:800;color:#E11D48;text-transform:uppercase;margin-bottom:4px;display:block;">' + prod.award + '</span>' +
              '<h3 style="font-size:1.35rem;font-weight:800;color:#0F172A;margin:0 0 8px;line-height:1.25;">' + prod.name + '</h3>' +
              '<div style="font-size:14px;font-weight:800;color:#0052FF;margin-bottom:12px;">' + (prod.price || 'Verified') + ' &bull; ★★★★★ (' + prod.rating + ')</div>' +
              '<div style="font-size:13.5px;color:#475569;line-height:1.65;">' + (prod.long_text || '<p>' + prod.description + '</p>') + '</div>' +
            '</div>' +
          '</div>' +

          '<div class="kc-procon-grid" style="margin-bottom:18px;">' +
            '<div class="pro-con-card" style="background:#F0FDF4;border:1px solid #86EFAC;">' +
              '<div style="font-size:11px;font-weight:900;color:#166534;text-transform:uppercase;margin-bottom:8px;">PROS (KEY ADVANTAGES)</div>' +
              '<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:6px;">' + prosList + '</ul>' +
            '</div>' +
            '<div class="pro-con-card" style="background:#FEF2F2;border:1px solid #FECACA;">' +
              '<div style="font-size:11px;font-weight:900;color:#991B1B;text-transform:uppercase;margin-bottom:8px;">CONS (LIMITATIONS)</div>' +
              '<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:6px;">' + consList + '</ul>' +
            '</div>' +
          '</div>' +

          (specsHtml ? '<div style="margin-bottom:18px;"><div style="font-size:12px;font-weight:800;color:#0F172A;text-transform:uppercase;margin-bottom:6px;">📊 Hardware &amp; Architectural Specifications</div>' + specsHtml + '</div>' : '') +

          (buyBtns ? '<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;padding-top:12px;border-top:1px solid #F1F5F9;">' + buyBtns + '</div>' : '') +
        '</div>';
      }).join('');
    } else {
      productsContainer.innerHTML = '';
    }
  }

  // 8. Load Post-Specific Verified 3 Top Reviews for this active article
  loadPostReviews(art.id);

  // 9. Update Sidebar active states
  renderSidebarNavigator();

  // 10. Update Browser URL
  if (window.history && window.history.pushState) {
    window.history.pushState(null, '', 'knowledge-center.php?id=' + art.id);
  }

  // Smooth scroll down to reader container
  document.getElementById('kcReaderLayout').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Close Reader View and Return to Full Overview Grid
function closeDynamicArticle() {
  document.getElementById('kcReaderLayout').style.display = 'none';
  document.getElementById('kcOverviewLayout').style.display = 'grid';
  if (window.history && window.history.pushState) {
    window.history.pushState(null, '', 'knowledge-center.php');
  }
  document.getElementById('kcOverviewLayout').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

// Audio Player Handlers for Reader
var readerAudio = document.getElementById('readerAudioPlayer');
var readerPlayBtn = document.getElementById('readerPlayBtn');
var readerScrubber = document.getElementById('readerScrubber');
var readerCurTime = document.getElementById('readerCurTime');
var readerDurTime = document.getElementById('readerDurTime');

function formatAudioTime(s) {
  var m = Math.floor(s / 60);
  var sec = Math.floor(s % 60);
  return (m < 10 ? '0' : '') + m + ':' + (sec < 10 ? '0' : '') + sec;
}

function toggleReaderAudio() {
  if (!readerAudio) return;
  if (readerAudio.paused) {
    readerAudio.play();
    readerPlayBtn.innerHTML = '❚❚';
  } else {
    readerAudio.pause();
    readerPlayBtn.innerHTML = '▶';
  }
}

if (readerAudio) {
  readerAudio.addEventListener('timeupdate', function() {
    if (!isNaN(readerAudio.duration) && readerAudio.duration > 0) {
      readerScrubber.value = (readerAudio.currentTime / readerAudio.duration) * 100;
      readerCurTime.textContent = formatAudioTime(readerAudio.currentTime);
      readerDurTime.textContent = formatAudioTime(readerAudio.duration);
    }
  });

  readerAudio.addEventListener('ended', function() {
    readerPlayBtn.innerHTML = '▶';
    readerScrubber.value = 0;
  });
}

function seekReaderAudio(val) {
  if (readerAudio && !isNaN(readerAudio.duration)) {
    readerAudio.currentTime = (val / 100) * readerAudio.duration;
  }
}

function setReaderSpeed(spd) {
  if (readerAudio) {
    readerAudio.playbackRate = spd;
    ['readerSpd-1', 'readerSpd-15', 'readerSpd-2'].forEach(function(id) {
      var btn = document.getElementById(id);
      if (btn) {
        btn.style.background = '#1E293B';
        btn.style.color = '#94A3B8';
        btn.style.borderColor = '#334155';
      }
    });
    var activeBtn = document.getElementById(spd === 1.0 ? 'readerSpd-1' : (spd === 1.5 ? 'readerSpd-15' : 'readerSpd-2'));
    if (activeBtn) {
      activeBtn.style.background = '#0052FF';
      activeBtn.style.color = '#fff';
      activeBtn.style.borderColor = '#0052FF';
    }
  }
}

function shareActiveArticle(type) {
  if (type === 'copy') {
    navigator.clipboard.writeText(window.location.href);
    alert('✓ Direct link copied to clipboard!');
  }
}

// Brand Wires Controller
var WIRE_DATA = <?= json_encode(!empty($brandWires) ? $brandWires : new stdClass(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

var currentWireBrand = 'google';

function selectWireBrand(brand) {
  currentWireBrand = brand;
  var b = (WIRE_DATA && WIRE_DATA[brand]) ? WIRE_DATA[brand] : null;

  var imgEl = document.getElementById('wireImg');
  if (imgEl) {
    var rawImg = b ? (b.img || b.image || b.image_url || b.local_image_path || 'assets/img/hero_img.webp') : 'assets/img/hero_img.webp';
    imgEl.src = rawImg;
    imgEl.alt = b ? (b.title || 'News Story Photo') : 'No verified item available';
    imgEl.onerror = function() {
      this.onerror = null;
      this.src = 'assets/img/hero_img.webp';
    };
  }
  var brandBadge = document.getElementById('wireBrandBadge');
  if (brandBadge) {
    brandBadge.textContent = b ? (b.brandBadge || brand.toUpperCase()) : (brand ? brand.toUpperCase() : 'WIRE');
  }
  var captionTag = document.getElementById('wireCaptionTag');
  if (captionTag) {
    captionTag.textContent = b ? (b.captionTag || 'OFFICIAL WIRE') : 'UNAVAILABLE';
  }
  var captionText = document.getElementById('wireCaptionText');
  if (captionText) {
    captionText.textContent = b ? (b.caption || ('📷 ' + (b.title || ''))) : '📷 No verified item available';
  }

  if (document.getElementById('wireCat')) document.getElementById('wireCat').textContent = b ? (b.cat || b.category || 'OFFICIAL WIRE') : 'OFFICIAL WIRE';
  if (document.getElementById('wireDate')) document.getElementById('wireDate').textContent = b ? (b.date || '') : '';
  if (document.getElementById('wireTitle')) document.getElementById('wireTitle').textContent = b ? (b.title || 'No verified item available') : 'No verified item available';
  if (document.getElementById('wireSummary')) document.getElementById('wireSummary').textContent = b ? (b.summary || b.desc || 'No verified item available for this provider.') : 'No verified item available for this provider.';
  if (document.getElementById('wireSourceName')) document.getElementById('wireSourceName').textContent = b ? (b.source || b.sourceName || '') : '';
  if (document.getElementById('wireSourceBtn')) {
    if (b && (b.link || b.sourceUrl)) {
      document.getElementById('wireSourceBtn').href = b.link || b.sourceUrl;
      document.getElementById('wireSourceBtn').style.display = 'inline-flex';
    } else {
      document.getElementById('wireSourceBtn').removeAttribute('href');
      document.getElementById('wireSourceBtn').style.display = 'none';
    }
  }

  var tabs = document.querySelectorAll('#intlWireTabsContainer .wire-tab-btn, .wire-tab-btn');
  tabs.forEach(function(el) {
    var p = el.getAttribute('data-provider') || (el.id ? el.id.replace('wireBtn-', '') : '');
    if (p === brand) {
      el.classList.add('tab-active');
      el.style.background = '#0052FF';
      el.style.color = '#fff';
    } else {
      el.classList.remove('tab-active');
      el.style.background = '#F1F5F9';
      el.style.color = '#475569';
    }
  });
}

// Breaking News Carousel (5 Verified Live Provider Stories)
var MAIN_NEWS_LIST = <?= json_encode(!empty($breakingNews) ? $breakingNews : [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

function switchMainNews(idx) {
  var item = MAIN_NEWS_LIST[idx];
  if (!item) return;
  var imgEl = document.getElementById('mainNewsImg');
  if (imgEl) {
    var rawImg = item.img || item.image || item.image_url || item.urlToImage || 'assets/img/hero_img.webp';
    imgEl.src = rawImg;
    imgEl.onerror = function() {
      this.onerror = null;
      this.src = 'assets/img/hero_img.webp';
    };
  }
  if (document.getElementById('mainNewsTag')) document.getElementById('mainNewsTag').textContent = item.tag || '';
  if (document.getElementById('mainNewsDate')) document.getElementById('mainNewsDate').textContent = item.date || '';
  if (document.getElementById('mainNewsSource')) document.getElementById('mainNewsSource').textContent = item.source || '';
  if (document.getElementById('mainNewsTitle')) document.getElementById('mainNewsTitle').textContent = item.title || '';
  if (document.getElementById('mainNewsDesc')) document.getElementById('mainNewsDesc').textContent = item.desc || '';
  if (document.getElementById('mainNewsLink') && item.link) document.getElementById('mainNewsLink').href = item.link;
}

function renderBreakingNewsList(list) {
  if (!list || !list.length) return;
  MAIN_NEWS_LIST = list;
  switchMainNews(0);

  var sideContainer = document.getElementById('sideNewsContainer');
  if (!sideContainer) return;

  var providerBadges = {
    apple:        { color: '#0284C7', label: '🍎 APPLE • HARDWARE & SILICON' },
    openai:       { color: '#7C3AED', label: '🤖 OPENAI • AI REASONING' },
    nvidia:       { color: '#059669', label: '⚡ NVIDIA • ACCELERATED AI' },
    anthropic:    { color: '#D97706', label: '🧠 ANTHROPIC • SAFETY RESEARCH' },
    google:       { color: '#0052FF', label: '🌐 GOOGLE • AI & DEVICES' },
    meta:         { color: '#0081FB', label: '♾️ META • OPEN SOURCE AI' },
    microsoft:    { color: '#00A4EF', label: '🪟 MICROSOFT • CLOUD & COPILOT' },
    intel:        { color: '#0071C5', label: '🔷 INTEL • NEXT-GEN SILICON' },
    dawn:         { color: '#059669', label: '🇵🇰 DAWN • TECH & SCIENCE' },
    brecorder:    { color: '#0284C7', label: '🇵🇰 B-RECORDER • FINTECH' },
    propakistani: { color: '#D97706', label: '🇵🇰 PROPAKISTANI • DIGITAL ECOSYSTEM' },
    tribune:      { color: '#DC2626', label: '🇵🇰 TRIBUNE • AEROSPACE & TECH' }
  };

  var html = '';
  for (var i = 1; i < Math.min(7, list.length); i++) {
    var s = list[i];
    var pKey = (s.provider || '').toLowerCase();
    var pBadge = providerBadges[pKey] || { color: '#475569', label: pKey.toUpperCase() };
    var img = s.img || s.image || s.image_url || 'assets/img/hero_img.webp';

    html += '<div onclick="switchMainNews(' + i + ')" style="background:#fff;border:1px solid #E2E8F0;border-radius:0.65rem;padding:0.75rem 0.9rem;cursor:pointer;transition:all 0.2s;box-shadow:0 1px 3px rgba(0,0,0,0.04);width:100%;box-sizing:border-box;" onmouseover="this.style.borderColor=\'#0052FF\';this.style.transform=\'translateY(-1px)\'" onmouseout="this.style.borderColor=\'#E2E8F0\';this.style.transform=\'none\'">' +
      '<div style="display:flex;gap:0.75rem;align-items:center;">' +
        '<div style="width:3.75rem;height:3.75rem;border-radius:6px;overflow:hidden;background:#0B1120;flex-shrink:0;">' +
          '<img src="' + img + '" alt="' + (s.title ? s.title.replace(/"/g, '&quot;') : '') + '" style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null;this.src=\'assets/img/hero_img.webp\';">' +
        '</div>' +
        '<div style="flex:1;min-width:0;">' +
          '<span style="font-size:9.5px;font-weight:800;color:' + pBadge.color + ';text-transform:uppercase;letter-spacing:0.04em;display:block;margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' + pBadge.label + '</span>' +
          '<h4 style="font-size:0.84rem;font-weight:700;color:#0F172A;line-height:1.3;margin:0 0 2px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">' + (s.title || '') + '</h4>' +
          '<span style="font-size:10.5px;color:#64748B;">' + (s.date || '') + '</span>' +
        '</div>' +
      '</div>' +
    '</div>';
  }
  sideContainer.innerHTML = html;
}

// Pakistan Regional Tech Wire Controller (Verified Real Feeds)
var REGIONAL_DATA = <?= json_encode(!empty($regionalWires) ? $regionalWires : new stdClass(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

var currentRegionalTab = 'dawn';

function selectRegionalTab(tab) {
  currentRegionalTab = tab;
  var r = (REGIONAL_DATA && REGIONAL_DATA[tab]) ? REGIONAL_DATA[tab] : null;

  var imgEl = document.getElementById('regImg');
  if (imgEl) {
    var rawImg = r ? (r.image || r.img || r.image_url || r.local_image_path || 'assets/img/hero_img.webp') : 'assets/img/hero_img.webp';
    imgEl.src = rawImg;
    imgEl.alt = r ? (r.title || 'Regional Story Photo') : 'No verified item available';
    imgEl.onerror = function() {
      this.onerror = null;
      this.src = 'assets/img/hero_img.webp';
    };
  }
  var brandBadge = document.getElementById('regBrandBadge');
  if (brandBadge) {
    brandBadge.textContent = r ? (r.brandBadge || tab.toUpperCase()) : (tab ? tab.toUpperCase() : 'REGIONAL');
  }
  var captionTag = document.getElementById('regCaptionTag');
  if (captionTag) {
    captionTag.textContent = r ? (r.captionTag || 'PAKISTAN TECH') : 'UNAVAILABLE';
  }
  var captionText = document.getElementById('regCaptionText');
  if (captionText) {
    captionText.textContent = r ? (r.caption || ('📷 ' + (r.title || ''))) : '📷 No verified item available';
  }

  if (document.getElementById('regCat')) document.getElementById('regCat').textContent = r ? (r.category || r.cat || 'PAKISTAN TECH') : 'PAKISTAN TECH';
  if (document.getElementById('regDate')) document.getElementById('regDate').textContent = r ? (r.date || '') : '';
  if (document.getElementById('regTitle')) document.getElementById('regTitle').textContent = r ? (r.title || 'No verified item available') : 'No verified item available';
  if (document.getElementById('regSummary')) document.getElementById('regSummary').textContent = r ? (r.summary || r.desc || 'No verified item available for this provider.') : 'No verified item available for this provider.';
  if (document.getElementById('regSourceName')) document.getElementById('regSourceName').textContent = r ? (r.sourceName || r.source || '') : '';
  if (document.getElementById('regSourceBtn')) {
    if (r && (r.sourceUrl || r.link)) {
      document.getElementById('regSourceBtn').href = r.sourceUrl || r.link;
      document.getElementById('regSourceBtn').style.display = 'inline-flex';
    } else {
      document.getElementById('regSourceBtn').removeAttribute('href');
      document.getElementById('regSourceBtn').style.display = 'none';
    }
  }

  var tabs = document.querySelectorAll('#pakWireTabsContainer .reg-tab-btn, .reg-tab-btn');
  tabs.forEach(function(el) {
    var p = el.getAttribute('data-provider') || (el.id ? el.id.replace('regBtn-', '') : '');
    if (p === tab) {
      el.classList.add('tab-active');
      el.style.background = '#059669';
      el.style.color = '#fff';
      el.style.border = 'none';
      el.style.boxShadow = '0 4px 6px -1px rgba(5,150,105,0.3)';
    } else {
      el.classList.remove('tab-active');
      el.style.background = '#fff';
      el.style.color = '#475569';
      el.style.border = '1px solid #CBD5E1';
      el.style.boxShadow = 'none';
    }
  });
}

// Topic Filter Controller (Strictly targets Category Directory; Trending remains independent)
function filterTopic(topic) {
  ['ALL','SEO','Hosting','Social','AI & Cloud','DevOps'].forEach(function(t) {
    var btn = document.getElementById('topicBtn-' + t);
    if (!btn) return;
    if (t === topic) {
      btn.style.background = '#0052FF';
      btn.style.color = '#fff';
    } else {
      btn.style.background = '#F1F5F9';
      btn.style.color = '#475569';
    }
  });

  var cards = document.querySelectorAll('#topicCardsGrid .topic-card-item');
  cards.forEach(function(c) {
    var t = c.getAttribute('data-topic');
    if (topic === 'ALL' || t === topic) {
      c.style.display = 'block';
    } else {
      c.style.display = 'none';
    }
  });
}

// =========================================================
// RIGHT SIDEBAR INTERACTIVE SLIDERS (Top Stories, Videos, Events)
// =========================================================
var SIDEBAR_STORIES_PAGES = [
  [
    { id: 1, icon: '💻', iconBg: '#1E293B', title: 'The 7 Best Enterprise AI &amp; Cloud Laptops in 2026', date: '15-Aug-2026' },
    { id: 2, icon: '🤖', iconBg: '#312E81', title: 'Artificial Intelligence Development: Modern AI Foundations', date: '18-Aug-2026' },
    { id: 3, icon: '📈', iconBg: '#0F766E', title: 'International Growth &amp; High-Throughput Cloud Scaling', date: '25-Apr-2026' }
  ],
  [
    { id: 2, icon: '🛡️', iconBg: '#7C2D12', title: 'Autonomous Neural Threat Detection &amp; Zero Trust', date: '12-Aug-2026' },
    { id: 1, icon: '⚡', iconBg: '#0369A1', title: 'High-Performance eBPF Network Mesh Routing', date: '08-Aug-2026' },
    { id: 3, icon: '🌐', iconBg: '#4338CA', title: 'Distributed Multi-Region Cloud Database Replication', date: '05-Aug-2026' }
  ],
  [
    { id: 1, icon: '🧠', iconBg: '#15803D', title: 'LLM Inference Latency Optimization at 120k TPS', date: '01-Aug-2026' },
    { id: 2, icon: '🔐', iconBg: '#6B21A8', title: 'Post-Quantum Cryptography Enterprise Standards', date: '28-Jul-2026' },
    { id: 3, icon: '🚀', iconBg: '#9D174D', title: 'Container Orchestration &amp; Microservices Governance', date: '22-Jul-2026' }
  ]
];

var SIDEBAR_VIDEOS_PAGES = [
  [
    { title: 'WHAT ARE SOCIAL ADVERTISING?', date: '25-Apr-2024' },
    { title: 'ENTERPRISE AI ARCHITECTURE', date: '18-Apr-2024' },
    { title: 'HYBRID CLOUD DEVOPS TEARDOWN', date: '12-May-2024' }
  ],
  [
    { title: 'KUBERNETES AT 10M DAU: LESSONS LEARNED', date: '04-Jun-2024' },
    { title: 'MODERN CI/CD PIPELINE SECURITY HARDENING', date: '22-May-2024' },
    { title: 'GRAPHQL VS REST IN HIGH-THROUGHPUT SYSTEMS', date: '15-May-2024' }
  ],
  [
    { title: 'EVALUATING OPEN SOURCE LLMS FOR ENTERPRISE', date: '10-Jul-2024' },
    { title: 'DATABASE SHARDING &amp; ZERO-DOWNTIME MIGRATION', date: '29-Jun-2024' },
    { title: 'EVENT-DRIVEN ARCHITECTURES WITH KAFKA', date: '18-Jun-2024' }
  ]
];

var SIDEBAR_EVENTS_PAGES = [
  [
    { day: '13', month: 'APR', title: 'International Conference on World Cloud Architecture', date: '25-Apr-2026' },
    { day: '28', month: 'MAY', title: 'Global AI &amp; Autonomous Agents Summit 2026', date: '28-May-2026' },
    { day: '15', month: 'JUN', title: 'Enterprise Cybersecurity &amp; Threat Modeling Workshop', date: '15-Jun-2026' }
  ],
  [
    { day: '22', month: 'JUL', title: 'Silicon &amp; Accelerated Computing Expo 2026', date: '22-Jul-2026' },
    { day: '18', month: 'AUG', title: 'Next-Gen Microservices &amp; Cloud Native Forum', date: '18-Aug-2026' },
    { day: '09', month: 'SEP', title: 'Global Tech Leadership &amp; Founder Round Table', date: '09-Sep-2026' }
  ],
  [
    { day: '14', month: 'OCT', title: 'Enterprise Data Mesh &amp; Real-time Analytics Summit', date: '14-Oct-2026' },
    { day: '05', month: 'NOV', title: 'AI Safety, Governance &amp; Alignment World Congress', date: '05-Nov-2026' },
    { day: '12', month: 'DEC', title: 'Annual Global Software Architecture Conference', date: '12-Dec-2026' }
  ]
];

var currentStoriesPage = 0;
var currentVideosPage = 0;
var currentEventsPage = 0;

function renderStoriesWidget() {
  var containers = document.querySelectorAll('.sidebar-top-stories-list');
  var page = SIDEBAR_STORIES_PAGES[currentStoriesPage];
  containers.forEach(function(c) {
    c.style.opacity = '0';
    setTimeout(function() {
      c.innerHTML = page.map(function(item, idx) {
        return '<a href="blog_detail?id=' + item.id + '" onclick="openDynamicArticle(' + item.id + ', event)" style="text-decoration:none;display:flex;align-items:center;gap:12px;' + (idx > 0 ? 'padding-top:0.5rem;border-top:1px solid #F9FAFB;' : '') + '">' +
          '<div style="width:3.5rem;height:3.5rem;border-radius:8px;background:' + item.iconBg + ';flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">' + item.icon + '</div>' +
          '<div>' +
            '<h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">' + item.title + '</h5>' +
            '<span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">' + item.date + '</span>' +
          '</div>' +
        '</a>';
      }).join('');
      c.style.opacity = '1';
    }, 120);
  });
}

function renderVideosWidget() {
  var containers = document.querySelectorAll('.sidebar-videos-list');
  var page = SIDEBAR_VIDEOS_PAGES[currentVideosPage];
  containers.forEach(function(c) {
    c.style.opacity = '0';
    setTimeout(function() {
      c.innerHTML = page.map(function(item) {
        return '<div onclick="openVideoModal()" style="display:flex;align-items:center;gap:12px;cursor:pointer;">' +
          '<div style="width:3.5rem;height:3.5rem;border-radius:8px;background:#312E81;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;font-size:14px;transition:transform 0.2s;" onmouseover="this.style.transform=\'scale(1.08)\'" onmouseout="this.style.transform=\'scale(1)\'">▶</div>' +
          '<div>' +
            '<h5 style="font-size:12px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;text-transform:uppercase;">' + item.title + '</h5>' +
            '<span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">' + item.date + '</span>' +
          '</div>' +
        '</div>';
      }).join('');
      c.style.opacity = '1';
    }, 120);
  });
}

function renderEventsWidget() {
  var containers = document.querySelectorAll('.sidebar-events-list');
  var page = SIDEBAR_EVENTS_PAGES[currentEventsPage];
  containers.forEach(function(c) {
    c.style.opacity = '0';
    setTimeout(function() {
      c.innerHTML = page.map(function(item) {
        return '<div onclick="openEventModal(\'' + item.title.replace(/'/g, "\\'") + '\')" style="display:flex;align-items:center;gap:14px;cursor:pointer;" class="event-item-row">' +
          '<div style="width:3rem;height:3rem;border-radius:10px;background:#F1F5F9;border:1px solid #E2E8F0;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;">' +
            '<span style="font-size:0.875rem;font-weight:700;color:#0F172A;line-height:1;">' + item.day + '</span>' +
            '<span style="font-size:9px;font-weight:700;color:#64748B;letter-spacing:0.05em;">' + item.month + '</span>' +
          '</div>' +
          '<div>' +
            '<h5 style="font-size:12.5px;font-weight:700;color:#111827;line-height:1.35;margin:0 0 2px;">' + item.title + '</h5>' +
            '<span style="font-size:10.5px;color:#9CA3AF;font-weight:600;">' + item.date + '</span>' +
          '</div>' +
        '</div>';
      }).join('');
      c.style.opacity = '1';
    }, 120);
  });
}

function prevTopStories() {
  currentStoriesPage = (currentStoriesPage - 1 + SIDEBAR_STORIES_PAGES.length) % SIDEBAR_STORIES_PAGES.length;
  renderStoriesWidget();
}
function nextTopStories() {
  currentStoriesPage = (currentStoriesPage + 1) % SIDEBAR_STORIES_PAGES.length;
  renderStoriesWidget();
}

function prevVideos() {
  currentVideosPage = (currentVideosPage - 1 + SIDEBAR_VIDEOS_PAGES.length) % SIDEBAR_VIDEOS_PAGES.length;
  renderVideosWidget();
}
function nextVideos() {
  currentVideosPage = (currentVideosPage + 1) % SIDEBAR_VIDEOS_PAGES.length;
  renderVideosWidget();
}

function prevEvents() {
  currentEventsPage = (currentEventsPage - 1 + SIDEBAR_EVENTS_PAGES.length) % SIDEBAR_EVENTS_PAGES.length;
  renderEventsWidget();
}
function nextEvents() {
  currentEventsPage = (currentEventsPage + 1) % SIDEBAR_EVENTS_PAGES.length;
  renderEventsWidget();
}

// =========================================================
// 3D STACKED BADGE TESTIMONIALS (Persistent DOM Motion Deck)
// =========================================================
var DECK_ITEMS = [
  {
    company: "SQUIRE",
    quote: "Robin and Creed Tech consistently deliver clean, intuitive designs that strike the perfect balance between aesthetic and usability. Whether it's for a complex workflow or a lightweight self-service feature, the user experience always feels effortless and refined.",
    author: "Dave Salvant",
    role: "Co-Founder of Squire",
    avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "HIREFRESH",
    quote: "It's always an extraordinary pleasure working with Creed Tech. They bring 100% engineering rigor to each milestone and execute mission-critical cloud workflows when they are needed the most.",
    author: "Vlad Hryhoren",
    role: "UX/UI Director @ HiRefresh",
    avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "ADOR NETWORK",
    quote: "We engaged Creed Tech with the goal of scaling our high-throughput transactional infrastructure. Their team was extraordinary in orchestrating zero-downtime microservices and cloud automation.",
    author: "Jonathan Anastas",
    role: "Chief Marketing Officer @ Ador",
    avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "COGNITIVE HEALTH",
    quote: "Crystal-clear documentation, transparent code audits, and proactive communication. Finding rigorously tested enterprise AI and data synchronization capabilities like this is extraordinarily rare.",
    author: "Elena Rostova",
    role: "AI Product Lead @ Cognitive Health",
    avatar: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  },
  {
    company: "CLOUDNATIVE GLOBAL",
    quote: "Creed Tech has an amazing squad of principal engineers. They possess deep, practical mastery over modern cloud topologies, eBPF routing, and deliver rock-solid results on every sprint.",
    author: "Alex Linetski",
    role: "Principal SRE Architect @ CloudNative",
    avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=180&auto=format&fit=crop&q=80",
    linkedin: "https://linkedin.com"
  }
];

var deckActiveIndex = 0;
var deckTimer = null;
var isDeckPaused = false;
var isDeckBusy = false;

// Initial Setup: Render permanent cards in DOM once
function initDeckCards() {
  var container = document.getElementById('deckCardsContainer');
  if (!container) return;

  container.innerHTML = DECK_ITEMS.map(function(c, idx) {
    return '<div id="deckCardItem-' + idx + '" class="deck-card-elem" onclick="nextDeckCard(event)" style="position:absolute;top:0;left:0;right:0;background:#FFFFFF;border-radius:20px;padding:36px 42px;border:1px solid #E5E7EB;box-sizing:border-box;user-select:none;text-align:left;will-change:transform,opacity;cursor:pointer;">' +
      '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">' +
        '<span style="font-size:1.3rem;font-weight:900;letter-spacing:0.04em;color:#0F172A;text-transform:uppercase;font-family:Impact, \'Arial Black\', -apple-system, sans-serif;">' + c.company + '</span>' +
        '<span style="color:#94A3B8;font-size:18px;letter-spacing:3px;">•••</span>' +
      '</div>' +
      '<div style="font-size:2.25rem;color:#0F172A;line-height:1;margin-bottom:12px;font-family:Georgia, serif;font-weight:900;">&ldquo;</div>' +
      '<p style="font-size:15px;color:#334155;line-height:1.75;margin:0 0 24px;font-weight:400;min-height:76px;">' + c.quote + '</p>' +
      '<div style="display:flex;align-items:center;justify-content:space-between;padding-top:18px;border-top:1px solid #F1F5F9;">' +
        '<div style="display:flex;align-items:center;gap:14px;">' +
          '<img src="' + c.avatar + '" alt="' + c.author + '" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #F1F5F9;box-shadow:0 1px 3px rgba(0,0,0,0.06);">' +
          '<div>' +
            '<h4 style="font-size:14.5px;font-weight:800;color:#0F172A;margin:0 0 2px;">' + c.author + '</h4>' +
            '<span style="font-size:12px;color:#64748B;font-weight:500;">' + c.role + '</span>' +
          '</div>' +
        '</div>' +
        '<a href="' + (c.linkedin || '#') + '" target="_blank" onclick="event.stopPropagation()" style="width:34px;height:34px;border-radius:8px;background:#F1F5F9;display:flex;align-items:center;justify-content:center;color:#0A66C2;font-weight:800;font-size:14px;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background=\'#E2E8F0\'" onmouseout="this.style.background=\'#F1F5F9\'">in</a>' +
      '</div>' +
    '</div>';
  }).join('');

  applyDeckStackTransforms(false);
  renderDeckDots();
}

// Apply transform styles to all cards based on their relative stack position
function applyDeckStackTransforms(withTransition) {
  var total = DECK_ITEMS.length;
  var transStyle = withTransition ? 'transform 0.85s cubic-bezier(0.2, 0.9, 0.3, 1), opacity 0.7s ease, box-shadow 0.7s ease' : 'none';

  for (var i = 0; i < total; i++) {
    var el = document.getElementById('deckCardItem-' + i);
    if (!el) continue;

    // Relative position from active index (0 = front, 1 = middle, 2 = back, etc.)
    var relPos = (i - deckActiveIndex + total) % total;

    el.style.transition = transStyle;

    if (relPos === 0) {
      // Front Active Card
      el.style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
      el.style.opacity = '1';
      el.style.zIndex = '10';
      el.style.boxShadow = '0 25px 50px -12px rgba(0,0,0,0.12), 0 1px 3px rgba(0,0,0,0.05)';
      el.style.pointerEvents = 'auto';
    } else if (relPos === 1) {
      // Second Card (Middle Stack)
      el.style.transform = 'translate3d(0, 18px, -40px) scale(0.96) rotate(-2deg)';
      el.style.opacity = '0.9';
      el.style.zIndex = '8';
      el.style.boxShadow = '0 16px 32px -8px rgba(0,0,0,0.08)';
      el.style.pointerEvents = 'none';
    } else if (relPos === 2) {
      // Third Card (Back Stack)
      el.style.transform = 'translate3d(0, 36px, -80px) scale(0.92) rotate(2deg)';
      el.style.opacity = '0.68';
      el.style.zIndex = '6';
      el.style.boxShadow = '0 10px 20px -6px rgba(0,0,0,0.04)';
      el.style.pointerEvents = 'none';
    } else {
      // Hidden Queue Cards
      el.style.transform = 'translate3d(0, 48px, -120px) scale(0.88) rotate(0deg)';
      el.style.opacity = '0';
      el.style.zIndex = '2';
      el.style.boxShadow = 'none';
      el.style.pointerEvents = 'none';
    }
  }

  renderDeckDots();
}

// Reset and Restart the Autoplay Timer after user interactions
function resetDeckTimer() {
  if (deckTimer) {
    clearInterval(deckTimer);
    deckTimer = null;
  }
  startDeckAutoRotate();
}

// Fluid Card Slide-Out to Back Motion
function nextDeckCard(e) {
  if (e) {
    e.stopPropagation();
    resetDeckTimer();
  }
  if (isDeckBusy) return;
  isDeckBusy = true;

  var total = DECK_ITEMS.length;
  var curFrontIdx = deckActiveIndex;
  var nextActiveIdx = (deckActiveIndex + 1) % total;
  var frontEl = document.getElementById('deckCardItem-' + curFrontIdx);

  if (frontEl) {
    // Phase 1 (0ms - 400ms): Front card slides out smoothly
    frontEl.style.transition = 'transform 0.55s cubic-bezier(0.2, 0.85, 0.35, 1), opacity 0.5s ease, box-shadow 0.5s ease';
    frontEl.style.transform = 'translate3d(160px, -25px, 60px) rotate(10deg) scale(1.02)';
    frontEl.style.boxShadow = '0 35px 70px -15px rgba(0,0,0,0.18)';
    frontEl.style.zIndex = '20';

    // Other cards glide forward into their next stack slot
    for (var i = 0; i < total; i++) {
      if (i === curFrontIdx) continue;
      var el = document.getElementById('deckCardItem-' + i);
      if (!el) continue;

      var newRelPos = (i - nextActiveIdx + total) % total;
      el.style.transition = 'transform 0.75s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.65s ease, box-shadow 0.65s ease';

      if (newRelPos === 0) {
        el.style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
        el.style.opacity = '1';
        el.style.zIndex = '10';
        el.style.boxShadow = '0 25px 50px -12px rgba(0,0,0,0.12), 0 1px 3px rgba(0,0,0,0.05)';
        el.style.pointerEvents = 'auto';
      } else if (newRelPos === 1) {
        el.style.transform = 'translate3d(0, 18px, -40px) scale(0.96) rotate(-2deg)';
        el.style.opacity = '0.9';
        el.style.zIndex = '8';
        el.style.boxShadow = '0 16px 32px -8px rgba(0,0,0,0.08)';
        el.style.pointerEvents = 'none';
      } else if (newRelPos === 2) {
        el.style.transform = 'translate3d(0, 36px, -80px) scale(0.92) rotate(2deg)';
        el.style.opacity = '0.68';
        el.style.zIndex = '6';
        el.style.boxShadow = '0 10px 20px -6px rgba(0,0,0,0.04)';
        el.style.pointerEvents = 'none';
      } else {
        el.style.transform = 'translate3d(0, 48px, -120px) scale(0.88) rotate(0deg)';
        el.style.opacity = '0';
        el.style.zIndex = '2';
        el.style.boxShadow = 'none';
        el.style.pointerEvents = 'none';
      }
    }

    // Phase 2 (380ms): Drop behind stack into back slot
    setTimeout(function() {
      if (frontEl) {
        frontEl.style.transition = 'transform 0.55s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.5s ease, box-shadow 0.5s ease';
        frontEl.style.zIndex = '4';
        frontEl.style.transform = 'translate3d(0, 36px, -80px) scale(0.92) rotate(2deg)';
        frontEl.style.opacity = '0.68';
        frontEl.style.boxShadow = '0 10px 20px -6px rgba(0,0,0,0.04)';
        frontEl.style.pointerEvents = 'none';
      }
    }, 380);

    // Phase 3 (850ms): Finalize state
    setTimeout(function() {
      deckActiveIndex = nextActiveIdx;
      applyDeckStackTransforms(false);
      isDeckBusy = false;
    }, 850);

  } else {
    deckActiveIndex = nextActiveIdx;
    applyDeckStackTransforms(true);
    isDeckBusy = false;
  }
}

function prevDeckCard(e) {
  if (e) e.stopPropagation();
  resetDeckTimer();
  if (isDeckBusy) return;
  isDeckBusy = true;
  deckActiveIndex = (deckActiveIndex - 1 + DECK_ITEMS.length) % DECK_ITEMS.length;
  applyDeckStackTransforms(true);
  setTimeout(function() { isDeckBusy = false; }, 800);
}

function jumpToDeckCard(idx, e) {
  if (e) e.stopPropagation();
  resetDeckTimer();
  if (isDeckBusy || idx === deckActiveIndex) return;
  isDeckBusy = true;
  deckActiveIndex = idx;
  applyDeckStackTransforms(true);
  setTimeout(function() { isDeckBusy = false; }, 800);
}

function renderDeckDots() {
  var dotsContainer = document.getElementById('deckProgressDots');
  if (!dotsContainer) return;
  var total = DECK_ITEMS.length;
  var html = '';
  for (var i = 0; i < total; i++) {
    var isActive = (i === deckActiveIndex);
    html += '<span onclick="jumpToDeckCard(' + i + ', event)" style="display:inline-block;height:4px;width:' + (isActive ? '26px' : '9px') + ';background:' + (isActive ? '#0F172A' : '#CBD5E1') + ';cursor:pointer;border-radius:2px;transition:all 0.35s ease;"></span>';
  }
  dotsContainer.innerHTML = html;
}

function startDeckAutoRotate() {
  if (deckTimer) {
    clearInterval(deckTimer);
    deckTimer = null;
  }
  // Smooth auto-slide every 3.8 seconds
  deckTimer = setInterval(function() {
    if (!isDeckPaused && !document.hidden) {
      nextDeckCard();
    }
  }, 3800);
}

// Modals
function openVideoModal() {
  document.getElementById('videoModal').style.display = 'flex';
}
function closeVideoModal() {
  document.getElementById('videoModal').style.display = 'none';
}

function openEventModal(eventTitle) {
  document.getElementById('modalEventTitle').textContent = eventTitle;
  document.getElementById('eventModal').style.display = 'flex';
}
function closeEventModal() {
  document.getElementById('eventModal').style.display = 'none';
}

function handleEventRegister(e) {
  e.preventDefault();
  alert('Registration confirmed! We have emailed your event access pass.');
  closeEventModal();
}

// Fetch Live Tech Feeds API (Continuous Live Background Polling)
async function fetchLiveNewsAPI() {
  try {
    const res = await fetch('/ajax/live_tech_news.php?t=' + Date.now());
    if (!res.ok) return;
    const data = await res.json();
    if (data.status === 'success') {
      if (data.brand_wires && Object.keys(data.brand_wires).length > 0) {
        WIRE_DATA = data.brand_wires;
        selectWireBrand(currentWireBrand);
      }
      if (data.regional_wires && Object.keys(data.regional_wires).length > 0) {
        REGIONAL_DATA = data.regional_wires;
        selectRegionalTab(currentRegionalTab);
      }
      if (data.breaking_news && Array.isArray(data.breaking_news) && data.breaking_news.length > 0) {
        renderBreakingNewsList(data.breaking_news);
      }
    }
  } catch (err) {
    console.log('Live news API fallback active:', err);
  }
}

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
  renderSidebarNavigator();
  initDeckCards();
  startDeckAutoRotate();

  // Only pause when hovering directly over the card deck, not the entire page section
  var deckWrap = document.getElementById('badgeDeckWrapper') || document.getElementById('deckCardsContainer');
  if (deckWrap) {
    deckWrap.addEventListener('mouseenter', function() { isDeckPaused = true; });
    deckWrap.addEventListener('mouseleave', function() { isDeckPaused = false; resetDeckTimer(); });
  }

  document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
      isDeckPaused = true;
    } else {
      isDeckPaused = false;
      resetDeckTimer();
    }
  });

  // IntersectionObserver to ensure autoplay resumes whenever user scrolls to the reviews section
  if ('IntersectionObserver' in window) {
    var obsTarget = document.getElementById('reviewCarouselSection');
    if (obsTarget) {
      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            isDeckPaused = false;
            resetDeckTimer();
          }
        });
      }, { threshold: 0.15 });
      observer.observe(obsTarget);
    }
  }
  
  // Bind International Wire Tabs with scoped event delegation
  var intlContainer = document.getElementById('intlWireTabsContainer');
  if (intlContainer) {
    intlContainer.addEventListener('click', function(e) {
      var btn = e.target.closest('.wire-tab-btn, button[data-provider]');
      if (btn) {
        var provider = btn.getAttribute('data-provider');
        if (provider) selectWireBrand(provider);
      }
    });
  }

  // Bind Pakistani Regional Wire Tabs with scoped event delegation
  var pakContainer = document.getElementById('pakWireTabsContainer');
  if (pakContainer) {
    pakContainer.addEventListener('click', function(e) {
      var btn = e.target.closest('.reg-tab-btn, button[data-provider]');
      if (btn) {
        var provider = btn.getAttribute('data-provider');
        if (provider) selectRegionalTab(provider);
      }
    });
  }

  // Initial live news fetch
  fetchLiveNewsAPI();

  // Real-time Background Auto-Update: Polls live API every 60 seconds automatically
  setInterval(fetchLiveNewsAPI, 60000);

  var urlParams = new URLSearchParams(window.location.search);
  var targetId = urlParams.get('id');
  if (targetId) {
    openDynamicArticle(parseInt(targetId));
  }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
