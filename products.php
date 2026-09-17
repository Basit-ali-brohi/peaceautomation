<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$pageTitle      = 'Products & Hardware Systems | Peace Automation';
$bannerTitle    = 'Enterprise Hardware';
$bannerSubtitle = 'Certified surveillance cameras, biometric access terminals, intelligent fire panels, and automated gate equipment.';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ============ PRODUCTS HERO (Seonex Style) ============ -->
<section class="svc-hero">
  <!-- Home Page style background elements -->
  <span class="hero__glow hero__glow--top-right" aria-hidden="true"></span>
  <span class="hero__glow hero__glow--bottom-left" aria-hidden="true"></span>
  <div class="hero__wave-bg" aria-hidden="true">
    <img src="<?= e(asset('images/hero/hero-wave.svg')) ?>" alt="" class="hero__wave-img">
  </div>

  <div class="container svc-hero__inner">
    <div class="svc-hero__copy">
      <span class="eyebrow" style="color:var(--lime)">Certified Hardware — <em>Tested &amp; Warrantied</em></span>
      <h1>Engineered Hardware<br>Built For Continuous<br>Operation</h1>
      <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span aria-hidden="true">›</span>
        <span>Products</span>
      </nav>
      <a href="contact.php" class="btn btn--primary" style="margin-top:32px">
        Get Hardware Quote <span class="btn__chip"><?= icon('arrow') ?></span>
      </a>
    </div>
    <div class="svc-hero__collage">
      <div class="svc-hero__main-img">
        <?= img('why-dome-camera.webp', 'Certified 4K surveillance equipment and biometric hardware', 660, 480) ?>
      </div>
      <div class="svc-hero__badge"><span class="n">48h</span><span class="l">Bench<br>Testing</span></div>
      <div class="svc-hero__pill"><?= icon('cpu') ?><span>100% Genuine Hardware</span></div>
    </div>
  </div>
</section>

<main>

