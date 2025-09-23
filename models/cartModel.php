<?php

// cartModel.php

/**
 * Adds a product to the user's cart. If the product already exists,
 * it updates the quantity. Otherwise, it inserts a new cart item.
 */
function addProductToCart($pdo, $userId, $productId, $quantity)
{
    try {
        $sql = "SELECT id, quantity FROM cart_items WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $newQuantity = $item['quantity'] + $quantity;
            $updateSql = "UPDATE cart_items SET quantity = :quantity, updated_at = NOW() WHERE id = :id";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute(['quantity' => $newQuantity, 'id' => $item['id']]);
        } else {
            $insertSql = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
        }
        return true;
    } catch (PDOException $e) {
        error_log("Error adding product to cart: " . $e->getMessage());
        return false;
    }
}

/**
 * Updates the quantity of a specific cart item.
 */
function updateCartItem($pdo, $userId, $cartItemId, $quantity)
{
    try {
        $sql = "UPDATE cart_items SET quantity = :quantity, updated_at = NOW() WHERE id = :id AND user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['quantity' => $quantity, 'id' => $cartItemId, 'user_id' => $userId]);
    } catch (PDOException $e) {
        error_log("Error updating cart item: " . $e->getMessage());
        return false;
    }
}

/**
 * Removes a specific cart item.
 */
function removeCartItem($pdo, $userId, $cartItemId)
{
    try {
        $sql = "DELETE FROM cart_items WHERE id = :id AND user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['id' => $cartItemId, 'user_id' => $userId]);
    } catch (PDOException $e) {
        error_log("Error removing cart item: " . $e->getMessage());
        return false;
    }
}

/**
 * Fetch all cart items for a user
 */
function getCartItems($pdo, $userId): array
{
    $sql = "SELECT ci.id AS cart_item_id, ci.product_id, ci.quantity, p.name, p.price
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Clears all items from a user's cart
 */
function clearCart($pdo, $userId): bool
{
    try {
        $sql = "DELETE FROM cart_items WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['user_id' => $userId]);
    } catch (PDOException $e) {
        error_log("Error clearing cart: " . $e->getMessage());
        return false;
    }
}
