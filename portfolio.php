<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle      = 'Our Portfolio | Peace Automation';
$bannerTitle    = 'Our Portfolio';
$bannerSubtitle = 'A look at recent security and automation projects we\'ve delivered for leading organizations.';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ============ PORTFOLIO HERO (Seonex Style) ============ -->
<!-- ============ PORTFOLIO HERO ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Verified Deployments — <em>Karachi &amp; Nationwide</em></span>
      <h1>Delivering Measurable<br>Impact Across<br>Every Site</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>Portfolio</span>
      </nav>
      <a href="contact.php" class="btn btn--primary" style="margin-top:32px">
        Start a Project <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('showcase-1.webp', 'Air base and defense facility perimeter security project', 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">100%</span><span class="l">On-Time<br>Handover</span></div>
      <div class="svc-hero__pill"><?= icon('shield') ?><span>500+ Verified Deployments</span></div>
    </div>
  </div>
</section>

<main>

<!-- ============ PORTFOLIO GRID (Seonex Staggered) ============ -->
<section class="pf-grid-sec">
  <div class="container">
    <div class="pf-grid-head">
      <span class="eyebrow" style="color:var(--body); text-transform:none;">Explore Our — <em style="color:var(--ink); font-style:italic;">Latest Works.</em></span>
      <h2 class="anim-heading">Let's explore our award-winning projects</h2>
    </div>

    <?php
      $projects = [
        ['img' => 'service-cctv.webp',           'cat' => 'Surveillance',       'year' => '2024', 'title' => 'Refinery-Wide CCTV Surveillance'],
        ['img' => 'service-access-control.webp',  'cat' => 'Access Control',     'year' => '2024', 'title' => 'Multi-Site Access Control Deployment'],
        ['img' => 'service-fire-alarm.webp',      'cat' => 'Fire Safety',        'year' => '2024', 'title' => 'Industrial Fire Alarm System Upgrade'],
        ['img' => 'service-gate-barrier.webp',    'cat' => 'Gate Automation',    'year' => '2024', 'title' => 'Automated Gate Barrier Installation'],
        ['img' => 'service-attendance.webp',      'cat' => 'Automation',         'year' => '2025', 'title' => 'Time & Attendance Management System'],
        ['img' => 'service-intrusion.webp',       'cat' => 'Security',           'year' => '2025', 'title' => 'Perimeter Intrusion Detection Setup'],
        ['img' => 'service-fire-fighting.webp',   'cat' => 'Fire Safety',        'year' => '2025', 'title' => 'Fire Fighting System Deployment'],
        ['img' => 'tech-warehouse-cam.webp',      'cat' => 'Surveillance',       'year' => '2025', 'title' => 'Warehouse Surveillance & Monitoring'],
      ];
    ?>

    <div class="pf-masonry">
      <?php foreach ($projects as $i => $p): ?>
      <div class="pf-item <?= $i % 2 === 0 ? 'pf-left' : 'pf-right' ?>">
        <div class="pf-img-wrap">
          <?= img($p['img'], $p['title'], 700, 500) ?>
        </div>
        <div class="pf-meta">
          <span class="pf-cat"><?= $p['cat'] ?></span>
          <span class="pf-sep">——</span>
          <span class="pf-year"><?= $p['year'] ?></span>
        </div>
        <h3 class="pf-title"><?= $p['title'] ?></h3>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ CTA STRIP ============ -->
<section class="pf-cta-sec">
  <div class="container" style="text-align:center;">
    <h2 class="anim-heading">Have a Project in Mind?</h2>
    <p style="color:var(--body); max-width:500px; margin:16px auto 32px; font-size:1.1rem; line-height:1.6;">Let's talk about how we can deliver similar results for your business.</p>
    <a href="contact.php" class="btn btn--primary btn--exp">
      START A PROJECT <span class="btn__chip"><?= icon('arrow') ?></span>
    </a>
  </div>
</section>

</main>

<style>
/* =========================================================
   PORTFOLIO PAGE — HERO
   ========================================================= */
.pf-hero {
  background: var(--navy-900);
  position: relative;
  overflow: hidden;
  padding: 100px 0 60px;
}
.pf-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: center;
}
.pf-hero-text h1 {
  color: #fff;
  font-size: clamp(2.5rem, 5vw, 4.2rem);
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.03em;
  margin: 0 0 24px;
}
.pf-hero-text .breadcrumb {
  color: rgba(255,255,255,0.6);
  font-size: 0.95rem;
}
.pf-hero-text .breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; }
.pf-hero-text .breadcrumb a:hover { color: #fff; }
.pf-hero-text .breadcrumb span { margin: 0 8px; }
.pf-hero-text .breadcrumb .active { color: var(--lime); font-style: italic; text-decoration: underline; text-underline-offset: 4px; }
.pf-hero-img {
  border-radius: 16px;
  overflow: hidden;
}
.pf-hero-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  border-radius: 16px;
}
@media (max-width: 768px) {
  .pf-hero-grid { grid-template-columns: 1fr; }
}

