<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/cartModel.php'; // We need a function from the cart model

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Authentication Check
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['checkout_error'] = 'You must be logged in to place an order.';
        header('Location: ' . FILE_ROOT . '/products');
        exit();
    }

    $userId = $_SESSION['user_id'];
    // todo
    // a. Validate the submitted form data (shipping info).
    // b. Create a new order record in an 'orders' table.
    // c. Move the cart items to an 'order_items' table.

    try {
        $sql = "DELETE FROM cart_items WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        $_SESSION['order_success'] = 'Thank you! Your order has been placed successfully.';
        header('Location: ' . FILE_ROOT . '/order-confirmation');
        exit();

    } catch (PDOException $e) {
        error_log("Error placing order and clearing cart: " . $e->getMessage());
        $_SESSION['checkout_error'] = 'An error occurred while placing your order. Please try again.';
        header('Location: ' . FILE_ROOT . '/checkout');
        exit();
    }

} else {
    header('Location: ' . FILE_ROOT);
    exit();
}
