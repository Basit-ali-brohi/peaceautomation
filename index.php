<?php
/**
 * Homepage — S1 … S14.
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/includes/functions.php';

$useTailwind = false;                      // fully migrated to custom CSS
$pageTitle   = cfg('name') . ' | CCTV, Fire Safety & Automation in Karachi';
$pageDesc    = 'Smart security and automation built for Pakistani businesses. CCTV surveillance, fire alarm and fire fighting systems, access control, attendance and gate barriers — surveyed, installed and maintained in Karachi.';

$services   = data('services');
$projects   = data('projects');
$reviews    = data('reviews');
$posts      = data('blog');
$steps      = data('steps');
$strengths  = data('strengths');
$ticker     = data('ticker');
$team       = data('team');
$capsules   = data('capsules');
$timeline   = data('timeline');

require __DIR__ . '/includes/header.php';
?>

<main id="main">

<!-- ============ S1 HERO ============ -->
<section class="hero" data-hero>
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container hero__inner">
    <!-- Left Column: Copy & Stats -->
    <div class="hero__copy">
      <span class="hero__eyebrow" data-hero-item>
        Designed for Control. <em>Built for Protection.</em>
      </span>
      <h1 data-hero-item>Smart Security And Automation Built For Pakistani Businesses</h1>
      <p class="hero__lead" data-hero-item>
        We help organizations grow by implementing smart, reliable, and scalable security technologies tailored to real-world industrial and commercial needs.
      </p>
      <div class="hero__cta" data-hero-item>
        <a href="contact.php" class="btn btn--primary btn--hero-compact">
          GET A FREE QUOTE <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>

      <div class="hero__stats" data-hero-item>
        <div>
          <p class="n"><span data-count="48" data-suffix="%">0</span></p>
          <p class="l">Clients satisfied and repeating</p>
        </div>
        <div>
          <p class="n"><span data-count="3.7" data-decimals="1">0</span></p>
          <p class="l">Based on client reviews (500+)</p>
        </div>
      </div>
    </div>

    <!-- Right Column: 4-Card Collage (Exact match to reference image) -->
    <div class="hero__collage" data-hero-collage>
      <!-- Top Wide Card -->
      <div class="hero__card hero__card--wide">
        <?= img('hero/hero-wide.webp', 'Close-up of a CCTV camera lens with its infrared array', 612, 408, ['eager' => true]) ?>
      </div>

      <!-- Bottom Subgrid: Left Column (Lime Card + White Card) & Right Column (Tall Card) -->
      <div class="hero__subgrid">
        <div class="hero__subcol">
          <!-- Card 1: Lime Card (10+ Quality Security Team Specialists) -->
          <div class="hero__card hero__card--lime">
            <?= img('hero/hero-card-lime.webp', '10+ Quality Security Team Specialists', 500, 328) ?>
          </div>

          <!-- Card 2: White Card (Smart PTZ & Dome 360 Field Coverage) -->
          <div class="hero__card hero__card--white">
            <?= img('hero/hero-card-white.webp', 'Smart PTZ and Dome 360 Field Coverage', 500, 312) ?>
          </div>
        </div>

        <!-- Card 3: Tall Card (Exterior Dome Camera with Night Vision) -->
        <div class="hero__card hero__card--tall">
          <?= img('hero/hero-tall.webp', 'Exterior dome camera with infrared night vision', 420, 660, ['eager' => true]) ?>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ============ S2 INTRO STATEMENT (Seonex Style) ============ -->
<section class="s2-intro">
  <div class="container">
    <span class="eyebrow" style="margin-bottom:20px; display:block;">Real strategies. <em>Real results.</em></span>
    <div class="s2-intro__grid">
      <div class="s2-intro__left">
        <h2 class="s2-intro__heading anim-heading">We believe success comes from strategy, not guesswork. Approach combines deep market insight.</h2>
      </div>
      <div class="s2-intro__right">
        <p class="s2-intro__desc">We focus on creating real, data-driven strategies that deliver measurable results. Every campaign is built on research, insight, and clear objectives — ensuring your security infrastructure runs at peak performance.</p>
        <a href="about.php" class="btn btn--outline-dark">
          LEARN MORE <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<style>
.s2-intro {
  padding: clamp(80px, 10vw, 120px) 0;
  background: #fff;
}
.s2-intro__grid {
  display: grid;
  grid-template-columns: 1.3fr 0.7fr;
  gap: 60px;
  align-items: start;
}
.s2-intro__heading {
  font-size: clamp(2.2rem, 4vw, 3.4rem) !important;
  font-weight: 800 !important;
  color: var(--ink) !important;
  line-height: 1.15 !important;
  margin: 0 !important;
  letter-spacing: -0.02em;
}
.s2-intro__right {
  padding-top: 10px;
}
.s2-intro__desc {
  color: var(--body);
  font-size: 1.05rem;
  line-height: 1.75;
  margin: 0 0 32px;
}
.btn--outline-dark {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 0.82rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--ink);
  border: 1.5px solid var(--ink);
  border-radius: var(--r-pill);
  padding: 14px 22px 14px 28px;
  transition: all 0.3s var(--ease);
  font-family: var(--font-head);
}
.btn--outline-dark .btn__chip {
  width: 32px; height: 32px;
  border-radius: 50%;
  background: var(--ink);
  display: grid; place-items: center;
}
.btn--outline-dark .btn__chip .ico { color: #fff; width: 14px; height: 14px; }
.btn--outline-dark:hover {
  background: var(--ink);
  color: #fff;
}
.btn--outline-dark:hover .btn__chip {
  background: var(--lime);
}
.btn--outline-dark:hover .btn__chip .ico { color: var(--ink); }
@media (max-width: 768px) {
  .s2-intro__grid { grid-template-columns: 1fr; gap: 30px; }
}
</style>

<!-- ============ S2B THREE COLUMN CARDS (Seonex Style) ============ -->
<section class="s2b-cards">
  <div class="container">
    <div class="s2b-grid">

      <!-- Card 1: Dark Navy with Glowing Cyan/Blue Aura -->
      <div class="s2b-card s2b-card--navy">
        <div class="s2b-card__mark" aria-hidden="true">
          <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="5.5" fill="#D4E734"/>
            <circle cx="32" cy="12" r="5.5" fill="#D4E734"/>
            <circle cx="12" cy="32" r="5.5" fill="#D4E734"/>
            <circle cx="32" cy="32" r="5.5" fill="#D4E734"/>
            <circle cx="22" cy="22" r="6.5" fill="#D4E734"/>
            <rect x="10" y="18" width="24" height="8" rx="4" fill="#D4E734"/>
            <rect x="18" y="10" width="8" height="24" rx="4" fill="#D4E734"/>
          </svg>
        </div>
        <h3>Helping businesses secure, monitor, and automate operations.</h3>
        <p>We ensure every installation drives real results — increased safety and engagement to higher reliability and revenue.</p>
        <ul class="s2b-checks">
          <li><?= icon('check') ?> CCTV &amp; Surveillance Systems</li>
          <li><?= icon('check') ?> Automation &amp; Control Solutions</li>
        </ul>
      </div>

      <!-- Card 2: Center Photo -->
      <div class="s2b-card s2b-card--photo">
        <?= img('tech-warehouse-cam.webp', 'Dome camera covering warehouse racking', 640, 720) ?>
      </div>

      <!-- Card 3: Stat Card -->
      <div class="s2b-card s2b-card--stat">
        <div class="s2b-stat__top">
          <p class="s2b-stat__n"><span data-count="71" data-suffix="%">0%</span></p>
          <p class="s2b-stat__label">System Reliability</p>
          <p class="s2b-stat__desc">Measured across every active deployment we maintain — monitored, tested, and serviced on a documented schedule.</p>
        </div>
        <a href="contact.php" class="s2b-btn">
          <span class="s2b-btn__text">GET STARTED</span>
          <span class="s2b-btn__icon"><?= icon('arrow') ?></span>
        </a>
      </div>

    </div>
  </div>
</section>

<style>
.s2b-cards {
  padding: 0 0 clamp(60px, 8vw, 100px);
  background: #fff;
}
.s2b-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 24px;
}
.s2b-card {
  height: 440px;
  border-radius: 24px;
  overflow: hidden;
  box-sizing: border-box;
}

/* Card 1: Dark Navy with ambient top-right cyan/blue radial glow */
.s2b-card--navy {
  background: radial-gradient(circle at 86% 16%, rgba(0, 166, 255, 0.45) 0%, rgba(18, 74, 235, 0.28) 36%, rgba(4, 9, 24, 0) 70%), #04091A;
  padding: 38px 32px 32px;
  color: rgba(255,255,255,0.85);
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  box-shadow: 0 10px 30px rgba(4, 9, 24, 0.08);
}
.s2b-card__mark {
  margin-bottom: 22px;
  display: inline-flex;
}
.s2b-card--navy h3 {
  color: #fff;
  font-size: 1.35rem;
  font-weight: 700;
  line-height: 1.28;
  margin: 0 0 14px;
  letter-spacing: -0.01em;
}
.s2b-card--navy p {
  font-size: 0.88rem;
  line-height: 1.65;
  margin: 0 0 20px;
  color: rgba(255,255,255,0.72);
}
.s2b-checks {
  list-style: none; padding: 0; margin: 0;
  display: flex; flex-direction: column; gap: 9px;
}
.s2b-checks li {
  display: flex; align-items: center; gap: 8px;
  font-size: 0.85rem; color: rgba(255,255,255,0.92);
  font-weight: 500;
}
.s2b-checks .ico { width: 14px; height: 14px; color: var(--lime); flex-shrink: 0; stroke-width: 2.2; }

