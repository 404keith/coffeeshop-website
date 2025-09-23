<?php
declare(strict_types=1);

require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/cartModel.php';

/**
 * Get all cart items for the user.
 */
function cart_index(PDO $pdo, int $userId): array
{
    return getCartItems($pdo, $userId);
}

/**
 * Add a product to the cart.
 */
function cart_add(PDO $pdo, int $userId, int $productId, int $qty): bool
{
    return addProductToCart($pdo, $userId, $productId, $qty);
}

/**
 * Update a specific cart item.
 */
function cart_update(PDO $pdo, int $userId, int $cartItemId, int $qty): bool
{
    return updateCartItem($pdo, $userId, $cartItemId, $qty);
}

/**
 * Remove a specific cart item.
 */
function cart_remove(PDO $pdo, int $userId, int $cartItemId): bool
{
    return removeCartItem($pdo, $userId, $cartItemId);
}

/**
 * Clear all items in a user's cart.
 */
function cart_clear(PDO $pdo, int $userId): bool
{
    return clearCart($pdo, $userId);
}
