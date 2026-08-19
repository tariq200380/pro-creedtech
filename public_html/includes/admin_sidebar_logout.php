<?php
/**
 * Creed Tech - Shared Admin Sidebar Logout Form Component
 */
require_once __DIR__ . '/csrf.php';
?>
<div class="profile_dashboard user_dashboard mt-2" style="background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);border-radius:4px;padding:8px 12px;">
  <form method="POST" action="logout.php" style="margin:0;padding:0;">
    <?php echo csrf_field(); ?>
    <button type="submit" style="background:none;border:none;color:#FCA5A5;cursor:pointer;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px;width:100%;text-align:left;padding:0;">
      <span>🚪</span> <span>Logout</span>
    </button>
  </form>
</div>
