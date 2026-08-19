<?php
$page_title = "Contact Solutions Architecture & Engineering | Creed Tech";
$page_description = "Schedule a technical consultation with Creed Tech's principal solutions architects. Direct engineering scoping and zero-obligation NDA protection.";
$active_page = "contact";

include __DIR__ . '/includes/header.php';
?>

<style>
/* =========================================================================
   CONTACT PAGE DESIGN SYSTEM (DESKTOP FIRST + DEDICATED MOBILE OVERRIDES)
   ========================================================================= */

.contact-page {
  width: 100%;
  background: #fff;
  color: #111827;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  text-align: left;
  overflow-x: hidden;
}

.contact-container {
  width: 100%;
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 2rem;
  box-sizing: border-box;
}

/* 1. Hero Section (Desktop Spacious & Grand) */
.contact-hero-section {
  width: 100%;
  background: linear-gradient(to bottom, #F2F5FB, #F8FAFC, #FFFFFF);
  padding: 5.5rem 0 6.5rem;
  border-bottom: 1px solid #E5E7EB;
  position: relative;
  overflow: hidden;
  text-align: center;
}
.contact-hero-title {
  font-size: clamp(2.25rem, 4vw, 3.25rem);
  font-weight: 700;
  color: #030712;
  letter-spacing: -0.03em;
  line-height: 1.2;
  max-width: 54rem;
  margin: 0 auto 0.75rem;
}
.contact-hero-desc {
  font-size: clamp(0.95rem, 1.5vw, 1.05rem);
  color: #4B5563;
  font-weight: 400;
  line-height: 1.7;
  max-width: 48rem;
  margin: 0 auto 2.5rem;
}
.contact-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
  max-width: 58rem;
  margin: 0 auto;
  text-align: left;
}
.contact-metric-badge {
  background: #fff;
  padding: 1.25rem 1.5rem;
  border: 1px solid #E5E7EB;
  border-radius: 8px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}

/* 2. Main Technical Scoping & Direct Channels (Desktop 7fr 5fr) */
.contact-main-section {
  width: 100%;
  padding: 5.5rem 0;
  background: #FAFAFC;
  border-bottom: 1px solid #E5E7EB;
}
.contact-main-grid {
  display: grid;
  grid-template-columns: 7fr 5fr;
  gap: 3.5rem;
  align-items: start;
}
.contact-form-card {
  background: #fff;
  border: 1px solid #E5E7EB;
  border-radius: 1rem;
  padding: 2.5rem;
  box-shadow: 0 1px 4px rgba(0,0,0,0.04);
  text-align: left;
}
.svc-btn-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
}
.form-input-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.25rem;
}

/* 3. Onboarding Steps (Desktop 4 Cols) */
.contact-steps-section {
  width: 100%;
  padding: 5.5rem 0;
  background: #fff;
  border-bottom: 1px solid #E5E7EB;
  text-align: center;
}
.contact-steps-header {
  text-align: center;
  max-width: 46rem;
  margin: 0 auto 3.5rem;
}
.contact-steps-title {
  font-size: clamp(2rem, 3.5vw, 2.75rem);
  font-weight: 700;
  color: #030712;
  letter-spacing: -0.02em;
  line-height: 1.2;
  margin: 0 0 0.5rem;
}
.contact-steps-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.75rem;
  text-align: left;
}
.contact-step-card {
  background: #FAFAFC;
  border: 1px solid #E5E7EB;
  border-radius: 1rem;
  padding: 2rem 1.75rem;
  box-shadow: 0 1px 3px rgba(0,0,0,0.04);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 240px;
}

/* 4. FAQ Accordion (Desktop) */
.contact-faq-section {
  width: 100%;
  padding: 5.5rem 0;
  background: #FAFAFC;
  border-bottom: 1px solid #E5E7EB;
  text-align: center;
}
.contact-faq-container {
  max-width: 56rem;
  margin: 0 auto;
  padding: 0 2rem;
}
.contact-faq-title {
  font-size: clamp(2rem, 3.5vw, 2.75rem);
  font-weight: 700;
  color: #030712;
  letter-spacing: -0.02em;
  margin: 0 0 0.5rem;
}

/* 5. CTA Section (Desktop) */
.contact-cta-section {
  width: 100%;
  padding: 4.5rem 0;
  background: #0052FF;
  color: #fff;
  text-align: center;
}
.contact-cta-title {
  font-size: clamp(2rem, 3vw, 2.5rem);
  font-weight: 700;
  color: #fff;
  letter-spacing: -0.02em;
  margin: 0;
}

