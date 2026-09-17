<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle       = 'Installation Packages & Pricing | Peace Automation';
$eyebrowText     = 'Turnkey Solutions — All Inclusive';
$bannerTitle     = 'Security & Automation Packages';
$bannerSubtitle  = 'Fixed-scope turnkey packages including site survey, tier-1 hardware, concealed cabling, mobile app setup, and handover warranty.';
$bannerImage     = 'service-cctv.webp';
$bannerPill      = 'All-Inclusive Turnkey';
$bannerBadgeNum  = '100%';
$bannerBadgeLabel= 'Fixed-Scope<br>Pricing';
$bannerCtaText   = 'Explore Packages';
$bannerCtaHref   = '#packages';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/page-hero.php';
?>

<main>

<!-- ============ PRICING CARDS SECTION ============ -->
<section class="pkg-sec">
  <div class="container">
    <div class="pkg-sec-head">
      <span class="eyebrow">Fixed-Scope Tiers — <em>Transparent Pricing</em></span>
      <h2 class="anim-heading">Everything required to secure your premises, covered in one quote</h2>
      <p style="color:var(--body); max-width:620px; margin:0 auto; font-size:0.95rem; line-height:1.7;">
        Every package below includes equipment, professional cabling in conduits, system programming, and remote mobile viewing setup.
      </p>
    </div>

    <?php
      $packages = [
        [
          'name'     => 'Essential Small Shop / Home',
          'subtitle' => '4 Full HD Cameras + DVR System',
          'popular'  => false,
          'badge'    => '',
          'price'    => 'Custom Survey Quote',
          'includes' => [
            '4x 1080p High-Resolution Night Vision Cameras',
            '1x 4-Channel H.265+ Digital Video Recorder',
            '1TB Surveillance-Grade Hard Drive (15-Day Retention)',
            'Complete RG59 / Coaxial Cabling in PVC Conduits',
            'Centralized Regulated Power Supply Unit',
            'Smartphone Remote Viewing Setup on iOS & Android',
            '1-Year Official Hardware & Workmanship Warranty',
          ],
        ],
        [
          'name'     => 'Commercial Office & Retail',
          'subtitle' => '8 IP AI Cameras + 4K NVR System',
          'popular'  => true,
          'badge'    => 'Most Popular',
          'price'    => 'Custom Survey Quote',
          'includes' => [
            '8x 4MP / 2K IP Network Cameras (Human Detection AI)',
            '1x 8-Channel 4K Network Video Recorder (NVR)',
            '2TB WD Purple Surveillance Drive (25-Day Retention)',
            'Cat6 Gigabit Structured Network Cabling & Conduits',
            '8-Port 100W PoE Managed Network Switch',
            'Multi-User Smartphone & Desktop Client Configuration',
            '1-Year Direct On-Site Warranty + 2 Free Tune-Ups',
          ],
        ],
        [
          'name'     => 'Industrial Enterprise & Facility',
          'subtitle' => '16+ IP Cameras + Central Storage',
          'popular'  => false,
          'badge'    => 'Enterprise',
          'price'    => 'Custom Survey Quote',
          'includes' => [
            '16x 4K Ultra-HD Cameras (Bullet, Dome & PTZ options)',
            '1x 16-Channel RAID-Ready Enterprise 4K NVR',
            '4TB+ High-Endurance Surveillance Storage Array',
            'Industrial Shielded Cabling & Cable Tray Infrastructure',
            'Dual Managed PoE Gigabit Switches + Online UPS Battery',
            'Control Room Video Wall Output & Central Monitoring',
            '2-Year Enterprise SLA Warranty with Priority Dispatch',
          ],
        ],
      ];
    ?>

    <div class="pkg-grid">
      <?php foreach ($packages as $pkg): ?>
      <div class="pkg-card<?= $pkg['popular'] ? ' pkg-card--popular' : '' ?>">
        <?php if (!empty($pkg['badge'])): ?>
          <span class="pkg-card-badge"><?= e($pkg['badge']) ?></span>
        <?php endif; ?>
        
        <h3 class="pkg-card-name"><?= e($pkg['name']) ?></h3>
        <p class="pkg-card-sub"><?= e($pkg['subtitle']) ?></p>
        
        <div class="pkg-card-price">
          <span class="pkg-price-label">Transparent Pricing</span>
          <span class="pkg-price-val"><?= e($pkg['price']) ?></span>
        </div>

        <ul class="pkg-card-checks">
          <?php foreach ($pkg['includes'] as $inc): ?>
          <li>
            <span class="pkg-chk-ico"><?= icon('check') ?></span>
            <span><?= e($inc) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>

        <div class="pkg-card-foot">
          <a href="contact.php?package=<?= urlencode($pkg['name']) ?>" class="btn <?= $pkg['popular'] ? 'btn--primary' : 'btn--ghost' ?> btn--hero-compact" style="width:100%; justify-content:center;">
            GET PACKAGE QUOTE <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============ COMPARISON TABLE ============ -->
