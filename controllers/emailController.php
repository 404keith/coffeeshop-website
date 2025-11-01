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

function send_verification_email(string $email, string $code): bool
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
    $mail->Subject = 'Your Verification Code';
    $mail->Body = '
            <h1>Verification Code</h1>
            <p>Your verification code is: <strong>' . $code . '</strong></p>
            <p>Use this code to complete your registration.</p>';

    return $mail->send();
  } catch (Exception $e) {
    error_log("Verification Mail Error: {$e->getMessage()}");
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

    $mail->SMTPDebug = 2; // Enable verbose debug output
    $mail->Debugoutput = 'error_log'; // Send output to PHP error log


    $mail->setFrom('mondaymornings.test123@gmail.com', 'Coffee by Monday Mornings');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Order Confirmation - Order #{$order['id']}";

    // Build order items list
    $itemsHtml = '';
    foreach ($orderItems as $item) {
      $imagePath = APP_ROOT . str_replace('/', DIRECTORY_SEPARATOR, $item['image']);
      $cid = 'product_' . $item['product_id'];
      $mail->addEmbeddedImage($imagePath, $cid);

      $itemsHtml .= "<li style='margin-bottom: 10px; display: flex; align-items: center;'><img src='cid:{$cid}' style='width: 50px; height: 50px; object-fit: cover; margin-right: 15px; border-radius: 5px;'><span>{$item['name']} (x{$item['quantity']}) - P "
        . number_format($item['price'] * $item['quantity'], 2) . "</span></li>";
    }

    $heartIcon = APP_ROOT . "/public/assets/images/heart.png";
    $logoIcon = APP_ROOT . "/public/assets/images/logo.png";
    $cartIcon = APP_ROOT . "/public/assets/images/cart.png";

    $facebookIcon = APP_ROOT . "/public/assets/images/facebook.png";
    $instagramIcon = APP_ROOT . "/public/assets/images/instagram.png";
    $tiktokIcon = APP_ROOT . "/public/assets/images/tiktok.png";

    $mail->addEmbeddedImage($facebookIcon, 'facebookicon');
    $mail->addEmbeddedImage($instagramIcon, 'igicon');
    $mail->addEmbeddedImage($tiktokIcon, 'tiktokicon');

    $mail->addEmbeddedImage($cartIcon, 'carticon');
    $mail->addEmbeddedImage($heartIcon, 'hearticon');
    $mail->addEmbeddedImage($logoIcon, 'logoicon');

    $formattedDate = date('F j, Y g:i A', strtotime($order['created_at']));

    $mail->Body = "
<div style=\"width: 100%; padding: 10px 0;\">
  <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
    <tr>
      <td align=\"center\">
        <!-- Centered Container Table -->
        <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" style=\"border-radius: 8px; margin: 0 auto;\">
          <tr>
            <td style=\"padding: 30px; font-family: Arial, sans-serif; color: #333333;\">

            <div style=\"padding-bottom:10px;\">
              <img src=\"cid:logoicon\" alt=\"Heart\" width=\"auto\" height=\"24\" style=\"vertical-align: middle; \">
              <span style=\"color: #555555; font-weight:bold; font-size: 12px; vertical-align: middle; padding-left:5px; \">Coffee by Monday Mornings</span>
            </div>

              <h1 style=\"text-align: left; margin-top: 0; color: #2c3e50;\">Thank you for your order!
                <img src=\"cid:hearticon\" alt=\"Heart\" width=\"24\" height=\"24\" style=\"vertical-align: middle;\">
              </h1>
              
              <h2 style=\"font-size: 18px; font-weight: normal;\">Hello {$order['full_name']},</h2>
              
              <p style=\"font-size: 16px; line-height: 1.5;\">
                We’ve received your order <strong>#{$order['id']}</strong> placed on {$formattedDate}.
              </p>
              

              <h3 style=\"border-top: 2px solid #eeeeee; padding-top: 20px; margin-top: 30px; margin-bottom: 20px;\">
               <img src=\"cid:carticon\" alt=\"Cart\" height=\"22\" style=\"vertical-align: middle; margin-right: 8px;\">
                Orders:
             </h3>
              
              <ul style=\"list-style: none; padding: 0;  margin-left:25px;\">
                 {$itemsHtml}
              </ul>
              
              <p style=\"font-size: 18px; font-weight: bold; margin-top: 20px; margin-bottom: 30px;\">
                Total: P " . number_format($order['total'], 2) . "
              </p>
              
              <p style=\"font-size: 16px;\">We’ll notify you once it’s ready to pickup.</p>


       <hr style=\"border: none; border-top: 1px solid #dddddd; margin: 20px 0;\">

        <div style=\"text-align: left;\">
            
            <p style=\"color: #555555; font-size: 14px; margin: 0 0 10px 0;\">
                Follow Us:
            </p>
            
            <div>
                <a href=\"https://www.facebook.com/profile.php?id=100092605117539\" target=\"_blank\" style=\"text-decoration: none; margin-right: 10px;\">
                    <img src=\"cid:facebookicon\" alt=\"Facebook\" height=\"24\" style=\"vertical-align: middle;\">
                </a>
                
                <a href=\"https://www.instagram.com/coffeebymondaymornings/\" target=\"_blank\" style=\"text-decoration: none; margin-right: 10px;\">
                    <img src=\"cid:igicon\" alt=\"Instagram\" height=\"24\" style=\"vertical-align: middle;\">
                </a>
                
                <a href=\"https://www.tiktok.com/@coffeebymondaymornings\" target=\"_blank\" style=\"text-decoration: none;\">
                    <img src=\"cid:tiktokicon\" alt=\"TikTok\" height=\"24\" style=\"vertical-align: middle;\">
                </a>
            </div>

        </div>
              

            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
";

    return $mail->send();
  } catch (Exception $e) {
    error_log("Order Mail Error: {$e->getMessage()}");
    return false;
  }
}

function sendPasswordChangeEmail(string $email, int $code): bool
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
    $mail->Subject = 'Your Password Change Verification Code';
    $mail->Body = '
            <h1>Password Change Verification Code</h1>
            <p>Your verification code is: <strong>' . $code . '</strong></p>
            <p>Use this code to complete your password change.</p>';

    return $mail->send();
  } catch (Exception $e) {
    error_log("Password Change Mail Error: {$e->getMessage()}");
    return false;
  }
}