/* Card 2: Center Photo */
.s2b-card--photo {
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
}
.s2b-card--photo img {
  width: 100%; height: 100%;
  object-fit: cover; display: block;
}

/* Card 3: Stat Card */
.s2b-card--stat {
  background: #F4F6F9;
  border: 1px solid rgba(0, 0, 0, 0.04);
  padding: 38px 34px 34px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
}
.s2b-stat__n {
  font-size: clamp(3rem, 4.2vw, 3.8rem);
  font-weight: 800;
  color: var(--ink);
  line-height: 1;
  margin: 0 0 10px;
  letter-spacing: -0.03em;
  font-family: var(--font-head);
}
.s2b-stat__label {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--ink);
  margin: 0 0 16px;
  letter-spacing: -0.01em;
}
.s2b-stat__desc {
  font-size: 0.9rem;
  line-height: 1.7;
  color: var(--body);
  margin: 0;
}

/* Seonex-style Dual-Element Blue Button */
.s2b-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  width: fit-content;
  margin-top: 20px;
}
.s2b-btn__text {
  background: #1446E8;
  color: #fff;
  font-size: 0.74rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  padding: 12px 24px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center;
  transition: background 0.25s var(--ease), transform 0.2s var(--ease);
  font-family: var(--font-head);
}
.s2b-btn__icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #1446E8;
  color: #fff;
  display: grid;
  place-items: center;
  flex-shrink: 0;
  transition: background 0.25s var(--ease), transform 0.3s var(--ease);
}
.s2b-btn__icon .ico {
  width: 14px;
  height: 14px;
  stroke: #fff;
}
.s2b-btn:hover .s2b-btn__text,
.s2b-btn:hover .s2b-btn__icon {
  background: #092688;
}
.s2b-btn:hover .s2b-btn__icon {
  transform: rotate(45deg);
}

