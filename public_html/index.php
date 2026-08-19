<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "CREED TECH | Enterprise IT Intelligence & Custom Software Engineering";
$page_description = "Enterprise IT solutions, custom software engineering, AI workflow orchestration, cloud modernization, and real-time tech industry intelligence for high-growth enterprises worldwide.";
$active_page = "home";

include __DIR__ . '/includes/header.php';
?>

<!-- 1. HERO SECTION (src/components/home/hero-section) -->
<section class="w-full bg-white py-10 lg:py-14 m-0 border-b border-gray-100 overflow-hidden">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16">
    
    <!-- LEFT — Text & CTA -->
    <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left shrink-0">
      <h1 class="font-bold text-4xl sm:text-5xl text-[#1A1A1A] tracking-tight leading-[1.15]">
        Your infrastructure, supercharged
      </h1>

      <p class="text-base sm:text-lg text-[#3E3E3E] leading-relaxed mt-4 max-w-lg font-normal">
        Creed Tech delivers enterprise software architecture, robust cloud infrastructure, advanced cybersecurity, and AI solutions — all in one platform.
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
          src="hero-3d-white.png" 
          alt="Creed Tech Cloud, AI, and Software Architecture Solutions" 
          class="w-full h-auto object-contain block transition-transform duration-700 hover:scale-105 select-none"
          onerror="this.src='hero-3d-transparent.png'"
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
          <img src="partners/clutch.png" alt="Clutch" class="h-9 w-auto object-contain" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" onerror="this.src='The-Manifest-Logo.svg'">
        </a>
        <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/shopify.png" alt="Shopify" class="h-9 w-auto object-contain" onerror="this.src='shopify-ar21.svg'">
        </a>
        <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/trustpilot.png" alt="Trustpilot" class="h-9 w-auto object-contain" onerror="this.src='trustpilot-seeklogo.png'">
        </a>
      </div>

      <!-- Set 2 -->
      <div class="flex items-center gap-14 sm:gap-20 shrink-0">
        <a href="https://clutch.co" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/clutch.png" alt="Clutch" class="h-9 w-auto object-contain" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" onerror="this.src='The-Manifest-Logo.svg'">
        </a>
        <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/shopify.png" alt="Shopify" class="h-9 w-auto object-contain" onerror="this.src='shopify-ar21.svg'">
        </a>
        <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/trustpilot.png" alt="Trustpilot" class="h-9 w-auto object-contain" onerror="this.src='trustpilot-seeklogo.png'">
        </a>
      </div>

      <!-- Set 3 -->
      <div class="flex items-center gap-14 sm:gap-20 shrink-0">
        <a href="https://clutch.co" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/clutch.png" alt="Clutch" class="h-9 w-auto object-contain" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" onerror="this.src='The-Manifest-Logo.svg'">
        </a>
        <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/shopify.png" alt="Shopify" class="h-9 w-auto object-contain" onerror="this.src='shopify-ar21.svg'">
        </a>
        <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/trustpilot.png" alt="Trustpilot" class="h-9 w-auto object-contain" onerror="this.src='trustpilot-seeklogo.png'">
        </a>
      </div>

      <!-- Set 4 -->
      <div class="flex items-center gap-14 sm:gap-20 shrink-0">
        <a href="https://clutch.co" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/clutch.png" alt="Clutch" class="h-9 w-auto object-contain" onerror="this.src='clutch-logo.png'">
        </a>
        <a href="https://www.google.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/google.png" alt="Google" class="h-9 w-auto object-contain" onerror="this.src='google-ar21.svg'">
        </a>
        <a href="https://themanifest.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/the-manifest.png" alt="The Manifest" class="h-11 w-auto object-contain" onerror="this.src='The-Manifest-Logo.svg'">
        </a>
        <a href="https://www.shopify.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/shopify.png" alt="Shopify" class="h-9 w-auto object-contain" onerror="this.src='shopify-ar21.svg'">
        </a>
        <a href="https://www.trustpilot.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
          <img src="partners/trustpilot.png" alt="Trustpilot" class="h-9 w-auto object-contain" onerror="this.src='trustpilot-seeklogo.png'">
        </a>
      </div>

    </div>
  </div>
