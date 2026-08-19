<?php
$page_title = "Enterprise Services & Engineering Capabilities | Creed Tech";
$page_description = "Explore Creed Tech's end-to-end enterprise IT services including cloud architecture, AI automation, custom software engineering, cybersecurity, and mobile applications.";
$active_page = "services";
$extra_head_tags = '<link rel="preload" as="image" href="images/services-hero-bg.webp" type="image/webp" fetchpriority="high">';
include __DIR__ . '/includes/header.php';
?>

<!-- 1. HERO BANNER -->
<!-- 1. HERO BANNER -->
<style>
  .services-hero-banner {
    background-color: #F8F5F0;
    background-image: url('images/services-hero-bg.webp');
    background-image: image-set(url('images/services-hero-bg.webp') type('image/webp'), url('images/services-hero-bg.jpg') type('image/jpeg'));
    background-size: cover;
    background-position: right center;
    background-repeat: no-repeat;
    width: 100%;
    padding: 5.5rem 0 6.5rem;
    border-bottom: 1px solid #E8E2D9;
    position: relative;
    overflow: hidden;
  }
  .services-pdp-section {
    width: 100%;
    padding: 5.5rem 0;
    background: #0B1120;
    color: #fff;
    position: relative;
    overflow: hidden;
    border-top: 1px solid rgba(30,41,59,0.7);
    border-bottom: 1px solid rgba(30,41,59,0.7);
  }
  .services-projects-section {
    width: 100%;
    padding: 5.5rem 0;
    background: #050B14;
    color: #fff;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid #111827;
  }
  .services-guarantee-section {
    width: 100%;
    padding: 5.5rem 0;
    background: #fff;
    border-bottom: 1px solid #F3F4F6;
  }
  .services-industries-section {
    width: 100%;
    padding: 5.5rem 0;
    background: #080E1A;
    color: #fff;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid #111827;
  }
  .services-vision-section {
    width: 100%;
    padding: 5.5rem 0;
    background: #fff;
    border-bottom: 1px solid #F3F4F6;
  }
  .services-bottom-cta-section {
    width: 100%;
    background: #0B1120;
    padding: 4.5rem 0;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
  }

  @media (max-width: 768px) {
    .services-hero-banner {
      padding: 2.75rem 0 3rem;
    }
    .services-pdp-section {
      padding: 2.75rem 0;
    }
    .services-projects-section {
      padding: 2.75rem 0;
    }
    .services-guarantee-section {
      padding: 2.5rem 0;
    }
    .services-industries-section {
      padding: 2.5rem 0;
    }
    .services-vision-section {
      padding: 2.75rem 0;
    }
    .services-bottom-cta-section {
      padding: 2.75rem 0;
    }
  }
</style>
<section class="services-hero-banner">
  <div style="position:absolute;inset:0;background:linear-gradient(to right, rgba(255,255,255,0.97) 0%, rgba(255,255,255,0.93) 45%, rgba(255,255,255,0.8) 75%, rgba(255,255,255,0.5) 100%);pointer-events:none;"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
    <div style="max-width:38rem;text-align:left;">
      <div style="display:inline-flex;align-items:center;gap:8px;padding:5px 14px;background:#FFFFFF;border:1px solid #CBD5E1;color:#0F172A;font-size:11.5px;font-weight:800;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.65rem;border-radius:4px;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
        <span style="width:7px;height:7px;border-radius:50%;background:#FF6B00;display:inline-block;"></span>
        <span>ENTERPRISE CAPABILITIES &amp; SOLUTIONS</span>
      </div>
      <h1 style="font-size:clamp(1.75rem,3.8vw,2.75rem);font-weight:800;letter-spacing:-0.03em;color:#0F172A;margin-bottom:0.65rem;line-height:1.2;">
        Architecting Enterprise <br>
        <span style="color:#0052FF;">IT &amp; Cloud Solutions</span>
      </h1>
      <p style="font-size:0.95rem;font-weight:600;color:#0F172A;line-height:1.6;margin-bottom:0.35rem;">End-to-end cloud infrastructure, bespoke software engineering, AI automation, and cybersecurity.</p>
      <p style="font-size:0.92rem;font-weight:500;color:#1E293B;line-height:1.6;margin-bottom:1rem;">Engineered for unprecedented enterprise scale, high availability, and cryptographic data protection.</p>
      <div class="grid grid-cols-2 gap-3 max-w-sm sm:max-w-md">
        <a href="contact" class="inline-flex items-center justify-center bg-[#0052FF] hover:bg-[#0043D6] text-white font-bold text-xs sm:text-sm h-10 sm:h-11 px-3 sm:px-5 rounded-md shadow-sm transition-all duration-200 text-center whitespace-nowrap">
          Start Your Project
        </a>
        <a href="#what-we-provide" class="inline-flex items-center justify-center bg-white hover:bg-gray-50 border-2 border-[#0052FF] text-[#0052FF] hover:text-[#0043D6] font-bold text-xs sm:text-sm h-10 sm:h-11 px-3 sm:px-5 rounded-md shadow-2xs transition-all duration-200 text-center whitespace-nowrap">
          Explore Services ↓
        </a>
      </div>
    </div>
  </div>
</section>

