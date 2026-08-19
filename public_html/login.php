<?php
/**
 * Creed Tech - Administrative Portal Login
 */

ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? '') == 443;
session_name('CREED_ADMIN_SESSID');
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'domain'   => '',
    'secure'   => $isHttps,
    'httponly' => true,
    'samesite' => 'Strict'
]);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Anti-cache headers for login page
if (!headers_sent()) {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private');
    header('Pragma: no-cache');
}

require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/admin_auth.php';

// If already authenticated, redirect to destination
if (!empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit;
}

$error = "";
$submittedEmail = "";
$redirect = $_GET['redirect'] ?? 'admin.php';

// Sanitize redirect target to prevent open redirect vulnerabilities
if (preg_match('/^[a-zA-Z0-9_\-\.\/]+$/', $redirect) && !str_contains($redirect, '://') && !str_starts_with($redirect, '//')) {
    $safeRedirect = $redirect;
} else {
    $safeRedirect = 'admin.php';
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login_user'])) {
    $submittedEmail = trim((string)($_POST['email'] ?? ''));
    if (!validate_csrf_token()) {
        $error = "Security token validation failed. Please refresh and try again.";
    } else {
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $error = "Please enter both administrator email and password.";
        } else {
            $auth = authenticate_admin($email, $password);
            if ($auth['success']) {
                header('Location: ' . $safeRedirect);
                exit;
            } else {
                $error = $auth['error'];
            }
        }
    }
}

$page_title = "Admin Portal Login | Creed Tech";
$page_description = "Administrative portal login for managing Creed Tech articles, stories, and platform content.";
$active_page = "login";

include __DIR__ . '/includes/header.php';
?>

<!-- ======= Login Section ======= -->
<section class="creed-section" style="min-height: 75vh; display: flex; align-items: center; background: radial-gradient(circle at center, rgba(235, 242, 255, 0.7) 0%, #ffffff 90%);">
  <div class="creed-container" style="max-width: 480px;">
    
    <div style="background: white; border: 1px solid var(--color-slate-200); border-radius: var(--radius-xl); padding: 40px 36px; box-shadow: var(--shadow-xl); text-align: center;">
      
      <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--color-primary-light); color: var(--color-primary); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; margin: 0 auto 20px auto;">
        <i class="bi bi-shield-lock-fill"></i>
      </div>

      <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--color-slate-900); margin-bottom: 8px;">
        Administrator Portal
      </h2>
      <p style="color: var(--color-slate-500); font-size: 0.92rem; margin-bottom: 28px;">
        Enter your administrative credentials to access the management dashboard.
      </p>

      <?php if (!empty($error)): ?>
        <div style="padding: 12px 16px; background-color: #fef2f2; border: 1px solid #fecaca; border-radius: var(--radius-md); color: #991b1b; font-size: 0.9rem; margin-bottom: 20px; text-align: left;">
          <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['logged_out'])): ?>
        <div style="padding: 12px 16px; background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: var(--radius-md); color: #166534; font-size: 0.9rem; margin-bottom: 20px; text-align: left;">
          <i class="bi bi-check-circle-fill me-2"></i> You have been safely logged out.
        </div>
      <?php endif; ?>

      <form action="login.php<?php echo ($safeRedirect !== 'edit_panel.php') ? '?redirect=' . urlencode($safeRedirect) : ''; ?>" method="POST" style="text-align: left;">
        <?php echo csrf_field(); ?>
        
        <div class="form-group-creed">
          <label class="form-label-creed" for="email">Admin Email or Username</label>
          <input type="text" id="email" name="email" class="form-control-creed" placeholder="admin@domain.com or username" value="<?php echo htmlspecialchars($submittedEmail, ENT_QUOTES, 'UTF-8'); ?>" required autocomplete="username">
        </div>

        <div class="form-group-creed">
          <label class="form-label-creed" for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control-creed" placeholder="••••••••" required autocomplete="current-password">
        </div>

        <button type="submit" name="login_user" class="btn-creed btn-creed-primary w-100" style="width: 100%; padding: 14px; margin-top: 10px;">
          <i class="bi bi-box-arrow-in-right me-2"></i> Access Dashboard
        </button>

      </form>

    </div>

  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>