</section>

<!-- 3. SERVICES SECTION: CLEAN HEADING (NO 'CORE'), 4 LEFT & 4 RIGHT, SIDE ICONS, COMPACT HEIGHT, NORMAL SIZES -->
<section class="w-full bg-[#E5E7EB] py-12 lg:py-16 border-b border-gray-300">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col items-center">
    
    <!-- Clean Heading (Core removed) -->
    <div class="flex flex-col items-center text-center mb-10">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#1A1A1A]">
        What We Provide
      </h2>
      <p class="text-sm sm:text-base text-gray-700 max-w-2xl mt-2 font-normal">
        Eight specialized engineering domains tailored for mission-critical enterprise scale, cloud modernization, and high availability.
      </p>
    </div>

    <!-- 4 Left & 4 Right with Wider Horizontal Gap (gap-8 lg:gap-12) -->
    <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12">
      
      <!-- LEFT COLUMN (4 Services) -->
      <div class="flex flex-col gap-4">
        
        <!-- Service 1: Software Development -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><polyline points="16 18 22 12 16 6" /><polyline points="8 6 2 12 8 18" /></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                Software Development
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                Custom web and mobile applications engineered for reliability, built with modern maintainable architecture.
              </p>
            </div>
            <a href="services#software-development" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

        <!-- Service 2: UI/UX Design -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                UI/UX Design
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                Interfaces designed around real user workflows, not just visual polish. Streamlined, accessible, and high-converting.
              </p>
            </div>
            <a href="services#ui-ux" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

        <!-- Service 3: Mobile Applications -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2" /><line x1="12" y1="18" x2="12.01" y2="18" /></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                Mobile Applications
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                High-performance iOS and Android applications crafted for native speed and intuitive mobile gestures.
              </p>
            </div>
            <a href="services#mobile-applications" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

        <!-- Service 4: Cloud Infrastructure -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z" /></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                Cloud Infrastructure
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                Provisioning, CI/CD automated deployment, and hardening for infrastructure that scales with traffic.
              </p>
            </div>
            <a href="services#cloud-infrastructure" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN (4 Services) -->
      <div class="flex flex-col gap-4">
        
        <!-- Service 5: Database Management -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><ellipse cx="12" cy="5" rx="9" ry="3" /><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3" /><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" /></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                Database Management
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                Schema design, migrations, and ongoing management for high-concurrency relational and NoSQL databases.
              </p>
            </div>
            <a href="services#database-management" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

        <!-- Service 6: Cybersecurity & QA -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10" /></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                Cybersecurity & QA
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                Security audits, automated test suites, and compliance checks to keep your systems protected.
              </p>
            </div>
            <a href="services#cybersecurity" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

        <!-- Service 7: Artificial Intelligence (AI) -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M12 2a4 4 0 0 0-4 4v1H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2V6a4 4 0 0 0-4-4z"/><circle cx="9" cy="13" r="1"/><circle cx="15" cy="13" r="1"/></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                Artificial Intelligence (AI)
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                Private on-premise LLM fine-tuning, dense vector embeddings, and autonomous AI agent orchestration.
              </p>
            </div>
            <a href="services#ai" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

        <!-- Service 8: Digital Marketing & Branding -->
        <div class="group bg-white border border-gray-200 hover:border-blue-300 p-5 rounded-none flex items-start gap-4 hover:shadow-md transition-all duration-200">
          <div class="p-2.5 bg-blue-50 border border-blue-100/80 rounded-none shrink-0 group-hover:bg-blue-100 transition-colors">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
          </div>
          <div class="flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-tight mb-1.5">
                Digital Marketing & Branding
              </h3>
              <p class="text-xs sm:text-[13px] text-gray-600 leading-relaxed font-normal">
                Strategic tech product positioning, high-conversion CRO landing pages, and enterprise search visibility.
              </p>
            </div>
            <a href="services#marketing" class="mt-2.5 text-xs font-semibold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
              Learn more <span>&rarr;</span>
            </a>
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

