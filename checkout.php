<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/shop.php';

$lines = cart_lines();

// Nothing to check out — send them back to the cart rather than showing an
// empty form.
if (!$lines) {
    header('Location: cart.php');
    exit;
}

$errors = [];
$old    = [
    'name' => '', 'company' => '', 'phone' => '', 'email' => '',
    'address' => '', 'city' => '', 'notes' => '', 'payment_method' => 'cod',
];

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    foreach ($old as $field => $_) {
        $old[$field] = trim((string) ($_POST[$field] ?? ''));
    }

    // Honeypot — silently accept and go nowhere.
    if (!empty($_POST['website'])) {
        header('Location: cart.php');
        exit;
    }

    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors['form'] = 'Your session expired. Please refresh the page and try again.';
    }

    if (mb_strlen($old['name']) < 2) {
        $errors['name'] = 'Please enter your full name.';
    }

    // Pakistani formats: 03xxxxxxxxx, +923xxxxxxxxx, 021xxxxxxx
    $digits = preg_replace('/\D+/', '', $old['phone']) ?? '';
    if ($digits === '' || !preg_match('/^(92|0)?(3\d{9}|\d{2,3}\d{7,8})$/', $digits)) {
        $errors['phone'] = 'Enter a valid Pakistani phone number.';
    }

    if ($old['email'] !== '' && !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }

    if (mb_strlen($old['address']) < 8) {
        $errors['address'] = 'Please give the full delivery address.';
    }

    if ($old['city'] === '') {
        $errors['city'] = 'Please enter the city.';
    }

    if (!array_key_exists($old['payment_method'], PAYMENT_METHODS)) {
        $errors['payment_method'] = 'Please choose how you want to pay.';
    }

    if (!$errors) {
        $reference = create_order($old, $lines);

        if ($reference) {
            // ---- notify the office -------------------------------------
            $body = "New website order — {$reference}\n\n"
                  . "Name:    {$old['name']}\n"
                  . 'Company: ' . ($old['company'] !== '' ? $old['company'] : '—') . "\n"
                  . "Phone:   {$old['phone']}\n"
                  . 'Email:   ' . ($old['email'] !== '' ? $old['email'] : '—') . "\n"
                  . "Address: {$old['address']}, {$old['city']}\n"
                  . 'Payment: ' . PAYMENT_METHODS[$old['payment_method']] . "\n\n"
                  . "Items:\n";

            $total = 0;
            foreach ($lines as $l) {
                $total += $l['line'];
                $body  .= sprintf(
                    "  %-42s x%-3d %s\n",
                    $l['product']['name'],
                    $l['qty'],
                    money($l['line'])
                );
            }
            $body .= "\nOrder total: " . money($total) . "\n"
                   . 'Notes: ' . ($old['notes'] !== '' ? $old['notes'] : '—') . "\n"
                   . "\n--\nPlaced: " . date('Y-m-d H:i:s') . "\n";

            send_site_mail('Website order — ' . $reference, $body, $old['email'], $old['name']);
            shop_log('orders.log', str_replace("\n", ' | ', $body));

            cart_clear();
            $_SESSION['last_order'] = $reference;

            header('Location: order-confirmation.php?ref=' . urlencode($reference));
            exit;
        }

        $errors['form'] = 'We could not record the order just now. Please call us on ' . cfg('phone') . ' and we will take it directly.';
    }
}

$subtotal  = cart_subtotal();
$pageTitle = 'Checkout | ' . cfg('name');
$pageDesc  = 'Confirm your security hardware order — cash on delivery or bank transfer.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="pd-bar">
  <div class="container">
    <nav class="pd-crumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a>
      <span aria-hidden="true">›</span>
      <a href="cart.php">Cart</a>
      <span aria-hidden="true">›</span>
      <span>Checkout</span>
    </nav>
  </div>
</section>

