<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/shop.php';

$reference = trim((string) ($_GET['ref'] ?? ''));

// Only the browser that placed the order can read it back — an order
// reference on its own is not a key to somebody else's details.
if ($reference === '' || ($_SESSION['last_order'] ?? '') !== $reference) {
    header('Location: products.php');
    exit;
}

$order = order_by_reference($reference);
if (!$order) {
    header('Location: products.php');
    exit;
}

$pageTitle = 'Order ' . $reference . ' | ' . cfg('name');
$pageDesc  = 'Your order has been received.';
$bank      = cfg('bank');

require_once __DIR__ . '/includes/header.php';
?>

<!-- The transparent header sits on white text, so every page needs a dark
     band behind it — this bar is that band as well as the breadcrumb. -->
<section class="pd-bar">
  <div class="container">
    <nav class="pd-crumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span aria-hidden="true">›</span>
      <a href="products.php">Products</a>
      <span aria-hidden="true">›</span>
      <span>Order <?= e($order['reference']) ?></span>
    </nav>
  </div>
</section>

<main id="main">
<section class="ck-sec">
  <div class="container">

    <div class="oc-head">
      <span class="oc-tick"><?= icon('check') ?></span>
      <h1>Thank you — your order is in.</h1>
      <p>We have your request and the team will call <strong><?= e($order['phone']) ?></strong> to confirm stock and a delivery slot. Nothing is charged until then.</p>
    </div>

    <div class="oc-grid">

      <!-- ---------- receipt ---------- -->
      <div class="oc-card">
        <h2>Order summary</h2>

        <dl class="oc-facts">
          <div><dt>Order reference</dt><dd class="oc-ref"><?= e($order['reference']) ?></dd></div>
          <div><dt>Placed</dt><dd><?= e(date('F j, Y', strtotime((string) $order['created_at']))) ?></dd></div>
          <div><dt>Payment</dt><dd><?= e(PAYMENT_METHODS[$order['payment_method']] ?? $order['payment_method']) ?></dd></div>
          <div><dt>Status</dt><dd><span class="oc-status">Awaiting confirmation</span></dd></div>
        </dl>

        <table class="oc-items">
          <thead>
            <tr><th scope="col">Product</th><th scope="col">Qty</th><th scope="col">Total</th></tr>
          </thead>
          <tbody>
            <?php foreach ($order['items'] as $item): ?>
            <tr>
              <td>
                <?= e($item['product_name']) ?>
                <span class="oc-sku">SKU: <?= e((string) $item['sku']) ?></span>
              </td>
              <td><?= (int) $item['quantity'] ?></td>
              <td><?= e(money((int) $item['line_total'])) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th scope="row" colspan="2">Order total</th>
              <td><?= e(money((int) $order['total'])) ?></td>
            </tr>
          </tfoot>
        </table>

        <p class="oc-note">Delivery and installation are quoted when we confirm the order, so the total above covers hardware only.</p>
      </div>

      <!-- ---------- next steps ---------- -->
      <aside class="oc-side">
        <div class="oc-card">
          <h2>Delivering to</h2>
          <address class="oc-address">
            <strong><?= e($order['name']) ?></strong><br>
            <?php if ($order['company']): ?><?= e($order['company']) ?><br><?php endif; ?>
            <?= e($order['address']) ?><br>
            <?= e($order['city']) ?><br>
            <?= e($order['phone']) ?>
            <?php if ($order['email']): ?><br><?= e($order['email']) ?><?php endif; ?>
          </address>
        </div>

        <?php if ($order['payment_method'] === 'bank'): ?>
        <div class="oc-card oc-card--bank">
          <h2>Bank transfer details</h2>
          <dl class="oc-facts">
            <div><dt>Account title</dt><dd><?= e($bank['title']) ?></dd></div>
            <div><dt>Bank</dt><dd><?= e($bank['bank']) ?></dd></div>
            <div><dt>Account</dt><dd><?= e($bank['account']) ?></dd></div>
            <div><dt>IBAN</dt><dd><?= e($bank['iban']) ?></dd></div>
          </dl>
          <p class="oc-note">Quote <strong><?= e($order['reference']) ?></strong> in the transfer reference and send the receipt to <?= e(cfg('email')) ?>.</p>
        </div>
        <?php endif; ?>

        <div class="oc-card">
          <h2>Need to change something?</h2>
          <p class="oc-note">Call us with your order reference and we will adjust it before dispatch.</p>
          <a href="tel:<?= e(cfg('phone_href')) ?>" class="oc-phone"><?= icon('phone') ?><?= e(cfg('phone')) ?></a>
          <a href="products.php" class="oc-back">← Back to products</a>
        </div>
      </aside>

    </div>
  </div>
</section>
</main>

<?php
$hideClients = true;
$hideConnect = true;
require_once __DIR__ . '/includes/footer.php';
