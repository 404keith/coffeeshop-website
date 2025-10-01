<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/orderModel.php';

// Initialize variables for the view
$order = null;
$orderItems = [];
$error_message = '';

// 1. Authentication Check
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}
$userId = $_SESSION['user_id'];
$orderId = isset($_GET['order_id']) ? (int) $_GET['order_id'] : 0;
$fullName = getUserFullName($pdo, $userId);


// 2. Input Validation and Data Fetching
if ($orderId <= 0) {
    $error_message = 'Invalid order reference.';
} else {
    try {
        // Fetch the specific order details, securing it with user_id
        // Uses function: getOrderById(pdo, orderId, userId)
        $order = getOrderById($pdo, $orderId, (int) $userId);

        if ($order) {
            // Fetch the items for this order
            // Uses function: getOrderItems(pdo, orderId)
            $orderItems = getOrderItems($pdo, $order['id']);
        } else {
            // Order not found or doesn't belong to the user
            $error_message = 'Order not found or you do not have permission to view this order.';
        }

    } catch (PDOException $e) {
        error_log("Error fetching order details: " . $e->getMessage());
        $error_message = 'An error occurred while retrieving order details. Please try again later.';
    }
}

include APP_ROOT . '/views/products/order-details.php';
