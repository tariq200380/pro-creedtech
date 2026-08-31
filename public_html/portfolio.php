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

<div style="width:100%;background:#FAFAFC;color:#111827;font-family:sans-serif;text-align:left;">
  
  <!-- ============================================ -->
  <!-- FLAGSHIP CASE STUDIES SECTION - PREMIUM DESIGN -->
  <!-- ONLY THIS SECTION - NOTHING ELSE CHANGES -->
  <!-- ============================================ -->

  <style>
  /* ========================================== */
  /* FLAGSHIP SECTION - FINAL DESIGN */
  /* ========================================== */

  /* SECTION BACKGROUND - MATCHES "HOW WE DELIVER" */
  .case-studies-section,
  .flagship-section {
    background: #0B1120 !important;
    padding: 40px 60px !important;
    position: relative !important;
    overflow: hidden !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }

  /* AMBIENT ORANGE GLOW - TOP CENTER + LEFT & RIGHT SIDES */
  .case-studies-section::before,
  .flagship-section::before {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background:
      radial-gradient(circle at 50% 20%, rgba(255,107,0,0.17) 0%, rgba(255,107,0,0.05) 45%, rgba(11,17,32,0) 70%),
      radial-gradient(circle at 0% 50%, rgba(255,107,0,0.16) 0%, rgba(255,107,0,0.05) 40%, rgba(11,17,32,0) 65%),
      radial-gradient(circle at 100% 50%, rgba(255,107,0,0.16) 0%, rgba(255,107,0,0.05) 40%, rgba(11,17,32,0) 65%) !important;
    pointer-events: none !important;
    z-index: 0 !important;
  }

  /* ULTRA-LIGHT SUBTLE GRID BACKGROUND */
  .case-studies-section::after,
  .flagship-section::after {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background-image: linear-gradient(to right, #FFFFFF 1px, transparent 1px),
                      linear-gradient(to bottom, #FFFFFF 1px, transparent 1px) !important;
    background-size: 36px 36px !important;
    opacity: 0.035 !important;
    pointer-events: none !important;
    z-index: 0 !important;
  }

  /* CONTAINER LAYOUT */
  .flagship-container,
  .portfolio-container {
    display: flex !important;
    align-items: center !important;
    gap: 50px !important;
    position: relative !important;
    z-index: 1 !important;
    max-width: 1280px !important;
    margin: 0 auto !important;
  }

  /* LEFT COLUMN (TEXT CONTENT) */
  .flagship-left {
    flex: 1 1 50% !important;
    max-width: 50% !important;
  }

  /* RIGHT COLUMN (STATS) */
  .flagship-right {
    flex: 1 1 50% !important;
    max-width: 50% !important;
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 16px !important;
  }

  /* TAGLINE COLOR & STYLING (scoped - sirf tagline, kisi aur h2 par nahi) */
  .flagship-section .flagship-tagline {
    font-family: 'Inter', sans-serif !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 3px !important;
    color: #AEB6C2 !important;
    margin-bottom: 10px !important;
  }

  /* SEPARATOR LINE */
  .flagship-line {
    width: 60px !important;
    height: 2px !important;
    background: #FF6B00 !important;
    opacity: 0.8 !important;
    margin-bottom: 24px !important;
  }

  /* HEADLINE - SOLID WHITE (NO GRADIENT) */
  .case-studies-section h3:first-of-type,
  .flagship-section h3:first-of-type,
  .flagship-section .flagship-headline-1 {
    font-family: 'Inter', sans-serif !important;
    font-size: 46px !important;
    font-weight: 800 !important;
    color: #FFFFFF !important;
    margin: 0 0 2px 0 !important;
    line-height: 1.1 !important;
  }

  .flagship-headline-2 {
    font-family: 'Inter', sans-serif !important;
    font-size: 38px !important;
    font-weight: 800 !important;
    color: #FFFFFF !important;
    margin: 0 0 18px 0 !important;
    line-height: 1.2 !important;
  }

  /* DESCRIPTION */
  .flagship-desc {
    font-family: 'Inter', sans-serif !important;
    font-size: 16px !important;
    font-weight: 400 !important;
    color: rgba(255,255,255,0.75) !important;
    line-height: 1.7 !important;
    max-width: 520px !important;
    margin: 0 0 28px 0 !important;
  }

  /* CTA BUTTON - SAME AS NAVBAR "GET STARTED" */
  .case-studies-section .btn,
  .flagship-section .btn,
  .flagship-section .flagship-btn {
    background-color: #0052FF !important;
    color: #FFFFFF !important;
    font-family: 'Inter', sans-serif !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    line-height: 1 !important;
    padding: 16px 32px !important;
    border-radius: 4px !important;
    box-shadow: none !important;
    transition: background-color 0.15s ease !important;
    border: 1px solid transparent !important;
    display: inline-block !important;
    text-decoration: none !important;
    cursor: pointer !important;
  }

  .case-studies-section .btn:hover,
  .flagship-section .btn:hover,
  .flagship-section .flagship-btn:hover {
    background-color: #0042D0 !important;
    color: #FFFFFF !important;
    box-shadow: none !important;
    transform: none !important;
  }

  /* STAT CARDS - GLASSMORPHISM */
  .case-studies-section .stat-item,
  .case-studies-section .stat-card,
  .flagship-section .stat-item,
  .flagship-section .stat-card,
  .flagship-section .flagship-card {
    background: rgba(255,255,255,0.06) !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
    border: 1px solid rgba(255,255,255,0.08) !important;
    border-radius: 14px !important;
    padding: 22px 18px !important;
    box-shadow: 0 8px 32px rgba(0,0,0,0.25) !important;
    transition: all 0.3s ease !important;
    text-align: left !important;
  }

  .case-studies-section .stat-item:hover,
  .flagship-section .stat-item:hover,
  .flagship-section .stat-card:hover,
  .flagship-section .flagship-card:hover {
    transform: translateY(-4px) !important;
    border-color: rgba(255,107,0,0.4) !important;
  }

  /* CARD ICON */
  .flagship-icon {
    width: 24px !important;
    height: 24px !important;
    color: rgba(0, 240, 255, 0.7) !important;
    margin-bottom: 10px !important;
    display: block !important;
  }

  /* STAT NUMBERS - WHITE */
  .case-studies-section .stat-number,
  .case-studies-section strong,
  .flagship-section .stat-number,
  .flagship-section .flagship-number {
    font-family: 'Inter', sans-serif !important;
    font-size: 34px !important;
    font-weight: 700 !important;
    color: #FFFFFF !important;
    display: block !important;
    line-height: 1.1 !important;
    margin: 0 0 2px 0 !important;
  }

  .flagship-number.small {
    font-size: 28px !important;
  }

  /* STAT LABELS */
  .flagship-label {
    font-family: 'Inter', sans-serif !important;
    font-size: 11px !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    color: rgba(255,255,255,0.5) !important;
    display: block !important;
    margin: 0 !important;
  }

  /* RESPONSIVE */
  @media (max-width: 1024px) {
    .flagship-container {
      flex-direction: column !important;
      gap: 40px !important;
    }
    .flagship-left,
    .flagship-right {
      flex: 0 0 100% !important;
      max-width: 100% !important;
    }
    .flagship-headline-1 {
      font-size: 36px !important;
    }
    .flagship-headline-2 {
      font-size: 30px !important;
    }
  }

  @media (max-width: 600px) {
    .flagship-section {
      padding: 60px 24px !important;
    }
    .flagship-headline-1 {
      font-size: 28px !important;
    }
    .flagship-headline-2 {
      font-size: 24px !important;
    }
    .flagship-desc {
      font-size: 15px !important;
    }
    .flagship-right {
      grid-template-columns: 1fr 1fr !important;
      gap: 12px !important;
    }
    .flagship-number {
      font-size: 26px !important;
    }
    .flagship-number.small {
      font-size: 22px !important;
    }
  }
  </style>

  <!-- ===== HTML SECTION ===== -->
  <section class="flagship-section case-studies-section" id="portfolio-hero-section">
    <div class="flagship-container portfolio-container">

      <!-- LEFT COLUMN -->
      <div class="flagship-left">
        <div class="flagship-tagline">FLAGSHIP CASE STUDIES &amp; PROVEN ARCHITECTURES</div>
        <div class="flagship-line"></div>
        <h1 class="flagship-headline-1">Architectural Mastery.</h1>
        <h2 class="flagship-headline-2">Proven Business Impact.</h2>
        <p class="flagship-desc">
          In-depth case studies documenting how Creed Tech engineers mission-critical infrastructure, multi-region database replication, private LLMs, and enterprise-grade security platforms — delivering measurable outcomes for global enterprises.
        </p>
        <a href="#portfolio-case-studies" class="flagship-btn btn">View Case Studies</a>
      </div>

      <!-- RIGHT COLUMN - STATS -->
      <div class="flagship-right">

        <!-- CARD 1 -->
        <div class="flagship-card stat-item stat-card">
          <svg class="flagship-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
          </svg>
          <p class="flagship-number stat-number small">End-to-End</p>
          <p class="flagship-label">Project Delivery</p>
        </div>

        <!-- CARD 2 -->
        <div class="flagship-card stat-item stat-card">
          <svg class="flagship-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            <polyline points="9 12 11 14 15 10" />
          </svg>
          <p class="flagship-number stat-number small">Security-First</p>
          <p class="flagship-label">Engineering</p>
        </div>

        <!-- CARD 3 -->
        <div class="flagship-card stat-item stat-card">
          <svg class="flagship-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
          <p class="flagship-number stat-number small">Reliable</p>
          <p class="flagship-label">Delivery</p>
        </div>

        <!-- CARD 4 -->
        <div class="flagship-card stat-item stat-card">
          <svg class="flagship-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
          </svg>
          <p class="flagship-number stat-number small">Quality-Driven</p>
          <p class="flagship-label">Development</p>
        </div>

      </div>
      <!-- END RIGHT COLUMN -->

    </div>
    <!-- END CONTAINER -->
  </section>
  <!-- ===== END SECTION ===== -->

  <!-- 2. UNIQUE ENGINEERING STANDARDS & EXECUTION SHOWCASE WITH PICTURE -->
  <section style="width:100%;padding:2.5rem 0;background:#F4F6FA;border-bottom:1px solid #E5E7EB;color:#111827;">
    <div style="max-width:80rem;margin:0 auto;padding:0 3rem;">
      <style>
        .portfolio-standards-grid {
          display: grid;
          grid-template-columns: 5fr 7fr;
          gap: 3.5rem;
          align-items: center;
        }
        @media (max-width: 1024px) {
          .portfolio-standards-grid {
            grid-template-columns: 1fr !important;
            gap: 2.5rem !important;
          }
        }
        .portfolio-standards-img-box {
          width: 100%;
          height: 460px;
          position: relative;
        }
        @media (max-width: 640px) {
          .portfolio-standards-img-box {
            height: 260px !important;
          }
        }
      </style>
      <div class="portfolio-standards-grid">
        
        <!-- Left: High-Tech Engineering & DevOps Picture -->
        <div style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);border:1px solid #E5E7EB;">
          <div class="portfolio-standards-img-box">
            <img src="<?= htmlspecialchars($standards['image'] ?? 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&auto=format&fit=crop&q=80') ?>" alt="Creed Tech Senior Engineering Team" width="600" height="460" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.3) 50%, transparent);pointer-events:none;"></div>
            
            <!-- Top Badge -->
            <div style="position:absolute;top:1rem;left:1rem;">
              <span style="padding:4px 12px;background:#0052FF;color:#fff;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,0.2);">
                <?= htmlspecialchars($standards['badge'] ?? 'ENGINEERING CULTURE') ?>
              </span>
            </div>

            <!-- Floating Metric Card Overlay -->
            <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);padding:1rem;border-radius:12px;border:1px solid #E5E7EB;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);text-align:left;">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                <div>
                  <span style="font-size:12px;font-weight:700;color:#030712;display:block;"><?= htmlspecialchars($standards['overlay_title'] ?? '100% Principal Engineer Led') ?></span>
                  <span style="font-size:10px;color:#6B7280;font-weight:500;"><?= htmlspecialchars($standards['overlay_subtitle'] ?? 'Zero junior outsourcing. Full accountability.') ?></span>
                </div>
                <span style="padding:4px 10px;background:#DCFCE7;color:#166534;font-size:10px;font-weight:700;border-radius:2px;">
                  <?= htmlspecialchars($standards['overlay_tag'] ?? 'Verified SLA') ?>
                </span>
              </div>
            </div>

          </div>
        </div>

        <!-- Right: Engineering Standards & Execution Pillars -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.5rem;">
          <div>
            <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 12px;background:#fff;border:1px solid #D1D5DB;color:#0052FF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.75rem;border-radius:2px;">
              <span style="width:6px;height:6px;background:#0052FF;display:inline-block;"></span>
              <?= htmlspecialchars($standards['tagline'] ?? 'HOW WE GUARANTEE SUCCESS') ?>
            </div>

            <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);font-weight:600;color:#030712;letter-spacing:-0.03em;line-height:1.2;margin:0 0 0.75rem;">
              <?= htmlspecialchars($standards['title'] ?? 'Built on Rigorous Enterprise Standards') ?>
            </h2>

            <p style="font-size:0.875rem;color:#4B5563;line-height:1.6;margin:0;">
              <?= htmlspecialchars($standards['description'] ?? 'Every case study in our portfolio is the direct outcome of disciplined architectural principles, continuous automated verification, and zero-compromise security controls.') ?>
            </p>
          </div>

          <!-- 4 Pillars Grid -->
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;padding-top:0.25rem;">
            
            <div style="padding:1rem;background:#fff;border-radius:12px;border:1px solid #E5E7EB;box-shadow:0 1px 2px rgba(0,0,0,0.05);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">⚡</span>
                <h4 style="font-size:13px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Contractual 99.99% SLA</h4>
              </div>
              <p style="font-size:11.5px;color:#4B5563;line-height:1.55;margin:0;">Every milestone backed by contractual latency and uptime guarantees.</p>
            </div>

            <div style="padding:1rem;background:#fff;border-radius:12px;border:1px solid #E5E7EB;box-shadow:0 1px 2px rgba(0,0,0,0.05);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">🛡️</span>
                <h4 style="font-size:13px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Cryptographic Zero-Trust</h4>
              </div>
              <p style="font-size:11.5px;color:#4B5563;line-height:1.55;margin:0;">Automated mTLS encryption, isolated VPC boundaries, and immutable audit logs.</p>
            </div>

            <div style="padding:1rem;background:#fff;border-radius:12px;border:1px solid #E5E7EB;box-shadow:0 1px 2px rgba(0,0,0,0.05);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">👨‍💻</span>
                <h4 style="font-size:13px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Dedicated Senior Pods</h4>
              </div>
              <p style="font-size:11.5px;color:#4B5563;line-height:1.55;margin:0;">Direct collaboration with senior principal architects with daily Git commits.</p>
            </div>

            <div style="padding:1rem;background:#fff;border-radius:12px;border:1px solid #E5E7EB;box-shadow:0 1px 2px rgba(0,0,0,0.05);text-align:left;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                <span style="font-size:1.1rem;">🚀</span>
                <h4 style="font-size:13px;font-weight:700;color:#030712;margin:0;line-height:1.3;">Zero-Downtime Releases</h4>
              </div>
              <p style="font-size:11.5px;color:#4B5563;line-height:1.55;margin:0;">Automated CI/CD staging with instant multi-region failover and 100% test coverage.</p>
            </div>

          </div>

          <!-- Bottom Quote & Action -->
          <div style="padding-top:0.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;border-top:1px solid #E5E7EB;">
            <p style="font-size:12px;color:#6B7280;font-style:italic;margin:0;">
              &ldquo;Quality is not an afterthought; it is contractually engineered into our foundations.&rdquo;
            </p>
            <a href="contact" style="font-size:12px;font-weight:700;color:#0052FF;text-decoration:none;display:inline-flex;align-items:center;gap:4px;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
              <span>Request Technical Scoping &rarr;</span>
            </a>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- 3. ALTERNATING CASE STUDIES SECTION -->
  <section id="portfolio-case-studies" style="width:100%;padding:2.5rem 0;background:#fff;border-bottom:1px solid #E5E7EB;">
    <div style="max-width:80rem;margin:0 auto;padding:0 3rem;display:flex;flex-direction:column;gap:6rem;">
      <style>
        .portfolio-case-item {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 3.5rem;
          align-items: center;
        }
        @media (max-width: 1024px) {
          .portfolio-case-item {
            grid-template-columns: 1fr !important;
            gap: 2.5rem !important;
          }
        }
        .portfolio-case-img-box {
          width: 100%;
          height: 400px;
          position: relative;
        }
        @media (max-width: 640px) {
          .portfolio-case-img-box {
            height: 240px !important;
          }
        }
      </style>
      
      <?php foreach ($projectsList as $idx => $proj): 
        $pId = $proj['id'] ?? ('case-' . ($idx + 1));
        $pNum = $proj['number'] ?? sprintf('%02d', $idx + 1);
        $dotColor = ($idx % 3 === 0) ? '#0052FF' : (($idx % 3 === 1) ? '#FF6B00' : '#10B981');
        $isImageLeft = ($idx % 2 === 0);
      ?>
      <div class="portfolio-case-item">
        
        <?php if ($isImageLeft): ?>
          <!-- Image Column (Left) -->
          <div onclick="openCaseModal('<?= htmlspecialchars($pId) ?>')" style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);border:1px solid #E5E7EB;background:#030712;cursor:pointer;">
            <div class="portfolio-case-img-box">
              <img src="<?= htmlspecialchars($proj['image'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars($proj['title'] ?? 'Case Study') ?>" width="550" height="400" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
              <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2) 50%, transparent);pointer-events:none;"></div>
              
              <div style="position:absolute;top:1rem;left:1rem;display:flex;align-items:center;gap:8px;">
                <span style="width:2rem;height:2rem;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);color:#fff;font-weight:600;font-size:12px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);border-radius:2px;"><?= htmlspecialchars($pNum) ?></span>
                <span style="padding:4px 12px;background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);color:#111827;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.1);"><?= htmlspecialchars($proj['badge_category'] ?? $proj['category'] ?? 'Case Study') ?></span>
              </div>

              <div style="position:absolute;bottom:1rem;left:1rem;color:rgba(255,255,255,0.9);font-size:12px;font-weight:600;backdrop-filter:blur(8px);background:rgba(0,0,0,0.5);padding:6px 12px;border-radius:6px;">
                <?= htmlspecialchars($proj['client_location'] ?? ('🏢 ' . ($proj['client'] ?? 'Global Client'))) ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Text Detail Column -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.25rem;">
          <div style="display:flex;align-items:center;gap:8px;">
            <span style="width:8px;height:8px;background:<?= $dotColor ?>;display:inline-block;"></span>
            <span style="font-size:12px;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;color:#6B7280;"><?= htmlspecialchars($proj['category'] ?? 'Enterprise Systems') ?></span>
          </div>

          <h3 style="font-size:clamp(1.5rem,2.5vw,2rem);font-weight:600;color:#030712;letter-spacing:-0.02em;line-height:1.25;margin:0;">
            <?= htmlspecialchars($proj['title'] ?? '') ?>
          </h3>

          <p style="font-size:0.875rem;color:#374151;line-height:1.65;margin:0;">
            <?= htmlspecialchars($proj['description'] ?? '') ?>
          </p>

          <!-- 3 Impact Metrics Row -->
          <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:12px;padding:1rem;background:#F2F8FD;border-radius:12px;border:1px solid #BFDBFE;">
            <div>
              <span style="font-size:1.25rem;font-weight:600;color:#0052FF;display:block;line-height:1.1;"><?= htmlspecialchars($proj['metric1_val'] ?? '100%') ?></span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;"><?= htmlspecialchars($proj['metric1_label'] ?? 'Impact') ?></span>
            </div>
            <div>
              <span style="font-size:1.25rem;font-weight:600;color:#0052FF;display:block;line-height:1.1;"><?= htmlspecialchars($proj['metric2_val'] ?? '99.9%') ?></span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;"><?= htmlspecialchars($proj['metric2_label'] ?? 'Efficiency') ?></span>
            </div>
            <div>
              <span style="font-size:1.25rem;font-weight:600;color:#0052FF;display:block;line-height:1.1;"><?= htmlspecialchars($proj['metric3_val'] ?? '0 Defect') ?></span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;"><?= htmlspecialchars($proj['metric3_label'] ?? 'Uptime SLA') ?></span>
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
                <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:2px;border:1px solid #E5E7EB;"><?= htmlspecialchars($tech) ?></span>
              <?php endforeach; ?>
            </div>
          </div>

          <div style="padding-top:0.5rem;">
            <button onclick="openCaseModal('<?= htmlspecialchars($pId) ?>')" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#030712;color:#fff;font-weight:700;font-size:12px;border:none;border-radius:2px;cursor:pointer;transition:background 0.2s;" onmouseover="this.style.background='#0052FF'" onmouseout="this.style.background='#030712'">
              <span>Explore Case Study Deep-Dive</span>
            </button>
          </div>
        </div>

        <?php if (!$isImageLeft): ?>
          <!-- Image Column (Right) -->
          <div onclick="openCaseModal('<?= htmlspecialchars($pId) ?>')" style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);border:1px solid #E5E7EB;background:#030712;cursor:pointer;">
            <div class="portfolio-case-img-box">
              <img src="<?= htmlspecialchars($proj['image'] ?? 'assets/img/hero_img.webp') ?>" alt="<?= htmlspecialchars($proj['title'] ?? 'Case Study') ?>" width="550" height="400" loading="lazy" decoding="async" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
              <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2) 50%, transparent);pointer-events:none;"></div>
              
              <div style="position:absolute;top:1rem;left:1rem;display:flex;align-items:center;gap:8px;">
                <span style="width:2rem;height:2rem;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);color:#fff;font-weight:600;font-size:12px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);border-radius:2px;"><?= htmlspecialchars($pNum) ?></span>
                <span style="padding:4px 12px;background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);color:#111827;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.1);"><?= htmlspecialchars($proj['badge_category'] ?? $proj['category'] ?? 'Case Study') ?></span>
              </div>

              <div style="position:absolute;bottom:1rem;left:1rem;color:rgba(255,255,255,0.9);font-size:12px;font-weight:600;backdrop-filter:blur(8px);background:rgba(0,0,0,0.5);padding:6px 12px;border-radius:6px;">
                <?= htmlspecialchars($proj['client_location'] ?? ('🏢 ' . ($proj['client'] ?? 'Global Client'))) ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
      <?php endforeach; ?>

    </div>
  </section>

  <!-- 4. MODAL: DETAILED ARCHITECTURAL CASE STUDY VIEW -->
  <div id="caseStudyModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);backdrop-filter:blur(6px);z-index:9999;align-items:center;justify-content:center;padding:1rem;">
    <div style="background:#fff;color:#111827;border:1px solid #E5E7EB;border-radius:1rem;padding:2rem;max-width:42rem;width:100%;max-height:90vh;overflow-y:auto;box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);position:relative;text-align:left;">
      
      <button onclick="closeCaseModal()" style="position:absolute;top:1.25rem;right:1.25rem;width:2rem;height:2rem;border-radius:2px;background:#F3F4F6;border:none;color:#4B5563;font-weight:700;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">✕</button>

      <div style="margin-bottom:1rem;">
        <span id="modalCategoryTag" style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">CASE 01 • Fintech &amp; Banking</span>
        <h3 id="modalTitle" style="font-size:1.375rem;font-weight:600;color:#030712;letter-spacing:-0.02em;line-height:1.3;margin:0;">Project Title</h3>
      </div>

      <div id="modalMetricsBox" style="display:grid;grid-template-columns:repeat(3, 1fr);gap:12px;padding:1rem;background:#F2F8FD;border-radius:12px;border:1px solid #BFDBFE;margin-bottom:1.5rem;text-align:center;">
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
  <section style="width:100%;background:#0B1120;padding:2.5rem 0;color:#fff;text-align:center;position:relative;overflow:hidden;border-top:1px solid #1F2937;">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 50%, rgba(0, 102, 255, 0.22) 0%, transparent 65%);"></div>
    <div style="max-width:48rem;margin:0 auto;padding:0 2rem;position:relative;z-index:10;display:flex;flex-direction:column;align-items:center;gap:1rem;">
      <span style="font-size:11px;font-weight:700;color:#FF6B00;text-transform:uppercase;letter-spacing:0.05em;">HAVE AN AMBITIOUS ENGINEERING INITIATIVE?</span>
      <h2 style="font-size:clamp(1.75rem,3.5vw,2.5rem);font-weight:600;color:#fff;letter-spacing:-0.02em;margin:0;">Let's Build Your Next High-Performance Platform</h2>
      <p style="font-size:0.95rem;color:#D1D5DB;max-width:38rem;margin:0;line-height:1.65;font-weight:400;">Schedule a confidential sprint architecture consultation with our principal software architects.</p>
      <div style="padding-top:0.75rem;">
        <a href="contact" class="btn-blue" style="height:48px;padding:0 32px;font-size:13px;text-transform:uppercase;letter-spacing:0.05em;border-radius:4px;">Start Technical Scoping</a>
      </div>
    </div>
  </section>