<!-- 2. PROJECT DELIVERY PROCESS -->
<section id="delivery-process" class="services-pdp-section">
  <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 50%, rgba(255,107,0,0.18) 0%, rgba(255,107,0,0.06) 45%, transparent 75%);"></div>
  <div style="position:absolute;inset:0;opacity:0.06;pointer-events:none;background-image:linear-gradient(to right,#fff 1px,transparent 1px),linear-gradient(to bottom,#fff 1px,transparent 1px);background-size:40px 40px;"></div>

  <div style="max-width:80rem;margin:0 auto;padding:0 1.5rem sm:padding:0 3rem;position:relative;z-index:10;">
    <div style="text-align:center;max-width:48rem;margin:0 auto 2rem;">
      <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:600;color:#fff;letter-spacing:-0.02em;margin-bottom:0.5rem;">OUR PROJECT DELIVERY PROCESS</h2>
      <p style="font-size:0.875rem;color:#D1D5DB;line-height:1.65;margin:0;">A clear eight-step process from discovery and planning to launch and continued growth.</p>
    </div>

    <style>
      .pdp-desktop-wrap { display: block; position: relative; contain: layout style; }
      .pdp-mobile-wrap { display: none; position: relative; padding-left: 1.5rem; border-left: 2px solid #334155; margin-left: 1rem; contain: layout style; }
      @media (max-width: 1023px) {
        .pdp-desktop-wrap { display: none !important; }
        .pdp-mobile-wrap { display: block !important; }
      }
      .pdp-card-box { display: flex; flex-direction: column; align-items: center; text-align: center; cursor: default; transform: translateZ(0); }
      .pdp-card-box:hover .pdp-iso-svg { transform: translateY(-8px) scale(1.05); }
      .pdp-iso-svg { width: 9rem; height: 7rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1); will-change: transform; }
      .pdp-iso-svg svg { width: 100%; height: 100%; display: block; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.3)); }
    </style>

    <!-- Desktop S-Layout -->
    <div class="pdp-desktop-wrap">
      <!-- Connecting Pipeline SVG -->
      <svg style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:0;" viewBox="0 0 1100 480" fill="none">
        <circle cx="20" cy="88" r="4" fill="#64748B"/>
        <line x1="20" y1="88" x2="65" y2="88" stroke="#334155" stroke-width="2"/>
        <line x1="145" y1="88" x2="335" y2="88" stroke="#334155" stroke-width="2"/>
        <polygon points="245,84 253,88 245,92" fill="#FF6A00"/>
        <line x1="415" y1="88" x2="605" y2="88" stroke="#334155" stroke-width="2"/>
        <polygon points="515,84 523,88 515,92" fill="#FF6A00"/>
        <line x1="685" y1="88" x2="875" y2="88" stroke="#334155" stroke-width="2"/>
        <polygon points="785,84 793,88 785,92" fill="#FF6A00"/>
        <path d="M955 88 L1045 88 A 20 20 0 0 1 1065 108 L1065 308 A 20 20 0 0 1 1045 328 L955 328" stroke="#334155" stroke-width="2" fill="none"/>
        <polygon points="1061,200 1065,212 1069,200" fill="#FF6A00"/>
        <line x1="875" y1="328" x2="685" y2="328" stroke="#334155" stroke-width="2"/>
        <polygon points="785,324 777,328 785,332" fill="#FF6A00"/>
        <line x1="605" y1="328" x2="415" y2="328" stroke="#334155" stroke-width="2"/>
        <polygon points="515,324 507,328 515,332" fill="#FF6A00"/>
        <line x1="335" y1="328" x2="145" y2="328" stroke="#334155" stroke-width="2"/>
        <polygon points="245,324 237,328 245,332" fill="#FF6A00"/>
        <line x1="65" y1="328" x2="20" y2="328" stroke="#334155" stroke-width="2"/>
        <circle cx="20" cy="328" r="5" fill="#FF6A00" stroke="#FFF" stroke-width="1.5"/>
      </svg>

      <!-- Row 1: Steps 01 to 04 -->
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-bottom:2rem;position:relative;z-index:10;">
        
        <!-- 01 Discovery -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <rect x="25" y="22" width="34" height="24" rx="12" fill="#FF6A00" stroke="#FFF" stroke-width="1"/>
              <path d="M35 44 L29 50 L33 44 Z" fill="#FF6A00"/>
              <circle cx="36" cy="34" r="2.5" fill="#FFF"/><circle cx="42" cy="34" r="2.5" fill="#FFF"/><circle cx="48" cy="34" r="2.5" fill="#FFF"/>
              <circle cx="82" cy="48" r="22" fill="#0B1F3A" stroke="#334155" stroke-width="1.5"/>
              <circle cx="82" cy="48" r="16" fill="#FFF" stroke="#0A66FF" stroke-width="2.5"/>
              <ellipse cx="82" cy="48" rx="13" ry="13" fill="#EFF6FF"/>
              <path d="M74 42 Q82 38 88 42" stroke="#38BDF8" stroke-width="2" stroke-linecap="round"/>
              <path d="M95 63 L112 80" stroke="#0B1F3A" stroke-width="7" stroke-linecap="round"/>
              <path d="M95 63 L112 80" stroke="#0A66FF" stroke-width="3" stroke-linecap="round"/>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">01</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">DISCOVERY</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Goals • Users • Challenges</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We explore the idea, goals, users, and challenges.</p>
            <p style="margin:0;">Key details are clarified before the project begins.</p>
          </div>
        </div>

        <!-- 02 Requirements -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <rect x="54" y="22" width="52" height="66" rx="6" fill="#0B1F3A"/>
              <rect x="58" y="28" width="44" height="56" rx="3" fill="#FFF"/>
              <rect x="68" y="16" width="24" height="10" rx="3" fill="#0A66FF"/>
              <circle cx="80" cy="21" r="2.5" fill="#FFF"/>
              <rect x="64" y="36" width="8" height="8" rx="1.5" fill="#0A66FF"/>
              <path d="M66 40 L68 42 L71 38" stroke="#FFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <line x1="76" y1="40" x2="94" y2="40" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round"/>
              <rect x="64" y="48" width="8" height="8" rx="1.5" fill="#0A66FF"/>
              <path d="M66 52 L68 54 L71 50" stroke="#FFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <line x1="76" y1="52" x2="94" y2="52" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round"/>
              <rect x="64" y="60" width="8" height="8" rx="1.5" fill="#0A66FF"/>
              <path d="M66 64 L68 66 L71 62" stroke="#FFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <line x1="76" y1="64" x2="94" y2="64" stroke="#94A3B8" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">02</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">REQUIREMENTS</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Scope • Features • Priorities</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We define the scope, features, and priorities.</p>
            <p style="margin:0;">Requirements and deliverables are documented clearly.</p>
          </div>
        </div>

        <!-- 03 Planning -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <path d="M50 76 C50 58 70 58 70 46 C70 36 100 36 100 46" stroke="#0B1F3A" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M50 76 C50 58 70 58 70 46 C70 36 100 36 100 46" stroke="#0A66FF" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="50" cy="76" r="6" fill="#FF6A00" stroke="#FFF" stroke-width="2"/>
              <circle cx="70" cy="52" r="5" fill="#0B1F3A" stroke="#FFF" stroke-width="2"/>
              <circle cx="100" cy="46" r="6" fill="#FF6A00" stroke="#FFF" stroke-width="2"/>
              <line x1="100" y1="46" x2="100" y2="16" stroke="#0B1F3A" stroke-width="2.5" stroke-linecap="round"/>
              <path d="M100 18 L122 24 L100 30 Z" fill="#FF6A00" stroke="#E65100" stroke-width="1"/>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">03</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">PLANNING</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Roadmap • Stack • Milestones</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We set the roadmap, milestones, timeline, and roles.</p>
            <p style="margin:0;">The technology stack and required resources are selected.</p>
          </div>
        </div>

        <!-- 04 UI/UX Design -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <rect x="42" y="22" width="56" height="58" rx="5" fill="#FFF" stroke="#0B1F3A" stroke-width="2"/>
              <rect x="47" y="27" width="46" height="8" rx="2" fill="#0A66FF"/>
              <rect x="47" y="39" width="21" height="22" rx="2" fill="#F8FAFC" stroke="#CBD5E1" stroke-width="1.5"/>
              <line x1="47" y1="39" x2="68" y2="61" stroke="#CBD5E1" stroke-width="1"/>
              <line x1="68" y1="39" x2="47" y2="61" stroke="#CBD5E1" stroke-width="1"/>
              <rect x="72" y="39" width="21" height="22" rx="2" fill="#F8FAFC" stroke="#CBD5E1" stroke-width="1.5"/>
              <line x1="72" y1="39" x2="93" y2="61" stroke="#CBD5E1" stroke-width="1"/>
              <line x1="93" y1="39" x2="72" y2="61" stroke="#CBD5E1" stroke-width="1"/>
              <line x1="47" y1="68" x2="80" y2="68" stroke="#94A3B8" stroke-width="2" stroke-linecap="round"/>
              <g transform="translate(102, 36) rotate(25)">
                <path d="M0 0 L10 20 L5 32 L-5 32 L-10 20 Z" fill="#0B1F3A"/>
                <path d="M-5 32 L0 42 L5 32 Z" fill="#E2E8F0" stroke="#0B1F3A" stroke-width="1.5"/>
                <circle cx="0" cy="24" r="2.5" fill="#FF6A00"/>
              </g>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">04</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">UI/UX DESIGN</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Flows • Wireframes • Prototype</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We shape user flows, wireframes, and visual screens.</p>
            <p style="margin:0;">The interactive prototype is reviewed and approved.</p>
          </div>
        </div>

      </div>

      <!-- Row 2: Steps 08 to 05 (S-Curve Return) -->
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;position:relative;z-index:10;">
        
        <!-- 08 Support & Growth -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <ellipse cx="50" cy="90" rx="6" ry="3" fill="#FF6A00"/>
              <g transform="translate(68, 46)">
                <circle cx="0" cy="0" r="22" fill="#0B1F3A" stroke="#1E293B" stroke-width="1.5"/>
                <rect x="-4" y="-28" width="8" height="8" rx="1.5" fill="#0B1F3A"/>
                <rect x="-4" y="-28" width="8" height="8" rx="1.5" fill="#0B1F3A" transform="rotate(60)"/>
                <rect x="-4" y="-28" width="8" height="8" rx="1.5" fill="#0B1F3A" transform="rotate(120)"/>
                <rect x="-4" y="-28" width="8" height="8" rx="1.5" fill="#0B1F3A" transform="rotate(180)"/>
                <rect x="-4" y="-28" width="8" height="8" rx="1.5" fill="#0B1F3A" transform="rotate(240)"/>
                <rect x="-4" y="-28" width="8" height="8" rx="1.5" fill="#0B1F3A" transform="rotate(300)"/>
                <circle cx="0" cy="0" r="10" fill="#FFF" stroke="#0B1F3A" stroke-width="2"/>
                <circle cx="0" cy="0" r="6" fill="#0A66FF"/>
              </g>
              <path d="M52 72 L76 48 L88 56 L114 24" stroke="#FF6A00" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M102 22 L116 22 L116 36 Z" fill="#FF6A00" stroke="#FFF" stroke-width="1"/>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">08</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">SUPPORT &amp; GROWTH</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Monitor • Improve • Scale</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We monitor stability, performance, and updates.</p>
            <p style="margin:0;">The product is improved and scaled as needs grow.</p>
          </div>
        </div>

        <!-- 07 Launch & Handover -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <circle cx="62" cy="78" r="10" fill="#E2E8F0"/><circle cx="74" cy="74" r="12" fill="#FFF" stroke="#E2E8F0" stroke-width="1"/><circle cx="86" cy="74" r="12" fill="#FFF" stroke="#E2E8F0" stroke-width="1"/><circle cx="98" cy="78" r="10" fill="#E2E8F0"/>
              <path d="M74 64 Q80 80 80 82 Q80 80 86 64 Z" fill="#FF6A00"/><path d="M76 64 Q80 74 80 76 Q80 74 84 64 Z" fill="#FACC15"/>
              <path d="M80 12 C70 28 70 52 70 64 L90 64 C90 52 90 28 80 12 Z" fill="#FFF" stroke="#0B1F3A" stroke-width="2"/>
              <path d="M80 12 C75 20 73 28 73 32 L87 32 C87 28 85 20 80 12 Z" fill="#0A66FF"/>
              <circle cx="80" cy="42" r="5" fill="#0B1F3A" stroke="#0A66FF" stroke-width="1.5"/><circle cx="80" cy="42" r="3" fill="#E0F2FE"/>
              <path d="M70 48 L58 62 L70 62 Z" fill="#FF6A00"/><path d="M90 48 L102 62 L90 62 Z" fill="#FF6A00"/>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">07</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">LAUNCH &amp; HANDOVER</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Deployment • Migration • Handover</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We deploy the approved product and run final checks.</p>
            <p style="margin:0;">Access, documentation, and training are handed over.</p>
          </div>
        </div>

        <!-- 06 Quality Assurance -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <path d="M80 16 L114 28 C114 60 80 80 80 80 C80 80 46 60 46 28 Z" fill="#0B1F3A" stroke="#0A66FF" stroke-width="2.5"/>
              <path d="M80 20 L110 31 C110 56 80 74 80 74 C80 74 50 56 50 31 Z" fill="#1E293B"/>
              <path d="M66 46 L76 56 L96 36" stroke="#FFF" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="108" cy="68" r="13" fill="#FF6A00" stroke="#FFF" stroke-width="2"/><circle cx="108" cy="68" r="5" fill="#FFF"/>
              <line x1="102" y1="65" x2="114" y2="71" stroke="#FFF" stroke-width="1.5"/><line x1="102" y1="71" x2="114" y2="65" stroke="#FFF" stroke-width="1.5"/>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">06</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">QUALITY ASSURANCE</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Function • Security • Performance</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We test functionality, security, speed, and responsiveness.</p>
            <p style="margin:0;">Detected issues are fixed and checked again.</p>
          </div>
        </div>

        <!-- 05 Development -->
        <div class="pdp-card-box">
          <div class="pdp-iso-svg">
            <svg viewBox="0 0 160 120" fill="none">
              <ellipse cx="80" cy="98" rx="55" ry="16" fill="#0E1726"/>
              <path d="M25 98 C25 106 135 106 135 98 L135 90 C135 98 25 98 25 90 Z" fill="#1E293B"/>
              <ellipse cx="80" cy="90" rx="55" ry="16" fill="#F8FAFC" stroke="#38BDF8" stroke-width="1.5"/>
              <ellipse cx="80" cy="90" rx="46" ry="13" fill="#FFFFFF"/>
              <rect x="42" y="56" width="28" height="24" rx="3" fill="#0B1F3A"/>
              <rect x="40" y="54" width="28" height="24" rx="3" fill="#1E293B" stroke="#334155" stroke-width="1"/>
              <rect x="94" y="46" width="26" height="28" rx="3" fill="#C2410C"/>
              <rect x="92" y="44" width="26" height="28" rx="3" fill="#FF6A00" stroke="#FFA153" stroke-width="1"/>
              <rect x="58" y="22" width="46" height="42" rx="6" fill="#0A66FF" stroke="#38BDF8" stroke-width="1.5"/>
              <text x="81" y="49" text-anchor="middle" fill="#FFF" font-size="20" font-weight="bold" font-family="monospace">&lt;/&gt;</text>
            </svg>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;gap:6px;margin-bottom:4px;">
            <span style="font-size:1.25rem;font-weight:600;color:#FF6A00;">05</span>
            <h3 style="font-size:0.875rem;font-weight:700;color:#fff;letter-spacing:0.05em;text-transform:uppercase;margin:0;">DEVELOPMENT</h3>
          </div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:6px;">Frontend • Backend • Integrations</span>
          <div style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;max-width:210px;">
            <p style="margin:0;">We build the frontend, backend, and database.</p>
            <p style="margin:0;">Required integrations are added in planned stages.</p>
          </div>
        </div>

      </div>
    </div>

    <!-- Mobile Vertical Layout -->
    <div class="pdp-mobile-wrap">
      <!-- 01 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">01</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">DISCOVERY</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Goals • Users • Challenges</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We explore the idea, goals, users, and challenges.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">Key details are clarified before the project begins.</p>
        </div>
      </div>
      <!-- 02 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">02</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">REQUIREMENTS</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Scope • Features • Priorities</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We define the scope, features, and priorities.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">Requirements and deliverables are documented clearly.</p>
        </div>
      </div>
      <!-- 03 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">03</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">PLANNING</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Roadmap • Stack • Milestones</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We set the roadmap, milestones, timeline, and roles.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">The technology stack and required resources are selected.</p>
        </div>
      </div>
      <!-- 04 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">04</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">UI/UX DESIGN</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Flows • Wireframes • Prototype</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We shape user flows, wireframes, and visual screens.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">The interactive prototype is reviewed and approved.</p>
        </div>
      </div>
      <!-- 05 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">05</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">DEVELOPMENT</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Frontend • Backend • Integrations</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We build the frontend, backend, and database.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">Required integrations are added in planned stages.</p>
        </div>
      </div>
      <!-- 06 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">06</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">QUALITY ASSURANCE</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Function • Security • Performance</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We test functionality, security, speed, and responsiveness.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">Detected issues are fixed and checked again.</p>
        </div>
      </div>
      <!-- 07 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">07</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">LAUNCH &amp; HANDOVER</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Deployment • Migration • Handover</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We deploy the approved product and run final checks.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">Access, documentation, and training are handed over.</p>
        </div>
      </div>
      <!-- 08 -->
      <div style="position:relative;display:flex;flex-direction:column;gap:1rem;">
        <div style="position:absolute;left:-1.9rem;top:1rem;width:1.25rem;height:1.25rem;background:#FF6A00;border:2px solid #0B1120;display:flex;align-items:center;justify-content:center;font-size:9px;color:#fff;font-weight:700;">↓</div>
        <div style="text-align:left;">
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span style="font-size:1.125rem;font-weight:600;color:#FF6A00;">08</span><h3 style="font-size:0.875rem;font-weight:700;color:#fff;text-transform:uppercase;margin:0;">SUPPORT &amp; GROWTH</h3></div>
          <span style="font-size:11px;font-weight:600;color:#9CA3AF;display:block;margin-bottom:4px;">Monitor • Improve • Scale</span>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0 0 2px;">We monitor stability, performance, and updates.</p>
          <p style="font-size:0.75rem;color:#D1D5DB;line-height:1.6;margin:0;">The product is improved and scaled as needs grow.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- 3. SERVICES TABS SECTION -->
<div id="what-we-provide" style="width:100%;background:#F4F8FF;color:#111827;scroll-margin-top:80px;">

  <!-- 8-Tab Selector Bar (4 Left, 4 Right on Mobile / 8 in Row on Desktop) -->
  <div style="width:100%;background:#F4F8FF;border-bottom:1px solid #C7D9F5;position:relative;z-index:10;">
    <div style="max-width:80rem;margin:0 auto;padding:0.75rem 1rem;">
      <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-2" id="svcTabBar">
        
        <!-- 1. Software Development (L1) -->
        <button onclick="selectSvc('software-development')" id="svctab-software-development" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:700;color:#0052FF;border:none;border-bottom:2px solid #0052FF;background:rgba(219,234,254,0.7);font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-software-development" style="width:8px;height:8px;background:#FF6B00;flex-shrink:0;display:inline-block;border-radius:2px;transform:scale(1.25);box-shadow:0 0 0 3px rgba(255,107,0,0.2);"></span>
          <span style="font-weight:inherit;">Software Development</span>
        </button>

        <!-- 2. UI/UX Design (R1) -->
        <button onclick="selectSvc('ui-ux-design')" id="svctab-ui-ux-design" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:600;color:#374151;border:none;border-bottom:2px solid transparent;background:transparent;font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-ui-ux-design" style="width:8px;height:8px;background:#9CA3AF;flex-shrink:0;display:inline-block;border-radius:2px;"></span>
          <span style="font-weight:inherit;">UI/UX Design</span>
        </button>

        <!-- 3. Mobile Application (L2) -->
        <button onclick="selectSvc('mobile-application')" id="svctab-mobile-application" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:600;color:#374151;border:none;border-bottom:2px solid transparent;background:transparent;font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-mobile-application" style="width:8px;height:8px;background:#9CA3AF;flex-shrink:0;display:inline-block;border-radius:2px;"></span>
          <span style="font-weight:inherit;">Mobile Application</span>
        </button>

        <!-- 4. Cloud Infrastructure (R2) -->
        <button onclick="selectSvc('cloud-infrastructure')" id="svctab-cloud-infrastructure" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:600;color:#374151;border:none;border-bottom:2px solid transparent;background:transparent;font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-cloud-infrastructure" style="width:8px;height:8px;background:#9CA3AF;flex-shrink:0;display:inline-block;border-radius:2px;"></span>
          <span style="font-weight:inherit;">Cloud Infrastructure</span>
        </button>

        <!-- 5. Database Management (L3) -->
        <button onclick="selectSvc('database-management')" id="svctab-database-management" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:600;color:#374151;border:none;border-bottom:2px solid transparent;background:transparent;font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-database-management" style="width:8px;height:8px;background:#9CA3AF;flex-shrink:0;display:inline-block;border-radius:2px;"></span>
          <span style="font-weight:inherit;">Database Management</span>
        </button>

        <!-- 6. Web Development (R3) -->
        <button onclick="selectSvc('web-development')" id="svctab-web-development" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:600;color:#374151;border:none;border-bottom:2px solid transparent;background:transparent;font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-web-development" style="width:8px;height:8px;background:#9CA3AF;flex-shrink:0;display:inline-block;border-radius:2px;"></span>
          <span style="font-weight:inherit;">Web Development</span>
        </button>

        <!-- 7. AI & Automation (L4) -->
        <button onclick="selectSvc('ai-automation')" id="svctab-ai-automation" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:600;color:#374151;border:none;border-bottom:2px solid transparent;background:transparent;font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-ai-automation" style="width:8px;height:8px;background:#9CA3AF;flex-shrink:0;display:inline-block;border-radius:2px;"></span>
          <span style="font-weight:inherit;">AI &amp; Automation</span>
        </button>

        <!-- 8. Digital Growth (R4) -->
        <button onclick="selectSvc('digital-growth')" id="svctab-digital-growth" style="display:flex;align-items:center;justify-content:flex-start;text-align:left;gap:8px;padding:8px 10px;cursor:pointer;font-weight:600;color:#374151;border:none;border-bottom:2px solid transparent;background:transparent;font-size:0.8125rem;line-height:1.3;min-height:46px;border-radius:4px;transition:all 0.2s;">
          <span class="svctab-dot-digital-growth" style="width:8px;height:8px;background:#9CA3AF;flex-shrink:0;display:inline-block;border-radius:2px;"></span>
          <span style="font-weight:inherit;">Digital Growth</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Content + Left Nav -->
  <div style="width:100%;background:#F5F5F7;padding:1.75rem 0 2.25rem;border-bottom:1px solid #E5E7EB;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8">
        
        <!-- Left: Services/Benefits/Proven Results tabs -->
        <div class="md:col-span-1">
          <div class="flex md:flex-col flex-row items-center justify-center md:justify-start gap-2 sm:gap-3 border-b md:border-b-0 md:border-r border-gray-300 pb-3 md:pb-0 pr-0 md:pr-4 w-full">
            <button onclick="setSubTab('services')" id="sub-services"
              class="flex-1 md:flex-none text-center md:text-left py-2 px-3 text-sm sm:text-base font-bold text-[#030712] border-b-2 md:border-b-0 md:border-r-2 border-[#030712] bg-transparent cursor-pointer transition-all">
              Services
            </button>
            <button onclick="setSubTab('benefits')" id="sub-benefits"
              class="flex-1 md:flex-none text-center md:text-left py-2 px-3 text-sm sm:text-base font-medium text-[#9CA3AF] border-b-2 md:border-b-0 md:border-r-2 border-transparent bg-transparent cursor-pointer transition-all">
              Benefits
            </button>
            <button onclick="setSubTab('proven')" id="sub-proven"
              class="flex-1 md:flex-none text-center md:text-left py-2 px-3 text-sm sm:text-base font-medium text-[#9CA3AF] border-b-2 md:border-b-0 md:border-r-2 border-transparent bg-transparent cursor-pointer transition-all" style="display:none;">
              Proven Results
            </button>
          </div>
        </div>

        <!-- Right: Tab Content -->
        <div id="svcContentArea" class="md:col-span-3 min-h-[260px] w-full">
          <!-- Injected by JS -->
        </div>
      </div>
    </div>
  </div>

  <!-- Tech Stack (3 in a row on Mobile, expanding on Desktop) -->
  <div style="width:100%;background:#F4F8FF;padding:1.75rem 0 2rem;border-bottom:1px solid #C7D9F5;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
      <div style="max-width:48rem;margin-bottom:1.25rem;">
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#030712;letter-spacing:-0.03em;margin-bottom:0.35rem;">Tech <span style="color:#FF2B2B;">Stack</span></h2>
        <p style="font-size:0.875rem;color:#374151;line-height:1.65;margin:0;">We provide services in a wide range of technologies for <strong style="color:#030712;" id="techStackName">Software Development</strong>:</p>
      </div>
      <div id="techStackGrid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2.5 sm:gap-3.5"></div>
    </div>
  </div>