@media (max-width: 992px) {
  .s2b-grid { grid-template-columns: 1fr; gap: 20px; }
  .s2b-card { height: auto; min-height: 380px; }
  .s2b-card--photo { aspect-ratio: 16/10; min-height: auto; }
}
</style>

<!-- ============ S3 STATEMENT + PROOF ============ -->
<section class="section">
  <div class="container">
    <p class="reveal reveal--wide">
      <?= reveal_words('We are a team of experienced engineers, security specialists, and automation experts dedicated to delivering reliable solutions for modern businesses.') ?>
    </p>
    <p class="measure center mx-auto" style="margin-top:26px">
      Every system we hand over is designed around the building it protects — surveyed first,
      engineered to the risk, and supported long after commissioning.
    </p>

    <div class="grid g-2 statement-pair" style="margin-top:56px">
      <div class="statement-photo">
        <?= img('app-in-hand.webp', 'Technician operating an access control terminal on site', 900, 720) ?>
      </div>
      <div class="quote-card">
        <?= icon('quote', 'ico--quote') ?>
        <p>The team scoped, installed and supported our whole site without a single delay — and the handover documentation was the best we have received.</p>
        <div class="quote-card__by">
          <?= img('avatar-samia.webp', 'Samia Ali', 52, 52) ?>
          <span><strong>Samia Ali</strong><span>Facility Supervisor</span></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ S4 SERVICES ACCORDION ============ -->
