<?php
/**
 * Creed Tech - Global Footer with Dynamic Settings Integration
 */
require_once __DIR__ . '/security_helpers.php';
$siteSettings = creed_get_site_settings();
$footerConfig = $siteSettings['footer'] ?? [];
$generalConfig = $siteSettings['general'] ?? [];

// Social media URLs (already dynamic, completely unchanged!)
$fbUrl   = !empty($footerConfig['facebook_url']) ? $footerConfig['facebook_url'] : 'https://facebook.com/creedtechnology';
$instaUrl = !empty($footerConfig['instagram_url']) ? $footerConfig['instagram_url'] : 'https://instagram.com/creed.technologiess';
$liUrl   = !empty($footerConfig['linkedin_url']) ? $footerConfig['linkedin_url'] : 'https://linkedin.com/company/creedtech';
$pinUrl  = !empty($footerConfig['pinterest_url']) ? $footerConfig['pinterest_url'] : 'https://pinterest.com/creedtech';
$xUrl    = !empty($footerConfig['twitter_url']) ? $footerConfig['twitter_url'] : 'https://x.com/Creedtech3';
$ghUrl   = !empty($footerConfig['github_url']) ? $footerConfig['github_url'] : 'https://github.com/creed-tech';
$copyrightText = !empty($footerConfig['copyright_text']) ? $footerConfig['copyright_text'] : '© 2026 Creed Tech. All rights reserved.';

// Brand description paragraphs (with fallback)
$brandP1 = !empty($footerConfig['brand_description_p1']) ? $footerConfig['brand_description_p1'] : 'We specialize in enterprise software architecture, robust cloud infrastructure, and next-generation cybersecurity.';
$brandP2 = !empty($footerConfig['brand_description_p2']) ? $footerConfig['brand_description_p2'] : 'Engineering scalable, high-performance, and resilient systems tailored for global enterprises and modern businesses.';
$brandP3 = !empty($footerConfig['brand_description_p3']) ? $footerConfig['brand_description_p3'] : 'Delivering end-to-end digital transformation, modern web systems, and strategic IT consulting to accelerate growth.';

// Contact Information: Connected directly to general settings with fallback
$footerAddress = !empty($generalConfig['office_address']) ? $generalConfig['office_address'] : 'Office # 02, Mian Shopping Center, Sheikhupura, Pakistan';
$footerEmail   = !empty($generalConfig['contact_email']) ? $generalConfig['contact_email'] : 'info@creed-tech.com';
$footerPhone   = !empty($generalConfig['contact_phone']) ? $generalConfig['contact_phone'] : '+92 309 8307115';

// Useful Links (with fallback)
$defaultUsefulLinks = [
  ['label' => 'Home', 'url' => '/'],
  ['label' => 'Services', 'url' => 'services'],
  ['label' => 'Knowledge Center', 'url' => 'knowledge-center'],
  ['label' => 'Portfolio', 'url' => 'portfolio'],
  ['label' => 'About', 'url' => 'about'],
  ['label' => 'Contact', 'url' => 'contact'],
  ['label' => 'Careers', 'url' => 'careers'],
  ['label' => 'Security Center', 'url' => 'security'],
];
$usefulLinks = (!empty($footerConfig['useful_links']) && is_array($footerConfig['useful_links'])) ? $footerConfig['useful_links'] : $defaultUsefulLinks;

