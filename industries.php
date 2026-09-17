<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle      = 'Industries We Serve | Peace Automation';
$bannerTitle    = 'Industries We Serve';
$bannerSubtitle = 'Tailored security, surveillance, and automated control systems engineered to match the regulatory and operational risks of your sector.';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ============ INDUSTRIES HERO (Seonex Style) ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Specialized Sectors — <em>Proven Expertise</em></span>
      <h1>Engineered For<br>Your Industry’s<br>Unique Risks</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>Industries</span>
      </nav>
      <a href="contact.php" class="btn btn--primary" style="margin-top:32px">
        Request Sector Audit <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('industry-office.webp', 'Corporate and industrial facilities security Karachi', 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">97%</span><span class="l">Client<br>Retention</span></div>
      <div class="svc-hero__pill"><?= icon('shield') ?><span>9+ Key Sectors Covered</span></div>
    </div>
  </div>
</section>

<main>

<!-- ============ INDUSTRIES GRID SECTION ============ -->
<section class="ind-sec">
  <div class="container">
    <div class="ind-sec-head">
      <span class="eyebrow">Tailored Implementations — <em>Sector by Sector</em></span>
      <h2 class="anim-heading">Comprehensive protection designed for your operational workflow</h2>
    </div>

    <?php
      $industries = [
        [
          'img'   => 'industry-bank.webp',
          'title' => 'Banking & Financial',
          'desc'  => 'Vault-grade biometric access control, 24/7 ATM surveillance, ultra-HD teller cameras, and silent alarm arrays integrated with local police dispatch.',
          'tags'  => ['Vault Security', 'Cash Counter HD', 'Silent Alarms'],
        ],
        [
          'img'   => 'industry-office.webp',
          'title' => 'Corporate Offices',
          'desc'  => 'Multi-floor touchless facial recognition, visitor badge logging, turnstile gates, and cloud-synced time & attendance for modern workplaces.',
          'tags'  => ['Face Recognition', 'Turnstiles', 'Time Attendance'],
        ],
        [
          'img'   => 'industry-education.webp',
          'title' => 'Educational Institutes',
          'desc'  => 'Campus-wide PTZ surveillance, perimeter tripwire alarms, automated student entry logs, and integrated emergency public address systems.',
          'tags'  => ['Perimeter Defense', 'Campus CCTV', 'Emergency PA'],
        ],
        [
          'img'   => 'industry-factory.webp',
          'title' => 'Factories & Manufacturing',
          'desc'  => 'Heavy-duty explosion-proof CCTV, thermal temperature checks, forklift path monitoring, and automated safety barrier controls.',
          'tags'  => ['Explosion Proof', 'Thermal Cameras', 'Barrier Control'],
        ],
        [
          'img'   => 'industry-government.webp',
          'title' => 'Government & Municipal',
          'desc'  => 'High-security multi-tier access permissions, automatic number-plate recognition (ANPR), and secure control-room video walls.',
          'tags'  => ['ANPR Recognition', 'Restricted Access', 'Control Rooms'],
        ],
        [
          'img'   => 'industry-hospital.webp',
          'title' => 'Healthcare & Hospitals',
          'desc'  => 'Restricted pharmacy access, ICU infant protection systems, touchless door automation, and fire suppression compliance for patient safety.',
          'tags'  => ['Cleanroom Access', 'Touchless Doors', 'Fire Suppression'],
        ],
        [
          'img'   => 'industry-mall.webp',
          'title' => 'Retail & Shopping Malls',
          'desc'  => 'Loss-prevention 360° dome coverage, AI footfall count analytics, parking barrier automation, and fast emergency egress management.',
          'tags'  => ['AI Footfall Count', '360° Domes', 'Smart Parking'],
        ],
        [
          'img'   => 'industry-residential.webp',
          'title' => 'Gated Communities & Residential',
          'desc'  => 'RFID gate barriers, intercom video doorbells, perimeter solar surveillance beams, and digital visitor registration for resident peace of mind.',
          'tags'  => ['RFID Gate Boom', 'Video Intercoms', 'Solar Perimeter'],
        ],
        [
          'img'   => 'industry-warehouse.webp',
          'title' => 'Warehousing & Logistics',
          'desc'  => 'Long-corridor high-rack surveillance, loading dock access, 24/7 movement recording, and sprinkler pressure monitoring systems.',
          'tags'  => ['High-Rack Cam', 'Dock Monitoring', 'Sprinkler Alerts'],
        ],
      ];
    ?>

    <div class="ind-grid">
      <?php foreach ($industries as $i => $item): ?>
      <div class="ind-card">
        <div class="ind-img-box">
          <?= img($item['img'], $item['title'], 600, 420) ?>
          <span class="ind-num">0<?= $i + 1 ?></span>
        </div>
        <div class="ind-card-body">
          <div class="ind-tags">
            <?php foreach ($item['tags'] as $tag): ?>
              <span class="ind-tag"><?= e($tag) ?></span>
            <?php endforeach; ?>
          </div>
          <h3 class="ind-title"><?= e($item['title']) ?></h3>
          <p class="ind-desc"><?= e($item['desc']) ?></p>
          <a href="contact.php?sector=<?= urlencode($item['title']) ?>" class="ind-link">
            <span>Request Sector Assessment</span>
            <span class="ind-link-ico"><?= icon('arrow') ?></span>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============ CTA STRIP (Seonex Style) ============ -->
<section class="ind-cta-sec">
  <div class="container">
    <div class="ind-cta-box">
      <div class="ind-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Custom Engineering — <em>Free On-Site Survey</em></span>
        <h2>Need a specialized system for your specific facility?</h2>
        <p>Our senior system engineers conduct on-site risk audits across Karachi to map camera angles, access choke-points, and emergency egress routes before quoting.</p>
      </div>
      <div class="ind-cta-btn">
        <a href="contact.php" class="btn btn--primary btn--hero-compact">
          BOOK A SITE SURVEY <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
/* =========================================================
   INDUSTRIES PAGE — HERO
   ========================================================= */
.ind-hero {
  background: var(--navy-900);
  position: relative;
  overflow: hidden;
  padding: 110px 0 70px;
}
.ind-hero-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 50px;
  align-items: center;
}
.ind-hero-text h1 {
  color: #fff;
  font-size: clamp(2.4rem, 4.8vw, 3.8rem);
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -0.03em;
  margin: 0 0 20px;
}
.ind-hero-text .breadcrumb {
  color: rgba(255,255,255,0.6);
  font-size: 0.95rem;
}
.ind-hero-text .breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; }
.ind-hero-text .breadcrumb a:hover { color: #fff; }
.ind-hero-text .breadcrumb span { margin: 0 8px; }
.ind-hero-text .breadcrumb .active { color: var(--lime); font-style: italic; text-decoration: underline; text-underline-offset: 4px; }

.ind-hero-badge-box {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 20px;
  padding: 32px 30px;
  backdrop-filter: blur(10px);
}
.ind-stat-pill {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
}
.ind-stat-num {
  font-size: 2.8rem;
  font-weight: 800;
  color: var(--lime);
  line-height: 1;
  font-family: var(--font-head);
}
.ind-stat-text {
  font-size: 0.95rem;
  color: #fff;
  font-weight: 600;
  line-height: 1.3;
}
.ind-hero-lead {
  color: rgba(255,255,255,0.7);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 900px) {
  .ind-hero-grid { grid-template-columns: 1fr; gap: 30px; }
}

/* =========================================================
   INDUSTRIES PAGE — GRID
   ========================================================= */
.ind-sec {
  padding: clamp(80px, 9vw, 130px) 0;
  background: #fff;
}
.ind-sec-head {
  text-align: center;
  margin-bottom: 60px;
}
.ind-sec-head h2 {
  font-size: clamp(2.2rem, 3.8vw, 3.2rem) !important;
  font-weight: 800 !important;
  color: var(--ink) !important;
  line-height: 1.18 !important;
  margin: 16px auto 0;
  max-width: 24ch;
}
.ind-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}
.ind-card {
  background: #fff;
  border: 1px solid var(--line);
  border-radius: 20px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 20px rgba(4,13,36,0.04);
  transition: transform 0.35s var(--ease), box-shadow 0.35s var(--ease), border-color 0.35s var(--ease);
}
.ind-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 16px 40px rgba(4,13,36,0.1);
  border-color: rgba(26,86,219,0.3);
}
.ind-img-box {
  position: relative;
  height: 220px;
  overflow: hidden;
}
.ind-img-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.6s var(--ease);
}
.ind-card:hover .ind-img-box img {
  transform: scale(1.08);
}
.ind-num {
  position: absolute;
  top: 14px;
  right: 14px;
  background: rgba(4,13,36,0.75);
  backdrop-filter: blur(8px);
  color: var(--lime);
  font-size: 0.8rem;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.15);
}
.ind-card-body {
  padding: 28px 26px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.ind-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 14px;
}
.ind-tag {
  font-size: 0.72rem;
  font-weight: 600;
  color: var(--body);
  background: var(--light);
  border: 1px solid var(--line);
  padding: 3px 10px;
  border-radius: 999px;
}
.ind-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--ink);
  line-height: 1.3;
  margin: 0 0 12px;
}
.ind-desc {
  font-size: 0.88rem;
  line-height: 1.65;
  color: var(--body);
  margin: 0 0 24px;
  flex-grow: 1;
}
.ind-link {
  display: inline-flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding-top: 16px;
  border-top: 1px solid var(--line);
  color: var(--ink);
  font-size: 0.82rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  text-decoration: none;
  transition: color 0.25s var(--ease);
}
.ind-link-ico {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--light);
  border: 1px solid var(--line);
  display: grid;
  place-items: center;
  transition: background 0.25s var(--ease), color 0.25s var(--ease), transform 0.25s var(--ease);
}
.ind-link-ico .ico { width: 13px; height: 13px; }
.ind-card:hover .ind-link {
  color: var(--blue-600);
}
.ind-card:hover .ind-link-ico {
  background: var(--blue-600);
  color: #fff;
  border-color: var(--blue-600);
  transform: rotate(45deg);
}

