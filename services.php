<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Security & Automation Services | Peace Automation';
$pageDesc  = 'Professional CCTV surveillance, fire alarm, access control, intrusion detection and building automation services across Karachi.';
$useTailwind = false;

$services = data('services');
require_once __DIR__ . '/includes/header.php';
?>
<main id="main">

<!-- ============ SV1 HERO ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Certified Engineers — <em>Karachi's Trusted Installer</em></span>
      <h1>Security-Driven<br>Professional<br>Services</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>Services</span>
      </nav>
      <a href="contact.php" class="btn btn--primary" style="margin-top:32px">
        Get a free quote <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('service-cctv.webp','CCTV surveillance camera installation',660,480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">7+</span><span class="l">Years of<br>Excellence</span></div>
      <div class="svc-hero__pill"><?= icon('shield') ?><span>ISO-Certified Installation</span></div>
    </div>
  </div>
</section>

<!-- ============ SV2 INTRO 3-COL ============ -->
<section class="section">
  <div class="container">
    <div class="center" style="margin-bottom:52px">
      <span class="eyebrow">Real results. <em>Proven performance.</em></span>
      <h2 style="max-width:26ch;margin:14px auto 0">We believe safety comes from precision, not guesswork.</h2>
    </div>
    <div class="svc-intro-grid">
      <div class="svc-intro-card svc-intro-card--dark">
        <?= icon('shield','svc-intro-icon') ?>
        <h3>Protecting businesses,<br>one system at a time.</h3>
        <p>Every installation is surveyed, engineered to risk, and supported long after commissioning.</p>
        <ul class="svc-checks">
          <li><?= icon('check') ?> End-to-End Security Solutions</li>
          <li><?= icon('check') ?> Smart Strategies. Reliable Results.</li>
          <li><?= icon('check') ?> Helping Businesses Stay Safe</li>
        </ul>
      </div>
      <div class="svc-intro-card svc-intro-card--photo">
        <?= img('service-access-control.webp','Access control installation',420,520) ?>
      </div>
      <div class="svc-intro-card svc-intro-card--stat">
        <div class="svc-intro-stat">
          <span class="svc-intro-stat__n"><span data-count="97" data-suffix="%">0%</span></span>
          <span class="svc-intro-stat__l">Client retention rate</span>
        </div>
        <hr style="border:0;border-top:1px solid var(--line);margin:24px 0">
        <p style="color:var(--body);font-size:.95rem;line-height:1.7;margin-bottom:28px">
          We help buildings stay secure, engage the right protection, and convert threats into zero incidents.
        </p>
        <a href="contact.php" class="btn btn--primary">Get started <span class="btn__chip"><?= icon('arrow') ?></span></a>
      </div>
    </div>
  </div>
</section>

<!-- ============ SV3 STACKING SCROLL CARDS ============ -->
<section class="section section--light svc-stack-section">
  <div class="container">
    <div class="center" style="margin-bottom:60px">
      <span class="eyebrow">Smart Digital Services. <em>Measurable Results.</em></span>
      <h2 style="max-width:22ch;margin:14px auto 0">We provide high-quality security &amp; automation services</h2>
    </div>
    <div class="svc-stack" id="svcStack">
      <?php $stackNums=['01','02','03','04']; foreach(array_slice($services,0,4) as $i=>$s): ?>
      <div class="svc-card" data-svc-card="<?= $i ?>">
        <div class="svc-card__left">
          <span class="svc-card__num"><?= $stackNums[$i] ?></span>
          <div class="svc-card__text">
            <h3 class="svc-card__title"><?= e($s['title']) ?></h3>
            <p class="svc-card__body"><?= e($s['body']) ?></p>
            <ul class="svc-card__checks">
              <?php foreach($s['checks'] as $c): ?><li><?= icon('check') ?> <?= e($c) ?></li><?php endforeach; ?>
            </ul>
            <a href="service-detail.php?slug=<?= e($s['slug']) ?>" class="svc-card__link">
              Read more <?= icon('arrow') ?>
            </a>
          </div>
        </div>
        <div class="svc-card__right">
          <?= img($s['image'],$s['title'],540,380) ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SV2.5 EXPERIENCE HIGHLIGHT ============ -->
<section class="svc-exp-section">
  <div class="container">
    <h2 class="svc-exp-title">Let's create the best security experience for your project</h2>
    
    <div class="svc-exp-grid">
      <div class="svc-exp-left">
        <div class="svc-exp-small-img">
          <?= img('service-thumb-attendance.webp', 'Time attendance', 300, 400) ?>
        </div>
        <div class="svc-exp-content">
          <p class="svc-exp-desc">Advanced Automation helps your facility operate seamlessly with trusted and secure access.</p>
          <ul class="svc-checks">
            <li><?= icon('check') ?> Targeted Security Selection</li>
            <li><?= icon('check') ?> Threat Awareness &amp; Growth</li>
            <li><?= icon('check') ?> Cross-Platform Management</li>
            <li><?= icon('check') ?> Strategy &amp; Collaboration</li>
          </ul>
          <a href="contact.php" class="btn btn--primary btn--exp">
            READ MORE <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
        </div>
      </div>
      
      <div class="svc-exp-right">
        <?= img('service-cctv.webp', 'CCTV Monitoring', 550, 750) ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ SV4 ALL SERVICES GRID ============ -->
<section class="section">
  <div class="container">
    <div class="row-between" style="margin-bottom:44px">
      <div>
        <span class="eyebrow">Full Range — <em>All Services</em></span>
        <h2 style="margin:10px 0 0;max-width:20ch">Every system your building needs</h2>
      </div>
      <a href="contact.php" class="btn btn--primary">Book a survey <span class="btn__chip"><?= icon('arrow') ?></span></a>
    </div>
    <div class="svc-all-grid">
      <?php foreach($services as $s): ?>
      <a class="svc-all-card" href="service-detail.php?slug=<?= e($s['slug']) ?>">
        <div class="svc-all-card__img"><?= img($s['image'],$s['title'],400,280) ?></div>
        <div class="svc-all-card__body">
          <h3><?= e($s['title']) ?></h3>
          <p><?= e($s['short']) ?></p>
          <span class="svc-all-card__arrow"><?= icon('arrow') ?></span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</main>

<script>
(function(){
  'use strict';
  if(!window.gsap||!window.ScrollTrigger)return;
  gsap.registerPlugin(ScrollTrigger);

  /* ---- SV1 HERO entrance ---- */
  var heroCopy    = document.querySelector('.svc-hero__copy');
  var heroCollage = document.querySelector('.svc-hero__collage');
  if(heroCopy){
    gsap.from(heroCopy,{x:-60,opacity:0,duration:0.9,ease:'power3.out',delay:0.2});
  }
  if(heroCollage){
    gsap.from(heroCollage,{x:60,opacity:0,duration:0.9,ease:'power3.out',delay:0.35});
  }

  /* ---- SV2 INTRO 3-COLUMN slide-in ---- */
  var introGrid = document.querySelector('.svc-intro-grid');
  if(introGrid){
    var darkCard  = introGrid.querySelector('.svc-intro-card--dark');
    var photoCard = introGrid.querySelector('.svc-intro-card--photo');
    var statCard  = introGrid.querySelector('.svc-intro-card--stat');

    /* Dark card — slides in from LEFT */
    if(darkCard){
      gsap.from(darkCard,{
        x:-80, opacity:0, duration:0.85, ease:'power3.out',
        scrollTrigger:{trigger:introGrid,start:'top 82%',once:true}
      });
    }
    /* Photo card — scales + fades up from bottom */
    if(photoCard){
      gsap.from(photoCard,{
        y:60, scale:0.94, opacity:0, duration:0.85, ease:'power3.out',
        scrollTrigger:{trigger:introGrid,start:'top 82%',once:true},
        delay:0.12
      });
    }
    /* Stat card — slides in from RIGHT */
    if(statCard){
      gsap.from(statCard,{
        x:80, opacity:0, duration:0.85, ease:'power3.out',
        scrollTrigger:{trigger:introGrid,start:'top 82%',once:true},
        delay:0.22
      });
    }
  }

  /* ---- SV2.5 EXPERIENCE HIGHLIGHT ---- */
  var expSection = document.querySelector('.svc-exp-section');
  if(expSection){
    var expTitle = expSection.querySelector('.svc-exp-title');
    var expLeft  = expSection.querySelector('.svc-exp-left');
    var expRight = expSection.querySelector('.svc-exp-right');
    var expPImg  = expSection.querySelector('.svc-exp-right img');

    /* 1. Entrance Animations (Sides & Fade Up) */
    if(expTitle){
      gsap.from(expTitle, {
        y:40, opacity:0, duration:0.8, ease:'power3.out',
        scrollTrigger:{trigger:expSection, start:'top 85%', once:true}
      });
    }
    if(expLeft){
      gsap.from(expLeft, {
        x:-80, opacity:0, duration:0.85, ease:'power3.out',
        scrollTrigger:{trigger:expSection, start:'top 75%', once:true}
      });
    }
    if(expRight){
      gsap.from(expRight, {
        x:80, opacity:0, duration:0.85, ease:'power3.out',
        scrollTrigger:{trigger:expSection, start:'top 75%', once:true}
      });
    }

    /* 2. Parallax Image (Moves up/down while scrolling) */
    if(expPImg){
      gsap.to(expPImg, {
        yPercent: 15, /* moves image down by 15% as user scrolls down */
        ease: 'none',
        scrollTrigger: {
          trigger: expRight,
          start: 'top bottom', /* starts when top of container hits bottom of screen */
          end: 'bottom top',   /* ends when bottom of container hits top of screen */
          scrub: true          /* ties movement directly to scrollbar */
        }
      });
    }
  }

  /* ---- SV3 STACKING CARDS (overlap on scroll) ---- */
  var cards=document.querySelectorAll('.svc-card');
  cards.forEach(function(card,i){
    /* Previous card shrinks as next slides in */
    if(i<cards.length-1){
      gsap.to(card,{
        scale:0.93, yPercent:-4, opacity:0.5, ease:'none',
        scrollTrigger:{trigger:cards[i+1],start:'top 72%',end:'top 20%',scrub:1.2}
      });
    }
    /* Each card slides up into view */
    gsap.from(card,{
      y:80, opacity:0, duration:0.75, ease:'power2.out',
      scrollTrigger:{trigger:card,start:'top 88%',once:true}
    });
  });

  /* ---- SV4 ALL SERVICES GRID — stagger up ---- */
  var allCards=document.querySelectorAll('.svc-all-card');
  if(allCards.length){
    gsap.from(allCards,{
      y:50, opacity:0, duration:0.6, ease:'power2.out',
      stagger:0.08,
      scrollTrigger:{trigger:'.svc-all-grid',start:'top 85%',once:true}
    });
  }

})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
