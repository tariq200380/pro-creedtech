<?php
/**
 * Creed Tech - Shared Admin Top Bar Component with Administrator Badge and POST Logout Form
 */
require_once __DIR__ . '/csrf.php';
$adminDisplayName = htmlspecialchars($_SESSION['admin_email'] ?? 'Lead Architect');
?>
<div style="display:flex;align-items:center;gap:16px;">
  <div style="display:flex;align-items:center;gap:8px;font-size:12px;color:#94A3B8;">
    <span style="width:8px;height:8px;background:#10B981;border-radius:50%;display:inline-block;"></span>
    <span><?php echo $adminDisplayName; ?> <strong style="color:#10B981;">(Logged In)</strong></span>
  </div>
  <form method="POST" action="logout.php" style="margin:0;display:inline-block;">
    <?php echo csrf_field(); ?>
    <button type="submit" id="adminLogoutBtn" title="Secure Logout" style="background:#EF4444;color:#FFFFFF;border:none;padding:6px 14px;font-size:12px;font-weight:600;border-radius:4px;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s;box-shadow:0 1px 2px rgba(0,0,0,0.2);" onmouseover="this.style.background='#DC2626'" onmouseout="this.style.background='#EF4444'">
      <span>🚪</span> <span>Logout</span>
    </button>
  </form>
</div>