<!-- ============ PRODUCTS CATALOG (SHOP LAYOUT) ============ -->
<section class="shop-sec">
  <div class="container">

    <?php
      $categories     = product_categories();
      $featureFilters = product_features();
      $allProducts    = products();
      $ratings        = all_product_ratings();

      // Per-category counts for the sidebar list.
      $catCounts = array_fill_keys(array_keys($categories), 0);
      foreach ($allProducts as $p) {
        $catCounts[$p['category']]++;
      }

      $featuredKeys = [0, 2, 4];   // sidebar "Featured Hardware" rail

      // Tag cloud, built from the products themselves.
      $tagList = [];
      foreach ($allProducts as $p) {
        foreach ($p['tags'] as $t) { $tagList[$t] = true; }
      }
      $tagList = array_slice(array_keys($tagList), 0, 10);
    ?>

    <div class="shop-head">
      <span class="eyebrow">Equipment Showcase — <em>Industrial &amp; Commercial</em></span>
      <h2 class="anim-heading">Proven security hardware trusted by enterprise facilities</h2>
    </div>

    <div class="shop-layout">

      <!-- ---------- MAIN COLUMN ---------- -->
      <div class="shop-main">

        <div class="shop-toolbar">
          <p class="shop-count">
            Showing <strong id="shopShown">1–6</strong> of <strong id="shopTotal"><?= count($allProducts) ?></strong> products
          </p>
          <div class="shop-sort">
            <label for="shopSort" class="shop-sr">Sort products</label>
            <select id="shopSort">
              <option value="default">Default sorting</option>
              <option value="az">Sort by name: A–Z</option>
              <option value="za">Sort by name: Z–A</option>
              <option value="low">Sort by price: low to high</option>
              <option value="high">Sort by price: high to low</option>
            </select>
          </div>
        </div>

        <div class="shop-grid" id="shopGrid">
          <?php foreach ($allProducts as $i => $p):
            $url      = 'product-detail.php?slug=' . urlencode($p['slug']);
            $rating   = $ratings[$p['slug']] ?? ['avg' => 0.0, 'count' => 0];
            $off      = discount_percent($p);
            $keywords = strtolower($p['name'] . ' ' . $p['short'] . ' ' . implode(' ', $p['specs'])
                        . ' ' . implode(' ', $p['tags']) . ' ' . category_label($p['category']) . ' ' . $p['badge']);
          ?>
          <article class="shop-card"
                   data-cat="<?= e($p['category']) ?>"
                   data-features="<?= e(implode(',', $p['features'])) ?>"
                   data-name="<?= e($p['name']) ?>"
                   data-price="<?= (int) $p['price'] ?>"
                   data-keywords="<?= e($keywords) ?>"
                   data-index="<?= $i ?>">
            <div class="shop-card__media">
              <a href="<?= e($url) ?>" class="shop-card__media-link" tabindex="-1" aria-hidden="true">
                <?= img($p['image'], $p['name'], 550, 550) ?>
              </a>
              <span class="shop-card__flag"><?= e($p['badge']) ?></span>
              <?php if ($off): ?><span class="shop-card__off"><?= $off ?>% OFF</span><?php endif; ?>
              <div class="shop-card__actions">
                <button type="button" class="shop-card__cart" data-add-to-cart="<?= e($p['slug']) ?>">Add to cart</button>
                <a href="<?= e($url) ?>" class="shop-card__chip" aria-label="View <?= e($p['name']) ?>">
                  <?= icon('arrow') ?>
                </a>
              </div>
            </div>
            <div class="shop-card__body">
              <h3 class="shop-card__title"><a href="<?= e($url) ?>"><?= e($p['name']) ?></a></h3>
              <p class="shop-card__meta">
                <?php if ($p['old_price']): ?><span class="shop-card__old"><?= e(money($p['old_price'])) ?></span><?php endif; ?>
                <span class="shop-card__key"><?= e(money($p['price'])) ?></span>
              </p>
              <?php if ($rating['count']): ?>
                <p class="shop-card__rating">
                  <?= stars_html($rating['avg']) ?>
                  <span>(<?= $rating['count'] ?>)</span>
                </p>
              <?php else: ?>
                <ul class="shop-card__specs">
                  <?php foreach (array_slice($p['specs'], 0, 2) as $spec): ?>
                  <li><?= icon('check') ?><span><?= e($spec) ?></span></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          </article>
          <?php endforeach; ?>
        </div>

        <p class="shop-empty" id="shopEmpty" hidden>
          No equipment matches this filter. Try another category or clear the search.
        </p>

        <nav class="shop-pager" id="shopPager" aria-label="Product pages"></nav>
      </div>

      <!-- ---------- SIDEBAR ---------- -->
      <aside class="shop-side" aria-label="Product filters">

        <!-- Search -->
        <form class="shop-search" role="search" onsubmit="return false;">
          <label for="shopSearch" class="shop-sr">Search products</label>
          <input type="search" id="shopSearch" placeholder="Search products…" autocomplete="off">
          <button type="submit" class="shop-search__btn" aria-label="Search"><?= icon('search') ?></button>
        </form>

        <!-- Categories -->
        <div class="shop-widget">
          <h3 class="shop-widget__title">Categories</h3>
          <ul class="shop-cats">
            <li>
              <button type="button" class="shop-cat is-active" data-cat="all">
                <span>All Equipment</span><em><?= count($allProducts) ?></em>
              </button>
            </li>
            <?php foreach ($categories as $key => $label): ?>
            <li>
              <button type="button" class="shop-cat" data-cat="<?= e($key) ?>">
                <span><?= e($label) ?></span><em><?= $catCounts[$key] ?></em>
              </button>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Feature filter -->
        <div class="shop-widget">
          <h3 class="shop-widget__title">Filter by Feature</h3>
          <ul class="shop-feats">
            <?php foreach ($featureFilters as $key => $label): ?>
            <li>
              <label class="shop-feat">
                <input type="checkbox" value="<?= e($key) ?>" class="shop-sr">
                <span class="shop-feat__box"><?= icon('check') ?></span>
                <span class="shop-feat__label"><?= e($label) ?></span>
              </label>
            </li>
            <?php endforeach; ?>
          </ul>
          <div class="shop-feats__foot">
            <button type="button" class="shop-clear" id="shopClear">Clear all</button>
            <button type="button" class="shop-filter-btn" id="shopApply">Filter</button>
          </div>
        </div>

        <!-- Featured -->
        <div class="shop-widget">
          <h3 class="shop-widget__title">Featured Hardware</h3>
          <ul class="shop-feature-list">
            <?php foreach ($featuredKeys as $k): $f = $allProducts[$k]; ?>
            <li>
              <a href="product-detail.php?slug=<?= urlencode($f['slug']) ?>">
                <span class="shop-feature__thumb"><?= img($f['image'], $f['name'], 140, 140) ?></span>
                <span class="shop-feature__text">
                  <span class="shop-feature__name"><?= e($f['name']) ?></span>
                  <span class="shop-feature__spec"><?= e(money($f['price'])) ?></span>
                  <span class="shop-feature__tag"><?= e($f['badge']) ?></span>
                </span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Tags -->
        <div class="shop-widget">
          <h3 class="shop-widget__title">Tags</h3>
          <div class="shop-tags">
            <?php foreach ($tagList as $tag): ?>
            <button type="button" class="shop-tag" data-tag="<?= e(strtolower($tag)) ?>"><?= e($tag) ?></button>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Promo -->
        <div class="shop-promo">
          <?= img('cameras-banner.webp', 'Free security site survey by Peace Automation', 620, 760) ?>
          <div class="shop-promo__overlay">
            <span class="shop-promo__kicker"><em>Free</em> site survey</span>
            <h4>Book a security audit</h4>
            <a href="contact.php" class="shop-promo__btn">
              BOOK NOW <span class="shop-promo__chip"><?= icon('arrow') ?></span>
            </a>
          </div>
        </div>

      </aside>
    </div>

  </div>
