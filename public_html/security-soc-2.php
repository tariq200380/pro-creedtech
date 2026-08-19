<?php
$page_title = "AICPA SOC 2 Type II Audited Controls & Architecture | Creed Tech";
$page_description = "In-depth overview of AICPA SOC 2 Type II Trust Services Criteria (Security, Availability, Confidentiality) and Creed Tech operational enforcement.";
$active_page = "security";

include __DIR__ . '/includes/header.php';
?>

<style>
.sec-container {
  max-width: 80rem;
  margin: 0 auto;
  padding: 0 2rem;
  box-sizing: border-box;
}
.sec-hero-grid {
  display: grid;
  grid-template-columns: 3fr 2fr;
  gap: 2.5rem;
  align-items: center;
  width: 100%;
}
.sec-grid-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 1.5rem;
  text-align: left;
  width: 100%;
}
.sec-cc-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 1.25rem;
  text-align: left;
  width: 100%;
}

@media (max-width: 768px) {
  .sec-container {
    padding: 0 1.25rem !important;
  }
  .sec-hero-grid {
    grid-template-columns: 1fr !important;
    gap: 2rem !important;
  }
  .sec-grid-cards,
  .sec-cc-grid {
    grid-template-columns: 1fr !important;
    gap: 1rem !important;
  }
  .sec-btn-group {
    flex-direction: column !important;
    align-items: stretch !important;
  }
  .sec-btn-group a {
    text-align: center !important;
    width: 100% !important;
    box-sizing: border-box;
  }
}
</style>