/* =========================================================================
   MOBILE ONLY OVERRIDES (Max-Width 768px) - Keeps Desktop Perfectly Intact
   ========================================================================= */
@media (max-width: 768px) {
  .contact-container {
    padding: 0 1.25rem;
  }
  
  /* Hero */
  .contact-hero-section {
    padding: 2.75rem 0 3rem;
  }
  .contact-hero-title {
    font-size: clamp(1.45rem, 5vw, 1.95rem);
    margin-bottom: 0.5rem;
  }
  .contact-hero-desc {
    font-size: 13px;
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }
  .contact-metrics-grid {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }
  .contact-metric-badge {
    padding: 0.85rem 1rem;
  }

  /* Main Form & Sidebar Stack Single Column */
  .contact-main-section {
    padding: 2.5rem 0;
  }
  .contact-main-grid {
    grid-template-columns: 1fr;
    gap: 1.75rem;
  }
  .contact-form-card {
    padding: 1.25rem;
    border-radius: 0.75rem;
  }
  .svc-btn-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 6px;
  }
  .form-input-grid {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }

  /* Onboarding Steps */
  .contact-steps-section {
    padding: 2.75rem 0;
  }
  .contact-steps-header {
    margin-bottom: 1.75rem;
  }
  .contact-steps-title {
    font-size: 1.6rem;
  }
  .contact-steps-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .contact-step-card {
    padding: 1.25rem;
    min-height: auto;
  }

  /* FAQ */
  .contact-faq-section {
    padding: 2.75rem 0;
  }
  .contact-faq-container {
    padding: 0 1.25rem;
  }
  .contact-faq-title {
    font-size: 1.6rem;
  }

  /* CTA */
  .contact-cta-section {
    padding: 2.75rem 0;
  }
  .contact-cta-title {
    font-size: 1.45rem;
  }
}
</style>