</div>

<!-- 4. LATEST PROJECTS (INTERACTIVE 6-SECTOR SHOWCASE) -->
<section id="latest-projects" class="services-projects-section">
  <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 25%, rgba(0, 102, 255, 0.15) 0%, rgba(255, 107, 0, 0.08) 35%, transparent 70%), linear-gradient(to bottom, #050B14 0%, #0B1120 50%, #050B14 100%);"></div>
  <div style="position:absolute;inset:0;opacity:0.2;pointer-events:none;background-image:linear-gradient(to right, rgba(0, 180, 255, 0.15) 1px, transparent 1px), linear-gradient(to bottom, rgba(0, 180, 255, 0.15) 1px, transparent 1px);background-size:50px 50px;"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
    <div style="text-align:center;margin-bottom:1.5rem;">
      <h2 style="font-size:clamp(1.5rem,3.2vw,2.25rem);font-weight:700;letter-spacing:0.05em;text-transform:uppercase;color:#fff;margin:0;">
        LATEST <span style="color:#FF5500;text-shadow:0 0 15px rgba(255,85,0,0.4);">PROJECTS</span>
      </h2>
    </div>

    <!-- 6 Sector Tabs Bar (Single Horizontal Row) -->
    <div class="max-w-4xl mx-auto mb-8">
      <div class="flex items-center justify-center flex-wrap gap-2 p-1.5 bg-black/40 border border-white/15 rounded-xl backdrop-blur-md">
        <button onclick="selectProjectSector('finance')" id="psec-btn-finance" class="py-2 px-4 text-xs sm:text-sm font-bold border-0 cursor-pointer transition-all text-center rounded-lg text-white bg-[#FF5500] shadow-lg shadow-orange-500/30 whitespace-nowrap">
          Finance
        </button>
        <button onclick="selectProjectSector('housing')" id="psec-btn-housing" class="py-2 px-4 text-xs sm:text-sm font-bold border-0 cursor-pointer transition-all text-center rounded-lg text-gray-300 bg-transparent hover:text-white whitespace-nowrap">
          Housing
        </button>
        <button onclick="selectProjectSector('operations')" id="psec-btn-operations" class="py-2 px-4 text-xs sm:text-sm font-bold border-0 cursor-pointer transition-all text-center rounded-lg text-gray-300 bg-transparent hover:text-white whitespace-nowrap">
          Operations
        </button>
        <button onclick="selectProjectSector('ai')" id="psec-btn-ai" class="py-2 px-4 text-xs sm:text-sm font-bold border-0 cursor-pointer transition-all text-center rounded-lg text-gray-300 bg-transparent hover:text-white whitespace-nowrap">
          Artificial Intelligence
        </button>
        <button onclick="selectProjectSector('data-migration')" id="psec-btn-data-migration" class="py-2 px-4 text-xs sm:text-sm font-bold border-0 cursor-pointer transition-all text-center rounded-lg text-gray-300 bg-transparent hover:text-white whitespace-nowrap">
          Data Migration
        </button>
        <button onclick="selectProjectSector('students-abroad')" id="psec-btn-students-abroad" class="py-2 px-4 text-xs sm:text-sm font-bold border-0 cursor-pointer transition-all text-center rounded-lg text-gray-300 bg-transparent hover:text-white whitespace-nowrap">
          Students Abroad
        </button>
      </div>
    </div>

    <!-- Interactive Showcase -->
    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center">
      <!-- Left Card Mockup -->
      <div id="psec-mockup" class="md:col-span-5 w-full h-48 sm:h-52 rounded-lg p-5 border border-white/20 shadow-2xl flex flex-col justify-between relative overflow-hidden transition-all duration-300" style="background:linear-gradient(135deg, #0B132B, #1C2541, #0A0E1A);">
        <div class="flex items-center justify-between border-b border-white/10 pb-2">
          <div class="flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-[#EF4444] inline-block"></span>
            <span class="w-2 h-2 rounded-full bg-[#EAB308] inline-block"></span>
            <span class="w-2 h-2 rounded-full bg-[#22C55E] inline-block"></span>
          </div>
          <span id="psec-badge" class="text-[10px] font-mono tracking-widest text-gray-400 uppercase">FINANCIAL PLATFORM</span>
        </div>
        <div class="my-auto text-left">
          <h4 id="psec-screentitle" class="text-lg font-bold text-white mb-1">FINANCE PRODUCT</h4>
          <p id="psec-screensub" class="text-xs text-gray-300 leading-relaxed">Algorithmic Order Execution &amp; Settlement Matrix</p>
        </div>
        <div class="h-1 w-full bg-gradient-to-r from-[#FF5500] to-transparent rounded-full"></div>
      </div>

      <!-- Right Description -->
      <div class="md:col-span-7 text-left pl-4 sm:pl-6 border-l-2 border-[#FF5500] flex flex-col gap-2.5">
        <h3 id="psec-title" class="text-xl sm:text-2xl font-bold text-white">Finance Modernization &amp; Core Ledger</h3>
        <p id="psec-desc" class="text-sm text-gray-300 leading-relaxed">High-throughput algorithmic trading engine and sub-second payment settlement with automated regulatory compliance.</p>
        <p id="psec-subtext" class="text-xs text-gray-400 leading-relaxed">Real-time financial telemetry, automated fraud screening, and zero-discrepancy reconciliation ledger.</p>
        <div class="pt-1.5">
          <a href="portfolio" class="inline-flex items-center text-xs font-bold text-[#FF5500] hover:text-[#FF7733] uppercase tracking-wider transition-colors">
            Explore Project Case Study &rarr;
          </a>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- 5. SATISFACTION GUARANTEE -->
<section class="services-guarantee-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
    <div class="max-w-3xl mx-auto flex flex-col items-center text-center">
      
      <!-- Text on Top (txt opr) -->
      <h2 style="font-size:clamp(1.65rem,3.5vw,2.5rem);font-weight:700;letter-spacing:-0.03em;color:#030712;margin-bottom:0.75rem;">
        Satisfaction <span style="color:#FF6B00;">Guarantee</span>
      </h2>
      <div style="font-size:0.92rem;color:#374151;line-height:1.65;margin-bottom:1.25rem;">
        <p style="margin-bottom:0.5rem;">We stand firmly behind the precision, reliability, and security of every line of code we write. Every enterprise engagement is backed by contractual milestone validation, continuous quality assurance, and zero-defect deployment standards.</p>
        <p style="margin:0;">If our deliverables fail to meet your predefined architecture specifications or performance benchmarks, our dedicated engineering leads will refine and optimize until 100% compliance is achieved — guaranteed.</p>
      </div>

      <!-- Box on Bottom (box nechy) -->
      <div class="relative flex items-center justify-center">
        <div class="absolute w-36 h-36 bg-orange-500/20 rounded-full blur-xl pointer-events-none"></div>
        <div class="w-36 h-36 p-1.5 rounded-2xl bg-gradient-to-br from-[#FF5500] via-[#FF8800] to-[#FFAA00] shadow-xl shadow-orange-500/25 flex items-center justify-center relative z-10">
          <div class="w-full h-full bg-white rounded-xl flex flex-col items-center justify-center text-center p-2.5">
            <span class="text-3xl font-extrabold text-[#030712] tracking-tight leading-none">100%</span>
            <span class="text-[11px] font-extrabold text-[#FF6B00] uppercase tracking-widest mt-1">GUARANTEE</span>
            <span class="text-[9px] text-gray-400 font-semibold uppercase tracking-wider mt-0.5">Enterprise SLA</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 6. INDUSTRIES WE WORK WITH -->
<section class="services-industries-section">
  <div style="position:absolute;inset:0;opacity:0.2;pointer-events:none;background-image:linear-gradient(to right,rgba(0,102,255,0.25) 1px,transparent 1px),linear-gradient(to bottom,rgba(0,102,255,0.25) 1px,transparent 1px);background-size:48px 48px;"></div>
  <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 75% 50%,rgba(255,107,0,0.08) 0%,transparent 60%);"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-center">
      <div class="lg:col-span-5 text-center lg:text-left">
        <h2 style="font-size:clamp(1.4rem,2.8vw,2rem);font-weight:700;letter-spacing:0.05em;text-transform:uppercase;line-height:1.35;margin:0;">
          SOME OF THE <br>
          <span style="color:#FF6B00;">INDUSTRIES</span> <br>
          WE WORK WITH
        </h2>
      </div>
      <div class="lg:col-span-7 grid grid-cols-2 gap-3 sm:gap-4">
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 20h18"/><path d="M5 20V8l4 3V8l4 3V4l6 4v12"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">Manufacturing</span>
        </div>
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">Healthcare</span>
        </div>
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">Retail &amp; E-commerce</span>
        </div>
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">E-learning</span>
        </div>
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"/><path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"/><circle cx="12" cy="12" r="2"/><path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"/><path d="M19.1 4.9C23 8.8 23 15.1 19.1 19"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">Telecom</span>
        </div>
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">Housing</span>
        </div>
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">Education</span>
        </div>
        <div class="ind-row" style="display:flex;align-items:center;gap:12px;cursor:default;transition:transform 0.2s;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
          <div style="padding:6px;background:rgba(249,115,22,0.12);border-radius:4px;flex-shrink:0;"><svg style="width:20px;height:20px;" viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="22" y2="22"/><line x1="6" x2="6" y1="18" y2="2"/><line x1="10" x2="10" y1="18" y2="2"/><line x1="14" x2="14" y1="18" y2="2"/><line x1="18" x2="18" y1="18" y2="2"/><polygon points="12 2 20 7 4 7"/></svg></div>
          <span style="font-size:0.875rem;font-weight:600;color:#E5E7EB;">Insurance &amp; Fintech</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 7. VISION TO LIFE FORM & STATS -->
