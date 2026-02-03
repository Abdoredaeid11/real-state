<?php
// تأكد إن PHPMailer موجودة، أو نزّلها من https://github.com/PHPMailer/PHPMailer
require 'PHPMailer/PHPMailerAutoload.php'; // لو استخدمت النسخة القديمة

$recipients = [
    'abdoredaeid905@gmail.com',
    'test2@example.com',
    'test3@example.com'
];

// SMTP ثابت
$fromEmail = 'vadecom@abo-elhol.com';
$fromName  = 'Vadecom';
$smtpHost  = 'mail.abo-elhol.com';
$smtpPort  = 587; // أو 465
$smtpUser  = 'vadecom@abo-elhol.com';
$smtpPass  = 'vadecom2026';
$smtpEncryption = 'tls'; // أو 'ssl'

// موضوع ومحتوى الإيميل
$subject = 'Test Bulk Email';
$body = '<h2>Hello!</h2><p>This is a test email sent via fixed SMTP.</p>';

$errors = [];

foreach ($recipients as $email) {
    $mail = new PHPMailer;

    // إعدادات SMTP
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    $mail->SMTPSecure = $smtpEncryption;
    $mail->Port = $smtpPort;

    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    if(!$mail->send()) {
        $errors[$email] = $mail->ErrorInfo;
    }
}

// طباعة النتيجة
if(!empty($errors)){
    echo "Errors:\n";
    print_r($errors);
}else{
    echo "All emails sent successfully!";
}
?>
