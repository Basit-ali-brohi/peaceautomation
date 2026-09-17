<?php
/**
 * Blog article. Looks the post up by slug; unknown slugs fall back to the first.
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/includes/functions.php';

$posts = data('blog');
$post  = find_by_slug('blog', isset($_GET['slug']) ? (string) $_GET['slug'] : '') ?? $posts[0];

$useTailwind     = false;
$pageTitle       = $post['title'] . ' | ' . cfg('name');
$pageDesc        = $post['excerpt'];
$eyebrowText     = 'Engineering Guide · ' . $post['category'];
$bannerTitle     = $post['title'];
$bannerSubtitle  = $post['excerpt'];
$bannerImage     = $post['image'];
$bannerPill      = '5 Min Read';
$bannerBadgeNum  = 'Peace';
$bannerBadgeLabel= 'Technical<br>Editorial';
$bannerCtaText   = 'Book a Free Survey';
$bannerCtaHref   = 'contact.php';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-hero.php';

$others = array_values(array_filter($posts, fn($p) => $p['slug'] !== $post['slug']));
?>

<main id="main">
<section class="section section--light">
  <div class="container">
    <div class="split split--sidebar">

      <article>
        <div class="zoom-frame" style="aspect-ratio:16/9;margin-bottom:34px">
          <?= img($post['image'], $post['title'], 900, 506) ?>
        </div>

        <div class="pcard__meta" style="margin-bottom:22px">
          <span class="pill"><?= e($post['category']) ?></span>
          <span><?= e(date('d M Y', strtotime($post['date']))) ?></span>
          <span><?= e($post['author']) ?></span>
        </div>

        <?php foreach (explode('|', $post['body']) as $para): ?>
          <p class="measure" style="color:var(--body-dark);margin-bottom:1.35rem"><?= e(trim($para)) ?></p>
        <?php endforeach; ?>

        <div class="prose-block">
          <h3 style="font-size:1.15rem;margin-bottom:.5rem">Want this specced for your site?</h3>
          <p style="font-size:.9rem;color:var(--body-dark);margin-bottom:1.25rem">
            A free survey answers most of this in half an hour, on your premises.
          </p>
          <a href="contact.php" class="btn btn--primary">
            Book a free survey <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
        </div>
      </article>

      <aside style="position:sticky;top:120px">
        <div class="side-card">
          <h4 class="side-card__title">More articles</h4>
          <ul class="side-list">
            <?php foreach ($others as $o): ?>
            <li>
              <a href="blog-detail.php?slug=<?= e($o['slug']) ?>">
                <span class="side-list__thumb zoom-frame"><?= img($o['image'], $o['title'], 128, 96) ?></span>
                <span class="side-list__text"><?= e($o['title']) ?></span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="side-card side-card--dark">
          <p class="side-card__title">Talk to an engineer</p>
          <p style="font-size:.88rem;margin-bottom:18px">Not a call centre — you get someone who does the installs.</p>
          <a href="tel:<?= e(cfg('phone_href')) ?>" style="color:var(--lime);font-weight:700">
            <?= e(cfg('phone')) ?>
          </a>
        </div>
      </aside>

    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/cta.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
