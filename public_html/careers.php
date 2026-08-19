<?php
$page_title = "Careers & Engineering Pods | Creed Tech Enterprise Architecture";
$page_description = "Join Creed Tech's distributed engineering organization. We build high-concurrency systems, sovereign AI models, and mission-critical cloud infrastructure.";
$active_page = "careers";

$careersFile = __DIR__ . '/data/careers.json';
$jobs = [];
if (file_exists($careersFile)) {
    $jobs = json_decode(file_get_contents($careersFile), true) ?? [];
}

include __DIR__ . '/includes/header.php';
?>

<style>
/* Premium Careers Styling */
.careers-page {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  color: #0F172A;
  background: #FFFFFF;
}

.hero-gradient {
  background: radial-gradient(circle at 50% 0%, rgba(0, 82, 255, 0.09) 0%, transparent 65%),
              radial-gradient(circle at 90% 40%, rgba(255, 107, 0, 0.05) 0%, transparent 50%),
              linear-gradient(180deg, #F8FAFC 0%, #FFFFFF 100%);
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 16px;
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 9999px;
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: #0052FF;
  box-shadow: 0 2px 4px rgba(0,0,0,0.03);
}

.hero-badge-pulse {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #10B981;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
  animation: pulseGreen 2s infinite;
}

@keyframes pulseGreen {
  0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
  70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
  100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.metric-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  padding: 20px 24px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.metric-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 20px -5px rgba(0, 82, 255, 0.08);
  border-color: #BFDBFE;
}

.step-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 28px;
  position: relative;
  box-shadow: 0 2px 4px rgba(0,0,0,0.03);
  transition: all 0.2s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.step-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 24px -8px rgba(0,0,0,0.08);
  border-color: #0052FF;
}

.step-number {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
  font-size: 2rem;
  font-weight: 800;
  color: #0052FF;
  line-height: 1;
  margin-bottom: 16px;
}

.bento-card {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 28px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.02);
  transition: all 0.2s ease;
}
.bento-card:hover {
  border-color: #CBD5E1;
  box-shadow: 0 10px 20px -5px rgba(0,0,0,0.06);
}

.dept-filter-btn {
  padding: 8px 18px;
  font-size: 12.5px;
  font-weight: 700;
  border-radius: 6px;
  border: 1px solid #E2E8F0;
  background: #FFFFFF;
  color: #475569;
  cursor: pointer;
  transition: all 0.15s ease;
}
.dept-filter-btn:hover {
  background: #F8FAFC;
  color: #0F172A;
  border-color: #CBD5E1;
}
.dept-filter-btn.active {
  background: #0052FF;
  color: #FFFFFF;
  border-color: #0052FF;
  box-shadow: 0 2px 6px rgba(0, 82, 255, 0.25);
}

.job-card-item {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 10px;
  padding: 24px 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  flex-wrap: wrap;
  box-shadow: 0 2px 4px rgba(0,0,0,0.02);
  transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}
.job-card-item:hover {
  transform: translateY(-2px);
  border-color: #93C5FD;
  box-shadow: 0 10px 25px -5px rgba(0, 82, 255, 0.08);
}

