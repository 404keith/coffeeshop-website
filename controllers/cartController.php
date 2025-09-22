<?php
declare(strict_types=1);

function cart_index(object $pdo, int $user_id): array
{
    return get_cart_items($pdo, $user_id);
}

function cart_add(object $pdo, int $user_id, int $product_id, int $qty): void
{
    add_to_cart($pdo, $user_id, $product_id, $qty);
}

function cart_remove(object $pdo, int $user_id, int $product_id): void
{
    remove_from_cart($pdo, $user_id, $product_id);
}

function cart_clear(object $pdo, int $user_id): void
{
    clear_cart($pdo, $user_id);
}
