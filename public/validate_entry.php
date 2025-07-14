<?php
require_once '../config/config.php';
header('Content-Type: application/json');

$email = trim($_POST['email'] ?? '');
$code = trim($_POST['code'] ?? '');

// Debug output (only for testing, remove in production)
error_log("Validating: Email = $email | Code = $code");

$response = ['valid' => false];

if ($email && $code) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM training_entries WHERE staff_email = ? AND unique_code = ?");
    $stmt->execute([$email, $code]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $response['valid'] = true;
    } else {
        error_log("No match found in DB for: $email + $code");
    }
} else {
    error_log("Email or code missing");
}

echo json_encode($response);
?>
