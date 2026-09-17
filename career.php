<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle      = 'Careers & Opportunities | Peace Automation';
$bannerTitle    = 'Join Our Team';
$bannerSubtitle = 'Work alongside experienced system engineers delivering mission-critical security and automation deployments.';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ============ CAREER HERO (Seonex Style) ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Engineering Careers — <em>Grow With Us</em></span>
      <h1>Build Your Career<br>In Mission-Critical<br>Security</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>Careers</span>
      </nav>
      <a href="#jobs" class="btn btn--primary" style="margin-top:32px">
        View Vacancies <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('app-in-hand.webp', 'Field engineer managing automation system on mobile application', 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">#1</span><span class="l">Engineering<br>Team in Karachi</span></div>
      <div class="svc-hero__pill"><?= icon('shield') ?><span>OEM Certified Training</span></div>
    </div>
  </div>
</section>

<main>

<!-- ============ WHY WORK WITH US ============ -->
<section class="car-why-sec">
  <div class="container">
    <div class="car-sec-head">
      <span class="eyebrow">Our Workplace Culture — <em>Engineered for Growth</em></span>
      <h2 class="anim-heading">Why top engineers and technicians choose Peace Automation</h2>
    </div>

    <div class="car-perks-grid">
      <div class="car-perk-card">
        <div class="car-perk-icon"><?= icon('shield') ?></div>
        <h3>High-Impact Projects</h3>
        <p>Work on high-security refineries, defense infrastructure, university campuses, and commercial towers — not just standard small-scale jobs.</p>
      </div>
      <div class="car-perk-card">
        <div class="car-perk-icon"><?= icon('cpu') ?></div>
        <h3>Direct OEM Training</h3>
        <p>Get certified directly with Hikvision, Dahua, ZKTeco, and Honeywell with fully company-sponsored technical development programs.</p>
      </div>
      <div class="car-perk-card">
        <div class="car-perk-icon"><?= icon('clock') ?></div>
        <h3>Competitive Package</h3>
        <p>Industry-leading salaries, reliable project completion bonuses, company transport support, and clear pathways to team lead roles.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ OPEN POSITIONS ============ -->
<section class="car-jobs-sec">
  <div class="container">
    <div class="car-jobs-head">
      <span class="eyebrow">Current Vacancies — <em>Join Our Karachi Office</em></span>
      <h2>Open engineering &amp; technical positions</h2>
    </div>

    <?php
      $jobs = [
        [
          'title'      => 'Senior CCTV & Surveillance Engineer',
          'dept'       => 'Surveillance Systems',
          'type'       => 'Full-Time · On-Site',
          'location'   => 'Karachi, Pakistan',
          'exp'        => '3+ Years Experience',
          'desc'       => 'Lead installation, cabling, network configuration, and NVR/VMS setup for corporate, industrial, and defense client sites.',
          'skills'     => ['IP / HD-TVI Camera Setup', 'NVR & RAID Storage', 'Network Switch Topology', 'Client Handover Documentation'],
        ],
        [
          'title'      => 'Access Control & Biometrics Specialist',
          'dept'       => 'Automation & Control',
          'type'       => 'Full-Time · On-Site',
          'location'   => 'Karachi, Pakistan',
          'exp'        => '2+ Years Experience',
          'desc'       => 'Commission facial recognition terminals, flap turnstiles, magnetic locks, and integrate time & attendance databases with client HR software.',
          'skills'     => ['ZKTeco & Hikvision Access', 'Wiegand / OSDP Protocols', 'Magnetic Lock Wiring', 'Database Sync'],
        ],
        [
          'title'      => 'Fire Alarm & Life Safety Technician',
          'dept'       => 'Fire Safety Division',
          'type'       => 'Full-Time · On-Site',
          'location'   => 'Karachi, Pakistan',
          'exp'        => '2+ Years Experience',
          'desc'       => 'Execute addressable and conventional fire alarm loop wiring, detector programming, sounder testing, and official commissioning reports.',
          'skills'     => ['Addressable Panels', 'Smoke / Heat Detectors', 'Loop Diagnostic Testing', 'Civil Defense Codes'],
        ],
        [
          'title'      => 'Client Solutions & Technical Sales Executive',
          'dept'       => 'Client Relations',
          'type'       => 'Full-Time · Hybrid',
          'location'   => 'Karachi, Pakistan',
          'exp'        => '2+ Years Experience',
          'desc'       => 'Accompany senior engineers on site surveys, understand facility risk requirements, prepare BOQ proposals, and present solutions to corporate clients.',
          'skills'     => ['Technical Proposal Writing', 'Site Survey Coordination', 'BOQ Preparation', 'Client Presentation'],
        ],
      ];
    ?>

    <div class="car-jobs-list">
      <?php foreach ($jobs as $job): ?>
      <div class="car-job-card">
        <div class="car-job-top">
          <div>
            <span class="car-job-dept"><?= e($job['dept']) ?></span>
            <h3 class="car-job-title"><?= e($job['title']) ?></h3>
            <div class="car-job-meta">
              <span><?= icon('pin') ?> <?= e($job['location']) ?></span>
              <span><?= icon('clock') ?> <?= e($job['type']) ?></span>
              <span><?= icon('shield') ?> <?= e($job['exp']) ?></span>
            </div>
          </div>
          <a href="mailto:<?= e(cfg('email')) ?>?subject=<?= urlencode('Application: ' . $job['title']) ?>" class="car-apply-btn">
            <span>Apply Now</span>
            <span class="car-apply-ico"><?= icon('arrow') ?></span>
          </a>
        </div>
        <p class="car-job-desc"><?= e($job['desc']) ?></p>
        <div class="car-job-skills">
          <?php foreach ($job['skills'] as $sk): ?>
            <span class="car-job-skill"><?= e($sk) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============ DIRECT CV SUBMISSION CTA ============ -->
<section class="car-cta-sec">
  <div class="container">
    <div class="car-cta-box">
      <div class="car-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Don't See Your Role? — <em>General Applications</em></span>
        <h2>We are always looking for passionate engineers</h2>
        <p>Send your resume directly to our engineering desk. If your profile matches upcoming enterprise projects, we will schedule an interview right away.</p>
      </div>
      <div class="car-cta-actions">
        <a href="mailto:<?= e(cfg('email')) ?>?subject=General%20Engineering%20Application" class="btn btn--primary btn--hero-compact">
          EMAIL YOUR CV <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
        <a href="<?= whatsapp_link() ?>" class="btn btn--outline-white" target="_blank" rel="noopener">
          WHATSAPP HR
        </a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
/* =========================================================
   CAREER PAGE — HERO
   ========================================================= */
.car-hero {
  background: var(--navy-900);
  position: relative;
  overflow: hidden;
  padding: 110px 0 70px;
}
.car-hero-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 50px;
  align-items: center;
}
.car-hero-text h1 {
  color: #fff;
  font-size: clamp(2.4rem, 4.8vw, 3.8rem);
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -0.03em;
  margin: 0 0 20px;
}
.car-hero-text .breadcrumb {
  color: rgba(255,255,255,0.6);
  font-size: 0.95rem;
}
.car-hero-text .breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; }
.car-hero-text .breadcrumb a:hover { color: #fff; }
.car-hero-text .breadcrumb span { margin: 0 8px; }
.car-hero-text .breadcrumb .active { color: var(--lime); font-style: italic; text-decoration: underline; text-underline-offset: 4px; }

.car-hero-badge-box {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 20px;
  padding: 32px 30px;
  backdrop-filter: blur(10px);
}
.car-stat-pill {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
}
.car-stat-num {
  font-size: 2.8rem;
  font-weight: 800;
  color: var(--lime);
  line-height: 1;
  font-family: var(--font-head);
}
.car-stat-text {
  font-size: 0.95rem;
  color: #fff;
  font-weight: 600;
  line-height: 1.3;
}
.car-hero-lead {
  color: rgba(255,255,255,0.7);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 900px) {
  .car-hero-grid { grid-template-columns: 1fr; gap: 30px; }
}

/* =========================================================
   CAREER PAGE — PERKS
   ========================================================= */
.car-why-sec {
  padding: clamp(80px, 9vw, 120px) 0;
  background: #fff;
}
.car-sec-head {
  text-align: center;
  margin-bottom: 60px;
}
.car-sec-head h2 {
  font-size: clamp(2.2rem, 3.8vw, 3.2rem) !important;
  font-weight: 800 !important;
  color: var(--ink) !important;
  line-height: 1.18 !important;
  margin: 16px auto 0;
  max-width: 22ch;
}
.car-perks-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}
.car-perk-card {
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 24px;
  padding: 40px 32px;
  transition: transform 0.3s var(--ease), box-shadow 0.3s var(--ease);
}
.car-perk-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(4,13,36,0.08);
  border-color: rgba(26,86,219,0.3);
}
.car-perk-icon {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  background: var(--navy-900);
  color: var(--lime);
  display: grid;
  place-items: center;
  margin-bottom: 22px;
}
.car-perk-icon .ico { width: 24px; height: 24px; }
.car-perk-card h3 {
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--ink);
  margin: 0 0 12px;
}
.car-perk-card p {
  font-size: 0.9rem;
  line-height: 1.7;
  color: var(--body);
  margin: 0;
}
@media (max-width: 900px) {
  .car-perks-grid { grid-template-columns: 1fr; gap: 20px; }
}

