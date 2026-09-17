<?php
/**
 * Shop layer: product lookup, the session cart, orders and reviews.
 *
 * Prices are whole rupees (int) everywhere — no floats, no currency maths
 * in the templates. The cart lives in the session as [slug => qty]; the
 * price always comes from data.php at render time, never from the session,
 * so a stale cart can never carry an old price into an order.
 */

declare(strict_types=1);

require_once __DIR__ . '/functions.php';

const CART_KEY      = 'cart';
const CART_MAX_QTY  = 99;

/* ---------------------------------------------------------------
   Products
   --------------------------------------------------------------- */

/** @return array<int,array> */
function products(): array
{
    return data('products');
}

function product_by_slug(string $slug): ?array
{
    foreach (products() as $p) {
        if ($p['slug'] === $slug) {
            return $p;
        }
    }
    return null;
}

/** Other products in the same category, falling back to any product. */
function related_products(array $product, int $limit = 4): array
{
    $same  = [];
    $other = [];
    foreach (products() as $p) {
        if ($p['slug'] === $product['slug']) {
            continue;
        }
        if ($p['category'] === $product['category']) {
            $same[] = $p;
        } else {
            $other[] = $p;
        }
    }
    return array_slice(array_merge($same, $other), 0, $limit);
}

function product_categories(): array
{
    return data('product_categories');
}

function product_features(): array
{
    return data('product_features');
}

function category_label(string $key): string
{
    return product_categories()[$key] ?? ucfirst($key);
}

/** 18500 → "Rs 18,500" */
function money(int $rupees): string
{
    return 'Rs ' . number_format($rupees);
}

/* ---------------------------------------------------------------
   Cart — session only, keyed by slug
   --------------------------------------------------------------- */

/** @return array<string,int> slug => qty */
function cart(): array
{
    return is_array($_SESSION[CART_KEY] ?? null) ? $_SESSION[CART_KEY] : [];
}

function cart_save(array $cart): void
{
    $_SESSION[CART_KEY] = $cart;
}

function cart_add(string $slug, int $qty = 1): bool
{
    if (!product_by_slug($slug)) {
        return false;
    }
    $cart = cart();
    $cart[$slug] = min(CART_MAX_QTY, max(1, ($cart[$slug] ?? 0) + $qty));
    cart_save($cart);
    return true;
}

/** Sets an absolute quantity; 0 removes the line. */
function cart_set(string $slug, int $qty): bool
{
    if (!product_by_slug($slug)) {
        return false;
    }
    $cart = cart();
    if ($qty <= 0) {
        unset($cart[$slug]);
    } else {
        $cart[$slug] = min(CART_MAX_QTY, $qty);
    }
    cart_save($cart);
    return true;
}

function cart_remove(string $slug): void
{
    $cart = cart();
    unset($cart[$slug]);
    cart_save($cart);
}

function cart_clear(): void
{
    cart_save([]);
}

/**
 * Cart lines joined to live product data. Any slug that no longer exists in
 * data.php is dropped, so a renamed product cannot break the cart page.
 *
 * @return array<int,array{product:array,qty:int,line:int}>
 */
function cart_lines(): array
{
    $lines = [];
    $cart  = cart();
    $dirty = false;

    foreach ($cart as $slug => $qty) {
        $product = product_by_slug((string) $slug);
        if (!$product) {
            unset($cart[$slug]);
            $dirty = true;
            continue;
        }
        $qty     = min(CART_MAX_QTY, max(1, (int) $qty));
        $lines[] = [
            'product' => $product,
            'qty'     => $qty,
            'line'    => $product['price'] * $qty,
        ];
    }

    if ($dirty) {
        cart_save($cart);
    }
    return $lines;
}

function cart_count(): int
{
    return array_sum(array_map('intval', cart()));
}

function cart_subtotal(): int
{
    $sum = 0;
    foreach (cart_lines() as $l) {
        $sum += $l['line'];
    }
    return $sum;
}

/** Everything the front end needs after a cart change. */
function cart_summary(): array
{
    $items = [];
    foreach (cart_lines() as $l) {
        $items[] = [
            'slug'  => $l['product']['slug'],
            'name'  => $l['product']['name'],
            'qty'   => $l['qty'],
            'price' => $l['product']['price'],
            'line'  => $l['line'],
        ];
    }
    $subtotal = cart_subtotal();

    return [
        'count'           => cart_count(),
        'subtotal'        => $subtotal,
        'subtotal_display'=> money($subtotal),
        'items'           => $items,
    ];
}