// Services Links (with fallback)
$defaultServicesLinks = [
  ['label' => 'Database Management', 'url' => 'services'],
  ['label' => 'Web Development', 'url' => 'services'],
  ['label' => 'Software Development', 'url' => 'services'],
  ['label' => 'Digital Marketing', 'url' => 'services'],
  ['label' => 'Artificial Intelligence (AI)', 'url' => 'services'],
  ['label' => 'Cloud Infrastructure', 'url' => 'services'],
  ['label' => 'UI/UX Design', 'url' => 'services'],
  ['label' => 'Digital Branding', 'url' => 'services'],
];
$servicesLinks = (!empty($footerConfig['services_links']) && is_array($footerConfig['services_links'])) ? $footerConfig['services_links'] : $defaultServicesLinks;
?>
  <!-- ======= NEWSLETTER STRIP (newsletter-strip/index.tsx) ======= -->
  <section class="w-full bg-[#F4F6F8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      
      <div class="bg-white border border-[#E5E8EB] p-6 sm:p-8 md:p-10 rounded-2xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 lg:gap-16">
        
        <!-- Text -->
        <div class="w-full md:w-1/2 flex flex-col text-left">
          <h3 class="text-xl md:text-2xl font-bold text-[#1A1A1A] mb-2">
            Subscribe to Enterprise Insights
          </h3>
          <p class="text-sm text-[#1A1A1A]/70 leading-relaxed max-w-md">
            Get quarterly whitepapers, architectural blueprints, and technology benchmarks directly to your inbox.
          </p>
        </div>
        
        <!-- Vertical Separator for Desktop -->
        <div class="hidden md:block w-1 h-20 bg-[#E5E8EB] shrink-0 rounded-[2px]"></div>

        <!-- Form -->
        <div class="w-full md:w-1/2 flex flex-col">
          <form id="nextJsNewsletterForm" class="flex flex-col sm:flex-row gap-3 w-full">
            <input
              type="email"
              name="email"
              placeholder="Enter your work email"
              required
              class="bg-[#F4F6F8] border border-[#E5E8EB] text-[#1A1A1A] text-sm rounded-none px-4 py-2.5 focus:outline-none focus:border-[#0052FF] placeholder-[#888888] w-full transition-colors h-[42px]"
            />
            <button
              type="submit"
              id="newsletterBtnExact"
              class="btn-orange shrink-0 min-w-[130px]"
            >
              Subscribe
            </button>
          </form>
        </div>

      </div>

      <div class="w-full h-[3px] bg-[#FF6A00] mt-8 rounded-[2px]"></div>

    </div>
  </section>

  <!-- ======= EXACT NEXT.JS MAIN FOOTER (footer/index.tsx) ======= -->
  <footer class="bg-[#1A1A1A] text-[#F4F6F8] pt-16 pb-8 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid grid-cols-2 md:grid-cols-4 gap-y-10 gap-x-6 sm:gap-x-8 md:gap-x-12 lg:gap-x-16 w-full max-w-7xl mx-auto px-6 pb-2">
        
        <!-- FooterBrandInfo.tsx -->
        <div class="col-span-2 md:col-span-1 flex flex-col text-left">
          <h2 class="text-xl font-bold h-6 flex items-center mb-6 tracking-tight">
            <span class="text-[#F4F6F8]">CREED</span>
            <span class="text-[#FF6A00]"> TECH</span>
          </h2>
          <div class="text-sm text-[#F4F6F8]/80 leading-relaxed flex flex-col justify-between h-auto md:h-[290px] space-y-3.5 md:space-y-0">
            <p><?= htmlspecialchars($brandP1) ?></p>
            <p><?= htmlspecialchars($brandP2) ?></p>
            <p><?= htmlspecialchars($brandP3) ?></p>
          </div>
        </div>

        <!-- FooterLinksGroup.tsx (Useful Links - Left Column on Mobile) -->
        <div class="col-span-1 md:col-span-1 flex flex-col text-left">
          <h3 class="text-xs font-bold uppercase tracking-widest text-white h-6 flex items-center mb-6">
            Useful Links
          </h3>
          <ul class="flex flex-col space-y-3.5">
            <?php foreach ($usefulLinks as $uLink): 
              $uRawUrl = $uLink['url'] ?? '#';
              $uUrl = htmlspecialchars(($uRawUrl === 'Home' || $uRawUrl === 'home') ? '/' : $uRawUrl);
            ?>
            <li class="h-6 flex items-center"><a href="<?= $uUrl ?>" class="text-sm leading-6 text-[#F4F6F8]/80 hover:text-white transition-colors"><?= htmlspecialchars($uLink['label'] ?? '') ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- FooterLinksGroup.tsx (Our Services - Right Column on Mobile) -->
        <div class="col-span-1 md:col-span-1 flex flex-col text-left">
          <h3 class="text-xs font-bold uppercase tracking-widest text-white h-6 flex items-center mb-6">
            Our Services
          </h3>
          <ul class="flex flex-col space-y-3.5">
            <?php foreach ($servicesLinks as $sLink): ?>
            <li class="h-6 flex items-center"><a href="<?= htmlspecialchars($sLink['url'] ?? '#') ?>" class="text-sm leading-6 text-[#F4F6F8]/80 hover:text-white transition-colors"><?= htmlspecialchars($sLink['label'] ?? '') ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- FooterContactInfo.tsx (Contact Info) -->
        <div class="col-span-2 md:col-span-1 flex flex-col text-left">
          <h3 class="text-xs font-bold text-white uppercase tracking-widest h-6 flex items-center mb-6">
            Contact
          </h3>
          
          <div class="text-sm leading-6 text-[#F4F6F8]/80 grid grid-cols-2 md:grid-cols-1 gap-x-6 gap-y-4">
            
            <!-- LEFT on Mobile / BOTTOM on Desktop: PSEB badge + Social Links -->
            <div class="flex flex-col space-y-3.5 order-1 md:order-2">
              <div>
                <span class="bg-[#0052FF]/20 text-white text-[11px] font-semibold px-2 py-0.5 rounded inline-block leading-normal">
                  PSEB Registered
                </span>
              </div>
              
              <div class="grid grid-cols-2 gap-x-3 gap-y-3.5 max-w-[180px]">
                <a href="<?= htmlspecialchars($fbUrl) ?>" target="_blank" rel="noopener noreferrer" class="h-6 flex items-center hover:text-[#FF6B00] transition-colors duration-200">
                  Facebook
                </a>
                <a href="<?= htmlspecialchars($instaUrl) ?>" target="_blank" rel="noopener noreferrer" class="h-6 flex items-center hover:text-[#FF6B00] transition-colors duration-200">
                  Instagram
                </a>
                <a href="<?= htmlspecialchars($liUrl) ?>" target="_blank" rel="noopener noreferrer" class="h-6 flex items-center hover:text-[#FF6B00] transition-colors duration-200">
                  LinkedIn
                </a>
                <a href="<?= htmlspecialchars($pinUrl) ?>" target="_blank" rel="noopener noreferrer" class="h-6 flex items-center hover:text-[#FF6B00] transition-colors duration-200">
                  Pinterest
                </a>
                <a href="<?= htmlspecialchars($xUrl) ?>" target="_blank" rel="noopener noreferrer" class="h-6 flex items-center hover:text-[#FF6B00] transition-colors duration-200" title="X" aria-label="X">
                  <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                  </svg>
                </a>
                <a href="<?= htmlspecialchars($ghUrl) ?>" target="_blank" rel="noopener noreferrer" class="h-6 flex items-center hover:text-[#FF6B00] transition-colors duration-200">
                  GitHub
                </a>
              </div>
            </div>

            <!-- RIGHT on Mobile / TOP on Desktop: Address, Email, Phone -->
            <div class="flex flex-col space-y-3.5 order-2 md:order-1">
              <div class="h-auto leading-tight flex items-center"><?= htmlspecialchars($footerAddress) ?></div>
              <div class="h-6 flex items-center">
                <a href="mailto:<?= htmlspecialchars($footerEmail) ?>" class="hover:text-white transition-colors">
                  <?= htmlspecialchars($footerEmail) ?>
                </a>
              </div>
              <div class="h-6 flex items-center">
                <a href="tel:<?= htmlspecialchars(preg_replace('/[^0-9+]/', '', $footerPhone)) ?>" class="hover:text-white transition-colors">
                  <?= htmlspecialchars($footerPhone) ?>
                </a>
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- FooterSubLegalBar.tsx -->
      <div class="flex flex-col sm:flex-row items-center justify-between border-t border-[#2A2A2A] pt-6 mt-8">
        <div class="text-xs text-[#F4F6F8]/60 mb-4 sm:mb-0 text-center sm:text-left flex flex-wrap items-center justify-center sm:justify-start gap-x-3 gap-y-1">
          <span><?= htmlspecialchars($copyrightText) ?> • Designed & Developed by <span class="font-semibold text-white">CREED TECH</span></span>
          <span class="hidden sm:inline text-gray-600">|</span>
          <a href="privacy-policy" class="hover:text-white hover:underline transition-colors">Privacy Policy</a>
          <span class="text-gray-600">•</span>
          <a href="terms" class="hover:text-white hover:underline transition-colors">Terms &amp; Conditions</a>
        </div>
        
        <!-- 4 Equal-Sized Clickable Security Badges (2 Left & 2 Right on Mobile, Horizontal Row on Desktop) -->
        <div class="grid grid-cols-2 sm:flex sm:flex-row sm:items-center justify-center gap-3 w-full sm:w-auto">
          <a 
            href="security-iso-27001"
            class="w-full sm:w-28 h-8 flex items-center justify-center text-center text-xs font-semibold rounded-none bg-[#242424] text-[#F4F6F8]/90 border border-[#383838] transition-all duration-300 hover:border-[#FF6B00] hover:text-[#FF6B00] hover:bg-[#FF6B00]/10 cursor-pointer select-none"
          >
            ISO 27001
          </a>
          <a 
            href="security-gdpr"
            class="w-full sm:w-28 h-8 flex items-center justify-center text-center text-xs font-semibold rounded-none bg-[#242424] text-[#F4F6F8]/90 border border-[#383838] transition-all duration-300 hover:border-[#FF6B00] hover:text-[#FF6B00] hover:bg-[#FF6B00]/10 cursor-pointer select-none"
          >
            GDPR
          </a>
          <a 
            href="security-soc-2"
            class="w-full sm:w-28 h-8 flex items-center justify-center text-center text-xs font-semibold rounded-none bg-[#242424] text-[#F4F6F8]/90 border border-[#383838] transition-all duration-300 hover:border-[#FF6B00] hover:text-[#FF6B00] hover:bg-[#FF6B00]/10 cursor-pointer select-none"
          >
            SOC 2
          </a>
          <a 
            href="security-pci-dss"
            class="w-full sm:w-28 h-8 flex items-center justify-center text-center text-xs font-semibold rounded-none bg-[#242424] text-[#F4F6F8]/90 border border-[#383838] transition-all duration-300 hover:border-[#FF6B00] hover:text-[#FF6B00] hover:bg-[#FF6B00]/10 cursor-pointer select-none"
          >
            PCI-DSS
          </a>
        </div>
      </div>

    </div>
  </footer>

  <script>
    // Newsletter Submission
    const newsForm = document.getElementById("nextJsNewsletterForm");
    if (newsForm) {
      newsForm.addEventListener("submit", async function(e) {
        e.preventDefault();
        const btn = document.getElementById("newsletterBtnExact");
        btn.disabled = true;
        btn.innerText = "Subscribing...";
        const formData = new FormData(newsForm);

        try {
          const res = await fetch("ajax/newsletter.php", { method: "POST", body: formData });
          const data = await res.json();
          showCustomAlert({
            title: data.success ? "Subscribed!" : "Notice",
            message: data.message || "✓ Successfully subscribed to insights!",
            type: data.success ? "success" : "warning",
            buttonText: "Continue"
          });
          if (data.success) newsForm.reset();
        } catch (err) {
          showCustomAlert({
            title: "Subscribed!",
            message: "✓ Successfully subscribed to insights!",
            type: "success",
            buttonText: "Continue"
          });
          newsForm.reset();
        } finally {
          btn.disabled = false;
          btn.innerText = "Subscribe";
        }
      });
    }
  </script>
</body>
</html>
