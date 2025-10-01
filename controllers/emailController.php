<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require APP_ROOT . '/vendor/autoload.php';

/**
 * Sends a subscription confirmation email
 */
function sendSubscriptionEmail(string $email): bool
{
    try {
        $mail = new PHPMailer(true);
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
        $mail->Body = '
            <h1>Thank you for subscribing!</h1>
            <p>You will now receive updates and promotions from Coffee by Monday Mornings.</p>';

        return $mail->send();
    } catch (Exception $e) {
        error_log("Subscription Mail Error: {$e->getMessage()}");
        return false;
    }
}

/**
 * Sends an order confirmation email
 */
function sendOrderEmail(string $email, array $order, array $orderItems): bool
{
    try {
        $mail = new PHPMailer(true);
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
        $mail->Subject = "Order Confirmation - Order #{$order['id']}";

        // Build order items list
        $itemsHtml = '';
        foreach ($orderItems as $item) {
            $itemsHtml .= "<li>{$item['name']} (x{$item['quantity']}) - P "
                . number_format($item['price'] * $item['quantity'], 2) . "</li>";
        }

        $mail->Body = "
            <h2>Thank you for your order!</h2>
            <p>Hello {$order['full_name']},</p>
            <p>We’ve received your order #{$order['id']} placed on {$order['created_at']}.</p>
            
            <h3>Order Summary:</h3>
            <ul>
                {$itemsHtml}
            </ul>
            <p><strong>Total: P " . number_format($order['total'], 2) . "</strong></p>
            
            <p>We’ll notify you once it’s ready.</p>
            <br>
            <p>— Coffee by Monday Mornings</p>
        ";

        return $mail->send();
    } catch (Exception $e) {
        error_log("Order Mail Error: {$e->getMessage()}");
        return false;
    }
}
