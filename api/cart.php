<?php
/**
 * Cart endpoint — JSON in/out.
 * action = add | set | remove | clear | get
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/../includes/shop.php';

header('Content-Type: application/json; charset=utf-8');

function cart_fail(string $message, int $code = 422): never
{
    http_response_code($code);
    echo json_encode(['ok' => false, 'message' => $message]);
    exit;
}

$action = (string) ($_REQUEST['action'] ?? 'get');

// Reading the cart is safe on GET; anything that changes it must be a
// POST carrying the session's CSRF token.
if ($action !== 'get') {
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        cart_fail('Method not allowed.', 405);
    }
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        cart_fail('Your session expired. Please refresh the page and try again.', 419);
    }
}

$slug = trim((string) ($_POST['slug'] ?? ''));
$qty  = (int) ($_POST['qty'] ?? 1);

switch ($action) {
    case 'add':
        if (!cart_add($slug, max(1, $qty))) {
            cart_fail('That product is no longer available.', 404);
        }
        $message = 'Added to your cart.';
        break;

    case 'set':
        if (!cart_set($slug, $qty)) {
            cart_fail('That product is no longer available.', 404);
        }
        $message = $qty > 0 ? 'Cart updated.' : 'Item removed.';
        break;

    case 'remove':
        cart_remove($slug);
        $message = 'Item removed.';
        break;

    case 'clear':
        cart_clear();
        $message = 'Cart cleared.';
        break;

    case 'get':
        $message = '';
        break;

    default:
        cart_fail('Unknown action.', 400);
}

echo json_encode(['ok' => true, 'message' => $message, 'cart' => cart_summary()]);
