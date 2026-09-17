<?php
/**
 * Contact form handler — JSON in/out.
 * CSRF token + honeypot + per-session rate limit (1 submit / 30s).
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

function fail(string $message, array $errors = [], int $code = 422): never
{
    http_response_code($code);
    echo json_encode(['ok' => false, 'message' => $message, 'errors' => $errors]);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    fail('Method not allowed.', [], 405);
}

// Honeypot — a real user never fills this in.
if (!empty($_POST['website'])) {
    // Look successful so bots don't learn anything.
    echo json_encode(['ok' => true, 'message' => 'Thanks — we will be in touch shortly.']);
    exit;
}

if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    fail('Your session expired. Please refresh the page and try again.', [], 419);
}

// Rate limit
$now  = time();
$last = $_SESSION['contact_last'] ?? 0;
if ($now - $last < 30) {
    fail('Please wait a moment before sending another message.', [], 429);
}

$name    = trim((string) ($_POST['name']    ?? ''));
$phone   = trim((string) ($_POST['phone']   ?? ''));
$email   = trim((string) ($_POST['email']   ?? ''));
$city    = trim((string) ($_POST['city']    ?? ''));
$service = trim((string) ($_POST['service'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

$errors = [];

if ($name === '' || mb_strlen($name) < 2) {
    $errors['name'] = 'Please enter your name.';
}

// Pakistani formats: 03xxxxxxxxx, +923xxxxxxxxx, 021xxxxxxx, +9221xxxxxxx
$digits = preg_replace('/\D+/', '', $phone) ?? '';
if ($digits === '' || !preg_match('/^(92|0)?(3\d{9}|\d{2,3}\d{7,8})$/', $digits)) {
    $errors['phone'] = 'Enter a valid Pakistani phone number.';
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Enter a valid email address.';
}

if ($city === '') {
    $errors['city'] = 'Please tell us the city.';
}

$validServices = array_column(data('services'), 'title');
if ($service === '' || !in_array($service, $validServices, true)) {
    $errors['service'] = 'Please choose a service.';
}

if (mb_strlen($message) < 10) {
    $errors['message'] = 'Please give us a little more detail (10 characters or more).';
}

if ($errors) {
    fail('Please check the highlighted fields.', $errors);
}

$_SESSION['contact_last'] = $now;

// ---- Compose ------------------------------------------------------------
$body = "New enquiry from the website\n\n"
      . "Name:    {$name}\n"
      . "Phone:   {$phone}\n"
      . "Email:   " . ($email !== '' ? $email : '—') . "\n"
      . "City:    {$city}\n"
      . "Service: {$service}\n\n"
      . "Message:\n{$message}\n\n"
      . '--' . "\n"
      . 'IP: ' . ($_SERVER['REMOTE_ADDR'] ?? '?') . "\n"
      . 'Time: ' . date('Y-m-d H:i:s') . "\n";

$sent    = false;
$mailCfg = cfg('mail');

// PHPMailer if it has been dropped in and SMTP is configured, otherwise mail().
$phpmailer = __DIR__ . '/../vendor/PHPMailer/PHPMailer.php';
if (!empty($mailCfg['smtp']) && is_file($phpmailer)) {
    require_once $phpmailer;
    require_once __DIR__ . '/../vendor/PHPMailer/SMTP.php';
    require_once __DIR__ . '/../vendor/PHPMailer/Exception.php';

    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $mailCfg['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $mailCfg['username'];
        $mail->Password   = $mailCfg['password'];
        $mail->SMTPSecure = $mailCfg['encryption'];
        $mail->Port       = (int) $mailCfg['port'];
        $mail->setFrom($mailCfg['from'], $mailCfg['from_name']);
        $mail->addAddress($mailCfg['to']);
        if ($email !== '') {
            $mail->addReplyTo($email, $name);
        }
        $mail->Subject = 'Website enquiry — ' . $service;
        $mail->Body    = $body;
        $mail->send();
        $sent = true;
    } catch (Throwable $e) {
        $sent = false;
    }
} else {
    $headers = 'From: ' . $mailCfg['from_name'] . ' <' . $mailCfg['from'] . '>' . "\r\n";
    if ($email !== '') {
        $headers .= 'Reply-To: ' . $email . "\r\n";
    }
    $sent = @mail($mailCfg['to'], 'Website enquiry — ' . $service, $body, $headers);
}

// Always keep a local copy so an enquiry is never lost to a mail failure.
$logDir = __DIR__ . '/../storage';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0775, true);
}
@file_put_contents(
    $logDir . '/enquiries.log',
    date('c') . ' | ' . str_replace("\n", ' | ', $body) . PHP_EOL,
    FILE_APPEND
);

echo json_encode([
    'ok'      => true,
    'message' => $sent
        ? 'Thanks — we have got your message and will be in touch shortly.'
        : 'Thanks — your message is saved and we will be in touch shortly.',
]);
