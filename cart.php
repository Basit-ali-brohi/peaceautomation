<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/shop.php';

// No-JS fallbacks: the quantity form and the remove links post here.
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && csrf_verify($_POST['csrf_token'] ?? null)) {
    $action = (string) ($_POST['form_action'] ?? '');

    if ($action === 'update' && is_array($_POST['qty'] ?? null)) {
        foreach ($_POST['qty'] as $slug => $qty) {
            cart_set((string) $slug, (int) $qty);
        }
    } elseif ($action === 'remove') {
        cart_remove((string) ($_POST['slug'] ?? ''));
    } elseif ($action === 'clear') {
        cart_clear();
    }

    header('Location: cart.php');
    exit;
}

$lines    = cart_lines();
$subtotal = cart_subtotal();

$pageTitle = 'Your Cart | ' . cfg('name');
$pageDesc  = 'Review the security hardware in your cart before placing the order.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="pd-bar">
  <div class="container">
    <nav class="pd-crumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span aria-hidden="true">›</span>
      <a href="products.php">Products</a>
      <span aria-hidden="true">›</span>
      <span>Cart</span>
    </nav>
  </div>
</section>

<main id="main">
<section class="ck-sec">
  <div class="container">

    <h1 class="ck-title">Your cart</h1>

    <?php if (!$lines): ?>

      <div class="ck-empty">
        <span class="ck-empty__icon"><?= icon('cart') ?></span>
        <h2>Your cart is empty</h2>
        <p>Browse the hardware catalogue and add what you need — you can adjust quantities before placing the order.</p>
        <a href="products.php" class="btn btn--primary">
          Browse products <span class="btn__chip"><?= icon('arrow') ?></span>
        </a>
      </div>

    <?php else: ?>

      <form method="post" action="cart.php" class="ck-layout">
        <?= csrf_field() ?>
        <input type="hidden" name="form_action" value="update">

        <!-- ---------- lines ---------- -->
        <div class="ck-lines" id="cartLines">
          <div class="ck-lines__head" aria-hidden="true">
            <span>Product</span>
            <span>Price</span>
            <span>Quantity</span>
            <span>Subtotal</span>
            <span></span>
          </div>

          <?php foreach ($lines as $l): $p = $l['product']; ?>
          <div class="ck-line" data-line="<?= e($p['slug']) ?>">
            <div class="ck-line__product">
              <a href="product-detail.php?slug=<?= urlencode($p['slug']) ?>" class="ck-line__thumb">
                <?= img($p['image'], $p['name'], 160, 160) ?>
              </a>
              <div>
                <a href="product-detail.php?slug=<?= urlencode($p['slug']) ?>" class="ck-line__name"><?= e($p['name']) ?></a>
                <span class="ck-line__sku">SKU: <?= e($p['sku']) ?></span>
              </div>
            </div>

            <div class="ck-line__price" data-label="Price"><?= e(money($p['price'])) ?></div>

            <div class="ck-line__qty" data-label="Quantity">
              <div class="pd-qty pd-qty--sm" data-qty>
                <button type="button" data-qty-step="down" aria-label="Decrease quantity"><?= icon('minus') ?></button>
                <label for="qty-<?= e($p['slug']) ?>" class="shop-sr">Quantity for <?= e($p['name']) ?></label>
                <input type="number" id="qty-<?= e($p['slug']) ?>" name="qty[<?= e($p['slug']) ?>]"
                       data-line-qty="<?= e($p['slug']) ?>" value="<?= $l['qty'] ?>"
                       min="0" max="<?= CART_MAX_QTY ?>" inputmode="numeric">
                <button type="button" data-qty-step="up" aria-label="Increase quantity"><?= icon('plus') ?></button>
              </div>
            </div>

            <div class="ck-line__total" data-label="Subtotal" data-line-total><?= e(money($l['line'])) ?></div>

            <div class="ck-line__remove">
              <button type="button" class="ck-remove" data-line-remove="<?= e($p['slug']) ?>"
                      aria-label="Remove <?= e($p['name']) ?> from cart"><?= icon('trash') ?></button>
            </div>
          </div>
          <?php endforeach; ?>

          <div class="ck-lines__foot">
            <a href="products.php" class="ck-continue">← Continue shopping</a>
            <div class="ck-lines__actions">
              <button type="button" class="ck-clear" id="cartClear">Clear cart</button>
              <!-- Only shown when JavaScript is off; the steppers save on change otherwise. -->
              <noscript><button type="submit" class="shop-filter-btn">Update cart</button></noscript>
            </div>
          </div>
        </div>

        <!-- ---------- totals ---------- -->
        <aside class="ck-totals" aria-label="Cart totals">
          <h2>Cart totals</h2>

          <dl class="ck-totals__rows">
            <div>
              <dt>Subtotal</dt>
              <dd data-cart-subtotal><?= e(money($subtotal)) ?></dd>
            </div>
            <div>
              <dt>Delivery</dt>
              <dd class="ck-totals__muted">Quoted on confirmation</dd>
            </div>
            <div>
              <dt>Installation</dt>
              <dd class="ck-totals__muted">Optional — surveyed separately</dd>
            </div>
          </dl>

          <div class="ck-totals__grand">
            <span>Total</span>
            <strong data-cart-subtotal><?= e(money($subtotal)) ?></strong>
          </div>

          <a href="checkout.php" class="ck-checkout">
            Proceed to checkout <span class="ck-checkout__chip"><?= icon('arrow') ?></span>
          </a>

          <p class="ck-totals__note">
            <?= icon('shield') ?>
            <span>No online payment is taken here. You confirm the order, we confirm stock and delivery, and you pay on delivery or by bank transfer.</span>
          </p>
        </aside>
      </form>

    <?php endif; ?>

  </div>
</section>
</main>

<?php
$hideClients = true;
$hideConnect = true;
require_once __DIR__ . '/includes/footer.php';
