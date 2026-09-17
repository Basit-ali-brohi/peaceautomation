<?php
/**
 * Case study detail. Looks the project up by slug; unknown slugs fall back
 * to the first.
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/includes/functions.php';

$projects = data('projects');
$project  = find_by_slug('projects', isset($_GET['slug']) ? (string) $_GET['slug'] : '') ?? $projects[0];

$useTailwind    = false;
$pageTitle      = $project['title'] . ' | ' . cfg('name');
$pageDesc       = $project['summary'];
$eyebrowText    = 'Case Study · ' . $project['category'];
$bannerTitle    = $project['title'];
$bannerSubtitle = $project['summary'];
$bannerImage    = $project['image'];
$bannerPill     = $project['client'];
$bannerBadgeNum = $project['year'] ?? '2024';
$bannerBadgeLabel = 'Verified<br>Deployment';
$bannerCtaText  = 'Start Similar Project';
$bannerCtaHref  = 'contact.php';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/page-hero.php';

$others = array_values(array_filter($projects, fn($p) => $p['slug'] !== $project['slug']));

$facts = [
    ['icon' => 'pin',    'label' => 'Client',   'value' => $project['client']],
    ['icon' => 'grid',   'label' => 'Category', 'value' => $project['category']],
    ['icon' => 'pin',    'label' => 'Location', 'value' => $project['location']],
    ['icon' => 'clock',  'label' => 'Year',     'value' => $project['year']],
    ['icon' => 'camera', 'label' => 'Scale',    'value' => $project['cameras']],
    ['icon' => 'cpu',    'label' => 'Hardware', 'value' => $project['hardware']],
];
?>

<main id="main">
<section class="section section--light">
  <div class="container">

    <div class="zoom-frame" style="aspect-ratio:16/7;margin-bottom:44px">
      <?= img($project['image'], $project['title'], 1320, 578, ['eager' => true]) ?>
    </div>

    <div class="split split--sidebar-wide">

      <article>
        <h2 style="font-size:1.9rem;margin-bottom:1rem">Project overview</h2>
        <p class="measure" style="color:var(--body-dark);margin-bottom:1.35rem"><?= e($project['summary']) ?></p>
        <p class="measure" style="color:var(--body-dark);margin-bottom:2.5rem">
          The work was surveyed before a single price was quoted, phased so the site kept
          operating throughout, and handed over commissioned, tested and documented — with
          the recording schedule, retention figures and device list written down rather than
          left in someone's head.
        </p>

        <h2 style="font-size:1.9rem;margin-bottom:1.25rem">What we delivered</h2>
        <ul class="check-grid">
          <?php foreach ([
            'Full site survey and coverage plan agreed with the client',
            'Concealed cabling, labelled at both ends',
            'Recorder sizing for the agreed retention window',
            'Remote access configured and tested on site',
            'Commissioning test report at handover',
            'Scheduled service visits in the first year',
          ] as $d): ?>
          <li>
            <span class="check-bullet"><?= icon('check') ?></span><?= e($d) ?>
          </li>
          <?php endforeach; ?>
        </ul>

        <h2 style="font-size:1.9rem;margin-bottom:1.25rem">Other projects</h2>
        <div class="card-grid">
          <?php foreach ($others as $o): ?>
          <a class="pcard" href="portfolio-detail.php?slug=<?= e($o['slug']) ?>">
            <div class="pcard__media"><?= img($o['image'], $o['title'], 520, 390) ?></div>
            <div class="pcard__body">
              <div class="pcard__meta">
                <span><?= e($o['category']) ?></span><span><?= e($o['year']) ?></span>
              </div>
              <h3 style="font-size:1.05rem"><?= e($o['title']) ?></h3>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </article>

      <aside style="position:sticky;top:120px">
        <div class="side-card">
          <h4 class="side-card__title">Project facts</h4>
          <ul class="fact-list">
            <?php foreach ($facts as $f): ?>
            <li>
              <span class="icon-circle icon-circle--soft" style="width:36px;height:36px;flex:0 0 36px"><?= icon($f['icon']) ?></span>
              <span>
                <span class="fact-list__label"><?= e($f['label']) ?></span>
                <span class="fact-list__value"><?= e($f['value']) ?></span>
              </span>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="side-card side-card--dark">
          <p class="side-card__title">Similar site to protect?</p>
          <p style="font-size:.88rem;margin-bottom:18px">
            Free survey, honest quote, and a straight answer on what you do and do not need.
          </p>
          <a href="contact.php" class="btn btn--primary" style="width:100%;justify-content:center">
            Book a survey <span class="btn__chip"><?= icon('arrow') ?></span>
          </a>
        </div>
      </aside>

    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/cta.php'; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
