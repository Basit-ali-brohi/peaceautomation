<?php
/**
 * <head> + preloader + sticky header + mega dropdown + mobile drawer.
 *
 * Pages set these before including:
 *   $page        — page key for nav highlighting (optional, falls back to filename)
 *   $pageTitle   — <title>
 *   $pageDesc    — meta description
 *   $useTailwind — set false on pages already migrated to custom CSS.
 *                  Legacy pages leave it unset and keep the Tailwind CDN.
 */

$pageTitle ??= cfg('name') . ' | ' . cfg('tagline');
$pageDesc  ??= 'CCTV surveillance, fire alarm, fire fighting, access control and building automation systems — surveyed, installed and maintained across Karachi by ' . cfg('name') . '.';
$useTailwind = $useTailwind ?? true;

require_once __DIR__ . '/shop.php';

$navServices = data('services');
$canonical   = rtrim((string) cfg('url'), '/') . '/' . basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<script>document.documentElement.classList.replace('no-js','js');</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDesc) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="csrf-token" content="<?= e(csrf_token()) ?>">

<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDesc) ?>">
<meta property="og:site_name" content="<?= e(cfg('name')) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="<?= e(asset('images/favicon.png')) ?>">

<!-- TT Interphases Pro — local web font -->
<style>
@font-face { font-family:'TT Interphases Pro'; src:url('<?= e(asset('fonts/TT Interphases Pro Trial Light.ttf')) ?>') format('truetype'); font-weight:300; font-style:normal; font-display:swap; }
@font-face { font-family:'TT Interphases Pro'; src:url('<?= e(asset('fonts/TT Interphases Pro Trial Regular.ttf')) ?>') format('truetype'); font-weight:400; font-style:normal; font-display:swap; }
@font-face { font-family:'TT Interphases Pro'; src:url('<?= e(asset('fonts/TT Interphases Pro Trial Medium.ttf')) ?>') format('truetype'); font-weight:500; font-style:normal; font-display:swap; }
@font-face { font-family:'TT Interphases Pro'; src:url('<?= e(asset('fonts/TT Interphases Pro Trial DemiBold.ttf')) ?>') format('truetype'); font-weight:600; font-style:normal; font-display:swap; }
@font-face { font-family:'TT Interphases Pro'; src:url('<?= e(asset('fonts/TT Interphases Pro Trial Bold.ttf')) ?>') format('truetype'); font-weight:700; font-style:normal; font-display:swap; }
@font-face { font-family:'TT Interphases Pro'; src:url('<?= e(asset('fonts/TT Interphases Pro Trial ExtraBold.ttf')) ?>') format('truetype'); font-weight:800; font-style:normal; font-display:swap; }
</style>

<?php if ($useTailwind): ?>
<!-- Legacy: only for pages not yet migrated to custom CSS. Remove with the last one.
     Migrated pages draw icons as inline SVG via icon() and need neither of these. -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  /* Tailwind ships its own .container (max-width 1280 at xl, no padding) which
     overrides ours and shifts the header ~20px on legacy pages. Turn it off. */
  tailwind.config = { corePlugins: { container: false }, theme: { extend: {
    fontFamily:{ sans:['Manrope','system-ui','sans-serif'], head:['Figtree','Manrope','sans-serif'] },
    colors:{
      dark:{950:'#040E28',900:'#06153A',800:'#0B2151',700:'#12306E',600:'#1957D6',500:'#2C6FEA'},
      brand:{lime:'#D3E33C',blue:'#1957D6',orange:'#F07322','lime-light':'#E2EE72','blue-light':'#2C6FEA'},
      slate:{50:'#F8FAFC',100:'#F1F5F9',200:'#E2E8F0',300:'#CBD5E1',400:'#94A3B8',500:'#64748B',600:'#475569',700:'#334155',800:'#1E293B',900:'#0F172A',950:'#020617'},
    },
    boxShadow:{ lime:'0 10px 30px -8px rgba(240,115,34,.4)','lime-lg':'0 20px 50px -12px rgba(240,115,34,.5)',
      card:'0 4px 24px -4px rgba(0,0,0,.45)','card-lg':'0 16px 48px -8px rgba(0,0,0,.6)',glow:'0 0 40px rgba(240,115,34,.2)' },
  } } };
</script>
<?php endif; ?>

<link rel="stylesheet" href="<?= e(asset_v('css/style.css')) ?>">
<link rel="stylesheet" href="<?= e(asset_v('css/shop.css')) ?>">

