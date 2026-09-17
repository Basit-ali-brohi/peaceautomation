<?php
/**
 * Newsletter signup — email + consent, appended to a CSV.
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

function nl_fail(string $message, array $errors = [], int $code = 422): never
{
    http_response_code($code);
    echo json_encode(['ok' => false, 'message' => $message, 'errors' => $errors]);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    nl_fail('Method not allowed.', [], 405);
}

if (!empty($_POST['website'])) {
    echo json_encode(['ok' => true, 'message' => 'Thanks for subscribing.']);
    exit;
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    nl_fail('Your session expired. Please refresh the page and try again.', [], 419);
}

$now  = time();
$last = $_SESSION['nl_last'] ?? 0;
if ($now - $last < 30) {
    nl_fail('Please wait a moment before subscribing again.', [], 429);
}

$email = trim((string) ($_POST['email'] ?? ''));
$errors = [];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Enter a valid email address.';
}
if (empty($_POST['consent'])) {
    $errors['consent'] = 'Please accept the terms to subscribe.';
}
if ($errors) {
    nl_fail('Please check the highlighted fields.', $errors);
}

$_SESSION['nl_last'] = $now;

$csv = (string) cfg('newsletter_csv');
$dir = dirname($csv);
if (!is_dir($dir)) {
    @mkdir($dir, 0775, true);
}
if (!is_file($csv)) {
    @file_put_contents($csv, "email,consent,ip,created_at\n");
}

// Skip duplicates rather than growing the file with the same address.
$existing = is_file($csv) ? file($csv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
foreach ($existing as $line) {
    if (strcasecmp(strtok($line, ','), $email) === 0) {
        echo json_encode(['ok' => true, 'message' => 'You are already subscribed — thank you.']);
        exit;
    }
}

$row = [$email, 'yes', $_SERVER['REMOTE_ADDR'] ?? '', date('c')];
$fh  = @fopen($csv, 'a');
if ($fh) {
    fputcsv($fh, $row);
    fclose($fh);
}

echo json_encode(['ok' => true, 'message' => 'Thanks — you are subscribed.']);
