<?php
$page_title = "About Creed Tech | Engineering Principles & Leadership";
$page_description = "Learn about Creed Tech's engineering principles, distributed architecture hubs, and commitment to sovereign enterprise software.";
$active_page = "about";

$aboutSettingsFile = __DIR__ . '/data/about_page_settings.json';
$aboutData = file_exists($aboutSettingsFile) ? (json_decode(@file_get_contents($aboutSettingsFile), true) ?: []) : [];

$hubsSection = $aboutData['hubs_section'] ?? [
    'badge' => 'GLOBAL REACH & CONTINUOUS COVERAGE',
    'title' => 'Three Specialized Global Engineering Centers',
    'description' => 'Operating across multiple time zones to deliver seamless 24/7 technical continuity and deep regional domain expertise.',
    'hubs' => [
        [
            'city' => 'Frankfurt',
            'country' => 'Germany',
            'image' => 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?w=600&auto=format&fit=crop&q=80',
            'specialization' => 'European Cloud Infrastructure & Cyber Defense',
            'address' => '📍 Taunusanlage 8, Financial Centre, Frankfurt',
            'status' => 'Active Regional Engineering Pod'
        ],
        [
            'city' => 'Madrid',
            'country' => 'Spain',
            'image' => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=600&auto=format&fit=crop&q=80',
            'specialization' => 'Mobile Engineering & Digital Innovation Lab',
            'address' => '📍 Paseo de la Castellana 95, Madrid',
            'status' => 'Active Regional Engineering Pod'
        ],
        [
            'city' => 'San Francisco',
            'country' => 'United States',
            'image' => 'https://images.unsplash.com/photo-1501594907352-04cda38ebc29?w=600&auto=format&fit=crop&q=80',
            'specialization' => 'AI Research, Neural Systems & Cloud Labs',
            'address' => '📍 500 Howard Street, SoMa Tech District, San Francisco',
            'status' => 'Active Regional Engineering Pod'
        ]
    ]
];

$leadershipSection = $aboutData['leadership_section'] ?? [
    'badge' => 'THE PEOPLE BEHIND THE CODE',
    'title' => 'Executive Leadership & Technical Custodians',
    'description' => 'Meet the founders and principal architects who guide our engineering vision and mentor our senior pods across 3 global centers.',
    'leaders' => [
        [
            'name' => 'Alexander Wright',
            'role' => 'Founder & Chief Executive Officer',
            'badge' => 'Senior Systems Architect',
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&auto=format&fit=crop&q=80',
            'bio' => 'Founded Creed Tech in 2023 with the conviction that next-generation enterprise software should be built with mathematical precision, neural scalability, and uncompromising craftsmanship.',
            'quote' => 'We don\'t build software to sell and walk away. We build digital infrastructure that companies run their entire future on.',
            'link_text' => 'Connect with Alexander →',
            'link_url' => 'contact'
        ],
        [
            'name' => 'Dr. Elena Rostova',
            'role' => 'Chief Technology Officer',
            'badge' => 'Ph.D. Neural Computing',
            'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&auto=format&fit=crop&q=80',
            'bio' => 'Directs our research in private enterprise LLMs and distributed vector streaming. Champion of vendor-neutral open cloud architecture.',
            'quote' => 'The best engineering is invisible—it performs flawlessly under maximum load without ever asking for praise.',
            'link_text' => 'Connect with Elena →',
            'link_url' => 'contact'
        ],
        [
            'name' => 'Marcus Vance',
            'role' => 'Head of Global Security & Governance',
            'badge' => 'Ex-Defense Cryptographer',
            'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=500&auto=format&fit=crop&q=80',
            'bio' => 'Oversees zero-trust architectures, sovereign data privacy, and SOC 2 Type II governance across all client engagements.',
            'quote' => 'In high-stakes systems, trust is not a promise. It is mathematically verified cryptography.',
            'link_text' => 'Connect with Marcus →',
            'link_url' => 'contact'
        ],
        [
            'name' => 'Sarah Jenkins',
            'role' => 'VP of Global Client Engineering',
            'badge' => '14+ Yrs Agile Delivery',
            'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&auto=format&fit=crop&q=80',
            'bio' => 'Directs our dedicated senior engineering pods across 3 global centers, guaranteeing milestone velocity, zero-defect releases, and continuous client alignment.',
            'quote' => 'Engineering maturity is not just about writing code; it is about delivering business outcomes with absolute predictability.',
            'link_text' => 'Connect with Sarah →',
            'link_url' => 'contact'
        ]
    ]
];

include __DIR__ . '/includes/header.php';
?>

<style>
/* =========================================================================
   ABOUT PAGE DESIGN SYSTEM (DESKTOP FIRST + DEDICATED MOBILE OVERRIDES)
   ========================================================================= */

.about-page {
  width: 100%;
  background: #fff;
  color: #111827;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  text-align: left;
  overflow-x: hidden;
}

.about-container {
  width: 100%;
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 2rem;
  box-sizing: border-box;
}

