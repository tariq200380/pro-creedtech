<?php
$page_title = "Enterprise Case Studies & Delivered Systems | Creed Tech";
$page_description = "Explore real-world software architecture deployments, high-concurrency systems, and digital transformations delivered by Creed Tech.";
$active_page = "portfolio";

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
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&auto=format&fit=crop&q=80" alt="Creed Tech Senior Engineering Team" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.3) 50%, transparent);pointer-events:none;"></div>
            
            <!-- Top Badge -->
            <div style="position:absolute;top:1rem;left:1rem;">
              <span style="padding:4px 10px;background:#0052FF;color:#fff;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,0.2);">
                ENGINEERING CULTURE
              </span>
            </div>

            <!-- Floating Metric Card Overlay -->
            <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);padding:1rem 1.25rem;border-radius:10px;border:1px solid #E5E7EB;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);text-align:left;">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                <div>
                  <span style="font-size:13px;font-weight:700;color:#030712;display:block;">100% Principal Engineer Led</span>
                  <span style="font-size:11px;color:#6B7280;font-weight:500;">Zero junior outsourcing. Full accountability.</span>
                </div>
                <span style="padding:4px 10px;background:#DCFCE7;color:#166534;font-size:11px;font-weight:700;border-radius:2px;">
                  Verified SLA
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
              HOW WE GUARANTEE SUCCESS
            </div>

            <h2 style="font-size:clamp(1.6rem, 3vw, 2.35rem);font-weight:700;color:#030712;letter-spacing:-0.03em;line-height:1.25;margin:0 0 0.6rem;">
              Built on Rigorous Enterprise Standards
            </h2>

            <p style="font-size:14px;color:#4B5563;line-height:1.65;margin:0;">
              Every case study in our portfolio is the direct outcome of disciplined architectural principles, continuous automated verification, and zero-compromise security controls.
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

  <!-- 3. ALTERNATING 4 CASE STUDIES SECTION -->
  <section class="pf-cases-section">
    <div class="portfolio-container pf-cases-container" style="display:flex;flex-direction:column;gap:5rem;">
      
      <!-- CASE 1: Apex Global Settlement Rail (UK) [Text Left, Image Right] -->
      <div class="pf-case-grid">
        
        <!-- Text Detail Column (Always Left / First) -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.25rem;width:100%;">
          <div style="display:flex;align-items:center;gap:6px;">
            <span style="width:6px;height:6px;background:#0052FF;display:inline-block;border-radius:50%;"></span>
            <span style="font-size:11.5px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;color:#6B7280;">Fintech &amp; Banking Rails</span>
          </div>

          <h3 style="font-size:clamp(1.4rem,2.5vw,1.9rem);font-weight:700;color:#030712;letter-spacing:-0.02em;line-height:1.3;margin:0;">
            Next-Gen Multi-Region High-Frequency Payment Processing Engine
          </h3>

          <p style="font-size:14px;color:#374151;line-height:1.65;margin:0;">
            Engineered an ultra-low latency transaction clearing engine capable of processing 120,000 TPS with sub-10ms latency and zero transactional data loss.
          </p>

          <!-- 3 Impact Metrics Row -->
          <div class="pf-metrics-strip" style="padding:1rem 1.25rem;background:#F2F8FD;border-radius:10px;border:1px solid #BFDBFE;">
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">120k TPS</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Throughput Speed</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">-85%</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Latency Drop</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">99.999%</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Uptime SLA</span>
            </div>
          </div>

          <!-- Tech Stack Chips -->
          <div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Architectural Stack:</span>
            <div style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;">
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Go</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Kubernetes</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">CockroachDB</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Kafka</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">AWS GovCloud</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Redis</span>
            </div>
          </div>

          <div style="padding-top:0.25rem;">
            <button onclick="openCaseModal('case-1')" class="btn-dark" style="padding:10px 22px;font-size:12.5px;text-transform:uppercase;letter-spacing:0.05em;border-radius:3px;">
              <span>Explore Case Study Deep-Dive</span>
            </button>
          </div>
        </div>

        <!-- Image Column (Always Right / Second) -->
        <div onclick="openCaseModal('case-1')" style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.08);border:1px solid #E5E7EB;background:#030712;cursor:pointer;width:100%;">
          <div style="width:100%;height:260px;position:relative;" class="sm:h-[340px] lg:h-[400px]">
            <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?w=1200&auto=format&fit=crop&q=80" alt="Apex Global Settlement Rail" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2) 50%, transparent);pointer-events:none;"></div>
            
            <div style="position:absolute;top:1rem;left:1rem;display:flex;align-items:center;gap:6px;">
              <span style="width:1.85rem;height:1.85rem;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);color:#fff;font-weight:700;font-size:11.5px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);border-radius:2px;">01</span>
              <span style="padding:4px 12px;background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);color:#111827;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.1);">Fintech &amp; Banking</span>
            </div>

            <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;color:rgba(255,255,255,0.95);font-size:12.5px;font-weight:600;backdrop-filter:blur(8px);background:rgba(0,0,0,0.6);padding:8px 14px;border-radius:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
              🏢 Apex Global Settlement Rail • United Kingdom
            </div>
          </div>
        </div>

      </div>

      <!-- CASE 2: Cognitive Health Analytics (US) [Text Left, Image Right] -->
      <div class="pf-case-grid">
        
        <!-- Text Detail Column (Always Left / First) -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.25rem;width:100%;">
          <div style="display:flex;align-items:center;gap:6px;">
            <span style="width:6px;height:6px;background:#FF6B00;display:inline-block;border-radius:50%;"></span>
            <span style="font-size:11.5px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;color:#6B7280;">Private LLM Orchestration</span>
          </div>

          <h3 style="font-size:clamp(1.4rem,2.5vw,1.9rem);font-weight:700;color:#030712;letter-spacing:-0.02em;line-height:1.3;margin:0;">
            Enterprise Neural Copilot &amp; Multi-Agent Document Intelligence
          </h3>

          <p style="font-size:14px;color:#374151;line-height:1.65;margin:0;">
            Deployed private on-premise LLMs and dense vector search to automate compliance extraction across 15M+ medical unstructured diagnostic records.
          </p>

          <!-- 3 Impact Metrics Row -->
          <div class="pf-metrics-strip" style="padding:1rem 1.25rem;background:#F2F8FD;border-radius:10px;border:1px solid #BFDBFE;">
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">88%</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Audit Time Saved</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">99.4%</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Extraction Accuracy</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">100% On-Prem</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Zero Data Leakage</span>
            </div>
          </div>

          <!-- Tech Stack Chips -->
          <div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Architectural Stack:</span>
            <div style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;">
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Python</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">PyTorch</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Pinecone</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">LangChain</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">FastAPI</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Docker</span>
            </div>
          </div>

          <div style="padding-top:0.25rem;">
            <button onclick="openCaseModal('case-2')" class="btn-dark" style="padding:10px 22px;font-size:12.5px;text-transform:uppercase;letter-spacing:0.05em;border-radius:3px;">
              <span>Explore Case Study Deep-Dive</span>
            </button>
          </div>
        </div>

        <!-- Image Column (Always Right / Second) -->
        <div onclick="openCaseModal('case-2')" style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.08);border:1px solid #E5E7EB;background:#030712;cursor:pointer;width:100%;">
          <div style="width:100%;height:260px;position:relative;" class="sm:h-[340px] lg:h-[400px]">
            <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=1200&auto=format&fit=crop&q=80" alt="Cognitive Health Analytics" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2) 50%, transparent);pointer-events:none;"></div>
            
            <div style="position:absolute;top:1rem;left:1rem;display:flex;align-items:center;gap:6px;">
              <span style="width:1.85rem;height:1.85rem;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);color:#fff;font-weight:700;font-size:11.5px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);border-radius:2px;">02</span>
              <span style="padding:4px 12px;background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);color:#111827;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.1);">AI &amp; Machine Learning</span>
            </div>

            <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;color:rgba(255,255,255,0.95);font-size:12.5px;font-weight:600;backdrop-filter:blur(8px);background:rgba(0,0,0,0.6);padding:8px 14px;border-radius:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
              🏢 Cognitive Health Analytics • United States
            </div>
          </div>
        </div>

      </div>

      <!-- CASE 3: Nexus Global Logistics (Germany) [Text Left, Image Right] -->
      <div class="pf-case-grid">
        
        <!-- Text Detail Column (Always Left / First) -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.25rem;width:100%;">
          <div style="display:flex;align-items:center;gap:6px;">
            <span style="width:6px;height:6px;background:#00A3FF;display:inline-block;border-radius:50%;"></span>
            <span style="font-size:11.5px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;color:#6B7280;">Cloud Infrastructure &amp; DevOps</span>
          </div>

          <h3 style="font-size:clamp(1.4rem,2.5vw,1.9rem);font-weight:700;color:#030712;letter-spacing:-0.02em;line-height:1.3;margin:0;">
            Zero-Trust Multi-Cloud Kubernetes Infrastructure &amp; GitOps Mesh
          </h3>

          <p style="font-size:14px;color:#374151;line-height:1.65;margin:0;">
            Modernized 80+ legacy monolithic applications into a unified, self-healing cloud-native service mesh deployed across hybrid AWS &amp; Azure VPCs.
          </p>

          <!-- 3 Impact Metrics Row -->
          <div class="pf-metrics-strip" style="padding:1rem 1.25rem;background:#F2F8FD;border-radius:10px;border:1px solid #BFDBFE;">
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">14x Daily</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Deploy Frequency</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">-42%</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Compute Cost</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">&lt; 2 Mins</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Recovery Time</span>
            </div>
          </div>

          <!-- Tech Stack Chips -->
          <div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Architectural Stack:</span>
            <div style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;">
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Terraform</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Kubernetes</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Istio</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">ArgoCD</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Azure</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Prometheus</span>
            </div>
          </div>

          <div style="padding-top:0.25rem;">
            <button onclick="openCaseModal('case-3')" class="btn-dark" style="padding:10px 22px;font-size:12.5px;text-transform:uppercase;letter-spacing:0.05em;border-radius:3px;">
              <span>Explore Case Study Deep-Dive</span>
            </button>
          </div>
        </div>

        <!-- Image Column (Always Right / Second) -->
        <div onclick="openCaseModal('case-3')" style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.08);border:1px solid #E5E7EB;background:#030712;cursor:pointer;width:100%;">
          <div style="width:100%;height:260px;position:relative;" class="sm:h-[340px] lg:h-[400px]">
            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1200&auto=format&fit=crop&q=80" alt="Nexus Global Logistics" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2) 50%, transparent);pointer-events:none;"></div>
            
            <div style="position:absolute;top:1rem;left:1rem;display:flex;align-items:center;gap:6px;">
              <span style="width:1.85rem;height:1.85rem;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);color:#fff;font-weight:700;font-size:11.5px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);border-radius:2px;">03</span>
              <span style="padding:4px 12px;background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);color:#111827;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.1);">Cloud &amp; DevOps</span>
            </div>

            <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;color:rgba(255,255,255,0.95);font-size:12.5px;font-weight:600;backdrop-filter:blur(8px);background:rgba(0,0,0,0.6);padding:8px 14px;border-radius:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
              🏢 Nexus Global Logistics • Germany
            </div>
          </div>
        </div>

      </div>

      <!-- CASE 4: VaultSafe InsurTech (Switzerland) [Text Left, Image Right] -->
      <div class="pf-case-grid">
        
        <!-- Text Detail Column (Always Left / First) -->
        <div style="text-align:left;display:flex;flex-direction:column;gap:1.25rem;width:100%;">
          <div style="display:flex;align-items:center;gap:6px;">
            <span style="width:6px;height:6px;background:#10B981;display:inline-block;border-radius:50%;"></span>
            <span style="font-size:11.5px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;color:#6B7280;">Cybersecurity &amp; Governance</span>
          </div>

          <h3 style="font-size:clamp(1.4rem,2.5vw,1.9rem);font-weight:700;color:#030712;letter-spacing:-0.02em;line-height:1.3;margin:0;">
            Automated SOC 2 Compliance Logging &amp; Cryptographic Shield
          </h3>

          <p style="font-size:14px;color:#374151;line-height:1.65;margin:0;">
            Built continuous security telemetry and automated cryptographic vulnerability mitigation meeting strict ISO 27001 and SOC 2 Type II controls.
          </p>

          <!-- 3 Impact Metrics Row -->
          <div class="pf-metrics-strip" style="padding:1rem 1.25rem;background:#F2F8FD;border-radius:10px;border:1px solid #BFDBFE;">
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">100% Pass</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Security Audit</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">&lt; 30 Sec</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Threat Response</span>
            </div>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">50M+</span>
              <span style="font-size:10px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-top:2px;">Encrypted Records</span>
            </div>
          </div>

          <!-- Tech Stack Chips -->
          <div>
            <span style="font-size:11px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">Architectural Stack:</span>
            <div style="display:flex;align-items:center;flex-wrap:wrap;gap:6px;">
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">HashiCorp Vault</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">eBPF</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Wazuh</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">Go</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">GCP</span>
              <span style="padding:4px 10px;background:#F3F4F6;color:#1F2937;font-size:11px;font-family:monospace;border-radius:3px;border:1px solid #E5E7EB;">PostgreSQL</span>
            </div>
          </div>

          <div style="padding-top:0.25rem;">
            <button onclick="openCaseModal('case-4')" class="btn-dark" style="padding:10px 22px;font-size:12.5px;text-transform:uppercase;letter-spacing:0.05em;border-radius:3px;">
              <span>Explore Case Study Deep-Dive</span>
            </button>
          </div>
        </div>

        <!-- Image Column (Always Right / Second) -->
        <div onclick="openCaseModal('case-4')" style="position:relative;border-radius:1rem;overflow:hidden;box-shadow:0 10px 15px -3px rgba(0,0,0,0.08);border:1px solid #E5E7EB;background:#030712;cursor:pointer;width:100%;">
          <div style="width:100%;height:260px;position:relative;" class="sm:h-[340px] lg:h-[400px]">
            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=1200&auto=format&fit=crop&q=80" alt="VaultSafe InsurTech" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2) 50%, transparent);pointer-events:none;"></div>
            
            <div style="position:absolute;top:1rem;left:1rem;display:flex;align-items:center;gap:6px;">
              <span style="width:1.85rem;height:1.85rem;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);color:#fff;font-weight:700;font-size:11.5px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);border-radius:2px;">04</span>
              <span style="padding:4px 12px;background:rgba(255,255,255,0.9);backdrop-filter:blur(8px);color:#111827;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.1);">Cybersecurity</span>
            </div>

            <div style="position:absolute;bottom:1rem;left:1rem;right:1rem;color:rgba(255,255,255,0.95);font-size:12.5px;font-weight:600;backdrop-filter:blur(8px);background:rgba(0,0,0,0.6);padding:8px 14px;border-radius:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
              🏢 VaultSafe InsurTech • Switzerland
            </div>
          </div>
        </div>

      </div>

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

