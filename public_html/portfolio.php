<?php
$page_title = "Enterprise Case Studies & Delivered Systems | Creed Tech";
$page_description = "Explore real-world software architecture deployments, high-concurrency systems, and digital transformations delivered by Creed Tech.";
$active_page = "portfolio";

$portfolioFile = __DIR__ . '/data/portfolio_projects.json';
$portfolioData = file_exists($portfolioFile) ? (json_decode(file_get_contents($portfolioFile), true) ?: []) : [];

$standards = $portfolioData['standards_showcase'] ?? [
    'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&auto=format&fit=crop&q=80',
    'badge' => 'ENGINEERING CULTURE',
    'overlay_title' => '100% Principal Engineer Led',
    'overlay_subtitle' => 'Zero junior outsourcing. Full accountability.',
    'overlay_tag' => 'Verified SLA',
    'tagline' => 'HOW WE GUARANTEE SUCCESS',
    'title' => 'Built on Rigorous Enterprise Standards',
    'description' => 'Every case study in our portfolio is the direct outcome of disciplined architectural principles, continuous automated verification, and zero-compromise security controls.'
];

$projectsList = $portfolioData['projects'] ?? [];

include __DIR__ . '/includes/header.php';
?>

<style>
/* =========================================================================
   PORTFOLIO PAGE DESIGN SYSTEM (DESKTOP FIRST + DEDICATED MOBILE OVERRIDES)
   ========================================================================= */

.portfolio-page {
  width: 100%;
  background: #FAFAFC;
  color: #111827;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  text-align: left;
  overflow-x: hidden;
}

.portfolio-container {
  width: 100%;
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 2rem;
  box-sizing: border-box;
}

/* 1. Hero Section (Desktop Spacious & Grand - Center Aligned) */
.pf-hero-section {
  width: 100%;
  background: #070D1E;
  color: #fff;
  padding: 5.5rem 0 6.5rem;
  position: relative;
  overflow: hidden;
  border-bottom: 1px solid #1F2937;
  text-align: center;
}
.pf-hero-title {
  font-size: clamp(2.25rem, 4vw, 3.25rem);
  font-weight: 700;
  letter-spacing: -0.03em;
  color: #fff;
  margin: 0 auto 1rem;
  line-height: 1.2;
  text-align: center;
}
.pf-hero-desc {
  font-size: clamp(0.95rem, 1.5vw, 1.05rem);
  color: #D1D5DB;
  line-height: 1.7;
  font-weight: 400;
  margin: 0 auto 2.5rem;
  max-width: 48rem;
  text-align: center;
}
.pf-hero-metrics {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  padding-top: 2rem;
  border-top: 1px solid rgba(255,255,255,0.12);
  text-align: center;
  max-width: 56rem;
  margin: 0 auto;
}

/* 2. Engineering Standards (Desktop 5fr 7fr) */
.pf-standards-section {
  width: 100%;
  padding: 5.5rem 0;
  background: #F4F6FA;
  border-bottom: 1px solid #E5E7EB;
  color: #111827;
}
.pf-standards-grid {
  display: grid;
  grid-template-columns: 5fr 7fr;
  gap: 3.5rem;
  align-items: center;
  width: 100%;
}
.pf-pillars-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.25rem;
  width: 100%;
}

/* 3. Case Studies Showcase (Desktop 1fr 1fr Side-by-Side) */
.pf-cases-section {
  width: 100%;
  padding: 5.5rem 0;
  background: #fff;
  border-bottom: 1px solid #E5E7EB;
}
.pf-case-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3.5rem;
  align-items: center;
  width: 100%;
}
.pf-metrics-strip {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
  text-align: center;
}

/* 4. CTA Banner (Desktop) */
.pf-cta-section {
  width: 100%;
  background: #0B1120;
  padding: 4.5rem 0;
  color: #fff;
  text-align: center;
  position: relative;
  overflow: hidden;
  border-top: 1px solid #1F2937;
}

/* =========================================================================
   MOBILE ONLY OVERRIDES (Max-Width 768px) - Keeps Desktop Perfectly Intact
   ========================================================================= */
