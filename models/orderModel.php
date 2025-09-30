<?php
declare(strict_types=1);

/**
 * Create a new order with optional delivery info and cart items
 */
function createOrder($pdo, $userId, $orderType, $total, $fullName, $address, $phone, $cartItems)
{
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO orders 
        (user_id, order_type, total, full_name, address, phone, created_at)
        VALUES (:user_id, :order_type, :total, :full_name, :address, :phone, NOW())");
    $stmt->execute([
        'user_id' => $userId,
        'order_type' => $orderType,
        'total' => $total,
        'full_name' => $fullName,
        'address' => $address,
        'phone' => $phone
    ]);

    $orderId = $pdo->lastInsertId();

    $stmtItem = $pdo->prepare("INSERT INTO order_items 
        (order_id, product_id, quantity, price)
        VALUES (:order_id, :product_id, :quantity, :price)");

    foreach ($cartItems as $item) {
        $stmtItem->execute([
            'order_id' => $orderId,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ]);
    }

    $pdo->commit();
    return $orderId;
}


/**
 * Fetch an order by ID
 */
function getOrder(object $pdo, int $id): array|false
{
    $sql = "SELECT * FROM orders WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Fetch an order by ID with user security check
 */
function getOrderById(object $pdo, int $orderId, int $userId): array|false
{
    $sql = "SELECT * FROM orders WHERE id = :order_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':order_id' => $orderId,
        ':user_id' => $userId
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function getOrdersByUserId($pdo, int $userId)
{
    $sql = "SELECT * FROM orders WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $userId
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
/**
 * Fetch order items for a given order
 */
function getOrderItems(object $pdo, int $orderId): array
{
    $sql = "SELECT oi.*, p.name 
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':order_id' => $orderId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserFullName(PDO $pdo, int $userId): string|false
{
    $sql = "SELECT first_name, last_name FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row['first_name'] . ' ' . $row['last_name'];
    }

    return false; // user not found
}