<!-- JAVASCRIPT: Modal Controller -->
<script>
var CASE_STUDIES = {
  'case-1': {
    number: '01',
    title: 'Next-Gen Multi-Region High-Frequency Payment Processing Engine',
    categoryTag: 'Fintech & Banking',
    client: 'Apex Global Settlement Rail',
    challenge: 'Legacy core banking bottlenecks caused transaction spikes to queue for up to 4 minutes during peak market volatility, leading to severe settlement latency.',
    solution: 'Architected distributed event-driven microservices on Kubernetes with CockroachDB active-active multi-region replication and Redis in-memory caches.',
    impactMetrics: [
      { label: 'Throughput Speed', value: '120k TPS' },
      { label: 'Latency Drop', value: '-85%' },
      { label: 'Uptime SLA', value: '99.999%' }
    ],
    techStack: ['Go', 'Kubernetes', 'CockroachDB', 'Kafka', 'AWS GovCloud', 'Redis']
  },
  'case-2': {
    number: '02',
    title: 'Enterprise Neural Copilot & Multi-Agent Document Intelligence',
    categoryTag: 'AI & Machine Learning',
    client: 'Cognitive Health Analytics',
    challenge: 'Manual audits of unstructured diagnostic records required 4,000+ clinician hours per quarter with a 6% human error rate.',
    solution: 'Implemented hybrid RAG pipelines with private VPC embeddings, domain-fine-tuned Llama 3 models, and cryptographic source citation verifiers.',
    impactMetrics: [
      { label: 'Audit Time Saved', value: '88%' },
      { label: 'Extraction Accuracy', value: '99.4%' },
      { label: 'Zero Data Leakage', value: '100% On-Prem' }
    ],
    techStack: ['Python', 'PyTorch', 'Pinecone', 'LangChain', 'FastAPI', 'Docker']
  },
  'case-3': {
    number: '03',
    title: 'Zero-Trust Multi-Cloud Kubernetes Infrastructure & GitOps Mesh',
    categoryTag: 'Cloud & DevOps',
    client: 'Nexus Global Logistics',
    challenge: 'Siloed data centers caused recurring deployment failures and required manual rolling updates spanning 18 hours per release.',
    solution: 'Designed declarative Terraform IaC and ArgoCD GitOps pipelines with Istio service mesh and automated zero-trust mutual TLS encryption.',
    impactMetrics: [
      { label: 'Deploy Frequency', value: '14x Daily' },
      { label: 'Compute Cost', value: '-42%' },
      { label: 'Recovery Time', value: '< 2 Mins' }
    ],
    techStack: ['Terraform', 'Kubernetes', 'Istio', 'ArgoCD', 'Azure', 'Prometheus']
  },
  'case-4': {
    number: '04',
    title: 'Automated SOC 2 Compliance Logging & Cryptographic Shield',
    categoryTag: 'Cybersecurity',
    client: 'VaultSafe InsurTech',
    challenge: 'Complex multi-jurisdiction data privacy laws required real-time cryptographic verification of data-at-rest and in-transit.',
    solution: 'Deployed automated eBPF runtime network monitoring with HashiCorp Vault key rotation and cryptographic immutable tamper logs.',
    impactMetrics: [
      { label: 'Security Audit', value: '100% Pass' },
      { label: 'Threat Response', value: '< 30 Sec' },
      { label: 'Encrypted Records', value: '50M+' }
    ],
    techStack: ['HashiCorp Vault', 'eBPF', 'Wazuh', 'Go', 'GCP', 'PostgreSQL']
  }
};

