<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "Custom Software Development | Creed Tech";
$page_description = "Bespoke web and mobile software development services. Full-stack engineering with modern React, Next.js, Node, PHP, Python, and Flutter.";
$active_page = "software-development";

include __DIR__ . '/includes/header.php';
?>

<!-- ======= Service Detail Hero ======= -->
<section class="hero-wrapper">
  <div class="creed-container">
    <div class="hero-grid">
      
      <div class="hero-content">
        <span class="section-tag section-tag-accent"><i class="bi bi-code-square"></i> Core Engineering</span>
        <h1>High-Performance <span class="highlight">Software</span> Development</h1>
        <p class="hero-lead">
          We translate ambitious concepts into robust, scalable, and mission-critical web and mobile applications using modern frameworks and clean architecture.
        </p>
        <div class="hero-actions">
          <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-rocket-takeoff-fill"></i> Start Your Project</a>
          <a href="#solutions" class="btn-creed btn-creed-outline"><i class="bi bi-chevron-down"></i> Explore Capabilities</a>
        </div>
      </div>

      <div class="hero-img-container">
        <img src="assets/img/web-service.webp" alt="Software Development" width="700" height="467" fetchpriority="high" decoding="async" onerror="this.src='assets/img/hero_img.webp'">
      </div>

    </div>
  </div>
</section>

<!-- ======= Detailed Capabilities ======= -->
<section class="creed-section" id="solutions">
  <div class="creed-container">
    
    <div class="text-center" style="text-align: center;">
      <span class="section-tag"><i class="bi bi-layers-half"></i> What We Build</span>
      <h2 class="section-title">End-to-End <span>Application</span> Capabilities</h2>
      <p class="section-subtitle">
        Custom engineering tailored for high throughput, seamless user experiences, and maintainable codebases.
      </p>
    </div>

    <div class="bento-grid">
      
      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-globe"></i></div>
          <h3>Enterprise Web Applications</h3>
          <p>Custom SaaS platforms, customer portals, and internal tools engineered with modern frontend reactivity and bulletproof backend architecture.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-phone"></i></div>
          <h3>Cross-Platform Mobile Apps</h3>
          <p>Native-grade iOS and Android mobile apps built with Flutter and React Native for unified codebases and rapid time-to-market.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-hdd-network"></i></div>
          <h3>REST & GraphQL API Backends</h3>
          <p>High-throughput API microservices engineered for secure third-party integrations, webhook handling, and real-time data sync.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-cart-check"></i></div>
          <h3>E-Commerce & Payment Gateways</h3>
          <p>Custom Shopify Plus applications, headless commerce systems, and secure PCI-compliant Stripe/PayPal payment workflows.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-arrow-repeat"></i></div>
          <h3>Legacy System Modernization</h3>
          <p>Refactoring dated monolithic applications into modern, modular microservices without disrupting live production traffic.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-shield-check"></i></div>
          <h3>Security & Code Auditing</h3>
          <p>Comprehensive code audits, vulnerability mitigation (OWASP Top 10), and strict static analysis to ensure enterprise reliability.</p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======= CTA Section ======= -->
<section class="creed-section" style="background-color: var(--color-slate-50);">
  <div class="creed-container text-center" style="text-align: center;">
    <h2 class="section-title">Ready to Engineer Your <span>Software</span>?</h2>
    <p class="section-subtitle">Connect with our senior technical architects to discuss specifications, architecture, and timelines.</p>
    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
      <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-calendar-check"></i> Schedule Free Consultation</a>
      <a href="services" class="btn-creed btn-creed-outline"><i class="bi bi-grid"></i> All Services</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>