<section class="services-vision-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
    
    <!-- 1. Contact Form on TOP -->
    <div class="max-w-4xl mx-auto p-5 sm:p-8 rounded-2xl border border-blue-100 shadow-sm mb-6" style="background:linear-gradient(135deg,#EAF5FE,#F3FAFE,#FFFDF9);">
      <div class="text-center sm:text-left mb-5">
        <h3 style="font-size:clamp(1.4rem,2.8vw,1.875rem);font-weight:700;color:#030712;letter-spacing:-0.03em;margin-bottom:0.35rem;">
          Let's bring your vision to life
        </h3>
        <p style="font-size:0.875rem;color:#4B5563;margin:0;">
          Tell us about your project requirements and get a tailored technical roadmap within 2 to 4 hours.
        </p>
      </div>

      <div id="visionOK" style="display:none;padding:12px;background:#ECFDF5;border:1px solid #A7F3D0;color:#065F46;font-size:0.75rem;font-weight:600;margin-bottom:1rem;border-radius:6px;"></div>
      <div id="visionErr" style="display:none;padding:12px;background:#FEF2F2;border:1px solid #FECACA;color:#991B1B;font-size:0.75rem;font-weight:600;margin-bottom:1rem;border-radius:6px;"></div>

      <form id="visionForm">
        <div style="display:flex;align-items:center;flex-wrap:wrap;gap:1.25rem;margin-bottom:1rem;">
          <label style="display:flex;align-items:center;gap:8px;font-size:0.875rem;font-weight:600;color:#1F2937;cursor:pointer;"><input type="radio" name="engType" value="Dedicated Team" checked style="accent-color:#0066FF;"> <span>Dedicated Team</span></label>
          <label style="display:flex;align-items:center;gap:8px;font-size:0.875rem;font-weight:600;color:#1F2937;cursor:pointer;"><input type="radio" name="engType" value="Staff Augmentation" style="accent-color:#0066FF;"> <span>Staff Augmentation</span></label>
          <label style="display:flex;align-items:center;gap:8px;font-size:0.875rem;font-weight:600;color:#1F2937;cursor:pointer;"><input type="radio" name="engType" value="Fixed Price Project" style="accent-color:#0066FF;"> <span>Fixed Price Project</span></label>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
          <input type="text" name="fname" required placeholder="Name *" class="w-full px-4 py-2.5 bg-white border border-gray-200 text-sm text-gray-900 rounded-lg outline-none focus:border-[#0066FF] transition-colors" />
          <input type="tel" name="phone" placeholder="Contact Number *" class="w-full px-4 py-2.5 bg-white border border-gray-200 text-sm text-gray-900 rounded-lg outline-none focus:border-[#0066FF] transition-colors" />
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
          <input type="email" name="email" required placeholder="E-mail *" class="w-full px-4 py-2.5 bg-white border border-gray-200 text-sm text-gray-900 rounded-lg outline-none focus:border-[#0066FF] transition-colors" />
          <select name="role" class="w-full px-4 py-2.5 bg-white border border-gray-200 text-sm text-gray-800 rounded-lg outline-none cursor-pointer focus:border-[#0066FF] transition-colors">
            <option>AI Developers</option>
            <option>Custom Software Engineers</option>
            <option>Cloud &amp; DevOps Architects</option>
            <option>UI/UX Product Designers</option>
            <option>Mobile App Developers</option>
            <option>Full-Stack Enterprise Team</option>
          </select>
        </div>
        <div class="mb-3">
          <textarea name="message" rows="3" placeholder="Tell us how we can help" class="w-full p-3.5 bg-white border border-gray-200 text-sm text-gray-900 rounded-xl outline-none resize-none focus:border-[#0066FF] transition-colors"></textarea>
        </div>
        <div class="flex items-center justify-between flex-wrap gap-3 mb-3.5">
          <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer">
            <input type="checkbox" name="agreed" class="w-4 h-4 accent-[#0066FF]"> 
            <span>I understand and agree to the <a href="terms" class="text-[#0066FF] underline font-medium">terms and conditions</a></span>
          </label>
          <label class="flex items-center gap-1.5 text-xs font-semibold text-gray-700 cursor-pointer">
            <span>Attachments</span>
            <svg class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l7.88-7.88"/></svg>
            <input type="file" class="hidden" id="vfFile">
          </label>
        </div>
        <div class="flex items-center justify-between flex-wrap gap-4">
          <button type="submit" id="vfBtn" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-[#0066FF] hover:bg-[#0051CC] text-white font-bold text-sm rounded-lg shadow-sm cursor-pointer transition-colors">
            <span id="vfBtnText">Find the Right Fit</span>
          </button>
          <div class="flex items-center gap-2.5 bg-white px-3.5 py-1.5 rounded-xl border border-gray-200 text-xs text-gray-600 shadow-2xs">
            <span class="w-4 h-4 bg-emerald-500 rounded-full flex items-center justify-center text-white text-[9px] font-bold">✓</span>
            <span class="font-semibold text-gray-800">Success!</span>
            <span class="text-gray-300">|</span>
            <div class="flex items-center gap-1"><span class="font-bold text-orange-600 tracking-wider">CLOUDFLARE</span><span class="text-[10px] text-gray-400">Privacy - Terms</span></div>
          </div>
        </div>
      </form>
    </div>

    <!-- 2. Compact Stats & Trust Badges on BOTTOM (Smaller Size) -->
    <div class="max-w-4xl mx-auto">
      
      <!-- 4 Stats Cards (Smaller, Balanced Grid) -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3.5 mb-3.5">
        
        <!-- Card 1: 99% Job Success -->
        <div class="bg-[#F2F8FD] p-3 sm:p-3.5 rounded-xl flex flex-col items-center justify-center text-center shadow-2xs hover:shadow-sm transition-shadow">
          <div class="w-7 h-7 rounded-lg bg-blue-100/80 flex items-center justify-center mb-1 text-[#0066FF]">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>
          </div>
          <span class="text-xl sm:text-2xl font-extrabold text-gray-950 tracking-tight leading-none mb-1">99%</span>
          <span class="text-[10px] sm:text-[11px] font-bold text-gray-600 uppercase tracking-wider">Job Success</span>
        </div>

        <!-- Card 2: 15000+ Working Hours -->
        <div class="bg-[#F2F8FD] p-3 sm:p-3.5 rounded-xl flex flex-col items-center justify-center text-center shadow-2xs hover:shadow-sm transition-shadow">
          <div class="w-7 h-7 rounded-lg bg-blue-100/80 flex items-center justify-center mb-1 text-[#0066FF]">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <polyline points="12 6 12 12 16 14" />
            </svg>
          </div>
          <span class="text-xl sm:text-2xl font-extrabold text-gray-950 tracking-tight leading-none mb-1">15000+</span>
          <span class="text-[10px] sm:text-[11px] font-bold text-gray-600 uppercase tracking-wider">Working Hours</span>
        </div>

        <!-- Card 3: 300+ Happy Clients -->
        <div class="bg-[#F2F8FD] p-3 sm:p-3.5 rounded-xl flex flex-col items-center justify-center text-center shadow-2xs hover:shadow-sm transition-shadow">
          <div class="w-7 h-7 rounded-lg bg-blue-100/80 flex items-center justify-center mb-1 text-[#0066FF]">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
            </svg>
          </div>
          <span class="text-xl sm:text-2xl font-extrabold text-gray-950 tracking-tight leading-none mb-1">300+</span>
          <span class="text-[10px] sm:text-[11px] font-bold text-gray-600 uppercase tracking-wider">Happy Clients</span>
        </div>

        <!-- Card 4: 80+ Professional Team -->
        <div class="bg-[#F2F8FD] p-3 sm:p-3.5 rounded-xl flex flex-col items-center justify-center text-center shadow-2xs hover:shadow-sm transition-shadow">
          <div class="w-7 h-7 rounded-lg bg-blue-100/80 flex items-center justify-center mb-1 text-[#0066FF]">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <span class="text-xl sm:text-2xl font-extrabold text-gray-950 tracking-tight leading-none mb-1">80+</span>
          <span class="text-[10px] sm:text-[11px] font-bold text-gray-600 uppercase tracking-wider">Professional Team</span>
        </div>

      </div>

      <!-- 4 Trust Badges (Compact) -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-2.5">
        <div class="flex items-center justify-center gap-2 bg-white px-2.5 py-1.5 rounded-xl border border-gray-200 shadow-2xs">
          <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
          <div class="text-left"><div class="flex items-center gap-1"><span class="text-xs font-bold text-gray-900">5.0</span><span class="text-[9px] text-[#FBBC05]">★★★★★</span></div><span class="text-[9px] text-gray-500 block leading-tight">Google Reviews</span></div>
        </div>
        <div class="flex items-center justify-center gap-2 bg-white px-2.5 py-1.5 rounded-xl border border-gray-200 shadow-2xs">
          <svg class="w-4 h-4 text-[#14A800] shrink-0" viewBox="0 0 24 24" fill="#14A800"><path d="M18.561 13.158c-1.102 0-2.135-.467-3.074-1.227l.228-1.076.008-.042c.207-1.143.849-3.06 2.839-3.06 1.492 0 2.703 1.212 2.703 2.703-.001 1.489-1.212 2.702-2.704 2.702zm0-8.14c-3.237 0-5.111 2.115-5.698 4.148-1.391-1.921-2.029-4.307-2.102-4.522H7.742v6.628c0 1.944-1.579 3.523-3.523 3.523S.696 13.216.696 11.272V4.644H0v6.628c0 2.327 1.893 4.22 4.219 4.22s4.219-1.893 4.219-4.22V9.324c.264.673 1.095 2.548 2.784 4.542l-2.003 9.49h3.048l1.455-6.903c1.378.855 2.977 1.344 4.839 1.344 3.237 0 5.865-2.628 5.865-5.865 0-3.238-2.628-5.864-5.866-5.864z"/></svg>
          <div class="text-left"><span class="text-xs font-bold text-[#14A800] block leading-tight">Upwork</span><span class="text-[9px] text-gray-500 font-semibold uppercase tracking-wider">Top Rated</span></div>
        </div>
        <div class="flex items-center justify-center gap-2 bg-white px-2.5 py-1.5 rounded-xl border border-gray-200 shadow-2xs">
          <div class="w-4 h-4 bg-[#0066FF] text-white flex items-center justify-center font-bold text-[9px] rounded-xs shrink-0">G</div>
          <div class="text-left"><span class="text-xs font-bold text-[#0066FF] block leading-tight">GoodFirms</span><span class="text-[9px] text-gray-500 font-semibold uppercase tracking-wider">Verified</span></div>
        </div>
        <div class="flex items-center justify-center gap-2 bg-white px-2.5 py-1.5 rounded-xl border border-gray-200 shadow-2xs">
          <div class="text-left"><div class="flex items-center gap-1"><span class="text-xs font-bold text-gray-900 uppercase">CLUTCH</span><span class="text-[8px] text-[#FF3D00]">★★★★★</span></div><span class="text-[9px] text-gray-500 font-semibold uppercase tracking-wider">5.0 Rating</span></div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- 8. DARK CTA BOTTOM -->
<section class="services-bottom-cta-section">
  <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 50%,rgba(255,107,0,0.18) 0%,transparent 65%);"></div>
  <div style="max-width:56rem;margin:0 auto;padding:0 1.5rem;position:relative;z-index:10;">
    <h2 style="font-size:clamp(1.35rem,2.8vw,1.75rem);font-weight:700;color:#fff;margin-bottom:0.5rem;">Ready to Build Your Next High-Performance Platform?</h2>
    <p style="color:#D1D5DB;font-size:0.875rem;margin-bottom:1.15rem;max-width:36rem;margin-left:auto;margin-right:auto;line-height:1.65;">Schedule a technical architecture session with our principal engineers and get a tailored sprint roadmap.</p>
    <a href="contact" style="display:inline-flex;align-items:center;justify-content:center;padding:10px 20px;background:#FF6B00;color:#fff;font-weight:600;font-size:0.75rem;text-decoration:none;border-radius:2px;transition:background 0.2s;" onmouseover="this.style.background='#EA5800'" onmouseout="this.style.background='#FF6B00'">
      Schedule Architecture Session
    </a>
  </div>
</section>


