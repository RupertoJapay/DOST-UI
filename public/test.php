<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php'; // adjust path if needed

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'system.testinggg@gmail.com';
    $mail->Password = 'mnrxgqtueoqxjlvk'; // Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content
    $mail->setFrom('system.testinggg@gmail.com', 'Dost System');
    $mail->addAddress('japay.rupertoiii@gmail.com', 'You'); // change to your own email
    $mail->Subject = 'SMTP Test Email';
    $mail->Body = 'This is a test email to check if PHPMailer and Gmail SMTP are working.';

    $mail->send();
    echo '✅ Test email sent successfully!';
} catch (Exception $e) {
    echo "❌ Email failed: {$mail->ErrorInfo}";
}
