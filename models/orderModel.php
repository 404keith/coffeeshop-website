<?php
// used for communication to DATABASE (MYSQL)
declare(strict_types=1);

function create_order(object $pdo, int $user_id, array $cartItems): int
{
    $pdo->beginTransaction();

    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // insert order
    $query = "INSERT INTO orders (user_id, total) VALUES (:user_id, :total)";
    $statement = $pdo->prepare($query);
    $statement->execute([':user_id' => $user_id, ':total' => $total]);
    $orderId = (int) $pdo->lastInsertId();

    // insert order items + reduce stock
    foreach ($cartItems as $item) {
        $insertItem = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                       VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $pdo->prepare($insertItem);
        $stmt->execute([
            ':order_id' => $orderId,
            ':product_id' => $item['product_id'],
            ':quantity' => $item['quantity'],
            ':price' => $item['price']
        ]);

        $updateStock = "UPDATE products SET stock = stock - :qty WHERE id = :id";
        $stmt = $pdo->prepare($updateStock);
        $stmt->execute([':qty' => $item['quantity'], ':id' => $item['product_id']]);
    }

    $pdo->commit();
    return $orderId;
}

function get_order(object $pdo, int $id): array|false
{
    $query = "SELECT * FROM orders WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function get_order_items(object $pdo, int $order_id): array
{
    $query = "SELECT oi.*, p.name 
              FROM order_items oi
              JOIN products p ON oi.product_id = p.id
              WHERE oi.order_id = :order_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