/* Sections Default (Desktop Spacious & Luxurious) */
.about-hero-section {
  width: 100%;
  background: linear-gradient(to bottom, #F2F5FB, #F8FAFC, #FFFFFF);
  color: #111827;
  padding: 5.5rem 0 6.5rem;
  position: relative;
  overflow: hidden;
  border-bottom: 1px solid #E5E7EB;
  text-align: center;
}
.about-section {
  width: 100%;
  padding: 5.5rem 0;
  border-bottom: 1px solid #E5E7EB;
  text-align: center;
}
.about-section-header {
  text-align: center;
  max-width: 48rem;
  margin: 0 auto 3.5rem;
}
.about-section-title {
  font-size: clamp(2rem, 3.5vw, 2.75rem);
  font-weight: 700;
  color: #030712;
  letter-spacing: -0.02em;
  line-height: 1.2;
  margin: 0 0 0.75rem;
}
.about-section-desc {
  font-size: 1rem;
  color: #4B5563;
  line-height: 1.7;
  font-weight: 400;
  margin: 0 auto;
}

/* Philosophy 6 Cards (Desktop 3 Cols) */
.about-philosophy-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  text-align: left;
}
.about-philosophy-card {
  background: #fff;
  border-radius: 1rem;
  padding: 2.25rem;
  border: 1px solid #E5E7EB;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 360px;
  transition: all 0.3s;
}

/* What We Do 3 Cards (Desktop 3 Cols) */
.about-whatwedo-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  text-align: left;
}
.about-whatwedo-card {
  border-radius: 1rem;
  padding: 2.25rem;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 360px;
  transition: all 0.3s;
}

/* Creed Code 4 Pillars (Desktop 2 Cols) */
.creed-code-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2rem;
  text-align: left;
}
.creed-code-card {
  background: #fff;
  border-radius: 1rem;
  border: 1px solid #E5E7EB;
  padding: 2.25rem;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Global Hubs (Desktop 3 Cols) */
.about-hubs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  text-align: left;
}
.about-hub-card {
  background: #FAFAFC;
  border-radius: 1rem;
  border: 1px solid #E5E7EB;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.about-hub-img {
  width: 100%;
  height: 11rem;
  position: relative;
  overflow: hidden;
  background: #111827;
}

/* Leadership (Desktop 2 Cols Landscape Cards) */
.about-leader-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2rem;
  text-align: left;
}
.about-leader-card {
  background: #fff;
  border-radius: 1rem;
  border: 1px solid #E5E7EB;
  padding: 1.75rem;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  display: flex;
  flex-direction: row;
  gap: 1.5rem;
  text-align: left;
  transition: all 0.3s;
}
.about-leader-img-box {
  width: 10.5rem;
  height: 13.5rem;
  border-radius: 0.75rem;
  overflow: hidden;
  flex-shrink: 0;
  position: relative;
  background: #111827;
}

/* 4 Metrics Strip (Desktop 4 Cols) */
.about-metrics-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  margin-bottom: 3rem;
}
.about-metric-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  padding: 1.25rem 1rem;
  background: #FAFAFC;
  border: 1px solid #F3F4F6;
  border-radius: 12px;
}
.about-metric-val {
  font-size: clamp(2.25rem, 3.5vw, 3rem);
  font-weight: 700;
  color: #030712;
  line-height: 1;
  letter-spacing: -0.03em;
}

/* =========================================================================
   MOBILE ONLY OVERRIDES (Max-Width 768px) - Keeps Desktop Perfectly Intact
   ========================================================================= */
@media (max-width: 768px) {
  .about-container {
    padding: 0 1.25rem;
  }
  .about-hero-section {
    padding: 2.75rem 0 3rem;
  }
  .about-section {
    padding: 2.75rem 0;
  }
  .about-section-header {
    margin-bottom: 1.75rem;
  }
  .about-section-title {
    font-size: clamp(1.45rem, 5vw, 1.85rem);
    margin-bottom: 0.5rem;
  }
  .about-section-desc {
    font-size: 13px;
    line-height: 1.6;
  }

  /* Philosophy Cards stack to 1 col */
  .about-philosophy-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .about-philosophy-card {
    padding: 1.35rem;
    min-height: auto;
  }

  /* What We Do Cards stack to 1 col */
  .about-whatwedo-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .about-whatwedo-card {
    padding: 1.35rem;
    min-height: auto;
  }

  /* Creed Code stack to 1 col */
  .creed-code-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .creed-code-card {
    padding: 1.35rem;
  }

  /* Global Hubs stack to 1 col */
  .about-hubs-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .about-hub-img {
    height: 9.5rem;
  }

  /* Leadership Cards stack vertically on mobile (Image on top, full width text below) */
  .about-leader-grid {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }
  .about-leader-card {
    flex-direction: column;
    padding: 1.25rem;
    gap: 1rem;
  }
  .about-leader-img-box {
    width: 100%;
    height: 200px;
    border-radius: 0.75rem;
  }

  /* Metrics become a clean 2x2 grid */
  .about-metrics-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.75rem;
  }
  .about-metric-card {
    padding: 0.85rem 0.65rem;
  }
  .about-metric-val {
    font-size: 1.85rem;
  }
}
</style>

