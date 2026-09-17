<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle      = 'Client Testimonials & Reviews | Peace Automation';
$eyebrowText    = 'Client Satisfaction — Karachi Wide';
$bannerTitle    = 'Client Testimonials';
$bannerSubtitle = 'See what facility directors, operations managers, and business owners say about our security and automation systems.';
$bannerImage    = 'review-1.webp';
$bannerPill     = '500+ Verified Reviews';
$bannerBadgeNum = '4.9';
$bannerBadgeLabel = 'Client Rating<br>Average';
$bannerCtaText  = 'Book a Site Survey';
$bannerCtaHref  = 'contact.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/page-hero.php';
?>

<main>

<!-- ============ TESTIMONIALS SECTION ============ -->
<section class="testi-sec">
  <div class="container">

    <!-- Trust Stats Badge -->
    <div class="testi-stats-row">
      <div class="testi-badge-circle">
        <span class="testi-badge-num">4.9<small>/5</small></span>
        <div class="testi-badge-divider"></div>
        <span class="testi-badge-sub">500+ Reviews</span>
      </div>
      <div class="testi-badge-text">
        <span class="eyebrow" style="margin-bottom:8px; display:inline-block;">Proven Field Reliability</span>
        <h2 class="anim-heading" style="margin:0 0 10px; font-size:clamp(1.8rem, 3.2vw, 2.6rem);">Trusted across critical installations in Karachi</h2>
        <p style="color:var(--body); font-size:0.95rem; margin:0; max-width:540px;">From military compounds and industrial manufacturing plants to residential societies, our client retention rate stands at over 97%.</p>
      </div>
    </div>

    <!-- Reviews Grid -->
    <?php
      $testimonials = [
        ['name' => 'Ahmed Raza',   'role' => 'Facility Manager, Gulshan',      'avatar' => 'avatars/t-1.webp', 'text' => 'The install was clean, on schedule, and the control room handover was properly documented. No exposed conduits or loose wires.'],
        ['name' => 'Sana Malik',   'role' => 'Ops Manager, Korangi Warehouse', 'avatar' => 'avatars/t-2.webp', 'text' => 'They flagged two critical camera blind spots our previous contractor had missed and corrected the angle in the same quote.'],
        ['name' => 'Faisal Khan',  'role' => 'Director, SITE Area Factory',    'avatar' => 'avatars/t-3.webp', 'text' => 'Twenty-four 4K cameras across two factory floors, finished in under three days without stopping active production lines.'],
        ['name' => 'Hina Sheikh',  'role' => 'Operations Head, Clifton',       'avatar' => 'avatars/t-4.webp', 'text' => 'Fire alarm commissioning came with a full certified loop test report — the first time we received paperwork civil defense approved.'],
        ['name' => 'Bilal Ahmed',  'role' => 'IT Administrator, DHA',          'avatar' => 'avatars/t-5.webp', 'text' => 'Remote viewing was tested and fine-tuned on our own network before they left the site. Support always answers on the first ring.'],
        ['name' => 'Nadia Iqbal',  'role' => 'HR Lead, Shahrah-e-Faisal',      'avatar' => 'avatars/t-6.webp', 'text' => 'The biometric facial recognition and time attendance system paid for itself within the first quarter. Payroll export works seamlessly.'],
        ['name' => 'Kamran Ali',   'role' => 'Commercial Store Owner',         'avatar' => 'avatars/t-7.webp', 'text' => 'Fair quote, arrived exactly on time, and the color night-vision footage is clear enough to identify vehicle license plates easily.'],
        ['name' => 'Zara Hussain', 'role' => 'Admin Manager, North Nazimabad', 'avatar' => 'avatars/t-8.webp', 'text' => 'Touchless access control across three branch offices, all managed centrally from one cloud dashboard. Highly recommended.'],
      ];
    ?>

    <div class="testi-grid">
      <?php foreach ($testimonials as $t): ?>
      <div class="testi-card">
        <div class="testi-stars">
          <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
        <p class="testi-text">&ldquo;<?= e($t['text']) ?>&rdquo;</p>
        <div class="testi-user">
          <div class="testi-avatar">
            <?= img($t['avatar'], $t['name'], 80, 80) ?>
          </div>
          <div>
            <h4 class="testi-name"><?= e($t['name']) ?></h4>
            <span class="testi-role"><?= e($t['role']) ?></span>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============ CTA STRIP (Seonex Style) ============ -->
<section class="testi-cta-sec">
  <div class="container">
    <div class="ind-cta-box">
      <div class="ind-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Become Our Next Success Story</span>
        <h2>Ready for a reliable, professional security partner?</h2>
        <p>Book a free technical site survey today. We examine your facility, listen to your concerns, and provide a transparent, competitive quote.</p>
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
   TESTIMONIALS PAGE STYLES
   ========================================================= */
.testi-sec {
  padding: clamp(70px, 9vw, 120px) 0 60px;
  background: #fff;
}
.testi-stats-row {
  display: flex;
  align-items: center;
  gap: 36px;
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 24px;
  padding: 36px 40px;
  margin-bottom: 60px;
}
.testi-badge-circle {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  background: var(--lime);
  color: var(--ink);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  box-shadow: 0 10px 30px rgba(212, 231, 52, 0.35);
}
.testi-badge-num {
  font-size: 2.2rem;
  font-weight: 800;
  line-height: 1;
  font-family: var(--font-head);
}
.testi-badge-num small { font-size: 1.1rem; }
.testi-badge-divider {
  width: 32px;
  height: 1.5px;
  background: rgba(4,13,36,0.25);
  margin: 4px 0;
}
.testi-badge-sub {
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
@media (max-width: 768px) {
  .testi-stats-row { flex-direction: column; text-align: center; padding: 30px 24px; }
}

.testi-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}
.testi-card {
  background: #fff;
  border: 1px solid var(--line);
  border-radius: 20px;
  padding: 30px 26px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 20px rgba(4,13,36,0.03);
  transition: transform 0.3s var(--ease), box-shadow 0.3s var(--ease), border-color 0.3s var(--ease);
}
.testi-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(4,13,36,0.08);
  border-color: rgba(26,86,219,0.3);
}
.testi-stars {
  color: #F59E0B;
  font-size: 1rem;
  letter-spacing: 2px;
  margin-bottom: 14px;
}
.testi-text {
  font-size: 0.9rem;
  line-height: 1.7;
  color: var(--body);
  margin: 0 0 24px;
  flex-grow: 1;
}
.testi-user {
  display: flex;
  align-items: center;
  gap: 14px;
  padding-top: 18px;
  border-top: 1px solid var(--line);
}
.testi-avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  overflow: hidden;
  flex-shrink: 0;
  background: var(--light);
}
.testi-avatar img {
  width: 100%; height: 100%; object-fit: cover; display: block;
}
.testi-name {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--ink);
  margin: 0 0 2px;
}
.testi-role {
  font-size: 0.78rem;
  color: var(--body);
  display: block;
}

@media (max-width: 1200px) {
  .testi-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
  .testi-grid { grid-template-columns: 1fr; }
}

.testi-cta-sec {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);

  var cards = document.querySelectorAll('.testi-card');
  if (cards.length) {
    gsap.fromTo(cards,
      { y: 40, opacity: 0 },
      {
        y: 0, opacity: 1, stagger: 0.08, duration: 0.65, ease: 'power3.out',
        scrollTrigger: { trigger: '.testi-grid', start: 'top 85%' }
      }
    );
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
