<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle      = 'Insights & Security Engineering Blog | Peace Automation';
$bannerTitle    = 'Our Blog';
$bannerSubtitle = 'Practical guides, compliance insights, and engineering benchmarks for commercial security and building automation.';

$posts = data('blog');
$featured = $posts[0] ?? null;
$gridPosts = array_slice($posts, 1);

require_once __DIR__ . '/includes/header.php';
?>

<!-- ============ BLOG HERO (Seonex Style) ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Security Intelligence — <em>Engineering Guides</em></span>
      <h1>Insights On Modern<br>Security &amp; Smart<br>Automation</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>Blog</span>
      </nav>
      <a href="contact.php" class="btn btn--primary" style="margin-top:32px">
        Ask an Engineer <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('blog-1.webp', 'Surveillance storage planning and high-bay warehouse camera layout', 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">50+</span><span class="l">Technical<br>Articles</span></div>
      <div class="svc-hero__pill"><?= icon('link') ?><span>Field-Tested Notes</span></div>
    </div>
  </div>
</section>

<main>

<!-- ============ FEATURED ARTICLE SPOTLIGHT ============ -->
<?php if ($featured): ?>
<section class="blog-feat-sec">
  <div class="container">
    <div class="blog-feat-card">
      <div class="blog-feat-img">
        <?= img($featured['image'], $featured['title'], 800, 520) ?>
        <span class="blog-feat-badge">Featured Guide</span>
      </div>
      <div class="blog-feat-content">
        <div class="blog-meta-top">
          <span class="blog-cat-pill"><?= e($featured['category']) ?></span>
          <span class="blog-date"><?= date('F d, Y', strtotime($featured['date'])) ?></span>
          <span class="blog-sep">·</span>
          <span class="blog-read-time">5 Min Read</span>
        </div>
        <h2 class="blog-feat-title">
          <a href="blog-detail.php?slug=<?= urlencode($featured['slug']) ?>"><?= e($featured['title']) ?></a>
        </h2>
        <p class="blog-feat-excerpt"><?= e($featured['excerpt']) ?></p>
        <div class="blog-feat-foot">
          <div class="blog-author">
            <span class="blog-author-avatar"><?= icon('shield') ?></span>
            <div>
              <span class="blog-author-name"><?= e($featured['author']) ?></span>
              <span class="blog-author-role">Technical Editorial Team</span>
            </div>
          </div>
          <a href="blog-detail.php?slug=<?= urlencode($featured['slug']) ?>" class="btn btn--primary btn--hero-compact">
            READ ARTICLE <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ BLOG POSTS GRID ============ -->
<section class="blog-grid-sec">
  <div class="container">
    <div class="blog-sec-head">
      <span class="eyebrow">Latest Engineering Articles — <em>Archive</em></span>
      <h2 class="anim-heading">Practical guides for facilities and operations leaders</h2>
    </div>

    <div class="blog-grid">
      <?php foreach ($gridPosts as $post): ?>
      <article class="blog-card">
        <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>" class="blog-card-img-box">
          <?= img($post['image'], $post['title'], 600, 400) ?>
          <span class="blog-card-cat"><?= e($post['category']) ?></span>
        </a>
        <div class="blog-card-body">
          <div class="blog-card-meta">
            <span><?= date('M d, Y', strtotime($post['date'])) ?></span>
            <span class="blog-sep">·</span>
            <span>4 Min Read</span>
          </div>
          <h3 class="blog-card-title">
            <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>"><?= e($post['title']) ?></a>
          </h3>
          <p class="blog-card-excerpt"><?= e($post['excerpt']) ?></p>
          <div class="blog-card-foot">
            <a href="blog-detail.php?slug=<?= urlencode($post['slug']) ?>" class="blog-read-link">
              <span>Read Full Article</span>
              <span class="blog-link-ico"><?= icon('arrow') ?></span>
            </a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============ CTA STRIP (Seonex Style) ============ -->
<section class="blog-cta-sec">
  <div class="container">
    <div class="blog-cta-box">
      <div class="blog-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Have a Specific Engineering Question? — <em>Consultation</em></span>
        <h2>Need personalized advice for your facility layout?</h2>
        <p>Book a free technical survey. We analyze your premises, discuss camera sightlines and access workflows, and answer your compliance questions on site.</p>
      </div>
      <div class="blog-cta-btn">
        <a href="contact.php" class="btn btn--primary btn--hero-compact">
          SPEAK WITH AN ENGINEER <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
/* =========================================================
   BLOG PAGE — HERO
   ========================================================= */
.blog-hero {
  background: var(--navy-900);
  position: relative;
  overflow: hidden;
  padding: 110px 0 70px;
}
.blog-hero-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 50px;
  align-items: center;
}
.blog-hero-text h1 {
  color: #fff;
  font-size: clamp(2.4rem, 4.8vw, 3.8rem);
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -0.03em;
  margin: 0 0 20px;
}
.blog-hero-text .breadcrumb {
  color: rgba(255,255,255,0.6);
  font-size: 0.95rem;
}
.blog-hero-text .breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; }
.blog-hero-text .breadcrumb a:hover { color: #fff; }
.blog-hero-text .breadcrumb span { margin: 0 8px; }
.blog-hero-text .breadcrumb .active { color: var(--lime); font-style: italic; text-decoration: underline; text-underline-offset: 4px; }

.blog-hero-badge-box {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 20px;
  padding: 32px 30px;
  backdrop-filter: blur(10px);
}
.blog-stat-pill {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
}
.blog-stat-num {
  font-size: 2.8rem;
  font-weight: 800;
  color: var(--lime);
  line-height: 1;
  font-family: var(--font-head);
}
.blog-stat-text {
  font-size: 0.95rem;
  color: #fff;
  font-weight: 600;
  line-height: 1.3;
}
.blog-hero-lead {
  color: rgba(255,255,255,0.7);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 900px) {
  .blog-hero-grid { grid-template-columns: 1fr; gap: 30px; }
}

/* =========================================================
   BLOG PAGE — FEATURED SPOTLIGHT
   ========================================================= */
.blog-feat-sec {
  padding: clamp(60px, 8vw, 90px) 0 30px;
  background: #fff;
}
.blog-feat-card {
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 28px;
  overflow: hidden;
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: 0;
  box-shadow: 0 10px 36px rgba(4,13,36,0.05);
  transition: box-shadow 0.35s var(--ease);
}
.blog-feat-card:hover {
  box-shadow: 0 20px 50px rgba(4,13,36,0.1);
}
.blog-feat-img {
  position: relative;
  overflow: hidden;
  min-height: 380px;
}
.blog-feat-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.6s var(--ease);
}
.blog-feat-card:hover .blog-feat-img img {
  transform: scale(1.06);
}
.blog-feat-badge {
  position: absolute;
  top: 20px;
  left: 20px;
  background: var(--navy-900);
  color: var(--lime);
  font-size: 0.78rem;
  font-weight: 700;
  padding: 6px 16px;
  border-radius: 999px;
  letter-spacing: 0.04em;
  text-transform: uppercase;
}
.blog-feat-content {
  padding: clamp(36px, 5vw, 56px);
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.blog-meta-top {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
  font-size: 0.85rem;
  color: var(--body);
}
.blog-cat-pill {
  background: var(--blue-600);
  color: #fff;
  font-size: 0.74rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  padding: 4px 12px;
  border-radius: 999px;
}
.blog-sep { color: rgba(0,0,0,0.2); }
.blog-feat-title {
  font-size: clamp(1.6rem, 2.6vw, 2.2rem);
  font-weight: 800;
  color: var(--ink);
  line-height: 1.25;
  margin: 0 0 16px;
}
.blog-feat-title a { color: inherit; text-decoration: none; transition: color 0.25s var(--ease); }
.blog-feat-title a:hover { color: var(--blue-600); }
.blog-feat-excerpt {
  font-size: 0.95rem;
  line-height: 1.7;
  color: var(--body);
  margin: 0 0 28px;
}
.blog-feat-foot {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
  padding-top: 20px;
  border-top: 1px solid var(--line);
}
.blog-author {
  display: flex;
  align-items: center;
  gap: 12px;
}
.blog-author-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--navy-900);
  color: var(--lime);
  display: grid;
  place-items: center;
}
.blog-author-avatar .ico { width: 20px; height: 20px; }
.blog-author-name {
  display: block;
  font-size: 0.9rem;
  font-weight: 700;
  color: var(--ink);
}
.blog-author-role {
  display: block;
  font-size: 0.75rem;
  color: var(--body);
}