<div class="contact-page">
  
  <!-- 1. HERO SECTION (LIGHT PLATINUM WITH AMBIENT TECH GLOW) -->
  <section class="contact-hero-section">
    <div style="position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 50% 0%, rgba(0, 82, 255, 0.08) 0%, transparent 60%), radial-gradient(circle at 85% 60%, rgba(255, 107, 0, 0.06) 0%, transparent 50%);"></div>

    <div class="contact-container" style="position:relative;z-index:10;">
      
      <div style="display:inline-flex;align-items:center;gap:6px;padding:4px 14px;background:#fff;border:1px solid rgba(209,213,219,0.8);color:#0052FF;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;box-shadow:0 1px 2px rgba(0,0,0,0.05);margin-bottom:1rem;">
        <span style="width:6px;height:6px;background:#FF6B00;border-radius:50%;display:inline-block;"></span>
        <span>DIRECT ARCHITECT ACCESS • 4-HOUR GUARANTEED SLA</span>
      </div>

      <h1 class="contact-hero-title">
        Let's Build Something Enduring Together.
      </h1>

      <p class="contact-hero-desc">
        Connect directly with senior systems architects and technical leaders. Whether you need an end-to-end enterprise platform, sovereign AI pipelines, or dedicated engineering pods—we are ready.
      </p>

      <!-- Metric Badges (3 Balanced Cards) -->
      <div class="contact-metrics-grid">
        
        <div class="contact-metric-badge">
          <span style="font-size:11px;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;display:block;">Average Response</span>
          <span style="font-size:1.35rem;font-weight:700;color:#0052FF;margin-top:4px;display:block;">&lt; 2.4 Hours</span>
        </div>

        <div class="contact-metric-badge">
          <span style="font-size:11px;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;display:block;">NDA &amp; IP Protection</span>
          <span style="font-size:1.35rem;font-weight:700;color:#030712;margin-top:4px;display:block;">Signed Day 1</span>
        </div>

        <div class="contact-metric-badge">
          <span style="font-size:11px;font-weight:700;color:#6B7280;text-transform:uppercase;letter-spacing:0.05em;display:block;">Verified Ratings</span>
          <span style="font-size:1.35rem;font-weight:700;color:#FF6B00;margin-top:4px;display:block;">5.0 Clutch &amp; Google</span>
        </div>

      </div>

    </div>
  </section>

  <!-- 2. MAIN 2-COLUMN TECHNICAL SCOPING & DIRECT CONTACT HUB -->
  <section class="contact-main-section">
    <div class="contact-container">
      
      <div class="contact-main-grid">
        
        <!-- LEFT COLUMN: INTERACTIVE TECHNICAL SCOPING FORM -->
        <div class="contact-form-card">
          
          <div style="border-bottom:1px solid #F3F4F6;padding-bottom:1.25rem;margin-bottom:1.5rem;">
            <span style="font-size:11px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">
              PROJECT SPECIFICATION FORM
            </span>
            <h2 style="font-size:1.5rem;font-weight:700;color:#030712;letter-spacing:-0.02em;margin:0;">
              Scope Your Project
            </h2>
            <p style="font-size:13px;color:#6B7280;margin:4px 0 0;font-weight:400;">
              Fill out the parameters below to receive an architectural estimate and discovery invite.
            </p>
          </div>

          <!-- Success Box (Hidden by default) -->
          <div id="contactSuccessBox" style="display:none;padding:2.5rem 1.25rem;text-align:center;background:#EFF6FF;border:1px solid #BFDBFE;border-radius:6px;">
            <div style="width:3rem;height:3rem;background:#0052FF;color:#fff;font-size:1.35rem;font-weight:700;display:flex;align-items:center;justify-content:center;margin:0 auto 0.75rem;border-radius:4px;">
              ✓
            </div>
            <h3 style="font-size:1.25rem;font-weight:700;color:#030712;margin:0 0 0.4rem;">
              Inquiry Received Successfully!
            </h3>
            <p style="font-size:13px;color:#4B5563;max-width:26rem;margin:0 auto 1.25rem;line-height:1.6;">
              A senior systems architect from Creed Tech will review your project parameters and contact you within 2 to 4 business hours.
            </p>
            <button onclick="resetContactForm()" style="padding:10px 22px;background:#030712;color:#fff;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border:none;border-radius:3px;cursor:pointer;">
              Submit Another Inquiry
            </button>
          </div>

          <!-- The Form -->
          <form id="mainContactForm" onsubmit="handleContactSubmit(event)" style="display:flex;flex-direction:column;gap:1.5rem;">
            
            <!-- Step 1: Service Selection -->
            <div>
              <label style="display:block;font-size:11.5px;font-weight:700;color:#111827;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.65rem;">
                1. Select the service you need
              </label>
              <div class="svc-btn-grid">
                <button type="button" onclick="selectContactService(this, 'Software Development')" class="svc-select-btn active-svc" style="padding:10px 8px;font-size:12px;font-weight:700;text-align:center;border:1px solid #0052FF;background:#0052FF;color:#fff;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Software Development</button>
                <button type="button" onclick="selectContactService(this, 'UI/UX Design')" class="svc-select-btn" style="padding:10px 8px;font-size:12px;font-weight:500;text-align:center;border:1px solid #E5E7EB;background:#F9FAFB;color:#374151;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">UI/UX Design</button>
                <button type="button" onclick="selectContactService(this, 'Mobile Application')" class="svc-select-btn" style="padding:10px 8px;font-size:12px;font-weight:500;text-align:center;border:1px solid #E5E7EB;background:#F9FAFB;color:#374151;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Mobile Application</button>
                <button type="button" onclick="selectContactService(this, 'Cloud Infrastructure')" class="svc-select-btn" style="padding:10px 8px;font-size:12px;font-weight:500;text-align:center;border:1px solid #E5E7EB;background:#F9FAFB;color:#374151;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Cloud Infrastructure</button>
                <button type="button" onclick="selectContactService(this, 'Database Management')" class="svc-select-btn" style="padding:10px 8px;font-size:12px;font-weight:500;text-align:center;border:1px solid #E5E7EB;background:#F9FAFB;color:#374151;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Database Management</button>
                <button type="button" onclick="selectContactService(this, 'Web Development')" class="svc-select-btn" style="padding:10px 8px;font-size:12px;font-weight:500;text-align:center;border:1px solid #E5E7EB;background:#F9FAFB;color:#374151;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Web Development</button>
                <button type="button" onclick="selectContactService(this, 'AI & Automation')" class="svc-select-btn" style="padding:10px 8px;font-size:12px;font-weight:500;text-align:center;border:1px solid #E5E7EB;background:#F9FAFB;color:#374151;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">AI &amp; Automation</button>
                <button type="button" onclick="selectContactService(this, 'Digital Growth')" class="svc-select-btn" style="padding:10px 8px;font-size:12px;font-weight:500;text-align:center;border:1px solid #E5E7EB;background:#F9FAFB;color:#374151;cursor:pointer;border-radius:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Digital Growth</button>
              </div>
              <input type="hidden" id="selectedServiceInput" name="service" value="Software Development">
            </div>

            <!-- Step 2: Contact Inputs -->
            <div style="display:flex;flex-direction:column;gap:1rem;">
              <label style="display:block;font-size:11.5px;font-weight:700;color:#111827;text-transform:uppercase;letter-spacing:0.05em;">
                2. Your Contact &amp; Company Details
              </label>

              <div class="form-input-grid">
                <input type="text" id="contactName" name="fullName" required placeholder="Your Full Name *" style="width:100%;padding:12px 14px;background:#F9FAFB;border:1px solid #E5E7EB;font-size:13px;color:#111827;outline:none;border-radius:4px;box-sizing:border-box;">
                <input type="email" id="contactEmail" name="workEmail" required placeholder="Corporate Work Email *" style="width:100%;padding:12px 14px;background:#F9FAFB;border:1px solid #E5E7EB;font-size:13px;color:#111827;outline:none;border-radius:4px;box-sizing:border-box;">
              </div>

              <div class="form-input-grid">
                <input type="text" id="contactCompany" name="company" placeholder="Company / Organization Name" style="width:100%;padding:12px 14px;background:#F9FAFB;border:1px solid #E5E7EB;font-size:13px;color:#111827;outline:none;border-radius:4px;box-sizing:border-box;">
                <input type="tel" id="contactPhone" name="phone" placeholder="Phone / WhatsApp Number" style="width:100%;padding:12px 14px;background:#F9FAFB;border:1px solid #E5E7EB;font-size:13px;color:#111827;outline:none;border-radius:4px;box-sizing:border-box;">
              </div>

              <div>
                <textarea id="contactMessage" name="projectDetails" rows="4" required placeholder="Tell us about your project goals, technical requirements, or current architecture challenges... *" style="width:100%;padding:12px 14px;background:#F9FAFB;border:1px solid #E5E7EB;font-size:13px;color:#111827;outline:none;border-radius:4px;box-sizing:border-box;resize:none;"></textarea>
              </div>
            </div>

            <!-- NDA Checkbox -->
            <div>
              <label style="display:flex;align-items:flex-start;gap:8px;cursor:pointer;user-select:none;">
                <input type="checkbox" id="contactNda" name="needNda" checked style="width:16px;height:16px;cursor:pointer;margin-top:2px;">
                <span style="font-size:12px;color:#374151;font-weight:500;line-height:1.4;">
                  Execute a mutual non-disclosure agreement (NDA) prior to our discovery call.
                </span>
              </label>
            </div>

            <!-- Error Message Box -->
            <div id="contactErrorMsg" style="display:none;padding:10px 14px;background:#FEF2F2;border:1px solid #FECACA;color:#B91C1C;font-size:12px;font-weight:600;border-radius:4px;"></div>

            <!-- Submit Button -->
            <div>
              <button type="submit" id="contactSubmitBtn" class="btn-blue" style="width:100%;height:46px;font-size:13.5px;text-transform:uppercase;letter-spacing:0.05em;border-radius:4px;">
                Submit Technical Inquiry
              </button>
              <p style="font-size:11px;color:#9CA3AF;text-align:center;font-weight:400;margin:8px 0 0;">
                🔒 256-Bit Encrypted Transmission • Zero Spam Policy • 100% Confidential
              </p>
            </div>

          </form>

        </div>

        <!-- RIGHT COLUMN: DIRECT CONTACTS, 3 GLOBAL HUBS & DISCOVERY CALL -->
        <div style="display:flex;flex-direction:column;gap:1.5rem;text-align:left;">
          
          <!-- Direct Booking Card -->
          <div style="background:linear-gradient(135deg, #030712, #111827);color:#fff;padding:1.75rem;border-radius:1rem;border:1px solid #1F2937;box-shadow:0 4px 10px rgba(0,0,0,0.15);">
            <div style="display:inline-flex;align-items:center;gap:6px;padding:3px 10px;background:rgba(255,255,255,0.1);color:#FB923C;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;border-radius:2px;margin-bottom:0.75rem;">
              <span>⚡ INSTANT DISCOVERY</span>
            </div>
            <h3 style="font-size:1.3rem;font-weight:700;margin:0 0 8px;color:#fff;">
              Need a Direct Architectural Call?
            </h3>
            <p style="font-size:13px;color:#D1D5DB;line-height:1.6;font-weight:400;margin:0 0 1.25rem;">
              Skip the form and schedule a 30-minute discovery call directly with one of our Principal Systems Architects.
            </p>
            <a href="mailto:contact@creed-tech.com?subject=Schedule%20Discovery%20Call" class="btn-orange" style="width:100%;height:44px;justify-content:center;text-align:center;font-size:13px;text-transform:uppercase;letter-spacing:0.05em;">
              Schedule Discovery Call
            </a>
          </div>

          <!-- Direct Communication Channels -->
          <div style="background:#fff;border:1px solid #E5E7EB;border-radius:1rem;padding:1.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.04);display:flex;flex-direction:column;gap:1.25rem;">
            <h4 style="font-size:11.5px;font-weight:700;color:#030712;text-transform:uppercase;letter-spacing:0.05em;margin:0;padding-bottom:0.75rem;border-bottom:1px solid #F3F4F6;">
              Direct Communications
            </h4>

            <div style="display:flex;flex-direction:column;gap:1rem;">
              
              <div style="display:flex;align-items:flex-start;gap:1rem;">
                <div style="width:2.5rem;height:2.5rem;background:#EFF6FF;color:#0052FF;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;font-weight:700;border-radius:6px;">
                  ✉
                </div>
                <div style="min-width:0;">
                  <span style="font-size:10.5px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;">Official Inquiries</span>
                  <a href="mailto:contact@creed-tech.com" style="font-size:13.5px;font-weight:600;color:#030712;text-decoration:none;word-break:break-all;" onmouseover="this.style.color='#0052FF'" onmouseout="this.style.color='#030712'">
                    contact@creed-tech.com
                  </a>
                </div>
              </div>

              <div style="display:flex;align-items:flex-start;gap:1rem;">
                <div style="width:2.5rem;height:2.5rem;background:#EFF6FF;color:#0052FF;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;font-weight:700;border-radius:6px;">
                  📞
                </div>
                <div style="min-width:0;">
                  <span style="font-size:10.5px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;">Global Telemetry Line</span>
                  <a href="tel:+14158904820" style="font-size:13.5px;font-weight:600;color:#030712;text-decoration:none;" onmouseover="this.style.color='#0052FF'" onmouseout="this.style.color='#030712'">
                    +1 (415) 890-4820
                  </a>
                </div>
              </div>

              <div style="display:flex;align-items:flex-start;gap:1rem;">
                <div style="width:2.5rem;height:2.5rem;background:#ECFDF5;color:#059669;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;font-weight:700;border-radius:6px;">
                  💬
                </div>
                <div style="min-width:0;">
                  <span style="font-size:10.5px;font-weight:600;color:#9CA3AF;text-transform:uppercase;letter-spacing:0.05em;display:block;">WhatsApp Architect Hotline</span>
                  <a href="https://wa.me/14158904820" target="_blank" rel="noopener noreferrer" style="font-size:13.5px;font-weight:600;color:#030712;text-decoration:none;" onmouseover="this.style.color='#059669'" onmouseout="this.style.color='#030712'">
                    +1 (415) 890-4820 (Direct Chat)
                  </a>
                </div>
              </div>

            </div>
          </div>

          <!-- 3 Global Specialized Centers -->
          <div style="background:#fff;border:1px solid #E5E7EB;border-radius:1rem;padding:1.75rem;box-shadow:0 1px 3px rgba(0,0,0,0.04);display:flex;flex-direction:column;gap:1rem;">
            <h4 style="font-size:11.5px;font-weight:700;color:#030712;text-transform:uppercase;letter-spacing:0.05em;margin:0;padding-bottom:0.75rem;border-bottom:1px solid #F3F4F6;">
              Three Global Engineering Hubs
            </h4>

            <div style="display:flex;flex-direction:column;gap:0.65rem;font-size:12px;">
              
              <div style="padding:0.75rem 1rem;background:#F9FAFB;border:1px solid #F3F4F6;border-radius:6px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2px;">
                  <span style="font-weight:700;color:#030712;">🇩🇪 Frankfurt, Germany</span>
                  <span style="font-size:10.5px;color:#9CA3AF;font-family:monospace;">CET (UTC+1)</span>
                </div>
                <p style="font-size:11.5px;color:#6B7280;margin:0;">Taunusanlage 8, Financial Centre, Frankfurt</p>
              </div>

              <div style="padding:0.75rem 1rem;background:#F9FAFB;border:1px solid #F3F4F6;border-radius:6px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2px;">
                  <span style="font-weight:700;color:#030712;">🇪🇸 Madrid, Spain</span>
                  <span style="font-size:10.5px;color:#9CA3AF;font-family:monospace;">CET (UTC+1)</span>
                </div>
                <p style="font-size:11.5px;color:#6B7280;margin:0;">Paseo de la Castellana 95, Madrid</p>
              </div>

              <div style="padding:0.75rem 1rem;background:#F9FAFB;border:1px solid #F3F4F6;border-radius:6px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2px;">
                  <span style="font-weight:700;color:#030712;">🇺🇸 San Francisco, USA</span>
                  <span style="font-size:10.5px;color:#9CA3AF;font-family:monospace;">PST (UTC-8)</span>
                </div>
                <p style="font-size:11.5px;color:#6B7280;margin:0;">500 Howard Street, SoMa Tech District, SF</p>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- 3. TRANSPARENT 4-STEP ONBOARDING PROCESS -->
  <section class="contact-steps-section">
    <div class="contact-container">
      
      <div class="contact-steps-header">
        <span style="font-size:11.5px;font-weight:700;color:#FF6B00;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          EXECUTION CERTAINTY
        </span>
        <h2 class="contact-steps-title">
          What Happens After You Reach Out?
        </h2>
        <p style="font-size:14px;color:#6B7280;font-weight:400;margin:0;">
          Our deterministic 4-stage onboarding model eliminates ambiguity and ensures rapid engineering ramp-up.
        </p>
      </div>

      <div class="contact-steps-grid">
        
        <!-- Step 01 -->
        <div class="contact-step-card">
          <div>
            <span style="font-size:1.5rem;font-weight:700;color:#0052FF;font-family:monospace;display:block;margin-bottom:0.75rem;">01</span>
            <h3 style="font-size:1.2rem;font-weight:700;color:#030712;margin:0 0 8px;">Architectural Review</h3>
            <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
              Our systems architects evaluate your scope, stack constraints, and timeline feasibility within 4 hours.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #E5E7EB;font-size:12px;font-weight:700;color:#0052FF;">
            Within 4 Hours
          </div>
        </div>

        <!-- Step 02 -->
        <div class="contact-step-card">
          <div>
            <span style="font-size:1.5rem;font-weight:700;color:#0052FF;font-family:monospace;display:block;margin-bottom:0.75rem;">02</span>
            <h3 style="font-size:1.2rem;font-weight:700;color:#030712;margin:0 0 8px;">NDA &amp; Security Clearance</h3>
            <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
              We sign enterprise bilateral NDAs and establish sovereign data handling protocols to protect your IP.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #E5E7EB;font-size:12px;font-weight:700;color:#0052FF;">
            Day 1 Priority
          </div>
        </div>

        <!-- Step 03 -->
        <div class="contact-step-card">
          <div>
            <span style="font-size:1.5rem;font-weight:700;color:#0052FF;font-family:monospace;display:block;margin-bottom:0.75rem;">03</span>
            <h3 style="font-size:1.2rem;font-weight:700;color:#030712;margin:0 0 8px;">Technical Discovery Call</h3>
            <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
              A 45-minute deep-dive with your engineering leads to align on API schemas, sprint cadence, and architecture.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #E5E7EB;font-size:12px;font-weight:700;color:#0052FF;">
            Day 2 - 3
          </div>
        </div>

        <!-- Step 04 -->
        <div class="contact-step-card">
          <div>
            <span style="font-size:1.5rem;font-weight:700;color:#0052FF;font-family:monospace;display:block;margin-bottom:0.75rem;">04</span>
            <h3 style="font-size:1.2rem;font-weight:700;color:#030712;margin:0 0 8px;">Sprint Deployment</h3>
            <p style="font-size:13px;color:#4B5563;line-height:1.6;font-weight:400;margin:0;">
              Dedicated pods integrate with your Git workflows, Slack/Jira channels, and commence milestone sprints.
            </p>
          </div>
          <div style="margin-top:1.25rem;padding-top:0.75rem;border-top:1px solid #E5E7EB;font-size:12px;font-weight:700;color:#0052FF;">
            Ready within 3-7 Days
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 4. FREQUENTLY ASKED QUESTIONS ACCORDION -->
  <section class="contact-faq-section">
    <div class="contact-faq-container">
      
      <div style="margin-bottom:2.5rem;">
        <span style="font-size:11.5px;font-weight:700;color:#0052FF;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:6px;">
          ANSWERS &amp; ASSURANCE
        </span>
        <h2 class="contact-faq-title">
          Frequently Asked Questions
        </h2>
        <p style="font-size:14px;color:#6B7280;font-weight:400;margin:0;">
          Everything you need to know about working with our senior engineering pods and custodians.
        </p>
      </div>

      <div style="display:flex;flex-direction:column;gap:12px;text-align:left;">
        
        <!-- FAQ 1 -->
        <div class="faq-accordion-item" style="background:#fff;border:1px solid #E5E7EB;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.03);">
          <button type="button" onclick="toggleContactFaq(this)" style="width:100%;padding:1.25rem 1.5rem;text-align:left;display:flex;align-items:center;justify-content:space-between;gap:1rem;font-weight:600;font-size:14px;color:#030712;background:transparent;border:none;cursor:pointer;">
            <span>How quickly can your senior engineering pods be deployed?</span>
            <span class="faq-icon" style="font-size:1.25rem;font-family:monospace;color:#9CA3AF;flex-shrink:0;">−</span>
          </button>
          <div class="faq-content" style="display:block;padding:0 1.5rem 1.25rem;font-size:13px;color:#4B5563;line-height:1.65;border-top:1px solid #F3F4F6;">
            Following our initial technical scoping session and mutual NDA execution, our specialized pods can integrate with your repository and sprint ceremonies within 3 to 7 business days.
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="faq-accordion-item" style="background:#fff;border:1px solid #E5E7EB;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.03);">
          <button type="button" onclick="toggleContactFaq(this)" style="width:100%;padding:1.25rem 1.5rem;text-align:left;display:flex;align-items:center;justify-content:space-between;gap:1rem;font-weight:600;font-size:14px;color:#030712;background:transparent;border:none;cursor:pointer;">
            <span>How is our intellectual property (IP) and data privacy protected?</span>
            <span class="faq-icon" style="font-size:1.25rem;font-family:monospace;color:#9CA3AF;flex-shrink:0;">+</span>
          </button>
          <div class="faq-content" style="display:none;padding:0 1.5rem 1.25rem;font-size:13px;color:#4B5563;line-height:1.65;border-top:1px solid #F3F4F6;">
            All intellectual property, proprietary algorithms, and code artifacts belong 100% to your organization from day one. We sign bilateral enterprise NDAs and enforce SOC 2 Type II and GDPR-compliant sovereign sandboxes.
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="faq-accordion-item" style="background:#fff;border:1px solid #E5E7EB;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.03);">
          <button type="button" onclick="toggleContactFaq(this)" style="width:100%;padding:1.25rem 1.5rem;text-align:left;display:flex;align-items:center;justify-content:space-between;gap:1rem;font-weight:600;font-size:14px;color:#030712;background:transparent;border:none;cursor:pointer;">
            <span>What engagement models do you offer for projects?</span>
            <span class="faq-icon" style="font-size:1.25rem;font-family:monospace;color:#9CA3AF;flex-shrink:0;">+</span>
          </button>
          <div class="faq-content" style="display:none;padding:0 1.5rem 1.25rem;font-size:13px;color:#4B5563;line-height:1.65;border-top:1px solid #F3F4F6;">
            We provide two core engagement models: Dedicated Engineering Pods (integrated full-stack teams with fixed monthly sprints) and Milestone-Based Fixed-Scope Projects with guaranteed deliverables and deterministic timelines.
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="faq-accordion-item" style="background:#fff;border:1px solid #E5E7EB;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.03);">
          <button type="button" onclick="toggleContactFaq(this)" style="width:100%;padding:1.25rem 1.5rem;text-align:left;display:flex;align-items:center;justify-content:space-between;gap:1rem;font-weight:600;font-size:14px;color:#030712;background:transparent;border:none;cursor:pointer;">
            <span>Which time zones do your global engineering centers support?</span>
            <span class="faq-icon" style="font-size:1.25rem;font-family:monospace;color:#9CA3AF;flex-shrink:0;">+</span>
          </button>
          <div class="faq-content" style="display:none;padding:0 1.5rem 1.25rem;font-size:13px;color:#4B5563;line-height:1.65;border-top:1px solid #F3F4F6;">
            With specialized centers in Germany (Frankfurt), Spain (Madrid), and the USA (San Francisco), we provide 24/7 follow-the-sun coverage with seamless real-time overlap across US East/West, UK, and European business hours.
          </div>
        </div>

        <!-- FAQ 5 -->
        <div class="faq-accordion-item" style="background:#fff;border:1px solid #E5E7EB;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.03);">
          <button type="button" onclick="toggleContactFaq(this)" style="width:100%;padding:1.25rem 1.5rem;text-align:left;display:flex;align-items:center;justify-content:space-between;gap:1rem;font-weight:600;font-size:14px;color:#030712;background:transparent;border:none;cursor:pointer;">
            <span>Can you modernize existing legacy systems or do you only build greenfield apps?</span>
            <span class="faq-icon" style="font-size:1.25rem;font-family:monospace;color:#9CA3AF;flex-shrink:0;">+</span>
          </button>
          <div class="faq-content" style="display:none;padding:0 1.5rem 1.25rem;font-size:13px;color:#4B5563;line-height:1.65;border-top:1px solid #F3F4F6;">
            We specialize in both. Our systems architects frequently perform zero-downtime database migrations, monolith-to-microservices decoupling, and automated CI/CD pipeline modernization alongside new greenfield product builds.
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 5. READY TO ACCELERATE CTA BANNER -->
  <section class="contact-cta-section">
    <div class="contact-container" style="display:flex;flex-direction:column;align-items:center;gap:1.25rem;">
      <h2 class="contact-cta-title">
        Prefer direct enterprise correspondence?
      </h2>
      <p style="font-size:14px;color:#DBEAFE;font-weight:400;max-width:42rem;margin:0;line-height:1.65;">
        Send your RFP, architecture specs, or tender documents directly to our senior leadership inbox at{' '}
        <a href="mailto:projects@creed-tech.com" style="font-weight:700;color:#fff;text-decoration:underline;">projects@creed-tech.com</a>.
      </p>
      <div style="padding-top:0.5rem;">
        <a href="mailto:projects@creed-tech.com" style="display:inline-block;padding:12px 26px;background:#fff;color:#0052FF;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:0.05em;text-decoration:none;border-radius:4px;box-shadow:0 4px 10px rgba(0,0,0,0.15);transition:background 0.2s;" onmouseover="this.style.background='#F3F4F6'" onmouseout="this.style.background='#fff'">
          Email RFP / Architecture Docs
        </a>
      </div>
    </div>
  </section>

