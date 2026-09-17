<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/shop.php';

$slug    = trim((string) ($_GET['slug'] ?? ''));
$product = product_by_slug($slug);

if (!$product) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$selfUrl = 'product-detail.php?slug=' . urlencode($product['slug']);

/* ---------------------------------------------------------------
   POST — add to cart (no-JS fallback) and review submission.
   Both use post/redirect/get so a refresh never resubmits.
   --------------------------------------------------------------- */
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $action = (string) ($_POST['form_action'] ?? '');

    if ($action === 'add-to-cart' && csrf_verify($_POST['csrf_token'] ?? null)) {
        cart_add($product['slug'], max(1, (int) ($_POST['qty'] ?? 1)));
        header('Location: cart.php');
        exit;
    }

    if ($action === 'review') {
        $errors = [];
        $author = trim((string) ($_POST['author'] ?? ''));
        $email  = trim((string) ($_POST['email']  ?? ''));
        $rating = (int) ($_POST['rating'] ?? 0);
        $body   = trim((string) ($_POST['body']   ?? ''));

        // Honeypot — a real visitor never fills this in.
        if (!empty($_POST['website'])) {
            header('Location: ' . $selfUrl . '&review=ok#reviews');
            exit;
        }

        if (!csrf_verify($_POST['csrf_token'] ?? null)) {
            $errors['form'] = 'Your session expired. Please refresh the page and try again.';
        }
        if (mb_strlen($author) < 2) {
            $errors['author'] = 'Please enter your name.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Enter a valid email address.';
        }
        if ($rating < 1 || $rating > 5) {
            $errors['rating'] = 'Please choose a star rating.';
        }
        if (mb_strlen($body) < 10) {
            $errors['body'] = 'Please write at least a sentence about the product.';
        }
        if (time() - (int) ($_SESSION['review_last'] ?? 0) < 60) {
            $errors['form'] = 'Please wait a moment before posting another review.';
        }

        if (!$errors) {
            $db = shop_db();
            if ($db) {
                try {
                    $db->prepare(
                        'INSERT INTO product_reviews (product_slug, author, email, rating, body, ip_address)
                         VALUES (?, ?, ?, ?, ?, ?)'
                    )->execute([
                        $product['slug'], $author, $email, $rating, $body, $_SERVER['REMOTE_ADDR'] ?? null,
                    ]);
                    $_SESSION['review_last'] = time();
                    header('Location: ' . $selfUrl . '&review=ok#reviews');
                    exit;
                } catch (PDOException $e) {
                    error_log('Review insert failed: ' . $e->getMessage());
                    $errors['form'] = 'We could not save your review just now. Please try again shortly.';
                }
            } else {
                $errors['form'] = 'Reviews are temporarily unavailable. Please try again shortly.';
            }
        }

        $_SESSION['review_flash'] = ['errors' => $errors, 'old' => compact('author', 'email', 'rating', 'body')];
        header('Location: ' . $selfUrl . '#reviews');
        exit;
    }
}

/* ---------------------------------------------------------------
   Render
   --------------------------------------------------------------- */
$flash  = $_SESSION['review_flash'] ?? ['errors' => [], 'old' => []];
unset($_SESSION['review_flash']);
$errors = $flash['errors'];
$old    = $flash['old'];

$reviews   = product_reviews($product['slug']);
$rating    = product_rating($product['slug']);
$related   = related_products($product, 4);
$ratings   = all_product_ratings();
$off       = discount_percent($product);
$gallery   = array_merge([$product['image']], $product['gallery']);
$justSaved = ($_GET['review'] ?? '') === 'ok';

$pageTitle = $product['name'] . ' | ' . cfg('name');
$pageDesc  = $product['short'];

require_once __DIR__ . '/includes/header.php';
?>

<!-- ============ BREADCRUMB BAR ============ -->
<section class="pd-bar">
  <div class="container">
    <nav class="pd-crumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span aria-hidden="true">›</span>
      <a href="products.php">Products</a>
      <span aria-hidden="true">›</span>
      <span><?= e($product['name']) ?></span>
    </nav>
  </div>