@media (max-width: 768px) {
  .portfolio-container {
    padding: 0 1.25rem;
  }

  /* Hero */
  .pf-hero-section {
    padding: 2.75rem 0 3rem;
  }
  .pf-hero-title {
    font-size: clamp(1.5rem, 5.5vw, 2.15rem);
    margin-bottom: 0.6rem;
  }
  .pf-hero-desc {
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }
  .pf-hero-metrics {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    padding-top: 1.25rem;
  }

  /* Standards */
  .pf-standards-section {
    padding: 2.5rem 0;
  }
  .pf-standards-grid {
    grid-template-columns: 1fr;
    gap: 1.75rem;
  }
  .pf-pillars-grid {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }

  /* Case Studies (Stack 1-col: Text on Top, Image Below) */
  .pf-cases-section {
    padding: 2.75rem 0;
  }
  .pf-cases-container {
    gap: 3rem !important;
  }
  .pf-case-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  .pf-metrics-strip {
    grid-template-columns: repeat(3, 1fr);
    gap: 6px;
    padding: 0.65rem 0.75rem !important;
  }

  /* CTA */
  .pf-cta-section {
    padding: 2.75rem 0;
  }
}
</style>

<div class="portfolio-page">
  
  <!-- 1. HERO BANNER (CENTER ALIGNED) -->
  <section class="pf-hero-section">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 30%, rgba(0, 102, 255, 0.25) 0%, transparent 65%), radial-gradient(circle at 50% 80%, rgba(255, 107, 0, 0.12) 0%, transparent 60%);"></div>
    <div style="position:absolute;inset:0;opacity:0.15;pointer-events:none;background-image:linear-gradient(to right, rgba(0, 150, 255, 0.2) 1px, transparent 1px), linear-gradient(to bottom, rgba(0, 150, 255, 0.2) 1px, transparent 1px);background-size:40px 40px;"></div>

    <div class="portfolio-container" style="position:relative;z-index:10;">
      <div style="max-width:54rem;margin:0 auto;text-align:center;">
        
        <!-- Pulse Badge -->
        <div style="display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:4px 14px;background:rgba(255,255,255,0.1);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.15);color:#FF6B00;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1rem;border-radius:2px;">
          <span style="width:6px;height:6px;background:#FF6B00;border-radius:50%;display:inline-block;"></span>
          FLAGSHIP CASE STUDIES &amp; PROVEN ARCHITECTURES
        </div>

        <h1 class="pf-hero-title">
          Architectural Mastery. <br />
          <span style="color:#00A3FF;">Proven Business Impact.</span>
        </h1>

        <p class="pf-hero-desc">
          Deep architectural case studies documenting how Creed Tech engineers mission-critical infrastructure, multi-region database replication, private LLMs, and enterprise security platforms.
        </p>

        <!-- Quick Hero Metrics Bar (Center Aligned) -->
        <div class="pf-hero-metrics">
          <div style="text-align:center;">
            <span style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:700;color:#fff;display:block;line-height:1.1;">120+</span>
            <span style="font-size:11px;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;font-weight:600;display:block;margin-top:4px;">Enterprise Projects</span>
          </div>
          <div style="text-align:center;">
            <span style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:700;color:#00A3FF;display:block;line-height:1.1;">$450M+</span>
            <span style="font-size:11px;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;font-weight:600;display:block;margin-top:4px;">Transactions Secured</span>
          </div>
          <div style="text-align:center;">
            <span style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:700;color:#FF6B00;display:block;line-height:1.1;">99.99%</span>
            <span style="font-size:11px;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;font-weight:600;display:block;margin-top:4px;">Historical Uptime</span>
          </div>
          <div style="text-align:center;">
            <span style="font-size:clamp(1.5rem,2.5vw,2.25rem);font-weight:700;color:#fff;display:block;line-height:1.1;">0 Defect</span>
            <span style="font-size:11px;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;font-weight:600;display:block;margin-top:4px;">SLA Guarantee</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 2. UNIQUE ENGINEERING STANDARDS & EXECUTION SHOWCASE WITH PICTURE -->
  <section class="pf-standards-section">
    <div class="portfolio-container">
      <div class="pf-standards-grid">
        
        <!-- Left: High-Tech Engineering & DevOps Picture -->
        <div style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 15px 25px -5px rgba(0,0,0,0.08);border:1px solid #E5E7EB;width:100%;">
          <div style="width:100%;height:320px;position:relative;background:#0F172A;" class="sm:h-[380px] lg:h-[440px]">
            <img src="<?= htmlspecialchars($standards['image'] ?? 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&auto=format&fit=crop&q=80') ?>" alt="Creed Tech Senior Engineering Team" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.3) 50%, transparent);pointer-events:none;"></div>
            
            <!-- Top Badge -->
            <div style="position:absolute;top:1rem;left:1rem;">
              <span style="padding:4px 10px;background:#0052FF;color:#fff;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,0.2);">
                <?= htmlspecialchars($standards['badge'] ?? 'ENGINEERING CULTURE') ?>
              </span>
            </div>

            <!-- Floating Metric Card Overlay -->
            <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);padding:1rem 1.25rem;border-radius:10px;border:1px solid #E5E7EB;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);text-align:left;">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                <div>
                  <span style="font-size:13px;font-weight:700;color:#030712;display:block;"><?= htmlspecialchars($standards['overlay_title'] ?? '100% Principal Engineer Led') ?></span>
                  <span style="font-size:11px;color:#6B7280;font-weight:500;"><?= htmlspecialchars($standards['overlay_subtitle'] ?? 'Zero junior outsourcing. Full accountability.') ?></span>
                </div>
                <span style="padding:4px 10px;background:#DCFCE7;color:#166534;font-size:11px;font-weight:700;border-radius:2px;">
                  <?= htmlspecialchars($standards['overlay_tag'] ?? 'Verified SLA') ?>
                </span>
              </div>
            </div>

          </div>
        </div>

        <!-- Right: Engineering Standards & Execution Pillars -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.5rem;width:100%;">
          <div>
            <div style="display:inline-flex;align-items:center;gap:6px;padding:3px 10px;background:#fff;border:1px solid #D1D5DB;color:#0052FF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.75rem;border-radius:2px;">
              <span style="width:5px;height:5px;background:#0052FF;display:inline-block;border-radius:50%;"></span>
              <?= htmlspecialchars($standards['tagline'] ?? 'HOW WE GUARANTEE SUCCESS') ?>
            </div>

            <h2 style="font-size:clamp(1.6rem, 3vw, 2.35rem);font-weight:700;color:#030712;letter-spacing:-0.02em;line-height:1.25;margin:0 0 0.6rem;">
              <?= htmlspecialchars($standards['title'] ?? 'Built on Rigorous Enterprise Standards') ?>
            </h2>

            <p style="font-size:14px;color:#4B5563;line-height:1.65;margin:0;">
              <?= htmlspecialchars($standards['description'] ?? 'Every case study in our portfolio is the direct outcome of disciplined architectural principles, continuous automated verification, and zero-compromise security controls.') ?>
            </p>
          </div>

          <!-- 4 Pillars Grid -->
          <div class="pf-pillars-grid">
            
            <div style="padding:1.15rem 1.25rem;background:#fff;border-radius:10px;border:1px solid #E5E7EB;box-shadow:0 1px 3px rgba(0,0,0,0.04);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">⚡</span>
                <h4 style="font-size:13.5px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Contractual 99.99% SLA</h4>
              </div>
              <p style="font-size:12px;color:#4B5563;line-height:1.55;margin:0;">Every milestone backed by contractual latency and uptime guarantees.</p>
            </div>

            <div style="padding:1.15rem 1.25rem;background:#fff;border-radius:10px;border:1px solid #E5E7EB;box-shadow:0 1px 3px rgba(0,0,0,0.04);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">🛡️</span>
                <h4 style="font-size:13.5px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Cryptographic Zero-Trust</h4>
              </div>
              <p style="font-size:12px;color:#4B5563;line-height:1.55;margin:0;">Automated mTLS encryption, isolated VPC boundaries, and immutable audit logs.</p>
            </div>

            <div style="padding:1.15rem 1.25rem;background:#fff;border-radius:10px;border:1px solid #E5E7EB;box-shadow:0 1px 3px rgba(0,0,0,0.04);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">👨‍💻</span>
                <h4 style="font-size:13.5px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Dedicated Senior Pods</h4>
              </div>
              <p style="font-size:12px;color:#4B5563;line-height:1.55;margin:0;">Direct collaboration with senior principal architects with daily Git commits.</p>
            </div>

            <div style="padding:1.15rem 1.25rem;background:#fff;border-radius:10px;border:1px solid #E5E7EB;box-shadow:0 1px 3px rgba(0,0,0,0.04);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">🚀</span>
                <h4 style="font-size:13.5px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Zero-Downtime Releases</h4>
              </div>
              <p style="font-size:12px;color:#4B5563;line-height:1.55;margin:0;">Automated CI/CD staging with instant multi-region failover and 100% test coverage.</p>
            </div>

          </div>

          <!-- Bottom Quote & Action -->
          <div style="padding-top:0.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;border-top:1px solid #E5E7EB;">
            <p style="font-size:12.5px;color:#6B7280;font-style:italic;margin:0;">
              &ldquo;Quality is not an afterthought; it is contractually engineered into our foundations.&rdquo;
            </p>
            <a href="contact" style="font-size:12.5px;font-weight:700;color:#0052FF;text-decoration:none;display:inline-flex;align-items:center;gap:4px;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
              <span>Request Technical Scoping &rarr;</span>
            </a>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- 3. DYNAMIC CASE STUDIES SHOWCASE SECTION -->
  <section class="pf-cases-section">
    <div class="portfolio-container pf-cases-container" style="display:flex;flex-direction:column;gap:5rem;">
      
      <?php if (empty($projectsList)): ?>
        <div style="text-align:center;padding:4rem 1rem;color:#64748B;">
          <p style="font-size:1.1rem;margin:0;">No portfolio case studies published yet.</p>
        </div>
      <?php else: ?>
        <?php foreach ($projectsList as $idx => $proj): 
          $pId = $proj['id'] ?? ('case-' . ($idx + 1));
          $pNum = $proj['number'] ?? sprintf('%02d', $idx + 1);
          $dotColor = ($idx % 3 === 0) ? '#0052FF' : (($idx % 3 === 1) ? '#FF6B00' : '#10B981');
        ?>
        <div class="pf-case-grid">
          
          <!-- Text Detail Column (Always Left / First) -->
          <div style="text-align:left;display:flex;flex-direction:column;gap:1.25rem;width:100%;">
            <div style="display:flex;align-items:center;gap:6px;">
              <span style="width:6px;height:6px;background:<?= $dotColor ?>;display:inline-block;border-radius:50%;"></span>
              <span style="font-size:11.5px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;color:#6B7280;"><?= htmlspecialchars($proj['category'] ?? 'Enterprise Systems') ?></span>
            </div>

            <h3 style="font-size:clamp(1.4rem,2.5vw,1.9rem);font-weight:700;color:#030712;letter-spacing:-0.02em;line-height:1.3;margin:0;">
              <?= htmlspecialchars($proj['title'] ?? '') ?>
            </h3>

            <p style="font-size:14px;color:#374151;line-height:1.65;margin:0;">
              <?= htmlspecialchars($proj['description'] ?? '') ?>
            </p>

            <!-- 3 Impact Metrics Row -->
            <div class="pf-metrics-strip" style="padding:1rem 1.25rem;background:#F2F8FD;border-radius:10px;border:1px solid #BFDBFE;">
              <div>
                <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;"><?= htmlspecialchars($proj['metric1_val'] ?? '100%') ?></span>
                <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;"><?= htmlspecialchars($proj['metric1_label'] ?? 'Impact') ?></span>
              </div>
              <div>
                <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;"><?= htmlspecialchars($proj['metric2_val'] ?? '99.9%') ?></span>
                <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;"><?= htmlspecialchars($proj['metric2_label'] ?? 'Efficiency') ?></span>
              </div>
              <div>
                <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;"><?= htmlspecialchars($proj['metric3_val'] ?? '0 Defect') ?></span>
                <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;"><?= htmlspecialchars($proj['metric3_label'] ?? 'Uptime SLA') ?></span>
              </div>
            </div>

            <!-- Tech Stack Chips -->
            <div>
              <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Architectural Stack:</span>
              <div style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;">
                <?php 
                  $stack = is_array($proj['tech_stack'] ?? null) ? $proj['tech_stack'] : explode(',', $proj['tech_stack'] ?? '');
                  foreach ($stack as $tech):
                    $tech = trim($tech);
                    if (empty($tech)) continue;
                ?>
                  <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;"><?= htmlspecialchars($tech) ?></span>
                <?php endforeach; ?>
              </div>
            </div>

            <div style="padding-top:0.25rem;">
              <button onclick="openCaseModal('<?= htmlspecialchars($pId) ?>')" class="btn-dark" style="padding:10px 22px;font-size:12.5px;text-transform:uppercase;letter-spacing:0.05em;border-radius:3px;">
                <span>Explore Case Study Deep-Dive</span>
              </button>
            </div>
          </div>

          <!-- Image Column (Always Right / Second) -->
          <div onclick="openCaseModal('<?= htmlspecialchars($pId) ?>')" style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.08);border:1px solid #E5E7EB;background:#030712;cursor:pointer;width:100%;">
            <div style="width:100%;height:260px;position:relative;" class="sm:h-[340px] lg:h-[400px]">
              <img src="<?= htmlspecialchars($proj['image'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars($proj['title'] ?? 'Case Study') ?>" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
              <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2) 50%, transparent);pointer-events:none;"></div>
              
              <div style="position:absolute;top:1rem;left:1rem;display:flex;align-items:center;gap:6px;">
                <span style="width:1.85rem;height:1.85rem;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);color:#fff;font-weight:700;font-size:11.5px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);border-radius:2px;"><?= htmlspecialchars($pNum) ?></span>
                <span style="padding:4px 12px;background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);color:#111827;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.1);"><?= htmlspecialchars($proj['badge_category'] ?? $proj['category'] ?? 'Case Study') ?></span>
              </div>

              <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;color:rgba(255,255,255,0.95);font-size:12.5px;font-weight:600;backdrop-filter:blur(8px);background:rgba(0,0,0,0.6);padding:8px 14px;border-radius:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                <?= htmlspecialchars($proj['client_location'] ?? ('🏢 ' . ($proj['client'] ?? 'Global Client'))) ?>
              </div>
            </div>
          </div>

        </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </section>

  <!-- 4. MODAL: DETAILED ARCHITECTURAL CASE STUDY VIEW -->
  <div id="caseStudyModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);backdrop-filter:blur(6px);z-index:9999;align-items:center;justify-content:center;padding:1rem;">
    <div style="background:#fff;color:#111827;border:1px solid #E5E7EB;border-radius:1rem;padding:1.75rem;max-width:38rem;width:100%;max-height:90vh;overflow-y:auto;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);position:relative;text-align:left;">
      
      <button onclick="closeCaseModal()" style="position:absolute;top:1rem;right:1rem;width:2.25rem;height:2.25rem;border-radius:50%;background:#F3F4F6;border:none;color:#4B5563;font-weight:700;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">✕</button>

      <div style="margin-bottom:1rem;padding-right:2rem;">
        <span id="modalCategoryTag" style="font-size:11.5px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">CASE 01 • Fintech &amp; Banking</span>
        <h3 id="modalTitle" style="font-size:1.35rem;font-weight:700;color:#030712;letter-spacing:-0.02em;line-height:1.3;margin:0;">Project Title</h3>
      </div>

      <div id="modalMetricsBox" class="pf-metrics-strip" style="padding:1rem 1.25rem;background:#F2F8FD;border-radius:10px;border:1px solid #BFDBFE;margin-bottom:1.5rem;text-align:center;">
        <!-- Injected via JS -->
      </div>

      <div style="display:flex;flex-direction:column;gap:1rem;margin-bottom:1.5rem;">
        <div style="padding:1rem 1.25rem;border-radius:10px;background:#F9FAFB;border:1px solid #F3F4F6;">
          <h4 style="font-size:11px;font-weight:800;color:#DC2626;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 4px;">The Engineering Challenge</h4>
          <p id="modalChallenge" style="font-size:13px;color:#374151;line-height:1.6;margin:0;"></p>
        </div>

        <div style="padding:1rem 1.25rem;border-radius:10px;background:#F0FDF4;border:1px solid #DCFCE7;">
          <h4 style="font-size:11px;font-weight:800;color:#15803D;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 4px;">Creed Tech Architectural Solution</h4>
          <p id="modalSolution" style="font-size:13px;color:#374151;line-height:1.6;margin:0;"></p>
        </div>
      </div>

      <div style="margin-bottom:1.5rem;">
        <h4 style="font-size:11px;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;margin:0 0 8px;">Technologies &amp; Frameworks Deployed:</h4>
        <div id="modalTechChips" style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;"></div>
      </div>

      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;padding-top:1rem;border-top:1px solid #F3F4F6;">
        <button onclick="closeCaseModal()" style="background:transparent;border:none;padding:8px 14px;font-size:12.5px;font-weight:600;color:#6B7280;cursor:pointer;">Close Breakdown</button>
        <a href="contact" class="btn-orange" style="padding:10px 20px;font-size:12.5px;text-transform:uppercase;letter-spacing:0.05em;">Request Architecture Session &rarr;</a>
      </div>

    </div>
  </div>

  <!-- 5. CLIENT ENGAGEMENT CTA BANNER -->
  <section class="pf-cta-section">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 50%, rgba(0, 102, 255, 0.22) 0%, transparent 65%);"></div>
    <div class="portfolio-container" style="position:relative;max-width:50rem;margin:0 auto;z-index:10;display:flex;flex-direction:column;align-items:center;gap:1rem;">
      <span style="font-size:11px;font-weight:700;color:#FF6B00;text-transform:uppercase;letter-spacing:0.05em;">HAVE AN AMBITIOUS ENGINEERING INITIATIVE?</span>
      <h2 style="font-size:clamp(1.6rem,3vw,2.35rem);font-weight:700;color:#fff;letter-spacing:-0.02em;margin:0;">Let's Build Your Next High-Performance Platform</h2>
      <p style="font-size:14px;color:#D1D5DB;max-width:38rem;margin:0;line-height:1.65;font-weight:400;">Schedule a confidential sprint architecture consultation with our principal software architects.</p>
      <div style="padding-top:0.5rem;">
        <a href="contact" class="btn-blue" style="height:46px;padding:0 28px;font-size:13px;text-transform:uppercase;letter-spacing:0.05em;border-radius:4px;">Start Technical Scoping</a>
      </div>
    </div>
  </section>