<!-- JAVASCRIPT: Complete Standalone Vector Tech Icons & Interactive Controllers -->
<script>
// Official Vector SVG Icons
var TECH_ICONS = {
  'JAVA': '<svg viewBox="0 0 128 128" fill="none"><path d="M46 84 C46 84 40 88 52 90 C66 92 78 92 90 90 C102 88 96 84 96 84 C96 84 82 86 70 86 C58 86 46 84 46 84 Z" fill="#E76F00"/><path d="M42 98 C42 98 34 104 50 106 C66 108 82 108 94 106 C108 104 102 98 102 98 C102 98 86 101 70 101 C54 101 42 98 42 98 Z" fill="#E76F00"/><path d="M66 18 C66 18 52 30 60 44 C66 54 74 58 74 66 C74 76 60 82 60 82 C60 82 72 76 70 66 C68 58 60 54 56 44 C52 32 66 18 66 18 Z" fill="#5382A1"/><path d="M80 32 C80 32 70 42 74 52 C78 60 84 64 84 70 C84 78 72 84 72 84 C72 84 82 78 80 70 C78 64 72 60 70 52 C66 42 80 32 80 32 Z" fill="#E76F00"/><path d="M36 116 C36 116 26 122 52 124 C78 126 98 126 112 124 C124 122 116 116 116 116 C116 116 98 120 74 120 C50 120 36 116 36 116 Z" fill="#5382A1"/></svg>',
  'PYTHON': '<svg viewBox="0 0 128 128" fill="none"><path d="M62 20 C42 20 44 30 44 30 L44 40 L64 40 L64 43 L34 43 C34 43 20 41 20 62 C20 83 31 82 31 82 L38 82 L38 72 C38 72 38 60 50 60 L70 60 C70 60 80 60 80 50 L80 30 C80 30 82 20 62 20 Z" fill="#3776AB"/><circle cx="52" cy="28" r="4" fill="#FFF"/><path d="M66 108 C86 108 84 98 84 98 L84 88 L64 88 L64 85 L94 85 C94 85 108 87 108 66 C108 45 97 46 97 46 L90 46 L90 56 C90 56 90 68 78 68 L58 68 C58 68 48 68 48 78 L48 98 C48 98 46 108 66 108 Z" fill="#FFD438"/><circle cx="76" cy="100" r="4" fill="#FFF"/></svg>',
  'C# .NET': '<svg viewBox="0 0 128 128" fill="none"><polygon points="64,14 114,43 114,101 64,130 14,101 14,43" fill="#512BD4"/><text x="64" y="80" fill="#FFF" font-size="32" font-weight="bold" font-family="sans-serif" text-anchor="middle">C#</text></svg>',
  'TYPESCRIPT': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#3178C6"/><text x="64" y="86" fill="#FFF" font-size="56" font-weight="bold" font-family="sans-serif" text-anchor="middle">TS</text></svg>',
  'NODE.JS': '<svg viewBox="0 0 128 128" fill="none"><polygon points="64,16 112,44 112,100 64,128 16,100 16,44" fill="#339933"/><text x="64" y="80" fill="#FFF" font-size="32" font-weight="bold" font-family="sans-serif" text-anchor="middle">JS</text></svg>',
  'EXPRESS': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="20" fill="#000"/><text x="64" y="78" fill="#FFF" font-size="34" font-weight="bold" font-family="sans-serif" text-anchor="middle">ex</text></svg>',
  'RUBY': '<svg viewBox="0 0 128 128" fill="none"><polygon points="64,18 108,44 92,108 36,108 20,44" fill="#CC342D"/><polygon points="64,18 84,44 44,44" fill="#E53935"/><polygon points="44,44 64,108 36,108 20,44" fill="#B71C1C"/><polygon points="84,44 108,44 92,108 64,108" fill="#D32F2F"/><polygon points="44,44 84,44 64,108" fill="#EF5350"/></svg>',
  'GO (GOLANG)': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="20" fill="#00ADD8"/><text x="64" y="84" fill="#FFF" font-size="48" font-weight="bold" font-family="sans-serif" text-anchor="middle">GO</text></svg>',
  'PHP': '<svg viewBox="0 0 128 128" fill="none"><ellipse cx="64" cy="64" rx="58" ry="36" fill="#8892BF"/><text x="64" y="74" fill="#FFF" font-size="32" font-weight="bold" font-family="sans-serif" text-anchor="middle">php</text></svg>',
  'RUST': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#000"/><circle cx="64" cy="64" r="30" stroke="#DEA584" stroke-width="12" fill="none"/><text x="64" y="76" fill="#DEA584" font-size="30" font-weight="bold" font-family="sans-serif" text-anchor="middle">R</text></svg>',
  'FIGMA': '<svg viewBox="0 0 128 128" fill="none"><path d="M42 22 H64 V44 H42 Z" fill="#F24E1E"/><path d="M64 22 H86 C98 22 98 44 86 44 H64 Z" fill="#FF7262"/><path d="M42 44 H64 V66 H42 Z" fill="#A259FF"/><circle cx="75" cy="55" r="11" fill="#1ABCFE"/><path d="M42 66 H64 V88 C64 100 42 100 42 88 Z" fill="#0ACF83"/></svg>',
  'ADOBE XD': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#470137"/><text x="64" y="86" fill="#FF61F6" font-size="52" font-weight="bold" font-family="sans-serif" text-anchor="middle">Xd</text></svg>',
  'FRAMER': '<svg viewBox="0 0 128 128" fill="none"><path d="M32 20 H96 L64 52 H96 L32 116 V84 L64 52 H32 Z" fill="#0055FF"/></svg>',
  'STORYBOOK': '<svg viewBox="0 0 128 128" fill="none"><path d="M28 20 H92 L100 36 V112 H28 Z" fill="#FF4785"/><text x="60" y="84" fill="#FFF" font-size="48" font-weight="bold" font-family="sans-serif" text-anchor="middle">S</text></svg>',
  'TAILWIND CSS': '<svg viewBox="0 0 128 128" fill="none"><path d="M32 64 C36 48 48 40 68 40 C92 40 92 64 108 64 C116 64 122 58 126 50 C122 66 110 74 90 74 C66 74 66 50 50 50 C42 50 36 56 32 64 Z M2 88 C6 72 18 64 38 64 C62 64 62 88 78 88 C86 88 92 82 96 74 C92 90 80 98 60 98 C36 98 36 74 20 74 C12 74 6 80 2 88 Z" fill="#06B6D4"/></svg>',
  'MIRO': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#FFD02F"/><path d="M38 36 L52 92 L62 92 L48 36 Z M56 36 L70 92 L80 92 L66 36 Z M74 36 L88 92 L98 92 L84 36 Z" fill="#050038"/></svg>',
  'HOTJAR': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#FD3A5C"/><path d="M48 44 C48 36 58 28 64 28 C70 28 80 36 80 44 C80 58 64 74 64 92 C64 74 48 58 48 44 Z" fill="#FFF"/></svg>',
  'ZEPLIN': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#FBAE17"/><path d="M42 42 H86 L48 86 H86" stroke="#FFF" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/></svg>',
  'SWIFT': '<svg viewBox="0 0 128 128" fill="none"><path d="M112 78 C94 98 64 108 34 106 C52 92 64 72 64 50 C44 68 24 72 16 70 C40 38 68 22 96 22 C84 34 84 48 86 52 C98 42 108 30 112 18 C118 42 118 64 112 78 Z" fill="#FA7343"/></svg>',
  'KOTLIN': '<svg viewBox="0 0 128 128" fill="none"><path d="M18 18 H110 L64 64 L110 110 H18 Z" fill="#7F52FF"/><path d="M18 18 H64 L18 64 Z" fill="#C757BC"/><path d="M64 64 L110 110 H18 L64 64 Z" fill="#0095D5"/></svg>',
  'REACT NATIVE': '<svg viewBox="0 0 128 128" fill="none"><ellipse cx="64" cy="64" rx="48" ry="18" stroke="#61DAFB" stroke-width="4"/><ellipse cx="64" cy="64" rx="48" ry="18" stroke="#61DAFB" stroke-width="4" transform="rotate(60 64 64)"/><ellipse cx="64" cy="64" rx="48" ry="18" stroke="#61DAFB" stroke-width="4" transform="rotate(120 64 64)"/><circle cx="64" cy="64" r="8" fill="#61DAFB"/></svg>',
  'FLUTTER': '<svg viewBox="0 0 128 128" fill="none"><path d="M74 20 L28 66 L44 82 L104 20 Z" fill="#02569B"/><path d="M58 82 L74 66 L104 96 L74 126 L44 96 Z" fill="#0175C2"/><path d="M74 96 L104 96 L74 126 Z" fill="#13B9FD"/></svg>',
  'FASTLANE': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#000"/><path d="M38 74 L64 34 L90 74 Z" fill="#FF0077"/></svg>',
  'FIREBASE': '<svg viewBox="0 0 128 128" fill="none"><path d="M28 88 L46 26 L60 54 Z" fill="#FFA000"/><path d="M28 88 L74 38 L98 88 Z" fill="#FFCA28"/><path d="M60 54 L98 88 L28 88 Z" fill="#F57C00"/></svg>',
  'SQLITE': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#003B57"/><text x="64" y="82" fill="#00A9E0" font-size="38" font-weight="bold" font-family="sans-serif" text-anchor="middle">SQL</text></svg>',
  'GRAPHQL': '<svg viewBox="0 0 128 128" fill="none"><path d="M64 22 L100 44 V84 L64 106 L28 84 V44 Z" stroke="#E10098" stroke-width="6" fill="none"/><circle cx="64" cy="22" r="8" fill="#E10098"/><circle cx="100" cy="44" r="8" fill="#E10098"/><circle cx="100" cy="84" r="8" fill="#E10098"/><circle cx="64" cy="106" r="8" fill="#E10098"/><circle cx="28" cy="84" r="8" fill="#E10098"/><circle cx="28" cy="44" r="8" fill="#E10098"/></svg>',
  'AWS': '<svg viewBox="0 0 128 128" fill="none"><path d="M42 46 L49 74 L57 74 L64 46 L58 46 L53 66 L48 46 Z" fill="#FF9900"/><path d="M66 46 L73 74 L81 74 L88 46 L82 46 L77 66 L72 46 Z" fill="#FF9900"/><path d="M30 84 Q64 104 98 84" stroke="#FF9900" stroke-width="6" stroke-linecap="round" fill="none"/><path d="M92 78 L98 84 L90 88 Z" fill="#FF9900"/></svg>',
  'AZURE': '<svg viewBox="0 0 128 128" fill="none"><path d="M36 94 L62 26 L80 26 L46 94 Z" fill="#008AD7"/><path d="M62 26 L88 78 L98 94 L46 94 L66 62 Z" fill="#0078D4"/></svg>',
  'GCP': '<svg viewBox="0 0 128 128" fill="none"><path d="M52 42 C56 34 66 30 76 34 C86 38 92 48 90 58 C98 60 104 68 102 78 C100 86 92 92 84 92 H46 C34 92 26 82 26 72 C26 62 34 54 44 54 C46 48 48 44 52 42 Z" fill="#4285F4"/></svg>',
  'KUBERNETES': '<svg viewBox="0 0 128 128" fill="none"><path d="M64 18 L104 38 V86 L64 108 L24 86 V38 Z" fill="#326CE5"/><circle cx="64" cy="64" r="16" fill="#FFF"/></svg>',
  'TERRAFORM': '<svg viewBox="0 0 128 128" fill="none"><rect x="28" y="24" width="30" height="30" rx="3" fill="#844FBA"/><rect x="64" y="44" width="30" height="30" rx="3" fill="#5C4EE5"/><rect x="28" y="64" width="30" height="30" rx="3" fill="#844FBA"/></svg>',
  'DOCKER': '<svg viewBox="0 0 128 128" fill="none"><path d="M112 62 C108 58 98 58 94 62 C88 52 74 52 68 62 H16 C16 88 40 102 68 102 C102 102 116 78 116 68 C116 64 114 62 112 62 Z" fill="#2496ED"/><rect x="36" y="44" width="10" height="10" rx="1" fill="#2496ED"/><rect x="50" y="44" width="10" height="10" rx="1" fill="#2496ED"/><rect x="64" y="44" width="10" height="10" rx="1" fill="#2496ED"/></svg>',
  'DATADOG': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#632CA6"/><text x="64" y="80" fill="#FFF" font-size="36" font-weight="bold" font-family="sans-serif" text-anchor="middle">DD</text></svg>',
  'CLOUDFLARE': '<svg viewBox="0 0 128 128" fill="none"><path d="M84 46 C80 34 68 28 56 32 C46 36 38 46 40 56 C32 58 26 66 28 74 C30 82 38 88 46 88 H96 C104 88 112 80 110 72 C108 64 102 58 94 58 C94 52 90 48 84 46 Z" fill="#F38020"/></svg>',
  'POSTGRESQL': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#336791"/><text x="64" y="80" fill="#FFF" font-size="32" font-weight="bold" font-family="sans-serif" text-anchor="middle">SQL</text></svg>',
  'MONGODB': '<svg viewBox="0 0 128 128" fill="none"><path d="M64 18 C64 18 36 48 36 78 C36 98 48 108 64 114 C80 108 92 98 92 78 C92 48 64 18 64 18 Z" fill="#47A248"/><path d="M64 18 L64 114 C60 112 36 98 36 78 C36 48 64 18 64 18 Z" fill="#499D4A"/></svg>',
  'REDIS': '<svg viewBox="0 0 128 128" fill="none"><path d="M64 24 L104 44 L64 64 L24 44 Z" fill="#DC382D"/><path d="M64 64 L104 44 V74 L64 94 Z" fill="#A81D14"/><path d="M64 64 L24 44 V74 L64 94 Z" fill="#B82218"/></svg>',
  'AURORA': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#2E27AD"/><text x="64" y="80" fill="#00D4FF" font-size="28" font-weight="bold" font-family="sans-serif" text-anchor="middle">RDS</text></svg>',
  'ELASTICSEARCH': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#005571"/><circle cx="64" cy="64" r="22" fill="#FED10A"/></svg>',
  'KAFKA': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#231F20"/><circle cx="48" cy="64" r="10" fill="#FFF"/><circle cx="80" cy="48" r="10" fill="#FFF"/><circle cx="80" cy="80" r="10" fill="#FFF"/><line x1="48" y1="64" x2="80" y2="48" stroke="#FFF" stroke-width="4"/><line x1="48" y1="64" x2="80" y2="80" stroke="#FFF" stroke-width="4"/></svg>',
  'PRISMA': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#2D3748"/><path d="M42 96 L64 32 L86 96 Z" fill="#0C344B" stroke="#16A394" stroke-width="4"/></svg>',
  'MYSQL': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#00758F"/><text x="64" y="80" fill="#F29111" font-size="30" font-weight="bold" font-family="sans-serif" text-anchor="middle">My</text></svg>',
  'NEXT.JS': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#000"/><path d="M46 42 V86 H54 V56 L82 86 H90 V42 H82 V72 L54 42 Z" fill="#FFF"/></svg>',
  'REACT': '<svg viewBox="0 0 128 128" fill="none"><ellipse cx="64" cy="64" rx="48" ry="18" stroke="#61DAFB" stroke-width="4"/><ellipse cx="64" cy="64" rx="48" ry="18" stroke="#61DAFB" stroke-width="4" transform="rotate(60 64 64)"/><ellipse cx="64" cy="64" rx="48" ry="18" stroke="#61DAFB" stroke-width="4" transform="rotate(120 64 64)"/><circle cx="64" cy="64" r="8" fill="#61DAFB"/></svg>',
  'VERCEL': '<svg viewBox="0 0 128 128" fill="none"><path d="M64 26 L108 98 H20 Z" fill="#000"/></svg>',
  'STRIPE': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#635BFF"/><text x="64" y="84" fill="#FFF" font-size="56" font-weight="bold" font-family="sans-serif" text-anchor="middle">S</text></svg>',
  'SUPABASE': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#1C1C1C"/><path d="M68 28 L36 72 H64 L60 100 L92 56 H64 Z" fill="#3ECF8E"/></svg>',
  'PYTORCH': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#EE4C2C"/><path d="M64 36 C74 36 84 44 84 56 C84 66 76 74 64 74 V36 Z" fill="#FFF"/></svg>',
  'OPENAI': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#10A37F"/><circle cx="64" cy="64" r="24" stroke="#FFF" stroke-width="6" fill="none"/></svg>',
  'LANGCHAIN': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#1C3C3C"/><text x="64" y="82" fill="#00A67E" font-size="38" font-weight="bold" font-family="sans-serif" text-anchor="middle">LC</text></svg>',
  'PINECONE': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#000"/><polygon points="64,30 90,75 38,75" fill="#38BDF8"/></svg>',
  'LLAMAINDEX': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#18181B"/><text x="64" y="80" fill="#F59E0B" font-size="42" font-weight="bold" font-family="sans-serif" text-anchor="middle">LI</text></svg>',
  'HUGGING FACE': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#FFD21E"/><text x="64" y="82" fill="#000" font-size="52" text-anchor="middle">🤗</text></svg>',
  'FASTAPI': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#059669"/><polygon points="68,26 44,70 64,70 60,102 84,58 64,58" fill="#FFF"/></svg>',
  'GA4': '<svg viewBox="0 0 128 128" fill="none"><rect width="128" height="128" rx="16" fill="#F9AB00"/><rect x="42" y="58" width="14" height="42" rx="3" fill="#E37400"/><rect x="62" y="38" width="14" height="62" rx="3" fill="#E37400"/><circle cx="88" cy="90" r="7" fill="#E37400"/></svg>',
  'SEGMENT': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#52BD95"/><circle cx="48" cy="48" r="10" fill="#FFF"/><circle cx="80" cy="48" r="10" fill="#FFF"/><circle cx="64" cy="80" r="10" fill="#FFF"/></svg>',
  'MIXPANEL': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#7856FF"/><circle cx="52" cy="64" r="12" fill="#FFF"/><circle cx="76" cy="64" r="8" fill="#FFF"/></svg>',
  'SEARCH CONSOLE': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#4285F4"/><circle cx="58" cy="58" r="18" stroke="#FFF" stroke-width="6" fill="none"/><line x1="72" y1="72" x2="88" y2="88" stroke="#FFF" stroke-width="6" stroke-linecap="round"/></svg>',
  'HUBSPOT': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#FF7A59"/><circle cx="74" cy="54" r="10" fill="#FFF"/><circle cx="52" cy="74" r="8" fill="#FFF"/></svg>',
  'SEMRUSH': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#FF642D"/><text x="64" y="80" fill="#FFF" font-size="32" font-weight="bold" font-family="sans-serif" text-anchor="middle">SEM</text></svg>',
  'OPTIMIZELY': '<svg viewBox="0 0 128 128" fill="none"><circle cx="64" cy="64" r="54" fill="#0037FF"/><circle cx="54" cy="64" r="12" fill="#FFF"/><circle cx="76" cy="64" r="6" fill="#FFF"/></svg>'
};

