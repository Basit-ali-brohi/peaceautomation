<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$allServices = data('services');
if (empty($allServices)) {
    $allServices = site('services');
}
$slug = isset($_GET['slug']) ? (string)$_GET['slug'] : (isset($_GET['s']) ? (string)$_GET['s'] : '');

$service = null;
foreach ($allServices as $s) {
    if ($s['slug'] === $slug) { $service = $s; break; }
}
if ($service === null) {
    $service = $allServices[0];
}

$pageTitle      = $service['title'] . ' | Peace Automation';
$bannerTitle    = $service['title'];
$eyebrowText    = 'Specialized Engineering Solution';
$bannerSubtitle = $service['short'] ?? $service['desc'] ?? 'Turnkey installation, system integration, and dedicated maintenance across Karachi.';
$bannerImage    = $service['image'];
$bannerPill     = 'ISO-Certified System';
$bannerBadgeNum = '100%';
$bannerBadgeLabel = 'Workmanship<br>Warranty';
$bannerCtaText  = 'Request This Service';
$bannerCtaHref  = 'contact.php?service=' . urlencode($service['title']);

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/page-hero.php';
?>

<main id="main">
<section class="section section--light svc-detail-sec">
  <div class="container">
    <div class="svc-detail-layout">

      <!-- Main Article Content -->
      <article class="svc-detail-main">
        <div class="svc-detail-hero-img">
          <?= img($service['image'], $service['title'], 1000, 560, ['eager' => true]) ?>
        </div>

        <div class="svc-detail-block">
          <h2>Engineering Overview</h2>
          <p><?= e($service['body'] ?? $service['desc'] ?? '') ?></p>
          <p>Every deployment begins with a certified site assessment. Our senior engineers inspect the facility structure, map camera line-of-sights, test cabling conduits, and configure recording schedules tailored to the real physical risk profile of the building — not a generic package.</p>
        </div>

        <?php if (!empty($service['checks'])): ?>
        <div class="svc-detail-block">
          <h2>What's Included in This Service</h2>
          <div class="svc-detail-checks">
            <?php foreach ($service['checks'] as $chk): ?>
            <div class="svc-chk-item">
              <span class="svc-chk-ico"><?= icon('check') ?></span>
              <span class="svc-chk-text"><?= e($chk) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Equipment Tier -->
        <div class="svc-detail-block">
          <h2>Tier-1 Equipment Brands We Deploy</h2>
          <p style="margin-bottom:16px;">We partner exclusively with certified international manufacturers to ensure hardware reliability, firmware updates, and local warranty fulfillment:</p>
          <div class="svc-brands-wrap">
            <span class="svc-brand-tag">Hikvision</span>
            <span class="svc-brand-tag">Dahua Technology</span>
            <span class="svc-brand-tag">ZKTeco</span>
            <span class="svc-brand-tag">Honeywell</span>
            <span class="svc-brand-tag">Simplex</span>
            <span class="svc-brand-tag">Bosch Security</span>
            <span class="svc-brand-tag">Seagate SkyHawk</span>
          </div>
        </div>

        <!-- FAQs -->
        <div class="svc-detail-block">
          <h2>Frequently Answered Questions</h2>
          <div class="svc-faq-list">
            <details class="svc-faq-item" open>
              <summary class="svc-faq-q">
                <span>Do you survey the site before quoting?</span>
                <span class="svc-faq-ico"><?= icon('plus') ?></span>
              </summary>
              <div class="svc-faq-a">
                <p>Always. A quote given over the phone without site inspection is merely a guess. Our senior systems engineer visits your facility, marks the camera positions and cable routes with you, and prices the actual scope accurately.</p>
              </div>
            </details>

            <details class="svc-faq-item">
              <summary class="svc-faq-q">
                <span>How long does a typical installation take?</span>
                <span class="svc-faq-ico"><?= icon('plus') ?></span>
              </summary>
              <div class="svc-faq-a">
                <p>A standard 4-to-8 camera commercial or residential deployment is completed within 1 to 2 business days. Large industrial facilities and multi-floor corporate offices are phased outside operating hours to avoid downtime.</p>
              </div>
            </details>

            <details class="svc-faq-item">
              <summary class="svc-faq-q">
                <span>What is covered under the warranty?</span>
                <span class="svc-faq-ico"><?= icon('plus') ?></span>
              </summary>
              <div class="svc-faq-a">
                <p>We provide full official manufacturer warranty on hardware (1 to 2 years depending on tier) plus our direct workmanship guarantee, including scheduled preventative maintenance visits.</p>
              </div>
            </details>
          </div>
        </div>

      </article>

      <!-- Sticky Sidebar -->
      <aside class="svc-detail-sidebar">
        
        <!-- Other Services List -->
        <div class="svc-sidebar-card">
          <h4>Explore Other Services</h4>
          <ul class="svc-nav-list">
            <?php foreach ($allServices as $other): ?>
              <?php if ($other['slug'] === $service['slug']) continue; ?>
              <li>
                <a href="service-detail.php?slug=<?= urlencode($other['slug']) ?>" class="svc-nav-item">
                  <span><?= e($other['title']) ?></span>
                  <span class="svc-nav-ico"><?= icon('arrow') ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Quick Inquiry Card -->
        <div class="svc-sidebar-card svc-sidebar-card--cta">
          <span class="eyebrow" style="color:var(--lime);">Free Site Survey</span>
          <h3>Ready to secure your premises?</h3>
          <p>Book an on-site survey with an engineer today. We inspect, map, and advise on optimal hardware for your exact floor plan.</p>
          <a href="contact.php?service=<?= urlencode($service['title']) ?>" class="btn btn--primary btn--hero-compact" style="width:100%; justify-content:center; margin-bottom:14px;">
            REQUEST A SURVEY <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
          <div class="svc-sidebar-phone">
            <span>Or call an engineer directly:</span>
            <a href="tel:<?= e(cfg('phone_href')) ?>"><?= e(cfg('phone')) ?></a>
          </div>
        </div>

      </aside>

    </div>
  </div>
