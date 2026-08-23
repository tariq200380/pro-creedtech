<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/security_helpers.php';

$page_title = "Privacy Policy | Creed Tech";
$page_description = "Official Privacy Policy explaining how Creed Tech collects, handles, stores, and protects voluntary project inquiries, talent applications, and platform information.";
$canonical_url = "https://creed-tech.com/privacy-policy";
$active_page = "privacy-policy";

include __DIR__ . '/includes/header.php';
?>

<!-- Header Hero -->
<section style="padding: 56px 0 40px; background: #0B1120; border-bottom: 1px solid #1E293B;">
  <div class="container-creed">
    <div style="max-width: 860px; margin: 0 auto; text-align: center;">
      <span style="font-size: 0.78rem; font-weight: 800; color: #0052FF; text-transform: uppercase; letter-spacing: 0.14em; display: inline-block; margin-bottom: 12px; background: rgba(0,82,255,0.12); padding: 4px 12px; border-radius: 4px; border: 1px solid rgba(0,82,255,0.25);">
        DATA GOVERNANCE &amp; TRUST
      </span>
      <h1 style="font-size: clamp(2.2rem, 3.8vw, 3.2rem); font-weight: 800; color: #FFFFFF; line-height: 1.18; margin-bottom: 16px; letter-spacing: -0.02em;">
        Privacy Policy
      </h1>
      <p style="font-size: 1.05rem; color: #94A3B8; line-height: 1.7; max-width: 720px; margin: 0 auto 12px;">
        Transparent principles governing how Creed Tech respects, processes, and secures information submitted through our website and engineering communication channels.
      </p>
      <div style="font-size: 0.85rem; color: #64748B; font-weight: 500;">
        Last Updated: August 21, 2026
      </div>
    </div>
  </div>
</section>

