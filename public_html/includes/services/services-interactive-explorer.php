<section id="what-we-provide" class="services-interactive-section">
  <div style="position:absolute;inset:0;opacity:0.035;pointer-events:none;background-image:linear-gradient(to right,rgba(0,82,255,0.7) 1px,transparent 1px),linear-gradient(to bottom,rgba(0,82,255,0.7) 1px,transparent 1px);background-size:44px 44px;"></div>

  <div class="svc-container">
    <!-- Section Header -->
    <div style="text-align:center;max-width:52rem;margin:0 auto 1.5rem;">
      <h2 style="font-size:clamp(1.75rem,3vw,2.35rem);font-weight:800;color:#0F172A;letter-spacing:-0.02em;margin:0 0 0.45rem;line-height:1.2;">
        Enterprise Engineering &amp; <span style="color:#0052FF;">Digital Solutions</span>
      </h2>
      <p style="font-size:0.9375rem;color:#475569;line-height:1.55;margin:0;font-weight:400;">
        Select any service below to explore dedicated capabilities, technical benefits, delivery methodology, results, and Tech Ecosystem.
      </p>
    </div>

    <!-- 8 HORIZONTAL SERVICE SELECTOR (3-Column Layout on Mobile) -->
    <div class="svc-selector-relative-container">
      <!-- Mobile Left Arrow (Column 1) -->
      <button type="button" class="svc-scroll-arrow svc-scroll-arrow-left" id="svcSelectorLeftBtn" aria-label="Previous service" onclick="navigateServiceCarousel('prev')">
        <svg viewBox="0 0 24 24" fill="none" stroke="#0052FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:20px;height:20px;"><polyline points="15 18 9 12 15 6"></polyline></svg>
      </button>

      <!-- Scrollable Track (Column 2) -->
      <div class="svc-selector-grid" id="svcSelectorGrid" role="tablist" aria-label="Services">
        <!-- 01 Software Development -->
        <button type="button" onclick="selectSvc('software-development', true)" id="svc-card-software-development" class="svc-select-card active" aria-label="Select Software Development" role="tab" aria-selected="true" tabindex="0" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">01</span>
            <span class="svc-card-name">Software Development</span>
          </div>
        </button>

        <!-- 02 UI/UX Design -->
        <button type="button" onclick="selectSvc('ui-ux-design', true)" id="svc-card-ui-ux-design" class="svc-select-card" aria-label="Select UI/UX Design" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">02</span>
            <span class="svc-card-name">UI/UX Design</span>
          </div>
        </button>

        <!-- 03 Mobile Application -->
        <button type="button" onclick="selectSvc('mobile-application', true)" id="svc-card-mobile-application" class="svc-select-card" aria-label="Select Mobile Application" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">03</span>
            <span class="svc-card-name">Mobile Application</span>
          </div>
        </button>

        <!-- 04 Cloud Infrastructure -->
        <button type="button" onclick="selectSvc('cloud-infrastructure', true)" id="svc-card-cloud-infrastructure" class="svc-select-card" aria-label="Select Cloud Infrastructure" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">04</span>
            <span class="svc-card-name">Cloud Infrastructure</span>
          </div>
        </button>

        <!-- 05 Database Management -->
        <button type="button" onclick="selectSvc('database-management', true)" id="svc-card-database-management" class="svc-select-card" aria-label="Select Database Management" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">05</span>
            <span class="svc-card-name">Database Management</span>
          </div>
        </button>

        <!-- 06 Web Development -->
        <button type="button" onclick="selectSvc('web-development', true)" id="svc-card-web-development" class="svc-select-card" aria-label="Select Web Development" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">06</span>
            <span class="svc-card-name">Web Development</span>
          </div>
        </button>

        <!-- 07 AI & Automation -->
        <button type="button" onclick="selectSvc('ai-automation', true)" id="svc-card-ai-automation" class="svc-select-card" aria-label="Select AI & Automation" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/><circle cx="12" cy="12" r="4"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">07</span>
            <span class="svc-card-name">AI &amp; Automation</span>
          </div>
        </button>

        <!-- 08 Digital Growth -->
        <button type="button" onclick="selectSvc('digital-growth', true)" id="svc-card-digital-growth" class="svc-select-card" aria-label="Select Digital Growth" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
          <div class="svc-card-top-bar"></div>
          <div class="svc-card-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          </div>
          <div class="svc-card-text">
            <span class="svc-card-step">08</span>
            <span class="svc-card-name">Digital Growth</span>
          </div>
        </button>
      </div>

      <!-- Mobile Right Arrow (Column 3) -->
      <button type="button" class="svc-scroll-arrow svc-scroll-arrow-right" id="svcSelectorRightBtn" aria-label="Next service" onclick="navigateServiceCarousel('next')">
        <svg viewBox="0 0 24 24" fill="none" stroke="#0052FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:20px;height:20px;"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </button>
    </div>

    <!-- SERVICE DETAIL SECTION: TWO-COLUMN STICKY LAYOUT -->
    <div id="service-detail-view" class="svc-detail-container">
      <!-- Left Column: Sticky Sub-Navigation -->
      <aside class="svc-sidebar-col">
        <div class="svc-sticky-sidebar">
          <div class="svc-nav-card">
            <div class="svc-nav-header">
              <span class="svc-nav-badge" id="sidebarSvcNum">01</span>
              <h3 class="svc-nav-title" id="sidebarSvcName">Software Development</h3>
            </div>

            <!-- Subsection Nav with 3-Column Layout on Mobile -->
            <div class="svc-subtab-relative-container">
              <!-- Mobile Subtab Left Arrow (Column 1) -->
              <button type="button" class="svc-subtab-arrow svc-subtab-arrow-left" id="subtabLeftBtn" aria-label="Previous section" onclick="navigateSubtabCarousel('prev')">
                <svg viewBox="0 0 24 24" fill="none" stroke="#0052FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;"><polyline points="15 18 9 12 15 6"></polyline></svg>
              </button>

              <!-- Subsection Buttons Track (Column 2) -->
              <div class="svc-nav-menu" role="tablist" aria-label="Service Sections">
                <button type="button" onclick="setSubTab('overview')" id="subtab-btn-overview" class="svc-subtab-btn active" role="tab" aria-selected="true" tabindex="0" aria-controls="serviceDetailPanel">
                  <span class="svc-subtab-dot"></span>
                  <span class="svc-subtab-label">Overview</span>
                </button>
                <button type="button" onclick="setSubTab('services')" id="subtab-btn-services" class="svc-subtab-btn" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
                  <span class="svc-subtab-dot"></span>
                  <span class="svc-subtab-label">Services</span>
                </button>
                <button type="button" onclick="setSubTab('benefits')" id="subtab-btn-benefits" class="svc-subtab-btn" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
                  <span class="svc-subtab-dot"></span>
                  <span class="svc-subtab-label">Benefits</span>
                </button>
                <button type="button" onclick="setSubTab('process')" id="subtab-btn-process" class="svc-subtab-btn" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
                  <span class="svc-subtab-dot"></span>
                  <span class="svc-subtab-label">Process</span>
                </button>
                <button type="button" onclick="setSubTab('proven')" id="subtab-btn-proven" class="svc-subtab-btn" role="tab" aria-selected="false" tabindex="-1" aria-controls="serviceDetailPanel">
                  <span class="svc-subtab-dot"></span>
                  <span class="svc-subtab-label">Results</span>
                </button>
              </div>

              <!-- Mobile Subtab Right Arrow (Column 3) -->
              <button type="button" class="svc-subtab-arrow svc-subtab-arrow-right" id="subtabRightBtn" aria-label="Next section" onclick="navigateSubtabCarousel('next')">
                <svg viewBox="0 0 24 24" fill="none" stroke="#0052FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;"><polyline points="9 18 15 12 9 6"></polyline></svg>
              </button>
            </div>
          </div>

          <!-- Sticky Start Project Card -->
          <div class="svc-sidebar-cta" id="sidebarCtaBox">
            <h4 id="sidebarCtaTitle">Have a Software Project in Mind?</h4>
            <p id="sidebarCtaDesc">Share your requirements with our team and explore a practical development approach for your business.</p>
            <a href="contact" class="svc-cta-btn">
              <span>Start Your Project</span>
              <span style="color:#FF6B00;margin-left:5px;font-weight:800;">&rarr;</span>
            </a>
          </div>
        </div>
      </aside>

      <!-- Right Column: Dynamic Content Pane (Pre-rendered for Instant Paint!) -->
      <main class="svc-content-col">
        <div id="serviceDetailPanel" class="svc-content-pane service-detail-transition" role="tabpanel" aria-labelledby="subtab-btn-overview">
          <!-- Pre-rendered Default Service: 01 Software Development -->
          <div style="padding-bottom:24px;margin-bottom:24px;border-bottom:1px solid #E2E8F0;">
            <div style="display:inline-flex;align-items:center;gap:6px;padding:4px 12px;background:#FFF3EB;border:1px solid #FFD8BE;border-radius:6px;color:#FF6B00;font-size:12px;font-weight:700;letter-spacing:0.04em;line-height:1;margin-bottom:12px;">
              <span>SERVICE 01 / 08</span>
            </div>
            <h3 style="font-size:clamp(30px, 3.2vw, 38px);font-weight:700;color:#0F172A;letter-spacing:-0.025em;margin:0 0 8px;line-height:1.2;">
              Software Development
            </h3>
            <p style="font-size:18px;font-weight:600;color:#0052FF;margin:0 0 12px;line-height:1.45;">Reliable Software Built Around Your Business</p>
            <p style="font-size:17px;color:#475569;line-height:1.65;margin:0;max-width:850px;">We design and develop secure scalable software solutions tailored to real business requirements. Our approach combines thoughtful architecture clean development practices and long-term maintainability to create software that remains dependable as your operations evolve.</p>
          </div>
          <div class="svc-cards-grid-2">
            <div class="svc-feature-card">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <span style="font-size:0.6875rem;font-weight:800;color:#0052FF;background:#EFF6FF;border:1px solid #DBEAFE;padding:3px 9px;border-radius:4px;text-transform:uppercase;letter-spacing:0.04em;">CUSTOM</span>
                <span style="width:8px;height:8px;border-radius:50%;background:#FF6B00;display:inline-block;"></span>
              </div>
              <h4>Business-Focused Solutions</h4>
              <p>Software designed around your workflows operational needs and long-term objectives.</p>
            </div>
            <div class="svc-feature-card">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <span style="font-size:0.6875rem;font-weight:800;color:#0052FF;background:#EFF6FF;border:1px solid #DBEAFE;padding:3px 9px;border-radius:4px;text-transform:uppercase;letter-spacing:0.04em;">SECURE</span>
                <span style="width:8px;height:8px;border-radius:50%;background:#FF6B00;display:inline-block;"></span>
              </div>
              <h4>Secure by Design</h4>
              <p>Authentication data protection access control and secure coding practices built into every development stage.</p>
            </div>
            <div class="svc-feature-card">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <span style="font-size:0.6875rem;font-weight:800;color:#0052FF;background:#EFF6FF;border:1px solid #DBEAFE;padding:3px 9px;border-radius:4px;text-transform:uppercase;letter-spacing:0.04em;">SCALABLE</span>
                <span style="width:8px;height:8px;border-radius:50%;background:#FF6B00;display:inline-block;"></span>
              </div>
              <h4>Growth-Ready Architecture</h4>
              <p>Flexible systems structured to support new features users integrations and changing business demands.</p>
            </div>
            <div class="svc-feature-card">
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <span style="font-size:0.6875rem;font-weight:800;color:#0052FF;background:#EFF6FF;border:1px solid #DBEAFE;padding:3px 9px;border-radius:4px;text-transform:uppercase;letter-spacing:0.04em;">MAINTAINABLE</span>
                <span style="width:8px;height:8px;border-radius:50%;background:#FF6B00;display:inline-block;"></span>
              </div>
              <h4>Clean and Sustainable Code</h4>
              <p>Well-structured documented code that remains easier to test improve and support over time.</p>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- TECH STACK SECTION: TECH ECOSYSTEM (Pre-rendered for Instant Paint!) -->
    <div class="svc-tech-section">
      <div class="svc-tech-header">
        <h3 style="font-size:clamp(1.35rem,2.4vw,1.85rem);font-weight:800;color:#0F172A;letter-spacing:-0.02em;margin:0 0 0.35rem;line-height:1.25;">
          Tech <span style="color:#0052FF;">Ecosystem</span>
        </h3>
        <p style="font-size:0.9rem;color:#475569;margin:0;line-height:1.5;">
          Technologies and platforms used for <strong style="color:#0F172A;" id="techStackServiceName">Software Development</strong> solutions.
        </p>
      </div>
      <div id="techStackGrid" class="svc-tech-grid">
        <!-- Pre-rendered Default Tech Ecosystem: Software Development -->
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><path fill="#5382A1" d="M46.7 91.5c-4.9.4-7.8.8-7.8.8s-3.5.3-7.5.5c-7.3.3-12.7.2-12.7.2s2.6-1.5 6.3-2.6c8.5-2.6 14.8-3.5 21.7 1.1M54.1 79.4c-6.8-5.3-15.6-5.8-24.3-3.6 0 0-1.7.5-2.5.8 0 0 1.5-.7 3.4-1.3 7.8-2.6 16.3-2.8 23.4 4.1M66.4 107.1c-14.7 1.2-31.9 1.1-42.3-.5-4.8-.7-9.5-2-9.5-2s3.2.7 7.7 1.1c16.3 1.5 32.8 1.4 44.1 1.4M69.7 114.7c-21.7 1.4-44.5 1-57.8-1.5 0 0-4.1-.8-6.7-1.7 0 0 2.2.9 6.2 1.5 17.5 2.5 38.6 2.3 58.3 1.7M83.4 97.4c-1.3 1.2-3.1 2.3-5.2 3.3-8.8 4.2-22.3 5.4-34.9 5.8-11.7.3-25.2-.2-33.8-3.4-3.1-1.1-5.7-2.6-5.7-2.6s2 .9 5.3 1.7c10.8 2.6 23.7 2.8 35.5 2.5 13.5-.4 28.5-1.9 38.8-7.3M85.7 122.3c-23.7 1.5-48.7 1.3-71.1-1.5-6.5-.8-13.4-2.5-13.4-2.5s4 1.1 9.8 1.7c22.5 2.3 47.9 2.5 74.7 2.3M48.5 28.5c4.7 5.4 3.7 10.9.1 16.8-4.2 6.8-8.1 13.7-4.7 20.3 1.7-4.7 3.8-8.9 7.8-13.4 5.3-6 5.8-11.4 2.8-16.7-2.3-4-4.8-6.7-6-7"/><path fill="#E76F00" d="M72.2 63.8c4.2 4.4 7.5 9.1 6.3 14.5-1.7 7.5-8.5 12.7-16 13.9 6-2.5 10.5-6.6 11.2-12.7.7-6.2-2.8-10.8-6.8-15-4.4-4.6-7.8-9.4-6.4-15.1 1.6-6.6 7.6-11.4 13.8-13.8-4.5 3.3-8.4 7.6-8.7 13.6-.3 6.3 2.9 10.7 6.6 14.6"/><path fill="#5382A1" d="M84.7 103.7s1.8-1.5 2.8-2.6c3.7-4.1 4.7-7.7 2.4-11.8-2.6-4.6-7.4-7.2-11.8-9.9-5.1-3.2-10.4-6.5-13.8-11.4-2.4-3.4-3.5-7.4-3.1-11.5-4 5.6-4.8 11.6-2 17.5 3 6.3 8.8 10.1 14.5 14.2 3.6 2.6 7.5 5.4 8.7 8.7 1.4 3.8-1.7 5.9-1.7 5.9 1.7-.3 3.1-.7 4-1.1M49.2 1.3c2.4 3 2.1 6.2.2 9.6-2.3 3.9-4.5 7.8-2.6 11.6 1-2.7 2.2-5.1 4.5-7.7 3-3.4 3.3-6.5 1.6-9.6-1.3-2.3-2.7-3.8-3.7-3.9"/></svg></div>
          <span class="svc-tech-name">Java</span>
        </div>
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><path fill="#9B4993" d="M64 5.3C31.6 5.3 5.3 31.6 5.3 64s26.3 58.7 58.7 58.7 58.7-26.3 58.7-58.7S96.4 5.3 64 5.3z"/><path fill="#FFF" d="M64 21.3c-23.6 0-42.7 19.1-42.7 42.7S40.4 106.7 64 106.7c15.8 0 29.6-8.6 37-21.3l-18.5-10.7c-3.7 6.4-10.6 10.7-18.5 10.7-11.8 0-21.3-9.5-21.3-21.3s9.5-21.3 21.3-21.3c7.9 0 14.8 4.3 18.5 10.7l18.5-10.7C93.6 29.9 79.8 21.3 64 21.3z"/><path fill="#FFF" d="M96 48v8h-8v8h8v8h-8v8h8v8h8v-8h8v-8h-8v-8h8v-8h-8v-8h-8zm16 16v8h-8v-8h8z"/></svg></div>
          <span class="svc-tech-name">C#</span>
        </div>
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><path fill="#3776AB" d="M63.7 5.5c-15.6 0-24.5 6.8-24.5 19.9v14.6h25.1v3.7H29.1c-13.7 0-23.6 8.3-23.6 24.5 0 16 9.8 24.3 23.6 24.3h7.6V81.3c0-8.9 7.7-16.3 16.7-16.3h25.4V39.9c0-13.6-11.1-24.4-24.7-24.4h-4.4zm-13.4 7.6a4.2 4.2 0 1 1 0 8.4 4.2 4.2 0 0 1 0-8.4z"/><path fill="#FFD43B" d="M64.3 122.5c15.6 0 24.5-6.8 24.5-19.9V88H63.7v-3.7h35.2c13.7 0 23.6-8.3 23.6-24.5 0-16-9.8-24.3-23.6-24.3h-7.6v11.2c0 8.9-7.7 16.3-16.7 16.3H49.2v25.1c0 13.6 11.1 24.4 24.7 24.4h4.4zm13.4-7.6a4.2 4.2 0 1 1 0-8.4 4.2 4.2 0 0 1 0 8.4z"/></svg></div>
          <span class="svc-tech-name">Python</span>
        </div>
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><path fill="#00599C" d="M64 5.3C31.6 5.3 5.3 31.6 5.3 64s26.3 58.7 58.7 58.7 58.7-26.3 58.7-58.7S96.4 5.3 64 5.3z"/><path fill="#FFF" d="M64 21.3c-23.6 0-42.7 19.1-42.7 42.7S40.4 106.7 64 106.7c15.8 0 29.6-8.6 37-21.3l-18.5-10.7c-3.7 6.4-10.6 10.7-18.5 10.7-11.8 0-21.3-9.5-21.3-21.3s9.5-21.3 21.3-21.3c7.9 0 14.8 4.3 18.5 10.7l18.5-10.7C93.6 29.9 79.8 21.3 64 21.3z"/><path fill="#FFF" d="M84 56h8v-8h8v8h8v8h-8v8h-8v-8h-8v-8zm24 0h8v-8h8v8h8v8h-8v8h-8v-8h-8v-8z"/></svg></div>
          <span class="svc-tech-name">C++</span>
        </div>
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><rect width="128" height="128" rx="16" fill="#3178C6"/><path fill="#FFF" d="M30 40h42v13H54v45H40V53H30V40zm47 27c0-3.3 2.7-5.5 6.7-5.5 3.5 0 6.6 1.7 8.3 3.6l6.8-7.7C95.5 54.3 90 52 83.2 52c-11.2 0-19.4 6.7-19.4 17.2 0 18.8 24.3 14.9 24.3 23.3 0 3.7-3.3 6-7.8 6-4.6 0-8.8-2.3-11.3-5.2l-7.2 8c4 4.5 10.8 7.2 18.2 7.2 12.3 0 20.8-7 20.8-17.7 0-19.3-24.8-15.6-24.8-23.8z"/></svg></div>
          <span class="svc-tech-name">TypeScript</span>
        </div>
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><path fill="#512BD4" d="M64 5.3C31.6 5.3 5.3 31.6 5.3 64s26.3 58.7 58.7 58.7 58.7-26.3 58.7-58.7S96.4 5.3 64 5.3z"/><path fill="#FFF" d="M38 78h-8V42h8l14 24V42h8v36h-8L38 54v24zm28 0h-8v-8h8v8zm16-28h-14v-8h36v8h-14v28h-8V50z"/></svg></div>
          <span class="svc-tech-name">.NET</span>
        </div>
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><path fill="#6DB33F" d="M117.4 57.6c-1.6-19.8-17.7-35.3-37.4-35.9-10.2-.3-19.8 3.5-27.1 10.1C45.6 25.2 36 21.4 25.8 21.7 6.1 22.3-10 37.8-11.6 57.6c-.8 9.9 2.4 19.6 8.8 26.9L64 122.7l66.8-38.2c6.4-7.3 9.6-17 8.8-26.9z"/><path fill="#FFF" d="M64 116.5L13.6 87.7c-5.5-6.3-8.3-14.6-7.6-23.1C7.4 47.6 21.2 34.3 38 33.8c8.7-.3 17 2.9 23.2 8.7L64 45l2.8-2.5c6.2-5.8 14.5-9 23.2-8.7 16.8.5 30.6 13.8 32 30.8.7 8.5-2.1 16.8-7.6 23.1L64 116.5z"/><path fill="#6DB33F" d="M52.3 84.7c-1.8 1.8-4.7 1.8-6.5 0l-12.8-12.8c-1.8-1.8-1.8-4.7 0-6.5s4.7-1.8 6.5 0l9.5 9.5 23.2-23.2c1.8-1.8 4.7-1.8 6.5 0s1.8 4.7 0 6.5L52.3 84.7z"/></svg></div>
          <span class="svc-tech-name">Spring Boot</span>
        </div>
        <div class="svc-tech-card">
          <div class="svc-tech-icon"><svg viewBox="0 0 128 128" width="36" height="36"><path fill="#F05032" d="M124.9 57.4L70.6 3.1c-4.1-4.1-10.8-4.1-14.9 0L39.9 18.9l18.9 18.9c4.4-1.5 9.5-.5 13 2.9 3.5 3.5 4.5 8.7 2.9 13.2l18.2 18.2c4.4-1.6 9.6-.6 13.1 2.9 4.9 4.9 4.9 12.8 0 17.7s-12.8 4.9-17.7 0c-3.7-3.7-4.6-9.2-2.7-13.8L68.2 61.3v28.8c1.3 1 2.3 2.3 3 3.9 3.1 6.3.5 13.9-5.8 17-6.3 3.1-13.9.5-17-5.8-3.1-6.3-.5-13.9 5.8-17 1.9-.9 4-1.4 6.1-1.4V57.6c-2.1 0-4.2-.5-6.1-1.4-4.6-2.3-7.3-7.2-6.7-12.3L28.7 24.9 3.1 50.5c-4.1 4.1-4.1 10.8 0 14.9l54.3 54.3c4.1 4.1 10.8 4.1 14.9 0l52.6-52.6c4.1-4.1 4.1-10.8 0-14.9z"/></svg></div>
          <span class="svc-tech-name">Git</span>
        </div>
      </div>
    </div>

  </div>
</section>