</section>

<!-- ============ CTA STRIP ============ -->
<section class="svc-detail-cta">
  <div class="container">
    <div class="ind-cta-box">
      <div class="ind-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Turnkey Automation — <em>Karachi Wide</em></span>
        <h2>Have questions about <?= e($service['title']) ?>?</h2>
        <p>Talk directly with our project delivery engineers to review technical drawings and equipment specs.</p>
      </div>
      <div class="ind-cta-btn">
        <a href="contact.php?service=<?= urlencode($service['title']) ?>" class="btn btn--primary btn--hero-compact">
          SPEAK WITH AN ENGINEER <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
/* =========================================================
   SERVICE DETAIL STYLES
   ========================================================= */
.svc-detail-sec {
  padding: clamp(60px, 8vw, 100px) 0 60px;
  background: #fff;
}
.svc-detail-layout {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 56px;
  align-items: start;
}
.svc-detail-hero-img {
  border-radius: 24px;
  overflow: hidden;
  height: clamp(300px, 42vw, 480px);
  margin-bottom: 40px;
  box-shadow: 0 10px 30px rgba(4,13,36,0.06);
}
.svc-detail-hero-img img {
  width: 100%; height: 100%; object-fit: cover; display: block;
}
.svc-detail-block {
  margin-bottom: 48px;
}
.svc-detail-block h2 {
  font-size: clamp(1.6rem, 2.6vw, 2.2rem);
  font-weight: 800;
  color: var(--ink);
  margin: 0 0 16px;
  line-height: 1.25;
}
.svc-detail-block p {
  color: var(--body);
  font-size: 1rem;
  line-height: 1.75;
  margin: 0 0 16px;
}
.svc-detail-checks {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 14px 24px;
  margin-top: 18px;
}
.svc-chk-item {
  display: flex;
  align-items: center;
  gap: 12px;
  background: var(--light);
  border: 1px solid var(--line);
  padding: 12px 18px;
  border-radius: 12px;
}
.svc-chk-ico {
  width: 22px; height: 22px;
  border-radius: 50%;
  background: var(--blue-600);
  color: #fff;
  display: grid; place-items: center;
  flex-shrink: 0;
}
.svc-chk-ico .ico { width: 12px; height: 12px; }
.svc-chk-text {
  font-size: 0.92rem;
  font-weight: 600;
  color: var(--ink);
}

