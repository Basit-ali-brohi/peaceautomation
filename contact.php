<?php
/**
 * Contact — enquiry form (posts to api/contact.php), map, contact cards.
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/includes/functions.php';

$useTailwind    = false;
$pageTitle      = 'Contact Us | ' . cfg('name');
$pageDesc       = 'Book a free site survey in Karachi. Call, WhatsApp or send an enquiry and we will get back to you within one business day.';
$eyebrowText    = 'Let’s Discuss Your Facility — Free Site Survey';
$bannerTitle    = 'Contact Our Team';
$bannerSubtitle = 'Tell us about your premises and security requirements. Our senior systems engineers conduct on-site audits and provide documented solutions.';

require __DIR__ . '/includes/header.php';
?>

<!-- ============ CONTACT HERO (Seonex Style) ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Let's Discuss Your Site — <em>Free Survey</em></span>
      <h1>Request Your Free<br>On-Site Risk<br>Assessment</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>Contact</span>
      </nav>
      <a href="#contact-form" class="btn btn--primary" style="margin-top:32px">
        Fill Enquiry Form <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('tech-warehouse-cam.webp', 'Dome surveillance camera monitoring industrial facility', 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">FREE</span><span class="l">On-Site<br>Survey</span></div>
      <div class="svc-hero__pill"><?= icon('clock') ?><span>1 Business Day Response</span></div>
    </div>
  </div>
</section>

<?php
$services = data('services');
$selectedService = $_GET['service'] ?? $_GET['sector'] ?? $_GET['product'] ?? '';
?>

<main id="main">

<section class="section">
  <div class="container">
    <div class="split split--a">

      <!-- Form -->
      <div>
        <span class="eyebrow">Send an enquiry — <em>We reply within one business day</em></span>
        <h2 style="margin-bottom:28px">Request your free site survey</h2>

        <form id="contact-form" novalidate>
          <?= csrf_field() ?>
          <div class="hp"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

          <div class="form-note" id="contact-note" role="status" aria-live="polite"></div>

          <div class="grid g-2" style="gap:0 20px">
            <div class="field">
              <label for="c-name">Your name <span aria-hidden="true" style="color:var(--orange)">*</span></label>
              <input type="text" id="c-name" name="name" autocomplete="name" required>
              <p class="field__err"></p>
            </div>
            <div class="field">
              <label for="c-phone">Phone <span aria-hidden="true" style="color:var(--orange)">*</span></label>
              <input type="tel" id="c-phone" name="phone" autocomplete="tel" placeholder="03XX XXXXXXX" required>
              <p class="field__err"></p>
            </div>
            <div class="field">
              <label for="c-email">Email</label>
              <input type="email" id="c-email" name="email" autocomplete="email">
              <p class="field__err"></p>
            </div>
            <div class="field">
              <label for="c-city">City <span aria-hidden="true" style="color:var(--orange)">*</span></label>
              <input type="text" id="c-city" name="city" autocomplete="address-level2" value="Karachi" required>
              <p class="field__err"></p>
            </div>
          </div>

          <div class="field">
            <label for="c-service">Service needed <span aria-hidden="true" style="color:var(--orange)">*</span></label>
            <select id="c-service" name="service" required>
              <option value="">Select a service…</option>
              <?php foreach ($services as $s): ?>
              <option value="<?= e($s['title']) ?>" <?= (stripos($selectedService, $s['title']) !== false || stripos($s['title'], $selectedService) !== false) && !empty($selectedService) ? 'selected' : '' ?>><?= e($s['title']) ?></option>
              <?php endforeach; ?>
            </select>
            <p class="field__err"></p>
          </div>

          <div class="field">
            <label for="c-message">Tell us about the site <span aria-hidden="true" style="color:var(--orange)">*</span></label>
            <textarea id="c-message" name="message" rows="5" required
                      placeholder="Size of the premises, how many entrances, anything already installed…"></textarea>
            <p class="field__err"></p>
          </div>

          <button type="submit" class="btn btn--primary btn--hero-compact">
            SEND ENQUIRY <span class="btn__chip"><?= icon('arrow') ?></span>
          </button>
        </form>
      </div>

      <!-- Contact cards -->
      <aside>
        <div class="card-navy" style="margin-bottom:20px">
          <h3 style="font-size:1.25rem">Prefer to talk?</h3>
          <p style="font-size:.95rem;margin-bottom:22px">
            Call during working hours and you will get an engineer, not a call centre.
          </p>
          <ul class="footer__contact" style="margin-bottom:22px">
            <li><span class="ico-wrap"><?= icon('phone') ?></span>
              <a href="tel:<?= e(cfg('phone_href')) ?>" style="color:#fff;font-weight:600"><?= e(cfg('phone')) ?></a></li>
            <li><span class="ico-wrap"><?= icon('mail') ?></span>
              <a href="mailto:<?= e(cfg('email')) ?>" style="color:#fff"><?= e(cfg('email')) ?></a></li>
            <li><span class="ico-wrap"><?= icon('pin') ?></span><span><?= e(cfg('address')) ?></span></li>
            <li><span class="ico-wrap"><?= icon('clock') ?></span><span><?= e(cfg('hours')) ?></span></li>
          </ul>
          <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener" class="btn btn--primary"
             style="background:#25D366;width:100%;justify-content:center">
            Chat on WhatsApp <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
        </div>

        <div style="border:1px solid var(--line);border-radius:var(--r-card);overflow:hidden">
          <iframe
            title="Peace Automation office location on Google Maps"
            src="https://www.google.com/maps?q=Gulshan-e-Iqbal,+Karachi,+Pakistan&output=embed"
            width="100%" height="320" style="border:0;display:block" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </aside>

    </div>
  </div>
</section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
