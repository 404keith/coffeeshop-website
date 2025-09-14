<?php
declare(strict_types=1);

function category_index(object $pdo): array
{
    return get_all_categories($pdo);
}

function category_show(object $pdo, string $category_name)
{
    return get_products_by_category($pdo, $category_name);
}