<script type="application/ld+json">
<?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'LocalBusiness',
  'name'     => cfg('name'),
  'description' => $pageDesc,
  'url'      => cfg('url'),
  'telephone'=> cfg('phone'),
  'email'    => cfg('email'),
  'address'  => ['@type'=>'PostalAddress','streetAddress'=>cfg('address'),'addressLocality'=>'Karachi','addressCountry'=>'PK'],
  'openingHours' => cfg('hours'),
  'areaServed'   => 'Karachi, Pakistan',
], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) ?>
</script>
<script type="application/ld+json">
<?= json_encode([
  '@context'=>'https://schema.org','@type'=>'ItemList',
  'itemListElement'=>array_map(fn($i,$s)=>[
    '@type'=>'ListItem','position'=>$i+1,
    'item'=>['@type'=>'Service','name'=>$s['title'],'description'=>$s['short'],
             'provider'=>['@type'=>'LocalBusiness','name'=>cfg('name')]],
  ], array_keys($navServices), $navServices),
], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) ?>
</script>
</head>
<body>

<!-- Custom cursor (Seonex style) — hidden on touch devices via CSS -->
<div class="cursor-dot" aria-hidden="true"></div>
<div class="cursor-ring" aria-hidden="true"></div>

<div id="preloader">
  <span class="logo__mark" style="width:52px;height:52px;border-radius:15px"><?= icon('shield') ?></span>
  <div class="preloader__bar"><span></span></div>
</div>

<a href="#main" class="skip-link">Skip to content</a>

<header class="header" id="header">
  <span class="header-aurora" aria-hidden="true"></span>
  <div class="container header__inner">

    <a href="index.php" class="logo" aria-label="<?= e(cfg('name')) ?> — home">
      <span class="logo__mark"><?= icon('shield') ?></span>
      <span class="logo__text"><?= e(cfg('name')) ?></span>
    </a>

    <nav class="nav" aria-label="Main">
      <a href="index.php" class="nav__link<?= active_nav('index.php') ?>">Home</a>
      <a href="about.php" class="nav__link<?= active_nav('about.php') ?>">About Us</a>

      <div class="nav__item">
        <a href="services.php" class="nav__link<?= active_nav('services.php') ?>" aria-haspopup="true">
          <span class="nav__label">Services <?= icon('chevron','nav__caret') ?></span>
        </a>
        <div class="mega">
          <?php foreach (array_chunk($navServices, 4) as $chunk): ?>
          <div>
            <?php foreach ($chunk as $s): ?>
            <a class="mega__item" href="service-detail.php?slug=<?= e($s['slug']) ?>">
              <?= icon($s['icon']) ?>
              <span>
                <span class="mega__name"><?= e($s['title']) ?></span>
                <span class="mega__desc"><?= e($s['short']) ?></span>
              </span>
            </a>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
          <div class="mega__card">
            <h4>Not sure what you need?</h4>
            <p style="font-size:.86rem;line-height:1.6">Book a free site survey and we'll spec the right system for your building.</p>
            <a href="tel:<?= e(cfg('phone_href')) ?>"><?= e(cfg('phone')) ?></a>
          </div>
        </div>
      </div>

      <a href="industries.php" class="nav__link<?= active_nav('industries.php') ?>">Industries</a>
      <a href="products.php"   class="nav__link<?= active_nav('products.php') ?>">Products</a>
      <a href="portfolio.php"  class="nav__link<?= active_nav('portfolio.php') ?>">Portfolio</a>
      <a href="career.php"     class="nav__link<?= active_nav('career.php') ?>">Career</a>
      <a href="blog.php"       class="nav__link<?= active_nav('blog.php') ?>">Blogs</a>
    </nav>

    <div class="header__actions">
      <a href="contact.php" class="btn btn--white" style="padding:10px 10px 10px 20px">
        Get in touch <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
      <a href="cart.php" class="cart-btn<?= cart_count() ? ' has-items' : '' ?>" id="header-cart"
         aria-label="Cart (<?= cart_count() ?> items)">
        <?= icon('cart') ?>
        <span class="cart-btn__count" data-cart-count><?= cart_count() ?></span>
      </a>
      <!-- Desktop: opens the info panel (no nav inside) -->
      <button type="button" class="icon-btn icon-btn--info" id="info-open" aria-label="About Peace Automation"
              aria-expanded="false" aria-controls="info-panel"><?= icon('grid') ?></button>
      <!-- Below 1200px: opens the nav drawer -->
      <button type="button" class="icon-btn icon-btn--burger" id="nav-open" aria-label="Open menu"
              aria-expanded="false" aria-controls="nav-drawer"><?= icon('menu') ?></button>
    </div>
  </div>
</header>

<!-- Shared dim overlay for whichever panel is open -->
<div class="panel-overlay" id="panel-overlay" hidden></div>

