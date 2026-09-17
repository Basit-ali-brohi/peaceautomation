<?php
/**
 * Privacy policy.
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/includes/functions.php';

$pageTitle       = 'Privacy Policy | ' . site('name');
$metaDescription = 'How ' . site('name') . ' collects, uses and stores the information you share with us.';
$bannerTitle     = 'Privacy Policy';
$bannerSubtitle  = 'What we collect, why we collect it, and what we do with it.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/page-hero.php';
?>

<main id="main">
<section class="section-y section-light">
  <div class="container-x">
    <div class="max-w-3xl">
      <p class="text-sm mb-10" style="color:var(--body-dark); opacity:.7">
        Last updated <?= date('F Y') ?>
      </p>

      <?php
        $sections = [
          ['What we collect', 'When you submit an enquiry form we collect the name, phone number, email address, city and message you provide. We do not collect payment details through this website.'],
          ['Why we collect it', 'Solely to respond to your enquiry, arrange a site survey, and provide a quote. We do not sell, rent or share your details with third parties for marketing.'],
          ['CCTV footage', 'We do not have access to footage from systems we install unless you explicitly grant it for support purposes. Recordings stay on your recorder, under your control.'],
          ['How long we keep it', 'Enquiry records are kept while your enquiry is active and for a reasonable period afterwards for warranty and service history. You can ask us to delete them at any time.'],
          ['Cookies', 'This site uses only what is required to keep your session working. We do not run advertising trackers.'],
          ['Your rights', 'You can ask what we hold about you, ask us to correct it, or ask us to delete it. Email us and we will action it.'],
        ];
        foreach ($sections as $i => $s):
      ?>
      <div class="mb-10">
        <h2 class="mb-4" style="font-size:1.5rem"><?= htmlspecialchars($s[0]) ?></h2>
        <p class="measure" style="color:var(--body-dark)"><?= htmlspecialchars($s[1]) ?></p>
      </div>
      <?php endforeach; ?>

      <div class="rounded-2xl p-7 mt-12" style="background:var(--bg-light-2); border:1px solid var(--border-light)">
        <p class="font-semibold mb-2" style="color:var(--heading-dark)">Questions about your data?</p>
        <p class="text-sm mb-4" style="color:var(--body-dark)">Write to us and we will respond within a few working days.</p>
        <a href="mailto:<?= htmlspecialchars(site('email')) ?>" class="font-semibold text-sm" style="color:var(--accent-2)">
          <?= htmlspecialchars(site('email')) ?>
        </a>
      </div>
    </div>
  </div>
</section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