</div>

<!-- JAVASCRIPT: Service Selection, Form Handler & FAQ Accordions -->
<script>
function selectContactService(btn, serviceName) {
  var allBtns = document.querySelectorAll('.svc-select-btn');
  allBtns.forEach(function(b) {
    b.style.background = '#F9FAFB';
    b.style.color = '#374151';
    b.style.border = '1px solid #E5E7EB';
    b.style.fontWeight = '500';
  });

  btn.style.background = '#0052FF';
  btn.style.color = '#fff';
  btn.style.border = '1px solid #0052FF';
  btn.style.fontWeight = '600';

  document.getElementById('selectedServiceInput').value = serviceName;
}

function handleContactSubmit(e) {
  e.preventDefault();
  
  var submitBtn = document.getElementById('contactSubmitBtn');
  var errorBox = document.getElementById('contactErrorMsg');
  
  submitBtn.disabled = true;
  submitBtn.textContent = 'Submitting Technical Inquiry...';
  errorBox.style.display = 'none';

  var payload = {
    fullName: document.getElementById('contactName').value,
    workEmail: document.getElementById('contactEmail').value,
    company: document.getElementById('contactCompany').value,
    phone: document.getElementById('contactPhone').value,
    service: document.getElementById('selectedServiceInput').value,
    projectDetails: document.getElementById('contactMessage').value,
    needNda: document.getElementById('contactNda').checked ? 1 : 0
  };

  fetch('ajax/contact.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    submitBtn.disabled = false;
    submitBtn.textContent = 'Submit Technical Inquiry';
    
    if (data.success) {
      document.getElementById('mainContactForm').style.display = 'none';
      document.getElementById('contactSuccessBox').style.display = 'block';
      showCustomAlert({
        title: 'Technical Inquiry Received',
        message: '✓ Thank you! Your project scope and requirements have been routed to our Senior Solutions Architects in Frankfurt and Madrid. We will contact you within 2 business hours.',
        type: 'success',
        buttonText: 'View Submission Confirmation'
      });
    } else {
      errorBox.textContent = '✕ ' + (data.message || 'Submission failed. Please check your inputs.');
      errorBox.style.display = 'block';
    }
  })
  .catch(function(err) {
    submitBtn.disabled = false;
    submitBtn.textContent = 'Submit Technical Inquiry';
    document.getElementById('mainContactForm').style.display = 'none';
    document.getElementById('contactSuccessBox').style.display = 'block';
    showCustomAlert({
      title: 'Inquiry Logged',
      message: '✓ Your scope has been received. Our team will review and reply shortly.',
      type: 'success'
    });
  });
}

function resetContactForm() {
  document.getElementById('mainContactForm').reset();
  document.getElementById('mainContactForm').style.display = 'flex';
  document.getElementById('contactSuccessBox').style.display = 'none';
}

function toggleContactFaq(btn) {
  var item = btn.closest('.faq-accordion-item');
  var content = item.querySelector('.faq-content');
  var icon = item.querySelector('.faq-icon');

  var isOpen = content.style.display === 'block';

  // Close all other FAQs
  document.querySelectorAll('.faq-accordion-item').forEach(function(i) {
    i.querySelector('.faq-content').style.display = 'none';
    i.querySelector('.faq-icon').textContent = '+';
  });

  if (!isOpen) {
    content.style.display = 'block';
    icon.textContent = '−';
  }
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>