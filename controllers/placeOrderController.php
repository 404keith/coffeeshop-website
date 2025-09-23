<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/cartModel.php';
require_once APP_ROOT . '/models/orderModel.php';

// Initialize variables for the view
$order = null;
$orderItems = [];
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        $error_message = 'You must be logged in to place an order.';
        header('Location: ' . FILE_ROOT . '/drinks');
        exit();
    }

    $userId = $_SESSION['user_id'];
    $orderType = $_POST['order_type'] ?? '';

    if (!in_array($orderType, ['pickup', 'delivery'])) {
        $error_message = 'Invalid order type.';
        header('Location: ' . FILE_ROOT . '/checkout');
        exit();
    }

    // Delivery info
    $fullName = null;
    $address = null;
    $phone = null;

    if ($orderType === 'delivery') {
        $fullName = trim($_POST['full_name'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if (empty($fullName) || empty($address) || empty($phone)) {
            $error_message = 'Please complete all delivery fields.';
            header('Location: ' . FILE_ROOT . '/checkout');
            exit();
        }
    }

    try {
        // Get cart items
        $cartItems = getCartItems($pdo, $userId);
        if (empty($cartItems)) {
            $error_message = 'Your cart is empty.';
            header('Location: ' . FILE_ROOT . '/checkout');
            exit();
        }

        // Calculate total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Place order and get the new order ID
        $orderId = createOrder($pdo, $userId, $orderType, $total, $fullName, $address, $phone, $cartItems);

        // Fetch the newly created order for the confirmation view
        $order = getOrderById($pdo, (int) $orderId, (int) $userId);
        $orderItems = getOrderItems($pdo, $order['id']);

        // Clear cart after order
        clearCart($pdo, $userId);

        $_SESSION['order_success'] = 'Thank you! Your order has been placed successfully.';

        // *** IMPORTANT: The redirect line has been REMOVED to keep the same URL. ***
        // *** THIS IS NOT A RECOMMENDED PRACTICE. ***

    } catch (PDOException $e) {
        error_log("Error placing order: " . $e->getMessage());
        $error_message = 'An error occurred while placing your order. Please try again.';
        // Redirect back to checkout on error
        header('Location: ' . FILE_ROOT . '/checkout');
        exit();
    }
} else {
    // If the request is not a POST, redirect to the homepage
    header('Location: ' . FILE_ROOT);
    exit();
}

// Now that the order has been processed, include the view file to display the data.
// This is the content that would have been in order-confirmation.php.
// The variables $order, $orderItems, and $error_message are now available here.
include APP_ROOT . '/views/products/pickup.php';