function openCaseModal(caseId) {
  var study = CASE_STUDIES[caseId];
  if (!study) return;

  document.getElementById('modalCategoryTag').textContent = 'CASE ' + study.number + ' • ' + study.categoryTag + ' (' + study.client + ')';
  document.getElementById('modalTitle').textContent = study.title;
  document.getElementById('modalChallenge').textContent = study.challenge;
  document.getElementById('modalSolution').textContent = study.solution;

  var metricsHtml = study.impactMetrics.map(function(m) {
    return '<div>' +
      '<span style="font-size:1.2rem;font-weight:700;color:#0052FF;display:block;line-height:1.1;">' + m.value + '</span>' +
      '<span style="font-size:9.5px;color:#6B7280;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' + m.label + '</span>' +
    '</div>';
  }).join('');
  document.getElementById('modalMetricsBox').innerHTML = metricsHtml;

  var techHtml = study.techStack.map(function(t) {
    return '<span style="padding:3px 8px;background:#F3F4F6;color:#1F2937;font-size:10.5px;font-family:monospace;border-radius:2px;border:1px solid #E5E7EB;">' + t + '</span>';
  }).join('');
  document.getElementById('modalTechChips').innerHTML = techHtml;

  document.getElementById('caseStudyModal').style.display = 'flex';
}

function closeCaseModal() {
  document.getElementById('caseStudyModal').style.display = 'none';
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
include __DIR__ . '/includes/footer.php'; ?>