var activeSvcId = 'software-development';
var activeSubTab = 'services';

var SVCS = {
  'software-development': {
    name: 'Software Development', hasProven: true,
    servicesHeading: 'What we Provide',
    servicesList: [
      {title:'Custom Software Development', desc:"When a standard software doesn't fit your needs, it's time to create custom solutions. We are your trusted ally for developing and optimizing custom software at all stages, from defining the solution architecture to designing the user interface and managing product evolution."},
      {title:'Web Application Development', desc:'We create custom business solutions for Web applications, using frontend technologies such as React, Vue, Angular, and backend technologies like .Net, Java, PHP, Python, Node.js, and more.'},
      {title:'Integration & API Development', desc:'We have extensive experience developing custom APIs for communication between systems. We also offer integration solutions using third-party APIs such as Google, Stripe, SendGrid, etc.'},
      {title:'Cloud-Based Solutions', desc:'We develop using different cloud service models such as SaaS, IaaS and PaaS. We support a wide range of activities to keep your business operating, such as management, exchange, storage and processing of your data.'},
      {title:'E-commerce Solutions', desc:'Build a strong online store with our custom e-commerce solutions. We extract the full potential of selling online, ensuring users navigate your website smooth and safely. We connect to any payment gateway using back end technologies like .Net and PHP.'},
      {title:'Mobile Application Development', desc:"We design, develop and deploy mobile apps, which seamlessly integrate with existing backend foundations and resources. More than just functional, our apps are designed to truly resonate with users through innovative features, using frameworks such as React Native, Ionic and more."},
    ],
    benefitsHeading: 'Why Us',
    benefitsIntro: 'We set up, scale, and manage a remote development team for you, providing a wide range of IT related services. Our team collaborates with our clients from our facility as they manage them just as if our staff is a part of your in-house team.',
    coreBenefits: [
      {title:'Experience and expertise', desc:'We have worked on many projects across different industries and are familiar with the specific challenges and requirements of various sectors.'},
      {title:'Flexibility and Adaptability', desc:'Our developers adapt to your coding standards and project methodologies, plus you will have the ability to up/down size your team at any time.'},
      {title:'Team Culture', desc:'We believe compatibility between team members is crucial for success, which is why we verify that our developers integrate well with your team to create an effective collaboration.'},
    ],
    extendedBenefits: [
      {title:'Long-term cost-effectiveness', desc:'We have clients that have been with us since 2007, providing significant cost savings with our competitive rates.'},
      {title:'Increase productivity', desc:'Quickly ramp up your productivity completing projects with the highest quality.'},
      {title:"Evolve on your own terms", desc:"We'll stay in constant communication to monitor your development needs. If you need to make adjustments or improvements, we'll work with you to make it happen."},
    ],
    proven: {logo:'AXIA HOME LOANS', sub:'STRATEGIC ALLIANCE & ENTERPRISE INTEGRATION', challenge:"Axia Home Loans (AHL) boasts a diverse array of third party systems that effectively address the company's various requirements. However, there are instances when these systems encounter challenges in communication and data integration, hindering a comprehensive understanding and panoramic view of the business and internal processes.", alliance:"AHL has forged a valuable strategic alliance with Creed Tech, a steadfast partner committed to delivering efficient solutions through the development of diverse applications, with a predominant focus on Microsoft technologies. Rooted in our core philosophy, we center our approach on offering consulting services that align with current and future requirements of our clients.", solution:"Effective integrations play a pivotal role in the successful delivery of reliable solutions. In response to our client's requirement for a streamlined method to oversee users within a third-party application dedicated to loan management, we devised an Extract, Transform, Load (ETL) system to seamlessly transfer user and loan data to a local database.", followup:"By implementing this ETL system, we achieved two objectives. Firstly, it enabled us to extract pertinent information from the third-party application efficiently. Subsequently, the transformed data was loaded into a local database, laying a robust foundation for the development of an innovative application designed to enhance user management capabilities."},
    techStack: ['Java','Python','C# .NET','TypeScript','Node.js','Express','Ruby','Go (Golang)','PHP','Rust']
  },
  'ui-ux-design': {
    name: 'UI/UX Design', hasProven: false,
    servicesHeading: 'What we Provide in UI/UX Design',
    servicesList: [
      {title:'User Research & Journey Mapping', desc:'We conduct deep user empathy interviews, competitor benchmarking, persona development, and workflow bottleneck analysis to establish solid foundations.'},
      {title:'Enterprise Figma Design Systems', desc:'Comprehensive design component libraries with atomic design tokens, accessibility standards, interactive states, and developer-ready CSS specs.'},
      {title:'Interactive Wireframing & Prototyping', desc:'High-fidelity clickable prototypes that validate features, micro-interactions, and navigation flows with stakeholders before coding begins.'},
      {title:'Responsive Web & Dashboard Design', desc:'Pixel-perfect interfaces tailored for high-density enterprise data tables, complex filter panels, and responsive multi-device layouts.'},
      {title:'Usability Testing & Heuristic Evaluation', desc:'Empirical user testing, clickstream heatmaps, and iterative A/B validation to minimize user friction and maximize task completion.'},
      {title:'WCAG AAA Accessibility Compliance', desc:'Strict color contrast ratios, keyboard navigation semantics, and screen-reader readiness for inclusive global compliance.'},
    ],
    benefitsHeading: 'Why Us for UI/UX Design',
    benefitsIntro: 'We bridge the gap between creative visual elegance and functional software engineering, ensuring every interface is intuitive, accessible, and fast to build.',
    coreBenefits: [
      {title:'User-Centric Architecture', desc:'Every layout and component decision is backed by empirical research and real user behavior analysis.'},
      {title:'50% Faster Dev Handoff', desc:'Production-ready Figma tokens and detailed CSS component specs streamline frontend build time drastically.'},
      {title:'Cohesive Brand Equity', desc:'Unified visual language across web platforms, mobile apps, documentation portals, and marketing surfaces.'},
    ],
    extendedBenefits: [
      {title:'Higher User Retention', desc:'Intuitive frictionless interfaces drastically reduce onboarding churn and customer support tickets.'},
      {title:'Conversion Funnel Velocity', desc:'Optimized checkout and signup funnels convert visitors into active paying users with higher velocity.'},
      {title:'Modular Future Scalability', desc:'Modular design systems enable rapid addition of new features without redesigning screens from scratch.'},
    ],
    proven: null,
    techStack: ['Figma','Adobe XD','Framer','Storybook','Tailwind CSS','Miro','Hotjar','Zeplin']
  },
  'mobile-application': {
    name: 'Mobile Application', hasProven: true,
    servicesHeading: 'What we Provide in Mobile Development',
    servicesList: [
      {title:'Native iOS Engineering', desc:'High-performance native apps written in Swift and SwiftUI, utilizing device hardware capabilities and Apple ecosystem integrations.'},
      {title:'Native Android Engineering', desc:'Robust native Android apps developed with Kotlin and Jetpack Compose, optimized for high responsiveness and memory efficiency.'},
      {title:'Cross-Platform React Native', desc:'Single codebase architectures that achieve 95%+ code sharing between iOS and Android while preserving 60fps native fluidity.'},
      {title:'Flutter High-Performance Apps', desc:'Custom-rendered, pixel-perfect Flutter mobile experiences with smooth 120fps hardware acceleration across all screen sizes.'},
      {title:'Offline-First Data Sync Protocols', desc:'Local SQLite and encrypted caching with automated conflict resolution when cellular or Wi-Fi connectivity is restored.'},
      {title:'App Store & Play Store CI/CD', desc:'Automated Fastlane build, test, signing, and submission pipelines with phased enterprise rollout controls.'},
    ],
    benefitsHeading: 'Why Us for Mobile Applications',
    benefitsIntro: 'We build mobile applications that achieve top user ratings, enterprise security standards, and seamless real-time backend synchronization.',
    coreBenefits: [
      {title:'Native Speed & Fluidity', desc:'Sub-100ms response times and smooth animations designed to maximize user engagement and session length.'},
      {title:'Zero App Store Rejections', desc:'Strict compliance with Apple App Store Review Guidelines and Google Play Security requirements.'},
      {title:'Hardware Biometric Vaults', desc:'FaceID, TouchID, and Keychain/Keystore hardware-backed encryption for confidential client data.'},
    ],
    extendedBenefits: [
      {title:'99.9% Crash-Free Stability', desc:'Automated device farm testing guarantees high stability across hundreds of Android and iOS device models.'},
      {title:'Over-The-Air (OTA) Updates', desc:'Deploy critical bug fixes and content updates instantly without waiting for app store review approval.'},
      {title:'Battery & Network Efficiency', desc:'Optimized background workers and minimal payload sizes that conserve device battery and cellular bandwidth.'},
    ],
    proven: {logo:'LOGI-TRACK FLEET SOLUTIONS', sub:'NATIONWIDE DRIVER LOGISTICS & OFFLINE ENGINE', challenge:'Fleet drivers operating in remote rural areas faced app freezing and lost cargo delivery receipts due to spotty cellular networks, leading to billing disputes.', alliance:'Creed Tech partnered as lead mobile engineering team, rebuilding the driver mobile app on an offline-first Flutter architecture with local database persistence.', solution:'Drivers could scan barcodes, capture digital signatures, and route shipments offline, with automated atomic cloud sync upon re-establishing 4G/5G connectivity.', followup:'Achieved 99.98% crash-free sessions across 12,000 active daily drivers and eliminated delivery receipt loss entirely.'},
    techStack: ['Swift','Kotlin','React Native','Flutter','Fastlane','Firebase','SQLite','GraphQL']
  },
  'cloud-infrastructure': {
    name: 'Cloud Infrastructure', hasProven: true,
    servicesHeading: 'What we Provide in Cloud Infrastructure',
    servicesList: [
      {title:'Multi-Cloud Architecture (AWS / Azure / GCP)', desc:'Secure network isolation, private VPCs, transit gateways, and hybrid cloud interconnects built for high availability.'},
      {title:'Kubernetes Container Orchestration', desc:'Automated pod autoscaling, zero-downtime rolling deployments, service mesh (Istio), and container security hardening.'},
      {title:'Infrastructure as Code (Terraform / Pulumi)', desc:'100% reproducible, version-controlled cloud environments with automated GitOps drift detection.'},
      {title:'Continuous CI/CD Delivery Pipelines', desc:'Automated GitHub Actions and GitLab CI workflows with integrated SAST scanning and staging verification gates.'},
      {title:'24/7 SIEM Surveillance & SRE Telemetry', desc:'Prometheus, Grafana, Datadog, and PagerDuty alert matrices with automated incident triage and <15 min MTTR.'},
      {title:'Disaster Recovery & Multi-Region Failover', desc:'Active-passive and active-active geographic replication with automated DNS failover and point-in-time recovery.'},
    ],
    benefitsHeading: 'Why Us for Cloud Infrastructure',
    benefitsIntro: 'We transform unpredictable server management into an automated, highly available, and cost-efficient cloud engineering engine.',
    coreBenefits: [
      {title:'99.99% Guaranteed SLA Uptime', desc:'Fault-tolerant multi-availability zone infrastructure engineered for continuous enterprise reliability.'},
      {title:'Zero Configuration Drift', desc:'Every server, security group, and cluster is declared in version-controlled Terraform code.'},
      {title:'Enterprise Defense Hardening', desc:'Strict CIS benchmark hardening, automated vulnerability patching, and zero-trust IAM segmentation.'},
    ],
    extendedBenefits: [
      {title:'35% Cloud Cost Optimization', desc:'Automated rightsizing, spot instance orchestration, and reserved capacity management reduce monthly cloud bills.'},
      {title:'Instant Horizontal Elasticity', desc:'Clusters scale from 10 to 10,000 instances automatically during viral traffic surges without manual intervention.'},
      {title:'Audit & Compliance Alignment', desc:'Out-of-the-box infrastructure alignment with ISO 27001, SOC 2 Type II, and PCI-DSS security criteria.'},
    ],
    proven: {logo:'STREAM-NET GLOBAL MEDIA', sub:'MULTI-REGION CLOUD INFRASTRUCTURE & EDGE SCALING', challenge:'Traffic surges during live sports broadcasts overwhelmed legacy dedicated servers, leading to video buffering and costly service outages.', alliance:'Creed Tech architected and deployed an automated Kubernetes cluster on AWS across Frankfurt, Virginia, and Tokyo with Cloudflare Enterprise routing.', solution:'Achieved 100% uninterrupted uptime across 10M concurrent video streams while reducing raw hosting spend by 38% through automated pod scaling.', followup:'Full disaster recovery failover tested live with zero dropped packets and sub-10 second failover DNS switching.'},
    techStack: ['AWS','Azure','GCP','Kubernetes','Terraform','Docker','Datadog','Cloudflare']
  },
  'database-management': {
    name: 'Database Management', hasProven: true,
    servicesHeading: 'What we Provide in Database Management',
    servicesList: [
      {title:'Relational Database Architecture', desc:'Advanced schema design, connection pooling (PgBouncer), read-replica clusters, and ACID transaction safety on PostgreSQL and MySQL.'},
      {title:'Distributed NoSQL Database Solutions', desc:'High-throughput document and key-value stores (MongoDB, DynamoDB, Redis) with sub-millisecond query latency.'},
      {title:'Query Optimization & Index Engineering', desc:'Deep EXPLAIN ANALYZE query tuning, composite index engineering, and query caching eliminating database bottlenecks.'},
      {title:'Zero-Downtime Data Migration', desc:'Change Data Capture (CDC) streaming pipelines to migrate multi-terabyte production databases with zero downtime.'},
      {title:'Automated Backup & Point-in-Time Recovery', desc:'Hourly atomic snapshots, cross-region replication, and continuous WAL archiving guaranteeing RPO < 1 min.'},
      {title:'KMS Encryption & Data Governance', desc:'AES-256 field-level encryption at rest, TLS 1.3 in transit, automated audit logs, and GDPR erasure compliance.'},
    ],
    benefitsHeading: 'Why Us for Database Management',
    benefitsIntro: 'We protect your most critical asset—your data—with sub-millisecond query performance, strict ACID compliance, and zero data loss architectures.',
    coreBenefits: [
      {title:'Sub-Millisecond Query Response', desc:'Expertly tuned indexes and in-memory Redis caches deliver ultra-fast data retrieval even under heavy concurrency.'},
      {title:'Zero Data Loss Guarantee', desc:'Multi-AZ replication and automated WAL archiving protect against catastrophic hardware failures.'},
      {title:'Seamless Scale to Billions of Rows', desc:'Intelligent sharding and partitioning strategies prevent database degradation as data volume grows.'},
    ],
    extendedBenefits: [
      {title:'24/7 DBA Surveillance', desc:'Automated deadlock detection, slow-query tracking, and proactive storage expansion before issues affect users.'},
      {title:'Bank-Grade Data Security', desc:'Hardware-backed KMS envelope encryption ensures confidential financial and PII data is protected at all times.'},
      {title:'Type-Safe ORM Integration', desc:'Clean TypeScript Prisma, TypeORM, and SQLAlchemy bindings with type-safe query builders.'},
    ],
    proven: {logo:'OMNI-COMMERCE RETAIL NETWORK', sub:'HIGH-CONCURRENCY DATABASE ARCHITECTURE', challenge:'Database CPU utilization hit 99% during flash sales, causing order processing bottlenecks and checkout timeout errors.', alliance:'Creed Tech audited the PostgreSQL cluster, refactored 40+ complex reporting queries, and introduced distributed Redis caching.', solution:'Cut database query execution time from 1,200ms to 8ms, allowing the retailer to process 45,000 simultaneous orders with 18% CPU load.', followup:'Enabled seamless multi-region read replicas with real-time replication latency under 15ms.'},
    techStack: ['PostgreSQL','MongoDB','Redis','Aurora','Elasticsearch','Kafka','Prisma','MySQL']
  },
  'web-development': {
    name: 'Web Development', hasProven: true,
    servicesHeading: 'What we Provide in Web Development',
    servicesList: [
      {title:'Next.js & React Web Platforms', desc:'Server-Side Rendering (SSR) and Static Site Generation (SSG) architectures providing instant initial page loads.'},
      {title:'Fullstack TypeScript Engineering', desc:'End-to-end type safety from database models to frontend React components, preventing runtime errors.'},
      {title:'Headless CMS & Content Hubs', desc:'Integration with Sanity, Strapi, and Contentful giving marketing teams full publishing agility with zero code changes.'},
      {title:'High-Converting Portals & Checkout', desc:'Secure client portals, custom checkout funnels, and automated payment processing with Stripe and PayPal.'},
      {title:'Core Web Vitals 99+ Optimization', desc:'Sub-second Largest Contentful Paint (LCP), zero Cumulative Layout Shift (CLS), and ultra-fast First Input Delay (FID).'},
      {title:'Progressive Web Apps (PWA)', desc:'Offline caching, push notifications, and home screen installability delivering mobile app quality in the browser.'},
    ],
    benefitsHeading: 'Why Us for Web Development',
    benefitsIntro: 'We engineer high-performance web platforms that combine pixel-perfect UI execution, server-side rendering, edge caching, and technical SEO supremacy.',
    coreBenefits: [
      {title:'Sub-Second Page Loads', desc:'Global CDN edge distribution ensures users worldwide experience instantaneous loading.'},
      {title:'SEO Supremacy', desc:'Clean semantic HTML5, automated OpenGraph metadata, schema markup, and dynamic XML sitemaps.'},
      {title:'Bulletproof Security', desc:'Strict CSP headers, XSS prevention, CSRF mitigation, and automatic SSL/TLS encryption.'},
    ],
    extendedBenefits: [
      {title:'Higher Search Rankings', desc:'Google rewards our 99+ Core Web Vitals speed scores with top organic search placement.'},
      {title:'Omni-Device Responsiveness', desc:'Meticulously crafted breakpoints that render flawlessly on smartphones, tablets, and 4K displays.'},
      {title:'Lower Maintenance Overhead', desc:'Modular component architecture makes future upgrades and styling changes fast and risk-free.'},
    ],
    proven: {logo:'ENTERPRISE B2B SAAS PLATFORM', sub:'NEXT.JS MODERNIZATION & CONVERSION LIFT', challenge:'The legacy client portal suffered from slow 4.5-second load times and poor mobile responsiveness, hurting lead conversion and signups.', alliance:'Creed Tech rebuilt the marketing site and client portal on Next.js 15, TypeScript, and edge-cached Vercel infrastructure.', solution:'Reduced page load time to 0.6s, increased organic Google search traffic by 140%, and lifted trial signup conversion by 52%.', followup:'Delivered a modular headless CMS setup enabling marketing to publish 20+ campaign pages per week.'},
    techStack: ['Next.js','React','TypeScript','Tailwind CSS','Vercel','GraphQL','Stripe','Supabase']
  },
  'ai-automation': {
    name: 'AI & Automation', hasProven: true,
    servicesHeading: 'What we Provide in AI & Automation',
    servicesList: [
      {title:'Custom LLM & Private Model Fine-Tuning', desc:'Domain-specific fine-tuning on open-source Llama, Mistral, and Claude models hosted within your private cloud VPC.'},
      {title:'Retrieval-Augmented Generation (RAG)', desc:'Hybrid dense/sparse vector search over proprietary PDFs, internal wikis, and databases with verifiable source citations.'},
      {title:'Autonomous Multi-Agent Workflows', desc:'Intelligent AI agents (LangGraph / AutoGen) capable of orchestrating complex multi-step research, coding, and CRM tasks.'},
      {title:'Computer Vision & Intelligent Document OCR', desc:'Automated extraction and structuring of data from scanned invoices, receipts, contracts, and identification cards.'},
      {title:'Predictive Analytics & ML Pipelines', desc:'Time-series forecasting, customer churn prediction, and real-time fraud anomaly detection models.'},
      {title:'Robotic Process Automation (RPA)', desc:'End-to-end bot automation connecting legacy desktop tools, email triggers, and enterprise databases.'},
    ],
    benefitsHeading: 'Why Us for AI & Automation',
    benefitsIntro: 'We build enterprise AI systems that transform unstructured corporate knowledge into actionable intelligence, automate operational bottlenecks, and empower your workforce.',
    coreBenefits: [
      {title:'100% Private Sovereign Data', desc:'Zero data leakage: your proprietary models and embeddings never train public foundation models.'},
      {title:'80% Reduction in Manual Labor', desc:'Automate tedious document auditing, data extraction, and repetitive customer triage.'},
      {title:'Verifiable Ground-Truth Citations', desc:'Strict RAG guardrails and ground-truth citations guarantee factual model responses.'},
    ],
    extendedBenefits: [
      {title:'24/7 Intelligent Automation', desc:'AI agents work continuously overnight, processing orders, answering inquiries, and validating data.'},
      {title:'Exponential Team Multiplier', desc:'Empower team members with tailored AI copilots built specifically for their internal workflows.'},
      {title:'Rapid Prototype to Production', desc:'Deploy production-ready LangChain and FastAPI endpoints in weeks rather than quarters.'},
    ],
    proven: {logo:'COMMERCIAL INSURANCE CARRIER', sub:'AUTOMATED UNDERWRITING AI & DOCUMENT RAG', challenge:'Underwriters spent 4+ hours per application manually reviewing 100-page policy risk documents and commercial property reports.', alliance:"Creed Tech deployed a private RAG pipeline using Llama 3 and Pinecone vector search within the client's dedicated AWS environment.", solution:'Automated document risk scoring and clause extraction, reducing underwriter review time to under 12 minutes with 99.4% accuracy.', followup:'Integrated automated compliance logging to verify every AI citation against original source documents.'},
    techStack: ['Python','PyTorch','OpenAI','LangChain','Pinecone','LlamaIndex','Hugging Face','FastAPI']
  },
  'digital-growth': {
    name: 'Digital Growth', hasProven: true,
    servicesHeading: 'What we Provide in Digital Growth',
    servicesList: [
      {title:'Technical Search Engine Optimization (SEO)', desc:'Advanced site architecture audits, programmatic SEO indexing, schema markup, and crawl budget optimization.'},
      {title:'Conversion Rate Optimization (CRO)', desc:'Hypothesis-driven A/B split testing, clickstream analysis, and checkout funnel friction elimination.'},
      {title:'Multi-Touch Attribution & Telemetry', desc:'Server-side Google Analytics 4 (GA4), Segment, and Mixpanel tracking with privacy-compliant Cookieless models.'},
      {title:'High-Speed Landing Page Engineering', desc:'Rapid deployment of dynamic, personalized landing pages tailored for high-intent paid campaigns.'},
      {title:'Lead Generation & CRM Automation', desc:'Automated lead qualification pipelines integrating HubSpot, Salesforce, and real-time Slack notifications.'},
      {title:'Executive Real-Time Growth Dashboards', desc:'Custom Looker and Tableau dashboards providing unified visibility into CAC, LTV, MRR, and channel ROI.'},
    ],
    benefitsHeading: 'Why Us for Digital Growth',
    benefitsIntro: 'We combine technical software engineering with deep performance marketing telemetry to systematically grow your organic search authority, acquisition funnels, and customer lifetime value.',
    coreBenefits: [
      {title:'Sustainable Organic Pipeline', desc:'Build compounding domain authority that generates inbound enterprise leads without escalating ad spend.'},
      {title:'Data-Driven Precision', desc:'Eliminate guesswork with statistically significant A/B testing and rigorous funnel analytics.'},
      {title:'Engineered for Conversions', desc:'Merge high software engineering standards with persuasive conversion architecture.'},
    ],
    extendedBenefits: [
      {title:'Lower Customer Acquisition Cost', desc:'Optimized conversion funnels double lead capture from existing website traffic.'},
      {title:'Real-Time ROI Clarity', desc:'Understand the exact revenue contribution of every marketing channel with server-side tracking.'},
      {title:'Programmatic Scaling', desc:'Generate thousands of high-ranking directory and category landing pages programmatically.'},
    ],
    proven: {logo:'ENTERPRISE B2B CYBERSECURITY FIRM', sub:'ORGANIC SEARCH & FUNNEL SCALING', challenge:'The client had low organic Google search visibility and high paid search CPC ($140/click) for core enterprise security terms.', alliance:'Creed Tech implemented a programmatic technical SEO architecture and overhauled the product demo booking funnel.', solution:'Grew organic monthly search impressions from 25k to 480k, captured 85+ Page 1 Google rankings, and tripled demo conversions.', followup:'Built real-time executive Looker dashboards tracking pipeline velocity directly to closed revenue.'},
    techStack: ['GA4','Segment','Mixpanel','Search Console','Hotjar','HubSpot','SEMrush','Optimizely']
  }
};

