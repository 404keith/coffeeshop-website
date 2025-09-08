<?php
declare(strict_types=1);

function product_index(object $pdo): array {
    return get_all_products($pdo);
}

function product_show(object $pdo, int $id): array|false {
    return get_product_by_id($pdo, $id);
}
