<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/csrf.php';

$page_title = "CREED TECH | Enterprise IT Intelligence & Custom Software Engineering";
$page_description = "Enterprise IT solutions, custom software engineering, AI workflow orchestration, cloud modernization, and real-time intelligence for high-growth enterprises.";
$active_page = "home";
$og_image_width = 849;
$og_image_height = 384;
$extra_head_tags = '<link rel="preload" as="image" href="hero-services-web-q90.webp" type="image/webp" fetchpriority="high">';

include __DIR__ . '/includes/header.php';
?>

<!-- 1. HERO SECTION (src/components/home/hero-section) -->
<section class="w-full bg-white pt-3 pb-3 lg:pt-5 lg:pb-5 m-0 border-b border-gray-100 overflow-hidden">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16">
    
    <!-- LEFT — Text & CTA -->
    <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left shrink-0">
      <h1 class="font-normal text-4xl sm:text-5xl text-[#1A1A1A] tracking-tight leading-[1.15]">
        Your infrastructure supercharged
      </h1>

      <p class="text-base sm:text-lg text-[#3E3E3E] leading-[1.75] mt-4 max-w-lg font-normal">
        Creed Tech delivers enterprise software architecture, robust cloud infrastructure, advanced cybersecurity, and AI solutions all in one platform.
      </p>

      <div class="mt-7 w-full flex justify-center lg:justify-start">
        <a href="services" class="btn-blue">
          Explore Solutions
        </a>
      </div>
    </div>

    <!-- RIGHT — Hero Graphic Stack -->
    <div class="w-full lg:w-[48%] flex justify-end">
      <div class="relative w-full max-w-[620px] flex items-center justify-center">
        <img 
          src="hero-services-web-q90.webp" 
          alt="Creed Tech Cloud, AI, and Software Architecture Solutions" 
          class="w-full h-auto object-contain block transition-transform duration-700 hover:scale-105 select-none"
          onerror="this.src='hero-3d-white.png'"
          width="620"
          height="520"
          decoding="async"
          fetchpriority="high"
        />
      </div>
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
          <img src="partners/clutch.webp" alt="Clutch" class="h-7 w-auto object-contain" width="105" height="28" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.webp" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.webp" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
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
          <img src="partners/clutch.webp" alt="Clutch" class="h-7 w-auto object-contain" width="105" height="28" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.webp" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.webp" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
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
          <img src="partners/clutch.webp" alt="Clutch" class="h-7 w-auto object-contain" width="105" height="28" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.webp" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.webp" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
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
          <img src="partners/clutch.webp" alt="Clutch" class="h-7 w-auto object-contain" width="105" height="28" loading="lazy" decoding="async" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.webp" alt="Google" class="h-9 w-auto object-contain" width="110" height="36" loading="lazy" decoding="async" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.webp" alt="The Manifest" class="h-11 w-auto object-contain" width="130" height="44" loading="lazy" decoding="async" onerror="this.src='The-Manifest-Logo.svg'">
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

