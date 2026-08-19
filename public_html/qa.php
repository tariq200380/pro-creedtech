<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "QA & Software Testing Services | Creed Tech";
$page_description = "Comprehensive automated and manual software QA testing services. Zero regressions, API testing, load testing, and CI/CD quality gates.";
$active_page = "qa";

include __DIR__ . '/includes/header.php';
?>

<!-- ======= QA Hero ======= -->
<section class="hero-wrapper">
  <div class="creed-container">
    <div class="hero-grid">
      
      <div class="hero-content">
        <span class="section-tag section-tag-accent"><i class="bi bi-shield-check"></i> Quality Engineering</span>
        <h1>QA & Automated <span class="highlight">Software Testing</span></h1>
        <p class="hero-lead">
          We guarantee bug-free deployments, flawless user journeys, and robust system stability through rigorous manual testing and modern test automation frameworks.
        </p>
        <div class="hero-actions">
          <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-patch-check-fill"></i> Request QA Audit</a>
          <a href="#qa-services" class="btn-creed btn-creed-outline"><i class="bi bi-chevron-down"></i> QA Capabilities</a>
        </div>
      </div>

      <div class="hero-img-container">
        <img src="assets/img/service.webp" alt="QA Testing Services" onerror="this.src='assets/img/hero_img.webp'">
      </div>

    </div>
  </div>
</section>

<!-- ======= QA Capabilities ======= -->
<section class="creed-section" id="qa-services">
  <div class="creed-container">
    
    <div class="text-center" style="text-align: center;">
      <span class="section-tag"><i class="bi bi-bug-fill"></i> Zero-Regression Assurance</span>
      <h2 class="section-title">Comprehensive <span>QA</span> Services</h2>
      <p class="section-subtitle">
        Proactively catching regressions, security leaks, and edge-case errors before your users ever encounter them.
      </p>
    </div>

    <div class="bento-grid">
      
      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-robot"></i></div>
          <h3>Automated End-to-End Testing</h3>
          <p>Writing robust automated test suites with Playwright, Cypress, and Selenium that validate entire user flows automatically on every build.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-hdd-network-fill"></i></div>
          <h3>API & Contract Testing</h3>
          <p>Automating REST and GraphQL contract validations to ensure payload compliance, status code accuracy, and seamless integration between frontend and backend.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-activity"></i></div>
          <h3>Load & Performance Testing</h3>
          <p>Simulating thousands of concurrent user sessions with k6 and JMeter to evaluate latency, memory leaks, and bottleneck thresholds.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-display"></i></div>
          <h3>Cross-Browser & Device Compatibility</h3>
          <p>Testing across all major desktop browsers and mobile operating systems to guarantee consistent visual rendering and touch interactions.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-shield-shaded"></i></div>
          <h3>Security & Penetration Testing</h3>
          <p>Auditing authorization rules, input sanitization, token expiration, and CSRF/XSS vectors to prevent unauthorized data exposure.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-git"></i></div>
          <h3>CI/CD Quality Gates</h3>
          <p>Integrating automated test pipelines into GitHub Actions / GitLab CI so failing builds are blocked before reaching production.</p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======= CTA Section ======= -->
<section class="creed-section" style="background-color: var(--color-slate-50);">
  <div class="creed-container text-center" style="text-align: center;">
    <h2 class="section-title">Ensure Your Code is <span>Production-Ready</span></h2>
    <p class="section-subtitle">Partner with our dedicated QA automation engineers for peace of mind.</p>
    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
      <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-check2-circle"></i> Hire QA Squad</a>
      <a href="services" class="btn-creed btn-creed-outline"><i class="bi bi-grid"></i> All Services</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>