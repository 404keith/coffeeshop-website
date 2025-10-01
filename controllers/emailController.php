<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
require APP_ROOT . '/vendor/autoload.php';

$email = [];
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL_USERNAME;
    $mail->Password = EMAIL_PASSWORD;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('mondaymornings.test123@gmail.com', 'Coffee by Monday Mornings');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Email Subscription';

    // Image path and CID
    // $image_path = APP_ROOT . '/public/assets/images/forgot_icon.png';
    // $cid = 'forgot_icon';

    // Embed the image
    // $mail->addEmbeddedImage($image_path, $cid, 'forgot_icon.png');

    $mail->Body = '
        <h1>Thank you for subscribing to our email</h1>';

    $mail->send();
    // $email['success'] = 'Thank you for subscribing to our email';
    // $SESSION['subscription_success'] = $email;

    header('Location: /');
} catch (Exception $e) {
    error_log("Mail Error: {$mail->ErrorInfo}");
    header('Location: /');

}