/* =========================================================
   PORTFOLIO PAGE — STAGGERED GRID
   ========================================================= */
.pf-grid-sec {
  padding: clamp(80px, 10vw, 140px) 0;
  background: #fff;
}
.pf-grid-head {
  text-align: center;
  margin-bottom: 80px;
}
.pf-grid-head h2 {
  font-size: clamp(2.5rem, 4vw, 3.8rem) !important;
  font-weight: 800 !important;
  color: var(--ink) !important;
  line-height: 1.1 !important;
  margin: 20px auto 0;
  max-width: 20ch;
}

/* Masonry-like 2 column staggered */
.pf-masonry {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px 30px;
}
.pf-item {
  margin-bottom: 20px;
}
.pf-left {
  /* Left column: no offset */
}
.pf-right {
  /* Right column: pushed down to create stagger */
  margin-top: 100px;
}
.pf-img-wrap {
  border-radius: 16px;
  overflow: hidden;
  margin-bottom: 20px;
}
/* Row 1: left=small, right=big | Row 2: left=big, right=small — alternating */
.pf-item:nth-child(4n+1) .pf-img-wrap { max-width: 90%; height: 340px; }
.pf-item:nth-child(4n+2) .pf-img-wrap { max-width: 100%; height: 400px; margin-left: auto; }
.pf-item:nth-child(4n+3) .pf-img-wrap { max-width: 100%; height: 400px; }
.pf-item:nth-child(4n+4) .pf-img-wrap { max-width: 90%; height: 340px; margin-left: auto; }

.pf-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.6s var(--ease);
}
.pf-item:hover .pf-img-wrap img {
  transform: scale(1.05);
}
.pf-meta {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 8px;
  font-size: 0.95rem;
}
.pf-cat {
  color: var(--body);
}
.pf-sep {
  color: rgba(0,0,0,0.15);
  font-size: 0.8rem;
}
.pf-year {
  color: var(--body);
}
.pf-title {
  font-size: clamp(1.2rem, 1.8vw, 1.45rem);
  font-weight: 700;
  color: var(--ink);
  line-height: 1.3;
  margin: 0;
}
/* Right-side items: align text right */
.pf-item:nth-child(4n+2) .pf-meta,
.pf-item:nth-child(4n+2) .pf-title,
.pf-item:nth-child(4n+4) .pf-meta,
.pf-item:nth-child(4n+4) .pf-title {
  margin-left: auto;
  max-width: 520px;
}

@media (max-width: 768px) {
  .pf-masonry { grid-template-columns: 1fr; }
  .pf-right { margin-top: 0; }
}

/* =========================================================
   PORTFOLIO PAGE — CTA
   ========================================================= */
.pf-cta-sec {
  padding: clamp(80px, 10vw, 120px) 0;
  background: #f8f9fa;
}
.pf-cta-sec h2 {
  font-size: clamp(2rem, 3.5vw, 3rem) !important;
  font-weight: 800 !important;
  color: var(--ink) !important;
  line-height: 1.1 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Animate headings with word stagger
  var animHeadings = document.querySelectorAll('.anim-heading');
  animHeadings.forEach(function(heading) {
    if (heading.querySelector('.ab-word')) return;
    var words = heading.innerText.split(' ');
    heading.innerHTML = '';
    words.forEach(function(word) {
      var span = document.createElement('span');
      span.className = 'ab-word';
      span.innerText = word + ' ';
      heading.appendChild(span);
    });
    gsap.fromTo(heading.querySelectorAll('.ab-word'),
      { y: 40, opacity: 0 },
      {
        y: 0, opacity: 1,
        stagger: 0.03,
        duration: 0.8,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: heading,
          start: 'top 85%'
        }
      }
    );
  });

  // Animate portfolio items on scroll
  var pfItems = document.querySelectorAll('.pf-item');
  pfItems.forEach(function(item, i) {
    gsap.fromTo(item,
      { y: 60, opacity: 0 },
      {
        y: 0, opacity: 1,
        duration: 0.8,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: item,
          start: 'top 90%'
        }
      }
    );
  });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
