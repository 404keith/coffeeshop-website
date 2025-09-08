<?php
// used for communication to DATABASE (MYSQL)
declare(strict_types=1);

function get_cart_items(object $pdo, int $user_id): array {
    $query = "SELECT ci.id, ci.quantity, p.id AS product_id, p.name, p.price, p.image, p.stock
              FROM cart_items ci
              JOIN products p ON ci.product_id = p.id
              WHERE ci.user_id = :user_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function add_to_cart(object $pdo, int $user_id, int $product_id, int $quantity): void {
    // check if item already exists
    $query = "SELECT id, quantity FROM cart_items WHERE user_id = :user_id AND product_id = :product_id";
    $statement = $pdo->prepare($query);
    $statement->execute([':user_id' => $user_id, ':product_id' => $product_id]);
    $existing = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        $newQty = $existing['quantity'] + $quantity;
        $update = "UPDATE cart_items SET quantity = :quantity WHERE id = :id";
        $stmt = $pdo->prepare($update);
        $stmt->execute([':quantity' => $newQty, ':id' => $existing['id']]);
    } else {
        $insert = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
        $stmt = $pdo->prepare($insert);
        $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id, ':quantity' => $quantity]);
    }
}

function remove_from_cart(object $pdo, int $user_id, int $product_id): void {
    $query = "DELETE FROM cart_items WHERE user_id = :user_id AND product_id = :product_id";
    $statement = $pdo->prepare($query);
    $statement->execute([':user_id' => $user_id, ':product_id' => $product_id]);
}

function clear_cart(object $pdo, int $user_id): void {
    $query = "DELETE FROM cart_items WHERE user_id = :user_id";
    $statement = $pdo->prepare($query);
    $statement->execute([':user_id' => $user_id]);
}