<main id="main">
<section class="ck-sec">
  <div class="container">

    <h1 class="ck-title">Checkout</h1>
    <p class="ck-lead">No payment is taken online. Confirm the order and our team calls you back to verify stock, delivery date and any installation you need.</p>

    <?php if (!empty($errors['form'])): ?>
    <p class="pd-note pd-note--err"><?= e($errors['form']) ?></p>
    <?php endif; ?>

    <form method="post" action="checkout.php" class="ck-layout ck-layout--checkout" novalidate>
      <?= csrf_field() ?>
      <input type="text" name="website" class="shop-sr" tabindex="-1" autocomplete="off" aria-hidden="true">

      <!-- ---------- billing ---------- -->
      <div class="ck-form">
        <h2 class="ck-form__title">Delivery details</h2>

        <div class="ck-grid">
          <p class="pd-field">
            <label for="ckName">Full name <span>*</span></label>
            <input type="text" id="ckName" name="name" value="<?= e($old['name']) ?>" required autocomplete="name">
            <?php if (!empty($errors['name'])): ?><span class="pd-err"><?= e($errors['name']) ?></span><?php endif; ?>
          </p>
          <p class="pd-field">
            <label for="ckCompany">Company</label>
            <input type="text" id="ckCompany" name="company" value="<?= e($old['company']) ?>" autocomplete="organization">
          </p>
          <p class="pd-field">
            <label for="ckPhone">Phone <span>*</span></label>
            <input type="tel" id="ckPhone" name="phone" value="<?= e($old['phone']) ?>" required autocomplete="tel"
                   placeholder="03XX XXXXXXX">
            <?php if (!empty($errors['phone'])): ?><span class="pd-err"><?= e($errors['phone']) ?></span><?php endif; ?>
          </p>
          <p class="pd-field">
            <label for="ckEmail">Email</label>
            <input type="email" id="ckEmail" name="email" value="<?= e($old['email']) ?>" autocomplete="email">
            <?php if (!empty($errors['email'])): ?><span class="pd-err"><?= e($errors['email']) ?></span><?php endif; ?>
          </p>
          <p class="pd-field pd-field--wide">
            <label for="ckAddress">Delivery address <span>*</span></label>
            <input type="text" id="ckAddress" name="address" value="<?= e($old['address']) ?>" required
                   autocomplete="street-address" placeholder="Office / plot number, street, area">
            <?php if (!empty($errors['address'])): ?><span class="pd-err"><?= e($errors['address']) ?></span><?php endif; ?>
          </p>
          <p class="pd-field">
            <label for="ckCity">City <span>*</span></label>
            <input type="text" id="ckCity" name="city" value="<?= e($old['city']) ?>" required
                   autocomplete="address-level2" placeholder="Karachi">
            <?php if (!empty($errors['city'])): ?><span class="pd-err"><?= e($errors['city']) ?></span><?php endif; ?>
          </p>
          <p class="pd-field pd-field--wide">
            <label for="ckNotes">Order notes</label>
            <textarea id="ckNotes" name="notes" rows="4"
                      placeholder="Site details, floor, preferred delivery window, installation required…"><?= e($old['notes']) ?></textarea>
          </p>
        </div>

        <h2 class="ck-form__title">Payment</h2>
        <?php if (!empty($errors['payment_method'])): ?><span class="pd-err"><?= e($errors['payment_method']) ?></span><?php endif; ?>

        <div class="ck-pay">
          <label class="ck-pay__opt">
            <input type="radio" name="payment_method" value="cod" <?= $old['payment_method'] === 'cod' ? 'checked' : '' ?>>
            <span class="ck-pay__box">
              <span class="ck-pay__icon"><?= icon('truck') ?></span>
              <span class="ck-pay__text">
                <strong>Cash on delivery</strong>
                Pay the rider or our technician when the hardware reaches your site.
              </span>
            </span>
          </label>

          <label class="ck-pay__opt">
            <input type="radio" name="payment_method" value="bank" <?= $old['payment_method'] === 'bank' ? 'checked' : '' ?>>
            <span class="ck-pay__box">
              <span class="ck-pay__icon"><?= icon('wallet') ?></span>
              <span class="ck-pay__text">
                <strong>Bank transfer</strong>
                We send the account details with your order confirmation; dispatch follows the transfer.
              </span>
            </span>
          </label>
        </div>
      </div>

      <!-- ---------- summary ---------- -->
      <aside class="ck-totals" aria-label="Order summary">
        <h2>Your order</h2>

        <ul class="ck-summary">
          <?php foreach ($lines as $l): ?>
          <li>
            <span class="ck-summary__name"><?= e($l['product']['name']) ?> <em>× <?= $l['qty'] ?></em></span>
            <span class="ck-summary__val"><?= e(money($l['line'])) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>

        <dl class="ck-totals__rows">
          <div>
            <dt>Subtotal</dt>
            <dd><?= e(money($subtotal)) ?></dd>
          </div>
          <div>
            <dt>Delivery</dt>
            <dd class="ck-totals__muted">Quoted on confirmation</dd>
          </div>
        </dl>

        <div class="ck-totals__grand">
          <span>Total</span>
          <strong><?= e(money($subtotal)) ?></strong>
        </div>

        <button type="submit" class="ck-checkout ck-checkout--submit">
          Place order <span class="ck-checkout__chip"><?= icon('arrow') ?></span>
        </button>

        <p class="ck-totals__note">
          <?= icon('shield') ?>
          <span>We never ask for card or bank credentials on this site. Your details are used only to deliver and invoice this order.</span>
        </p>
      </aside>
    </form>

  </div>
</section>
</main>

<?php
$hideClients = true;
$hideConnect = true;
require_once __DIR__ . '/includes/footer.php';