@media (max-width: 900px) {
  .blog-feat-card { grid-template-columns: 1fr; }
  .blog-feat-img { height: 260px; min-height: auto; }
}

/* =========================================================
   BLOG PAGE — POSTS GRID
   ========================================================= */
.blog-grid-sec {
  padding: 40px 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
.blog-sec-head {
  text-align: center;
  margin-bottom: 60px;
}
.blog-sec-head h2 {
  font-size: clamp(2.2rem, 3.8vw, 3.2rem) !important;
  font-weight: 800 !important;
  color: var(--ink) !important;
  line-height: 1.18 !important;
  margin: 16px auto 0;
  max-width: 24ch;
}
.blog-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}
.blog-card {
  background: #fff;
  border: 1px solid var(--line);
  border-radius: 20px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 20px rgba(4,13,36,0.04);
  transition: transform 0.35s var(--ease), box-shadow 0.35s var(--ease), border-color 0.35s var(--ease);
}
.blog-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 16px 40px rgba(4,13,36,0.1);
  border-color: rgba(26,86,219,0.3);
}
.blog-card-img-box {
  position: relative;
  height: 220px;
  overflow: hidden;
  display: block;
}
.blog-card-img-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.6s var(--ease);
}
.blog-card:hover .blog-card-img-box img {
  transform: scale(1.08);
}
.blog-card-cat {
  position: absolute;
  top: 14px;
  right: 14px;
  background: rgba(4,13,36,0.8);
  backdrop-filter: blur(8px);
  color: var(--lime);
  font-size: 0.74rem;
  font-weight: 700;
  padding: 4px 12px;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.15);
}
.blog-card-body {
  padding: 26px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.blog-card-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.8rem;
  color: var(--body);
  margin-bottom: 12px;
}
.blog-card-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--ink);
  line-height: 1.35;
  margin: 0 0 12px;
}
.blog-card-title a { color: inherit; text-decoration: none; transition: color 0.25s var(--ease); }
.blog-card-title a:hover { color: var(--blue-600); }
.blog-card-excerpt {
  font-size: 0.88rem;
  line-height: 1.65;
  color: var(--body);
  margin: 0 0 22px;
  flex-grow: 1;
}
.blog-card-foot {
  padding-top: 16px;
  border-top: 1px solid var(--line);
}
.blog-read-link {
  display: inline-flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  color: var(--ink);
  font-size: 0.82rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  text-decoration: none;
  transition: color 0.25s var(--ease);
}
.blog-link-ico {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--light);
  border: 1px solid var(--line);
  display: grid;
  place-items: center;
  transition: background 0.25s var(--ease), color 0.25s var(--ease), transform 0.25s var(--ease);
}
.blog-link-ico .ico { width: 13px; height: 13px; }
.blog-card:hover .blog-read-link {
  color: var(--blue-600);
}
.blog-card:hover .blog-link-ico {
  background: var(--blue-600);
  color: #fff;
  border-color: var(--blue-600);
  transform: rotate(45deg);
}