</section>

<main id="main">

<!-- ============ PRODUCT SUMMARY ============ -->
<section class="pd-sec">
  <div class="container">
    <div class="pd-layout">

      <!-- ---------- gallery ---------- -->
      <div class="pd-gallery" id="pdGallery">
        <div class="pd-gallery__main" data-gallery-main>
          <?= img($gallery[0], $product['name'], 900, 900) ?>
          <button type="button" class="pd-gallery__zoom" data-gallery-zoom aria-label="View larger image">
            <?= icon('search') ?>
          </button>
          <?php if ($off): ?><span class="pd-gallery__off"><?= $off ?>% OFF</span><?php endif; ?>
        </div>

        <?php if (count($gallery) > 1): ?>
        <div class="pd-gallery__thumbs">
          <?php foreach ($gallery as $gi => $shot): ?>
          <button type="button" class="pd-gallery__thumb<?= $gi === 0 ? ' is-active' : '' ?>" data-gallery-thumb
                  aria-label="View image <?= $gi + 1 ?>">
            <?= img($shot, $product['name'] . ' — view ' . ($gi + 1), 400, 400) ?>
          </button>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <!-- ---------- summary ---------- -->
      <div class="pd-summary">
        <span class="pd-flag"><?= e($product['badge']) ?></span>
        <h1 class="pd-title"><?= e($product['name']) ?></h1>
        <p class="pd-short"><?= e($product['short']) ?></p>

        <p class="pd-price">
          <?php if ($product['old_price']): ?>
            <span class="pd-price__old"><?= e(money($product['old_price'])) ?></span>
          <?php endif; ?>
          <span class="pd-price__now"><?= e(money($product['price'])) ?></span>
        </p>

        <p class="pd-rating">
          <?php if ($rating['count']): ?>
            <?= stars_html($rating['avg']) ?>
            <a href="#reviews"><?= $rating['avg'] ?> out of 5 — <?= $rating['count'] ?> review<?= $rating['count'] > 1 ? 's' : '' ?></a>
          <?php else: ?>
            <?= stars_html(0) ?>
            <a href="#reviews">No reviews yet — be the first</a>
          <?php endif; ?>
        </p>

        <form class="pd-buy" method="post" action="<?= e($selfUrl) ?>">
          <?= csrf_field() ?>
          <input type="hidden" name="form_action" value="add-to-cart">

          <div class="pd-qty" data-qty>
            <button type="button" data-qty-step="down" aria-label="Decrease quantity"><?= icon('minus') ?></button>
            <label for="pdQty" class="shop-sr">Quantity</label>
            <input type="number" id="pdQty" name="qty" value="1" min="1" max="<?= CART_MAX_QTY ?>" inputmode="numeric">
            <button type="button" data-qty-step="up" aria-label="Increase quantity"><?= icon('plus') ?></button>
          </div>

          <button type="submit" class="pd-add" data-add-to-cart="<?= e($product['slug']) ?>" data-qty-from="#pdQty">
            Add to cart
          </button>
          <a href="cart.php" class="pd-add__chip" aria-label="Go to cart"><?= icon('arrow') ?></a>
        </form>

        <ul class="pd-assure">
          <li><?= icon('shield') ?><span>Original brand warranty, invoiced in your company name</span></li>
          <li><?= icon('truck') ?><span>Karachi delivery in 2–3 working days — installation quoted separately</span></li>
          <li><?= icon('headset') ?><span>Bench tested before dispatch, with technical support after handover</span></li>
        </ul>

        <dl class="pd-meta">
          <div>
            <dt>SKU:</dt>
            <dd><?= e($product['sku']) ?></dd>
          </div>
          <div>
            <dt>Category:</dt>
            <dd><a href="products.php"><?= e(category_label($product['category'])) ?></a></dd>
          </div>
          <div>
            <dt>Tags:</dt>
            <dd><?= e(implode(', ', $product['tags'])) ?></dd>
          </div>
        </dl>
      </div>

    </div>
  </div>
</section>

