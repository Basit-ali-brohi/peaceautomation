<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle       = 'Frequently Asked Questions | Peace Automation';
$eyebrowText     = 'Clear Answers — Transparent Advice';
$bannerTitle     = 'Frequently Asked Questions';
$bannerSubtitle  = 'Practical answers to common questions about camera selection, storage retention, fire safety compliance, and installation timelines.';
$bannerImage     = 'hero-camera.webp';
$bannerPill      = 'Engineer-Led Guidance';
$bannerBadgeNum  = '24/7';
$bannerBadgeLabel= 'Technical<br>Support';
$bannerCtaText   = 'Ask an Engineer';
$bannerCtaHref   = 'contact.php';

$faqGroups = [
    'System Selection & Planning' => [
        ['q' => 'How many cameras does my building actually need?',        'a' => 'Fewer than most people expect. Main entrances, cash registers/safes, loading bays, and blind corners usually provide comprehensive coverage. During our free on-site survey, our engineer walks the premises with you to identify high-risk choke points rather than selling unnecessary hardware counts.'],
        ['q' => 'Should I install Analog (HD-TVI) or IP Cameras?',          'a' => 'Analog HD is economical and works well for small retail shops and residential homes. IP cameras deliver higher resolutions (4K), advanced AI human/vehicle classification, PoE single-cable runs, and seamless scalability — highly recommended for multi-floor corporate offices, factories, and warehouses.'],
        ['q' => 'What resolution is ideal for commercial surveillance?',    'a' => '2MP (1080p) is suitable for general interior hallway monitoring. 4MP to 8MP (4K) is recommended for perimeter boundaries, cashier counters, and vehicle entry points where recognizing facial details or reading license plates is critical.'],
    ],
    'Installation & Cable Management' => [
        ['q' => 'How long does a standard installation take?',              'a' => 'A 4-to-8 camera residential or retail job is completed in 1 to 2 business days. Large-scale corporate or industrial installations are phased outside active business hours to minimize operational disruption.'],
        ['q' => 'Will cabling and conduits be visible?',                    'a' => 'No. All cables are routed inside matching PVC conduits, cable trays, or false ceiling cavities, labeled at both ends. If an exposed run is unavoidable, we review and agree upon the exact path with you prior to drilling.'],
        ['q' => 'Do you carry out work over weekends or after hours?',      'a' => 'Yes. For factories, commercial banks, and corporate offices, our installation teams routinely operate on weekends or night shifts to keep work completely transparent to your employees and customers.'],
    ],
    'Recording, Storage & Mobile Viewing' => [
        ['q' => 'How many days of video footage will be retained?',        'a' => 'Retention depends on hard drive capacity, camera count, resolution, and recording schedules. We calculate hard drive sizes specifically for your requested retention window (typically 15 to 30 days) and verify actual usage using H.265+ smart compression.'],
        ['q' => 'Can I watch live and recorded cameras on my smartphone?',  'a' => 'Yes. We install the official client app on your iOS and Android devices, set up secure cloud P2P remote access, and verify live streaming on your mobile cellular data network before signing off handover.'],
        ['q' => 'Does the security system keep recording during load-shedding?', 'a' => 'Yes, when connected to an online UPS. We can size and supply a dedicated uninterrupted power supply system that keeps your cameras, NVR, and network switches active through typical outage intervals.'],
    ],
    'Maintenance & Warranty' => [
        ['q' => 'What does your system warranty include?',                 'a' => 'All hardware includes official 1-to-2 year manufacturer warranty. Peace Automation backs this up with our direct installation workmanship warranty, including free on-site service visits during the initial warranty window.'],
        ['q' => 'How quickly do you respond to urgent service calls in Karachi?', 'a' => 'Emergency fault calls logged before 12:00 PM are attended the same business day across Karachi. Annual Maintenance Contract (AMC) clients receive dedicated SLA priority dispatch.'],
        ['q' => 'Can you take over and maintain an existing third-party system?', 'a' => 'Yes. Our engineers can perform a complete technical audit of your existing camera cabling, power supplies, and recorders, rectifying loose connections and repairing only what is broken.'],
    ],
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/page-hero.php';
?>

<main>

<section class="faqs-sec">
  <div class="container">
    <div class="faqs-layout">

      <!-- Sidebar -->
      <aside class="faqs-sidebar">
        <div class="faqs-nav-card">
          <h4>Jump to Category</h4>
          <ul class="faqs-nav-list">
            <?php foreach (array_keys($faqGroups) as $g): ?>
            <li>
              <a href="#<?= e(strtolower(str_replace([' ', '&'], ['-', ''], $g))) ?>" class="faqs-nav-link">
                <span><?= e($g) ?></span>
                <span class="faqs-nav-arrow"><?= icon('arrow') ?></span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="faqs-survey-card">
          <span class="eyebrow" style="color:var(--lime);">Free Consultation</span>
          <h3>Still have an unanswered question?</h3>
          <p>Book a free technical site survey. An engineer visits your building, reviews sightlines, and answers questions on the spot.</p>
          <a href="contact.php" class="btn btn--primary btn--hero-compact" style="width:100%; justify-content:center;">
            BOOK A FREE SURVEY <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
        </div>
      </aside>

      <!-- FAQ Groups -->
      <div class="faqs-content">
        <?php foreach ($faqGroups as $group => $items): ?>
        <div class="faqs-group-block" id="<?= e(strtolower(str_replace([' ', '&'], ['-', ''], $group))) ?>">
          <h2 class="faqs-group-title"><?= e($group) ?></h2>
          <div class="faqs-items-list">
            <?php foreach ($items as $i => $f): ?>
            <details class="faqs-item"<?= $i === 0 ? ' open' : '' ?>>
              <summary class="faqs-q">
                <span><?= e($f['q']) ?></span>
                <span class="faqs-ico"><?= icon('plus') ?></span>
              </summary>
              <div class="faqs-a">
                <p><?= e($f['a']) ?></p>
              </div>
            </details>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ============ CTA STRIP (Seonex Style) ============ -->
<section class="faqs-cta-sec">
  <div class="container">
    <div class="ind-cta-box">
      <div class="ind-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Engineering Support — <em>Karachi Desk</em></span>
        <h2>Need immediate technical advice for an ongoing project?</h2>
        <p>Call our central engineering office directly. You will speak with a certified systems technician, not an outsourced call center agent.</p>
      </div>
      <div class="ind-cta-btn">
        <a href="tel:<?= e(cfg('phone_href')) ?>" class="btn btn--primary btn--hero-compact">
          CALL AN ENGINEER <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
/* =========================================================
   FAQS PAGE STYLES
   ========================================================= */
.faqs-sec {
  padding: clamp(70px, 9vw, 120px) 0 60px;
  background: #fff;
}
.faqs-layout {
  display: grid;
  grid-template-columns: 320px 1fr;
  gap: 56px;
  align-items: start;
}
.faqs-sidebar {
  position: sticky;
  top: 110px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.faqs-nav-card {
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 20px;
  padding: 28px 24px;
}
.faqs-nav-card h4 {
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--ink);
  margin: 0 0 16px;
}
.faqs-nav-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.faqs-nav-link {
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
.faqs-nav-arrow {
  width: 24px; height: 24px;
  border-radius: 50%;
  background: var(--light);
  display: grid; place-items: center;
}
.faqs-nav-arrow .ico { width: 11px; height: 11px; }
.faqs-nav-link:hover {
  background: var(--navy-900);
  color: #fff;
  border-color: var(--navy-900);
}
.faqs-nav-link:hover .faqs-nav-arrow {
  background: var(--lime);
  color: var(--ink);
}

.faqs-survey-card {
  background: linear-gradient(145deg, var(--navy-900) 0%, var(--navy-800) 100%);
  color: #fff;
  border-radius: 20px;
  padding: 30px 24px;
}
.faqs-survey-card h3 {
  color: #fff;
  font-size: 1.35rem;
  font-weight: 800;
  margin: 8px 0 12px;
}
.faqs-survey-card p {
  color: rgba(255,255,255,0.7);
  font-size: 0.9rem;
  line-height: 1.6;
  margin: 0 0 20px;
}

.faqs-content {
  display: flex;
  flex-direction: column;
  gap: 50px;
}
.faqs-group-block {
  scroll-margin-top: 120px;
}
.faqs-group-title {
  font-size: clamp(1.5rem, 2.4vw, 1.9rem);
  font-weight: 800;
  color: var(--ink);
  margin: 0 0 20px;
  letter-spacing: -0.01em;
}
.faqs-items-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.faqs-item {
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 14px;
  overflow: hidden;
  transition: border-color 0.25s var(--ease);
}
.faqs-item[open] {
  border-color: var(--blue-600);
}
.faqs-q {
  padding: 20px 24px;
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--ink);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  list-style: none;
}
.faqs-q::-webkit-details-marker { display: none; }
.faqs-ico {
  width: 28px; height: 28px;
  border-radius: 50%;
  background: #fff;
  border: 1px solid var(--line);
  display: grid; place-items: center;
  transition: transform 0.25s var(--ease);
  flex-shrink: 0;
}
.faqs-ico .ico { width: 13px; height: 13px; }
.faqs-item[open] .faqs-ico {
  transform: rotate(45deg);
  background: var(--blue-600);
  color: #fff;
  border-color: var(--blue-600);
}
.faqs-a {
  padding: 0 24px 22px;
}
.faqs-a p {
  color: var(--body);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 992px) {
  .faqs-layout { grid-template-columns: 1fr; }
  .faqs-sidebar { position: static; }
}

.faqs-cta-sec {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
