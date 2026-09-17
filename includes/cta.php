<?php
/**
 * Closing CTA band — used by blog-detail.php and portfolio-detail.php.
 *
 * Styles live in style.css (.cta-band). The glow is clipped by the section
 * itself, so it can never widen the page on a phone.
 */
?>
<!-- ============ CLOSING CTA BAND ============ -->
<section class="cta-band">
  <span class="cta-band__glow" aria-hidden="true"></span>

  <div class="container cta-band__inner">
    <span class="eyebrow" style="color:var(--lime)">Free Site Survey — <em>No Obligation</em></span>
    <h2>Let's secure<br><span>your place</span></h2>
    <p>Tell us what the site is and we will tell you what it actually needs — in writing, before anyone quotes a price.</p>

    <div class="cta-band__actions">
      <a href="contact.php" class="btn btn--primary">
        Talk to us <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
      <a href="tel:<?= e(cfg('phone_href')) ?>" class="cta-band__phone">
        <?= icon('phone') ?><?= e(cfg('phone')) ?>
      </a>
    </div>

    <p class="cta-band__hours"><?= e(cfg('hours')) ?></p>
  </div>
</section>