@media (max-width: 1024px) {
  .ind-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
  .ind-grid { grid-template-columns: 1fr; }
}

/* =========================================================
   INDUSTRIES PAGE — CTA
   ========================================================= */
.ind-cta-sec {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
.ind-cta-box {
  background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-800) 100%);
  border-radius: 28px;
  padding: clamp(40px, 6vw, 64px);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 20px 50px rgba(4,13,36,0.18);
}
.ind-cta-box::before {
  content: "";
  position: absolute;
  top: -80px; right: -80px;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(0, 210, 255, 0.25) 0%, transparent 70%);
  pointer-events: none;
}
.ind-cta-text {
  max-width: 650px;
  position: relative;
  z-index: 2;
}
.ind-cta-text h2 {
  color: #fff;
  font-size: clamp(1.8rem, 3.2vw, 2.6rem);
  font-weight: 800;
  line-height: 1.2;
  margin: 10px 0 14px;
}
.ind-cta-text p {
  color: rgba(255,255,255,0.72);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}
.ind-cta-btn {
  position: relative;
  z-index: 2;
  flex-shrink: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);

  // Stagger heading words
  var head = document.querySelector('.ind-sec-head h2');
  if (head && !head.querySelector('.ab-word')) {
    var words = head.innerText.split(' ');
    head.innerHTML = '';
    words.forEach(function(w) {
      var s = document.createElement('span');
      s.className = 'ab-word';
      s.innerText = w + ' ';
      head.appendChild(s);
    });
    gsap.fromTo(head.querySelectorAll('.ab-word'),
      { y: 35, opacity: 0 },
      {
        y: 0, opacity: 1, stagger: 0.03, duration: 0.75, ease: 'power3.out',
        scrollTrigger: { trigger: head, start: 'top 85%' }
      }
    );
  }

  // Stagger cards up
  var cards = document.querySelectorAll('.ind-card');
  if (cards.length) {
    gsap.fromTo(cards,
      { y: 50, opacity: 0 },
      {
        y: 0, opacity: 1, stagger: 0.08, duration: 0.75, ease: 'power3.out',
        scrollTrigger: { trigger: '.ind-grid', start: 'top 85%' }
      }
    );
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
