<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "Get Started | Accelerate Your Enterprise Infrastructure | Creed Tech";
$page_description = "Book a discovery session with our senior architects to evaluate your architecture, optimize costs, and build for resilient scale.";
$active_page = "get-started";

include __DIR__ . '/includes/header.php';
?>

<section style="padding: 48px 0; background: #E5E7EB; border-bottom: 1px solid #D1D5DB;">
  <div class="container-creed">
    <div style="max-width: 800px; margin: 0 auto; text-align: center;">
      <span style="font-size: 0.8rem; font-weight: 800; color: #0052FF; text-transform: uppercase; letter-spacing: 0.12em; display: block; margin-bottom: 12px;">START YOUR JOURNEY</span>
      <h1 style="font-size: clamp(2.4rem, 4vw, 3.4rem); font-weight: 800; color: #0F172A; line-height: 1.15; margin-bottom: 18px;">
        Accelerate Your Enterprise Infrastructure
      </h1>
      <p style="font-size: 1.15rem; color: #374151; line-height: 1.7; margin-bottom: 36px;">
        Book a discovery session with our senior architects to evaluate your architecture, optimize infrastructure costs, and build for resilient scale.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 max-w-lg mx-auto">
        <a href="contact" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-3.5 text-[15px] font-bold text-white bg-[#0052FF] hover:bg-[#0043D1] border-2 border-[#0052FF] hover:border-[#0043D1] rounded-lg shadow-md hover:shadow-lg transition-all duration-200 min-w-[220px] text-center whitespace-nowrap">
          Book Architecture
        </a>
        <a href="services" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-3.5 text-[15px] font-bold text-[#0052FF] hover:text-white bg-white hover:bg-[#0052FF] border-2 border-[#0052FF] rounded-lg shadow-xs hover:shadow-md transition-all duration-200 min-w-[220px] text-center whitespace-nowrap">
          Explore Solutions
        </a>
      </div>
    </div>
  </div>
</section>

<!-- 3 Steps -->
<section style="padding: 70px 0; background: #FAFAFA; border-bottom: 1px solid #F1F5F9;">
  <div class="container-creed">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
      
      <div style="background: #ffffff; border: 1px solid #E2E8F0; padding: 32px; border-radius: 8px;">
        <span style="font-size: 1.8rem; font-weight: 800; color: #0052FF; display: block; margin-bottom: 12px;">01</span>
        <h4 style="font-size: 1.2rem; font-weight: 700; color: #0F172A; margin-bottom: 8px;">Discovery & Scoping</h4>
        <p style="font-size: 0.92rem; color: #64748B; line-height: 1.6;">We analyze your project requirements, technical architecture, and milestones under mutual NDA.</p>
      </div>

      <div style="background: #ffffff; border: 1px solid #E2E8F0; padding: 32px; border-radius: 8px;">
        <span style="font-size: 1.8rem; font-weight: 800; color: #0052FF; display: block; margin-bottom: 12px;">02</span>
        <h4 style="font-size: 1.2rem; font-weight: 700; color: #0F172A; margin-bottom: 8px;">Squad Integration</h4>
        <p style="font-size: 0.92rem; color: #64748B; line-height: 1.6;">We match dedicated senior developers, architects, and QA engineers who onboard in 48 hours.</p>
      </div>

      <div style="background: #ffffff; border: 1px solid #E2E8F0; padding: 32px; border-radius: 8px;">
        <span style="font-size: 1.8rem; font-weight: 800; color: #0052FF; display: block; margin-bottom: 12px;">03</span>
        <h4 style="font-size: 1.2rem; font-weight: 700; color: #0F172A; margin-bottom: 8px;">Iterative Delivery</h4>
        <p style="font-size: 0.92rem; color: #64748B; line-height: 1.6;">Continuous 2-week sprints, transparent Git commits, automated CI/CD builds, and production releases.</p>
      </div>

    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
