<?php
// checkoutController.php - This file handles the logic for the checkout page.

require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';

// Check if the user is logged in. If not, redirect them to the login page.
if (!isset($_SESSION['user_id'])) {
    $_SESSION['checkout_error'] = 'You must be logged in to access the checkout page.';
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}

try {
    $userId = $_SESSION['user_id'];

    // Fetch the cart items from the database for the current user.
    // This query joins the cart_items and products tables to get product details.
    $sql = "SELECT ci.quantity, p.name, p.price, p.image FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // This line loads the HTML view for the checkout page, passing the fetched data.
    // require APP_ROOT . '/views/checkout.php';

} catch (PDOException $e) {
    // Handle database errors.
    error_log("Error fetching cart items for checkout: " . $e->getMessage());
    $_SESSION['checkout_error'] = 'An error occurred while loading your cart.';
    header('Location: ' . FILE_ROOT);
    exit();
}
