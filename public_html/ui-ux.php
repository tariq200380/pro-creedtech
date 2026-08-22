<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "UI / UX Product Design Services | Creed Tech";
$page_description = "User-centered UI/UX design, Figma wireframing, high-fidelity prototypes, design systems, and conversion-optimized interfaces.";
$active_page = "ui-ux";

include __DIR__ . '/includes/header.php';
?>

<!-- ======= UI/UX Hero ======= -->
<section class="hero-wrapper">
  <div class="creed-container">
    <div class="hero-grid">
      
      <div class="hero-content">
        <span class="section-tag section-tag-accent"><i class="bi bi-palette-fill"></i> Product Experience</span>
        <h1>Intuitive & High-Converting <span class="highlight">UI / UX</span> Design</h1>
        <p class="hero-lead">
          We craft beautiful, accessible, and human-centered digital experiences that make complex software feel effortless, engaging, and memorable.
        </p>
        <div class="hero-actions">
          <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-brush"></i> Start UI/UX Project</a>
          <a href="#design-process" class="btn-creed btn-creed-outline"><i class="bi bi-chevron-down"></i> Design Capabilities</a>
        </div>
      </div>

      <div class="hero-img-container">
        <img src="assets/img/features.webp" alt="UI UX Design" width="700" height="525" fetchpriority="high" decoding="async" onerror="this.src='assets/img/hero_img.webp'">
      </div>

    </div>
  </div>
</section>

<!-- ======= UI/UX Capabilities ======= -->
<section class="creed-section" id="design-process">
  <div class="creed-container">
    
    <div class="text-center" style="text-align: center;">
      <span class="section-tag"><i class="bi bi-layout-text-window-reverse"></i> Human-Centered Design</span>
      <h2 class="section-title">Our UI / UX <span>Design Services</span></h2>
      <p class="section-subtitle">
        Bridging the gap between user psychology, aesthetic beauty, and engineering feasibility.
      </p>
    </div>

    <div class="bento-grid">
      
      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-bezier2"></i></div>
          <h3>User Research & Journey Mapping</h3>
          <p>Uncovering real user motivations, mapping interaction workflows, and eliminating cognitive friction points across user journeys.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-columns-gap"></i></div>
          <h3>Wireframing & Information Architecture</h3>
          <p>Structuring clean layout hierarchies, intuitive content categorization, and low-fidelity prototypes for rapid iteration.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-palette"></i></div>
          <h3>Figma Design Systems & Token Systems</h3>
          <p>Building comprehensive, component-based design systems with modular typography, color tokens, and responsive UI kits.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-phone-flip"></i></div>
          <h3>Interactive High-Fidelity Prototypes</h3>
          <p>Clickable, realistic prototypes with smooth micro-interactions that validate concepts with stakeholders before code is written.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-universal-access"></i></div>
          <h3>Accessibility & WCAG Compliance</h3>
          <p>Designing interfaces that meet WCAG 2.1 AA standards with high color contrast, screen reader compatibility, and clear focus states.</p>
        </div>
      </div>

      <div class="bento-card">
        <div>
          <div class="bento-icon"><i class="bi bi-code-square"></i></div>
          <h3>Design-to-Code Engineering Handoff</h3>
          <p>Providing developers with pixel-perfect asset specs, CSS variables, and layout guidelines for seamless frontend implementation.</p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======= CTA Section ======= -->
<section class="creed-section" style="background-color: var(--color-slate-50);">
  <div class="creed-container text-center" style="text-align: center;">
    <h2 class="section-title">Elevate Your <span>Product Experience</span></h2>
    <p class="section-subtitle">Let our senior product designers review your app or website for conversion and usability improvements.</p>
    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 16px; flex-wrap: wrap;">
      <a href="contact" class="btn-creed btn-creed-accent"><i class="bi bi-palette2"></i> Book UI/UX Consultation</a>
      <a href="services" class="btn-creed btn-creed-outline"><i class="bi bi-grid"></i> All Services</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>