</section>

<!-- ============ HARDWARE COMMITMENT BANNER ============ -->
<section class="prod-trust-sec">
  <div class="container">
    <div class="prod-trust-grid">
      <div class="prod-trust-item">
        <div class="prod-trust-icon"><?= icon('shield') ?></div>
        <h4>Original Brand Warranty</h4>
        <p>Direct official warranties from authorized global partners with guaranteed replacement support.</p>
      </div>
      <div class="prod-trust-item">
        <div class="prod-trust-icon"><?= icon('cpu') ?></div>
        <h4>Pre-Installation Bench Test</h4>
        <p>Every camera, terminal, and panel undergoes a 48-hour diagnostic run in our workshop prior to mounting.</p>
      </div>
      <div class="prod-trust-item">
        <div class="prod-trust-icon"><?= icon('clock') ?></div>
        <h4>24/7 Spare Parts Stock</h4>
        <p>We maintain dedicated inventory for active AMC clients so you never wait on backordered components.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA STRIP (Seonex Style) ============ -->
<section class="prod-cta-sec">
  <div class="container">
    <div class="prod-cta-box">
      <div class="prod-cta-text">
        <span class="eyebrow" style="color:var(--lime);">Custom Procurement — <em>Hardware Solutions</em></span>
        <h2>Looking for specific equipment specifications?</h2>
        <p>Our engineers source, configure, and install custom security hardware configurations matching your project drawings.</p>
      </div>
      <div class="prod-cta-btn">
        <a href="contact.php" class="btn btn--primary btn--hero-compact">
          CONTACT OUR HARDWARE TEAM <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

</main>

<style>
/* =========================================================
   PRODUCTS PAGE — HERO
   ========================================================= */
.prod-hero {
  background: var(--navy-900);
  position: relative;
  overflow: hidden;
  padding: 110px 0 70px;
}
.prod-hero-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: 50px;
  align-items: center;
}
.prod-hero-text h1 {
  color: #fff;
  font-size: clamp(2.4rem, 4.8vw, 3.8rem);
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -0.03em;
  margin: 0 0 20px;
}
.prod-hero-text .breadcrumb {
  color: rgba(255,255,255,0.6);
  font-size: 0.95rem;
}
.prod-hero-text .breadcrumb a { color: rgba(255,255,255,0.6); text-decoration: none; }
.prod-hero-text .breadcrumb a:hover { color: #fff; }
.prod-hero-text .breadcrumb span { margin: 0 8px; }
.prod-hero-text .breadcrumb .active { color: var(--lime); font-style: italic; text-decoration: underline; text-underline-offset: 4px; }

.prod-hero-badge-box {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 20px;
  padding: 32px 30px;
  backdrop-filter: blur(10px);
}
.prod-stat-pill {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
}
.prod-stat-num {
  font-size: 2.8rem;
  font-weight: 800;
  color: var(--lime);
  line-height: 1;
  font-family: var(--font-head);
}
.prod-stat-text {
  font-size: 0.95rem;
  color: #fff;
  font-weight: 600;
  line-height: 1.3;
}
.prod-hero-lead {
  color: rgba(255,255,255,0.7);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 900px) {
  .prod-hero-grid { grid-template-columns: 1fr; gap: 30px; }
}

/* =========================================================
   PRODUCTS PAGE — TRUST BADGES
   ========================================================= */
.prod-trust-sec {
  padding: 40px 0 80px;
  background: #fff;
}
.prod-trust-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
  background: var(--light);
  border: 1px solid var(--line);
  border-radius: 24px;
  padding: 40px 36px;
}
.prod-trust-item {
  display: flex;
  flex-direction: column;
}
.prod-trust-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: var(--navy-900);
  color: var(--lime);
  display: grid;
  place-items: center;
  margin-bottom: 18px;
}
.prod-trust-icon .ico { width: 24px; height: 24px; }
.prod-trust-item h4 {
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--ink);
  margin: 0 0 8px;
}
.prod-trust-item p {
  font-size: 0.88rem;
  line-height: 1.65;
  color: var(--body);
  margin: 0;
}
@media (max-width: 768px) {
  .prod-trust-grid { grid-template-columns: 1fr; gap: 24px; padding: 28px 24px; }
}