.svc-brands-wrap {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}
.svc-brand-tag {
  background: var(--light);
  border: 1.5px solid var(--line);
  padding: 8px 18px;
  border-radius: 999px;
  font-size: 0.85rem;
  font-weight: 700;
  color: var(--ink);
}

/* FAQs Accordion */
.svc-faq-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.svc-faq-item {
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 14px;
  overflow: hidden;
  transition: border-color 0.25s var(--ease);
}
.svc-faq-item[open] {
  border-color: var(--blue-600);
}
.svc-faq-q {
  padding: 18px 22px;
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--ink);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  list-style: none;
}
.svc-faq-q::-webkit-details-marker { display: none; }
.svc-faq-ico {
  width: 26px; height: 26px;
  border-radius: 50%;
  background: #fff;
  border: 1px solid var(--line);
  display: grid; place-items: center;
  transition: transform 0.25s var(--ease);
}
.svc-faq-ico .ico { width: 13px; height: 13px; }
.svc-faq-item[open] .svc-faq-ico {
  transform: rotate(45deg);
  background: var(--blue-600);
  color: #fff;
  border-color: var(--blue-600);
}
.svc-faq-a {
  padding: 0 22px 20px;
}
.svc-faq-a p {
  color: var(--body);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}

/* Sidebar */
.svc-detail-sidebar {
  position: sticky;
  top: 110px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.svc-sidebar-card {
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 20px;
  padding: 28px 24px;
}
.svc-sidebar-card h4 {
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--ink);
  margin: 0 0 16px;
}
.svc-nav-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.svc-nav-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 14px;
  border-radius: 10px;
  color: var(--body);
  font-size: 0.9rem;
  font-weight: 600;
  text-decoration: none;
  background: #fff;
  border: 1px solid var(--line);
  transition: all 0.25s var(--ease);
}
.svc-nav-ico {
  width: 24px; height: 24px;
  border-radius: 50%;
  background: var(--light);
  display: grid; place-items: center;
}
.svc-nav-ico .ico { width: 11px; height: 11px; }
.svc-nav-item:hover {
  background: var(--navy-900);
  color: #fff;
  border-color: var(--navy-900);
}
.svc-nav-item:hover .svc-nav-ico {
  background: var(--lime);
  color: var(--ink);
}

.svc-sidebar-card--cta {
  background: linear-gradient(145deg, var(--navy-900) 0%, var(--navy-800) 100%);
  color: #fff;
  border: none;
}
.svc-sidebar-card--cta h3 {
  color: #fff;
  font-size: 1.35rem;
  font-weight: 800;
  margin: 8px 0 12px;
}
.svc-sidebar-card--cta p {
  color: rgba(255,255,255,0.7);
  font-size: 0.9rem;
  line-height: 1.6;
  margin: 0 0 20px;
}
.svc-sidebar-phone {
  text-align: center;
}
.svc-sidebar-phone span {
  display: block;
  font-size: 0.78rem;
  color: rgba(255,255,255,0.6);
  margin-bottom: 4px;
}
.svc-sidebar-phone a {
  color: var(--lime);
  font-size: 1.05rem;
  font-weight: 700;
  text-decoration: none;
}

@media (max-width: 900px) {
  .svc-detail-layout { grid-template-columns: 1fr; }
  .svc-detail-checks { grid-template-columns: 1fr; }
}

.svc-detail-cta {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
