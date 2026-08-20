<?php
/**
 * Creed Tech - 404 Not Found Page
 * Standard HTTP 404 Header and Soft-404 Prevention
 */

http_response_code(404);

$page_title = "404 - Page Not Found | Creed Tech";
$page_description = "The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.";
$active_page = "404";
$canonical_url = "https://creed-tech.com/404";

require_once __DIR__ . '/includes/header.php';
?>

<div class="min-h-[70vh] bg-[#F8FAFC] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
  <div class="max-w-xl w-full text-center bg-white p-8 sm:p-12 rounded-2xl border border-[#E2E8F0] shadow-sm">
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-50 text-[#0052FF] text-3xl font-black mb-6 shadow-xs">
      404
    </div>
    
    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight mb-3">
      Page Not Found
    </h1>
    
    <p class="text-sm sm:text-base text-[#64748B] leading-relaxed mb-8">
      We couldn't find the page you're looking for. It may have been moved, renamed, or no longer exists.
    </p>
    
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
      <a href="/" class="btn-blue w-full sm:w-auto px-6 py-3 text-sm font-semibold rounded-lg shadow-xs transition-transform hover:-translate-y-0.5">
        Return to Home
      </a>
      <a href="knowledge-center" class="btn-gray w-full sm:w-auto px-6 py-3 text-sm font-semibold rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
        Browse Knowledge Center
      </a>
    </div>
  </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
