<?php
$page_title = "EU GDPR Regulation (EU) 2016/679 Compliance & DPA | Creed Tech";
$page_description = "Overview of European Data Protection Board (EDPB) principles, GDPR legal bases, and how Creed Tech implements privacy-by-design engineering.";
$active_page = "security";

include dirname(__DIR__) . '/includes/header.php';
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
  grid-template-columns: 7fr 5fr;
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
.sec-rights-grid {
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
  .sec-rights-grid {
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
  
  <!-- 1. Unique European Privacy Light Hero -->
  <section style="width:100%;padding:3.5rem 0;background:#F8FAFC;border-bottom:1px solid #E5E7EB;position:relative;overflow:hidden;">
    <div class="sec-container">
      
      <div style="display:flex;align-items:center;gap:8px;font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px;flex-wrap:wrap;">
        <a href="security" style="color:#0052FF;text-decoration:none;">Security Center</a>
        <span>/</span>
        <span style="color:#4B5563;">EU GDPR Regulation</span>
      </div>

      <div class="sec-hero-grid">
        
        <!-- Left Col -->
        <div>
          <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 12px;background:#FEF3C7;border:1px solid #FDE68A;color:#78350F;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:1rem;flex-wrap:wrap;">
            <span>🇪🇺</span>
            <span>EU REGULATION 2016/679 • BRUSSELS, BELGIUM</span>
          </div>

          <h1 style="font-size:clamp(1.75rem,3.5vw,2.75rem);font-weight:700;letter-spacing:-0.03em;color:#111827;line-height:1.2;margin:0 0 1rem;">
            European Union GDPR <br />
            <span style="color:#0052FF;">Data Privacy &amp; Governance Architecture</span>
          </h1>

          <p style="font-size:13px;color:#4B5563;line-height:1.7;font-weight:400;max-width:36rem;margin:0 0 1.5rem;">
            Enacted by the European Parliament, the GDPR mandates sovereign privacy by design. Creed Tech provides structured Article 28 Data Processing Agreement (DPA) templates and architects dedicated European cloud infrastructure with sovereign data residency.
          </p>

          <!-- Action Buttons -->
          <div class="sec-btn-group" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:1.25rem;">
            <a href="contact" style="padding:8px 16px;background:#0052FF;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 1px 2px rgba(0,82,255,0.2);transition:background 0.2s;" onmouseover="this.style.background='#0043D6'" onmouseout="this.style.background='#0052FF'">
              Request DPA &amp; Privacy Overview
            </a>
            <a href="security" style="padding:8px 16px;background:#fff;color:#374151;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border:1px solid #D1D5DB;border-radius:2px;transition:background 0.2s;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='#fff'">
              All Security Standards
            </a>
          </div>

          <div style="display:flex;align-items:center;gap:1rem;font-size:11px;color:#6B7280;font-weight:500;flex-wrap:wrap;">
            <span style="display:flex;align-items:center;gap:6px;color:#15803D;font-weight:700;">
              <span style="width:6px;height:6px;background:#10B981;border-radius:2px;display:inline-block;"></span>
              <span>European Cloud Region Deployment Options</span>
            </span>
            <span>•</span>
            <span>Standard Contractual Clauses (SCC)</span>
          </div>
        </div>

        <!-- Right Col - Interactive Rights Deck -->
        <div style="background:#fff;border:1px solid #E5E7EB;padding:1.5rem;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);width:100%;box-sizing:border-box;">
          <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #F3F4F6;padding-bottom:8px;margin-bottom:12px;">
            <span style="font-size:11px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.05em;">Statutory Privacy Controls</span>
            <span style="font-size:10px;font-weight:700;color:#1D4ED8;background:#EFF6FF;padding:2px 8px;border-radius:2px;">EDPB Mandated</span>
          </div>

          <div style="display:flex;flex-direction:column;gap:8px;">
            <div style="padding:10px 12px;background:#F9FAFB;border:1px solid #F3F4F6;border-radius:2px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2px;flex-wrap:wrap;gap:4px;">
                <span style="font-size:12px;font-weight:700;color:#111827;">Article 17: Right to Erasure</span>
                <span style="font-size:10px;color:#15803D;font-weight:700;font-family:monospace;">AUTOMATED</span>
              </div>
              <p style="font-size:11px;color:#6B7280;margin:0;line-height:1.5;">Cryptographic purge across relational DBs and immutable S3 backups.</p>
            </div>

            <div style="padding:10px 12px;background:#F9FAFB;border:1px solid #F3F4F6;border-radius:2px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2px;flex-wrap:wrap;gap:4px;">
                <span style="font-size:12px;font-weight:700;color:#111827;">Article 15: DSAR Access Export</span>
                <span style="font-size:10px;color:#15803D;font-weight:700;font-family:monospace;">INSTANT JSON/CSV</span>
              </div>
              <p style="font-size:11px;color:#6B7280;margin:0;line-height:1.5;">Self-service end-user data portability and archive downloads.</p>
            </div>

            <div style="padding:10px 12px;background:#F9FAFB;border:1px solid #F3F4F6;border-radius:2px;">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2px;flex-wrap:wrap;gap:4px;">
                <span style="font-size:12px;font-weight:700;color:#111827;">Article 28: Data Processor DPA</span>
                <span style="font-size:10px;color:#1D4ED8;font-weight:700;font-family:monospace;">LEGAL SCCs</span>
              </div>
              <p style="font-size:11px;color:#6B7280;margin:0;line-height:1.5;">Strict processor obligations preventing unauthorized sub-processing.</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 2. 6 Lawful Bases for Data Processing (Article 6) -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          STATUTORY FOUNDATION
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          Article 6: The 6 Lawful Bases for Processing Data
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          Under GDPR, personal data can only be processed if at least one of the following 6 legal conditions is satisfied:
        </p>
      </div>

      <div class="sec-grid-cards">
        
        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">1. Consent (Art. 6.1.a)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Freely given, specific, informed, and unambiguous indication of the data subject's wishes via clear affirmative action.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">2. Contractual Necessity (Art. 6.1.b)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Processing is necessary for the performance of a contract to which the data subject is party.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">3. Legal Obligation (Art. 6.1.c)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Processing is necessary for compliance with a statutory legal obligation to which the controller is subject.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">4. Vital Interests (Art. 6.1.d)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Processing is necessary in order to protect the vital interests of the data subject or of another natural person.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">5. Public Task (Art. 6.1.e)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Processing is necessary for the performance of a task carried out in the public interest or official authority.
          </p>
        </div>

        <div style="padding:1.5rem;background:#F8FAFC;border:1px solid #E5E7EB;border-radius:2px;">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">6. Legitimate Interests (Art. 6.1.f)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Processing is necessary for legitimate commercial interests pursued by the controller, provided fundamental rights do not override.
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- 3. 8 Data Subject Rights -->
  <section style="width:100%;padding:4rem 0;border-bottom:1px solid #F3F4F6;background:#F4F8FF;">
    <div class="sec-container">
      
      <div style="max-width:48rem;margin-bottom:2.5rem;text-align:left;">
        <span style="font-size:12px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          INDIVIDUAL PRIVACY RIGHTS
        </span>
        <h2 style="font-size:clamp(1.5rem,3vw,2.25rem);font-weight:700;color:#111827;letter-spacing:-0.02em;margin:0 0 8px;">
          The 8 Data Subject Rights We Architect for Clients
        </h2>
        <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
          Our software architectures are engineered with modular privacy controls supporting all 8 statutory user privacy workflows:
        </p>
      </div>

      <div class="sec-rights-grid">
        
        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 15: Right of Access (DSAR)</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Self-service user portal allowing end-users to generate and download an encrypted archive of all personal records, activity logs, and account history in structured format.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 16: Right to Rectification</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Direct profile settings interfaces and APIs enabling individuals to correct, update, or complete inaccurate or incomplete personal records instantly.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 17: Right to Erasure ("Right to be Forgotten")</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Cascading cryptographic data deletion pipeline that purges user records across primary relational databases, NoSQL stores, caching layers, and backup replicas.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 18: Right to Restriction of Processing</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            System-level processing lock that suspends data transformation and third-party sync while retaining records safely during legal or factual dispute resolutions.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 19: Notification of Rectification / Erasure</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Automated webhook notifications communicating any data correction, erasure, or restriction to all downstream sub-processors and external integrations.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 20: Right to Data Portability</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Standardized machine-readable JSON and CSV export endpoints enabling users to transfer personal data seamlessly to competing third-party services.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 21: Right to Object &amp; Opt-Out</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Granular consent management UI giving users instant toggle controls to opt out of marketing analytics, tracking cookies, and profiling algorithms.
          </p>
        </div>

        <div style="padding:1.5rem;background:#fff;border:1px solid #E5E7EB;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);">
          <h3 style="font-size:1rem;font-weight:700;color:#0052FF;margin:0 0 6px;">Article 22: Automated Decision-Making &amp; Profiling</h3>
          <p style="font-size:12px;color:#4B5563;line-height:1.6;margin:0;">
            Algorithmic transparency controls supporting human review, rationale disclosure, and contestation mechanisms for automated decisions.
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
        Need a Signed DPA &amp; Data Protection Impact Assessment (DPIA)?
      </h2>
      <p style="color:#D1D5DB;font-size:13px;line-height:1.6;margin:0 auto 1.5rem;max-width:36rem;font-weight:400;">
        Our privacy and compliance team can help prepare Standard Contractual Clauses (SCC) frameworks and support developing customized DPA documentation tailored to client data processing requirements.
      </p>
      <a href="contact" style="display:inline-block;padding:8px 20px;background:#FF6B00;color:#fff;font-weight:600;font-size:11px;text-transform:uppercase;letter-spacing:0.04em;text-decoration:none;border-radius:2px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);transition:background 0.2s;" onmouseover="this.style.background='#EA580C'" onmouseout="this.style.background='#FF6B00'">
        Contact Data Privacy Team
      </a>
    </div>
  </section>

</div>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