/* ---------------------------------------------------------------
   Database — optional. A dead database must never blank a page,
   so this returns null instead of dying like get_db_connection().
   --------------------------------------------------------------- */

function shop_db(): ?PDO
{
    static $pdo = false;   // false = not tried yet, null = tried and failed

    if ($pdo !== false) {
        return $pdo;
    }

    require_once __DIR__ . '/../config/db.php';

    try {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );
    } catch (PDOException $e) {
        error_log('Shop database unavailable: ' . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}

/* ---------------------------------------------------------------
   Reviews
   --------------------------------------------------------------- */

/** @return array<int,array> approved reviews, newest first */
function product_reviews(string $slug): array
{
    $db = shop_db();
    if (!$db) {
        return [];
    }
    try {
        $stmt = $db->prepare(
            'SELECT author, rating, body, created_at
               FROM product_reviews
              WHERE product_slug = ? AND is_approved = 1
           ORDER BY created_at DESC'
        );
        $stmt->execute([$slug]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log('Review fetch failed: ' . $e->getMessage());
        return [];
    }
}

/** @return array{avg:float,count:int} — count 0 means "no reviews yet". */
function product_rating(string $slug): array
{
    $db = shop_db();
    if (!$db) {
        return ['avg' => 0.0, 'count' => 0];
    }
    try {
        $stmt = $db->prepare(
            'SELECT AVG(rating) AS avg_rating, COUNT(*) AS n
               FROM product_reviews
              WHERE product_slug = ? AND is_approved = 1'
        );
        $stmt->execute([$slug]);
        $row = $stmt->fetch() ?: [];
        return [
            'avg'   => round((float) ($row['avg_rating'] ?? 0), 1),
            'count' => (int) ($row['n'] ?? 0),
        ];
    } catch (PDOException $e) {
        error_log('Rating fetch failed: ' . $e->getMessage());
        return ['avg' => 0.0, 'count' => 0];
    }
}

/**
 * Ratings for every product in one query — the grid would otherwise fire
 * one SELECT per card.
 *
 * @return array<string,array{avg:float,count:int}>
 */
function all_product_ratings(): array
{
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }

    $cache = [];
    $db    = shop_db();
    if (!$db) {
        return $cache;
    }
    try {
        $rows = $db->query(
            'SELECT product_slug, AVG(rating) AS avg_rating, COUNT(*) AS n
               FROM product_reviews
              WHERE is_approved = 1
           GROUP BY product_slug'
        )->fetchAll();
        foreach ($rows as $r) {
            $cache[$r['product_slug']] = [
                'avg'   => round((float) $r['avg_rating'], 1),
                'count' => (int) $r['n'],
            ];
        }
    } catch (PDOException $e) {
        error_log('Ratings fetch failed: ' . $e->getMessage());
    }
    return $cache;
}

/** Percentage saved, or null when the product has no struck-through price. */
function discount_percent(array $product): ?int
{
    $old = $product['old_price'] ?? null;
    if (!$old || $old <= $product['price']) {
        return null;
    }
    return (int) round(100 - ($product['price'] / $old * 100));
}

/**
 * Five stars, filled to $rating. Half stars are rounded to the nearest
 * whole star — a 4.5 average shows as 5 filled with the number beside it.
 */
function stars_html(float $rating, string $class = ''): string
{
    $filled = (int) round($rating);
    $out    = '<span class="stars ' . e($class) . '" aria-hidden="true">';
    for ($i = 1; $i <= 5; $i++) {
        $out .= '<svg class="stars__i' . ($i <= $filled ? ' is-on' : '') . '" viewBox="0 0 24 24" '
              . 'fill="currentColor" aria-hidden="true">'
              . '<path d="m12 3 2.6 5.7 6.4.7-4.7 4.3 1.3 6.3L12 17l-5.6 3 1.3-6.3L3 9.4l6.4-.7L12 3Z"/></svg>';
    }
    return $out . '</span>';
}

/* ---------------------------------------------------------------
   Orders
   --------------------------------------------------------------- */

const PAYMENT_METHODS = [
    'cod'  => 'Cash on delivery',
    'bank' => 'Bank transfer',
];

/**
 * Writes the order and its lines in one transaction.
 *
 * @param  array $buyer   name, email, phone, company, address, city, notes, payment_method
 * @param  array $lines   output of cart_lines()
 * @return string|null    the order reference, or null when the write failed
 */
function create_order(array $buyer, array $lines): ?string
{
    $db = shop_db();
    if (!$db || !$lines) {
        return null;
    }

    $subtotal = 0;
    foreach ($lines as $l) {
        $subtotal += $l['line'];
    }

    try {
        $db->beginTransaction();

        $db->prepare(
            'INSERT INTO orders
                (reference, name, email, phone, company, address, city, notes,
                 payment_method, subtotal, total, ip_address)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        )->execute([
            'PENDING',
            $buyer['name'],
            $buyer['email'] !== '' ? $buyer['email'] : null,
            $buyer['phone'],
            $buyer['company'] !== '' ? $buyer['company'] : null,
            $buyer['address'],
            $buyer['city'],
            $buyer['notes'] !== '' ? $buyer['notes'] : null,
            $buyer['payment_method'],
            $subtotal,
            $subtotal,
            $_SERVER['REMOTE_ADDR'] ?? null,
        ]);

        $orderId   = (int) $db->lastInsertId();
        $reference = 'PA' . date('ymd') . str_pad((string) $orderId, 4, '0', STR_PAD_LEFT);
        $db->prepare('UPDATE orders SET reference = ? WHERE id = ?')->execute([$reference, $orderId]);

        $item = $db->prepare(
            'INSERT INTO order_items
                (order_id, product_slug, product_name, sku, unit_price, quantity, line_total)
             VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        foreach ($lines as $l) {
            $item->execute([
                $orderId,
                $l['product']['slug'],
                $l['product']['name'],
                $l['product']['sku'] ?? null,
                $l['product']['price'],
                $l['qty'],
                $l['line'],
            ]);
        }

        $db->commit();
        return $reference;
    } catch (PDOException $e) {
        if ($db->inTransaction()) {
            $db->rollBack();
        }
        error_log('Order insert failed: ' . $e->getMessage());
        return null;
    }
}

/** One order plus its lines, for the confirmation page. */
function order_by_reference(string $reference): ?array
{
    $db = shop_db();
    if (!$db) {
        return null;
    }
    try {
        $stmt = $db->prepare('SELECT * FROM orders WHERE reference = ?');
        $stmt->execute([$reference]);
        $order = $stmt->fetch();
        if (!$order) {
            return null;
        }
        $stmt = $db->prepare('SELECT * FROM order_items WHERE order_id = ? ORDER BY id');
        $stmt->execute([$order['id']]);
        $order['items'] = $stmt->fetchAll();
        return $order;
    } catch (PDOException $e) {
        error_log('Order fetch failed: ' . $e->getMessage());
        return null;
    }
}

/* ---------------------------------------------------------------
   Mail — same SMTP-or-mail() fallback the contact form uses.
   --------------------------------------------------------------- */

function send_site_mail(string $subject, string $body, string $replyTo = '', string $replyName = ''): bool
{
    $cfg       = cfg('mail');
    $phpmailer = __DIR__ . '/../vendor/PHPMailer/PHPMailer.php';

    if (!empty($cfg['smtp']) && is_file($phpmailer)) {
        require_once $phpmailer;
        require_once __DIR__ . '/../vendor/PHPMailer/SMTP.php';
        require_once __DIR__ . '/../vendor/PHPMailer/Exception.php';

        try {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = $cfg['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $cfg['username'];
            $mail->Password   = $cfg['password'];
            $mail->SMTPSecure = $cfg['encryption'];
            $mail->Port       = (int) $cfg['port'];
            $mail->setFrom($cfg['from'], $cfg['from_name']);
            $mail->addAddress($cfg['to']);
            if ($replyTo !== '') {
                $mail->addReplyTo($replyTo, $replyName !== '' ? $replyName : $replyTo);
            }
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();
            return true;
        } catch (Throwable $e) {
            error_log('SMTP send failed: ' . $e->getMessage());
            return false;
        }
    }

    $headers = 'From: ' . $cfg['from_name'] . ' <' . $cfg['from'] . '>' . "\r\n";
    if ($replyTo !== '') {
        $headers .= 'Reply-To: ' . $replyTo . "\r\n";
    }
    return @mail($cfg['to'], $subject, $body, $headers);
}

/** Keeps a local copy of anything important, so mail trouble never loses it. */
function shop_log(string $file, string $text): void
{
    $dir = __DIR__ . '/../storage';
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
    @file_put_contents($dir . '/' . $file, date('c') . ' | ' . $text . PHP_EOL, FILE_APPEND);
}