.faq-accordion {
  background: #FFFFFF;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  overflow: hidden;
  margin-bottom: 12px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.02);
}
.faq-accordion summary {
  padding: 18px 24px;
  font-weight: 700;
  font-size: 14.5px;
  color: #0F172A;
  cursor: pointer;
  user-select: none;
  list-style: none;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.faq-accordion summary::-webkit-details-marker {
  display: none;
}
.faq-accordion summary::after {
  content: "+";
  font-size: 18px;
  font-weight: 700;
  color: #0052FF;
  transition: transform 0.2s ease;
}
.faq-accordion[open] summary::after {
  content: "−";
  color: #0F172A;
}
.faq-accordion p {
  padding: 0 24px 20px 24px;
  font-size: 13.5px;
  line-height: 1.7;
  color: #475569;
  margin: 0;
}
</style>

<div class="careers-page">

  <!-- ================= 1. HERO SECTION ================= -->
  <section class="hero-gradient" style="padding: 5.5rem 0 4.5rem; border-bottom: 1px solid #E2E8F0; position: relative;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px; text-align: center; position: relative; z-index: 10;">
      
      <!-- Top Live Badge -->
      <div style="margin-bottom: 20px;">
        <div class="hero-badge">
          <span class="hero-badge-pulse"></span>
          <span>DISTRIBUTED ENGINEERING PODS • SENIOR TALENT NETWORK</span>
        </div>
      </div>

      <!-- Main Headline -->
      <h1 style="font-size: clamp(2.25rem, 4.5vw, 3.75rem); font-weight: 800; color: #0F172A; letter-spacing: -0.03em; line-height: 1.15; max-width: 860px; margin: 0 auto 20px;">
        Build Digital Infrastructure That Endures. Not Just Demos.
      </h1>

      <!-- Subtitle -->
      <p style="font-size: clamp(1rem, 1.6vw, 1.15rem); color: #475569; line-height: 1.75; max-width: 760px; margin: 0 auto 36px;">
        We are an autonomous collective of principal systems architects, AI engineers, and design artisans. Zero micromanagement, zero bureaucratic sprawl, and zero throwaway code.
      </p>

      <!-- 4 High-Impact Architectural Metric Cards -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; max-width: 1080px; margin: 0 auto 40px; text-align: left;">
        
        <div class="metric-card">
          <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Work Model</div>
          <div style="font-size: 1.25rem; font-weight: 800; color: #0052FF; margin-top: 4px;">100% Remote &amp; Async</div>
          <div style="font-size: 12px; color: #64748B; margin-top: 4px;">Germany • Spain • USA • Global Hubs</div>
        </div>

        <div class="metric-card">
          <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Hiring SLA</div>
          <div style="font-size: 1.25rem; font-weight: 800; color: #10B981; margin-top: 4px;">7-Day Total Cycle</div>
          <div style="font-size: 12px; color: #64748B; margin-top: 4px;">Zero ghosting • Paid practical challenge</div>
        </div>

        <div class="metric-card">
          <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Hardware Allowance</div>
          <div style="font-size: 1.25rem; font-weight: 800; color: #FF6B00; margin-top: 4px;">$5,000 Gear Budget</div>
          <div style="font-size: 12px; color: #64748B; margin-top: 4px;">Apple M-Max / Threadripper + 4K OLED</div>
        </div>

        <div class="metric-card">
          <div style="font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em;">Autonomy Level</div>
          <div style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin-top: 4px;">Direct Architect-to-Client</div>
          <div style="font-size: 12px; color: #64748B; margin-top: 4px;">Zero non-technical middle layers</div>
        </div>

      </div>

      <!-- Quick Action CTAs -->
      <div style="display: flex; align-items: center; justify-content: center; gap: 14px; flex-wrap: wrap;">
        <a href="#open-positions" style="padding: 13px 32px; background: #0052FF; color: #FFFFFF; font-weight: 700; font-size: 13.5px; text-decoration: none; border-radius: 6px; box-shadow: 0 4px 14px rgba(0, 82, 255, 0.35); transition: background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
          Explore Open Engineering Roles ↓
        </a>
        <button type="button" onclick="openAlertModal()" style="padding: 13px 28px; background: #FFFFFF; color: #0F172A; font-weight: 700; font-size: 13.5px; border: 1px solid #CBD5E1; border-radius: 6px; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.04); transition: background 0.2s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='#FFFFFF'">
          Register for Vacancy Alert
        </button>
      </div>

    </div>
  </section>


  <!-- ================= 2. TRANSPARENT 4-STEP HIRING PIPELINE ================= -->
  <section style="padding: 5.5rem 0; background: #FAFAFC; border-bottom: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">
      
      <div style="text-align: center; max-width: 680px; margin: 0 auto 48px;">
        <span style="font-size: 11.5px; font-weight: 800; color: #0052FF; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 8px;">
          TRANSPARENT &amp; COMPENSATED
        </span>
        <h2 style="font-size: clamp(1.85rem, 3.2vw, 2.6rem); font-weight: 800; color: #0F172A; letter-spacing: -0.02em; margin: 0 0 12px;">
          Our 4-Stage Respectful Hiring Process
        </h2>
        <p style="font-size: 14.5px; color: #64748B; margin: 0; line-height: 1.6;">
          We value your craftsmanship and your time. No whiteboard trick riddles, no 8-round fatigue loops. Total turnaround time is strictly under 7 business days.
        </p>
      </div>

      <!-- 4-Step Pipeline Grid -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-bottom: 36px;">
        
        <!-- Step 1 -->
        <div class="step-card">
          <div>
            <div class="step-number">01</div>
            <div style="font-size: 11px; font-weight: 700; color: #0052FF; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;">STAGE 1 • 30 MINUTES</div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 10px; line-height: 1.3;">
              Architectural &amp; Values Alignment Call
            </h3>
            <p style="font-size: 13px; color: #475569; line-height: 1.65; margin: 0;">
              An informal, high-level conversation with a Principal Systems Architect. We discuss your technical philosophy, past distributed systems work, and your ideal pod setup.
            </p>
          </div>
          <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid #F1F5F9; font-size: 11.5px; font-weight: 700; color: #10B981;">
            ✓ Feedback in &lt; 24 Hours
          </div>
        </div>

        <!-- Step 2 -->
        <div class="step-card">
          <div>
            <div class="step-number" style="color: #FF6B00;">02</div>
            <div style="font-size: 11px; font-weight: 700; color: #FF6B00; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;">STAGE 2 • COMPENSATED</div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 10px; line-height: 1.3;">
              Paid Practical Code &amp; System Challenge
            </h3>
            <p style="font-size: 13px; color: #475569; line-height: 1.65; margin: 0;">
              A realistic take-home architecture or coding task mirroring real-world client challenges. We respect your effort and compensate your time regardless of outcome.
            </p>
          </div>
          <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid #F1F5F9; font-size: 11.5px; font-weight: 700; color: #FF6B00;">
            💰 Paid Stipend Provided
          </div>
        </div>

        <!-- Step 3 -->
        <div class="step-card">
          <div>
            <div class="step-number" style="color: #6366F1;">03</div>
            <div style="font-size: 11px; font-weight: 700; color: #6366F1; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;">STAGE 3 • 45 MINUTES</div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 10px; line-height: 1.3;">
              Interactive Design &amp; Solution Teardown
            </h3>
            <p style="font-size: 13px; color: #475569; line-height: 1.65; margin: 0;">
              A collaborative review session with our Technical Founders to walk through trade-offs, edge-case tuning, scalability bottlenecks, and distributed consensus decisions.
            </p>
          </div>
          <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid #F1F5F9; font-size: 11.5px; font-weight: 700; color: #6366F1;">
            🤝 Peer-to-Peer Dialogue
          </div>
        </div>

        <!-- Step 4 -->
        <div class="step-card">
          <div>
            <div class="step-number" style="color: #10B981;">04</div>
            <div style="font-size: 11px; font-weight: 700; color: #10B981; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px;">STAGE 4 • &lt; 48 HOURS</div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 10px; line-height: 1.3;">
              Formal Offer &amp; Custom Hardware Kit
            </h3>
            <p style="font-size: 13px; color: #475569; line-height: 1.65; margin: 0;">
              We present a transparent global compensation offer, equity parameters, and dispatch your $5k custom hardware &amp; ergonomics package prior to your day-one onboarding.
            </p>
          </div>
          <div style="margin-top: 20px; padding-top: 14px; border-top: 1px solid #F1F5F9; font-size: 11.5px; font-weight: 700; color: #10B981;">
            🎉 Zero Bureaucracy Offer
          </div>
        </div>

      </div>

      <!-- Guaranteed Hiring Commitment Callout -->
      <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 8px; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;">
        <div style="display: flex; align-items: center; gap: 12px;">
          <span style="font-size: 24px;">🛡️</span>
          <div>
            <div style="font-size: 13.5px; font-weight: 800; color: #1E40AF;">The Creed Tech Hiring Guarantee</div>
            <div style="font-size: 12.5px; color: #3B82F6;">Every candidate receives personalized feedback from a Principal Architect within 24 hours of every interview stage.</div>
          </div>
        </div>
        <a href="#open-positions" style="font-size: 12.5px; font-weight: 700; color: #0052FF; text-decoration: underline;">
          View Upcoming Roles &rarr;
        </a>
      </div>

    </div>
  </section>


  <!-- ================= 3. CORE PRINCIPLES & ENGINEERING CRAFT ================= -->
  <section style="padding: 5.5rem 0; background: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">
      
      <div style="text-align: center; max-width: 680px; margin: 0 auto 48px;">
        <span style="font-size: 11.5px; font-weight: 800; color: #FF6B00; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 8px;">
          CULTURE &amp; STANDARDS
        </span>
        <h2 style="font-size: clamp(1.85rem, 3.2vw, 2.6rem); font-weight: 800; color: #0F172A; letter-spacing: -0.02em; margin: 0 0 12px;">
          Why Senior Engineers Thrive at Creed Tech
        </h2>
        <p style="font-size: 14.5px; color: #64748B; margin: 0; line-height: 1.6;">
          We built the engineering organization we always wished we had: intellectual rigor, sovereign autonomy, and genuine respect for deep technical craftsmanship.
        </p>
      </div>

      <!-- 6 Culture Pillars (Bento Grid) -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
        
        <div class="bento-card">
          <div style="width: 44px; height: 44px; background: #EFF6FF; color: #0052FF; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px;">
            ⚡
          </div>
          <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 8px;">Autonomous Senior Pods</h3>
          <p style="font-size: 13.5px; color: #475569; line-height: 1.65; margin: 0 0 14px;">
            No non-technical layers assigning arbitrary tickets. You partner directly with client engineering leaders and make architectural choices with sovereign authority.
          </p>
          <div style="font-size: 11.5px; font-weight: 700; color: #0052FF;">Lead-Level Ownership &bull; Zero Micromanagement</div>
        </div>

        <div class="bento-card">
          <div style="width: 44px; height: 44px; background: #ECFDF5; color: #059669; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px;">
            🧘
          </div>
          <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 8px;">Deep Asynchronous Focus</h3>
          <p style="font-size: 13.5px; color: #475569; line-height: 1.65; margin: 0 0 14px;">
            We default to clear written RFCs, technical briefs, and asynchronous reviews. We protect 4+ continuous hours of daily deep maker time with zero meeting intrusions.
          </p>
          <div style="font-size: 11.5px; font-weight: 700; color: #059669;">RFC-Driven &bull; Minimal Meeting Fatigue</div>
        </div>

        <div class="bento-card">
          <div style="width: 44px; height: 44px; background: #FAF5FF; color: #7E22CE; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px;">
            💎
          </div>
          <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 8px;">Top-Tier Global Compensation</h3>
          <p style="font-size: 13.5px; color: #475569; line-height: 1.65; margin: 0 0 14px;">
            We calibrate compensation against top global technology hubs. We benchmark salaries transparently against US/European tier-1 levels regardless of where you live.
          </p>
          <div style="font-size: 11.5px; font-weight: 700; color: #7E22CE;">Global Tier-1 Banding &bull; Regular Reviews</div>
        </div>

        <div class="bento-card">
          <div style="width: 44px; height: 44px; background: #FFF7ED; color: #C2410C; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px;">
            💻
          </div>
          <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 8px;">$5K Gear &amp; Ergonomics Stipend</h3>
          <p style="font-size: 13.5px; color: #475569; line-height: 1.65; margin: 0 0 14px;">
            Choose your battle station: Apple MacBook Pro Max, custom Linux Threadripper workstation, Studio Display, and Herman Miller seating stipend refreshed biennially.
          </p>
          <div style="font-size: 11.5px; font-weight: 700; color: #C2410C;">Top-Spec Hardware &bull; Ergonomic Support</div>
        </div>

        <div class="bento-card">
          <div style="width: 44px; height: 44px; background: #EFF6FF; color: #1D4ED8; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px;">
            🎓
          </div>
          <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 8px;">Annual Learning &amp; Research Fund</h3>
          <p style="font-size: 13.5px; color: #475569; line-height: 1.65; margin: 0 0 14px;">
            Continuous growth is an absolute requirement. Dedicated annual funds for international technical conferences (RustConf, KubeCon, NeurIPS), certifications, and book allowances.
          </p>
          <div style="font-size: 11.5px; font-weight: 700; color: #1D4ED8;">Conferences &bull; Open-Source Sponsorship</div>
        </div>

        <div class="bento-card">
          <div style="width: 44px; height: 44px; background: #FFF1F2; color: #E11D48; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px;">
            🛡️
          </div>
          <h3 style="font-size: 1.2rem; font-weight: 800; color: #0F172A; margin: 0 0 8px;">Comprehensive Health &amp; Unlimited PTO</h3>
          <p style="font-size: 13.5px; color: #475569; line-height: 1.65; margin: 0 0 14px;">
            Full worldwide private health, dental, and vision insurance coverage. Flexible paid time off with mandatory 25+ days minimum annual rest to prevent burn-out.
          </p>
          <div style="font-size: 11.5px; font-weight: 700; color: #E11D48;">Worldwide Coverage &bull; Mandatory Rest Policy</div>
        </div>

      </div>

    </div>
  </section>


  <!-- ================= 4. INTERACTIVE OPEN ROLES SECTION ================= -->
  <section id="open-positions" style="padding: 5.5rem 0; background: #FAFAFC; border-bottom: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">
      
      <div style="text-align: center; max-width: 720px; margin: 0 auto 36px;">
        <span style="font-size: 11.5px; font-weight: 800; color: #0052FF; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 8px;">
          OPEN ENGINEERING VACANCIES
        </span>
        <h2 style="font-size: clamp(1.85rem, 3.2vw, 2.6rem); font-weight: 800; color: #0F172A; letter-spacing: -0.02em; margin: 0 0 12px;">
          Explore Active Pod Openings &amp; Upcoming Roles
        </h2>
        <p style="font-size: 14.5px; color: #64748B; margin: 0; line-height: 1.6;">
          Join an active hiring cycle or register for priority notification on upcoming engineering pod positions.
        </p>
      </div>

      <!-- Department Filter Tabs -->
      <div style="display: flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap; margin-bottom: 36px;">
        <button type="button" onclick="filterDepartment('All', this)" class="dept-filter-btn active">All Departments</button>
        <button type="button" onclick="filterDepartment('Engineering', this)" class="dept-filter-btn">Engineering</button>
        <button type="button" onclick="filterDepartment('AI & Machine Learning', this)" class="dept-filter-btn">AI &amp; Machine Learning</button>
        <button type="button" onclick="filterDepartment('UI/UX & Design', this)" class="dept-filter-btn">UI/UX &amp; Design</button>
        <button type="button" onclick="filterDepartment('Cloud & Infrastructure', this)" class="dept-filter-btn">Cloud &amp; SRE</button>
        <button type="button" onclick="filterDepartment('Solutions & Growth', this)" class="dept-filter-btn">Solutions &amp; Growth</button>
      </div>

      <!-- Dynamic Job Cards Container (Populated via JS & careers.json fallback) -->
      <div id="jobsContainer" style="display: flex; flex-direction: column; gap: 16px;">
        <?php if (!empty($jobs)): ?>
          <?php foreach ($jobs as $job): 
            $st = $job['status'] ?? 'Announcement Coming Soon';
            $isComingSoon = ($st === 'Announcement Coming Soon');
            $isInterviewing = ($st === 'Actively Interviewing');
            $badgeBg = $isComingSoon ? 'background:#FEF3C7;color:#92400E;border:1px solid #FDE68A;' : ($isInterviewing ? 'background:#ECFDF5;color:#065F46;border:1px solid #A7F3D0;' : 'background:#EFF6FF;color:#1E40AF;border:1px solid #BFDBFE;');
          ?>
            <div class="job-card-item" data-dept="<?php echo htmlspecialchars($job['department']); ?>">
              <div style="max-width: 760px; display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                  <span style="padding: 3px 8px; background: #EFF6FF; color: #0052FF; border-radius: 3px; border: 1px solid #DBEAFE;"><?php echo htmlspecialchars($job['department']); ?></span>
                  <span style="padding: 3px 8px; background: #F3F4F6; color: #374151; border-radius: 3px;">📍 <?php echo htmlspecialchars($job['location']); ?></span>
                  <span style="padding: 3px 8px; border-radius: 3px; <?php echo $badgeBg; ?>"><?php echo htmlspecialchars($st); ?></span>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 800; color: #0F172A; line-height: 1.25; margin: 2px 0 0;"><?php echo htmlspecialchars($job['title']); ?></h3>
                <p style="font-size: 13.5px; color: #475569; line-height: 1.6; margin: 0;"><?php echo htmlspecialchars($job['description']); ?></p>
                <div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap; padding-top: 4px;">
                  <?php foreach (($job['tags'] ?? []) as $tag): ?>
                    <span style="padding: 2px 8px; background: #F1F5F9; border: 1px solid #E2E8F0; color: #334155; font-size: 11px; font-family: monospace; border-radius: 3px;"><?php echo htmlspecialchars($tag); ?></span>
                  <?php endforeach; ?>
                </div>
              </div>
              <div>
                <?php if ($isComingSoon): ?>
                  <button type="button" onclick="openAlertModalForRole('<?php echo htmlspecialchars(addslashes($job['title'])); ?>', '<?php echo htmlspecialchars(addslashes($job['department'])); ?>')" style="padding: 10px 22px; background: #F59E0B; color: #FFFFFF; font-size: 12.5px; font-weight: 700; border: none; border-radius: 4px; cursor: pointer; box-shadow: 0 2px 6px rgba(245, 158, 11, 0.3);">
                    🔔 Register for Alert
                  </button>
                <?php else: ?>
                  <button type="button" onclick="openAlertModalForRole('<?php echo htmlspecialchars(addslashes($job['title'])); ?>', '<?php echo htmlspecialchars(addslashes($job['department'])); ?>')" style="padding: 10px 22px; background: #0052FF; color: #FFFFFF; font-size: 12.5px; font-weight: 700; border: none; border-radius: 4px; cursor: pointer; box-shadow: 0 2px 6px rgba(0, 82, 255, 0.35);">
                    🚀 Apply Now
                  </button>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="padding: 40px; text-align: center; color: #64748B; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px;">
            No open roles listed at this moment. Register for our Talent Pool below to receive immediate alert notifications when new vacancies are posted.
          </div>
        <?php endif; ?>
      </div>

      <!-- Register For Alert Callout Banner -->
      <div style="margin-top: 40px; padding: 28px 32px; background: #FFFFFF; border: 1px solid #BFDBFE; border-radius: 10px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; box-shadow: 0 4px 12px rgba(0, 82, 255, 0.05);">
        <div style="max-width: 640px;">
          <h4 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 6px;">
            Don't see your exact engineering domain?
          </h4>
          <p style="font-size: 13.5px; color: #475569; margin: 0; line-height: 1.6;">
            Register your coordinates with our Senior Talent Network. When new high-concurrency or AI pod requirements open, we contact registered candidates before public job listings.
          </p>
        </div>
        <div>
          <button type="button" onclick="openAlertModal()" style="padding: 12px 28px; background: #0052FF; color: #FFFFFF; font-weight: 700; font-size: 13px; border: none; border-radius: 6px; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 82, 255, 0.3);">
            + Register in Talent Network
          </button>
        </div>
      </div>

    </div>
  </section>


  <!-- ================= 5. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDIONS) ================= -->
  <section style="padding: 5.5rem 0; background: #FFFFFF; border-bottom: 1px solid #E2E8F0;">
    <div style="max-width: 860px; margin: 0 auto; padding: 0 24px;">
      
      <div style="text-align: center; margin-bottom: 40px;">
        <span style="font-size: 11.5px; font-weight: 800; color: #0052FF; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 8px;">
          CANDIDATE QUESTIONS
        </span>
        <h2 style="font-size: clamp(1.85rem, 3.2vw, 2.5rem); font-weight: 800; color: #0F172A; letter-spacing: -0.02em; margin: 0 0 10px;">
          Frequently Asked Questions
        </h2>
        <p style="font-size: 14px; color: #64748B; margin: 0;">
          Direct answers regarding our hiring process, equipment, working hours, and contracts.
        </p>
      </div>

      <div>
        <details class="faq-accordion" open>
          <summary>How does Creed Tech handle remote work and time zones?</summary>
          <p>
            We are 100% remote-first and asynchronous. We have team members across Germany, Spain, USA, and global time zones. Rather than demanding rigid 9-to-5 schedules, we require a minimum 3-hour daily overlap with your pod and rely on high-fidelity written documentation (RFCs and PR walkthroughs).
          </p>
        </details>

        <details class="faq-accordion">
          <summary>Is the take-home technical challenge really paid?</summary>
          <p>
            Yes, unconditionally. We believe assessing your real-world craftsmanship should be respectful of your time. If you advance to Stage 2, you are provided a fixed stipend regardless of whether an offer is extended.
          </p>
        </details>

        <details class="faq-accordion">
          <summary>What contract and employment types do you offer?</summary>
          <p>
            We support both full-time local employment via Employer of Record (EOR) in primary regions and direct B2B contractor agreements with full IP and compliance protections for international architects.
          </p>
        </details>

        <details class="faq-accordion">
          <summary>What hardware and software stack do you support?</summary>
          <p>
            Engineers receive a $5,000 allowance to spec their ideal hardware (Apple M-Max MacBook Pro, 64GB+ RAM Linux workstations, or dual 4K monitors) along with subscriptions for GitHub Copilot Enterprise, JetBrains, Linear, and Figma.
          </p>
        </details>

        <details class="faq-accordion">
          <summary>What happens after I submit a Vacancy Alert registration?</summary>
          <p>
            Your profile is securely indexed in our internal Talent Pool in the Creed Tech Master Command Center. As soon as a pod is slated for staffing, our Principal Architects review matches and reach out directly before public job announcements.
          </p>
        </details>
      </div>

    </div>
  </section>


  <!-- ================= 6. DIRECT ARCHITECT HOTLINE BANNER ================= -->
  <section style="padding: 4.5rem 0; background: #070D1E; color: #FFFFFF; text-align: center; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; pointer-events: none; background: radial-gradient(circle at 50% 50%, rgba(0, 82, 255, 0.25) 0%, transparent 70%);"></div>
    <div style="max-width: 800px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 10;">
      
      <span style="font-size: 11px; font-weight: 800; color: #00A3FF; text-transform: uppercase; letter-spacing: 0.1em; display: block; margin-bottom: 12px;">
        DIRECT FOUNDER HOTLINE
      </span>

      <h2 style="font-size: clamp(1.75rem, 3.2vw, 2.5rem); font-weight: 800; color: #FFFFFF; letter-spacing: -0.02em; margin: 0 0 16px;">
        Have a specialized systems architecture proposal?
      </h2>

      <p style="font-size: 14.5px; color: #94A3B8; line-height: 1.7; max-width: 620px; margin: 0 auto 28px;">
        If you are an exceptional engineer, cryptographer, or distributed systems architect, you can bypass standard recruiting and email our Founders directly.
      </p>

      <a href="mailto:careers@creed-tech.com" style="display: inline-block; padding: 13px 32px; background: #0052FF; color: #FFFFFF; font-weight: 800; font-size: 13.5px; text-decoration: none; border-radius: 6px; box-shadow: 0 4px 14px rgba(0, 82, 255, 0.5); transition: background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
        Email Technical Profile &bull; careers@creed-tech.com &rarr;
      </a>

    </div>
  </section>

