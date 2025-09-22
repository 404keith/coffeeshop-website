<?php

// cartModel.php

/**
 * Adds a product to the user's cart. If the product already exists,
 * it updates the quantity. Otherwise, it inserts a new cart item.
 *
 * @param PDO $pdo The database connection object.
 * @param int $userId The ID of the logged-in user.
 * @param int $productId The ID of the product to add.
 * @param int $quantity The quantity to add.
 * @return bool True on success, false on failure.
 */
function addProductToCart($pdo, $userId, $productId, $quantity)
{
    try {
        // First, check if the product is already in the user's cart
        $sql = "SELECT id, quantity FROM cart_items WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // If the item exists, update its quantity
            $newQuantity = $item['quantity'] + $quantity;
            $updateSql = "UPDATE cart_items SET quantity = :quantity, updated_at = NOW() WHERE id = :id";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute(['quantity' => $newQuantity, 'id' => $item['id']]);
        } else {
            // If the item doesn't exist, insert a new row
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
 *
 * @param PDO $pdo The database connection object.
 * @param int $userId The ID of the logged-in user.
 * @param int $cartItemId The ID of the cart item to update.
 * @param int $quantity The new quantity.
 * @return bool True on success, false on failure.
 */
function updateCartItem($pdo, $userId, $cartItemId, $quantity)
{
    try {
        $sql = "UPDATE cart_items SET quantity = :quantity, updated_at = NOW() WHERE id = :id AND user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute(['quantity' => $quantity, 'id' => $cartItemId, 'user_id' => $userId]);
        return $result;
    } catch (PDOException $e) {
        error_log("Error updating cart item: " . $e->getMessage());
        return false;
    }
}

/**
 * Removes a specific cart item.
 *
 * @param PDO $pdo The database connection object.
 * @param int $userId The ID of the logged-in user.
 * @param int $cartItemId The ID of the cart item to remove.
 * @return bool True on success, false on failure.
 */
function removeCartItem($pdo, $userId, $cartItemId)
{
    try {
        $sql = "DELETE FROM cart_items WHERE id = :id AND user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute(['id' => $cartItemId, 'user_id' => $userId]);
        return $result;
    } catch (PDOException $e) {
        error_log("Error removing cart item: " . $e->getMessage());
        return false;
    }
}
