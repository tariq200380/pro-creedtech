<?php
$page_title = "ISO/IEC 27001:2022 ISMS Security Architecture | Creed Tech";
$page_description = "Technical breakdown of Creed Tech's Information Security Management System (ISMS) alignment with ISO/IEC 27001:2022 standards and Annex A control architecture.";
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
.sec-grid-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.25rem;
  text-align: left;
  width: 100%;
}
.sec-verify-bar {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 12px;
  text-align: left;
  background: #fff;
  border: 1px solid #E5E7EB;
  padding: 1rem 1.25rem;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  width: 100%;
  box-sizing: border-box;
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
  .sec-grid-cards {
    grid-template-columns: 1fr !important;
    gap: 1rem !important;
  }
  .sec-verify-bar {
    grid-template-columns: 1fr 1fr !important;
    gap: 8px !important;
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
  
  <!-- 1. Centered Executive Hero Section -->
  <section style="width:100%;padding:3.5rem 0;background:#F8FAFC;border-bottom:1px solid #E5E7EB;position:relative;overflow:hidden;text-align:center;">
    <div class="sec-container" style="max-width:64rem;">
      
      <div style="display:flex;align-items:center;justify-content:center;gap:8px;font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;flex-wrap:wrap;">
        <a href="security" style="color:#0052FF;text-decoration:none;">Security Center</a>
        <span>/</span>
        <span style="color:#4B5563;">ISO/IEC 27001:2022</span>
      </div>

      <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 12px;background:#EFF6FF;border:1px solid #BFDBFE;color:#1E40AF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:1rem;flex-wrap:wrap;">
        <span style="width:6px;height:6px;background:#2563EB;border-radius:50%;display:inline-block;"></span>
        <span>GLOBAL ISMS STANDARD • ISO/IEC 27001:2022 ALIGNMENT</span>
      </div>

      <h1 style="font-size:clamp(1.75rem,4vw,3rem);font-weight:700;letter-spacing:-0.03em;color:#111827;line-height:1.2;margin:0 0 1rem;">
        ISO/IEC 27001:2022 Standard &amp; ISMS Architecture
      </h1>

      <p style="font-size:clamp(0.875rem,1.5vw,1rem);color:#4B5563;line-height:1.7;font-weight:400;max-width:48rem;margin:0 auto 1.5rem;">
        The International Organization for Standardization (ISO, Geneva) defines the premier global framework for information security management. Explore our 93-control Annex A implementation, 4-tier policy hierarchy, and client code protection models.
      </p>

      <!-- Compact Buttons -->
      <div class="sec-btn-group" style="display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;margin-bottom:2rem;">
        <a href="contact" style="padding:8px 16px;background:#0052FF;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 1px 2px rgba(0,82,255,0.2);transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
          Request ISMS Architecture Overview
        </a>
        <a href="security" style="padding:8px 16px;background:#fff;color:#374151;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border:1px solid #D1D5DB;border-radius:2px;transition:background 0.2s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='#fff'">
          All Security Standards
        </a>
      </div>

      <!-- Horizontal 4-Column Verification Bar -->
      <div class="sec-verify-bar">
        <div style="padding:4px 8px;border-right:1px solid #F3F4F6;">
          <span style="font-size:10px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;">Standard</span>
          <span style="font-size:12px;font-weight:700;color:#111827;">ISO/IEC 27001:2022</span>
        </div>
        <div style="padding:4px 8px;border-right:1px solid #F3F4F6;">
          <span style="font-size:10px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;">Governing Body</span>
          <span style="font-size:12px;font-weight:700;color:#111827;">ISO (Geneva, Switzerland)</span>
        </div>
        <div style="padding:4px 8px;border-right:1px solid #F3F4F6;">
          <span style="font-size:10px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;">Control Framework</span>
          <span style="font-size:12px;font-weight:700;color:#111827;">Annex A (93 Controls)</span>
        </div>
        <div style="padding:4px 8px;">
          <span style="font-size:10px;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;">Security Status</span>
          <span style="font-size:12px;font-weight:700;color:#15803D;">Operational ISMS Alignment</span>
        </div>
      </div>

    </div>
  </section>

  <!-- 2. ISMS Policy Architecture -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          POLICY HIERARCHY
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          4-Tier ISMS Governance Structure
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          Creed Tech implements an institutional 4-tier documentation and enforcement hierarchy ensuring structured security controls across all internal and client-facing systems:
        </p>
      </div>

      <div class="sec-grid-cards">
        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">TIER 1</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Security Policy</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">Executive-approved mandates defining organizational security goals, data ownership, legal requirements, and executive accountability.</p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">TIER 2</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Technical Standards</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">Mandatory engineering rules: AES-256 encryption, TLS 1.3 protocol standards, WebAuthn 2FA, and strict zero-trust IAM profiles.</p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">TIER 3</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Operating Procedures</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">Step-by-step SOPs for change management, secret rotation, PR code reviews, sandbox isolation, and continuous CI/CD deployments.</p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <span style="font-size:11px;font-weight:700;color:#2563EB;text-transform:uppercase;display:block;margin-bottom:4px;">TIER 4</span>
          <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0 0 6px;">Evidence &amp; Audits</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">Immutable audit logs, SIEM telemetry, authorized security assessment records, and employee security training documentation.</p>
        </div>
      </div>

    </div>
  </section>

  <!-- 3. Annex A 2022 Control Domains Matrix -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;background:#F4F8FF;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          ANNEX A IMPLEMENTATION
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          93 Technical &amp; Operational Controls Across 4 Domains
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          In accordance with the updated ISO/IEC 27001:2022 standard, our security operations are structured into four consolidated control themes:
        </p>
      </div>

      <div style="display:flex;flex-direction:column;gap:1.25rem;text-align:left;">
        
        <div style="background:#fff;border:1px solid #E5E7EB;padding:1.5rem;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <div style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;border-bottom:1px solid #F3F4F6;padding-bottom:8px;margin-bottom:10px;flex-wrap:wrap;gap:8px;">
            <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0;">1. Organizational Controls (37 Controls — Annex A.5)</h3>
            <span style="font-size:12px;font-weight:600;color:#2563EB;">Policies, Threat Intelligence &amp; Supplier Relations</span>
          </div>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0 0 12px;">
            Covers formal information security policies, asset management inventories, access governance, threat intelligence integration, third-party cloud supplier vetting, and business continuity readiness.
          </p>
          <div style="display:flex;flex-wrap:wrap;gap:8px;font-size:11px;color:#6B7280;">
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.5.7 Threat Intel</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.5.19 Supplier Risk</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.5.24 Incident Response</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.5.30 ICT Readiness</span>
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E5E7EB;padding:1.5rem;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <div style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;border-bottom:1px solid #F3F4F6;padding-bottom:8px;margin-bottom:10px;flex-wrap:wrap;gap:8px;">
            <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0;">2. People Controls (8 Controls — Annex A.6)</h3>
            <span style="font-size:12px;font-weight:600;color:#2563EB;">Personnel Screening &amp; Security Awareness</span>
          </div>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0 0 12px;">
            Multi-tier background screening prior to onboarding, mandatory signed Non-Disclosure Agreements (NDAs), quarterly simulated phishing exercises, and disciplinary protocols for security policy non-compliance.
          </p>
          <div style="display:flex;flex-wrap:wrap;gap:8px;font-size:11px;color:#6B7280;">
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.6.1 Background Verification</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.6.3 Security Awareness</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.6.5 Post-Employment Responsibilities</span>
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E5E7EB;padding:1.5rem;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <div style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;border-bottom:1px solid #F3F4F6;padding-bottom:8px;margin-bottom:10px;flex-wrap:wrap;gap:8px;">
            <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0;">3. Physical Controls (14 Controls — Annex A.7)</h3>
            <span style="font-size:12px;font-weight:600;color:#2563EB;">Secure Zones &amp; Clean Desk Enforcement</span>
          </div>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0 0 12px;">
            Physical access perimeters, biometric authorization, clean desk and clean screen policies, continuous video surveillance retention, and secure equipment disposal standards.
          </p>
          <div style="display:flex;flex-wrap:wrap;gap:8px;font-size:11px;color:#6B7280;">
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.7.2 Physical Entry</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.7.7 Clear Desk/Screen</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.7.14 Secure Disposal</span>
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E5E7EB;padding:1.5rem;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <div style="display:flex;flex-direction:row;align-items:center;justify-content:space-between;border-bottom:1px solid #F3F4F6;padding-bottom:8px;margin-bottom:10px;flex-wrap:wrap;gap:8px;">
            <h3 style="font-size:1rem;font-weight:700;color:#111827;margin:0;">4. Technological Controls (34 Controls — Annex A.8)</h3>
            <span style="font-size:12px;font-weight:600;color:#2563EB;">Secure SDLC, Encryption &amp; Vulnerability Management</span>
          </div>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0 0 12px;">
            Endpoint encryption, network segregation, automated source code SAST/DAST testing, secure development lifecycle (SSDLC), continuous logging, and automated vulnerability management. All security testing is performed exclusively on authorized systems within agreed client scope.
          </p>
          <div style="display:flex;flex-wrap:wrap;gap:8px;font-size:11px;color:#6B7280;">
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.8.8 Vulnerability Management</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.8.25 Secure SDLC</span>
            <span style="background:#F3F4F6;padding:2px 8px;border-radius:2px;">A.8.28 Secure Coding</span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 4. Incident Severity Matrix -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          INCIDENT RESPONSE PLAYBOOK
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          Incident Severity Classification &amp; Response Framework
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          In accordance with ISO 27001 Annex A.5.24-28, all security telemetry is routed through a structured incident triage and escalation process:
        </p>
      </div>

      <!-- Desktop Table -->
      <div class="sec-table-desktop">
        <table style="width:100%;text-align:left;border-collapse:collapse;border:1px solid #E5E7EB;font-size:12px;">
          <thead>
            <tr style="background:#F9FAFB;border-bottom:1px solid #E5E7EB;">
              <th style="padding:14px;font-weight:700;color:#111827;">Severity Level</th>
              <th style="padding:14px;font-weight:700;color:#111827;">Definition / Scenario</th>
              <th style="padding:14px;font-weight:700;color:#111827;">Response Priority</th>
              <th style="padding:14px;font-weight:700;color:#111827;">Client Notification</th>
            </tr>
          </thead>
          <tbody style="divide-y:1px solid #E5E7EB;">
            <tr style="border-bottom:1px solid #F3F4F6;">
              <td style="padding:14px;font-weight:700;color:#DC2626;">SEV-1 (Critical)</td>
              <td style="padding:14px;color:#374151;">Active data breach, ransomware, or full service outage</td>
              <td style="padding:14px;font-weight:600;color:#111827;">Immediate Escalation</td>
              <td style="padding:14px;font-weight:600;color:#111827;">Expedited — Direct Security Team Lead</td>
            </tr>
            <tr style="border-bottom:1px solid #F3F4F6;">
              <td style="padding:14px;font-weight:700;color:#EA580C;">SEV-2 (High)</td>
              <td style="padding:14px;color:#374151;">Potential unauthorized access or isolated core component failure</td>
              <td style="padding:14px;font-weight:600;color:#111827;">High Priority Response</td>
              <td style="padding:14px;font-weight:600;color:#111827;">Same-Day Notification</td>
            </tr>
            <tr style="border-bottom:1px solid #F3F4F6;">
              <td style="padding:14px;font-weight:700;color:#CA8A04;">SEV-3 (Medium)</td>
              <td style="padding:14px;color:#374151;">Non-critical vulnerability identified in non-production sandbox</td>
              <td style="padding:14px;font-weight:600;color:#111827;">Scheduled Assessment</td>
              <td style="padding:14px;font-weight:600;color:#111827;">24 Hours / Weekly Report</td>
            </tr>
            <tr>
              <td style="padding:14px;font-weight:700;color:#2563EB;">SEV-4 (Low)</td>
              <td style="padding:14px;color:#374151;">Informational security advisory or minor dependency patch</td>
              <td style="padding:14px;font-weight:600;color:#111827;">Planned Remediation</td>
              <td style="padding:14px;font-weight:600;color:#111827;">Monthly Sprint Release</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Mobile Responsive Cards -->
      <div class="sec-cards-mobile">
        <div style="background:#fff;border:1px solid #FCA5A5;border-left:4px solid #DC2626;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #FEE2E2;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#DC2626;">SEV-1 (Critical)</span>
            <span style="font-size:10px;font-weight:700;color:#DC2626;background:#FEF2F2;padding:2px 8px;border-radius:2px;">Immediate Escalation</span>
          </div>
          <div style="font-size:12px;color:#374151;line-height:1.5;margin-bottom:8px;">
            Active data breach, ransomware, or full service outage.
          </div>
          <div style="font-size:11px;color:#111827;font-weight:600;line-height:1.5;">
            <strong>Client Notification:</strong> Expedited — Direct Security Team Lead
          </div>
        </div>

        <div style="background:#fff;border:1px solid #FDBA74;border-left:4px solid #EA580C;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #FFEDD5;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#EA580C;">SEV-2 (High)</span>
            <span style="font-size:10px;font-weight:700;color:#EA580C;background:#FFF7ED;padding:2px 8px;border-radius:2px;">High Priority</span>
          </div>
          <div style="font-size:12px;color:#374151;line-height:1.5;margin-bottom:8px;">
            Potential unauthorized access or isolated core component failure.
          </div>
          <div style="font-size:11px;color:#111827;font-weight:600;line-height:1.5;">
            <strong>Client Notification:</strong> Same-Day Notification
          </div>
        </div>

        <div style="background:#fff;border:1px solid #FDE047;border-left:4px solid #CA8A04;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #FEF9C3;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#CA8A04;">SEV-3 (Medium)</span>
            <span style="font-size:10px;font-weight:700;color:#CA8A04;background:#FEFCE8;padding:2px 8px;border-radius:2px;">Scheduled</span>
          </div>
          <div style="font-size:12px;color:#374151;line-height:1.5;margin-bottom:8px;">
            Non-critical vulnerability identified in non-production sandbox.
          </div>
          <div style="font-size:11px;color:#111827;font-weight:600;line-height:1.5;">
            <strong>Client Notification:</strong> 24 Hours / Weekly Report
          </div>
        </div>

        <div style="background:#fff;border:1px solid #93C5FD;border-left:4px solid #2563EB;border-radius:4px;padding:1.25rem;box-shadow:0 1px 2px rgba(0,0,0,0.04);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;border-bottom:1px solid #DBEAFE;padding-bottom:8px;">
            <span style="font-size:13px;font-weight:700;color:#2563EB;">SEV-4 (Low)</span>
            <span style="font-size:10px;font-weight:700;color:#2563EB;background:#EFF6FF;padding:2px 8px;border-radius:2px;">Planned</span>
          </div>
          <div style="font-size:12px;color:#374151;line-height:1.5;margin-bottom:8px;">
            Informational security advisory or minor dependency patch.
          </div>
          <div style="font-size:11px;color:#111827;font-weight:600;line-height:1.5;">
            <strong>Client Notification:</strong> Monthly Sprint Release
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Dark Security CTA -->
  <section style="width:100%;background:#0B1120;padding:4rem 0;color:#fff;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 50%, rgba(255, 107, 0, 0.18) 0%, transparent 65%);"></div>
    <div class="sec-container" style="position:relative;max-width:48rem;z-index:10;">
      <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#fff;margin:0 0 12px;">
        Need Our ISO 27001 Security Alignment Documentation?
      </h2>
      <p style="color:#D1D5DB;font-size:13px;line-height:1.6;margin:0 auto 1.5rem;max-width:36rem;font-weight:400;">
        We can help prepare SIG questionnaires, CAIQ-aligned security documentation, and Statement of Applicability (SoA) frameworks tailored to client requirements, under standard mutual NDA.
      </p>
      <a href="contact" style="display:inline-block;padding:8px 20px;background:#FF6B00;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#EA580C'" onmouseout="this.style.background='#FF6B00'">
        Request ISO 27001 Security Architecture
      </a>
    </div>
  </section>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