</div>

<!-- JAVASCRIPT: Modal Controller -->
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
    metricsHtml += '<div><span style="font-size:1.25rem;font-weight:600;color:#0052FF;display:block;line-height:1.1;">' + study.metric1_val + '</span><span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' + (study.metric1_label || 'Impact') + '</span></div>';
  }
  if (study.metric2_val) {
    metricsHtml += '<div><span style="font-size:1.25rem;font-weight:600;color:#0052FF;display:block;line-height:1.1;">' + study.metric2_val + '</span><span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' + (study.metric2_label || 'Efficiency') + '</span></div>';
  }
  if (study.metric3_val) {
    metricsHtml += '<div><span style="font-size:1.25rem;font-weight:600;color:#0052FF;display:block;line-height:1.1;">' + study.metric3_val + '</span><span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' + (study.metric3_label || 'Uptime SLA') + '</span></div>';
  }
  document.getElementById('modalMetricsBox').innerHTML = metricsHtml;

  var stack = Array.isArray(study.tech_stack) ? study.tech_stack : (study.tech_stack ? study.tech_stack.split(',') : []);
  var techHtml = stack.map(function(t) {
    return '<span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:2px;border:1px solid #E5E7EB;">' + t.trim() + '</span>';
  }).join('');
  document.getElementById('modalTechChips').innerHTML = techHtml;

  document.getElementById('caseStudyModal').style.display = 'flex';
}

function closeCaseModal() {
  document.getElementById('caseStudyModal').style.display = 'none';
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