<section class="section">
  <div class="container">
    <h2 data-reveal style="max-width:16ch;margin-bottom:40px">Security &amp; Automation Services</h2>

    <div class="split split--b">
      <div data-acc="plain" data-acc-group="svc">
        <?php foreach ($services as $i => $s): ?>
        <div class="acc__row<?= $i === 0 ? ' is-open' : '' ?>" data-media="<?= e($s['slug']) ?>">
          <button type="button" class="acc__btn">
            <span class="acc__title"><?= e($s['title']) ?></span>
            <span class="acc__chip"><?= icon($i === 0 ? 'arrow' : 'chevron') ?></span>
          </button>
          <div class="acc__panel"><div>
            <div class="acc__body">
              <div>
                <p style="margin:0"><?= e($s['body']) ?></p>
                <ul class="check-list">
                  <?php foreach ($s['checks'] as $c): ?>
                  <li><?= icon('check') ?> <?= e($c) ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <?= img($s['thumb'], $s['title'] . ' thumbnail', 150, 150) ?>
            </div>
          </div></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="acc-media" data-acc-media="svc">
        <?php foreach ($services as $i => $s): ?>
          <?php
            $tag = img($s['image'], $s['title'], 620, 780);
            // tag the media element so JS can crossfade between them
            echo str_replace('class="', 'data-media-key="' . e($s['slug']) . '" class="' . ($i === 0 ? 'is-current ' : ''), $tag);
          ?>
        <?php endforeach; ?>
        <div class="acc-media__badge">
          <p class="n"><span data-count="66" data-suffix="%">0</span></p>
          <p class="l">Fewer security incidents</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ S5 DIAGONAL MARQUEE ============ -->
<div class="ticker" aria-hidden="true">
  <div class="ticker__band ticker__band--a">
    <div class="ticker__track">
      <?php for ($set = 0; $set < 2; $set++): foreach ($ticker as $t): ?>
        <span class="ticker__item"><span class="ticker__star">&#10033;</span><?= e($t) ?></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>
  <div class="ticker__band ticker__band--b">
    <div class="ticker__track">
      <?php for ($set = 0; $set < 2; $set++): foreach (array_reverse($ticker) as $t): ?>
        <span class="ticker__item"><span class="ticker__star">&#10033;</span><?= e($t) ?></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>
</div>

<!-- ============ S6 APPROACH ============ -->
<section class="section section--navy">
  <div class="container">
    <div class="center" style="max-width:60ch;margin-inline:auto;margin-bottom:56px">
      <span class="eyebrow">Driven by Precision. <em>Focused on Protection.</em></span>
      <h2>Custom security and automation solutions ensuring safety and efficiency.</h2>
    </div>

    <!-- 5-pill capsule photos gallery -->
    <div class="pill-gallery">
      <?php foreach ($capsules as $cap): ?>
      <div class="pill-card" title="<?= e($cap['title']) ?>">
        <?= img($cap['image'], $cap['title'], 320, 480) ?>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="approach__grid">
      <div>
        <p>
          We design around how your site actually operates — shift patterns, access routes,
          risk zones and the way people move through the building. The result is a system
          that gets used, not one that gets switched off after a month.
        </p>
        <div class="approach__years">
          <span class="n"><span data-count="7" data-suffix="+">0</span></span>
          <span style="font-weight:500;color:#fff">Years of<br>experience</span>
        </div>
      </div>

      <div>
        <?php foreach ($steps as $st): ?>
        <div class="step">
          <span class="step__no"><?= e($st['no']) ?></span>
          <span class="step__icon"><?= icon($st['icon']) ?></span>
          <div>
            <h4><?= e($st['title']) ?></h4>
            <p style="margin:0;font-size:.95rem"><?= e($st['text']) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Wide control room banner -->
    <div class="approach-banner">
      <?= img('band-surveillance.webp', 'Peace Automation Central Monitoring and Control Facility', 1320, 560) ?>
    </div>
  </div>
</section>