// 6-Sector Projects Data
var PROJECT_SECTORS = {
  'finance': {
    badge: 'FINANCIAL PLATFORM',
    title: 'Finance Modernization & Core Ledger',
    desc: 'High-throughput algorithmic trading engine and sub-second payment settlement with automated regulatory compliance.',
    subText: 'Real-time financial telemetry, automated fraud screening, and zero-discrepancy reconciliation ledger.',
    bgGradient: 'linear-gradient(135deg, #0B132B, #1C2541, #0A0E1A)',
    screenTitle: 'FINANCE PRODUCT',
    screenSub: 'Algorithmic Order Execution & Settlement Matrix'
  },
  'housing': {
    badge: 'REAL ESTATE SAAS',
    title: 'Smart Property & Tenant Management',
    desc: 'Unified property management console handling digital tenant leasing, automated rent collection, and maintenance routing.',
    subText: 'Multi-property portfolio analytics, automated tenant credit scoring, and digital escrow payments.',
    bgGradient: 'linear-gradient(135deg, #0A192F, #112240, #020C1B)',
    screenTitle: 'HOUSING PORTAL',
    screenSub: 'Automated Tenant Leasing & Digital Escrow'
  },
  'operations': {
    badge: 'SUPPLY CHAIN ENGINE',
    title: 'Enterprise Supply Chain & Logistics',
    desc: 'Real-time telemetry, automated fulfillment dispatch, and predictive inventory intelligence across distribution networks.',
    subText: 'Offline-first driver sync, automated ERP inventory reconciliation, and route optimization.',
    bgGradient: 'linear-gradient(135deg, #141E30, #243B55, #0D1524)',
    screenTitle: 'OPERATIONS SUITE',
    screenSub: 'Global Fleet Telemetry & Warehouse Inventory'
  },
  'ai': {
    badge: 'ENTERPRISE AI & RAG',
    title: 'Private Enterprise LLM & Neural Copilot',
    desc: 'Domain-fine-tuned private models turning complex unstructured documents into verified insights with source citations.',
    subText: 'Zero-data-leakage VPC hosting, high-density vector search, and autonomous multi-agent copilot triage.',
    bgGradient: 'linear-gradient(135deg, #1E1233, #2E1A4E, #120B20)',
    screenTitle: 'AI REASONING',
    screenSub: 'Private Neural LLM & RAG Vector Knowledge Base'
  },
  'data-migration': {
    badge: 'DATABASE ARCHITECTURE',
    title: 'Zero-Downtime Multi-Cloud Data Migration',
    desc: 'High-throughput transactional ETL pipeline migrating 40M+ relational records safely across cloud clusters.',
    subText: 'Live CDC continuous streaming, automated rollback safety, and sub-50ms synchronization latency.',
    bgGradient: 'linear-gradient(135deg, #0B1E28, #132E3E, #061219)',
    screenTitle: 'DATA ETL PIPELINE',
    screenSub: 'Live CDC Streaming & Zero-Downtime Migration'
  },
  'students-abroad': {
    badge: 'GLOBAL EDTECH PORTAL',
    title: 'International Student Visa & Admissions',
    desc: 'Automated international university application tracking, AI counselor matching, and global tuition rails.',
    subText: 'Automated embassy document validation, university degree matching, and multi-currency banking.',
    bgGradient: 'linear-gradient(135deg, #20180B, #332512, #140F07)',
    screenTitle: 'STUDENT ADMISSIONS',
    screenSub: 'Global University Admissions & Visa Pipeline'
  }
};

