<?php

// cart-actions.php - This file is a dedicated controller that handles all POST actions for the cart (add, update, remove).

require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/cartModel.php';

// Check if the request is a POST request and an action is set.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    // 1. Authentication Check: Ensure the user is logged in.
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['add_to_cart_error'] = 'You must be logged in to manage your cart.';
        header('Location: ' . FILE_ROOT . '/login');
        exit();
    }

    $userId = $_SESSION['user_id'];
    $action = $_POST['action'];

    switch ($action) {
        case 'add':
            // Handle adding a new product to the cart
            $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            if ($productId === false || $quantity === false || $quantity <= 0) {
                $_SESSION['add_to_cart_error'] = 'Invalid product or quantity specified.';
            } else {
                if (addProductToCart($pdo, $userId, $productId, $quantity)) {
                    $_SESSION['add_to_cart_success'] = 'Product successfully added to your cart!';
                } else {
                    $_SESSION['add_to_cart_error'] = 'An unexpected error occurred. Please try again.';
                }
            }
            header('Location: ' . FILE_ROOT . '/drinks');
            break;

        case 'update':
            // Handle updating the quantity of a cart item
            $cartItemId = filter_input(INPUT_POST, 'cart_item_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            if ($cartItemId === false || $quantity === false || $quantity <= 0) {
                $_SESSION['add_to_cart_error'] = 'Invalid item or quantity specified.';
            } else {
                if (updateCartItem($pdo, $userId, $cartItemId, $quantity)) {
                    $_SESSION['add_to_cart_success'] = 'Cart updated successfully!';
                } else {
                    $_SESSION['add_to_cart_error'] = 'An error occurred while updating the cart.';
                }
            }
            header('Location: ' . FILE_ROOT . '/cart');
            break;

        case 'remove':
            // Handle removing an item from the cart
            $cartItemId = filter_input(INPUT_POST, 'cart_item_id', FILTER_VALIDATE_INT);

            if ($cartItemId === false) {
                $_SESSION['add_to_cart_error'] = 'Invalid item specified for removal.';
            } else {
                if (removeCartItem($pdo, $userId, $cartItemId)) {
                    $_SESSION['add_to_cart_success'] = 'Item removed from cart!';
                } else {
                    $_SESSION['add_to_cart_error'] = 'An error occurred while removing the item.';
                }
            }
            header('Location: ' . FILE_ROOT . '/cart');
            break;

        default:
            // Redirect to home if action is unknown
            header('Location: ' . FILE_ROOT);
            break;
    }
    exit();

} else {
    // If the request method is not POST or GET, redirect to home.
    header('Location: ' . FILE_ROOT);
    exit();
}