<!-- 3. SERVICES SECTION: WHAT WE PROVIDE (PREMIUM ENTERPRISE UPGRADE) -->
<section class="w-full bg-[#F8FAFC] pt-6 pb-10 lg:pt-8 lg:pb-14 border-b border-gray-200 relative overflow-hidden" id="what-we-provide-section">
  
  <!-- Subtle Ambient Background Accents for Depth -->
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full blur-3xl pointer-events-none -mr-20 -mt-20"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-50/40 rounded-full blur-3xl pointer-events-none -ml-20 -mb-20"></div>

  <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col items-center relative z-10">
    
    <!-- Section Heading & Subtitle -->
    <div class="flex flex-col items-center text-center mb-7 max-w-3xl">
      <h2 class="text-3xl sm:text-4xl lg:text-[2.6rem] font-medium tracking-tight text-[#0F172A] leading-tight">
        What We Provide
      </h2>
      <p class="text-sm sm:text-base text-[#475569] mt-3 font-normal leading-relaxed max-w-2xl">
        Eight specialized engineering domains tailored for mission-critical enterprise scale, cloud modernization, and high availability.
      </p>
    </div>

    <!-- 2 Columns × 4 Rows Desktop Grid -->
    <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-6">
      
      <!-- Card 1: Software Development -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6" />
            <polyline points="8 6 2 12 8 18" />
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            Software Development
          </h3>
          <p class="prov-desc">
            Custom web and mobile applications engineered for reliability, built with modern maintainable architecture.
          </p>
          <a href="services#software-development" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

      <!-- Card 2: UI/UX Design -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/>
            <path d="M2 12h20"/>
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            UI/UX Design
          </h3>
          <p class="prov-desc">
            Interfaces designed around real user workflows, not just visual polish. Streamlined, accessible, and high-converting.
          </p>
          <a href="services#ui-ux" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

      <!-- Card 3: Mobile Applications -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="5" y="2" width="14" height="20" rx="2" ry="2" />
            <line x1="12" y1="18" x2="12.01" y2="18" />
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            Mobile Applications
          </h3>
          <p class="prov-desc">
            High-performance iOS and Android applications crafted for native speed and intuitive mobile gestures.
          </p>
          <a href="services#mobile-applications" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

      <!-- Card 4: Cloud Infrastructure -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z" />
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            Cloud Infrastructure
          </h3>
          <p class="prov-desc">
            Provisioning, CI/CD automated deployment, and hardening for infrastructure that scales with traffic.
          </p>
          <a href="services#cloud-infrastructure" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

      <!-- Card 5: Database Management -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <ellipse cx="12" cy="5" rx="9" ry="3" />
            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3" />
            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" />
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            Database Management
          </h3>
          <p class="prov-desc">
            Schema design, migrations, and ongoing management for high-concurrency relational and NoSQL databases.
          </p>
          <a href="services#database-management" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

      <!-- Card 6: Cybersecurity & QA -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10" />
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            Cybersecurity & QA
          </h3>
          <p class="prov-desc">
            Security audits, automated test suites, and compliance checks to keep your systems protected.
          </p>
          <a href="services#cybersecurity" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

      <!-- Card 7: Artificial Intelligence (AI) -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2a4 4 0 0 0-4 4v1H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2V6a4 4 0 0 0-4-4z"/>
            <circle cx="9" cy="13" r="1"/>
            <circle cx="15" cy="13" r="1"/>
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            Artificial Intelligence (AI)
          </h3>
          <p class="prov-desc">
            Private on-premise LLM fine-tuning, dense vector embeddings, and autonomous AI agent orchestration.
          </p>
          <a href="services#ai" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

      <!-- Card 8: Digital Marketing & Branding -->
      <div class="prov-card group">
        <div class="prov-accent"></div>
        <div class="prov-icon-wrap">
          <svg class="w-5 h-5 text-[#0052FF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 3v18h18"/>
            <path d="m19 9-5 5-4-4-3 3"/>
          </svg>
        </div>
        <div class="prov-content">
          <h3 class="prov-title">
            Digital Marketing & Branding
          </h3>
          <p class="prov-desc">
            Strategic tech product positioning, high-conversion CRO landing pages, and enterprise search visibility.
          </p>
          <a href="services#marketing" class="prov-link">
            <span>Learn more</span>
            <span class="prov-arrow">&rarr;</span>
          </a>
        </div>
      </div>

    </div>

  </div>

  <style>
    /* ================= WHAT WE PROVIDE: SCOPED PREMIUM CARD STYLES ================= */
    .prov-card {
      position: relative;
      display: flex;
      align-items: flex-start;
      gap: 1.15rem;
      background-color: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      padding: 1.75rem 1.6rem;
      box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03), 0 2px 6px rgba(15, 23, 42, 0.02);
      transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.22s ease, border-color 0.22s ease;
      overflow: hidden;
      box-sizing: border-box;
      height: 100%;
    }
    .prov-card:hover {
      transform: translateY(-3px);
      border-color: #CBD5E1;
      box-shadow: 0 10px 24px -4px rgba(15, 23, 42, 0.06), 0 4px 8px -2px rgba(15, 23, 42, 0.03);
    }
    /* Subtle Brand Accent indicator at the top of the card */
    .prov-accent {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2.5px;
      background: linear-gradient(90deg, #0052FF 0%, #38BDF8 60%, #FF6B00 100%);
      opacity: 0;
      transition: opacity 0.22s ease;
    }
    .prov-card:hover .prov-accent {
      opacity: 1;
    }
    /* Icon geometric container with subtle 3D depth - NEVER solid on hover */
    .prov-icon-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      flex-shrink: 0;
      border-radius: 10px;
      background-color: #F0F5FF;
      border: 1px solid #D6E4FF;
      box-shadow: 0 2px 5px rgba(0, 82, 255, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.9);
      transition: border-color 0.22s ease, box-shadow 0.22s ease;
    }
    .prov-card:hover .prov-icon-wrap {
      border-color: #BFDBFE;
      box-shadow: 0 3px 8px rgba(0, 82, 255, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.9);
    }
    /* Content Layout */
    .prov-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    .prov-title {
      font-size: 1.05rem;
      font-weight: 500;
      color: #0F172A;
      line-height: 1.35;
      margin: 0 0 0.45rem;
      letter-spacing: -0.01em;
    }
    .prov-desc {
      font-size: 0.845rem;
      line-height: 1.62;
      color: #475569;
      margin: 0 0 0.85rem;
      font-weight: 400;
    }
    .prov-link {
      margin-top: auto;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: 0.78rem;
      font-weight: 600;
      color: #0052FF;
      text-decoration: none;
      letter-spacing: 0.01em;
      width: fit-content;
    }
    .prov-arrow {
      display: inline-block;
      transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .prov-card:hover .prov-arrow {
      transform: translateX(3px);
    }
    @media (prefers-reduced-motion: reduce) {
      .prov-card, .prov-icon-wrap, .prov-arrow, .prov-accent {
        transition: none !important;
        transform: none !important;
      }
    }
  </style>
</section>

<!-- 4. HOW WE DELIVER SECTION (src/components/home/how-we-deliver) -->
<section 
  class="w-full pt-8 pb-8 lg:pt-[32px] lg:pb-[30px] text-white relative overflow-hidden border-b border-gray-800"
  style="background-color: #0B1120;"
  id="how-we-deliver-section"
>
  <!-- Ambient Orange Glow (matching Contact CTA section) -->
  <div 
    class="absolute inset-0 pointer-events-none"
    style="background: radial-gradient(circle at 50% 20%, rgba(255, 107, 0, 0.17) 0%, rgba(255, 107, 0, 0.05) 45%, rgba(11, 17, 32, 0) 70%);"
  ></div>

  <!-- Ultra-Light Subtle Grid Background for Premium Look -->
  <div 
    class="absolute inset-0 opacity-[0.035] pointer-events-none"
    style="background-image: linear-gradient(to right, #FFFFFF 1px, transparent 1px), linear-gradient(to bottom, #FFFFFF 1px, transparent 1px); background-size: 36px 36px;"
  ></div>

  <div class="relative max-w-6xl mx-auto px-6 lg:px-12 flex flex-col items-center z-10">
    
    <!-- Section Header -->
    <div class="flex flex-col items-center text-center mb-10 max-w-3xl">
      <a href="about" class="inline-flex items-center gap-2 px-3 py-1 rounded-[4px] bg-orange-500/10 border border-orange-500/20 text-[#FF6B00] text-[11px] font-medium uppercase tracking-widest mb-3 cursor-pointer hover:bg-orange-500/20 hover:border-orange-500/40 transition-colors duration-150">
        <span class="w-1.5 h-1.5 rounded-full bg-[#FF6B00]"></span>
        ENGINEERING METHODOLOGY
      </a>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-medium tracking-tight text-white uppercase text-center mb-3">
        HOW WE DELIVER
      </h2>
      <p class="text-xs sm:text-sm text-gray-400 max-w-xl text-center font-normal leading-relaxed">
        A transparent, four-phase delivery methodology designed to eliminate surprises and keep projects on track.
      </p>
    </div>

    <!-- 4-Phase Workflow Navigation -->
    <div class="w-full max-w-4xl mx-auto mb-8">
      <div class="grid grid-cols-4 gap-3 sm:gap-4">
        
        <button class="phase-item how-tab-btn btn-tab-active" data-target="del-req" type="button">
          <span class="phase-circle"></span>
          <span class="phase-label">Team Requirement</span>
        </button>

        <button class="phase-item how-tab-btn btn-tab-inactive" data-target="del-onboard" type="button">
          <span class="phase-circle"></span>
          <span class="phase-label">Onboarding</span>
        </button>

        <button class="phase-item how-tab-btn btn-tab-inactive" data-target="del-prod" type="button">
          <span class="phase-circle"></span>
          <span class="phase-label">Productivity Phase</span>
        </button>

        <button class="phase-item how-tab-btn btn-tab-inactive" data-target="del-qc" type="button">
          <span class="phase-circle"></span>
          <span class="phase-label">Quality Control</span>
        </button>

      </div>
    </div>

    <!-- Active Tab Box (Engineered Dark Navy Card with Internal Grid matching Contact card) -->
    <div class="del-main-panel w-full relative bg-[#131C31]/90 border border-[#1E293B] rounded-2xl px-6 py-5 sm:px-8 sm:py-7 lg:px-10 lg:py-8 flex flex-col justify-center overflow-hidden shadow-2xl">
      
      <!-- Minimal Technical Corner Brackets (Top-Left ┌ and Bottom-Right ┘) -->
      <div class="corner-bracket-tl pointer-events-none" aria-hidden="true"></div>
      <div class="corner-bracket-br pointer-events-none" aria-hidden="true"></div>

      <!-- Internal Technical Grid (matching Contact section card) -->
      <div 
        class="absolute inset-0 opacity-[0.05] pointer-events-none"
        style="background-image: linear-gradient(to right, #FFFFFF 1px, transparent 1px), linear-gradient(to bottom, #FFFFFF 1px, transparent 1px); background-size: 24px 24px;"
      ></div>
      <div class="absolute w-64 h-64 bg-orange-500/15 rounded-none blur-3xl pointer-events-none top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>

      <!-- Phase 1 Content -->
      <div id="del-req" class="del-pane relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7 flex flex-col items-start text-left">
            <div class="phase-badge-pill">
              <span class="badge-dot"></span>
              <span class="badge-text">PHASE 01</span>
            </div>
            <h3 class="text-xl sm:text-2xl lg:text-3xl font-medium text-white tracking-tight mb-3">
              Team Requirement
            </h3>
            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
              Define your technical stack, domain scope, and seniority expectations. We match verified senior software engineers tailored precisely to your architecture.
            </p>
          </div>
          <div class="lg:col-span-5 w-full flex flex-col justify-center divide-y divide-gray-800/80">
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">01</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Define technical stack &amp; domain scope</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">02</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Evaluate seniority expectations</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">03</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Match verified senior software engineers</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Phase 2 Content -->
      <div id="del-onboard" class="del-pane hidden relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7 flex flex-col items-start text-left">
            <div class="phase-badge-pill">
              <span class="badge-dot"></span>
              <span class="badge-text">PHASE 02</span>
            </div>
            <h3 class="text-xl sm:text-2xl lg:text-3xl font-medium text-white tracking-tight mb-3">
              Rapid Onboarding &amp; Setup
            </h3>
            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
              Sprint kickoff, repo provisioning, secure access integration, and architectural alignment within 48 hours without friction.
            </p>
          </div>
          <div class="lg:col-span-5 w-full flex flex-col justify-center divide-y divide-gray-800/80">
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">01</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Sprint kickoff &amp; repo provisioning</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">02</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Secure access integration</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">03</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Architectural alignment within 48 hours</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Phase 3 Content -->
      <div id="del-prod" class="del-pane hidden relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7 flex flex-col items-start text-left">
            <div class="phase-badge-pill">
              <span class="badge-dot"></span>
              <span class="badge-text">PHASE 03</span>
            </div>
            <h3 class="text-xl sm:text-2xl lg:text-3xl font-medium text-white tracking-tight mb-3">
              Full Velocity Execution
            </h3>
            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
              Daily async syncs, sprint milestone tracking, clean PR reviews, and automated CI/CD deployment pipelines operating at enterprise velocity.
            </p>
          </div>
          <div class="lg:col-span-5 w-full flex flex-col justify-center divide-y divide-gray-800/80">
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">01</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Daily async syncs &amp; milestone tracking</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">02</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Clean PR code reviews</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">03</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Automated CI/CD deployment pipelines</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Phase 4 Content -->
      <div id="del-qc" class="del-pane hidden relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7 flex flex-col items-start text-left">
            <div class="phase-badge-pill">
              <span class="badge-dot"></span>
              <span class="badge-text">PHASE 04</span>
            </div>
            <h3 class="text-xl sm:text-2xl lg:text-3xl font-medium text-white tracking-tight mb-3">
              Continuous Quality Control
            </h3>
            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
              End-to-end automated testing, security audits, performance profiling, and milestone sign-offs ensuring production-grade stability.
            </p>
          </div>
          <div class="lg:col-span-5 w-full flex flex-col justify-center divide-y divide-gray-800/80">
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">01</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">End-to-end automated testing</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">02</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Security audits &amp; performance profiling</span>
            </div>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center gap-3.5">
              <span class="text-xs font-mono font-medium text-[#FF6B00] tracking-wider">03</span>
              <span class="text-xs sm:text-sm text-gray-200 font-normal">Production-grade milestone sign-offs</span>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <style>
    /* ================= HOW WE DELIVER: SCOPED DESKTOP REDESIGN STYLES ================= */
    #how-we-deliver-section .phase-item {
      display: flex !important;
      flex-direction: column !important;
      align-items: center !important;
      justify-content: center !important;
      text-align: center !important;
      width: 100% !important;
      background: transparent !important;
      background-color: transparent !important;
      border: none !important;
      border-radius: 0 !important;
      padding: 0 !important;
      margin: 0 !important;
      box-shadow: none !important;
      outline: none !important;
      cursor: pointer !important;
      box-sizing: border-box !important;
      appearance: none !important;
      -webkit-appearance: none !important;
    }
    #how-we-deliver-section .phase-circle {
      display: block !important;
      width: 12px !important;
      height: 12px !important;
      min-width: 12px !important;
      min-height: 12px !important;
      border-radius: 50% !important;
      margin: 0 auto 12px auto !important;
      flex-shrink: 0 !important;
      box-sizing: border-box !important;
      position: static !important;
      transform: none !important;
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    #how-we-deliver-section .phase-label {
      display: block !important;
      width: 100% !important;
      text-align: center !important;
      margin: 0 auto !important;
      padding: 0 !important;
      font-size: 13.5px !important;
      line-height: 1.3 !important;
      white-space: nowrap !important;
      transition: color 0.25s ease, font-weight 0.25s ease !important;
    }
    /* Active Phase State */
    #how-we-deliver-section .btn-tab-active .phase-circle {
      background-color: #FF6B00 !important;
      border: 1.5px solid #FFA04D !important;
      box-shadow: 0 0 10px rgba(255, 107, 0, 0.8), 0 0 20px rgba(255, 107, 0, 0.4) !important;
      transform: scale(1.15) !important;
    }
    #how-we-deliver-section .btn-tab-active .phase-label {
      color: #FFFFFF !important;
      font-weight: 700 !important;
    }
    /* Inactive Phase State */
    #how-we-deliver-section .btn-tab-inactive .phase-circle {
      background-color: #0E1526 !important;
      border: 1.5px solid #3B4861 !important;
      box-shadow: none !important;
    }
    #how-we-deliver-section .btn-tab-inactive .phase-label {
      color: #94A3B8 !important;
      font-weight: 500 !important;
    }
    #how-we-deliver-section .btn-tab-inactive:hover .phase-circle {
      border-color: #64748B !important;
      background-color: #1E293B !important;
    }
    #how-we-deliver-section .btn-tab-inactive:hover .phase-label {
      color: #E2E8F0 !important;
    }
    /* Main Content Card */
    #how-we-deliver-section .del-main-panel {
      background-color: rgba(14, 21, 38, 0.95) !important;
      border: 1px solid rgba(255, 107, 0, 0.28) !important;
      border-radius: 16px !important;
      box-shadow: 0 20px 50px -15px rgba(0, 0, 0, 0.7), 0 0 35px -12px rgba(255, 107, 0, 0.14) !important;
    }
    /* Phase Badge Pill */
    #how-we-deliver-section .phase-badge-pill {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 7px !important;
      padding: 0 10px 0 8px !important;
      height: 24px !important;
      min-height: 24px !important;
      border-radius: 6px !important;
      background-color: rgba(255, 107, 0, 0.1) !important;
      border: 1px solid rgba(255, 107, 0, 0.3) !important;
      color: #FF6B00 !important;
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important;
      font-size: 11px !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.06em !important;
      line-height: 1 !important;
      margin: 0 0 12px 0 !important;
      box-sizing: border-box !important;
      position: static !important;
      transform: none !important;
    }
    #how-we-deliver-section .phase-badge-pill .badge-dot {
      display: inline-block !important;
      width: 6px !important;
      height: 6px !important;
      min-width: 6px !important;
      min-height: 6px !important;
      border-radius: 50% !important;
      background-color: #FF6B00 !important;
      flex-shrink: 0 !important;
      margin: 0 !important;
      padding: 0 !important;
      position: static !important;
      transform: translateY(-0.5px) !important;
      box-sizing: border-box !important;
    }
    #how-we-deliver-section .phase-badge-pill .badge-text {
      display: inline-block !important;
      line-height: 1 !important;
      margin: 0 !important;
      padding: 0 !important;
      position: static !important;
      transform: none !important;
    }
    /* Technical Corner Brackets (Top-Left ┌ and Bottom-Right ┘) */
    #how-we-deliver-section .corner-bracket-tl {
      position: absolute;
      top: 12px;
      left: 12px;
      width: 14px;
      height: 14px;
      border-top: 1.5px solid rgba(255, 107, 0, 0.65);
      border-left: 1.5px solid rgba(255, 107, 0, 0.65);
      border-top-left-radius: 3px;
      z-index: 5;
    }
    #how-we-deliver-section .corner-bracket-br {
      position: absolute;
      bottom: 12px;
      right: 12px;
      width: 14px;
      height: 14px;
      border-bottom: 1.5px solid rgba(255, 107, 0, 0.65);
      border-right: 1.5px solid rgba(255, 107, 0, 0.65);
      border-bottom-right-radius: 3px;
      z-index: 5;
    }
    #how-we-deliver-section .del-pane {
      animation: delPaneFade 0.22s ease-out;
    }
    @keyframes delPaneFade {
      from { opacity: 0; transform: translateY(4px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (prefers-reduced-motion: reduce) {
      #how-we-deliver-section .del-pane {
        animation: none !important;
      }
    }
  </style>
</section>

<!-- 5. WHY CHOOSE US SECTION (src/components/home/why-choose-us) -->
<section class="w-full bg-white border-b border-gray-100" style="height: auto; min-height: 0; padding-top: 28px; padding-bottom: 28px;">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16" style="height: auto; min-height: 0;">
    
    <!-- Left Column -->
    <div class="w-full lg:w-[44%] flex flex-col items-start text-left">
      <span class="text-xs font-medium text-orange-600 uppercase tracking-widest mb-3">
        WHY CREED TECH
      </span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-medium text-gray-900 tracking-tight leading-tight mb-5">
        <span class="block">Focused teams</span>
        <span class="block text-[#0052FF] mt-2.5 sm:mt-3">Reliable delivery</span>
      </h2>
      <p class="text-sm sm:text-base text-gray-600 leading-relaxed mb-8 max-w-md font-normal">
        What does this mean for you? You gain enterprise-grade engineering with the responsiveness of a dedicated team.
      </p>
      <a href="contact" class="btn-blue">
        Talk to Us
      </a>
    </div>

    <!-- Right Column (2x2 Card Grid) -->
    <div class="w-full lg:w-[52%] grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
      
      <!-- Card 1: Risk Free -->
      <div class="bg-white border border-gray-200/90 rounded-2xl p-6 sm:p-7 flex flex-col justify-between shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200 h-full">
        <div>
          <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-[#0052FF] mb-5 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              <path d="m9 12 2 2 4-4"/>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Risk Free</h3>
          <p class="text-sm text-gray-600 leading-relaxed font-normal">
            Structured delivery with clear milestones reduces project risk from day one.
          </p>
        </div>
      </div>

      <!-- Card 2: Cost -->
      <div class="bg-white border border-gray-200/90 rounded-2xl p-6 sm:p-7 flex flex-col justify-between shadow-sm hover:shadow-md hover:border-orange-200 transition-all duration-200 h-full">
        <div>
          <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center text-[#FF6B00] mb-5 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="12" y1="1" x2="12" y2="23"/>
              <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Cost</h3>
          <p class="text-sm text-gray-600 leading-relaxed font-normal">
            Transparent pricing with no hidden fees, scoped to your actual needs.
          </p>
        </div>
      </div>

      <!-- Card 3: Flexibility -->
      <div class="bg-white border border-gray-200/90 rounded-2xl p-6 sm:p-7 flex flex-col justify-between shadow-sm hover:shadow-md hover:border-orange-200 transition-all duration-200 h-full">
        <div>
          <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center text-[#FF6B00] mb-5 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="4" y1="21" x2="4" y2="14"/>
              <line x1="4" y1="10" x2="4" y2="3"/>
              <line x1="12" y1="21" x2="12" y2="12"/>
              <line x1="12" y1="8" x2="12" y2="3"/>
              <line x1="20" y1="21" x2="20" y2="16"/>
              <line x1="20" y1="12" x2="20" y2="3"/>
              <line x1="1" y1="14" x2="7" y2="14"/>
              <line x1="9" y1="8" x2="15" y2="8"/>
              <line x1="17" y1="16" x2="23" y2="16"/>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Flexibility</h3>
          <p class="text-sm text-gray-600 leading-relaxed font-normal">
            Engagement models that adapt as your priorities and roadmap change.
          </p>
        </div>
      </div>

      <!-- Card 4: Dedicated Delivery -->
      <div class="bg-white border border-gray-200/90 rounded-2xl p-6 sm:p-7 flex flex-col justify-between shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200 h-full">
        <div>
          <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-[#0052FF] mb-5 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Dedicated Delivery</h3>
          <p class="text-sm text-gray-600 leading-relaxed font-normal">
            A consistent, dedicated team — not a rotating pool of contractors.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- 6. TRACK RECORD SECTION (src/components/home/track-record) -->
<section class="w-full bg-[#0B1120] pt-8 sm:pt-9 lg:pt-10 pb-6 sm:pb-7 lg:pb-7 text-white relative overflow-hidden border-b border-[#1E293B]/60">
  <div 
    class="absolute inset-0 pointer-events-none"
    style="background: radial-gradient(ellipse at 50% 40%, rgba(255, 107, 0, 0.12) 0%, rgba(255, 107, 0, 0.03) 45%, rgba(11, 17, 32, 0) 75%);"
  ></div>
  <div 
    class="absolute inset-0 opacity-[0.04] pointer-events-none"
    style="background-image: linear-gradient(45deg, #ffffff 1px, transparent 1px), linear-gradient(-45deg, #ffffff 1px, transparent 1px); background-size: 40px 40px;"
  ></div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-12 z-10 text-left flex flex-col items-start">
    
    <!-- Top Label -->
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-none border border-[#1E293B] bg-[#131C31] text-gray-300 text-xs font-mono font-semibold tracking-widest uppercase mb-5">
      <span class="w-1.5 h-1.5 rounded-none bg-[#FF6B00]"></span>
      TRACK RECORD
    </div>

    <!-- Editorial Heading -->
    <h2 class="text-3xl sm:text-4xl lg:text-[44px] font-serif text-white tracking-tight leading-[1.2] mb-12 sm:mb-14 text-left">
      A decade of <span class="italic text-[#FF6B00] font-serif font-normal">quiet</span> <span class="font-serif">excellence</span>
    </h2>

    <!-- Single Horizontal Row of 4 Statistics on Desktop with Hairline Divider Lines -->
    <div class="w-full grid grid-cols-2 lg:grid-cols-4 border-t border-[#1E293B]">
      
      <!-- Stat 1: Years of Experience -->
      <div class="min-h-[200px] sm:min-h-[215px] flex flex-col justify-between items-start text-left py-7 sm:py-8 pr-6 lg:pr-8 border-b sm:border-b-0 border-r border-[#1E293B]">
        <div>
          <div class="flex items-baseline mb-3">
            <span class="text-5xl sm:text-6xl font-serif font-normal text-white tracking-tight">10</span>
            <span class="text-2xl sm:text-3xl text-[#C99A4D] font-serif font-light ml-1">+</span>
          </div>
          <span class="text-xs sm:text-sm font-mono tracking-widest text-gray-400 uppercase font-medium block leading-snug">
            YEARS OF<br class="hidden sm:inline" /> EXPERIENCE
          </span>
        </div>
        <div class="w-[110px] h-[1px] mt-8 pointer-events-none select-none" style="background: linear-gradient(90deg, rgba(205, 160, 85, 0.95) 0%, rgba(205, 160, 85, 0.5) 45%, rgba(205, 160, 85, 0.1) 80%, transparent 100%);"></div>
      </div>

      <!-- Stat 2: Projects Delivered -->
      <div class="min-h-[200px] sm:min-h-[215px] flex flex-col justify-between items-start text-left py-7 sm:py-8 pl-6 sm:pl-8 lg:px-8 border-b sm:border-b-0 lg:border-r border-[#1E293B]">
        <div>
          <div class="flex items-baseline mb-3">
            <span class="text-5xl sm:text-6xl font-serif font-normal text-white tracking-tight">50</span>
            <span class="text-2xl sm:text-3xl text-[#C99A4D] font-serif font-light ml-1">+</span>
          </div>
          <span class="text-xs sm:text-sm font-mono tracking-widest text-gray-400 uppercase font-medium block leading-snug">
            PROJECTS<br class="hidden sm:inline" /> DELIVERED
          </span>
        </div>
        <div class="w-[110px] h-[1px] mt-8 pointer-events-none select-none" style="background: linear-gradient(90deg, rgba(205, 160, 85, 0.95) 0%, rgba(205, 160, 85, 0.5) 45%, rgba(205, 160, 85, 0.1) 80%, transparent 100%);"></div>
      </div>

      <!-- Stat 3: Core Services -->
      <div class="min-h-[200px] sm:min-h-[215px] flex flex-col justify-between items-start text-left py-7 sm:py-8 pr-6 lg:px-8 border-r border-[#1E293B]">
        <div>
          <div class="flex items-baseline mb-3">
            <span class="text-5xl sm:text-6xl font-serif font-normal text-white tracking-tight">8</span>
            <span class="text-2xl sm:text-3xl text-[#C99A4D] font-serif font-light ml-1">+</span>
          </div>
          <span class="text-xs sm:text-sm font-mono tracking-widest text-gray-400 uppercase font-medium block leading-snug">
            CORE<br class="hidden sm:inline" /> SERVICES
          </span>
        </div>
        <div class="w-[110px] h-[1px] mt-8 pointer-events-none select-none" style="background: linear-gradient(90deg, rgba(205, 160, 85, 0.95) 0%, rgba(205, 160, 85, 0.5) 45%, rgba(205, 160, 85, 0.1) 80%, transparent 100%);"></div>
      </div>

      <!-- Stat 4: Dedicated Engineering -->
      <div class="min-h-[200px] sm:min-h-[215px] flex flex-col justify-between items-start text-left py-7 sm:py-8 pl-6 sm:pl-8 lg:pl-8">
        <div>
          <div class="flex items-baseline mb-3">
            <span class="text-5xl sm:text-6xl font-serif font-normal text-white tracking-tight">100</span>
            <span class="text-2xl sm:text-3xl text-[#C99A4D] font-serif font-light ml-1">%</span>
          </div>
          <span class="text-xs sm:text-sm font-mono tracking-widest text-gray-400 uppercase font-medium block leading-snug">
            DEDICATED<br class="hidden sm:inline" /> ENGINEERING
          </span>
        </div>
        <div class="w-[110px] h-[1px] mt-8 pointer-events-none select-none" style="background: linear-gradient(90deg, rgba(205, 160, 85, 0.95) 0%, rgba(205, 160, 85, 0.5) 45%, rgba(205, 160, 85, 0.1) 80%, transparent 100%);"></div>
      </div>

    </div>
  </div>
</section>

<!-- 7. CLIENT FEEDBACK SECTION: DUAL CONTINUOUS VERTICAL SCROLL (Left DOWN, Right UP) -->
<section id="homeReviewsSection" class="w-full py-6 sm:py-8 lg:py-8 bg-[#FCFDFF] text-gray-900 border-b border-gray-100 overflow-hidden relative">
  <div class="max-w-7xl mx-auto px-6 lg:px-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
      
      <!-- LEFT COLUMN -->
      <div class="lg:col-span-5 text-left space-y-6">
        <div>
          <span class="text-xs sm:text-[13px] font-medium text-[#E67E22] uppercase tracking-wider block mb-2">
            Enterprise Client Feedback
          </span>
          <h2 class="text-3xl sm:text-4xl lg:text-[44px] font-medium text-gray-950 tracking-tight leading-tight">
            <span class="block">What Our Clients Say</span>
            <span class="block mt-2.5 sm:mt-3">About Creed Tech</span>
          </h2>
        </div>

        <div class="space-y-3.5 pt-2">
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-normal text-gray-800 leading-snug">Dedicated Principal Engineers on Every Project.</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-normal text-gray-800 leading-snug">The Ability to Scale Engineering Pods in Real Time.</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-normal text-gray-800 leading-snug">99.8% On-Time Deployment & Strict SLA Controls.</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-normal text-gray-800 leading-snug">Zero-Defect Code Audits & SOC 2 Compliance.</span>
          </div>
        </div>

        <div class="pt-4 space-y-4">
          <div class="flex flex-col sm:flex-row items-center gap-3.5 w-full sm:w-auto">
            <a href="contact" class="btn-orange w-full sm:w-[225px] justify-center text-center">
              Schedule Consultation
            </a>
            <button type="button" onclick="openHomeReviewModal()" class="btn-dark cursor-pointer w-full sm:w-[225px] justify-center text-center">
              <span class="text-[#FFAA00]">★</span>
              <span>Write a Client Review</span>
            </button>
          </div>

          <div>
            <a
              href="portfolio"
              class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-900 hover:text-[#E67E22] border-b-2 border-gray-900 hover:border-[#E67E22] pb-0.5 transition-colors"
            >
              View Client Portfolio &rarr;
            </a>
          </div>
        </div>

        <p class="text-[11px] text-gray-400 font-normal pt-2">
          Verified Enterprise Customer Reviews on Clutch & Trustpilot.
        </p>
      </div>

      <!-- RIGHT COLUMN: 2 DUAL-DIRECTION VERTICAL SCROLLING COLUMNS (Left moves DOWN, Right moves UP) -->
      <div class="lg:col-span-7 relative h-[480px] sm:h-[520px] overflow-hidden rounded-2xl p-2 select-none">
        
        <!-- Top & Bottom Gradient Edge Fade Masks -->
        <div class="absolute top-0 left-0 right-0 h-16 bg-gradient-to-b from-[#FCFDFF] via-[#FCFDFF]/80 to-transparent z-20 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-[#FCFDFF] via-[#FCFDFF]/80 to-transparent z-20 pointer-events-none"></div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 h-full">
          
          <!-- LEFT COLUMN: MOVES DOWN CONTINUOUSLY (reviews-col-down) -->
          <div class="relative overflow-hidden h-full">
            <div class="reviews-col-down">
              
              <!-- Card 1 -->
              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;I'm using Creed Tech for our enterprise cloud architecture. It allowed us to deploy multi-region failover seamlessly with zero downtime.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    MR
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">Marina R.</h4>
                    <p class="text-[11px] text-gray-500 font-normal">Italy • Enterprise Cloud</p>
                  </div>
                </div>
              </div>

              <!-- Card 2 -->
              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;Exceptional full-stack capabilities and attention to detail. They built our AI-driven document intelligence pipeline directly with our ERP.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    ER
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">Elena Rostova</h4>
                    <p class="text-[11px] text-gray-500 font-normal">Germany • AI Automation</p>
                  </div>
                </div>
              </div>

              <!-- Duplicate Clones for 100% Seamless Infinite Down Loop -->
              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;I'm using Creed Tech for our enterprise cloud architecture. It allowed us to deploy multi-region failover seamlessly with zero downtime.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    MR
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">Marina R.</h4>
                    <p class="text-[11px] text-gray-500 font-normal">Italy • Enterprise Cloud</p>
                  </div>
                </div>
              </div>

              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;Exceptional full-stack capabilities and attention to detail. They built our AI-driven document intelligence pipeline directly with our ERP.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    ER
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">Elena Rostova</h4>
                    <p class="text-[11px] text-gray-500 font-normal">Germany • AI Automation</p>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- RIGHT COLUMN: MOVES UP CONTINUOUSLY (reviews-col-up) -->
          <div class="relative overflow-hidden h-full">
            <div class="reviews-col-up">
              
              <!-- Card 3 -->
              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;We had a complex legacy database problem and the engineering support was world-class. Solved our bottleneck within days.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    DL
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">David L.</h4>
                    <p class="text-[11px] text-gray-500 font-normal">United States • Database Arch</p>
                  </div>
                </div>
              </div>

              <!-- Card 4 -->
              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;It's been 4 years now that we rely on Creed Tech for dedicated staff augmentation and infrastructure. Top quality code.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    SJ
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">Sarah Jenkins</h4>
                    <p class="text-[11px] text-gray-500 font-normal">United Kingdom • Enterprise Squads</p>
                  </div>
                </div>
              </div>

              <!-- Duplicate Clones for 100% Seamless Infinite Up Loop -->
              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;We had a complex legacy database problem and the engineering support was world-class. Solved our bottleneck within days.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    DL
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">David L.</h4>
                    <p class="text-[11px] text-gray-500 font-normal">United States • Database Arch</p>
                  </div>
                </div>
              </div>

              <div class="bg-white rounded-2xl border border-blue-100/70 p-5 shadow-xs hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F7FAFE]">
                <div class="flex items-center gap-1 text-[#FFAA00] text-xs sm:text-sm mb-2.5">★★★★★</div>
                <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-normal mb-3.5">
                  &ldquo;It's been 4 years now that we rely on Creed Tech for dedicated staff augmentation and infrastructure. Top quality code.&rdquo;
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-medium text-xs">
                    SJ
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">Sarah Jenkins</h4>
                    <p class="text-[11px] text-gray-500 font-normal">United Kingdom • Enterprise Squads</p>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</section>

<!-- ================= 8. TRUST & SECURITY SECTION ================= -->
<section class="w-full bg-white py-14 sm:py-16 lg:py-20 border-b border-gray-100 relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

      <!-- LEFT VISUAL: Exact 3D Security Illustration Card -->
      <div class="lg:col-span-6 w-full flex items-center justify-center">
        <div class="relative w-full max-w-[480px] rounded-[28px] overflow-hidden bg-white shadow-[0_15px_40px_-10px_rgba(0,82,255,0.08)] border border-[#E2E8F0]/90 group hover:shadow-[0_20px_50px_-10px_rgba(0,82,255,0.14)] transition-all duration-300">
          <img 
            src="assets/img/trust-security-3d-test.webp" 
            alt="Secure Engineering - 99.99% Reliability SLA" 
            class="w-full h-auto object-contain block select-none"
            loading="lazy"
            decoding="async"
            width="480"
            height="500"
          />
        </div>
      </div>

      <!-- RIGHT CONTENT: Badge, Heading, Description, Stats & CTA -->
      <div class="lg:col-span-6 flex flex-col items-start text-left">
        
        <!-- Pre-title Pill / Tag -->
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-[4px] bg-[#EBF3FF] text-[#0052FF] text-xs font-medium tracking-wider uppercase mb-5">
          <span class="w-2 h-2 rounded-full bg-[#0052FF]"></span>
          <span>TRUST & SECURITY</span>
        </div>

        <!-- Main Headline -->
        <h2 class="text-[21px] sm:text-4xl lg:text-[42px] font-medium text-[#0F172A] tracking-tight leading-tight mb-5">
          <span class="block">Enterprise engineering built on</span>
          <span class="block mt-2.5 sm:mt-3">security reliability and trust</span>
        </h2>

        <!-- Description -->
        <p class="text-sm sm:text-[15px] text-[#475569] leading-relaxed mb-8 max-w-lg font-normal">
          We combine deep technical expertise with industry-leading security practices to deliver reliable, scalable, and future-ready solutions for your business.
        </p>

        <!-- Stats Grid -->
        <div class="flex items-center gap-10 sm:gap-14 mb-8">
          
          <!-- Stat 1: 10+ Years Experience -->
          <div class="flex flex-col">
            <div class="flex items-baseline mb-1">
              <span class="text-4xl sm:text-5xl font-medium text-[#0F172A] tracking-tight">10</span>
              <span class="text-3xl sm:text-4xl font-medium text-[#0052FF] ml-0.5">+</span>
            </div>
            <span class="text-xs sm:text-[13px] font-medium text-[#64748B] uppercase tracking-wider">
              YEARS EXPERIENCE
            </span>
          </div>

          <!-- Vertical Divider -->
          <div class="w-[1.5px] h-12 bg-gray-200"></div>

          <!-- Stat 2: 99.99% Reliability SLA -->
          <div class="flex flex-col">
            <div class="flex items-baseline mb-1">
              <span class="text-4xl sm:text-5xl font-medium text-[#0F172A] tracking-tight">99.99</span>
              <span class="text-2xl sm:text-3xl font-medium text-[#0052FF] ml-0.5">%</span>
            </div>
            <span class="text-xs sm:text-[13px] font-medium text-[#64748B] uppercase tracking-wider">
              RELIABILITY SLA
            </span>
          </div>

        </div>

        <!-- CTA Button -->
        <div>
          <a 
            href="security" 
            class="inline-flex items-center justify-center gap-2.5 px-6 py-3 rounded-[4px] bg-[#0052FF] hover:bg-[#0042D0] text-white text-sm font-semibold transition-colors duration-150 group"
          >
            <span>Security & Trust</span>
            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
          </a>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- 9. KNOWLEDGE CENTER SECTION (src/components/home/knowledge-center) -->
<?php
// Dynamic Knowledge Center Cards Image Resolver with Host-Agnostic Fast Cache & Invalidation
if (!function_exists('creed_get_kc_card_images')) {
    function creed_get_kc_card_images() {
        $cacheFile = __DIR__ . '/data/kc_images_cache.json';
        $liveNewsJsonPath = __DIR__ . '/data/live_news_cache.json';
        $articlesJsonPath = __DIR__ . '/data/articles.json';
        $maxTtl = 60; // Strict 60-second max TTL for MySQL-derived updates

        $newsMtime = file_exists($liveNewsJsonPath) ? (@filemtime($liveNewsJsonPath) ?: 0) : 0;
        $articlesMtime = file_exists($articlesJsonPath) ? (@filemtime($articlesJsonPath) ?: 0) : 0;
        $now = time();

        // 1. Try reading from cache
        if (file_exists($cacheFile)) {
            $rawCache = @file_get_contents($cacheFile);
            if ($rawCache) {
                $cache = @json_decode($rawCache, true);
                if (
                    is_array($cache) &&
                    !empty($cache['images']) &&
                    isset($cache['created_at']) &&
                    ($now - (int)$cache['created_at']) <= $maxTtl &&
                    isset($cache['source_mtimes']) &&
                    ($cache['source_mtimes']['live_news_cache'] ?? null) === $newsMtime &&
                    ($cache['source_mtimes']['articles'] ?? null) === $articlesMtime
                ) {
                    return $cache['images'];
                }
            }
        }

        // 2. Cache Miss / Invalidation: Run existing resolution logic
        $kc_insight_image = '';
        $kc_article_image = '';
        $kc_news_image    = '';
        $kc_blog_image    = '';

        // A. Database query
        $db_conn = function_exists('creed_db') ? creed_db() : false;
        if ($db_conn) {
            $artQuery = @$db_conn->query("SELECT title, category, image_url FROM articles WHERE is_published = 1 ORDER BY id DESC LIMIT 10");
            if ($artQuery) {
                while ($row = $artQuery->fetch_assoc()) {
                    $cat = strtoupper($row['category'] ?? '');
                    $img = $row['image_url'] ?? $row['image'] ?? $row['thumbnail'] ?? $row['featured_image'] ?? '';
                    if (!empty($img)) {
                        if (empty($kc_insight_image) && (strpos($cat, 'INSIGHT') !== false || strpos($cat, 'CLOUD') !== false || strpos($cat, 'HARDWARE') !== false)) {
                            $kc_insight_image = $img;
                        } elseif (empty($kc_article_image) && (strpos($cat, 'ARTICLE') !== false || strpos($cat, 'RESEARCH') !== false || strpos($cat, 'SECURITY') !== false)) {
                            $kc_article_image = $img;
                        } elseif (empty($kc_blog_image) && (strpos($cat, 'BLOG') !== false || strpos($cat, 'QA') !== false)) {
                            $kc_blog_image = $img;
                        }
                    }
                }
            }
        }

        // B. Fetch live news image from live_news_cache.json
        if (file_exists($liveNewsJsonPath)) {
            $liveNewsData = @json_decode(file_get_contents($liveNewsJsonPath), true);
            if (!empty($liveNewsData['breaking_news'])) {
                foreach ($liveNewsData['breaking_news'] as $bn) {
                    $bnImg = $bn['img'] ?? $bn['image_url'] ?? $bn['source_image_url'] ?? '';
                    if (!empty($bnImg)) {
                        $kc_news_image = $bnImg;
                        break;
                    }
                }
            }
            if (empty($kc_news_image) && !empty($liveNewsData['regional_items'])) {
                foreach ($liveNewsData['regional_items'] as $ri) {
                    $riImg = $ri['image_url'] ?? $ri['local_image_path'] ?? $ri['source_image_url'] ?? '';
                    if (!empty($riImg)) {
                        $kc_news_image = $riImg;
                        break;
                    }
                }
            }
        }

        // C. Fallbacks from structured data/articles.json
        if (file_exists($articlesJsonPath)) {
            $articlesJsonData = @json_decode(file_get_contents($articlesJsonPath), true);
            if (is_array($articlesJsonData)) {
                foreach ($articlesJsonData as $aj) {
                    $ajImg = $aj['image_url'] ?? $aj['image'] ?? $aj['thumbnail'] ?? $aj['featured_image'] ?? '';
                    $ajCat = strtoupper($aj['category'] ?? '');
                    if (!empty($ajImg)) {
                        if (empty($kc_insight_image) && strpos($ajCat, 'INSIGHT') !== false) $kc_insight_image = $ajImg;
                        if (empty($kc_article_image) && strpos($ajCat, 'ARTICLE') !== false) $kc_article_image = $ajImg;
                        if (empty($kc_blog_image) && strpos($ajCat, 'BLOG') !== false) $kc_blog_image = $ajImg;
                    }
                }
            }
        }

        // D. Fallback images
        if (empty($kc_insight_image)) {
            $kc_insight_image = 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=600&auto=format&fit=crop';
        }
        if (empty($kc_article_image)) {
            $kc_article_image = 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=600&auto=format&fit=crop';
        }
        if (empty($kc_news_image)) {
            $kc_news_image = 'uploads/live_news/google_le-play-sweepstakes_4683461c45eb.webp';
        }
        if (empty($kc_blog_image)) {
            $kc_blog_image = 'uploads/blog.webp';
        }

        $resolvedImages = [
            'insight' => $kc_insight_image,
            'article' => $kc_article_image,
            'news'    => $kc_news_image,
            'blog'    => $kc_blog_image,
        ];

        // 3. Concurrency-Safe Atomic Write
        $cachePayload = [
            'created_at'     => $now,
            'source_mtimes'  => [
                'live_news_cache' => $newsMtime,
                'articles'        => $articlesMtime,
            ],
            'images'         => $resolvedImages,
        ];

        $dataDir = dirname($cacheFile);
        if (is_dir($dataDir) && is_writable($dataDir)) {
            $tmpFile = $cacheFile . '.' . bin2hex(random_bytes(6)) . '.tmp';
            $json = @json_encode($cachePayload, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            if ($json !== false) {
                $fp = @fopen($tmpFile, 'wb');
                if ($fp) {
                    @flock($fp, LOCK_EX);
                    @fwrite($fp, $json);
                    @fflush($fp);
                    @flock($fp, LOCK_UN);
                    @fclose($fp);
                    @rename($tmpFile, $cacheFile);
                }
            }
        }

        return $resolvedImages;
    }
}

$kc_images = creed_get_kc_card_images();
$kc_insight_image = $kc_images['insight'] ?? 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=600&auto=format&fit=crop';
$kc_article_image = $kc_images['article'] ?? 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=600&auto=format&fit=crop';
$kc_news_image    = $kc_images['news'] ?? 'uploads/live_news/google_le-play-sweepstakes_4683461c45eb.webp';
$kc_blog_image    = $kc_images['blog'] ?? 'uploads/blog.webp';
?>
<section 
  class="w-full py-12 lg:py-16 border-b border-[#E3EDFF]"
  style="background-color: #F4F8FF;"
>
  <div class="max-w-7xl mx-auto px-6 lg:px-12">
    
    <div class="flex flex-col items-center text-center mb-10">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-medium text-gray-900 tracking-tight mb-4">
        Knowledge Center
      </h2>
      <p class="text-sm sm:text-base text-gray-600 max-w-2xl font-normal">
        Discover the latest advancements, expert insights, and practical tips to elevate your software development journey.
      </p>
    </div>

    <!-- 2x2 Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 lg:gap-x-14 gap-y-6 w-full">
      
      <!-- 1. INSIGHT CARD -->
      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-medium text-blue-600 uppercase tracking-wider mb-2">
            INSIGHT
          </span>
          <h3 class="text-base sm:text-lg font-medium text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            The enterprise software checklist before you scale
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jul 2026
          </span>
        </div>
        <div class="shrink-0 w-24 sm:w-28 h-20 sm:h-22 rounded-xl sm:rounded-2xl border border-gray-100 overflow-hidden relative shadow-xs group-hover:scale-105 transition-transform duration-300 bg-gray-50 flex items-center justify-center">
          <img 
            src="<?= htmlspecialchars($kc_insight_image) ?>" 
            alt="The enterprise software checklist before you scale" 
            class="w-full h-full object-cover object-center block"
            loading="lazy"
            decoding="async"
            width="112"
            height="88"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          />
          <div class="hidden absolute inset-0 bg-gradient-to-br from-blue-50/70 to-blue-100/30 items-center justify-center">
            <div class="w-9 h-9 rounded-lg bg-white shadow-xs flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5" /><path d="M9 18h6" /><path d="M10 22h4" /></svg>
            </div>
          </div>
        </div>
      </a>

      <!-- 2. ARTICLE CARD -->
      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-medium text-blue-600 uppercase tracking-wider mb-2">
            ARTICLE
          </span>
          <h3 class="text-base sm:text-lg font-medium text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            Why database migrations fail — and how to avoid it
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jul 2026
          </span>
        </div>
        <div class="shrink-0 w-24 sm:w-28 h-20 sm:h-22 rounded-xl sm:rounded-2xl border border-gray-100 overflow-hidden relative shadow-xs group-hover:scale-105 transition-transform duration-300 bg-gray-50 flex items-center justify-center">
          <img 
            src="<?= htmlspecialchars($kc_article_image) ?>" 
            alt="Why database migrations fail — and how to avoid it" 
            class="w-full h-full object-cover object-center block"
            loading="lazy"
            decoding="async"
            width="112"
            height="88"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          />
          <div class="hidden absolute inset-0 bg-gradient-to-br from-orange-50/70 to-amber-100/30 items-center justify-center">
            <div class="w-9 h-9 rounded-lg bg-white shadow-xs flex items-center justify-center">
              <svg class="w-5 h-5 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" /><polyline points="14 2 14 8 20 8" /></svg>
            </div>
          </div>
        </div>
      </a>

      <!-- 3. NEWS CARD -->
      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-medium text-blue-600 uppercase tracking-wider mb-2">
            NEWS
          </span>
          <h3 class="text-base sm:text-lg font-medium text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            Creed Tech expands cloud infrastructure practice
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jun 2026
          </span>
        </div>
        <div class="shrink-0 w-24 sm:w-28 h-20 sm:h-22 rounded-xl sm:rounded-2xl border border-gray-100 overflow-hidden relative shadow-xs group-hover:scale-105 transition-transform duration-300 bg-gray-50 flex items-center justify-center">
          <img 
            src="<?= htmlspecialchars($kc_news_image) ?>" 
            alt="Creed Tech expands cloud infrastructure practice" 
            class="w-full h-full object-cover object-center block"
            loading="lazy"
            decoding="async"
            width="112"
            height="88"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          />
          <div class="hidden absolute inset-0 bg-gradient-to-br from-blue-50/70 to-blue-100/30 items-center justify-center">
            <div class="w-9 h-9 rounded-lg bg-white shadow-xs flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" /></svg>
            </div>
          </div>
        </div>
      </a>

      <!-- 4. BLOG CARD -->
      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-medium text-blue-600 uppercase tracking-wider mb-2">
            BLOG
          </span>
          <h3 class="text-base sm:text-lg font-medium text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            A practical guide to QA for fast-moving teams
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jun 2026
          </span>
        </div>
        <div class="shrink-0 w-24 sm:w-28 h-20 sm:h-22 rounded-xl sm:rounded-2xl border border-gray-100 overflow-hidden relative shadow-xs group-hover:scale-105 transition-transform duration-300 bg-gray-50 flex items-center justify-center">
          <img 
            src="<?= htmlspecialchars($kc_blog_image) ?>" 
            alt="A practical guide to QA for fast-moving teams" 
            class="w-full h-full object-cover object-center block"
            loading="lazy"
            decoding="async"
            width="112"
            height="88"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          />
          <div class="hidden absolute inset-0 bg-gradient-to-br from-orange-50/70 to-amber-100/30 items-center justify-center">
            <div class="w-9 h-9 rounded-lg bg-white shadow-xs flex items-center justify-center">
              <svg class="w-5 h-5 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><polygon points="5 3 19 12 5 21 5 3" /></svg>
            </div>
          </div>
        </div>
      </a>

    </div>

  </div>
</section>

<!-- ================= 10. CAREERS AT CREED TECH SECTION ================= -->
<section class="w-full bg-white py-14 sm:py-16 lg:py-20 border-b border-gray-100 relative overflow-hidden">
  
  <!-- Subtle Ambient Background Accents -->
  <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50/50 rounded-full blur-3xl pointer-events-none -mr-20 -mt-20"></div>
  <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-50/30 rounded-full blur-3xl pointer-events-none -ml-20 -mb-20"></div>

  <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">

      <!-- LEFT CONTENT: Heading, Description, Bullet Points, and CTA -->
      <div class="lg:col-span-6 flex flex-col items-start text-left">
        
        <!-- Pre-title Pill / Tag -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-[4px] bg-[#EBF3FF] text-[#0052FF] text-xs font-medium tracking-wider uppercase mb-5">
          <span class="w-2 h-2 rounded-full bg-[#0052FF]"></span>
          <span>CAREERS AT CREED TECH</span>
        </div>

        <!-- Main Headline -->
        <h2 class="text-[22px] sm:text-4xl lg:text-[40px] font-medium text-[#0F172A] tracking-tight leading-tight mb-5">
          <span class="block">Build meaningful technology</span>
          <span class="block mt-2.5 sm:mt-3">Grow with the people behind it</span>
        </h2>

        <!-- Description -->
        <p class="text-sm sm:text-base text-[#475569] leading-relaxed mb-7 max-w-xl font-normal">
          Join a team focused on thoughtful engineering, continuous growth, and building technology that creates real business value.
        </p>

        <!-- 3 Short Points -->
        <div class="flex flex-col gap-3.5 mb-8">
          <div class="flex items-center gap-3">
            <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0 border border-emerald-200/80">
              ✓
            </div>
            <span class="text-sm sm:text-[15px] font-normal text-gray-800">Work on meaningful projects</span>
          </div>
          <div class="flex items-center gap-3">
            <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0 border border-emerald-200/80">
              ✓
            </div>
            <span class="text-sm sm:text-[15px] font-normal text-gray-800">Grow with experienced engineers</span>
          </div>
          <div class="flex items-center gap-3">
            <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0 border border-emerald-200/80">
              ✓
            </div>
            <span class="text-sm sm:text-[15px] font-normal text-gray-800">Build with modern technologies</span>
          </div>
        </div>

        <!-- CTA Button -->
        <div>
          <a 
            href="careers" 
            class="inline-flex items-center justify-center gap-2.5 px-6 py-3 rounded-[4px] bg-[#0052FF] hover:bg-[#0042D0] text-white text-sm font-semibold transition-colors duration-150 group"
          >
            <span>Explore Careers</span>
            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
          </a>
        </div>

      </div>

      <!-- RIGHT VISUAL: Premium Engineering & Careers 3D Visual Card -->
      <div class="lg:col-span-6 w-full flex items-center justify-center">
        <div class="relative w-full max-w-[500px] aspect-[4/3] sm:aspect-[1.25/1] rounded-[28px] bg-gradient-to-br from-[#F8FAFC] via-[#F0F6FF] to-[#EBF3FC] p-6 sm:p-8 border border-[#D9E6F7] shadow-[0_15px_40px_-10px_rgba(0,82,255,0.08)] flex items-center justify-center overflow-hidden group select-none hover:shadow-[0_20px_50px_-10px_rgba(0,82,255,0.14)] hover:border-blue-200 transition-all duration-500">
          
          <!-- Light Blue Technical Grid Lines -->
          <div class="absolute inset-0 opacity-[0.45] pointer-events-none" style="background-image: linear-gradient(to right, #0052FF 1px, transparent 1px), linear-gradient(to bottom, #0052FF 1px, transparent 1px); background-size: 32px 32px; mask-image: radial-gradient(ellipse at center, rgba(0,0,0,0.9) 30%, transparent 80%); -webkit-mask-image: radial-gradient(ellipse at center, rgba(0,0,0,0.9) 30%, transparent 80%);"></div>

          <!-- Ambient Soft Blue Glow Behind Center -->
          <div class="absolute w-48 h-48 bg-[#0052FF]/10 rounded-full blur-3xl pointer-events-none group-hover:scale-125 transition-transform duration-700"></div>

          <!-- Careers & Engineering Illustration SVG -->
          <svg class="relative z-10 w-full h-full max-h-[330px] max-w-[440px] transition-transform duration-500 group-hover:scale-[1.02]" viewBox="0 0 440 330" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <!-- Soft Shadows -->
              <filter id="carSoftShadow" x="-20%" y="-20%" width="140%" height="140%" filterUnits="userSpaceOnUse">
                <feDropShadow dx="0" dy="12" stdDeviation="14" flood-color="#0052FF" flood-opacity="0.14"/>
              </filter>
              <filter id="carCardShadow" x="-20%" y="-20%" width="140%" height="140%" filterUnits="userSpaceOnUse">
                <feDropShadow dx="0" dy="6" stdDeviation="10" flood-color="#0F172A" flood-opacity="0.08"/>
              </filter>

              <!-- Gradients -->
              <linearGradient id="ideHeaderGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#0F172A"/>
                <stop offset="100%" stop-color="#1E293B"/>
              </linearGradient>
              <linearGradient id="orangeAccentGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#FF8A00"/>
                <stop offset="100%" stop-color="#FF5500"/>
              </linearGradient>
            </defs>

            <!-- Subtle Network Rays -->
            <path d="M70 160 C 130 160, 160 140, 220 140" stroke="#93C5FD" stroke-width="1.5" stroke-dasharray="4 4" opacity="0.6"/>
            <path d="M220 140 C 280 140, 310 170, 370 170" stroke="#93C5FD" stroke-width="1.5" stroke-dasharray="4 4" opacity="0.6"/>
            <circle cx="70" cy="160" r="3" fill="#0052FF"/>
            <circle cx="220" cy="140" r="3.5" fill="#FF8A00"/>
            <circle cx="370" cy="170" r="3" fill="#0052FF"/>

            <!-- CENTER: MODERN CODE / DEV INTERFACE (IDE Card) -->
            <g filter="url(#carSoftShadow)">
              <!-- Main IDE Window -->
              <rect x="110" y="45" width="220" height="150" rx="14" fill="#0B1120" stroke="#1E293B" stroke-width="1.5"/>
              
              <!-- Top Window Bar -->
              <rect x="110" y="45" width="220" height="28" rx="14" fill="url(#ideHeaderGrad)"/>
              <rect x="110" y="60" width="220" height="13" fill="url(#ideHeaderGrad)"/>
              
              <!-- macOS Window Controls -->
              <circle cx="126" cy="59" r="3.5" fill="#EF4444"/>
              <circle cx="137" cy="59" r="3.5" fill="#F59E0B"/>
              <circle cx="148" cy="59" r="3.5" fill="#10B981"/>
              
              <!-- Active File Tab -->
              <rect x="164" y="50" width="76" height="18" rx="4" fill="#1E293B"/>
              <text x="172" y="63" fill="#94A3B8" font-size="8.5" font-family="monospace" font-weight="600">engineer.ts</text>
              
              <!-- Code Lines -->
              <text x="124" y="93" fill="#38BDF8" font-size="9.5" font-family="monospace" font-weight="bold">const</text>
              <text x="156" y="93" fill="#FFFFFF" font-size="9.5" font-family="monospace"> pod = new</text>
              <text x="216" y="93" fill="#F59E0B" font-size="9.5" font-family="monospace"> Squad()</text>
              
              <text x="124" y="112" fill="#94A3B8" font-size="9.5" font-family="monospace">pod.<tspan fill="#34D399">enableMentorship</tspan>()</text>
              <text x="124" y="131" fill="#94A3B8" font-size="9.5" font-family="monospace">pod.<tspan fill="#FF8A00">shipImpact</tspan>(<tspan fill="#60A5FA">'Production'</tspan>)</text>
              <text x="124" y="150" fill="#64748B" font-size="9" font-family="monospace">// Build with elite engineers</text>
              
              <!-- Status Indicator Line -->
              <rect x="124" y="168" width="192" height="14" rx="4" fill="#1E293B" opacity="0.8"/>
              <circle cx="134" cy="175" r="2.5" fill="#10B981"/>
              <text x="142" y="178" fill="#34D399" font-size="7.5" font-family="monospace" font-weight="bold">BUILD: PASSING (100% COVERAGE)</text>
            </g>

            <!-- LEFT OVERLAY: Developer Profile / Team Element -->
            <g filter="url(#carCardShadow)">
              <rect x="36" y="155" width="138" height="88" rx="14" fill="#FFFFFF" stroke="#E2E8F0" stroke-width="1.5"/>
              
              <!-- Profile Avatar Badge -->
              <rect x="48" y="167" width="28" height="28" rx="8" fill="#0052FF"/>
              <path d="M62 176 C65 176 67 178 67 181 V182 H57 V181 C57 178 59 176 62 176 Z" fill="#FFFFFF"/>
              <circle cx="62" cy="173" r="3" fill="#FFFFFF"/>
              
              <!-- Profile Info -->
              <text x="82" y="177" fill="#0F172A" font-size="10" font-weight="bold">Senior Lead</text>
              <text x="82" y="189" fill="#0052FF" font-size="8" font-weight="600">Staff Architect</text>
              
              <line x1="48" y1="203" x2="162" y2="203" stroke="#F1F5F9" stroke-width="1.5"/>
              
              <!-- Skills Tag Pills -->
              <rect x="48" y="211" width="34" height="16" rx="4" fill="#EFF6FF"/>
              <text x="53" y="222" fill="#0052FF" font-size="7.5" font-weight="700">React</text>

              <rect x="86" y="211" width="38" height="16" rx="4" fill="#EFF6FF"/>
              <text x="91" y="222" fill="#0052FF" font-size="7.5" font-weight="700">Node.js</text>

              <rect x="128" y="211" width="28" height="16" rx="4" fill="#FFF7ED"/>
              <text x="133" y="222" fill="#FF8A00" font-size="7.5" font-weight="700">Go</text>
            </g>

            <!-- RIGHT OVERLAY: Career Growth / Progression Graphic -->
            <g filter="url(#carCardShadow)">
              <rect x="265" y="165" width="142" height="96" rx="14" fill="#FFFFFF" stroke="#E2E8F0" stroke-width="1.5"/>
              
              <text x="277" y="183" fill="#0F172A" font-size="10" font-weight="bold">Career Progression</text>
              <text x="277" y="195" fill="#10B981" font-size="8" font-weight="700">↑ Continuous Growth</text>
              
              <!-- 3D Ascending Skill Steps / Growth Bars -->
              <!-- Bar 1: Junior -->
              <rect x="277" y="228" width="18" height="20" rx="3" fill="#E2E8F0"/>
              <text x="281" y="222" fill="#64748B" font-size="7" font-weight="bold">L1</text>
              
              <!-- Bar 2: Mid -->
              <rect x="303" y="218" width="18" height="30" rx="3" fill="#93C5FD"/>
              <text x="307" y="212" fill="#0052FF" font-size="7" font-weight="bold">L2</text>
              
              <!-- Bar 3: Senior -->
              <rect x="329" y="206" width="18" height="42" rx="3" fill="#0052FF"/>
              <text x="333" y="200" fill="#0052FF" font-size="7" font-weight="bold">L3</text>
              
              <!-- Bar 4: Principal (with Orange Accent) -->
              <rect x="355" y="192" width="18" height="56" rx="3" fill="url(#orangeAccentGrad)" filter="url(#carCardShadow)"/>
              <text x="357" y="186" fill="#FF8A00" font-size="7.5" font-weight="800">L4 ★</text>
              
              <!-- Growth Trend Curve Line -->
              <path d="M286 220 Q 320 200, 364 178" stroke="#FF8A00" stroke-width="2" stroke-linecap="round" fill="none"/>
              <circle cx="364" cy="178" r="3" fill="#FF8A00"/>
            </g>
          </svg>

          <!-- Floating Badge: Top-Left -->
          <div class="absolute top-5 left-5 z-20 bg-white/95 border border-[#D9E6F7] rounded-[4px] px-3.5 py-1.5 shadow-none flex items-center gap-2 text-xs font-medium text-gray-800 transition-transform duration-300 hover:scale-105">
            <span class="w-2 h-2 rounded-full bg-[#0052FF]"></span>
            <span>Engineering</span>
          </div>

          <!-- Floating Badge: Top-Right -->
          <div class="absolute top-5 right-5 z-20 bg-white/95 border border-[#D9E6F7] rounded-[4px] px-3.5 py-1.5 shadow-none flex items-center gap-2 text-xs font-medium text-gray-800 transition-transform duration-300 hover:scale-105">
            <span class="text-[#FF8A00] font-bold">📈</span>
            <span>Growth</span>
          </div>

          <!-- Floating Badge: Bottom-Center -->
          <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-20 bg-white/95 border border-[#D9E6F7] rounded-[4px] px-4 py-1.5 shadow-none flex items-center gap-2 text-xs font-medium text-gray-800 transition-transform duration-300 hover:scale-105 whitespace-nowrap">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>Open Roles • Active Hiring</span>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<!-- 9. CONTACT CTA SECTION (src/components/home/contact-cta) -->
<section class="w-full bg-[#0B1120] py-12 lg:py-16 text-white overflow-hidden relative border-y border-[#1E293B]/60">
  <div 
    class="absolute inset-0 pointer-events-none"
    style="background: radial-gradient(circle at 75% 50%, rgba(255, 107, 0, 0.17) 0%, rgba(255, 107, 0, 0.05) 45%, rgba(11, 17, 32, 0) 70%);"
  ></div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16 z-10">
    
    <!-- LEFT: 3D Communication Visual -->
    <div class="w-full lg:w-1/2 relative bg-[#131C31]/90 border border-[#1E293B] rounded-2xl h-72 sm:h-84 flex flex-col items-center justify-center overflow-hidden shadow-2xl group select-none">
      
      <!-- Subtle Technical Grid Lines -->
      <div 
        class="absolute inset-0 opacity-[0.09] pointer-events-none"
        style="background-image: linear-gradient(to right, #FFFFFF 1px, transparent 1px), linear-gradient(to bottom, #FFFFFF 1px, transparent 1px); background-size: 24px 24px;"
      ></div>

      <!-- Ambient Glows -->
      <div class="absolute w-56 h-56 bg-[#FF6B00]/15 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700"></div>
      <div class="absolute w-36 h-36 bg-[#0052FF]/15 rounded-full blur-2xl pointer-events-none translate-x-12 -translate-y-10"></div>

      <!-- Premium 3D Communication & Contact Visual SVG -->
      <svg class="relative z-10 w-full h-full max-w-[380px] max-h-[260px] transition-transform duration-500 group-hover:scale-[1.02]" viewBox="0 0 380 260" fill="none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <!-- Soft 3D Drop Shadows -->
          <filter id="c3dBubbleShadow" x="-30%" y="-30%" width="160%" height="160%" filterUnits="userSpaceOnUse">
            <feDropShadow dx="0" dy="14" stdDeviation="16" flood-color="#FF6B00" flood-opacity="0.35"/>
            <feDropShadow dx="0" dy="6" stdDeviation="8" flood-color="#000000" flood-opacity="0.5"/>
          </filter>
          <filter id="c3dNodeShadow" x="-30%" y="-30%" width="160%" height="160%" filterUnits="userSpaceOnUse">
            <feDropShadow dx="0" dy="8" stdDeviation="10" flood-color="#000000" flood-opacity="0.4"/>
            <feDropShadow dx="0" dy="2" stdDeviation="4" flood-color="#0052FF" flood-opacity="0.2"/>
          </filter>

          <!-- Gradients -->
          <linearGradient id="bubbleFaceGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#FF8A00"/>
            <stop offset="60%" stop-color="#FF6B00"/>
            <stop offset="100%" stop-color="#EA580C"/>
          </linearGradient>
          
          <linearGradient id="bubbleDepthGrad" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#C2410C"/>
            <stop offset="100%" stop-color="#9A3412"/>
          </linearGradient>

          <linearGradient id="bubbleHighlightGrad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#FFA84A" stop-opacity="0.9"/>
            <stop offset="50%" stop-color="#FF8A00" stop-opacity="0.5"/>
            <stop offset="100%" stop-color="#FF6B00" stop-opacity="0.1"/>
          </linearGradient>

          <linearGradient id="nodeDarkCardGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#1E293B"/>
            <stop offset="100%" stop-color="#0F172A"/>
          </linearGradient>

          <linearGradient id="blueNodeGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#0052FF"/>
            <stop offset="100%" stop-color="#003EBD"/>
          </linearGradient>
        </defs>

        <!-- BACKGROUND: Subtle Connecting Rays & Technical Node Lines -->
        <!-- Line to Email (Top-Left) -->
        <path d="M190 120 C 130 110, 100 75, 78 68" stroke="#FF6B00" stroke-width="1.5" stroke-dasharray="4 4" stroke-opacity="0.45"/>
        <circle cx="78" cy="68" r="2.5" fill="#FF8A00"/>

        <!-- Line to Send / Dispatch (Top-Right) -->
        <path d="M190 110 C 240 100, 275 75, 305 68" stroke="#0052FF" stroke-width="1.5" stroke-dasharray="4 4" stroke-opacity="0.45"/>
        <circle cx="305" cy="68" r="2.5" fill="#0052FF"/>

        <!-- Line to Phone / Voice (Bottom-Left) -->
        <path d="M180 145 C 135 155, 105 185, 75 195" stroke="#38BDF8" stroke-width="1.5" stroke-dasharray="4 4" stroke-opacity="0.45"/>
        <circle cx="75" cy="195" r="2.5" fill="#38BDF8"/>

        <!-- Line to Message (Bottom-Right) -->
        <path d="M210 145 C 255 160, 280 185, 305 195" stroke="#FF6B00" stroke-width="1.5" stroke-dasharray="4 4" stroke-opacity="0.45"/>
        <circle cx="305" cy="195" r="2.5" fill="#FF8A00"/>

        <!-- 3D Pedestal / Base Shadow for Main Bubble -->
        <ellipse cx="190" cy="172" rx="46" ry="10" fill="#000000" opacity="0.4" filter="url(#c3dBubbleShadow)"/>
        <ellipse cx="190" cy="170" rx="36" ry="6" fill="#FF6B00" opacity="0.18"/>

        <!-- ================= 1. CENTER PRIMARY 3D MESSAGE BUBBLE ================= -->
        <g filter="url(#c3dBubbleShadow)">
          
          <!-- 3D Extrusion Layer (Bottom/Sides Depth) -->
          <path d="M 148 76 C 148 68, 232 68, 232 76 V 134 C 232 144, 218 152, 206 152 L 180 152 L 160 166 L 164 152 C 154 152, 148 144, 148 134 Z" fill="url(#bubbleDepthGrad)" transform="translate(0, 8)"/>
          <polygon points="160,152 160,172 174,158" fill="url(#bubbleDepthGrad)"/>

          <!-- Main 3D Bubble Front Surface -->
          <path d="M 152 74 C 152 64, 160 56, 172 56 H 208 C 220 56, 228 64, 228 74 V 126 C 228 136, 220 144, 208 144 H 182 L 162 158 L 166 144 H 172 C 160 144, 152 136, 152 126 Z" fill="url(#bubbleFaceGrad)" stroke="#FFA84A" stroke-width="1.2"/>

          <!-- 3D Top Specular Highlight Pill -->
          <path d="M 166 63 C 166 60, 170 58, 176 58 H 204 C 210 58, 214 60, 214 63 C 214 66, 210 68, 204 68 H 176 C 170 68, 166 66, 166 63 Z" fill="url(#bubbleHighlightGrad)"/>

          <!-- 3D Inner Typing Dots (3 White Glossy Spheres) -->
          <circle cx="176" cy="100" r="5" fill="#FFFFFF"/>
          <circle cx="174.5" cy="98.5" r="1.5" fill="#FFF7ED"/>

          <circle cx="190" cy="100" r="5" fill="#FFFFFF"/>
          <circle cx="188.5" cy="98.5" r="1.5" fill="#FFF7ED"/>

          <circle cx="204" cy="100" r="5" fill="#FFFFFF"/>
          <circle cx="202.5" cy="98.5" r="1.5" fill="#FFF7ED"/>
        </g>

        <!-- ================= 2. TOP-LEFT: 3D EMAIL / ENVELOPE NODE ================= -->
        <g filter="url(#c3dNodeShadow)">
          <!-- Mini Card Base -->
          <rect x="42" y="44" width="72" height="48" rx="12" fill="url(#nodeDarkCardGrad)" stroke="#334155" stroke-width="1.2"/>
          <rect x="42" y="44" width="72" height="48" rx="12" fill="none" stroke="#FF6B00" stroke-width="1" stroke-opacity="0.3"/>
          
          <!-- 3D Envelope Shape -->
          <rect x="58" y="56" width="40" height="24" rx="4" fill="#0B1120" stroke="#475569" stroke-width="1"/>
          <!-- Envelope Flap -->
          <path d="M 58 58 L 78 72 L 98 58" stroke="#FF6B00" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          <circle cx="78" cy="72" r="2" fill="#FF8A00"/>
          <!-- Unread Pulse Dot -->
          <circle cx="98" cy="56" r="3.5" fill="#FF6B00"/>
          <circle cx="98" cy="56" r="1.5" fill="#FFFFFF"/>
        </g>

        <!-- ================= 3. TOP-RIGHT: 3D SEND / DISPATCH ELEMENT ================= -->
        <g filter="url(#c3dNodeShadow)">
          <!-- Mini Card Base -->
          <rect x="266" y="44" width="72" height="48" rx="12" fill="url(#nodeDarkCardGrad)" stroke="#334155" stroke-width="1.2"/>
          <rect x="266" y="44" width="72" height="48" rx="12" fill="none" stroke="#0052FF" stroke-width="1" stroke-opacity="0.4"/>
          
          <!-- 3D Paper Plane / Send Vector -->
          <g transform="translate(284, 54)">
            <path d="M 0 16 L 34 2 L 18 28 L 14 18 Z" fill="url(#blueNodeGrad)" stroke="#38BDF8" stroke-width="1"/>
            <path d="M 14 18 L 34 2 L 16 18 Z" fill="#60A5FA"/>
            <circle cx="-2" cy="20" r="1.5" fill="#38BDF8" opacity="0.7"/>
            <circle cx="-6" cy="24" r="1" fill="#38BDF8" opacity="0.4"/>
          </g>
        </g>

        <!-- ================= 4. BOTTOM-LEFT: 3D PHONE / DIRECT CALL NODE ================= -->
        <g filter="url(#c3dNodeShadow)">
          <!-- Mini Card Base -->
          <rect x="42" y="168" width="68" height="46" rx="12" fill="url(#nodeDarkCardGrad)" stroke="#334155" stroke-width="1.2"/>
          <rect x="42" y="168" width="68" height="46" rx="12" fill="none" stroke="#38BDF8" stroke-width="1" stroke-opacity="0.3"/>
          
          <!-- Phone Handset Icon -->
          <g transform="translate(56, 178)">
            <rect x="0" y="0" width="24" height="24" rx="6" fill="#0052FF" fill-opacity="0.2"/>
            <path d="M15.5 13.5 C14.5 14.5 13 15 11 13 C9 11 9.5 9.5 10.5 8.5 L9 7 C8 8 7.5 9.5 9 12 C10.5 14.5 12 15 13 14 L15.5 13.5 Z" fill="#38BDF8"/>
            <path d="M 16 6 C 18 8, 18 11, 16 13" stroke="#38BDF8" stroke-width="1.5" stroke-linecap="round" fill="none"/>
          </g>
          <circle cx="96" cy="180" r="3" fill="#10B981"/>
        </g>

        <!-- ================= 5. BOTTOM-RIGHT: 3D MESSAGE NODE ================= -->
        <g filter="url(#c3dNodeShadow)">
          <!-- Mini Card Base -->
          <rect x="270" y="168" width="68" height="46" rx="12" fill="url(#nodeDarkCardGrad)" stroke="#334155" stroke-width="1.2"/>
          <rect x="270" y="168" width="68" height="46" rx="12" fill="none" stroke="#FF6B00" stroke-width="1" stroke-opacity="0.3"/>
          
          <!-- Mini Message Lines -->
          <g transform="translate(282, 178)">
            <rect x="0" y="0" width="26" height="20" rx="4" fill="#0B1120" stroke="#FF6B00" stroke-width="1" stroke-opacity="0.6"/>
            <line x1="5" y1="6" x2="21" y2="6" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
            <line x1="5" y1="10" x2="16" y2="10" stroke="#FF8A00" stroke-width="1.5" stroke-linecap="round"/>
            <line x1="5" y1="14" x2="12" y2="14" stroke="#94A3B8" stroke-width="1.5" stroke-linecap="round"/>
          </g>
          <circle cx="324" cy="180" r="3" fill="#FF8A00"/>
        </g>
      </svg>
    </div>

    <!-- RIGHT: Contact Content -->
    <div class="w-full lg:w-1/2 flex flex-col items-start text-left">
      <span class="text-xs font-bold text-[#FF6B00] uppercase tracking-widest mb-4">
        CONTACT
      </span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-medium tracking-tight text-white mb-6 leading-tight">
        Let's Discuss <span class="text-[#FF6B00]">Your Project</span>
      </h2>
      <p class="text-sm sm:text-base text-gray-300 max-w-xl mb-9 leading-relaxed font-normal">
        We pride ourselves on our ability to perform and deliver results. Use the form below to discuss your project needs with our team — we'll get back to you as soon as possible.
      </p>
      <div>
        <a href="contact" class="btn-orange">
          Contact Us
        </a>
      </div>
    </div>

  </div>
</section>

<!-- ================= CLIENT REVIEW MODAL ================= -->
<div id="homeReviewModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);backdrop-filter:blur(5px);z-index:9999;align-items:center;justify-content:center;padding:20px;overflow-y:auto;">
  <div style="background:#fff;border-radius:6px;max-width:540px;width:100%;padding:28px;position:relative;box-shadow:none;border:1px solid #E2E8F0;text-align:left;">
    
    <button type="button" onclick="closeHomeReviewModal()" style="position:absolute;top:20px;right:20px;background:none;border:none;font-size:20px;font-weight:600;color:#94A3B8;cursor:pointer;">✕</button>

    <div id="reviewFormContainer">
      <div style="margin-bottom:18px;">
        <span style="font-size:11px;font-weight:600;color:#FF6B00;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:4px;">★ VERIFIED CLIENT ENDORSEMENT</span>
        <h2 style="font-size:22px;font-weight:600;color:#0F172A;margin:0 0 6px;">Share Your Enterprise Experience</h2>
        <p style="font-size:13px;color:#64748B;margin:0;font-weight:400;">Your verified review helps global organizations evaluate Creed Tech engineering standards.</p>
      </div>

      <form id="homeReviewForm" onsubmit="submitHomeReview(event)" style="display:flex;flex-direction:column;gap:14px;">
        <?= csrf_field() ?>
        
        <!-- Full Name & Role -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label style="display:block;font-size:12px;font-weight:600;color:#1E293B;margin-bottom:4px;">Full Name *</label>
            <input type="text" id="revName" required placeholder="e.g. Marcus Vance" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
          </div>
          <div>
            <label style="display:block;font-size:12px;font-weight:600;color:#1E293B;margin-bottom:4px;">Role &amp; Company *</label>
            <input type="text" id="revRole" required placeholder="e.g. VP of Eng, Apex Global" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
          </div>
        </div>

        <!-- Location & Rating -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label style="display:block;font-size:12px;font-weight:600;color:#1E293B;margin-bottom:4px;">Country / Location</label>
            <input type="text" id="revLocation" placeholder="e.g. Germany / United Kingdom" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;">
          </div>
          <div>
            <label style="display:block;font-size:12px;font-weight:600;color:#1E293B;margin-bottom:4px;">Rating Score *</label>
            <select id="revRating" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;background:#fff;font-weight:600;color:#E67E22;">
              <option value="5" selected>★★★★★ (5.0 Excellent)</option>
              <option value="4">★★★★☆ (4.0 Very Good)</option>
              <option value="3">★★★☆☆ (3.0 Good)</option>
            </select>
          </div>
        </div>

        <!-- Review Quote -->
        <div>
          <label style="display:block;font-size:12px;font-weight:600;color:#1E293B;margin-bottom:4px;">Your Review / Testimonial *</label>
          <textarea id="revQuote" rows="4" required placeholder="Describe your experience with Creed Tech engineers, architecture, velocity, or reliability..." style="width:100%;padding:10px 12px;border:1px solid #CBD5E1;border-radius:4px;font-size:13px;box-sizing:border-box;resize:none;line-height:1.6;"></textarea>
        </div>

        <!-- Submit Button -->
        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:6px;">
          <button type="button" onclick="closeHomeReviewModal()" style="padding:9px 18px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:13px;font-weight:600;color:#475569;border-radius:4px;cursor:pointer;">Cancel</button>
          <button type="submit" id="submitRevBtn" style="padding:9px 22px;background:#FF6B00;color:#fff;font-size:13px;font-weight:600;border:none;border-radius:4px;cursor:pointer;box-shadow:none;">Submit Client Review ★</button>
        </div>
      </form>
    </div>

    <!-- Success Confirmation State -->
    <div id="reviewSuccessState" style="display:none;text-align:center;padding:24px 12px;">
      <div style="width:52px;height:52px;background:#ECFDF5;border:2px solid #6EE7B7;color:#059669;border-radius:4px;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 16px;">✓</div>
      <h3 style="font-size:18px;font-weight:600;color:#0F172A;margin:0 0 8px;">Review Submitted Successfully!</h3>
      <p style="font-size:13px;color:#64748B;line-height:1.6;margin:0 0 20px;max-width:400px;margin-left:auto;margin-right:auto;">Thank you for your valuable endorsement. Your review has been saved and will appear in our verified customer highlights.</p>
      <button type="button" onclick="closeHomeReviewModal()" style="padding:9px 22px;background:#0F172A;color:#fff;font-size:13px;font-weight:600;border:none;border-radius:4px;cursor:pointer;">Close Window</button>
    </div>

  </div>
</div>

<!-- Tabs Script & Modal Controller -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const btns = document.querySelectorAll(".how-tab-btn");
  const panes = document.querySelectorAll(".del-pane");

  btns.forEach(btn => {
    btn.addEventListener("click", function() {
      const target = this.getAttribute("data-target");

      btns.forEach(b => {
        b.classList.remove("btn-tab-active");
        b.classList.add("btn-tab-inactive");
      });
      panes.forEach(p => p.classList.add("hidden"));

      this.classList.remove("btn-tab-inactive");
      this.classList.add("btn-tab-active");
      const activePane = document.getElementById(target);
      if (activePane) activePane.classList.remove("hidden");
    });
  });
});

function openHomeReviewModal() {
  var modal = document.getElementById('homeReviewModal');
  if (modal) {
    modal.style.display = 'flex';
    document.getElementById('reviewFormContainer').style.display = 'block';
    document.getElementById('reviewSuccessState').style.display = 'none';
  }
}

function closeHomeReviewModal() {
  var modal = document.getElementById('homeReviewModal');
  if (modal) modal.style.display = 'none';
}

function escapeReviewHtml(str) {
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function renderReviewCardHtml(rev) {
  var stars = '';
  var rating = parseInt(rev.rating, 10) || 5;
  rating = Math.min(5, Math.max(1, rating));
  for (var i = 0; i < rating; i++) stars += '★';
  while (stars.length < 5) stars += '☆';
  
  var authorName = escapeReviewHtml(rev.authorName || 'Verified Client');
  var quote = escapeReviewHtml(rev.quote || '');
  var location = escapeReviewHtml(rev.location || 'Global');
  var authorRole = escapeReviewHtml(rev.authorRole || 'Enterprise Client');

  var initials = 'CT';
  if (rev.authorName) {
    var cleanName = String(rev.authorName).trim().replace(/[^a-zA-Z0-9\s]/g, '');
    var parts = cleanName.split(/\s+/).filter(Boolean);
    if (parts.length === 1 && parts[0].length >= 2) initials = parts[0].substring(0, 2).toUpperCase();
    else if (parts.length >= 2) initials = (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
    else if (parts.length === 1) initials = parts[0][0].toUpperCase();
  }
  initials = escapeReviewHtml(initials);

  return '<div class="bg-white rounded-2xl border border-blue-200/80 p-5 shadow-sm hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F0F7FF]">' +
    '<div class="flex items-center justify-between mb-2.5">' +
      '<span class="text-[#FFAA00] text-xs sm:text-sm">' + stars + '</span>' +
      '<span class="text-[9px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100 uppercase tracking-wider">Verified Client</span>' +
    '</div>' +
    '<p class="text-xs sm:text-[13px] text-gray-800 leading-relaxed font-medium mb-3.5">&ldquo;' + quote + '&rdquo;</p>' +
    '<div class="flex items-center gap-3 pt-3 border-t border-gray-100">' +
      '<div class="w-9 h-9 rounded-full overflow-hidden shrink-0 border border-blue-300 flex items-center justify-center bg-blue-600 text-white font-bold text-xs shadow-xs">' + initials + '</div>' +
      '<div>' +
        '<h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">' + authorName + '</h4>' +
        '<p class="text-[11px] text-gray-500 font-normal">' + location + ' • ' + authorRole + '</p>' +
      '</div>' +
    '</div>' +
  '</div>';
}

var _hasLoadedLiveReviews = false;
function loadLiveReviewsOnHome() {
  if (_hasLoadedLiveReviews) return;
  _hasLoadedLiveReviews = true;

  fetch('ajax/reviews.php')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data.success && data.reviews && data.reviews.length > 0) {
        var grid = document.getElementById('reviews-grid');
        var colDown = document.querySelector('.reviews-col-down');
        var colUp = document.querySelector('.reviews-col-up');
        data.reviews.forEach(function(rev, idx) {
          var cardHtml = renderReviewCardHtml(rev);
          if (grid) {
            grid.insertAdjacentHTML('afterbegin', cardHtml);
          } else if (idx % 2 === 0 && colDown) {
            colDown.insertAdjacentHTML('afterbegin', cardHtml);
          } else if (colUp) {
            colUp.insertAdjacentHTML('afterbegin', cardHtml);
          }
        });
      }
    })
    .catch(function() {});
}

document.addEventListener("DOMContentLoaded", function() {
  var targetSection = document.getElementById('homeReviewsSection') || document.querySelector('.reviews-col-down');

  if ('IntersectionObserver' in window && targetSection) {
    var observer = new IntersectionObserver(function(entries, obs) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          loadLiveReviewsOnHome();
          obs.disconnect();
        }
      });
    }, { rootMargin: '300px 0px' });

    observer.observe(targetSection);
  } else {
    // Fallback if IntersectionObserver is not supported
    window.addEventListener('load', function() {
      loadLiveReviewsOnHome();
    });
  }
});

function submitHomeReview(e) {
  e.preventDefault();
  var btn = document.getElementById('submitRevBtn');
  btn.textContent = 'Submitting...';
  btn.disabled = true;

  var csrfInput = document.querySelector('#homeReviewForm input[name="csrf_token"]');
  var csrfVal = csrfInput ? csrfInput.value : '';

  var payload = {
    csrf_token: csrfVal,
    authorName: document.getElementById('revName').value,
    authorRole: document.getElementById('revRole').value,
    location: document.getElementById('revLocation').value,
    rating: parseInt(document.getElementById('revRating').value) || 5,
    quote: document.getElementById('revQuote').value
  };

  fetch('ajax/reviews.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    if (!data.success) {
      btn.textContent = 'Submit Client Review ★';
      btn.disabled = false;
      alert(data.message || 'Submission failed. Please try again.');
      return;
    }
    document.getElementById('reviewFormContainer').style.display = 'none';
    document.getElementById('reviewSuccessState').style.display = 'block';
    btn.textContent = 'Submit Client Review ★';
    btn.disabled = false;

    var cardHtml = renderReviewCardHtml(payload);
    var grid = document.getElementById('reviews-grid');
    var colDown = document.querySelector('.reviews-col-down');
    if (grid) grid.insertAdjacentHTML('afterbegin', cardHtml);
    else if (colDown) colDown.insertAdjacentHTML('afterbegin', cardHtml);
  })
  .catch(function(err) {
    btn.textContent = 'Submit Client Review ★';
    btn.disabled = false;
    alert('An unexpected error occurred. Please try again.');
  });
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>