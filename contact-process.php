<?php
/**
 * Handles the contact form POST: validates + sanitizes input, verifies the
 * CSRF token, stores the inquiry via a prepared statement, then redirects
 * back to the contact section with a status flag for the flash message.
 */

declare(strict_types=1);
session_start();

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

function fail(string $message): never
{
    $_SESSION['form_message'] = $message;
    header('Location: contact.php?status=error');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// --- CSRF check ---------------------------------------------------------
if (!csrf_verify($_POST['csrf_token'] ?? null)) {
    fail('Your session expired. Please try submitting the form again.');
}

// --- Gather + sanitize ---------------------------------------------------
$name        = clean_input($_POST['name'] ?? '');
$email       = clean_input($_POST['email'] ?? '');
$phone       = clean_input($_POST['phone'] ?? '');
$serviceType = clean_input($_POST['service_type'] ?? '');
$message     = clean_input($_POST['message'] ?? '');

// --- Server-side validation ----------------------------------------------
$errors = [];

if ($name === '' || mb_strlen($name) < 2 || mb_strlen($name) > 100) {
    $errors[] = 'a valid name';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
    $errors[] = 'a valid email address';
}

if ($phone !== '' && mb_strlen($phone) > 30) {
    $errors[] = 'a valid phone number';
}

if ($serviceType === '' || mb_strlen($serviceType) > 100) {
    $errors[] = 'a service selection';
}

if ($message === '' || mb_strlen($message) < 10 || mb_strlen($message) > 2000) {
    $errors[] = 'a message of at least 10 characters';
}

if (!empty($errors)) {
    fail('Please provide ' . implode(', ', $errors) . '.');
}

// --- Persist to database (prepared statement) -----------------------------
try {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare(
        'INSERT INTO inquiries (name, email, phone, service_type, message, ip_address)
         VALUES (:name, :email, :phone, :service_type, :message, :ip_address)'
    );
    $stmt->execute([
        ':name'         => $name,
        ':email'        => $email,
        ':phone'        => $phone !== '' ? $phone : null,
        ':service_type' => $serviceType,
        ':message'      => $message,
        ':ip_address'   => $_SERVER['REMOTE_ADDR'] ?? null,
    ]);
} catch (PDOException $e) {
    error_log('Inquiry insert failed: ' . $e->getMessage());
    fail('We could not save your inquiry right now. Please try again shortly.');
}

// Rotate the CSRF token after a successful submission.
unset($_SESSION['csrf_token']);

header('Location: contact.php?status=success');
exit;