<!-- 4. HOW WE DELIVER SECTION (src/components/home/how-we-deliver) -->
<section 
  class="w-full py-12 lg:py-16 text-white relative overflow-hidden border-b border-gray-800"
  style="background-color: #0F1420;"
>
  <div 
    class="absolute inset-0 pointer-events-none"
    style="background: radial-gradient(ellipse at 50% 15%, rgba(255, 107, 0, 0.15) 0%, rgba(255, 107, 0, 0.03) 50%, transparent 75%);"
  ></div>
  <div 
    class="absolute inset-0 opacity-[0.08] pointer-events-none"
    style="background-image: linear-gradient(to right, #FFFFFF 1px, transparent 1px), linear-gradient(to bottom, #FFFFFF 1px, transparent 1px); background-size: 36px 36px;"
  ></div>

  <div class="relative max-w-6xl mx-auto px-6 lg:px-12 flex flex-col items-center z-10">
    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-white uppercase text-center mb-2">
      HOW WE DELIVER
    </h2>
    <p class="text-xs sm:text-sm text-gray-400 max-w-xl text-center mb-8 font-normal">
      A transparent, four-phase delivery methodology designed to eliminate surprises and keep projects on track.
    </p>

    <!-- Tabs Navigation (Standard Equal Sized Buttons - Single Row) -->
    <div class="flex items-center justify-center flex-wrap gap-3 mb-8 w-full max-w-4xl mx-auto">
      <button class="how-tab-btn btn-tab-active whitespace-nowrap" data-target="del-req">
        Team Requirement
      </button>
      <button class="how-tab-btn btn-tab-inactive whitespace-nowrap" data-target="del-onboard">
        Onboarding
      </button>
      <button class="how-tab-btn btn-tab-inactive whitespace-nowrap" data-target="del-prod">
        Productivity Phase
      </button>
      <button class="how-tab-btn btn-tab-inactive whitespace-nowrap" data-target="del-qc">
        Quality Control
      </button>
    </div>

    <!-- Active Tab Box (Centered Content) -->
    <div class="w-full bg-[#161D2E] border border-gray-800 rounded-none p-6 sm:p-8 relative min-h-[160px] flex flex-col justify-center text-center">
      <div id="del-req" class="del-pane">
        <h3 class="text-lg sm:text-xl font-bold text-white mb-2 text-center">Team Requirement</h3>
        <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal text-center max-w-2xl mx-auto">
          Define your technical stack, domain scope, and seniority expectations. We match verified senior software engineers tailored precisely to your architecture.
        </p>
      </div>
      <div id="del-onboard" class="del-pane hidden">
        <h3 class="text-lg sm:text-xl font-bold text-white mb-2 text-center">Rapid Onboarding &amp; Setup</h3>
        <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal text-center max-w-2xl mx-auto">
          Sprint kickoff, repo provisioning, secure access integration, and architectural alignment within 48 hours without friction.
        </p>
      </div>
      <div id="del-prod" class="del-pane hidden">
        <h3 class="text-lg sm:text-xl font-bold text-white mb-2 text-center">Full Velocity Execution</h3>
        <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal text-center max-w-2xl mx-auto">
          Daily async syncs, sprint milestone tracking, clean PR reviews, and automated CI/CD deployment pipelines operating at enterprise velocity.
        </p>
      </div>
      <div id="del-qc" class="del-pane hidden">
        <h3 class="text-lg sm:text-xl font-bold text-white mb-2 text-center">Continuous Quality Control</h3>
        <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal text-center max-w-2xl mx-auto">
          End-to-end automated testing, security audits, performance profiling, and milestone sign-offs ensuring production-grade stability.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- 5. WHY CHOOSE US SECTION (src/components/home/why-choose-us) -->