<!-- ============ DESCRIPTION / REVIEWS ============ -->
<section class="pd-tabs-sec">
  <div class="container">

    <div class="pd-tabs" id="pdTabs" role="tablist" aria-label="Product information">
      <button type="button" role="tab" class="pd-tab is-active" aria-selected="true"
              aria-controls="pdDescription" id="pdTabDescription">Description</button>
      <button type="button" role="tab" class="pd-tab" aria-selected="false" tabindex="-1"
              aria-controls="pdReviews" id="pdTabReviews">Reviews (<?= count($reviews) ?>)</button>
    </div>

    <!-- ---------- description ---------- -->
    <div class="pd-panel" id="pdDescription" role="tabpanel" aria-labelledby="pdTabDescription">
      <h2 class="pd-panel__title"><?= e($product['name']) ?></h2>
      <?php foreach ($product['body'] as $para): ?>
      <p><?= e($para) ?></p>
      <?php endforeach; ?>

      <ul class="pd-bullets">
        <?php foreach ($product['bullets'] as $b): ?>
        <li><?= e($b) ?></li>
        <?php endforeach; ?>
      </ul>

      <h3 class="pd-specs__title">Technical specification</h3>
      <table class="pd-specs">
        <tbody>
          <tr><th scope="row">Model / SKU</th><td><?= e($product['sku']) ?></td></tr>
          <tr><th scope="row">Category</th><td><?= e(category_label($product['category'])) ?></td></tr>
          <?php foreach ($product['specs'] as $si => $spec): ?>
          <tr><th scope="row">Key spec <?= $si + 1 ?></th><td><?= e($spec) ?></td></tr>
          <?php endforeach; ?>
          <tr><th scope="row">Price</th><td><?= e(money($product['price'])) ?> (excluding installation)</td></tr>
        </tbody>
      </table>
    </div>

    <!-- ---------- reviews ---------- -->
    <div class="pd-panel" id="pdReviews" role="tabpanel" aria-labelledby="pdTabReviews" hidden>
      <a id="reviews" class="pd-anchor" aria-hidden="true"></a>

      <?php if ($justSaved): ?>
      <p class="pd-note pd-note--ok">Thanks — your review has been posted.</p>
      <?php endif; ?>

      <?php if (!$reviews): ?>
        <p class="pd-noreviews">There are no reviews yet. If you have installed this hardware on a site, tell the next buyer how it held up.</p>
      <?php else: ?>
        <ul class="pd-reviews">
          <?php foreach ($reviews as $r): ?>
          <li class="pd-review">
            <span class="pd-review__avatar" aria-hidden="true"><?= e(mb_strtoupper(mb_substr($r['author'], 0, 1))) ?></span>
            <div class="pd-review__body">
              <?= stars_html((float) $r['rating']) ?>
              <p class="pd-review__by">
                <strong><?= e($r['author']) ?></strong>
                <span aria-hidden="true">–</span>
                <time datetime="<?= e(date('Y-m-d', strtotime((string) $r['created_at']))) ?>">
                  <?= e(date('F j, Y', strtotime((string) $r['created_at']))) ?>
                </time>
              </p>
              <p class="pd-review__text"><?= nl2br(e($r['body'])) ?></p>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <!-- add a review -->
      <div class="pd-reviewform">
        <h3>Add a review</h3>
        <p class="pd-reviewform__note">Your email address will not be published. Required fields are marked <span>*</span></p>

        <?php if (!empty($errors['form'])): ?>
        <p class="pd-note pd-note--err"><?= e($errors['form']) ?></p>
        <?php endif; ?>

        <form method="post" action="<?= e($selfUrl) ?>#reviews" novalidate>
          <?= csrf_field() ?>
          <input type="hidden" name="form_action" value="review">
          <input type="text" name="website" class="shop-sr" tabindex="-1" autocomplete="off" aria-hidden="true">

          <div class="pd-rate">
            <span class="pd-rate__label">Your rating <span>*</span></span>
            <div class="pd-rate__stars" id="reviewRating">
              <input type="hidden" name="rating" value="<?= (int) ($old['rating'] ?? 0) ?>">
              <?php for ($i = 1; $i <= 5; $i++): ?>
              <button type="button" aria-label="<?= $i ?> star<?= $i > 1 ? 's' : '' ?>">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path d="m12 3 2.6 5.7 6.4.7-4.7 4.3 1.3 6.3L12 17l-5.6 3 1.3-6.3L3 9.4l6.4-.7L12 3Z"/>
                </svg>
              </button>
              <?php endfor; ?>
            </div>
            <?php if (!empty($errors['rating'])): ?><span class="pd-err"><?= e($errors['rating']) ?></span><?php endif; ?>
          </div>

          <div class="pd-fields">
            <p class="pd-field">
              <label for="rvName" class="shop-sr">Name</label>
              <input type="text" id="rvName" name="author" placeholder="Name *" value="<?= e($old['author'] ?? '') ?>" required>
              <?php if (!empty($errors['author'])): ?><span class="pd-err"><?= e($errors['author']) ?></span><?php endif; ?>
            </p>
            <p class="pd-field">
              <label for="rvEmail" class="shop-sr">Email</label>
              <input type="email" id="rvEmail" name="email" placeholder="Email *" value="<?= e($old['email'] ?? '') ?>" required>
              <?php if (!empty($errors['email'])): ?><span class="pd-err"><?= e($errors['email']) ?></span><?php endif; ?>
            </p>
          </div>

          <p class="pd-field">
            <label for="rvBody" class="shop-sr">Your review</label>
            <textarea id="rvBody" name="body" rows="6" placeholder="Your review *" required><?= e($old['body'] ?? '') ?></textarea>
            <?php if (!empty($errors['body'])): ?><span class="pd-err"><?= e($errors['body']) ?></span><?php endif; ?>
          </p>

          <button type="submit" class="pd-submit">Submit</button>
        </form>
      </div>
    </div>

  </div>