<!-- ============ S7 TEAM / EXPERTS ============ -->
<section class="section section--light team-section">
  <div class="container">
    <div class="center" style="max-width:60ch;margin-inline:auto;margin-bottom:60px">
      <span class="eyebrow">Meet Our Specialists — <em>Field Leadership</em></span>
      <h2 style="margin:0">Certified security engineers and automation experts</h2>
    </div>

    <div class="team-strip">
      <?php foreach ($team as $i => $m): ?>
      <div class="team-member" data-team-card>
        <div class="team-member__avatar">
          <?= img($m['avatar'], $m['name'], 140, 140) ?>
        </div>
        <h4 class="team-member__name"><?= e($m['name']) ?></h4>
        <p class="team-member__role"><?= e($m['role']) ?></p>
        <button class="team-member__plus" aria-label="View profile">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============ S8 FEATURE PROCESS / TIMELINE ============ -->
<section class="section">
  <div class="container">
    <div class="timeline-grid">
      <div class="timeline-media">
        <?= img('why-dome-camera.webp', 'Dome camera mounted on a building exterior', 700, 640) ?>
      </div>
      <div>
        <span class="eyebrow">Our Methodology — <em>Execution Cycle</em></span>
        <h2 style="margin-bottom:34px">How we secure your site from audit to live handover</h2>
        <div>
          <?php foreach ($timeline as $tl): ?>
          <div class="timeline-item">
            <div class="timeline-no"><?= e($tl['no']) ?></div>
            <div class="timeline-content">
              <h4><?= e($tl['title']) ?></h4>
              <p><?= e($tl['desc']) ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ S9 SMART SURVEILLANCE (pinned, scroll-driven rotation) ============ -->
<section class="surveillance">
  <div class="container surveillance__inner">

    <div class="surveillance__copy">
      <span class="eyebrow" style="color:rgba(255,255,255,.75)">AI-assisted monitoring</span>
      <h2>Smart Surveillance Systems</h2>
      <p style="color:var(--body-dim);max-width:46ch">
        Cameras specified for the job, positioned around real sightlines, and tuned so the
        footage is usable on the day somebody actually needs it.
      </p>
    </div>

    <!-- Static banner panel. Only the camera inside it turns as you scroll —
         two-sided so a full 360° reads as a solid object, not a flipping photo. -->
    <div class="surveillance__banner">
      <div class="spin" id="camSpin">
        <div class="spin__face spin__face--front">
          <?= img('surveillance-cam.webp', 'CCTV camera rotating through a full turn', 800, 800) ?>
        </div>
        <div class="spin__face spin__face--back" aria-hidden="true">
          <?= img('surveillance-cam.webp', '', 800, 800) ?>
        </div>
      </div>
      <span class="spin__hint" data-spin-hint>Keep scrolling</span>
    </div>

  </div>
</section>

<!-- ============ S10 PROJECTS ============ -->
<section class="section section--light">
  <div class="container">
    <div class="row-between" style="margin-bottom:44px">
      <div>
        <span class="eyebrow" data-reveal>Our Work — <em>Recent Deployments</em></span>
        <h2 data-reveal style="margin:0;max-width:16ch">Systems we designed and delivered</h2>
      </div>
      <a href="portfolio.php" data-reveal="right" class="btn btn--primary">View all projects <span class="btn__chip"><?= icon('arrow') ?></span></a>
    </div>

    <div class="grid g-3">
      <?php foreach ($projects as $p): ?>
      <a class="pcard" href="portfolio-detail.php?slug=<?= e($p['slug']) ?>">
        <div class="pcard__media"><?= img($p['image'], $p['title'], 520, 390) ?></div>
        <div class="pcard__body">
          <div class="pcard__meta">
            <span><?= e($p['category']) ?></span><span><?= e($p['location']) ?></span><span><?= e($p['year']) ?></span>
          </div>
          <h3><?= e($p['title']) ?></h3>
        </div>
        <div class="pcard__overlay">
          <div class="pcard__overlay-label">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 14L14 4M14 4H7M14 4V11" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <?= e($p['title']) ?>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ============ S11 REVIEWS ============ -->
