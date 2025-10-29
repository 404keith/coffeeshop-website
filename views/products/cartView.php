<?php

require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/cartModel.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['add_to_cart_error'] = 'Please login first';
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}

try {
    $userId = $_SESSION['user_id'];
    $sql = "SELECT ci.id, ci.quantity, p.name, p.price, p.image FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);



} catch (PDOException $e) {
    error_log("Error fetching cart items for checkout: " . $e->getMessage());
    $_SESSION['add_to_cart_error'] = 'An error occurred while loading your cart.';
    header('Location: ' . FILE_ROOT);
    exit();
}