/* =========================================================
   PRODUCTS PAGE — CTA
   ========================================================= */
.prod-cta-sec {
  padding: 0 0 clamp(80px, 9vw, 120px);
  background: #fff;
}
.prod-cta-box {
  background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-800) 100%);
  border-radius: 28px;
  padding: clamp(40px, 6vw, 64px);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 20px 50px rgba(4,13,36,0.18);
}
.prod-cta-box::before {
  content: "";
  position: absolute;
  top: -80px; right: -80px;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(0, 210, 255, 0.25) 0%, transparent 70%);
  pointer-events: none;
}
.prod-cta-text {
  max-width: 650px;
  position: relative;
  z-index: 2;
}
.prod-cta-text h2 {
  color: #fff;
  font-size: clamp(1.8rem, 3.2vw, 2.6rem);
  font-weight: 800;
  line-height: 1.2;
  margin: 10px 0 14px;
}
.prod-cta-text p {
  color: rgba(255,255,255,0.72);
  font-size: 0.95rem;
  line-height: 1.7;
  margin: 0;
}
.prod-cta-btn {
  position: relative;
  z-index: 2;
  flex-shrink: 0;
}
/* The label is long — on a phone the button takes the full width
   rather than spilling out of the card. */
@media (max-width: 560px) {
  .prod-cta-btn { width: 100%; }
  .prod-cta-btn .btn { width: 100%; justify-content: space-between; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

  var grid = document.getElementById('shopGrid');
  if (!grid) { return; }

  var cards     = Array.prototype.slice.call(grid.querySelectorAll('.shop-card'));
  var pager     = document.getElementById('shopPager');
  var emptyMsg  = document.getElementById('shopEmpty');
  var shownEl   = document.getElementById('shopShown');
  var totalEl   = document.getElementById('shopTotal');
  var searchIn  = document.getElementById('shopSearch');
  var sortSel   = document.getElementById('shopSort');
  var catBtns   = Array.prototype.slice.call(document.querySelectorAll('.shop-cat'));
  var tagBtns   = Array.prototype.slice.call(document.querySelectorAll('.shop-tag'));
  var featBoxes = Array.prototype.slice.call(document.querySelectorAll('.shop-feat input'));

  var PER_PAGE = 6;
  var state = { cat: 'all', query: '', feats: [], sort: 'default', page: 1 };

  var ARROW  = '<svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h13"/><path d="m12 5 7 7-7 7"/></svg>';
  var ARROWL = '<svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H6"/><path d="m12 5-7 7 7 7"/></svg>';

  function matches(card) {
    if (state.cat !== 'all' && card.dataset.cat !== state.cat) { return false; }
    if (state.query && card.dataset.keywords.indexOf(state.query) === -1) { return false; }
    if (state.feats.length) {
      var own = (card.dataset.features || '').split(',');
      // OR match — any ticked feature keeps the product in the list.
      var hit = state.feats.some(function (f) { return own.indexOf(f) > -1; });
      if (!hit) { return false; }
    }
    return true;
  }

  function sorted(list) {
    var out = list.slice();
    if (state.sort === 'az' || state.sort === 'za') {
      out.sort(function (a, b) { return a.dataset.name.localeCompare(b.dataset.name); });
      if (state.sort === 'za') { out.reverse(); }
    } else if (state.sort === 'low' || state.sort === 'high') {
      out.sort(function (a, b) { return (+a.dataset.price) - (+b.dataset.price); });
      if (state.sort === 'high') { out.reverse(); }
    } else {
      out.sort(function (a, b) { return (+a.dataset.index) - (+b.dataset.index); });
    }
    return out;
  }

  function buildPager(pages) {
    pager.innerHTML = '';
    if (pages < 2) { return; }

    function add(html, label, page, opts) {
      var b = document.createElement('button');
      b.type = 'button';
      b.innerHTML = html;
      b.setAttribute('aria-label', label);
      if (opts && opts.current) { b.classList.add('is-current'); b.setAttribute('aria-current', 'page'); }
      if (opts && opts.disabled) { b.disabled = true; }
      b.addEventListener('click', function () { goTo(page); });
      pager.appendChild(b);
    }

    add(ARROWL, 'Previous page', state.page - 1, { disabled: state.page === 1 });
    for (var i = 1; i <= pages; i++) {
      add(String(i), 'Page ' + i, i, { current: i === state.page });
    }
    add(ARROW, 'Next page', state.page + 1, { disabled: state.page === pages });
  }

  function goTo(page) {
    state.page = page;
    render();
    var top = grid.getBoundingClientRect().top + window.pageYOffset - 140;
    window.scrollTo({ top: top, behavior: 'smooth' });
  }

  function render() {
    var visible = sorted(cards.filter(matches));
    var pages   = Math.max(1, Math.ceil(visible.length / PER_PAGE));
    if (state.page > pages) { state.page = pages; }

    var start = (state.page - 1) * PER_PAGE;
    var slice = visible.slice(start, start + PER_PAGE);

    cards.forEach(function (card) { card.style.display = 'none'; });
    slice.forEach(function (card) {
      card.style.display = '';
      grid.appendChild(card);            // keeps the chosen sort order
    });

    emptyMsg.hidden = visible.length !== 0;
    grid.style.display = visible.length ? '' : 'none';

    totalEl.textContent = visible.length;
    shownEl.textContent = visible.length
      ? (start + 1) + '–' + (start + slice.length)
      : '0';

    buildPager(pages);

    if (typeof gsap !== 'undefined' && slice.length) {
      gsap.fromTo(slice, { opacity: 0, y: 18 },
        { opacity: 1, y: 0, duration: 0.4, stagger: 0.04, ease: 'power2.out', clearProps: 'transform' });
    }
  }

  /* ---- filters ---- */
  catBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      catBtns.forEach(function (b) { b.classList.remove('is-active'); });
      btn.classList.add('is-active');
      state.cat = btn.dataset.cat;
      state.page = 1;
      render();
    });
  });

  featBoxes.forEach(function (box) {
    box.addEventListener('change', function () {
      state.feats = featBoxes.filter(function (b) { return b.checked; })
                             .map(function (b) { return b.value; });
      state.page = 1;
      render();
    });
  });

  tagBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var on = btn.classList.contains('is-active');
      tagBtns.forEach(function (b) { b.classList.remove('is-active'); });
      if (!on) { btn.classList.add('is-active'); }
      state.query = on ? '' : btn.dataset.tag;
      searchIn.value = on ? '' : btn.textContent;
      state.page = 1;
      render();
    });
  });

  var typingTimer;
  searchIn.addEventListener('input', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(function () {
      state.query = searchIn.value.trim().toLowerCase();
      tagBtns.forEach(function (b) { b.classList.remove('is-active'); });
      state.page = 1;
      render();
    }, 180);
  });

  sortSel.addEventListener('change', function () {
    state.sort = sortSel.value;
    state.page = 1;
    render();
  });

  document.getElementById('shopApply').addEventListener('click', function () {
    state.page = 1;
    goTo(1);
  });

  document.getElementById('shopClear').addEventListener('click', function () {
    featBoxes.forEach(function (b) { b.checked = false; });
    tagBtns.forEach(function (b) { b.classList.remove('is-active'); });
    catBtns.forEach(function (b) { b.classList.toggle('is-active', b.dataset.cat === 'all'); });
    searchIn.value = '';
    state = { cat: 'all', query: '', feats: [], sort: sortSel.value, page: 1 };
    render();
  });

  render();

  /* ---- heading word reveal ---- */
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    var head = document.querySelector('.shop-head h2');
    if (head && !head.querySelector('.ab-word')) {
      var words = head.innerText.split(' ');
      head.innerHTML = '';
      words.forEach(function (w) {
        var s = document.createElement('span');
        s.className = 'ab-word';
        s.innerText = w + ' ';
        head.appendChild(s);
      });
      gsap.fromTo(head.querySelectorAll('.ab-word'),
        { y: 35, opacity: 0 },
        {
          y: 0, opacity: 1, stagger: 0.03, duration: 0.75, ease: 'power3.out',
          scrollTrigger: { trigger: head, start: 'top 85%' }
        }
      );
    }
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