</div>

<!-- ================= 7. INTERACTIVE REGISTRATION MODAL ================= -->
<div id="alertModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(6px); z-index: 9999; align-items: center; justify-content: center; padding: 20px;">
  <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 12px; max-width: 540px; width: 100%; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); position: relative; text-align: left;">
    
    <button type="button" onclick="closeAlertModal()" style="position: absolute; top: 20px; right: 20px; background: #F1F5F9; border: 1px solid #CBD5E1; border-radius: 50%; width: 32px; height: 32px; font-size: 14px; font-weight: 700; color: #64748B; cursor: pointer; display: flex; align-items: center; justify-content: center;">
      ✕
    </button>

    <div style="border-bottom: 2px solid #F1F5F9; padding-bottom: 14px; margin-bottom: 20px;">
      <span style="background: #0052FF; color: #fff; font-size: 10px; font-weight: 800; padding: 3px 8px; border-radius: 3px; letter-spacing: 0.05em; text-transform: uppercase;">
        TALENT POOL &bull; ROLE REGISTRATION
      </span>
      <h3 id="modalRoleTitle" style="font-size: 1.35rem; font-weight: 800; color: #0F172A; margin: 8px 0 2px;">
        Register for Next Engineering Vacancy
      </h3>
      <p style="font-size: 12.5px; color: #64748B; margin: 0;">
        Our Principal Architects will review your coordinates and contact you directly when matching pod vacancies open.
      </p>
    </div>

    <!-- Success Box inside Modal -->
    <div id="alertSuccessBox" style="display: none; padding: 28px 20px; text-align: center; background: #F0FDF4; border: 1px solid #86EFAC; border-radius: 8px;">
      <div style="width: 44px; height: 44px; background: #16A34A; color: #fff; font-size: 20px; font-weight: 800; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; border-radius: 50%;">
        ✓
      </div>
      <h4 style="font-size: 1.2rem; font-weight: 800; color: #14532D; margin: 0 0 6px;">
        Registration Successfully Received!
      </h4>
      <p style="font-size: 13px; color: #166534; margin: 0 0 20px; line-height: 1.6;">
        Your profile has been securely indexed in our private Talent Pool. You will receive priority notifications when the next vacancy cycle commences.
      </p>
      <button type="button" onclick="closeAlertModal()" style="padding: 10px 24px; background: #0F172A; color: #fff; font-size: 12.5px; font-weight: 700; border: none; border-radius: 4px; cursor: pointer;">
        Close Window
      </button>
    </div>

    <!-- Form inside Modal -->
    <form id="alertForm" onsubmit="handleAlertSubmit(event)" style="display: flex; flex-direction: column; gap: 14px;">
      <div>
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Full Name *</label>
        <input type="text" id="alertName" required placeholder="e.g. Julian Alvarez" style="width: 100%; padding: 10px 12px; background: #F8FAFC; border: 1px solid #CBD5E1; font-size: 13.5px; color: #0F172A; border-radius: 4px; box-sizing: border-box; outline: none;">
      </div>

      <div>
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Email Address *</label>
        <input type="email" id="alertEmail" required placeholder="e.g. julian@example.com" style="width: 100%; padding: 10px 12px; background: #F8FAFC; border: 1px solid #CBD5E1; font-size: 13.5px; color: #0F172A; border-radius: 4px; box-sizing: border-box; outline: none;">
      </div>

      <div>
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Technical Specialty &amp; Target Role *</label>
        <input type="text" id="alertSpecialty" required placeholder="e.g. Lead Systems Architect (Rust / Distributed Systems)" style="width: 100%; padding: 10px 12px; background: #F8FAFC; border: 1px solid #CBD5E1; font-size: 13.5px; color: #0F172A; border-radius: 4px; box-sizing: border-box; outline: none;">
      </div>

      <div>
        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">GitHub / Portfolio URL (Optional)</label>
        <input type="url" id="alertUrl" placeholder="https://github.com/yourhandle" style="width: 100%; padding: 10px 12px; background: #F8FAFC; border: 1px solid #CBD5E1; font-size: 13.5px; color: #0F172A; border-radius: 4px; box-sizing: border-box; outline: none;">
      </div>

      <div style="padding-top: 6px;">
        <button type="submit" id="alertSubmitBtn" style="width: 100%; padding: 12px; background: #0052FF; color: #FFFFFF; font-weight: 800; font-size: 13.5px; border: none; border-radius: 6px; cursor: pointer; box-shadow: 0 4px 12px rgba(0, 82, 255, 0.35); transition: background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
          Submit Registration &rarr;
        </button>
      </div>
    </form>

  </div>