<section class="w-full bg-white py-12 lg:py-16 border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-16">
    
    <!-- Left Column -->
    <div class="w-full lg:w-[45%] flex flex-col items-start text-left">
      <span class="text-xs font-bold text-orange-600 uppercase tracking-widest mb-4">
        WHY CREED TECH
      </span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight leading-[1.15] mb-6">
        Focused teams.<br />
        Reliable delivery.
      </h2>
      <p class="text-base text-gray-600 leading-relaxed mb-8 max-w-md">
        What does this mean for you? You gain enterprise-grade engineering with the responsiveness of a dedicated team.
      </p>
      <a href="contact" class="btn-blue">
        Talk to Us
      </a>
    </div>

    <!-- Right Column (2x2 Grid) -->
    <div class="w-full lg:w-[50%] grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-12">
      <div class="flex flex-col items-start">
        <div class="w-8 h-1 bg-orange-600 mb-4 rounded-none"></div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Risk Free</h3>
        <p class="text-sm text-gray-600 leading-relaxed font-normal">Structured delivery with clear milestones reduces project risk from day one.</p>
      </div>

      <div class="flex flex-col items-start">
        <div class="w-8 h-1 bg-orange-600 mb-4 rounded-none"></div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Cost</h3>
        <p class="text-sm text-gray-600 leading-relaxed font-normal">Transparent pricing with no hidden fees, scoped to your actual needs.</p>
      </div>

      <div class="flex flex-col items-start">
        <div class="w-8 h-1 bg-orange-600 mb-4 rounded-none"></div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Flexibility</h3>
        <p class="text-sm text-gray-600 leading-relaxed font-normal">Engagement models that adapt as your priorities and roadmap change.</p>
      </div>

      <div class="flex flex-col items-start">
        <div class="w-8 h-1 bg-orange-600 mb-4 rounded-none"></div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Dedicated Delivery</h3>
        <p class="text-sm text-gray-600 leading-relaxed font-normal">A consistent, dedicated team — not a rotating pool of contractors.</p>
      </div>
    </div>

  </div>
</section>