<div class="about-page">
  
  <!-- 1. HERO: EMOTIONAL & BRAND-DRIVEN COMPANY STORY (LIGHT PLATINUM THEME) -->
  <section class="about-hero-section">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 0%, rgba(0, 82, 255, 0.08) 0%, transparent 60%), radial-gradient(circle at 85% 60%, rgba(255, 107, 0, 0.06) 0%, transparent 50%);"></div>
    <div style="position:absolute;inset:0;opacity:0.4;pointer-events:none;background-image:linear-gradient(to right, rgba(0, 82, 255, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(0, 82, 255, 0.05) 1px, transparent 1px);background-size:48px 48px;"></div>

    <div class="about-container" style="position:relative;z-index:10;text-align:center;display:flex;flex-direction:column;align-items:center;gap:1.25rem;">
      
      <div style="display:inline-flex;align-items:center;gap:6px;padding:4px 14px;background:#fff;border:1px solid rgba(209,213,219,0.8);color:#0052FF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
        <span style="width:6px;height:6px;background:#FF6B00;border-radius:50%;display:inline-block;"></span>
        <span>OUR STORY • OUR PHILOSOPHY • OUR CRAFT</span>
      </div>

      <h1 style="font-size:clamp(1.75rem,3.5vw,3rem);font-weight:700;letter-spacing:-0.03em;color:#030712;line-height:1.2;margin:0;max-width:56rem;">
        We are architects, builders, and custodians of <br />
        <span style="color:#0052FF;">critical digital infrastructure.</span>
      </h1>

      <p style="font-size:clamp(0.9rem,1.5vw,1.05rem);color:#4B5563;line-height:1.7;font-weight:400;margin:0;max-width:44rem;">
        Founded on the belief that software should be engineered like bridges and skyscrapers—with mathematical precision, enduring resilience, and an obsessive focus on human utility.
      </p>

      <div style="padding-top:0.75rem;display:flex;align-items:center;justify-content:center;gap:1rem;flex-wrap:wrap;">
        <a href="contact" class="btn-blue" style="height:44px;padding:0 24px;font-size:14px;">Start a Conversation</a>
        <a href="#philosophy" style="padding:10px 22px;background:#fff;color:#1F2937;font-weight:700;font-size:13px;text-decoration:none;border-radius:4px;border:1px solid #D1D5DB;box-shadow:0 1px 2px rgba(0,0,0,0.05);transition:background 0.2s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='#fff'">Explore Our Journey &darr;</a>
      </div>

    </div>
  </section>

  <!-- 2. PARTNERS MARQUEE: 100% UNBREAKABLE CONTINUOUS SEAMLESS SCROLL -->
  <section 
    class="w-full py-6 border-t border-b border-[#D6E4FF] overflow-hidden relative select-none"
    style="background-color: #F4F8FF;"
  >
    <div class="relative w-full overflow-hidden flex items-center">
      <!-- Gradient Edge Fade Masks -->
      <div class="absolute left-0 top-0 bottom-0 w-24 z-10 pointer-events-none" style="background: linear-gradient(to right, #F4F8FF, transparent);"></div>
      <div class="absolute right-0 top-0 bottom-0 w-24 z-10 pointer-events-none" style="background: linear-gradient(to left, #F4F8FF, transparent);"></div>

      <!-- Infinite 4-Set Continuous Marquee Track -->
      <div class="partner-marquee-track items-center gap-14 sm:gap-20 px-6">
        
        <!-- Set 1 -->
        <div class="flex items-center gap-14 sm:gap-20 shrink-0">
          <a href="https://clutch.co" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/clutch.webp" alt="Clutch" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
          </a>
          <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
          </a>
          <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
          </a>
          <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/shopify.webp" alt="Shopify" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='shopify-ar21.svg'">
          </a>
          <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/trustpilot.webp" alt="Trustpilot" class="h-9 w-auto object-contain" width="130" height="36" loading="lazy" decoding="async" onerror="this.src='trustpilot-seeklogo.png'">
          </a>
        </div>

        <!-- Set 2 -->
        <div class="flex items-center gap-14 sm:gap-20 shrink-0">
          <a href="https://clutch.co" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/clutch.webp" alt="Clutch" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
          </a>
          <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
          </a>
          <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
          </a>
          <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/shopify.webp" alt="Shopify" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='shopify-ar21.svg'">
          </a>
          <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/trustpilot.webp" alt="Trustpilot" class="h-9 w-auto object-contain" width="130" height="36" loading="lazy" decoding="async" onerror="this.src='trustpilot-seeklogo.png'">
          </a>
        </div>

        <!-- Set 3 -->
        <div class="flex items-center gap-14 sm:gap-20 shrink-0">
          <a href="https://clutch.co" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/clutch.webp" alt="Clutch" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
          </a>
          <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
          </a>
          <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
          </a>
          <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/shopify.webp" alt="Shopify" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='shopify-ar21.svg'">
          </a>
          <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/trustpilot.webp" alt="Trustpilot" class="h-9 w-auto object-contain" width="130" height="36" loading="lazy" decoding="async" onerror="this.src='trustpilot-seeklogo.png'">
          </a>
        </div>

        <!-- Set 4 -->
        <div class="flex items-center gap-14 sm:gap-20 shrink-0">
          <a href="https://clutch.co" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/clutch.webp" alt="Clutch" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
          </a>
          <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
          </a>
          <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
          </a>
          <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/shopify.webp" alt="Shopify" class="h-9 w-auto object-contain" width="120" height="36" loading="lazy" decoding="async" onerror="this.src='shopify-ar21.svg'">
          </a>
          <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
            <img src="partners/trustpilot.webp" alt="Trustpilot" class="h-9 w-auto object-contain" width="130" height="36" loading="lazy" decoding="async" onerror="this.src='trustpilot-seeklogo.png'">
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- 3. OUR PHILOSOPHY & 6 CORE PRINCIPLES -->
  <section id="philosophy" class="about-section" style="background:#FAFAFC;">
    <div class="about-container">
      
      <div class="about-section-header">
        <span style="font-size:11.5px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">CORE VALUES &amp; DIRECTION</span>
        <h2 class="about-section-title">
          Our Philosophy
        </h2>
        <p class="about-section-desc">
          Our vision is to be at the forefront of technological innovation, enabling businesses worldwide to harness the power of digital transformation for sustainable growth and success. Established in 2023 with a mission to eliminate technical debt and bridge deep computer science with real-world enterprise velocity.
        </p>
      </div>

      <!-- 6 Core Cards Grid (3 Columns Desktop, 1 Column Mobile) -->
      <div class="about-philosophy-grid">
        
        <!-- Card 1: Progress -->
        <div class="about-philosophy-card" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,0,0,0.08)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3rem;height:3rem;border-radius:0.6rem;background:#FFF7ED;color:#FF6B00;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;">
              📊
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">Progress</h3>
            <p style="font-size:13.5px;color:#374151;line-height:1.65;margin:0;font-weight:400;">
              Our driving force is our clients' success, fostering enduring business relationships built on trust, collaboration, and mutual growth. We measure achievements by measurable scale and uptime resilience.
            </p>
          </div>
          <div style="padding-top:1rem;margin-top:1.25rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;font-size:12px;font-weight:700;color:#0052FF;">
            <span>Continuous Innovation</span>
          </div>
        </div>

        <!-- Card 2: Focused -->
        <div class="about-philosophy-card" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,0,0,0.08)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3rem;height:3rem;border-radius:0.6rem;background:#FFF7ED;color:#FF6B00;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;">
              🎯
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">Focused</h3>
            <p style="font-size:13.5px;color:#374151;line-height:1.65;margin:0;font-weight:400;">
              We prioritize discipline and focus, excelling in what we do best and transparently communicating if a task falls outside our specialized engineering domain. Zero diluted efforts.
            </p>
          </div>
          <div style="padding-top:1rem;margin-top:1.25rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;font-size:12px;font-weight:700;color:#0052FF;">
            <span>Uncompromising Discipline</span>
          </div>
        </div>

        <!-- Card 3: Flexible -->
        <div class="about-philosophy-card" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,0,0,0.08)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3rem;height:3rem;border-radius:0.6rem;background:#FFF7ED;color:#FF6B00;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;">
              ⚡
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">Flexible</h3>
            <p style="font-size:13.5px;color:#374151;line-height:1.65;margin:0;font-weight:400;">
              Embracing a client-centric ethos, we deliver exceptional quality without compromise, tailoring engineering pods and architectures to your unique organizational constraints.
            </p>
          </div>
          <div style="padding-top:1rem;margin-top:1.25rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;font-size:12px;font-weight:700;color:#0052FF;">
            <span>Adaptive Engineering</span>
          </div>
        </div>

        <!-- Card 4: User Experience -->
        <div class="about-philosophy-card" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,0,0,0.08)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3rem;height:3rem;border-radius:0.6rem;background:#FFF7ED;color:#FF6B00;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;">
              ✨
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">User Experience</h3>
            <p style="font-size:13.5px;color:#374151;line-height:1.65;margin:0;font-weight:400;">
              We prioritize human-centric user experience, ensuring intuitive interfaces, sub-second response latencies, and seamless interactions to drive organic product adoption.
            </p>
          </div>
          <div style="padding-top:1rem;margin-top:1.25rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;font-size:12px;font-weight:700;color:#0052FF;">
            <span>Human-Centric Design</span>
          </div>
        </div>

        <!-- Card 5: Partner -->
        <div class="about-philosophy-card" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,0,0,0.08)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3rem;height:3rem;border-radius:0.6rem;background:#FFF7ED;color:#FF6B00;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;">
              🤝
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">Partner</h3>
            <p style="font-size:13.5px;color:#374151;line-height:1.65;margin:0;font-weight:400;">
              We view every client as a long-term strategic partner, dedicated to evolving together in a continuous journey of technical maturity, resilience, and market success.
            </p>
          </div>
          <div style="padding-top:1rem;margin-top:1.25rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;font-size:12px;font-weight:700;color:#0052FF;">
            <span>Long-Term Alignment</span>
          </div>
        </div>

        <!-- Card 6: Inventiveness -->
        <div class="about-philosophy-card" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,0,0,0.08)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3rem;height:3rem;border-radius:0.6rem;background:#FFF7ED;color:#FF6B00;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;">
              🚀
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">Inventiveness</h3>
            <p style="font-size:13.5px;color:#374151;line-height:1.65;margin:0;font-weight:400;">
              In a rapidly evolving digital world, we stay ahead of the curve with futuristic development, pioneering autonomous AI pipelines and modern distributed architectures.
            </p>
          </div>
          <div style="padding-top:1rem;margin-top:1.25rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;font-size:12px;font-weight:700;color:#0052FF;">
            <span>Futuristic R&amp;D</span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 4. WHAT WE DO? (3 SOPHISTICATED CARDS) -->
  <section class="about-section" style="background:#fff;">
    <div class="about-container">
      
      <div class="about-section-header" style="max-width:40rem;">
        <div style="display:inline-flex;align-items:center;gap:6px;padding:3px 12px;background:#EFF6FF;border:1px solid #BFDBFE;color:#0052FF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:0.75rem;">
          <span style="width:5px;height:5px;background:#0052FF;display:inline-block;border-radius:50%;"></span>
          SERVICES &amp; EXPERTISE
        </div>

        <h2 class="about-section-title">
          What We Do?
        </h2>

        <p class="about-section-desc">
          We help businesses turn technology into their biggest competitive advantage
        </p>
      </div>

      <!-- 3 Cards -->
      <div class="about-whatwedo-grid">
        
        <!-- Card 1: Software Development -->
        <div class="about-whatwedo-card" style="background:#F6F8FC;border:1px solid #DBEAFE;" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,82,255,0.1)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3.25rem;height:3.25rem;border-radius:0.6rem;background:#0052FF;color:#fff;display:flex;align-items:center;justify-content:center;font-size:1.25rem;font-weight:700;font-family:monospace;margin-bottom:1.25rem;box-shadow:0 4px 10px rgba(0,82,255,0.3);">
              &lt;/&gt;
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">Software Development</h3>
            <p style="font-size:13.5px;color:#4B5563;line-height:1.65;margin:0 0 1.25rem;">
              Scalable, high-performance web, cloud, and enterprise software solutions tailored to accelerate your business goals.
            </p>
          </div>
          <div>
            <a href="services" style="display:inline-flex;align-items:center;gap:6px;padding:9px 18px;background:#030712;color:#fff;font-weight:700;font-size:12px;text-decoration:none;border-radius:3px;box-shadow:0 1px 2px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#0052FF'" onmouseout="this.style.background='#030712'">
              <span>Build with Us</span>
            </a>
          </div>
        </div>

        <!-- Card 2: AI Solutions -->
        <div class="about-whatwedo-card" style="background:#FCF8F4;border:1px solid #FFEDD5;" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(255,107,0,0.12)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3.25rem;height:3.25rem;border-radius:0.6rem;background:#FF6B00;color:#fff;display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;box-shadow:0 4px 10px rgba(255,107,0,0.3);">
              <svg style="width:1.5rem;height:1.5rem;color:#fff;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" />
                <circle cx="12" cy="12" r="3.5" />
              </svg>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">AI Solutions</h3>
            <p style="font-size:13.5px;color:#4B5563;line-height:1.65;margin:0 0 1.25rem;">
              Smarter decision-making, predictive machine learning, and autonomous AI-driven automation built for enterprise workflows.
            </p>
          </div>
          <div>
            <a href="services" style="display:inline-flex;align-items:center;gap:6px;padding:9px 18px;background:#030712;color:#fff;font-weight:700;font-size:12px;text-decoration:none;border-radius:3px;box-shadow:0 1px 2px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#FF6B00'" onmouseout="this.style.background='#030712'">
              <span>Build with Us</span>
            </a>
          </div>
        </div>

        <!-- Card 3: Digital Growth -->
        <div class="about-whatwedo-card" style="background:#F4F9F7;border:1px solid #D1FAE5;" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(5,150,105,0.12)';this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)';this.style.transform='none'">
          <div>
            <div style="width:3.25rem;height:3.25rem;border-radius:0.6rem;background:#059669;color:#fff;display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem;box-shadow:0 4px 10px rgba(5,150,105,0.3);">
              <svg style="width:1.5rem;height:1.5rem;color:#fff;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" />
                <polyline points="17 6 23 6 23 12" />
              </svg>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.6rem;letter-spacing:-0.02em;">Digital Growth</h3>
            <p style="font-size:13.5px;color:#4B5563;line-height:1.65;margin:0 0 1.25rem;">
              Data-driven SEO strategies, conversion rate optimization, and multi-channel brand scaling that maximize your digital ROI.
            </p>
          </div>
          <div>
            <a href="services" style="display:inline-flex;align-items:center;gap:6px;padding:9px 18px;background:#030712;color:#fff;font-weight:700;font-size:12px;text-decoration:none;border-radius:3px;box-shadow:0 1px 2px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#030712'">
              <span>Grow with Us</span>
            </a>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 5. THE CREED CODE: OUR 4 CORE ENGINEERING PRINCIPLES -->
  <section class="about-section" style="background:#F4F6FA;">
    <div class="about-container">
      
      <div class="about-section-header">
        <span style="font-size:11.5px;font-weight:700;color:#FF6B00;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">THE CREED CODE</span>
        <h2 class="about-section-title">
          Our 4 Pillars of Uncompromising Engineering
        </h2>
        <p class="about-section-desc">
          The fundamental principles that govern every technical decision, sprint review, and architectural deployment at Creed Tech.
        </p>
      </div>

      <div class="creed-code-grid">
        
        <!-- Pillar 01 -->
        <div class="creed-code-card">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.75rem;border-bottom:1px solid #F3F4F6;">
              <span style="font-size:1.5rem;font-weight:700;font-family:monospace;color:#0052FF;">01</span>
              <span style="padding:3px 10px;background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:700;border-radius:3px;">Pillar of Excellence</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 4px;">Architectural Integrity Over Shortcuts</h3>
            <p style="font-size:12px;font-weight:700;color:#FF6B00;margin:0 0 0.6rem;">We build for decades, not for quick demos.</p>
            <p style="font-size:13.5px;color:#4B5563;line-height:1.65;margin:0 0 1rem;">
              Software is the central nervous system of modern business. We reject fragile hacks, unnecessary dependencies, and opaque abstractions. Every line of code is structured to withstand massive scale.
            </p>
          </div>
          <div style="padding-top:0.75rem;border-top:1px solid #F3F4F6;">
            <span style="font-size:12px;font-weight:600;color:#1F2937;display:flex;align-items:center;gap:6px;">
              <span style="color:#10B981;font-weight:700;">✓</span>
              <span>Clean, deterministic, and self-documenting codebases.</span>
            </span>
          </div>
        </div>

        <!-- Pillar 02 -->
        <div class="creed-code-card">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.75rem;border-bottom:1px solid #F3F4F6;">
              <span style="font-size:1.5rem;font-weight:700;font-family:monospace;color:#0052FF;">02</span>
              <span style="padding:3px 10px;background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:700;border-radius:3px;">Pillar of Excellence</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 4px;">Direct Architect-to-Client Pairing</h3>
            <p style="font-size:12px;font-weight:700;color:#FF6B00;margin:0 0 0.6rem;">No layers of non-technical middlemen.</p>
            <p style="font-size:13.5px;color:#4B5563;line-height:1.65;margin:0 0 1rem;">
              When you collaborate with Creed Tech, your product roadmap is shaped directly by senior principal engineers who have built high-scale systems. We eliminate translation friction from day one.
            </p>
          </div>
          <div style="padding-top:0.75rem;border-top:1px solid #F3F4F6;">
            <span style="font-size:12px;font-weight:600;color:#1F2937;display:flex;align-items:center;gap:6px;">
              <span style="color:#10B981;font-weight:700;">✓</span>
              <span>100% principal engineer involvement from kickoff to launch.</span>
            </span>
          </div>
        </div>

        <!-- Pillar 03 -->
        <div class="creed-code-card">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.75rem;border-bottom:1px solid #F3F4F6;">
              <span style="font-size:1.5rem;font-weight:700;font-family:monospace;color:#0052FF;">03</span>
              <span style="padding:3px 10px;background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:700;border-radius:3px;">Pillar of Excellence</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 4px;">Zero-Trust &amp; Sovereign Privacy</h3>
            <p style="font-size:12px;font-weight:700;color:#FF6B00;margin:0 0 0.6rem;">Security is non-negotiable; it is our foundation.</p>
            <p style="font-size:13.5px;color:#4B5563;line-height:1.65;margin:0 0 1rem;">
              In an era of relentless cyber threats and sensitive AI models, we treat data sovereignty as a fundamental duty. We embed zero-knowledge cryptography and immutable audit trails into every platform.
            </p>
          </div>
          <div style="padding-top:0.75rem;border-top:1px solid #F3F4F6;">
            <span style="font-size:12px;font-weight:600;color:#1F2937;display:flex;align-items:center;gap:6px;">
              <span style="color:#10B981;font-weight:700;">✓</span>
              <span>Cryptographic data protection built into core architectures.</span>
            </span>
          </div>
        </div>

        <!-- Pillar 04 -->
        <div class="creed-code-card">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.75rem;border-bottom:1px solid #F3F4F6;">
              <span style="font-size:1.5rem;font-weight:700;font-family:monospace;color:#0052FF;">04</span>
              <span style="padding:3px 10px;background:#EFF6FF;color:#0052FF;font-size:11px;font-weight:700;border-radius:3px;">Pillar of Excellence</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 4px;">Empathetic Craftsmanship</h3>
            <p style="font-size:12px;font-weight:700;color:#FF6B00;margin:0 0 0.6rem;">Engineering with a deep respect for the end user.</p>
            <p style="font-size:13.5px;color:#4B5563;line-height:1.65;margin:0 0 1rem;">
              Brilliant engineering means nothing if the interface creates friction. We unite deep backend computer science with intuitive human-centric product design, creating platforms that people love.
            </p>
          </div>
          <div style="padding-top:0.75rem;border-top:1px solid #F3F4F6;">
            <span style="font-size:12px;font-weight:600;color:#1F2937;display:flex;align-items:center;gap:6px;">
              <span style="color:#10B981;font-weight:700;">✓</span>
              <span>Intuitive micro-interactions powered by resilient backend logic.</span>
            </span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 6. GLOBAL ENGINEERING HUBS -->
  <section class="about-section" style="background:#fff;">
    <div class="about-container">
      
      <div class="about-section-header">
        <span style="font-size:11.5px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;"><?= htmlspecialchars($hubsSection['badge'] ?? 'GLOBAL REACH & CONTINUOUS COVERAGE') ?></span>
        <h2 class="about-section-title">
          <?= htmlspecialchars($hubsSection['title'] ?? 'Three Specialized Global Engineering Centers') ?>
        </h2>
        <p class="about-section-desc">
          <?= htmlspecialchars($hubsSection['description'] ?? 'Operating across multiple time zones to deliver seamless 24/7 technical continuity and deep regional domain expertise.') ?>
        </p>
      </div>

      <div class="about-hubs-grid">
        <?php foreach (($hubsSection['hubs'] ?? []) as $hub): ?>
        <div class="about-hub-card">
          <div>
            <div class="about-hub-img">
              <img src="<?= htmlspecialchars($hub['image'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars($hub['city'] ?? '') ?>" width="380" height="200" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='assets/img/hero_img.webp'">
              <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), transparent);pointer-events:none;"></div>
              <div style="position:absolute;bottom:0.75rem;left:1rem;color:#fff;">
                <span style="font-size:1.1rem;font-weight:700;display:block;line-height:1.1;"><?= htmlspecialchars($hub['city'] ?? '') ?></span>
                <span style="font-size:12px;color:#D1D5DB;font-weight:500;"><?= htmlspecialchars($hub['country'] ?? '') ?></span>
              </div>
            </div>
            <div style="padding:1.25rem 1.25rem 0.75rem;display:flex;flex-direction:column;gap:6px;">
              <span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;">Core Specialization:</span>
              <p style="font-size:13px;color:#1F2937;font-weight:700;margin:0;line-height:1.4;"><?= htmlspecialchars($hub['specialization'] ?? '') ?></p>
              <?php if (!empty($hub['address'])): ?>
              <p style="font-size:11.5px;color:#6B7280;margin:4px 0 0;padding-top:6px;border-top:1px solid #F3F4F6;"><?= htmlspecialchars($hub['address']) ?></p>
              <?php endif; ?>
            </div>
          </div>
          <div style="padding:0 1.25rem 1.25rem;">
            <span style="font-size:11.5px;font-weight:700;color:#059669;display:flex;align-items:center;gap:6px;">
              <span style="width:6px;height:6px;background:#10B981;border-radius:50%;display:inline-block;"></span>
              <?= htmlspecialchars($hub['status'] ?? 'Active Regional Engineering Pod') ?>
            </span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- 7. EXECUTIVE LEADERSHIP & TECHNICAL CUSTODIANS -->
  <section class="about-section" style="background:#FAFAFC;">
    <div class="about-container">
      
      <div class="about-section-header">
        <div style="display:inline-flex;align-items:center;gap:5px;padding:3px 12px;background:#FFF7ED;border:1px solid #FFEDD5;color:#FF6B00;font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:0.75rem;">
          <span style="width:5px;height:5px;background:#FF6B00;display:inline-block;border-radius:50%;"></span>
          <?= htmlspecialchars($leadershipSection['badge'] ?? 'THE PEOPLE BEHIND THE CODE') ?>
        </div>
        <h2 class="about-section-title">
          <?= htmlspecialchars($leadershipSection['title'] ?? 'Executive Leadership & Technical Custodians') ?>
        </h2>
        <p class="about-section-desc">
          <?= htmlspecialchars($leadershipSection['description'] ?? 'Meet the founders and principal architects who guide our engineering vision and mentor our senior pods across 3 global centers.') ?>
        </p>
      </div>

      <!-- 2x2 Grid (Desktop Side-by-Side Landscape, Mobile Vertical Stack) -->
      <div class="about-leader-grid">
        <?php foreach (($leadershipSection['leaders'] ?? []) as $leader): ?>
        <div class="about-leader-card" onmouseover="this.style.boxShadow='0 12px 24px -4px rgba(0,0,0,0.08)'" onmouseout="this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)'">
          <div class="about-leader-img-box">
            <img src="<?= htmlspecialchars($leader['image'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars($leader['name'] ?? '') ?>" width="200" height="200" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='assets/img/hero_img.webp'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), transparent);pointer-events:none;"></div>
            <?php if (!empty($leader['badge'])): ?>
            <div style="position:absolute;bottom:8px;left:8px;right:8px;color:#fff;font-size:10px;font-family:monospace;font-weight:600;">
              <?= htmlspecialchars($leader['badge']) ?>
            </div>
            <?php endif; ?>
          </div>
          <div style="flex:1;display:flex;flex-direction:column;justify-content:space-between;gap:8px;min-width:0;">
            <div>
              <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0;line-height:1.2;"><?= htmlspecialchars($leader['name'] ?? '') ?></h3>
              <span style="font-size:12px;font-weight:700;color:#0052FF;display:block;margin-top:2px;"><?= htmlspecialchars($leader['role'] ?? '') ?></span>
              <?php if (!empty($leader['bio'])): ?>
              <p style="font-size:12.5px;color:#4B5563;line-height:1.6;margin:8px 0;">
                <?= htmlspecialchars($leader['bio']) ?>
              </p>
              <?php endif; ?>
              <?php if (!empty($leader['quote'])): ?>
              <blockquote style="margin:0;padding:8px 10px;background:#F9FAFB;border-radius:6px;border:1px solid #F3F4F6;font-size:11.5px;color:#374151;font-style:italic;line-height:1.5;">
                &ldquo;<?= htmlspecialchars($leader['quote']) ?>&rdquo;
              </blockquote>
              <?php endif; ?>
            </div>
            <?php if (!empty($leader['link_text'])): ?>
            <div style="padding-top:8px;border-top:1px solid #F3F4F6;">
              <a href="<?= htmlspecialchars($leader['link_url'] ?? 'contact') ?>" style="font-size:12px;font-weight:700;color:#0052FF;text-decoration:none;"><?= htmlspecialchars($leader['link_text']) ?></a>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

      </div>

    </div>
  </section>

  <!-- 8. DATA DRIVEN: LEADING YOU TO DIGITAL GROWTH (4 METRICS + 2 CTAs) -->
  <section class="about-section" style="background:#fff;border-top:1px solid #F3F4F6;">
    <div class="about-container" style="max-width:68rem;">
      
      <div style="display:inline-flex;align-items:center;padding:4px 14px;background:#EBF3FF;color:#0066FF;font-size:11.5px;font-weight:700;border-radius:2px;margin-bottom:0.75rem;">
        Data Driven
      </div>

      <h2 class="about-section-title">
        Leading You to Digital Growth
      </h2>

      <p class="about-section-desc" style="max-width:38rem;margin-bottom:2.5rem;">
        Our proven expertise and cutting-edge technology have driven measurable success—see the numbers that showcase our impact.
      </p>

      <!-- 4 Metrics Items (Desktop 4 Columns, Mobile 2x2 Grid) -->
      <div class="about-metrics-grid">
        
        <!-- Stat 1 -->
        <div class="about-metric-card">
          <div style="width:2.5rem;height:2.5rem;background:#FDF2F8;color:#F472B6;display:flex;align-items:center;justify-content:center;font-size:1.2rem;border-radius:6px;">
            ⭐
          </div>
          <span class="about-metric-val">99%</span>
          <span style="font-size:13px;font-weight:600;color:#4B5563;">Job Success Rate</span>
        </div>

        <!-- Stat 2 -->
        <div class="about-metric-card">
          <div style="width:2.5rem;height:2.5rem;background:#FDF2F8;color:#F472B6;display:flex;align-items:center;justify-content:center;font-size:1.2rem;border-radius:6px;">
            ⏱
          </div>
          <span class="about-metric-val">15000+</span>
          <span style="font-size:13px;font-weight:600;color:#4B5563;">Working Hours</span>
        </div>

        <!-- Stat 3 -->
        <div class="about-metric-card">
          <div style="width:2.5rem;height:2.5rem;background:#FFFBEB;color:#F59E0B;display:flex;align-items:center;justify-content:center;font-size:1.2rem;border-radius:6px;">
            👍
          </div>
          <span class="about-metric-val">300+</span>
          <span style="font-size:13px;font-weight:600;color:#4B5563;">Satisfied Clients</span>
        </div>

        <!-- Stat 4 -->
        <div class="about-metric-card">
          <div style="width:2.5rem;height:2.5rem;background:#ECFDF5;color:#10B981;display:flex;align-items:center;justify-content:center;font-size:1.2rem;border-radius:6px;">
            👥
          </div>
          <span class="about-metric-val">80+</span>
          <span style="font-size:13px;font-weight:600;color:#4B5563;">Professional Team</span>
        </div>

      </div>

      <!-- 2 CTA Buttons -->
      <div style="display:flex;align-items:center;justify-content:center;gap:1rem;flex-wrap:wrap;">
        <a href="contact" style="display:inline-flex;align-items:center;gap:6px;padding:12px 24px;background:#030712;color:#fff;font-weight:700;font-size:13px;text-decoration:none;border-radius:3px;box-shadow:0 2px 4px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#1F2937'" onmouseout="this.style.background='#030712'">
          <span>Get Free Consultation</span>
        </a>
        <a href="contact" style="display:inline-flex;align-items:center;gap:6px;padding:12px 24px;background:#fff;color:#0066FF;font-weight:700;font-size:13px;text-decoration:none;border-radius:3px;border:1px solid #0066FF;box-shadow:0 1px 2px rgba(0,0,0,0.05);transition:background 0.2s;" onmouseover="this.style.background='#EFF6FF'" onmouseout="this.style.background='#fff'">
          <span>Hire Top Talent</span>
        </a>
      </div>

    </div>
  </section>

  <!-- 9. READY TO TRANSFORM YOUR BUSINESS? BLUE CTA BANNER -->
  <section style="width:100%;background:#0066FF;padding:4.5rem 0;color:#fff;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;pointer-events:none;opacity:0.2;background-image:radial-gradient(circle at 50% 50%, white 1px, transparent 1px);background-size:24px 24px;"></div>
    
    <div class="about-container" style="max-width:68rem;position:relative;z-index:10;display:flex;flex-direction:row;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1.5rem;text-align:left;">
      <div>
        <h3 style="font-size:clamp(1.5rem,2.8vw,2.25rem);font-weight:700;color:#fff;letter-spacing:-0.02em;margin:0;line-height:1.25;">
          Ready to Transform Your Business? Let's Talk!
        </h3>
      </div>
      <div>
        <a href="contact" style="display:inline-flex;align-items:center;gap:6px;padding:12px 26px;background:#fff;color:#030712;font-weight:700;font-size:13px;text-decoration:none;border-radius:4px;box-shadow:0 10px 20px -5px rgba(0,0,0,0.25);transition:background 0.2s;flex-shrink:0;" onmouseover="this.style.background='#F3F4F6'" onmouseout="this.style.background='#fff'">
          <span>Schedule a Call</span>
        </a>
      </div>
    </div>
  </section>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>