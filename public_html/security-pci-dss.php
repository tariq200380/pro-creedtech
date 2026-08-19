<?php
$page_title = "PCI SSC PCI-DSS v4.0 Level 1 Payment Architecture | Creed Tech";
$page_description = "Comprehensive guide to PCI Security Standards Council (Wakefield, MA, USA), the 12 PCI-DSS requirements, and Creed Tech's scope-reducing fintech architectures.";
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
  .sec-grid-cards {
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
  
  <!-- 1. FinTech Pipeline Blueprint Hero -->
  <section style="width:100%;padding:3.5rem 0;background:#F4F8FF;border-bottom:1px solid #D6E4FF;position:relative;overflow:hidden;">
    <div class="sec-container">
      
      <div style="display:flex;align-items:center;gap:8px;font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;flex-wrap:wrap;">
        <a href="security" style="color:#0052FF;text-decoration:none;">Security Center</a>
        <span>/</span>
        <span style="color:#4B5563;">PCI-DSS v4.0</span>
      </div>

      <div class="sec-hero-grid">
        
        <!-- Left Col -->
        <div>
          <span style="display:inline-block;padding:2px 10px;background:#DBEAFE;color:#1E40AF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:12px;flex-wrap:wrap;">
            PAYMENT CARD INDUSTRY COUNCIL • WAKEFIELD, MA, USA
          </span>

          <h1 style="font-size:clamp(1.75rem,3.5vw,2.75rem);font-weight:700;letter-spacing:-0.03em;color:#111827;line-height:1.2;margin:0 0 1rem;">
            PCI-DSS v4.0 <br />
            <span style="color:#0052FF;">FinTech &amp; Tokenized Payment Architecture</span>
          </h1>

          <p style="font-size:13px;color:#4B5563;line-height:1.7;font-weight:400;max-width:36rem;margin:0 0 1.5rem;">
            Founded by Visa, MasterCard, Amex, Discover, and JCB, the PCI SSC enforces global payment card security. Creed Tech architects client-side tokenization flows that eliminate raw PAN exposure and reduce your PCI audit burden by over 90%.
          </p>

          <!-- Compact Buttons -->
          <div class="sec-btn-group" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <a href="contact" style="padding:8px 16px;background:#0052FF;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 1px 2px rgba(0,82,255,0.2);transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
              Consult Payment Architect
            </a>
            <a href="security" style="padding:8px 16px;background:#fff;color:#374151;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border:1px solid #D1D5DB;border-radius:2px;transition:background 0.2s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='#fff'">
              All Security Standards
            </a>
          </div>
        </div>

        <!-- Right Col: Tokenization Pipeline Visual Card -->
        <div style="background:#fff;border:1px solid #D6E4FF;border-radius:12px;padding:1.5rem;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #F3F4F6;padding-bottom:10px;margin-bottom:12px;">
            <span style="font-size:11px;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;">Zero-PAN Tokenization</span>
            <span style="font-size:10px;font-weight:700;color:#15803D;background:#F0FDF4;padding:2px 8px;border-radius:2px;border:1px solid #BBF7D0;">SAQ A SCOPE</span>
          </div>

          <!-- 3 Step Flow -->
          <div style="display:flex;flex-direction:column;gap:10px;font-size:12px;">
            <div style="padding:10px 12px;background:#F9FAFB;border:1px solid #E5E7EB;border-radius:2px;">
              <span style="font-size:10px;font-weight:700;color:#9CA3AF;display:block;margin-bottom:2px;">STEP 1: BROWSER IFRAME</span>
              <p style="font-family:monospace;font-size:11px;color:#374151;margin:0;">Cardholder Data → Direct Vault Iframe</p>
            </div>
            
            <div style="text-align:center;font-weight:700;color:#2563EB;font-size:12px;line-height:1;">↓</div>

            <div style="padding:10px 12px;background:#EFF6FF;border:1px solid #BFDBFE;border-radius:2px;">
              <span style="font-size:10px;font-weight:700;color:#2563EB;display:block;margin-bottom:2px;">STEP 2: ENCRYPTED VAULT</span>
              <p style="font-family:monospace;font-size:11px;color:#1E3A8A;margin:0;">Vault converts PAN into Token: 'tok_sec_99a'</p>
            </div>

            <div style="text-align:center;font-weight:700;color:#2563EB;font-size:12px;line-height:1;">↓</div>

            <div style="padding:10px 12px;background:#F0FDF4;border:1px solid #BBF7D0;border-radius:2px;">
              <span style="font-size:10px;font-weight:700;color:#15803D;display:block;margin-bottom:2px;">STEP 3: CLIENT SERVER</span>
              <p style="font-family:monospace;font-size:11px;color:#14532D;margin:0;">Server receives Token only • Zero Cardholder Scope</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 2. The 6 Core Goals & 12 PCI-DSS Requirements -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          STATUTORY MATRIX
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          The 6 Goals &amp; 12 Statutory PCI-DSS Requirements
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          PCI-DSS v4.0 establishes 12 mandatory technical requirements organized under 6 core security objectives:
        </p>
      </div>

      <div class="sec-grid-cards">
        
        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">GOAL 1 • SECURE NETWORK</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Req 1 &amp; 2: Firewalls &amp; Defaults</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Maintain network firewalls isolating cardholder data environments (CDE) and strictly forbid vendor-supplied default passwords or configuration parameters.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">GOAL 2 • PROTECT CARD DATA</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Req 3 &amp; 4: Encryption &amp; Transit</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Protect stored account data with AES-256 GCM encryption and enforce strong cryptography (TLS 1.3) during transmission over open, public networks.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">GOAL 3 • VULNERABILITY MGMT</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Req 5 &amp; 6: Malware &amp; Secure Code</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Deploy automated anti-malware telemetry and develop secure software following OWASP Top 10 guidelines with automated SAST code reviews.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">GOAL 4 • ACCESS CONTROL</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Req 7 &amp; 8: Need-to-Know &amp; MFA</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Restrict cardholder access to business need-to-know, assign unique user IDs, and enforce mandatory multi-factor authentication (MFA) on all CDE access.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">GOAL 5 • MONITOR &amp; TEST</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Req 9 &amp; 10: Physical &amp; Audit Logs</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Restrict physical server room access and log all network and database queries with immutable audit trails synchronized to NTP atomic clocks.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">GOAL 6 • SECURITY POLICY</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Req 11 &amp; 12: ASV Scans &amp; Policies</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Conduct quarterly external ASV vulnerability scans, annual third-party penetration testing, and maintain formal governance policies.
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
        Building an E-Commerce Checkout or FinTech Payment Engine?
      </h2>
      <p style="color:#D1D5DB;font-size:13px;line-height:1.6;margin:0 auto 1.5rem;max-width:36rem;font-weight:400;">
        Our certified payment architects design tokenized, scope-reduced checkout flows that pass PCI audits effortlessly.
      </p>
      <a href="contact" style="display:inline-block;padding:8px 20px;background:#FF6B00;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#EA580C'" onmouseout="this.style.background='#FF6B00'">
        Start FinTech Architecture
      </a>
    </div>
  </section>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