<section class="pkg-comp-sec">
  <div class="container">
    <div class="pkg-comp-head">
      <span class="eyebrow" style="color:var(--lime);">Feature Breakdown — <em>Side by Side</em></span>
      <h2>Compare package capabilities in detail</h2>
    </div>

    <div class="pkg-table-wrap">
      <table class="pkg-table">
        <thead>
          <tr>
            <th scope="col">Feature Specification</th>
            <th scope="col">Essential (4-Cam)</th>
            <th scope="col" style="color:var(--lime);">Commercial (8-Cam)</th>
            <th scope="col">Industrial (16+ Cam)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Camera Resolution</th>
            <td>1080p Full HD</td>
            <td>4MP / 2K Ultra</td>
            <td>4K Ultra-HD (8MP)</td>
          </tr>
          <tr>
            <th>AI Motion &amp; Human Filter</th>
            <td>Standard Motion</td>
            <td>Deep Learning AI</td>
            <td>Advanced Face/Vehicle AI</td>
          </tr>
          <tr>
            <th>Night Vision Range</th>
            <td>20–30 Meters IR</td>
            <td>30–50 Meters Smart IR</td>
            <td>60–100 Meters Laser/IR</td>
          </tr>
          <tr>
            <th>Network Topology</th>
            <td>Coaxial / Power Box</td>
            <td>PoE Cat6 Gigabit</td>
            <td>PoE Switch + Fiber Backbone</td>
          </tr>
          <tr>
            <th>Storage Drive</th>
            <td>1TB WD Purple</td>
            <td>2TB WD Purple</td>
            <td>4TB+ RAID Surveillance Array</td>
          </tr>
          <tr>
            <th>Mobile App Remote Access</th>
            <td>Included</td>
            <td>Included</td>
            <td>Included + PC Client Software</td>
          </tr>
          <tr>
            <th>On-Site Warranty &amp; SLA</th>
            <td>1 Year</td>
            <td>1 Year + 2 Tune-ups</td>
            <td>2 Years Enterprise Priority</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ CTA STRIP ============ -->
<section class="pkg-cta-sec">
  <div class="container">
    <div class="ind-cta-box">
      <div class="ind-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Custom Architectural Specifications</span>
        <h2>Need a hybrid solution for multiple branches?</h2>
        <p>We design custom engineering blueprints combining biometric turnstiles, fire loops, and camera arrays across multi-facility networks.</p>
      </div>
      <div class="ind-cta-btn">
        <a href="contact.php" class="btn btn--primary btn--hero-compact">
          REQUEST CUSTOM ESTIMATE <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
/* =========================================================
   PACKAGES PAGE STYLES
   ========================================================= */
