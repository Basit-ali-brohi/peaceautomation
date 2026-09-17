<?php
/**
 * Shared inner-page hero: Seonex style 2-column layout with banner image,
 * floating glassmorphism pill, and floating lime stat badge.
 *
 * Supported variables:
 * - $bannerTitle: Page title
 * - $eyebrowText: Eyebrow text above title
 * - $bannerSubtitle: Short description
 * - $bannerImage: Image filename (relative to assets/images/)
 * - $bannerPill: Pill text
 * - $bannerBadgeNum: Stat number (e.g. 7+, 100%, 4.9)
 * - $bannerBadgeLabel: Stat label
 * - $bannerCtaText: Button text
 * - $bannerCtaHref: Button link
 */

$heroImg        = $bannerImage ?? 'cameras-banner.webp';
$heroEyebrow    = $eyebrowText ?? 'Peace Automation — Karachi';
$heroTitle      = $bannerTitle ?? 'Security & Automation';
$heroPill       = $bannerPill ?? 'ISO-Certified Installation';
$heroBadgeN     = $bannerBadgeNum ?? '7+';
$heroBadgeL     = $bannerBadgeLabel ?? "Years of<br>Excellence";
$heroBtnText    = $bannerCtaText ?? 'Get a free quote';
$heroBtnHref    = $bannerCtaHref ?? 'contact.php';
?>
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)"><?= e($heroEyebrow) ?></span>
      <h1><?= e($heroTitle) ?></h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span><?= e($heroTitle) ?></span>
      </nav>
      <?php if (!empty($bannerSubtitle)): ?>
        <p style="color:rgba(255,255,255,0.72); font-size:0.95rem; line-height:1.65; margin:16px 0 0; max-width:500px;">
          <?= e($bannerSubtitle) ?>
        </p>
      <?php endif; ?>
      <a href="<?= e($heroBtnHref) ?>" class="btn btn--primary" style="margin-top:28px">
        <?= e($heroBtnText) ?> <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img($heroImg, $heroTitle, 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n"><?= e($heroBadgeN) ?></span><span class="l"><?= $heroBadgeL ?></span></div>
      <div class="svc-hero__pill"><?= icon('shield') ?><span><?= e($heroPill) ?></span></div>
    </div>
  </div>
</section>