@media (max-width: 1024px) {
  .blog-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
  .blog-grid { grid-template-columns: 1fr; }
}

/* =========================================================
   BLOG PAGE — CTA
   ========================================================= */
.blog-cta-sec {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
.blog-cta-box {
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
.blog-cta-box::before {
  content: "";
  position: absolute;
  top: -80px; right: -80px;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(0, 210, 255, 0.25) 0%, transparent 70%);
  pointer-events: none;
}
.blog-cta-text {
  max-width: 650px;
  position: relative;
  z-index: 2;
}
.blog-cta-text h2 {
  color: #fff;
  font-size: clamp(1.8rem, 3.2vw, 2.6rem);
  font-weight: 800;
  line-height: 1.2;
  margin: 10px 0 14px;
}
.blog-cta-text p {
  color: rgba(255,255,255,0.72);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}
.blog-cta-btn {
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
  var head = document.querySelector('.blog-sec-head h2');
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

  // Stagger blog cards up
  var cards = document.querySelectorAll('.blog-card');
  if (cards.length) {
    gsap.fromTo(cards,
      { y: 45, opacity: 0 },
      {
        y: 0, opacity: 1, stagger: 0.08, duration: 0.75, ease: 'power3.out',
        scrollTrigger: { trigger: '.blog-grid', start: 'top 85%' }
      }
    );
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