.pkg-sec {
  padding: clamp(70px, 9vw, 120px) 0 60px;
  background: #fff;
}
.pkg-sec-head {
  text-align: center;
  margin-bottom: 60px;
}
.pkg-sec-head h2 {
  font-size: clamp(2.2rem, 3.8vw, 3.2rem) !important;
  font-weight: 800 !important;
  color: var(--ink) !important;
  line-height: 1.18 !important;
  margin: 14px auto 16px;
  max-width: 24ch;
}
.pkg-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
  align-items: stretch;
}
.pkg-card {
  background: #fff;
  border: 1.5px solid var(--line);
  border-radius: 24px;
  padding: 40px 32px;
  display: flex;
  flex-direction: column;
  position: relative;
  box-shadow: 0 4px 20px rgba(4,13,36,0.03);
  transition: transform 0.3s var(--ease), box-shadow 0.3s var(--ease);
}
.pkg-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 40px rgba(4,13,36,0.08);
}
.pkg-card--popular {
  border-color: var(--blue-600);
  box-shadow: 0 10px 30px rgba(26,86,219,0.12);
  background: #FCFDFF;
}
.pkg-card-badge {
  position: absolute;
  top: -14px;
  left: 32px;
  background: var(--blue-600);
  color: #fff;
  font-size: 0.74rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding: 4px 14px;
  border-radius: 999px;
}
.pkg-card-name {
  font-size: 1.35rem;
  font-weight: 800;
  color: var(--ink);
  margin: 0 0 6px;
}
.pkg-card-sub {
  font-size: 0.88rem;
  color: var(--body);
  margin: 0 0 24px;
}
.pkg-card-price {
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 14px;
  padding: 16px 20px;
  margin-bottom: 28px;
}
.pkg-price-label {
  display: block;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--body);
  font-weight: 600;
}
.pkg-price-val {
  font-size: 1.3rem;
  font-weight: 800;
  color: var(--ink);
  font-family: var(--font-head);
}
.pkg-card-checks {
  list-style: none;
  padding: 0;
  margin: 0 0 32px;
  display: flex;
  flex-direction: column;
  gap: 14px;
  flex-grow: 1;
}
.pkg-card-checks li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 0.88rem;
  line-height: 1.5;
  color: var(--ink);
}
.pkg-chk-ico {
  width: 18px; height: 18px;
  border-radius: 50%;
  background: rgba(26,86,219,0.1);
  color: var(--blue-600);
  display: grid; place-items: center;
  flex-shrink: 0;
  margin-top: 2px;
}
.pkg-chk-ico .ico { width: 11px; height: 11px; }
.pkg-card-foot {
  margin-top: auto;
}

@media (max-width: 1024px) {
  .pkg-grid { grid-template-columns: 1fr; }
}

/* =========================================================
   COMPARISON TABLE STYLES
   ========================================================= */
.pkg-comp-sec {
  padding: 60px 0 clamp(80px, 9vw, 120px);
  background: var(--navy-900);
  color: #fff;
}
.pkg-comp-head {
  text-align: center;
  margin-bottom: 50px;
}
.pkg-comp-head h2 {
  color: #fff;
  font-size: clamp(2rem, 3.4vw, 2.8rem);
  font-weight: 800;
  margin: 12px 0 0;
}
.pkg-table-wrap {
  overflow-x: auto;
  border-radius: 20px;
  border: 1px solid rgba(255,255,255,0.12);
  background: rgba(255,255,255,0.03);
}
.pkg-table {
  width: 100%;
  min-width: 700px;
  border-collapse: collapse;
  text-align: left;
}
.pkg-table th, .pkg-table td {
  padding: 18px 24px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
  font-size: 0.9rem;
}
.pkg-table thead th {
  background: rgba(255,255,255,0.06);
  font-size: 1rem;
  font-weight: 700;
  color: #fff;
}
.pkg-table tbody th {
  color: rgba(255,255,255,0.9);
  font-weight: 600;
}
.pkg-table tbody td {
  color: rgba(255,255,255,0.72);
}

/* On a phone the table scrolls sideways inside its card — keep the
   columns narrow enough that two of them are visible at once. */
@media (max-width: 720px) {
  .pkg-table { min-width: 560px; }
  .pkg-table th, .pkg-table td { padding: 14px 16px; font-size: 0.84rem; }
  .pkg-table thead th { font-size: 0.9rem; }
}

.pkg-cta-sec {
  padding: clamp(60px, 8vw, 100px) 0;
  background: #fff;
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
