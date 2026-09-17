<?php
/**
 * S13 client strip + S14 footer + floating actions + scripts.
 * Pages can set $hideClients = true to drop the logo strip.
 */
$clients = data('clients');
$svc     = data('services');
?>

<?php if (empty($hideClients)): ?>
<!-- ============ S13 CLIENTS ============ -->
<section class="client-strip">
  <div class="container">
    <h2 class="center" style="margin-bottom:44px">Connect With Our Clients Across Pakistan</h2>
  </div>
  <!-- Full-bleed track with a soft mask at both ends, so logos fade out
       instead of being sliced by the container edge. -->
  <div class="clients-marquee">
    <div class="clients">
      <?php
        // Skip any logo whose file is missing rather than rendering an empty box.
        $shown = array_filter($clients, fn($c) => is_file(__DIR__ . '/../' . asset('images/' . $c['logo'])));
        // Repeat enough times that the track is always wider than the viewport.
        for ($set = 0; $set < 4; $set++):
          foreach ($shown as $c):
      ?>
        <span class="client-logo" <?= $set > 0 ? 'aria-hidden="true"' : '' ?>>
          <?= img($c['logo'], e($c['name']) . ' logo', 320, 160) ?>
        </span>
      <?php
          endforeach;
        endfor;
      ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (empty($hideConnect)): ?>
<!-- ============ S13 LET'S CONNECT TOGETHER ============ -->
<section class="cta-connect">
  <div class="container cta-connect__inner">
    <div class="cta-connect__copy">
      <h2 class="cta-connect__heading">
        <span class="cta-connect__row1">Let's Connect</span>
        <span class="cta-connect__row2">
          <span class="cta-connect__capsule">
            <img src="<?= e(asset('images/cta-capsule.webp')) ?>" alt="Peace Automation Team">
          </span>
          <span class="cta-connect__together">together</span>
        </span>
      </h2>
    </div>
    <div class="cta-connect__action">
      <a href="contact.php" class="btn-circle-lime" aria-label="Let's Talk">
        <svg class="cta-arrow" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <line x1="7" y1="17" x2="17" y2="7"></line>
          <polyline points="7 7 17 7 17 17"></polyline>
        </svg>
        <span class="cta-label">Let's Talk</span>
      </a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ S14 FOOTER ============ -->
<footer class="footer">
  <div class="footer__aurora" aria-hidden="true"></div>
  <div class="container">
    <div class="footer__grid">

      <!-- Column 1: Brand & Logo -->
      <div class="footer__col footer__col--brand">
        <a href="index.php" class="footer__brand" aria-label="<?= e(cfg('name')) ?> home">
          <span class="logo__mark">
            <?= icon('shield') ?>
          </span>
          <span class="footer__brand-text"><?= e(cfg('name')) ?></span>
        </a>
      </div>

      <!-- Column 2: Services -->
      <div class="footer__col">
        <h4>Services</h4>
        <ul class="footer__links">
          <?php foreach (array_slice($svc, 0, 5) as $s): ?>
          <li><a href="service-detail.php?slug=<?= e($s['slug']) ?>"><?= e($s['title']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Column 3: Our Company -->
      <div class="footer__col">
        <h4>Our Company</h4>
        <ul class="footer__links">
          <li><a href="about.php">Company History</a></li>
          <li><a href="about.php#team">Team Members</a></li>
          <li><a href="portfolio.php">Latest Cases</a></li>
          <li><a href="career.php">Need a Careers</a></li>
          <li><a href="blog.php">Articles &amp; news</a></li>
        </ul>
      </div>

      <!-- Column 4: Newsletter -->
      <div class="footer__col">
        <h4>Newsletter</h4>
        <p class="footer__nl-desc">Stay ahead in the digital world by subscribing to our newsletter.</p>
        <form id="newsletter-form" novalidate>
          <?= csrf_field() ?>
          <div class="hp"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
          <div class="form-note" id="nl-note" role="status"></div>
          <div class="footer__nl-box">
            <input type="email" id="nl-email" name="email" placeholder="Email address*" required autocomplete="email">
            <button type="submit" aria-label="Subscribe" class="footer__nl-btn">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none" aria-hidden="true">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
              </svg>
            </button>
          </div>
          <label class="footer__consent">
            <input type="checkbox" name="consent" required checked>
            <span class="footer__consent-bullet"></span>
            <span>I hereby accept all terms &amp; conditions.</span>
          </label>
        </form>
      </div>

      <!-- Column 5: Contact Us -->
      <div class="footer__col">
        <h4>Contact Us</h4>
        <ul class="footer__contacts">
          <li class="footer__contact-row">
            <span class="f-ico-box"><?= icon('pin') ?></span>
            <div class="f-contact-txt">
              <span><?= e(cfg('address')) ?></span>
            </div>
          </li>
          <li class="footer__contact-row">
            <span class="f-ico-box"><?= icon('mail') ?></span>
            <div class="f-contact-txt">
              <a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a>
              <a href="index.php" class="f-sublink">www.peaceautomation.com</a>
            </div>
          </li>
          <li class="footer__contact-row">
            <span class="f-ico-box"><?= icon('phone') ?></span>
            <div class="f-contact-txt">
              <a href="tel:<?= e(cfg('phone_href')) ?>"><?= e(cfg('phone')) ?></a>
              <a href="tel:+922134980000" class="f-sublink">+92 21 3498 0000</a>
            </div>
          </li>
        </ul>
      </div>

    </div>

    <!-- Bottom bar: Links on Left, Copyright on Right -->
    <div class="footer__bottom">
      <div class="footer__bottom-nav">
        <a href="index.php" class="is-active">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">Service</a>
        <a href="privacy.php">Privacy</a>
        <a href="faqs.php">FAQs</a>
      </div>
      <div class="footer__copyright">
        Copyright&copy; <?= date('Y') ?> <strong class="text-lime"><?= e(cfg('name')) ?></strong>. All Rights Reserved.
      </div>
    </div>
  </div>
</footer>

<div class="fab-stack">
  <a href="<?= e(whatsapp_link()) ?>" class="fab fab--wa" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
    <?= icon('whatsapp') ?>
  </a>
  <button type="button" class="fab fab--top" id="back-to-top" aria-label="Back to top">
    <?= icon('arrow-up') ?>
  </button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.1.14/swiper-bundle.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.1.14/swiper-bundle.min.css">
<script src="<?= e(asset_v('js/main.js')) ?>" defer></script>
<script src="<?= e(asset_v('js/shop.js')) ?>" defer></script>
</body>
</html>