</div>

<!-- JAVASCRIPT: Dynamic Modal Controller -->
<script>
var CASE_STUDIES = <?= json_encode(!empty($projectsList) ? array_combine(array_column($projectsList, 'id'), $projectsList) : new stdClass(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

function openCaseModal(caseId) {
  var study = CASE_STUDIES[caseId];
  if (!study) return;

  var categoryTag = study.badge_category || study.category || 'Case Study';
  var client = study.client_location || study.client || 'Enterprise Partner';
  var num = study.number || '01';

  document.getElementById('modalCategoryTag').textContent = 'CASE ' + num + ' • ' + categoryTag + ' (' + client.replace(/^[^\w\s]+/, '').trim() + ')';
  document.getElementById('modalTitle').textContent = study.title || '';
  document.getElementById('modalChallenge').textContent = study.challenge || study.description || '';
  document.getElementById('modalSolution').textContent = study.solution || study.description || '';

  var metricsHtml = '';
  if (study.metric1_val) {
    metricsHtml += '<div><span style="font-size:1.2rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">' + study.metric1_val + '</span><span style="font-size:9.5px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' + (study.metric1_label || 'Impact') + '</span></div>';
  }
  if (study.metric2_val) {
    metricsHtml += '<div><span style="font-size:1.2rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">' + study.metric2_val + '</span><span style="font-size:9.5px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' + (study.metric2_label || 'Efficiency') + '</span></div>';
  }
  if (study.metric3_val) {
    metricsHtml += '<div><span style="font-size:1.2rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">' + study.metric3_val + '</span><span style="font-size:9.5px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' + (study.metric3_label || 'Uptime SLA') + '</span></div>';
  }
  document.getElementById('modalMetricsBox').innerHTML = metricsHtml;

  var stack = Array.isArray(study.tech_stack) ? study.tech_stack : (study.tech_stack ? study.tech_stack.split(',') : []);
  var techHtml = stack.map(function(t) {
    return '<span style="padding:3px 8px;background:#F3F4F6;color:#1F2937;font-size:10.5px;font-family:monospace;border-radius:2px;border:1px solid #E5E7EB;">' + t.trim() + '</span>';
  }).join('');
  document.getElementById('modalTechChips').innerHTML = techHtml;

  document.getElementById('caseStudyModal').style.display = 'flex';
}

function closeCaseModal() {
  document.getElementById('caseStudyModal').style.display = 'none';
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>