<!-- Content Section -->
<section style="padding: 60px 0 80px; background: #F8FAFC;">
  <div class="container-creed">
    <div style="max-width: 860px; margin: 0 auto; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: clamp(24px, 4vw, 48px); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
      
      <!-- Section 1 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">1.</span> Overview &amp; Privacy Commitment
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin-bottom: 12px;">
          Creed Tech (&ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;) operates <a href="/" style="color: #0052FF; font-weight: 600; text-decoration: underline;">creed-tech.com</a> as an enterprise technology and custom software engineering firm. We hold a fundamental commitment to data privacy, confidentiality, and technical integrity.
        </p>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin: 0;">
          This Privacy Policy explains what information we collect when you browse our Website, submit technical project inquiries, apply for careers, or subscribe to tech intelligence feeds, and how that information is safeguarded.
        </p>
      </div>

      <!-- Section 2 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">2.</span> Information You Voluntarily Provide
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin-bottom: 12px;">
          We collect personal and professional information only when you voluntarily submit it to us through our interactive communication forms:
        </p>
        <ul style="list-style-type: disc; padding-left: 24px; font-size: 0.95rem; color: #334155; line-height: 1.75;">
          <li style="margin-bottom: 8px;"><strong>Contact &amp; Discovery Inquiries:</strong> When requesting architectural consultations, we collect your full name, business email, telephone number, organization name, requested service domain, and project scope details.</li>
          <li style="margin-bottom: 8px;"><strong>Vision Estimation &amp; Dedicated Pod Requests:</strong> When submitting project scoping forms, we collect your contact information, desired engineering roles, engagement model (Dedicated Team, Fixed Price, etc.), and optional project requirement attachments.</li>
          <li style="margin-bottom: 8px;"><strong>Career &amp; Talent Applications:</strong> When applying for open engineering positions, we collect your name, email, phone number, portfolio/GitHub links, cover note, and uploaded resume document.</li>
          <li style="margin-bottom: 8px;"><strong>Newsletter Subscriptions:</strong> When signing up for technical intelligence briefings, we collect your email address.</li>
          <li><strong>Article &amp; Platform Reviews:</strong> When submitting reader feedback on Knowledge Center articles, we collect your display name, role/organization, numerical rating, and review comments.</li>
        </ul>
      </div>

      <!-- Section 3 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">3.</span> Technical &amp; Operational Security Information
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin-bottom: 12px;">
          To ensure reliable server operation, defend against automated abuse, and maintain platform security:
        </p>
        <ul style="list-style-type: disc; padding-left: 24px; font-size: 0.95rem; color: #334155; line-height: 1.75;">
          <li style="margin-bottom: 8px;"><strong>Rate Limiting &amp; Abuse Prevention:</strong> Our backend implements lightweight, hashed IP-based rate limiting to prevent automated denial-of-service and form spamming. These temporary security hashes are automatically expired.</li>
          <li style="margin-bottom: 8px;"><strong>Session Security:</strong> Administrative portal sessions utilize secure, encrypted session cookies (<code style="background:#F1F5F9;padding:2px 6px;border-radius:4px;font-size:0.85rem;color:#0F172A;">CREED_ADMIN_SESSID</code>) flagged with <code style="background:#F1F5F9;padding:2px 6px;border-radius:4px;font-size:0.85rem;color:#0F172A;">HttpOnly</code>, <code style="background:#F1F5F9;padding:2px 6px;border-radius:4px;font-size:0.85rem;color:#0F172A;">SameSite=Lax</code>, and <code style="background:#F1F5F9;padding:2px 6px;border-radius:4px;font-size:0.85rem;color:#0F172A;">Secure</code> flags.</li>
          <li><strong>Zero Tracking Scripts:</strong> The Website does <strong>not</strong> load third-party ad trackers, cross-site behavioral tracking cookies, or commercial marketing spyware. All core CSS, JS, and font dependencies are self-hosted.</li>
        </ul>
      </div>

      <!-- Section 4 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">4.</span> How We Use Your Information
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin-bottom: 12px;">
          Information collected through the Website is utilized strictly for legitimate business and operational purposes:
        </p>
        <ul style="list-style-type: disc; padding-left: 24px; font-size: 0.95rem; color: #334155; line-height: 1.75;">
          <li style="margin-bottom: 6px;">Responding directly to your architectural consultations, technical scoping inquiries, and partnership requests.</li>
          <li style="margin-bottom: 6px;">Preparing mutual Non-Disclosure Agreements (NDAs) and formal Statements of Work (SOWs).</li>
          <li style="margin-bottom: 6px;">Evaluating candidate qualifications and scheduling recruitment interviews for career applicants.</li>
          <li style="margin-bottom: 6px;">Delivering requested tech wire updates and engineering research publications.</li>
          <li>Maintaining server stability, detecting security anomalies, and protecting intellectual property.</li>
        </ul>
      </div>

      <!-- Section 5 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">5.</span> Data Storage, Retention &amp; Protection
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin-bottom: 12px;">
          We implement multi-layered technical controls to protect your data against unauthorized access, disclosure, alteration, or destruction. Form submissions are stored within protected, access-controlled backend database records and private storage structures that are strictly inaccessible to public HTTP traffic.
        </p>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin: 0;">
          We retain inquiry and recruitment data only as long as necessary to fulfill the operational business purposes for which it was submitted, or as required by applicable legal and regulatory obligations.
        </p>
      </div>

      <!-- Section 6 -->
      <div style="margin-bottom: 36px; padding: 20px; background: #EFF6FF; border-left: 4px solid #0052FF; border-radius: 0 6px 6px 0;">
        <h2 style="font-size: 1.2rem; font-weight: 700; color: #0F172A; margin-bottom: 8px;">
          6. Statutory Data Rights &amp; GDPR Compliance
        </h2>
        <p style="font-size: 0.92rem; color: #334155; line-height: 1.7; margin-bottom: 12px;">
          Depending on your jurisdiction (including the European Economic Area under EU GDPR Regulation 2016/679), you may hold statutory rights regarding your personal data, including the right to access, rectify, port, or request erasure of your data, or to restrict or object to certain processing.
        </p>
        <p style="font-size: 0.92rem; color: #334155; line-height: 1.7; margin: 0;">
          For an in-depth breakdown of our European data residency architecture, Data Protection Officer (DPO) contact, and Article 28 Data Processing Agreements, please review our dedicated <a href="/security-gdpr" style="color: #0052FF; font-weight: 700; text-decoration: underline;">European Privacy &amp; GDPR Compliance Center</a>.
        </p>
      </div>

      <!-- Section 7 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">7.</span> Third-Party Disclosure &amp; External Links
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin-bottom: 12px;">
          Creed Tech does not sell, rent, or trade your personal or business inquiry information to third-party advertisers or commercial data brokers. We may share information only with authorized infrastructure providers (such as secure hosting facilities) acting on our direct instructions under strict confidentiality commitments, or when required by valid legal process.
        </p>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin: 0;">
          Our Website may include links to external websites and syndicated news sources. We encourage you to review the privacy policies of any third-party websites you visit.
        </p>
      </div>

      <!-- Section 8 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">8.</span> Protection of Minors
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin: 0;">
          The Website and its engineering services are intended strictly for enterprise professionals, businesses, and adult job applicants. We do not knowingly collect personal data from individuals under 16 years of age.
        </p>
      </div>

      <!-- Section 9 -->
      <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">9.</span> Updates to This Policy
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin: 0;">
          We may update this Privacy Policy periodically to reflect enhancements in our data practices, platform features, or legal requirements. Updates will be published on this page with a revised &ldquo;Last Updated&rdquo; timestamp.
        </p>
      </div>

      <!-- Section 10 -->
      <div>
        <h2 style="font-size: 1.35rem; font-weight: 700; color: #0F172A; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <span style="color: #0052FF;">10.</span> Data Privacy Contacts
        </h2>
        <p style="font-size: 0.95rem; color: #334155; line-height: 1.75; margin-bottom: 12px;">
          To exercise your statutory data rights, request information regarding your records, or submit data privacy inquiries:
        </p>
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 18px; font-size: 0.92rem; color: #334155; line-height: 1.7;">
          <strong>Creed Tech Data Governance &amp; Privacy Office</strong><br />
          Privacy Inquiries: <a href="mailto:privacy@creed-tech.com" style="color: #0052FF; font-weight: 600; text-decoration: underline;">privacy@creed-tech.com</a><br />
          General Contact: <a href="mailto:contact@creed-tech.com" style="color: #0052FF; font-weight: 600; text-decoration: underline;">contact@creed-tech.com</a><br />
          Security Center: <a href="/security" style="color: #0052FF; font-weight: 600; text-decoration: underline;">creed-tech.com/security</a>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