/* =========================================================
   CAREER PAGE — OPEN JOBS LIST
   ========================================================= */
.car-jobs-sec {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
.car-jobs-head {
  margin-bottom: 40px;
}
.car-jobs-head h2 {
  font-size: clamp(1.8rem, 3.2vw, 2.5rem);
  font-weight: 800;
  color: var(--ink);
  margin: 8px 0 0;
}
.car-jobs-list {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.car-job-card {
  background: #fff;
  border: 1px solid var(--line);
  border-radius: 20px;
  padding: 36px 32px;
  box-shadow: 0 4px 20px rgba(4,13,36,0.03);
  transition: transform 0.3s var(--ease), box-shadow 0.3s var(--ease), border-color 0.3s var(--ease);
}
.car-job-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 36px rgba(4,13,36,0.08);
  border-color: rgba(26,86,219,0.3);
}
.car-job-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 20px;
  margin-bottom: 16px;
}
.car-job-dept {
  display: inline-block;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--blue-600);
  background: rgba(26,86,219,0.08);
  padding: 4px 12px;
  border-radius: 999px;
  margin-bottom: 10px;
}
.car-job-title {
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--ink);
  margin: 0 0 8px;
}
.car-job-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  font-size: 0.85rem;
  color: var(--body);
}
.car-job-meta span {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.car-job-meta .ico { width: 14px; height: 14px; color: var(--blue-600); }
.car-apply-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: var(--navy-900);
  color: #fff;
  font-size: 0.8rem;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  padding: 10px 10px 10px 22px;
  border-radius: 999px;
  text-decoration: none;
  flex-shrink: 0;
  transition: background 0.25s var(--ease), transform 0.25s var(--ease);
  font-family: var(--font-head);
}
.car-apply-ico {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--lime);
  color: var(--ink);
  display: grid;
  place-items: center;
  transition: transform 0.25s var(--ease);
}
.car-apply-ico .ico { width: 13px; height: 13px; stroke: var(--ink); }
.car-apply-btn:hover {
  background: var(--blue-600);
}
.car-apply-btn:hover .car-apply-ico {
  transform: rotate(45deg);
}