<section class="section section--light reviews" style="padding-top:0">
  <div class="container">
    <div class="center" style="margin-bottom:44px">
      <span class="eyebrow">Client Feedback — <em>What They Say</em></span>
      <h2 style="margin:0">Trusted across every site we protect</h2>
    </div>

    <div class="reviews__wrap">

      <!-- Badge is the centre column of a 3-column grid and uses position:sticky.
           Sticky is bounded by its grid area, so it can never escape the section
           the way a GSAP pin did. -->
      <div class="reviews__badge">
        <p class="n"><span data-count="4.4" data-decimals="1">0</span>/5</p>
        <p class="s">(300+ reviews)</p>
        <hr>
        <p class="n" style="font-size:1.5rem"><span data-count="7" data-suffix="+">0</span></p>
        <p class="s">Years of Experience</p>
      </div>

      <?php foreach ($reviews as $r): ?>
      <div class="rcard">
        <div class="rcard__stars" aria-label="<?= (int) $r['stars'] ?> out of 5 stars">
          <?php for ($s = 0; $s < (int) $r['stars']; $s++) echo icon('star'); ?>
        </div>
        <p style="margin:0"><?= e($r['text']) ?></p>
        <div class="rcard__by">
          <?= img($r['avatar'], $r['name'], 46, 46) ?>
          <span><strong><?= e($r['name']) ?></strong><span><?= e($r['role']) ?></span></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ S11b CAMERA EYE BANNER ============ -->
<div class="eye-banner" id="eye-banner" aria-label="Camera surveillance banner">
  <div class="eye-banner__inner">
    <img class="eye-banner__img" src="<?= e(asset_v('images/cameras-banner.webp')) ?>" alt="Professional CCTV cameras installed on site" width="1600" height="600" loading="lazy">
    <div class="eye-banner__overlay"></div>
    <div class="eye-banner__content">
      <span class="eyebrow" style="color:var(--lime)">Always Watching — <em>Never Missing</em></span>
      <h2 style="color:#fff;margin:16px 0 24px;max-width:20ch">Every corner covered. Every moment recorded.</h2>
      <a href="contact.php" class="btn btn--primary">Get a free site survey <span class="btn__chip"><?= icon('arrow') ?></span></a>
    </div>
    <!-- Eye lid overlays — top and bottom clip from centre out -->
    <div class="eye-banner__lid eye-banner__lid--top" aria-hidden="true"></div>
    <div class="eye-banner__lid eye-banner__lid--bot" aria-hidden="true"></div>
  </div>
</div>

<!-- ============ S12 BLOG ============ -->
<section class="section">
  <div class="container">
    <div class="split split--c split--center">
      <div>
        <span class="eyebrow">Read Our — <em>News &amp; Blog</em></span>
        <h2>Stay updated with the latest insights</h2>
        <p class="measure">
          Practical guidance from the field — what works, what fails, and what to ask
          before you sign a security contract.
        </p>
        <a href="blog.php" class="btn btn--blue">View more <span class="btn__chip"><?= icon('arrow') ?></span></a>
      </div>

      <div>
        <div class="swiper" data-swiper="blog">
          <div class="swiper-wrapper">
            <?php foreach ($posts as $post): ?>
            <div class="swiper-slide">
              <article class="pcard">
                <a href="blog-detail.php?slug=<?= e($post['slug']) ?>" class="pcard__media">
                  <?= img($post['image'], $post['title'], 520, 390) ?>
                </a>
                <div class="pcard__body">
                  <div class="bcard__author" style="margin-bottom:12px">
                    <?= img('avatar-samia.webp', $post['author'], 30, 30) ?>
                    <span><?= e($post['author']) ?></span>
                  </div>
                  <div class="pcard__meta">
                    <span class="pill"><?= e($post['category']) ?></span>
                    <span><?= e(date('d M Y', strtotime($post['date']))) ?></span>
                  </div>
                  <h3 style="font-size:1.05rem">
                    <a href="blog-detail.php?slug=<?= e($post['slug']) ?>"><?= e($post['title']) ?></a>
                  </h3>
                </div>
              </article>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="swiper-nav" style="flex-direction:row;margin-top:20px">
          <button type="button" data-swiper-prev aria-label="Previous slide"><?= icon('chevron-left') ?></button>
          <button type="button" data-swiper-next aria-label="Next slide"><?= icon('chevron') ?></button>
        </div>
      </div>
    </div>
  </div>
</section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