function selectProjectSector(secId) {
  var sec = PROJECT_SECTORS[secId];
  if (!sec) return;
  
  Object.keys(PROJECT_SECTORS).forEach(function(k) {
    var btn = document.getElementById('psec-btn-' + k);
    if (!btn) return;
    if (k === secId) {
      btn.style.background = '#FF5500';
      btn.style.color = '#FFFFFF';
      btn.style.boxShadow = '0 10px 15px -3px rgba(255,85,0,0.4)';
    } else {
      btn.style.background = 'transparent';
      btn.style.color = '#D1D5DB';
      btn.style.boxShadow = 'none';
    }
  });

  var mockup = document.getElementById('psec-mockup');
  if (mockup) mockup.style.background = sec.bgGradient;
  var badge = document.getElementById('psec-badge');
  if (badge) badge.textContent = sec.badge;
  var screenTitle = document.getElementById('psec-screentitle');
  if (screenTitle) screenTitle.textContent = sec.screenTitle;
  var screenSub = document.getElementById('psec-screensub');
  if (screenSub) screenSub.textContent = sec.screenSub;
  var title = document.getElementById('psec-title');
  if (title) title.textContent = sec.title;
  var desc = document.getElementById('psec-desc');
  if (desc) desc.textContent = sec.desc;
  var subtext = document.getElementById('psec-subtext');
  if (subtext) subtext.textContent = sec.subText;
}

function h(str) {
  return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function updateSubTabStyles(tab) {
  var isDesktop = window.innerWidth >= 768;
  ['services','benefits','proven'].forEach(function(t) {
    var btn = document.getElementById('sub-' + t);
    if (!btn) return;
    if (t === tab) {
      btn.style.color = '#030712';
      btn.style.fontWeight = '700';
      btn.style.opacity = '1';
      if (isDesktop) {
        btn.style.borderRight = '2px solid #030712';
        btn.style.borderBottom = 'none';
      } else {
        btn.style.borderBottom = '2px solid #030712';
        btn.style.borderRight = 'none';
      }
    } else {
      btn.style.color = '#9CA3AF';
      btn.style.fontWeight = '500';
      btn.style.opacity = '0.85';
      btn.style.borderRight = isDesktop ? '2px solid transparent' : 'none';
      btn.style.borderBottom = isDesktop ? 'none' : '2px solid transparent';
    }
  });
}

function selectSvc(id, pushHash) {
  activeSvcId = id;
  activeSubTab = 'services';
  
  var allIds = ['software-development','ui-ux-design','mobile-application','cloud-infrastructure','database-management','web-development','ai-automation','digital-growth'];
  allIds.forEach(function(sid) {
    var btn = document.getElementById('svctab-' + sid);
    if (!btn) return;
    btn.style.color = '#374151';
    btn.style.fontWeight = '600';
    btn.style.borderBottom = '2px solid transparent';
    btn.style.background = 'transparent';
    var dot = btn.querySelector('[class^="svctab-dot"]');
    if (dot) { dot.style.background = '#9CA3AF'; dot.style.transform = 'scale(1)'; dot.style.boxShadow = 'none'; }
  });
  
  var activeBtn = document.getElementById('svctab-' + id);
  if (activeBtn) {
    activeBtn.style.color = '#0052FF';
    activeBtn.style.fontWeight = '700';
    activeBtn.style.borderBottom = '2px solid #0052FF';
    activeBtn.style.background = 'rgba(219,234,254,0.7)';
    var dot = activeBtn.querySelector('[class^="svctab-dot"]');
    if (dot) { dot.style.background = '#FF6B00'; dot.style.transform = 'scale(1.25)'; dot.style.boxShadow = '0 0 0 3px rgba(255,107,0,0.2)'; }
  }
  
  updateSubTabStyles(activeSubTab);
  renderContent();
  if (pushHash !== false && window.location.hash !== '#' + id) {
    try { window.history.replaceState(null, '', '#' + id); } catch(e){}
  }
}

function setSubTab(tab) {
  activeSubTab = tab;
  updateSubTabStyles(tab);
  renderContent();
}

function renderContent() {
  var svc = SVCS[activeSvcId];
  if (!svc) return;
  
  var provenBtn = document.getElementById('sub-proven');
  if (provenBtn) provenBtn.style.display = svc.hasProven ? 'block' : 'none';
  
  var area = document.getElementById('svcContentArea');
  if (!area) return;
  
  var checkIcon = '<svg style="width:22px;height:22px;flex-shrink:0;margin-top:2px;" viewBox="0 0 24 24" fill="none"><path d="M4 12.5L8.5 17L19 6.5" stroke="#0A66FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 12.5L13.5 17L22 8" stroke="#0A66FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.5"/></svg>';
  
  if (activeSubTab === 'services') {
    var items = svc.servicesList.map(function(item) {
      return '<div style="display:flex;align-items:flex-start;gap:12px;width:100%;box-sizing:border-box;"><span style="flex-shrink:0;">' + checkIcon + '</span><div style="flex:1;min-width:0;"><h3 style="font-size:1.15rem;font-weight:700;color:#030712;margin:0 0 6px;line-height:1.35;">' + h(item.title) + '</h3><p style="font-size:0.875rem;color:#374151;line-height:1.65;margin:0;font-weight:400;">' + h(item.desc) + '</p></div></div>';
    }).join('');
    area.innerHTML = '<h2 style="font-size:clamp(1.5rem,3.2vw,2.25rem);font-weight:700;color:#030712;letter-spacing:-0.02em;margin-bottom:1.75rem;line-height:1.25;">' + h(svc.servicesHeading) + '</h2><div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(min(100%, 280px), 1fr));gap:1.75rem 2.5rem;width:100%;box-sizing:border-box;">' + items + '</div>';
  
  } else if (activeSubTab === 'benefits') {
    var core = svc.coreBenefits.map(function(cb) {
      return '<li style="display:flex;align-items:flex-start;gap:10px;font-size:0.875rem;color:#374151;line-height:1.65;width:100%;box-sizing:border-box;"><span style="color:#0052FF;font-weight:800;flex-shrink:0;margin-top:1px;">•</span><span style="flex:1;min-width:0;"><strong style="color:#030712;font-weight:700;">' + h(cb.title) + ':</strong> ' + h(cb.desc) + '</span></li>';
    }).join('');
    var ext = svc.extendedBenefits.map(function(eb) {
      return '<li style="display:flex;align-items:flex-start;gap:10px;font-size:0.875rem;color:#374151;line-height:1.65;width:100%;box-sizing:border-box;"><span style="color:#0052FF;font-weight:800;flex-shrink:0;margin-top:1px;">•</span><span style="flex:1;min-width:0;"><strong style="color:#030712;font-weight:700;">' + h(eb.title) + ':</strong> ' + h(eb.desc) + '</span></li>';
    }).join('');
    area.innerHTML = '<div style="margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid #D1D5DB;width:100%;box-sizing:border-box;"><h2 style="font-size:clamp(1.5rem,3.2vw,2.25rem);font-weight:700;color:#030712;letter-spacing:-0.02em;margin-bottom:0.75rem;line-height:1.25;">' + h(svc.benefitsHeading) + '</h2><p style="font-size:0.875rem;color:#374151;line-height:1.65;max-width:56rem;margin:0;">' + h(svc.benefitsIntro) + '</p></div><div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(min(100%, 280px), 1fr));gap:1.75rem 2.5rem;width:100%;box-sizing:border-box;"><div><div style="display:flex;align-items:center;gap:10px;margin-bottom:1rem;"><span style="font-size:1.15rem;font-weight:700;color:#9CA3AF;">01</span><h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;">Core Benefits</h3></div><ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.85rem;width:100%;box-sizing:border-box;">' + core + '</ul></div><div><div style="display:flex;align-items:center;gap:10px;margin-bottom:1rem;"><span style="font-size:1.15rem;font-weight:700;color:#9CA3AF;">02</span><h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;">Extended Benefits</h3></div><ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.85rem;width:100%;box-sizing:border-box;">' + ext + '</ul></div></div>';
  
  } else if (activeSubTab === 'proven' && svc.proven) {
    var pr = svc.proven;
    area.innerHTML = '<div style="text-align:center;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid #D1D5DB;width:100%;box-sizing:border-box;"><span style="font-size:1.5rem;font-weight:800;letter-spacing:0.04em;color:#0B1F3A;display:block;margin-bottom:4px;">🏛 ' + h(pr.logo) + '</span><span style="font-size:0.75rem;color:#6B7280;text-transform:uppercase;letter-spacing:0.08em;font-weight:700;">' + h(pr.sub) + '</span></div><div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(min(100%, 280px), 1fr));gap:1.75rem 2.5rem;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid #D1D5DB;width:100%;box-sizing:border-box;"><div><div style="display:flex;align-items:center;gap:10px;margin-bottom:0.6rem;"><span style="font-size:1.15rem;font-weight:700;color:#9CA3AF;">01</span><h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;">The Challenge</h3></div><p style="font-size:0.875rem;color:#374151;line-height:1.65;margin:0;">' + h(pr.challenge) + '</p></div><div><div style="display:flex;align-items:center;gap:10px;margin-bottom:0.6rem;"><span style="font-size:1.15rem;font-weight:700;color:#9CA3AF;">02</span><h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;">Strong Alliance</h3></div><p style="font-size:0.875rem;color:#374151;line-height:1.65;margin:0;">' + h(pr.alliance) + '</p></div></div><div><div style="display:flex;align-items:center;gap:10px;margin-bottom:0.6rem;"><span style="font-size:1.15rem;font-weight:700;color:#9CA3AF;">03</span><h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;">Solution</h3></div><p style="font-size:0.875rem;color:#374151;line-height:1.65;margin-bottom:0.85rem;">' + h(pr.solution) + '</p>' + (pr.followup ? '<p style="font-size:0.875rem;color:#374151;line-height:1.65;margin:0;">' + h(pr.followup) + '</p>' : '') + '</div>';
  }
  
  // Update tech stack
  var svcEl = document.getElementById('techStackName');
  if (svcEl) svcEl.textContent = svc.name;
  var grid = document.getElementById('techStackGrid');
  if (grid) {
    grid.innerHTML = svc.techStack.map(function(t) {
      var iconSvg = TECH_ICONS[t.toUpperCase()] || TECH_ICONS[t] || null;
      var iconHtml = iconSvg ? '<div style="width:2.75rem;height:2.75rem;display:flex;align-items:center;justify-content:center;margin-bottom:6px;">' + iconSvg + '</div>' : '<div style="width:2.75rem;height:2.75rem;background:#F3F4F6;border-radius:6px;display:flex;align-items:center;justify-content:center;margin-bottom:6px;font-size:10px;font-weight:700;color:#374151;">' + h(t.substring(0,3)) + '</div>';
      return '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;padding:12px 6px;text-align:center;background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.03);cursor:default;transition:all 0.2s;" onmouseover="this.style.transform=\'translateY(-3px)\';this.style.borderColor=\'#0052FF\'" onmouseout="this.style.transform=\'translateY(0)\';this.style.borderColor=\'#E2E8F0\'">' + iconHtml + '<span style="font-size:11.5px;font-weight:600;color:#1F2937;letter-spacing:-0.01em;max-width:100%;text-align:center;display:block;line-height:1.25;word-break:break-word;">' + h(t) + '</span></div>';
    }).join('');
  }
}

// Init on script load and DOM ready for instant zero-lag render
function initServicesPage() {
  selectSvc('software-development', false);
  selectProjectSector('finance');
  
  var aliases = {'ui-ux':'ui-ux-design','mobile-applications':'mobile-application','mobile-application':'mobile-application','ui-ux-design':'ui-ux-design','cloud-infrastructure':'cloud-infrastructure','database-management':'database-management','web-development':'web-development','ai-automation':'ai-automation','digital-growth':'digital-growth','software-development':'software-development'};
  var hash = window.location.hash.replace('#','').toLowerCase();
  if (hash && (aliases[hash] || SVCS[hash])) selectSvc(aliases[hash] || hash, false);
}

document.addEventListener('DOMContentLoaded', initServicesPage);
window.addEventListener('hashchange', function() {
  var aliases = {'ui-ux':'ui-ux-design','mobile-applications':'mobile-application','mobile-application':'mobile-application','ui-ux-design':'ui-ux-design','cloud-infrastructure':'cloud-infrastructure','database-management':'database-management','web-development':'web-development','ai-automation':'ai-automation','digital-growth':'digital-growth','software-development':'software-development'};
  var h2 = window.location.hash.replace('#','').toLowerCase();
  if (h2 && (aliases[h2] || SVCS[h2])) selectSvc(aliases[h2] || h2, false);
});

// Vision form submission
document.getElementById('visionForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  var btn = document.getElementById('vfBtn'); var txt = document.getElementById('vfBtnText');
  btn.disabled = true; txt.textContent = 'Submitting...';
  try {
    var fd = new FormData(this);
    var res = await fetch('ajax/contact.php', {method:'POST', body:fd});
    document.getElementById('visionOK').style.display = 'block';
    document.getElementById('visionOK').textContent = '\u2713 Thank you! Your project specification has been delivered to our Lead Systems Architects. We will respond within 2 to 4 hours.';
    this.reset();
  } catch(err) {
    document.getElementById('visionOK').style.display = 'block';
    document.getElementById('visionOK').textContent = '\u2713 Thank you! Your project specification has been delivered to our Lead Systems Architects. We will respond within 2 to 4 hours.';
    this.reset();
  }
  btn.disabled = false; txt.textContent = 'Find the Right Fit';
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
