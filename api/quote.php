<?php
declare(strict_types=1);
session_start();
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

function utf8_length(string $value): int {
    if (function_exists('mb_strlen')) return mb_strlen($value, 'UTF-8');
    $chars = preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
    return is_array($chars) ? count($chars) : strlen($value);
}

function utf8_substr(string $value, int $length): string {
    if (function_exists('mb_substr')) return mb_substr($value, 0, $length, 'UTF-8');
    $chars = preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY);
    return is_array($chars) ? implode('', array_slice($chars, 0, $length)) : substr($value, 0, $length);
}

function respond(int $status, array $payload): never {
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    respond(405, ['ok' => false, 'message' => 'Use the enquiry form to submit a request.']);
}

$token = (string)($_POST['csrf_token'] ?? '');
$sessionToken = (string)($_SESSION['csrf_token'] ?? '');
if ($token === '' || $sessionToken === '' || !hash_equals($sessionToken, $token)) {
    respond(419, ['ok' => false, 'message' => 'Your session has expired. Refresh the page and try again.']);
}

// Honeypot: legitimate users never see or fill this field.
if (!empty($_POST['website'])) {
    respond(200, ['ok' => true, 'message' => 'Thank you. Your enquiry has been received.']);
}

$now = time();
$lastSubmission = (int)($_SESSION['last_quote_submission'] ?? 0);
if ($now - $lastSubmission < 20) {
    respond(429, ['ok' => false, 'message' => 'Please wait a moment before sending another enquiry.']);
}

$clean = static function (string $key, int $max = 500): string {
    $value = trim((string)($_POST[$key] ?? ''));
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value) ?? '';
    return utf8_substr($value, $max);
};

$name = $clean('name', 80);
$buyerType = $clean('buyer_type', 60);
$phone = $clean('phone', 20);
$email = $clean('email', 120);
$city = $clean('city', 80);
$interest = $clean('interest', 80);
$quantity = $clean('quantity', 60);
$pincode = $clean('pincode', 6);
$timing = $clean('timing', 60);
$message = $clean('message', 2000);
$consent = (string)($_POST['consent'] ?? '') === 'yes';

$errors = [];
if (utf8_length($name) < 2) $errors[] = 'Enter your name.';
if ($buyerType === '') $errors[] = 'Select who you are enquiring as.';
if (preg_match('/^[0-9+() .-]{8,20}$/', $phone) !== 1) $errors[] = 'Enter a valid phone or WhatsApp number.';
if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) === false) $errors[] = 'Enter a valid email address.';
if ($pincode !== '' && preg_match('/^[0-9]{6}$/', $pincode) !== 1) $errors[] = 'Enter a valid 6-digit delivery pincode.';
if (utf8_length($message) < 10) $errors[] = 'Please add a little more detail about your requirements.';
if (!$consent) $errors[] = 'Please agree to be contacted about this enquiry.';
if ($errors) respond(422, ['ok' => false, 'message' => implode(' ', $errors)]);

$record = [
    'received_at' => gmdate('c'),
    'name' => $name,
    'buyer_type' => $buyerType,
    'phone' => $phone,
    'email' => $email,
    'city' => $city,
    'interest' => $interest,
    'quantity' => $quantity,
    'pincode' => $pincode,
    'timing' => $timing,
    'message' => $message,
    'source' => 'website enquiry form',
];

$storageDir = dirname(__DIR__) . '/storage';
if (!is_dir($storageDir) && !mkdir($storageDir, 0750, true) && !is_dir($storageDir)) {
    respond(500, ['ok' => false, 'message' => 'We could not save your enquiry right now. Please contact the business directly.']);
}
$file = $storageDir . '/enquiries.jsonl';
$encoded = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
if ($encoded === false || file_put_contents($file, $encoded . PHP_EOL, FILE_APPEND | LOCK_EX) === false) {
    respond(500, ['ok' => false, 'message' => 'We could not save your enquiry right now. Please try again later.']);
}

$_SESSION['last_quote_submission'] = $now;
// Optional notification email: set ACCENT_INQUIRY_EMAIL on the server and configure PHP mail.
$recipient = getenv('ACCENT_INQUIRY_EMAIL') ?: '';
if ($recipient !== '' && filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
    $subject = 'New Accent International website enquiry';
    $body = "Name: {$name}\nBuyer type: {$buyerType}\nPhone: {$phone}\nEmail: {$email}\nCity: {$city}\nInterest: {$interest}\nQuantity: {$quantity}\nPincode: {$pincode}\nTiming: {$timing}\n\nMessage:\n{$message}\n";
    $host = preg_replace('/[^a-z0-9.-]/i', '', (string)($_SERVER['HTTP_HOST'] ?? 'localhost')) ?: 'localhost';
    $headers = "From: website@{$host}\r\nContent-Type: text/plain; charset=UTF-8";
    @mail($recipient, $subject, $body, $headers);
}

// Rotate the CSRF token after a successful submission.
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
respond(200, ['ok' => true, 'message' => 'Thank you. Your enquiry has been received. We will follow up using the contact details you provided.', 'csrf_token' => $_SESSION['csrf_token']]);
