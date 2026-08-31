<?php
require_once __DIR__ . '/includes/services/services-page-config.php';
include __DIR__ . '/includes/header.php';
?>

<!-- 1. HERO BANNER -->
<?php include __DIR__ . '/includes/services/services-hero.php'; ?>

<!-- 2. PROJECT DELIVERY PROCESS -->
<?php include __DIR__ . '/includes/services/services-delivery-process.php'; ?>

<!-- 3. SERVICES INTERACTIVE SELECTOR & DETAIL SECTION -->
<?php require __DIR__ . '/includes/services/services-interactive-explorer.php'; ?>

<!-- 4. SOLUTION AREAS -->
<?php include __DIR__ . '/includes/services/services-solution-areas.php'; ?>

<!-- 5. OUR DELIVERY COMMITMENT -->
<?php require __DIR__ . '/includes/services/services-delivery-commitment.php'; ?>

<!-- 6. INDUSTRIES WE SUPPORT (Dark Section) -->
<?php require __DIR__ . '/includes/services/services-industries.php'; ?>

<!-- 7. FINAL CTA: LET'S BRING YOUR VISION TO LIFE -->
<?php require __DIR__ . '/includes/services/services-vision-cta.php'; ?>


<!-- JAVASCRIPT: Complete Standalone Vector Tech Icons & Interactive Controllers -->
<script src="<?= htmlspecialchars(creed_asset_url('/assets/js/services/services-data.js'), ENT_QUOTES, 'UTF-8') ?>" defer></script>
<script src="<?= htmlspecialchars(creed_asset_url('/assets/js/services/services-controller.js'), ENT_QUOTES, 'UTF-8') ?>" defer></script>

<?php include __DIR__ . '/includes/footer.php'; ?>