</section>

<!-- ============ RELATED PRODUCTS ============ -->
<?php if ($related): ?>
<section class="pd-related">
  <div class="container">
    <h2 class="pd-related__title">Related products</h2>

    <div class="shop-grid shop-grid--four">
      <?php foreach ($related as $r):
        $rUrl    = 'product-detail.php?slug=' . urlencode($r['slug']);
        $rRating = $ratings[$r['slug']] ?? ['avg' => 0.0, 'count' => 0];
        $rOff    = discount_percent($r);
      ?>
      <article class="shop-card">
        <div class="shop-card__media">
          <a href="<?= e($rUrl) ?>" class="shop-card__media-link" tabindex="-1" aria-hidden="true">
            <?= img($r['image'], $r['name'], 550, 550) ?>
          </a>
          <span class="shop-card__flag"><?= e($r['badge']) ?></span>
          <?php if ($rOff): ?><span class="shop-card__off"><?= $rOff ?>% OFF</span><?php endif; ?>
          <div class="shop-card__actions">
            <button type="button" class="shop-card__cart" data-add-to-cart="<?= e($r['slug']) ?>">Add to cart</button>
            <a href="<?= e($rUrl) ?>" class="shop-card__chip" aria-label="View <?= e($r['name']) ?>"><?= icon('arrow') ?></a>
          </div>
        </div>
        <div class="shop-card__body">
          <h3 class="shop-card__title"><a href="<?= e($rUrl) ?>"><?= e($r['name']) ?></a></h3>
          <p class="shop-card__meta">
            <?php if ($r['old_price']): ?><span class="shop-card__old"><?= e(money($r['old_price'])) ?></span><?php endif; ?>
            <span class="shop-card__key"><?= e(money($r['price'])) ?></span>
          </p>
          <?php if ($rRating['count']): ?>
            <p class="shop-card__rating"><?= stars_html($rRating['avg']) ?><span>(<?= $rRating['count'] ?>)</span></p>
          <?php else: ?>
            <ul class="shop-card__specs">
              <?php foreach (array_slice($r['specs'], 0, 2) as $spec): ?>
              <li><?= icon('check') ?><span><?= e($spec) ?></span></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

</main>

<?php
$hideClients = true;
require_once __DIR__ . '/includes/footer.php';