</div>

<!-- JAVASCRIPT: Department Filtering & Dynamic Modal Controller -->
<script>
var ALL_CAREER_JOBS = [];
var CURRENT_DEPT_FILTER = 'All';

function filterDepartment(dept, btn) {
  CURRENT_DEPT_FILTER = dept;
  var allBtns = document.querySelectorAll('.dept-filter-btn');
  allBtns.forEach(function(b) {
    b.classList.remove('active');
  });

  if (btn) {
    btn.classList.add('active');
  }

  if (ALL_CAREER_JOBS.length > 0) {
    renderPublicJobs();
  } else {
    var cards = document.querySelectorAll('.job-card-item');
    cards.forEach(function(c) {
      var cardDept = c.getAttribute('data-dept');
      if (dept === 'All' || cardDept === dept) {
        c.style.display = 'flex';
      } else {
        c.style.display = 'none';
      }
    });
  }
}

function loadPublicCareers() {
  fetch('/ajax/careers_admin.php')
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data && data.jobs && data.jobs.length > 0) {
        ALL_CAREER_JOBS = data.jobs;
        renderPublicJobs();
      }
    })
    .catch(function(e){});
}

function renderPublicJobs() {
  var container = document.getElementById('jobsContainer');
  if (!container) return;
  
  var filtered = ALL_CAREER_JOBS;
  if (CURRENT_DEPT_FILTER !== 'All') {
    filtered = filtered.filter(function(j) { return j.department === CURRENT_DEPT_FILTER; });
  }

  if (filtered.length === 0) {
    container.innerHTML = '<div style="padding:40px;text-align:center;color:#64748B;background:#FFFFFF;border:1px solid #E2E8F0;border-radius:8px;">No open roles listed in this department right now. Please register for upcoming alert notifications below.</div>';
    return;
  }

  container.innerHTML = filtered.map(function(job) {
    var tagsHtml = (job.tags || []).map(function(t) {
      return '<span style="padding:2px 8px;background:#F1F5F9;border:1px solid #E2E8F0;color:#334155;font-size:11px;font-family:monospace;border-radius:3px;">' + t + '</span>';
    }).join(' ');

    var st = job.status || 'Announcement Coming Soon';
    var isComingSoon = (st === 'Announcement Coming Soon');
    var isInterviewing = (st === 'Actively Interviewing');
    var isOpen = (st === 'Open Application');
    var isClosed = (st === 'Closed');

    var statusBadgeStyle = isComingSoon 
      ? 'background:#FEF3C7;color:#92400E;border:1px solid #FDE68A;'
      : (isInterviewing 
        ? 'background:#ECFDF5;color:#065F46;border:1px solid #A7F3D0;'
        : (isOpen 
          ? 'background:#EFF6FF;color:#1E40AF;border:1px solid #BFDBFE;'
          : 'background:#F3F4F6;color:#6B7280;border:1px solid #E5E7EB;'));

    var btnHtml = '';
    if (isClosed) {
      btnHtml = '<button type="button" disabled style="padding:10px 22px;background:#E5E7EB;color:#9CA3AF;font-size:12.5px;font-weight:700;border:none;border-radius:4px;cursor:not-allowed;">Closed</button>';
    } else if (isComingSoon) {
      btnHtml = '<button type="button" onclick="openAlertModalForRole(\'' + (job.title || '').replace(/'/g, "\\'") + '\', \'' + (job.department || '').replace(/'/g, "\\'") + '\')" style="padding:10px 22px;background:#F59E0B;color:#fff;font-size:12.5px;font-weight:700;border:none;border-radius:4px;cursor:pointer;box-shadow:0 2px 6px rgba(245,158,11,0.3);">' +
        '🔔 Register for Alert' +
      '</button>';
    } else {
      btnHtml = '<button type="button" onclick="openAlertModalForRole(\'' + (job.title || '').replace(/'/g, "\\'") + '\', \'' + (job.department || '').replace(/'/g, "\\'") + '\')" style="padding:10px 22px;background:#0052FF;color:#fff;font-size:12.5px;font-weight:700;border:none;border-radius:4px;cursor:pointer;box-shadow:0 2px 6px rgba(0,82,255,0.35);">' +
        '🚀 Apply Now' +
      '</button>';
    }

    return '<div class="job-card-item" data-dept="' + job.department + '">' +
      '<div style="max-width:760px;display:flex;flex-direction:column;gap:8px;">' +
        '<div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">' +
          '<span style="padding:3px 8px;background:#EFF6FF;color:#0052FF;border-radius:3px;border:1px solid #DBEAFE;">' + job.department + '</span>' +
          '<span style="padding:3px 8px;background:#F3F4F6;color:#374151;border-radius:3px;">📍 ' + job.location + '</span>' +
          '<span style="padding:3px 8px;border-radius:3px;' + statusBadgeStyle + '">' + st + '</span>' +
        '</div>' +
        '<h3 style="font-size:1.3rem;font-weight:800;color:#0F172A;line-height:1.25;margin:2px 0 0;">' + job.title + '</h3>' +
        '<p style="font-size:13.5px;color:#475569;line-height:1.6;margin:0;">' + job.description + '</p>' +
        '<div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;padding-top:4px;">' +
          tagsHtml +
        '</div>' +
      '</div>' +
      '<div>' +
        btnHtml +
      '</div>' +
    '</div>';
  }).join('');
}

function openAlertModal() {
  document.getElementById('alertForm').reset();
  document.getElementById('alertForm').style.display = 'flex';
  document.getElementById('alertSuccessBox').style.display = 'none';
  document.getElementById('modalRoleTitle').textContent = 'Register for Next Engineering Vacancy';
  document.getElementById('alertModal').style.display = 'flex';
}

function openAlertModalForRole(roleTitle, dept) {
  openAlertModal();
  document.getElementById('modalRoleTitle').textContent = roleTitle;
  var specInput = document.getElementById('alertSpecialty');
  if (specInput) {
    specInput.value = roleTitle + ' (' + dept + ')';
  }
}

function closeAlertModal() {
  document.getElementById('alertModal').style.display = 'none';
}

function handleAlertSubmit(e) {
  if (e) e.preventDefault();
  
  var nameEl = document.getElementById('alertName');
  var emailEl = document.getElementById('alertEmail');
  var specEl = document.getElementById('alertSpecialty');
  var urlEl = document.getElementById('alertUrl');
  var submitBtn = document.getElementById('alertSubmitBtn');

  if (!nameEl || !emailEl || !nameEl.value.trim() || !emailEl.value.trim()) {
    alert('Please enter both your Full Name and Email address.');
    return;
  }

  var nameVal = nameEl.value.trim();
  var emailVal = emailEl.value.trim();
  var specVal = specEl ? (specEl.value.trim() || 'Engineering') : 'Engineering';
  var urlVal = urlEl ? urlEl.value.trim() : '';

  if (submitBtn) {
    submitBtn.disabled = true;
    submitBtn.innerText = '⏳ Submitting Profile...';
    submitBtn.style.opacity = '0.7';
  }

  var payload = {
    action: 'create_applicant',
    fullName: nameVal,
    email: emailVal,
    specialty: specVal,
    portfolioUrl: urlVal
  };

  fetch('/ajax/careers_admin.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.innerText = 'Submit Registration →';
      submitBtn.style.opacity = '1';
    }
    document.getElementById('alertForm').style.display = 'none';
    document.getElementById('alertSuccessBox').style.display = 'block';
  })
  .catch(function(err) {
    if (submitBtn) {
      submitBtn.disabled = false;
      submitBtn.innerText = 'Submit Registration →';
      submitBtn.style.opacity = '1';
    }
    document.getElementById('alertForm').style.display = 'none';
    document.getElementById('alertSuccessBox').style.display = 'block';
  });
}

document.addEventListener('DOMContentLoaded', function() {
  loadPublicCareers();
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