<!-- 6. TRACK RECORD SECTION (src/components/home/track-record) -->
<section class="w-full bg-[#0B1120] py-12 lg:py-16 text-white text-center relative overflow-hidden border-b border-[#1E293B]/60">
  <div 
    class="absolute inset-0 pointer-events-none"
    style="background: radial-gradient(ellipse at 50% 50%, rgba(255, 107, 0, 0.15) 0%, rgba(255, 107, 0, 0.04) 45%, rgba(11, 17, 32, 0) 75%);"
  ></div>
  <div 
    class="absolute inset-0 opacity-[0.05] pointer-events-none"
    style="background-image: linear-gradient(45deg, #ffffff 1px, transparent 1px), linear-gradient(-45deg, #ffffff 1px, transparent 1px); background-size: 40px 40px;"
  ></div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-12 z-10">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-none border border-[#1E293B] bg-[#131C31] text-gray-300 text-xs font-semibold tracking-wider uppercase mb-4">
      <span class="w-1.5 h-1.5 rounded-none bg-[#FF6B00]"></span>
      TRACK RECORD
    </div>

    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white mb-10">
      A Decade of <span class="text-[#FF6B00]">Excellence</span>
    </h2>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 divide-y lg:divide-y-0 lg:divide-x divide-[#1E293B]/80">
      <div class="flex flex-col items-center pt-6 lg:pt-0 px-4">
        <span class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-white hover:text-[#FF6B00] transition-colors mb-3 tracking-tight">10+</span>
        <span class="text-xs sm:text-sm text-gray-400 font-medium">Years of Experience</span>
      </div>
      <div class="flex flex-col items-center pt-6 lg:pt-0 px-4">
        <span class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-white hover:text-[#FF6B00] transition-colors mb-3 tracking-tight">50+</span>
        <span class="text-xs sm:text-sm text-gray-400 font-medium">Projects Delivered</span>
      </div>
      <div class="flex flex-col items-center pt-6 lg:pt-0 px-4">
        <span class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-white hover:text-[#FF6B00] transition-colors mb-3 tracking-tight">6</span>
        <span class="text-xs sm:text-sm text-gray-400 font-medium">Core Services</span>
      </div>
      <div class="flex flex-col items-center pt-6 lg:pt-0 px-4">
        <span class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-white hover:text-[#FF6B00] transition-colors mb-3 tracking-tight">100%</span>
        <span class="text-xs sm:text-sm text-gray-400 font-medium">Dedicated Engineering</span>
      </div>
    </div>
  </div>
</section>

<!-- 7. CLIENT FEEDBACK SECTION: DUAL CONTINUOUS VERTICAL SCROLL (Left DOWN, Right UP) -->
<section class="w-full py-16 sm:py-20 lg:py-24 bg-[#FCFDFF] text-gray-900 border-b border-gray-100 overflow-hidden relative">
  <div class="max-w-7xl mx-auto px-6 lg:px-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
      
      <!-- LEFT COLUMN -->
      <div class="lg:col-span-5 text-left space-y-6">
        <div>
          <span class="text-xs sm:text-[13px] font-bold text-[#E67E22] uppercase tracking-wider block mb-2">
            Enterprise Client Feedback
          </span>
          <h2 class="text-3xl sm:text-4xl lg:text-[44px] font-semibold text-gray-950 tracking-tight leading-tight">
            What Our Clients Say About Creed Tech
          </h2>
        </div>

        <div class="space-y-3.5 pt-2">
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-semibold text-gray-800 leading-snug">Dedicated Principal Engineers on Every Project.</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-semibold text-gray-800 leading-snug">The Ability to Scale Engineering Pods in Real Time.</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-semibold text-gray-800 leading-snug">99.8% On-Time Deployment & Strict SLA Controls.</span>
          </div>
          <div class="flex items-start gap-3">
            <span class="text-[#E67E22] font-semibold text-base shrink-0 mt-0.5">✓</span>
            <span class="text-sm sm:text-[15px] font-semibold text-gray-800 leading-snug">Zero-Defect Code Audits & SOC 2 Compliance.</span>
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
              class="inline-flex items-center text-xs sm:text-sm font-bold text-gray-900 hover:text-[#E67E22] border-b-2 border-gray-900 hover:border-[#E67E22] pb-0.5 transition-colors"
            >
              View Client Portfolio &rarr;
            </a>
          </div>
        </div>

        <p class="text-[11px] text-gray-400 font-medium pt-2">
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    MR
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">Marina R.</h4>
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    ER
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">Elena Rostova</h4>
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    MR
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">Marina R.</h4>
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    ER
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">Elena Rostova</h4>
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    DL
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">David L.</h4>
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    SJ
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">Sarah Jenkins</h4>
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    DL
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">David L.</h4>
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
                  <div class="w-9 h-9 rounded-none overflow-hidden shrink-0 border border-blue-200 flex items-center justify-center bg-gray-900 text-white font-bold text-xs">
                    SJ
                  </div>
                  <div>
                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">Sarah Jenkins</h4>
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

<!-- 8. KNOWLEDGE CENTER SECTION (src/components/home/knowledge-center) -->
<section 
  class="w-full py-12 lg:py-16 border-b border-[#E3EDFF]"
  style="background-color: #F4F8FF;"
>
  <div class="max-w-7xl mx-auto px-6 lg:px-12">
    
    <div class="flex flex-col items-center text-center mb-10">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight mb-4">
        Knowledge Center
      </h2>
      <p class="text-sm sm:text-base text-gray-600 max-w-2xl">
        Discover the latest advancements, expert insights, and practical tips to elevate your software development journey.
      </p>
    </div>

    <!-- 2x2 Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 lg:gap-x-14 gap-y-6 w-full">
      
      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">
            INSIGHT
          </span>
          <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            The enterprise software checklist before you scale
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jul 2026
          </span>
        </div>
        <div class="shrink-0 w-20 h-20 sm:w-22 sm:h-22 rounded-2xl bg-gradient-to-br from-blue-50/70 to-blue-100/30 border border-blue-100 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
          <div class="relative z-10 w-10 h-10 rounded-xl bg-white shadow-xs flex items-center justify-center">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5" /><path d="M9 18h6" /><path d="M10 22h4" /></svg>
          </div>
        </div>
      </a>

      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">
            ARTICLE
          </span>
          <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            Why database migrations fail — and how to avoid it
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jul 2026
          </span>
        </div>
        <div class="shrink-0 w-20 h-20 sm:w-22 sm:h-22 rounded-2xl bg-gradient-to-br from-orange-50/70 to-amber-100/30 border border-orange-100 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
          <div class="relative z-10 w-10 h-10 rounded-xl bg-white shadow-xs flex items-center justify-center">
            <svg class="w-5 h-5 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" /><polyline points="14 2 14 8 20 8" /></svg>
          </div>
        </div>
      </a>

      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">
            NEWS
          </span>
          <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            Creed Tech expands cloud infrastructure practice
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jun 2026
          </span>
        </div>
        <div class="shrink-0 w-20 h-20 sm:w-22 sm:h-22 rounded-2xl bg-gradient-to-br from-blue-50/70 to-blue-100/30 border border-blue-100 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
          <div class="relative z-10 w-10 h-10 rounded-xl bg-white shadow-xs flex items-center justify-center">
            <svg class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2" /></svg>
          </div>
        </div>
      </a>

      <a
        href="knowledge-center"
        class="group bg-white rounded-2xl border border-[#E1ECFB] p-6 sm:p-7 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-between gap-6"
      >
        <div class="flex flex-col items-start pr-2">
          <span class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-2">
            BLOG
          </span>
          <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors leading-snug mb-2.5 max-w-md">
            A practical guide to QA for fast-moving teams
          </h3>
          <span class="text-xs text-gray-400 font-normal">
            Creed Team • Jun 2026
          </span>
        </div>
        <div class="shrink-0 w-20 h-20 sm:w-22 sm:h-22 rounded-2xl bg-gradient-to-br from-orange-50/70 to-amber-100/30 border border-orange-100 flex items-center justify-center relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
          <div class="relative z-10 w-10 h-10 rounded-xl bg-white shadow-xs flex items-center justify-center">
            <svg class="w-5 h-5 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><polygon points="5 3 19 12 5 21 5 3" /></svg>
          </div>
        </div>
      </a>

    </div>

  </div>
</section>

<!-- 9. CONTACT CTA SECTION (src/components/home/contact-cta) -->
<section class="w-full bg-[#0B1120] py-12 lg:py-16 text-white overflow-hidden relative border-y border-[#1E293B]/60">
  <div 
    class="absolute inset-0 pointer-events-none"
    style="background: radial-gradient(circle at 25% 50%, rgba(255, 107, 0, 0.17) 0%, rgba(255, 107, 0, 0.05) 45%, rgba(11, 17, 32, 0) 70%);"
  ></div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16 z-10">
    
    <div class="w-full lg:w-1/2 flex flex-col items-start text-left">
      <span class="text-xs font-bold text-[#FF6B00] uppercase tracking-widest mb-4">
        CONTACT
      </span>
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white mb-6 leading-tight">
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

    <div class="w-full lg:w-1/2 relative bg-[#131C31]/90 border border-[#1E293B] rounded-2xl h-72 sm:h-84 flex flex-col items-center justify-center overflow-hidden shadow-2xl">
      <div 
        class="absolute inset-0 opacity-[0.08]"
        style="background-image: linear-gradient(to right, #FFFFFF 1px, transparent 1px), linear-gradient(to bottom, #FFFFFF 1px, transparent 1px); background-size: 24px 24px;"
      ></div>
      <div class="absolute w-44 h-44 bg-orange-500/15 rounded-none blur-3xl pointer-events-none"></div>

      <div class="relative z-10 w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 shadow-lg flex items-center justify-center text-white">
        <svg class="w-8 h-8 text-[#FF6B00]" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" /></svg>
      </div>
    </div>

  </div>
</section>

<!-- ================= CLIENT REVIEW MODAL ================= -->
<div id="homeReviewModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);backdrop-filter:blur(5px);z-index:9999;align-items:center;justify-content:center;padding:20px;overflow-y:auto;">
  <div style="background:#fff;border-radius:12px;max-width:540px;width:100%;padding:28px;position:relative;box-shadow:0 25px 50px -12px rgba(0,0,0,0.35);text-align:left;">
    
    <button type="button" onclick="closeHomeReviewModal()" style="position:absolute;top:20px;right:20px;background:none;border:none;font-size:20px;font-weight:700;color:#94A3B8;cursor:pointer;">✕</button>

    <div id="reviewFormContainer">
      <div style="margin-bottom:18px;">
        <span style="font-size:11px;font-weight:800;color:#FF6B00;text-transform:uppercase;letter-spacing:0.1em;display:block;margin-bottom:4px;">★ VERIFIED CLIENT ENDORSEMENT</span>
        <h2 style="font-size:22px;font-weight:800;color:#0F172A;margin:0 0 6px;">Share Your Enterprise Experience</h2>
        <p style="font-size:13px;color:#64748B;margin:0;">Your verified review helps global organizations evaluate Creed Tech engineering standards.</p>
      </div>

      <form id="homeReviewForm" onsubmit="submitHomeReview(event)" style="display:flex;flex-direction:column;gap:14px;">
        
        <!-- Full Name & Role -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div>
            <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Full Name *</label>
            <input type="text" id="revName" required placeholder="e.g. Marcus Vance" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;box-sizing:border-box;">
          </div>
          <div>
            <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Role &amp; Company *</label>
            <input type="text" id="revRole" required placeholder="e.g. VP of Eng, Apex Global" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;box-sizing:border-box;">
          </div>
        </div>

        <!-- Location & Rating -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div>
            <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Country / Location</label>
            <input type="text" id="revLocation" placeholder="e.g. Germany / United Kingdom" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;box-sizing:border-box;">
          </div>
          <div>
            <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Rating Score *</label>
            <select id="revRating" style="width:100%;padding:9px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;box-sizing:border-box;background:#fff;font-weight:700;color:#E67E22;">
              <option value="5" selected>★★★★★ (5.0 Excellent)</option>
              <option value="4">★★★★☆ (4.0 Very Good)</option>
              <option value="3">★★★☆☆ (3.0 Good)</option>
            </select>
          </div>
        </div>

        <!-- Review Quote -->
        <div>
          <label style="display:block;font-size:12px;font-weight:700;color:#1E293B;margin-bottom:4px;">Your Review / Testimonial *</label>
          <textarea id="revQuote" rows="4" required placeholder="Describe your experience with Creed Tech engineers, architecture, velocity, or reliability..." style="width:100%;padding:10px 12px;border:1px solid #CBD5E1;border-radius:6px;font-size:13px;box-sizing:border-box;resize:none;line-height:1.6;"></textarea>
        </div>

        <!-- Submit Button -->
        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:6px;">
          <button type="button" onclick="closeHomeReviewModal()" style="padding:10px 18px;background:#F1F5F9;border:1px solid #CBD5E1;font-size:13px;font-weight:700;color:#475569;border-radius:6px;cursor:pointer;">Cancel</button>
          <button type="submit" id="submitRevBtn" style="padding:10px 24px;background:#FF6B00;color:#fff;font-size:13px;font-weight:700;border:none;border-radius:6px;cursor:pointer;box-shadow:0 4px 6px -1px rgba(255,107,0,0.3);">Submit Client Review ★</button>
        </div>
      </form>
    </div>

    <!-- Success Confirmation State -->
    <div id="reviewSuccessState" style="display:none;text-align:center;padding:24px 12px;">
      <div style="width:60px;height:60px;background:#ECFDF5;border:2px solid #6EE7B7;color:#059669;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;margin:0 auto 16px;">✓</div>
      <h3 style="font-size:20px;font-weight:800;color:#0F172A;margin:0 0 8px;">Review Submitted Successfully!</h3>
      <p style="font-size:13px;color:#64748B;line-height:1.6;margin:0 0 20px;max-width:400px;margin-left:auto;margin-right:auto;">Thank you for your valuable endorsement. Your review has been saved and will appear in our verified customer highlights.</p>
      <button type="button" onclick="closeHomeReviewModal()" style="padding:10px 24px;background:#0F172A;color:#fff;font-size:13px;font-weight:700;border:none;border-radius:6px;cursor:pointer;">Close Window</button>
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
        b.className = "how-tab-btn btn-tab-inactive";
      });
      panes.forEach(p => p.classList.add("hidden"));

      this.className = "how-tab-btn btn-tab-active";
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

function renderReviewCardHtml(rev) {
  var stars = '';
  for (var i = 0; i < (rev.rating || 5); i++) stars += '★';
  while (stars.length < 5) stars += '☆';
  
  var initials = 'CT';
  if (rev.authorName) {
    var parts = rev.authorName.trim().split(' ');
    if (parts.length === 1) initials = parts[0].substring(0, 2).toUpperCase();
    else initials = (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
  }

  return '<div class="bg-white rounded-2xl border border-blue-200/80 p-5 shadow-sm hover:shadow-md transition-all duration-300 text-left bg-gradient-to-b from-white to-[#F0F7FF]">' +
    '<div class="flex items-center justify-between mb-2.5">' +
      '<span class="text-[#FFAA00] text-xs sm:text-sm">' + stars + '</span>' +
      '<span class="text-[9px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100 uppercase tracking-wider">Verified Client</span>' +
    '</div>' +
    '<p class="text-xs sm:text-[13px] text-gray-800 leading-relaxed font-medium mb-3.5">&ldquo;' + rev.quote + '&rdquo;</p>' +
    '<div class="flex items-center gap-3 pt-3 border-t border-gray-100">' +
      '<div class="w-9 h-9 rounded-full overflow-hidden shrink-0 border border-blue-300 flex items-center justify-center bg-blue-600 text-white font-bold text-xs shadow-xs">' + initials + '</div>' +
      '<div>' +
        '<h4 class="text-xs sm:text-sm font-bold text-gray-900 leading-tight">' + rev.authorName + '</h4>' +
        '<p class="text-[11px] text-gray-500 font-normal">' + (rev.location || 'Global') + ' • ' + (rev.authorRole || 'Enterprise Client') + '</p>' +
      '</div>' +
    '</div>' +
  '</div>';
}

function loadLiveReviewsOnHome() {
  fetch('ajax/reviews.php')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data.success && data.reviews && data.reviews.length > 0) {
        var colDown = document.querySelector('.reviews-col-down');
        var colUp = document.querySelector('.reviews-col-up');
        data.reviews.forEach(function(rev, idx) {
          var cardHtml = renderReviewCardHtml(rev);
          if (idx % 2 === 0 && colDown) {
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
  loadLiveReviewsOnHome();
});

function submitHomeReview(e) {
  e.preventDefault();
  var btn = document.getElementById('submitRevBtn');
  btn.textContent = 'Submitting...';
  btn.disabled = true;

  var payload = {
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
    document.getElementById('reviewFormContainer').style.display = 'none';
    document.getElementById('reviewSuccessState').style.display = 'block';
    btn.textContent = 'Submit Client Review ★';
    btn.disabled = false;

    // Immediately insert into live scrolling column
    var cardHtml = renderReviewCardHtml(payload);
    var colDown = document.querySelector('.reviews-col-down');
    if (colDown) colDown.insertAdjacentHTML('afterbegin', cardHtml);
  })
  .catch(function(err) {
    document.getElementById('reviewFormContainer').style.display = 'none';
    document.getElementById('reviewSuccessState').style.display = 'block';
    btn.textContent = 'Submit Client Review ★';
    btn.disabled = false;

    var cardHtml = renderReviewCardHtml(payload);
    var colDown = document.querySelector('.reviews-col-down');
    if (colDown) colDown.insertAdjacentHTML('afterbegin', cardHtml);
  });
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>