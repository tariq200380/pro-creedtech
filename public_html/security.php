<?php
$page_title = "Enterprise Trust & Security Center | Creed Tech";
$page_description = "Explore Creed Tech's security engineering architecture, enterprise trust models, compliance readiness (ISO 27001, GDPR, SOC 2, PCI-DSS), and data governance safeguards.";
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
.sec-metric-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  text-align: center;
  width: 100%;
}
.sec-grid-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 1.5rem;
  max-width: 72rem;
  text-align: left;
  width: 100%;
}
.sec-arch-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.25rem;
  text-align: left;
  width: 100%;
}

.sec-table-desktop {
  display: block;
  width: 100%;
  overflow-x: auto;
}
.sec-cards-mobile {
  display: none;
}

@media (max-width: 768px) {
  .sec-container {
    padding: 0 1.25rem !important;
  }
  .sec-metric-grid {
    grid-template-columns: 1fr 1fr !important;
    gap: 1.25rem !important;
  }
  .sec-grid-cards,
  .sec-arch-grid {
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
  .sec-table-desktop {
    display: none !important;
  }
  .sec-cards-mobile {
    display: flex !important;
    flex-direction: column;
    gap: 1rem;
    width: 100%;
  }
}
</style>

<div style="width:100%;background:#fff;color:#111827;font-family:sans-serif;text-align:left;">
  
  <!-- 1. Header Banner -->
  <section style="width:100%;padding:3.5rem 0;background:#F8FAFC;border-bottom:1px solid #E5E7EB;position:relative;overflow:hidden;text-align:center;">
    <div class="sec-container" style="max-width:64rem;">
      
      <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 12px;background:#EFF6FF;border:1px solid #BFDBFE;color:#1E40AF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:1rem;flex-wrap:wrap;">
        <span style="width:6px;height:6px;background:#2563EB;border-radius:50%;display:inline-block;"></span>
        <span>ENTERPRISE TRUST, GOVERNANCE &amp; COMPLIANCE CENTER</span>
      </div>

      <h1 style="font-size:clamp(1.75rem,4vw,3rem);font-weight:700;letter-spacing:-0.03em;color:#111827;line-height:1.2;margin:0 0 1rem;">
        Enterprise Trust &amp; Security Center
      </h1>

      <p style="font-size:clamp(0.875rem,1.5vw,1rem);color:#4B5563;line-height:1.7;font-weight:400;max-width:48rem;margin:0 auto 1.5rem;">
        At Creed Tech, security is deeply engineered into our infrastructure, software development lifecycles, and corporate governance. Explore our standards-aligned security architecture, operational posture metrics, and technical protection models engineered for enterprise compliance.
      </p>

      <!-- Compact Action Buttons -->
      <div class="sec-btn-group" style="display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;margin-bottom:2rem;">
        <a href="contact" style="padding:8px 16px;background:#0052FF;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 1px 2px rgba(0,82,255,0.2);transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
          Request Security Architecture Overview
        </a>
        <a href="#frameworks" style="padding:8px 16px;background:#fff;color:#374151;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border:1px solid #D1D5DB;border-radius:2px;transition:background 0.2s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='#fff'">
          Explore 4 Compliance Frameworks ↓
        </a>
      </div>

    </div>
  </section>

  <!-- 2. Live Telemetry Metric Strip -->
  <section style="width:100%;padding:2rem 0;background:#0B1120;color:#fff;border-bottom:1px solid #111827;">
    <div class="sec-container">
      <div class="sec-metric-grid">
      
      <div style="display:flex;flex-direction:column;align-items:center;">
        <span style="font-size:1.35rem;font-weight:700;color:#fff;margin-bottom:4px;letter-spacing:-0.01em;">High Availability</span>
        <span style="font-size:11px;color:#9CA3AF;font-weight:500;">Resilient Cloud Architecture</span>
      </div>

      <div style="display:flex;flex-direction:column;align-items:center;">
        <span style="font-size:1.35rem;font-weight:700;color:#fff;margin-bottom:4px;letter-spacing:-0.01em;">Zero-Trust</span>
        <span style="font-size:11px;color:#9CA3AF;font-weight:500;">Proactive Risk Mitigation</span>
      </div>

      <div style="display:flex;flex-direction:column;align-items:center;">
        <span style="font-size:1.35rem;font-weight:700;color:#fff;margin-bottom:4px;letter-spacing:-0.01em;">Centralized SIEM</span>
        <span style="font-size:11px;color:#9CA3AF;font-weight:500;">Security Telemetry &amp; Alerting</span>
      </div>

      <div style="display:flex;flex-direction:column;align-items:center;">
        <span style="font-size:1.35rem;font-weight:700;color:#fff;margin-bottom:4px;letter-spacing:-0.01em;">Rapid Triage</span>
        <span style="font-size:11px;color:#9CA3AF;font-weight:500;">Structured Incident Playbooks</span>
      </div>

    </div>
  </section>

  <!-- 3. The 4 Security Frameworks Hub Cards -->
  <section id="frameworks" style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          STANDARDS ALIGNMENT
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          Enterprise Compliance &amp; Security Frameworks
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          Click on any framework below to inspect its governing authority, statutory requirements, and Creed Tech's client implementation architecture:
        </p>
      </div>

      <div class="sec-grid-cards">
        
        <!-- Card 1: ISO 27001 -->
        <a href="security-iso-27001" style="display:flex;flex-direction:column;justify-content:space-between;padding:1.75rem;background:#fff;border:1px solid #DBEAFE;border-radius:2px;text-decoration:none;box-shadow:0 1px 2px rgba(0,0,0,0.05);transition:all 0.3s;" onmouseover="this.style.borderColor='#0052FF';this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.borderColor='#DBEAFE';this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span style="font-size:10px;font-weight:700;color:#374151;background:#F3F4F6;padding:2px 8px;border-radius:2px;text-transform:uppercase;letter-spacing:0.05em;">FRAMEWORK ALIGNED</span>
              <span style="font-size:12px;font-weight:600;color:#0052FF;">View Architecture →</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin:0 0 4px;">ISO/IEC 27001:2022</h3>
            <span style="font-size:11px;font-weight:600;color:#6B7280;display:block;margin-bottom:8px;">ISO &amp; IEC • Geneva, Switzerland</span>
            <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
              Comprehensive security governance aligned with all 93 Annex A controls, secure engineering lifecycle, access controls, and risk management.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;justify-content:space-between;font-size:11px;color:#9CA3AF;">
            <span>Standards Aligned</span>
            <span style="font-weight:600;color:#374151;">Explore Full Breakdown</span>
          </div>
        </a>

        <!-- Card 2: GDPR -->
        <a href="security-gdpr" style="display:flex;flex-direction:column;justify-content:space-between;padding:1.75rem;background:#fff;border:1px solid #FDE68A;border-radius:2px;text-decoration:none;box-shadow:0 1px 2px rgba(0,0,0,0.05);transition:all 0.3s;" onmouseover="this.style.borderColor='#F59E0B';this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.borderColor='#FDE68A';this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span style="font-size:10px;font-weight:700;color:#374151;background:#F3F4F6;padding:2px 8px;border-radius:2px;text-transform:uppercase;letter-spacing:0.05em;">PRIVACY BY DESIGN</span>
              <span style="font-size:12px;font-weight:600;color:#0052FF;">View Architecture →</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin:0 0 4px;">EU GDPR Regulation (EU) 2016/679</h3>
            <span style="font-size:11px;font-weight:600;color:#6B7280;display:block;margin-bottom:8px;">European Data Protection Board • Brussels, Belgium</span>
            <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
              Structured Article 28 Data Processing Agreement (DPA) templates, European data residency architecture, automated DSAR workflows, and Privacy by Design.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;justify-content:space-between;font-size:11px;color:#9CA3AF;">
            <span>Privacy Aligned</span>
            <span style="font-weight:600;color:#374151;">Explore Full Breakdown</span>
          </div>
        </a>

        <!-- Card 3: SOC 2 -->
        <a href="security-soc-2" style="display:flex;flex-direction:column;justify-content:space-between;padding:1.75rem;background:#fff;border:1px solid #BBF7D0;border-radius:2px;text-decoration:none;box-shadow:0 1px 2px rgba(0,0,0,0.05);transition:all 0.3s;" onmouseover="this.style.borderColor='#16A34A';this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.borderColor='#BBF7D0';this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span style="font-size:10px;font-weight:700;color:#374151;background:#F3F4F6;padding:2px 8px;border-radius:2px;text-transform:uppercase;letter-spacing:0.05em;">TRUST SERVICES READY</span>
              <span style="font-size:12px;font-weight:600;color:#0052FF;">View Architecture →</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin:0 0 4px;">AICPA SOC 2 Type II</h3>
            <span style="font-size:11px;font-weight:600;color:#6B7280;display:block;margin-bottom:8px;">American Institute of CPAs • USA</span>
            <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
              Engineered to meet AICPA SOC 2 Type II Trust Services Criteria across Security, Availability, and Confidentiality controls.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;justify-content:space-between;font-size:11px;color:#9CA3AF;">
            <span>Framework Aligned</span>
            <span style="font-weight:600;color:#374151;">Explore Full Breakdown</span>
          </div>
        </a>

        <!-- Card 4: PCI-DSS -->
        <a href="security-pci-dss" style="display:flex;flex-direction:column;justify-content:space-between;padding:1.75rem;background:#fff;border:1px solid #C7D2FE;border-radius:2px;text-decoration:none;box-shadow:0 1px 2px rgba(0,0,0,0.05);transition:all 0.3s;" onmouseover="this.style.borderColor='#4F46E5';this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)'" onmouseout="this.style.borderColor='#C7D2FE';this.style.boxShadow='0 1px 2px rgba(0,0,0,0.05)'">
          <div>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span style="font-size:10px;font-weight:700;color:#374151;background:#F3F4F6;padding:2px 8px;border-radius:2px;text-transform:uppercase;letter-spacing:0.05em;">SCOPE REDUCED</span>
              <span style="font-size:12px;font-weight:600;color:#0052FF;">View Architecture →</span>
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#111827;margin:0 0 4px;">PCI-DSS Version 4.0</h3>
            <span style="font-size:11px;font-weight:600;color:#6B7280;display:block;margin-bottom:8px;">PCI Security Standards Council • Wakefield, MA, USA</span>
            <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
              Client-side payment tokenization and isolated architectures designed to minimize cardholder data environment (CDE) scope under PCI-DSS v4.0.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #F3F4F6;display:flex;align-items:center;justify-content:space-between;font-size:11px;color:#9CA3AF;">
            <span>Scope Optimized</span>
            <span style="font-weight:600;color:#374151;">Explore Full Breakdown</span>
          </div>
        </a>

      </div>

    </div>
  </section>

  <!-- 4. 4-Layer Defense-in-Depth Architecture -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;background:#F8FAFC;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          DEFENSE IN DEPTH
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          4-Layer Enterprise Security Architecture
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          We employ layered technical and operational safeguards to protect client systems against advanced threat vectors:
        </p>
      </div>

      <div class="sec-arch-grid">
        
        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:12px;font-weight:700;color:#0052FF;display:block;margin-bottom:4px;">01</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 8px;">Zero-Trust Identity &amp; Access (IAM)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">Mandatory hardware WebAuthn 2FA, biometric facility checkpoints, zero standing administrative privileges (ZSP), and session recording.</p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:12px;font-weight:700;color:#0052FF;display:block;margin-bottom:4px;">02</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 8px;">Cryptographic Protection</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">AES-256 GCM encryption at rest with envelope key management, TLS 1.3 in transit with strict HSTS, and secure key custody via cloud-managed KMS services.</p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:12px;font-weight:700;color:#0052FF;display:block;margin-bottom:4px;">03</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 8px;">Secure Development Lifecycle (SSDLC)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">CI/CD SAST/DAST vulnerability scanning, structured peer code review, version-controlled source management, and authorized penetration testing within agreed client scope.</p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <span style="font-size:12px;font-weight:700;color:#0052FF;display:block;margin-bottom:4px;">04</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 8px;">24/7 Threat Telemetry &amp; SIEM</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">Real-time behavioral threat detection, immutable audit logs with atomic clock synchronization, and automated failover disaster recovery.</p>
        </div>

      </div>

    </div>
  </section>

  <!-- 5. Sub-Processor Transparency Matrix -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          SUPPLIER GOVERNANCE
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          Audited Enterprise Sub-Processors
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          Following ISO 27001 (A.5.19) and GDPR (Article 28) supplier governance guidelines, all infrastructure sub-processors undergo rigorous security evaluation:
        </p>
      </div>

      <!-- Desktop Table -->
      <div class="sec-table-desktop">
        <table style="width:100%;text-align:left;border-collapse:collapse;border:1px solid #E5E7EB;font-size:12px;">
          <thead>
            <tr style="background:#F9FAFB;border-bottom:1px solid #E5E7EB;">
              <th style="padding:14px;font-weight:700;color:#111827;">Sub-Processor</th>
              <th style="padding:14px;font-weight:700;color:#111827;">Role / Processing Activity</th>
              <th style="padding:14px;font-weight:700;color:#111827;">Data Location</th>
              <th style="padding:14px;font-weight:700;color:#111827;">Audited Certifications</th>
            </tr>
          </thead>
          <tbody style="divide-y:1px solid #E5E7EB;">
            <tr style="border-bottom:1px solid #F3F4F6;">
              <td style="padding:14px;font-weight:700;color:#111827;">Amazon Web Services (AWS)</td>
              <td style="padding:14px;color:#374151;">Primary Cloud Infrastructure &amp; KMS</td>
              <td style="padding:14px;color:#374151;">Frankfurt / Ireland / US-East</td>
              <td style="padding:14px;font-weight:600;color:#1D4ED8;">ISO 27001, SOC 2, PCI-DSS, FedRAMP</td>
            </tr>
            <tr style="border-bottom:1px solid #F3F4F6;">
              <td style="padding:14px;font-weight:700;color:#111827;">Google Cloud Platform (GCP)</td>
              <td style="padding:14px;color:#374151;">AI &amp; Data Pipeline Processing</td>
              <td style="padding:14px;color:#374151;">Belgium / Frankfurt / Iowa</td>
              <td style="padding:14px;font-weight:600;color:#1D4ED8;">ISO 27001, SOC 2, HIPAA, GDPR</td>
            </tr>
            <tr style="border-bottom:1px solid #F3F4F6;">
              <td style="padding:14px;font-weight:700;color:#111827;">Cloudflare Enterprise</td>
              <td style="padding:14px;color:#374151;">Edge WAF, DDoS Mitigation &amp; DNS</td>
              <td style="padding:14px;color:#374151;">Global Edge Network (300+ Cities)</td>
              <td style="padding:14px;font-weight:600;color:#1D4ED8;">SOC 2 Type II, ISO 27001, PCI-DSS</td>
            </tr>
            <tr>
              <td style="padding:14px;font-weight:700;color:#111827;">GitHub Enterprise</td>
              <td style="padding:14px;color:#374151;">Encrypted Source Code Management</td>
              <td style="padding:14px;color:#374151;">US / Multi-Region Secure Cloud</td>
              <td style="padding:14px;font-weight:600;color:#1D4ED8;">SOC 2 Type II, ISO 27001</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Mobile Responsive Cards -->
      <div class="sec-cards-mobile">
        <div style="background:#fff;border:1px solid #E5E7EB;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #F3F4F6;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#111827;">Amazon Web Services (AWS)</span>
            <span style="font-size:10px;font-weight:700;color:#1D4ED8;background:#EFF6FF;padding:2px 8px;border-radius:2px;">Primary Cloud</span>
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Role:</strong> Primary Cloud Infrastructure &amp; KMS
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Location:</strong> Frankfurt / Ireland / US-East
          </div>
          <div style="font-size:12px;color:#1D4ED8;font-weight:600;line-height:1.5;">
            <strong style="color:#111827;">Certifications:</strong> ISO 27001, SOC 2, PCI-DSS, FedRAMP
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E5E7EB;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #F3F4F6;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#111827;">Google Cloud Platform (GCP)</span>
            <span style="font-size:10px;font-weight:700;color:#1D4ED8;background:#EFF6FF;padding:2px 8px;border-radius:2px;">AI &amp; Data</span>
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Role:</strong> AI &amp; Data Pipeline Processing
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Location:</strong> Belgium / Frankfurt / Iowa
          </div>
          <div style="font-size:12px;color:#1D4ED8;font-weight:600;line-height:1.5;">
            <strong style="color:#111827;">Certifications:</strong> ISO 27001, SOC 2, HIPAA, GDPR
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E5E7EB;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #F3F4F6;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#111827;">Cloudflare Enterprise</span>
            <span style="font-size:10px;font-weight:700;color:#1D4ED8;background:#EFF6FF;padding:2px 8px;border-radius:2px;">Edge &amp; WAF</span>
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Role:</strong> Edge WAF, DDoS Mitigation &amp; DNS
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Location:</strong> Global Edge Network (300+ Cities)
          </div>
          <div style="font-size:12px;color:#1D4ED8;font-weight:600;line-height:1.5;">
            <strong style="color:#111827;">Certifications:</strong> SOC 2 Type II, ISO 27001, PCI-DSS
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E5E7EB;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #F3F4F6;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#111827;">GitHub Enterprise</span>
            <span style="font-size:10px;font-weight:700;color:#1D4ED8;background:#EFF6FF;padding:2px 8px;border-radius:2px;">Source Code</span>
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Role:</strong> Encrypted Source Code Management
          </div>
          <div style="font-size:12px;color:#4B5563;line-height:1.5;margin-bottom:6px;">
            <strong style="color:#111827;">Location:</strong> US / Multi-Region Secure Cloud
          </div>
          <div style="font-size:12px;color:#1D4ED8;font-weight:600;line-height:1.5;">
            <strong style="color:#111827;">Certifications:</strong> SOC 2 Type II, ISO 27001
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- 6. Dark Security CTA -->
  <section style="width:100%;background:#0B1120;padding:4rem 0;color:#fff;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 50%, rgba(255, 107, 0, 0.18) 0%, transparent 65%);"></div>
    <div class="sec-container" style="position:relative;max-width:48rem;z-index:10;">
      <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#fff;margin:0 0 12px;">
        Have Custom Vendor Security or Procurement Inquiries?
      </h2>
      <p style="color:#D1D5DB;font-size:13px;line-height:1.6;margin:0 auto 1.5rem;max-width:36rem;font-weight:400;">
        Our security and compliance team can help prepare security architecture documentation, assist with vendor NDA coordination, and support customizing DPA frameworks for enterprise client requirements.
      </p>
      <a href="contact" style="display:inline-block;padding:8px 20px;background:#FF6B00;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#EA580C'" onmouseout="this.style.background='#FF6B00'">
        Contact Security &amp; Compliance Team
      </a>
    </div>
  </section>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
