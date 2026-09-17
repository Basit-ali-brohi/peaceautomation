<?php
declare(strict_types=1);
// Guarded: product-detail.php includes this file when a slug is unknown,
// and a session is already running by then.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/includes/functions.php';

http_response_code(404);

$pageTitle       = 'Page Not Found — 404 | ' . cfg('name');
$metaDescription = 'That page could not be found.';

require_once __DIR__ . '/includes/header.php';
?>

<main id="main">
<section class="error-404-sec">
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>

  <div class="container" style="position:relative; z-index:2;">
    <div class="error-404-box">

      <!-- Offline Camera Visual -->
      <div class="error-cam-feed">
        <div class="error-cam-header">
          <span class="error-cam-dot"></span>
          <span class="error-cam-badge">FEED OFFLINE</span>
          <span class="error-cam-time">CAM 404 · NO SIGNAL</span>
        </div>
        <div class="error-cam-body">
          <div class="error-cam-icon"><?= icon('camera') ?></div>
          <span class="error-cam-title">Target Angle Unreachable</span>
        </div>
      </div>

      <span class="error-404-num">404</span>
      <h1 class="error-404-heading">This camera isn't covering that angle</h1>
      <p class="error-404-desc">
        The link you followed may be broken, or the page may have been relocated. Return to the homepage or connect directly with our engineering desk.
      </p>

      <div class="error-404-actions">
        <a href="index.php" class="btn btn--primary btn--hero-compact">
          BACK TO HOME <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
        <a href="contact.php" class="btn btn--ghost btn--hero-compact" style="color:#fff; border-color:rgba(255,255,255,0.3);">
          CONTACT SUPPORT <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>

    </div>
  </div>
</section>
</main>

<style>
.error-404-sec {
  background: var(--navy-900);
  min-height: 85vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 140px 0 100px;
  position: relative;
  overflow: hidden;
  text-align: center;
}
.error-404-box {
  max-width: 600px;
  margin: 0 auto;
}
.error-cam-feed {
  background: #0B0E20;
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 20px;
  max-width: 440px;
  margin: 0 auto 36px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}
.error-cam-header {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 18px;
  background: rgba(255,255,255,0.04);
  border-bottom: 1px solid rgba(255,255,255,0.08);
}
.error-cam-dot {
  width: 8px; height: 8px;
  border-radius: 50%;
  background: #EF4444;
  animation: blink 1.2s infinite;
}
@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.2; }
}
.error-cam-badge {
  font-size: 0.72rem;
  font-weight: 700;
  color: #EF4444;
  letter-spacing: 0.05em;
}
.error-cam-time {
  margin-left: auto;
  font-size: 0.72rem;
  font-weight: 600;
  color: rgba(255,255,255,0.5);
  font-family: monospace;
}
.error-cam-body {
  padding: 44px 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
}
.error-cam-icon {
  width: 54px; height: 54px;
  border-radius: 50%;
  background: rgba(255,255,255,0.06);
  color: rgba(255,255,255,0.4);
  display: grid; place-items: center;
}
.error-cam-icon .ico { width: 28px; height: 28px; }
.error-cam-title {
  color: rgba(255,255,255,0.6);
  font-size: 0.85rem;
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.error-404-num {
  display: inline-block;
  font-size: 4rem;
  font-weight: 800;
  color: var(--lime);
  line-height: 1;
  font-family: var(--font-head);
  margin-bottom: 10px;
}
.error-404-heading {
  color: #fff;
  font-size: clamp(1.8rem, 3.2vw, 2.4rem);
  font-weight: 800;
  margin: 0 0 16px;
  line-height: 1.25;
}
.error-404-desc {
  color: rgba(255,255,255,0.7);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0 0 32px;
}
.error-404-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 16px;
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