.car-job-desc {
  font-size: 0.92rem;
  line-height: 1.7;
  color: var(--body);
  margin: 0 0 20px;
}
.car-job-skills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.car-job-skill {
  font-size: 0.76rem;
  font-weight: 600;
  color: var(--ink);
  background: var(--light);
  border: 1px solid var(--line);
  padding: 4px 12px;
  border-radius: 999px;
}

@media (max-width: 768px) {
  .car-job-top { flex-direction: column; align-items: flex-start; }
}

/* =========================================================
   CAREER PAGE — CTA
   ========================================================= */
.car-cta-sec {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
.car-cta-box {
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
.car-cta-box::before {
  content: "";
  position: absolute;
  top: -80px; right: -80px;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(0, 210, 255, 0.25) 0%, transparent 70%);
  pointer-events: none;
}
.car-cta-text {
  max-width: 600px;
  position: relative;
  z-index: 2;
}
.car-cta-text h2 {
  color: #fff;
  font-size: clamp(1.8rem, 3.2vw, 2.6rem);
  font-weight: 800;
  line-height: 1.2;
  margin: 10px 0 14px;
}
.car-cta-text p {
  color: rgba(255,255,255,0.72);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}
.car-cta-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  position: relative;
  z-index: 2;
}
.btn--outline-white {
  display: inline-flex;
  align-items: center;
  padding: 12px 26px;
  border-radius: 999px;
  border: 1.5px solid rgba(255,255,255,0.4);
  color: #fff;
  font-size: 0.8rem;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  text-decoration: none;
  transition: all 0.25s var(--ease);
  font-family: var(--font-head);
}
.btn--outline-white:hover {
  background: rgba(255,255,255,0.12);
  border-color: #fff;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);

  // Stagger heading words
  var head = document.querySelector('.car-sec-head h2');
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

  // Stagger job cards up
  var jobCards = document.querySelectorAll('.car-job-card');
  if (jobCards.length) {
    gsap.fromTo(jobCards,
      { y: 40, opacity: 0 },
      {
        y: 0, opacity: 1, stagger: 0.1, duration: 0.7, ease: 'power3.out',
        scrollTrigger: { trigger: '.car-jobs-list', start: 'top 85%' }
      }
    );
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
