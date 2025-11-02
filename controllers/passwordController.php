<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function is_email_empty(string $email): bool
{
    return empty($email);
}

function is_user_not_found(bool|array $user): bool
{
    return !$user;
}

function is_password_empty(string $password): bool
{
    return empty($password);
}


// ** Send password reset link

function handle_send_reset_link(object $pdo, string $email): void
{
    $user = get_user_by_email($pdo, $email);
    if (is_user_not_found($user))
        return;

    $token = bin2hex(random_bytes(32));
    create_password_reset($pdo, $email, $token);

    $resetLink = FILE_ROOT . "coffeeshop-website.local/reset?token=" . urlencode($token);


    require APP_ROOT . '/vendor/autoload.php';

    $mail = new PHPMailer(true);

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
        $mail->Subject = 'Password Reset';

        // Image path and CID
        $image_path = APP_ROOT . '/public/assets/images/forgot_icon.png';
        $cid = 'forgot_icon';

        // Embed the image
        $mail->addEmbeddedImage($image_path, $cid, 'forgot_icon.png');

        $mail->Body = '
        <img src="cid:' . $cid . '" alt="Sad face" class="img-fluid mb-2 mx-auto d-block" style="max-width: 130px;">
        <h1>Password Reset:</h1>
        Click here to reset your password: <a href="' . $resetLink . '">' . $resetLink . '</a>
    ';

        $mail->send();
    } catch (Exception $e) {
        error_log("Mail Error: {$mail->ErrorInfo}");
    }
}


// ** Reset the password with token

function handle_reset_password(object $pdo, string $token, string $newPassword): bool
{
    $reset = find_valid_token($pdo, $token);

    if (!$reset) {
        return false; // invalid or expired token
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    update_user_password($pdo, $reset['email'], $hashedPassword);
    delete_password_reset($pdo, $reset['email']);

    return true;
}