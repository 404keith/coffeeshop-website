<?php
declare(strict_types=1);

function category_index(object $pdo): array
{
    return get_all_categories($pdo);
}

function category_show(object $pdo, int $id): array
{
    return get_products_by_category($pdo, $id);
}