<!-- ============ 3a. INFO PANEL (grid icon) — no navigation ============ -->
<aside class="panel" id="info-panel" role="dialog" aria-modal="true"
       aria-labelledby="info-panel-title" aria-hidden="true" tabindex="-1">
  <div class="panel__head">
    <a href="index.php" class="logo">
      <span class="logo__mark"><?= icon('shield') ?></span>
      <span class="logo__text"><?= e(cfg('name')) ?></span>
    </a>
    <button type="button" class="icon-btn" data-panel-close aria-label="Close"><?= icon('close') ?></button>
  </div>

  <div class="panel__body">
    <h3 id="info-panel-title" class="panel__title">About Peace Automation</h3>
    <p class="panel__text">
      We design, install and maintain CCTV, fire safety and building automation systems
      across Karachi. Every job starts with a site survey and ends with a system handed
      over configured, tested and documented — not left half-finished. One team from
      first call to annual service.
    </p>

    <div class="panel__shots">
      <?php foreach ([
        ['service-cctv.webp',           'Recent CCTV installation'],
        ['service-access-control.webp', 'Access control installation'],
        ['service-fire-alarm.webp',     'Fire alarm installation'],
        ['service-attendance.webp',     'Time attendance installation'],
      ] as $shot): ?>
        <span class="panel__shot"><?= img($shot[0], $shot[1], 300, 300) ?></span>
      <?php endforeach; ?>
    </div>

    <h4 class="panel__subtitle">Contact</h4>
    <ul class="footer__contact">
      <li><span class="ico-wrap"><?= icon('pin') ?></span><span><?= e(cfg('address')) ?></span></li>
      <li><span class="ico-wrap"><?= icon('mail') ?></span><a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a></li>
      <li><span class="ico-wrap"><?= icon('phone') ?></span><a href="tel:<?= e(cfg('phone_href')) ?>"><?= e(cfg('phone')) ?></a></li>
    </ul>

    <div class="footer__social" style="margin-top:20px">
      <?php foreach (cfg('social') as $net => $href): ?>
      <?php if ($href && $href !== '#'): ?>
      <a href="<?= e($href) ?>" target="_blank" rel="noopener" aria-label="<?= e(ucfirst($net)) ?>"><?= icon($net) ?></a>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="panel__foot">
    <a href="contact.php" class="btn btn--primary" style="width:100%;justify-content:center">
      Get a free survey <span class="btn__chip"><?= icon('arrow') ?></span>
    </a>
  </div>
</aside>

<!-- ============ 3b. NAV DRAWER (hamburger, below 1200px) ============ -->
<aside class="panel" id="nav-drawer" role="dialog" aria-modal="true"
       aria-label="Site navigation" aria-hidden="true" tabindex="-1">
  <div class="panel__head">
    <a href="index.php" class="logo">
      <span class="logo__mark"><?= icon('shield') ?></span>
      <span class="logo__text"><?= e(cfg('name')) ?></span>
    </a>
    <button type="button" class="icon-btn" data-panel-close aria-label="Close menu"><?= icon('close') ?></button>
  </div>

  <div class="panel__body">
    <nav aria-label="Mobile">
      <a href="index.php" class="drawer__link<?= active_nav('index.php') ?>">Home</a>
      <a href="about.php" class="drawer__link<?= active_nav('about.php') ?>">About Us</a>

      <div>
        <button type="button" class="drawer__link" style="width:100%" data-drawer-acc aria-expanded="false">
          Services <?= icon('plus') ?>
        </button>
        <div class="drawer__sub"><div>
          <?php foreach ($navServices as $s): ?>
          <a href="service-detail.php?slug=<?= e($s['slug']) ?>"><?= e($s['title']) ?></a>
          <?php endforeach; ?>
        </div></div>
      </div>

      <a href="industries.php" class="drawer__link<?= active_nav('industries.php') ?>">Industries</a>
      <a href="products.php"   class="drawer__link<?= active_nav('products.php') ?>">Products</a>
      <a href="portfolio.php"  class="drawer__link<?= active_nav('portfolio.php') ?>">Portfolio</a>
      <a href="career.php"     class="drawer__link<?= active_nav('career.php') ?>">Career</a>
      <a href="blog.php"       class="drawer__link<?= active_nav('blog.php') ?>">Blogs</a>
      <a href="contact.php"    class="drawer__link<?= active_nav('contact.php') ?>">Contact Us</a>
      <a href="cart.php"       class="drawer__link<?= active_nav('cart.php') ?>">Cart <span class="drawer__count" data-cart-count><?= cart_count() ?></span></a>
    </nav>

    <a href="tel:<?= e(cfg('phone_href')) ?>" class="panel__phone">
      <?= icon('phone') ?> <?= e(cfg('phone')) ?>
    </a>

    <a href="contact.php" class="btn btn--primary" style="width:100%;justify-content:center;margin-top:14px">
      Get in touch <span class="btn__chip"><?= icon('arrow') ?></span>
    </a>

    <div class="footer__social" style="margin-top:26px">
      <?php foreach (cfg('social') as $net => $href): ?>
      <?php if ($href && $href !== '#'): ?>
      <a href="<?= e($href) ?>" target="_blank" rel="noopener" aria-label="<?= e(ucfirst($net)) ?>"><?= icon($net) ?></a>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</aside>