<div style="width:100%;background:#fff;color:#111827;font-family:sans-serif;text-align:left;">
  
  <!-- 1. AICPA Live Console Hero -->
  <section style="width:100%;padding:3.5rem 0;background:#0B1120;color:#fff;border-bottom:1px solid #1A233A;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 80% 20%, rgba(0, 82, 255, 0.15) 0%, transparent 50%);"></div>

    <div class="sec-container" style="position:relative;z-index:10;">
      
      <div style="display:flex;align-items:center;gap:8px;font-size:11px;font-weight:700;color:#60A5FA;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;flex-wrap:wrap;">
        <a href="security" style="color:#60A5FA;text-decoration:none;">Security Center</a>
        <span>/</span>
        <span style="color:#9CA3AF;">SOC 2 Type II</span>
      </div>

      <div class="sec-hero-grid">
        
        <!-- Left Col -->
        <div>
          <span style="display:inline-block;padding:2px 10px;background:#172554;border:1px solid #1E40AF;color:#93C5FD;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:12px;flex-wrap:wrap;">
            AICPA SSAE 18 CRITERIA • DURHAM, NC &amp; NYC, USA
          </span>

          <h1 style="font-size:clamp(1.75rem,3.5vw,2.75rem);font-weight:700;letter-spacing:-0.03em;color:#fff;line-height:1.2;margin:0 0 1rem;">
            SOC 2 Type II <br />
            <span style="color:#0052FF;">Audited Trust Services Controls</span>
          </h1>

          <p style="font-size:13px;color:#D1D5DB;line-height:1.7;font-weight:400;max-width:36rem;margin:0 0 1.5rem;">
            The American Institute of CPAs (AICPA, USA) establishes the definitive benchmark for SaaS security. Creed Tech operates under continuous 12-month live observation testing Security, Availability (99.99%), and Confidentiality.
          </p>

          <!-- Compact Buttons -->
          <div class="sec-btn-group" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <a href="contact" style="padding:8px 16px;background:#0052FF;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 1px 2px rgba(0,82,255,0.2);transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
              Request SOC 2 Type II Report
            </a>
            <a href="security" style="padding:8px 16px;background:#1E293B;color:#E2E8F0;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border:1px solid #334155;border-radius:2px;transition:background 0.2s;" onmouseover="this.style.background='#334155'" onmouseout="this.style.background='#1E293B'">
              All Security Standards
            </a>
          </div>
        </div>

        <!-- Right Col: Live Observation Console Box -->
        <div style="background:#11192E;border:1px solid #1E40AF;border-radius:12px;padding:1.5rem;box-shadow:0 20px 25px -5px rgba(0,0,0,0.3);">
          <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #1F2937;padding-bottom:10px;margin-bottom:12px;">
            <div style="display:flex;align-items:center;gap:8px;">
              <span style="width:8px;height:8px;background:#4ADE80;border-radius:50%;display:inline-block;"></span>
              <span style="font-size:12px;font-weight:700;color:#E5E7EB;">AICPA SSAE 18 / AT-C 205</span>
            </div>
            <span style="font-size:10px;font-family:monospace;color:#4ADE80;background:rgba(20,83,45,0.8);padding:2px 8px;border-radius:2px;border:1px solid #166534;">
              UNQUALIFIED CLEAN OPINION
            </span>
          </div>

          <div style="display:flex;flex-direction:column;gap:8px;font-size:11px;font-family:monospace;">
            <div style="display:flex;justify-content:space-between;padding:4px 0;border-bottom:1px solid rgba(31,41,55,0.6);">
              <span style="color:#9CA3AF;font-family:sans-serif;">Audit Standard:</span>
              <span style="color:#fff;">SOC 2 Type II (12-Month)</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:4px 0;border-bottom:1px solid rgba(31,41,55,0.6);">
              <span style="color:#9CA3AF;font-family:sans-serif;">Audited Criteria:</span>
              <span style="color:#93C5FD;">Security, Availability, Confidentiality</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:4px 0;border-bottom:1px solid rgba(31,41,55,0.6);">
              <span style="color:#9CA3AF;font-family:sans-serif;">Exceptions Found:</span>
              <span style="color:#4ADE80;font-weight:700;">0 Material Exceptions</span>
            </div>
            <div style="display:flex;justify-content:space-between;padding:4px 0;">
              <span style="color:#9CA3AF;font-family:sans-serif;">Auditor:</span>
              <span style="color:#D1D5DB;">Independent Certified CPA Firm</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 2. Difference Between Type I and Type II -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          AUDIT RIGOR
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          Why SOC 2 Type II is the True Enterprise Benchmark
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          Many software vendors settle for a basic Type I snapshot. Creed Tech undergoes the comprehensive Type II audit:
        </p>
      </div>

      <div class="sec-grid-cards">
        
        <div style="padding:1.75rem;background:#F9FAFB;border:1px solid #E5E7EB;border-radius:2px;opacity:0.85;">
          <span style="font-size:11px;font-weight:700;color:#6B7280;text-transform:uppercase;display:block;margin-bottom:4px;">SOC 2 TYPE I (BASIC)</span>
          <h3 style="font-size:1.15rem;font-weight:700;color:#1F2937;margin:0 0 8px;">Single Point-in-Time Review</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0 0 12px;">
            Examines only whether security policies are designed properly on a single chosen day. Does not verify whether controls were actually followed in daily engineering practice.
          </p>
          <span style="font-size:12px;font-weight:600;color:#6B7280;">Theoretical Design Only</span>
        </div>

        <div style="padding:1.75rem;background:#fff;border:2px solid #0052FF;border-radius:2px;box-shadow:0 4px 6px -1px rgba(0,82,255,0.1);">
          <span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;display:block;margin-bottom:4px;">SOC 2 TYPE II (CREED TECH STANDARD)</span>
          <h3 style="font-size:1.15rem;font-weight:700;color:#111827;margin:0 0 8px;">12-Month Live Operational Proof</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0 0 12px;">
            Independent CPA auditors test random operational samples over a continuous 12-month window: verifying every code PR, deployment log, access revocation, and disaster recovery drill.
          </p>
          <span style="display:inline-block;padding:2px 10px;background:#F0FDF4;color:#15803D;font-size:12px;font-weight:600;border:1px solid #BBF7D0;border-radius:2px;">
            12-Month Proven Operating Effectiveness
          </span>
        </div>

      </div>

    </div>
  </section>

  <!-- 3. Common Criteria (CC1 to CC9) -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;background:#F4F8FF;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          TRUST CRITERIA BREAKDOWN
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          AICPA Common Criteria (CC1-CC9) Enforcement
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          How Creed Tech implements and proves compliance across the 9 core control categories:
        </p>
      </div>

      <div class="sec-cc-grid">
        
        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">CC1 &amp; CC2</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Control Environment &amp; Comm</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Executive governance, mandatory background checks, code of conduct enforcement, and transparent communication of security responsibilities.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">CC3 &amp; CC4</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Risk Assessment &amp; Monitoring</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Continuous automated vulnerability telemetry, weekly threat modeling, and real-time SIEM alerts evaluated against documented risk appetite.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">CC5 &amp; CC6</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Logical &amp; Physical Access</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Zero standing administrative privileges, mandatory WebAuthn 2FA, session recording, and automated access deprovisioning within 1 hour of role change.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">CC7</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">System Operations &amp; Incident Mgmt</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Immutable audit logging, anti-malware telemetry, file integrity monitoring (FIM), and guaranteed sub-15 minute critical incident response.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">CC8</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Change Management</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Mandatory peer review on all PRs, automated SAST/DAST unit testing, separation of dev/staging/prod environments, and single-click rollbacks.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">CC9</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Vendor &amp; Supplier Risk</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Mandatory annual SOC 2 review of all cloud providers (AWS, GCP, Cloudflare) and strict contractual security minimums.
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- Dark Security CTA -->
  <section style="width:100%;background:#0B1120;padding:4rem 0;color:#fff;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 50%, rgba(255, 107, 0, 0.18) 0%, transparent 65%);"></div>
    <div class="sec-container" style="position:relative;max-width:48rem;z-index:10;">
      <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#fff;margin:0 0 12px;">
        Undergoing Enterprise Vendor Risk Assessment?
      </h2>
      <p style="color:#D1D5DB;font-size:13px;line-height:1.6;margin:0 auto 1.5rem;max-width:36rem;font-weight:400;">
        We provide pre-filled SIG Core questionnaires, CAIQ documentation, and our full independent SOC 2 Type II audit report under standard mutual NDA.
      </p>
      <a href="contact" style="display:inline-block;padding:8px 20px;background:#FF6B00;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#EA580C'" onmouseout="this.style.background='#FF6B00'">
        Request SOC 2 Type II Audit Report
      </a>
    </div>
  </section>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
