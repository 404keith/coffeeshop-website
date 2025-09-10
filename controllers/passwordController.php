<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function is_email_empty(string $email): bool {
    return empty($email);
}

function is_user_not_found(bool|array $user): bool {
    return !$user;
}

function is_password_empty(string $password): bool {
    return empty($password);
}



/**
 * Send password reset link
 */
function handle_send_reset_link(object $pdo, string $email): void {
    $user = get_user_by_email($pdo, $email);
    if (is_user_not_found($user)) return;

    $token = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", strtotime(datetime: "+7 hour"));
    create_password_reset($pdo, $email, $token, $expires);

    $resetLink = FILE_ROOT . "coffeeshop-website.local/reset?token=" . urlencode($token);


    require APP_ROOT . '/vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mondaymornings.test123@gmail.com';
        $mail->Password = 'lwik oyjs xrbq etxl';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('mondaymornings.test123@gmail.com', 'Coffee by Monday Mornings');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';

        $mail->Body    =    "<h1>Password Reset:</h1>
                            Click here to reset your password: <a href='$resetLink'>$resetLink</a>
                            ";

        $mail->send();
    } catch (Exception $e) {
        error_log("Mail Error: {$mail->ErrorInfo}");
    }
}


/**
 * Reset the password with token
 */
function handle_reset_password(object $pdo, string $token, string $newPassword): bool {
    $reset = find_valid_token($pdo, $token);

    if (!$reset) {
        return false; // invalid or expired token
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    update_user_password($pdo, $reset['email'], $hashedPassword);
    delete_password_reset($pdo, $reset['email']);

    return true;
}
