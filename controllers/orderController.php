<?php
declare(strict_types=1);

function order_checkout(object $pdo, int $user_id): int
{
    $cartItems = get_cart_items($pdo, $user_id);

    if (empty($cartItems)) {
        return 0; // cart empty
    }

    $orderId = create_order($pdo, $user_id, $cartItems);
    clear_cart($pdo, $user_id);
    return $orderId;
}

function order_show(object $pdo, int $id): array
{
    return [
        'order' => get_order($pdo, $id),
        'items' => get_order_items($pdo, $id),
    ];
}
