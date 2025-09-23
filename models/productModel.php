<?php
// used for communication to DATABASE (MYSQL)
declare(strict_types=1);

function get_all_products(object $pdo): array
{
    $query = "SELECT * FROM products";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_product_by_id(object $pdo, int $id): array|false
{
    $query = "SELECT * FROM products WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_products_by_category(object $pdo, string $category_name): array
{
    $query = "SELECT p.* FROM products p
              JOIN categories c ON p.category_id = c.id
              WHERE c.name = :category_name
              GROUP BY p.name
              ORDER BY p.created_at DESC";

    $statement = $pdo->prepare($query);

    $statement->bindParam(':category_name', $category_name, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function add_product(object $pdo, int $category_id, string $product_type, string $name, string $description, int $price, int $stock, string $image)
{
    $query = "INSERT INTO products (category_id, product_type, name, description, price, stock, image)
              VALUES (:category_id, :name, :description, :price, :stock, :image);";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $statement->bindParam(':product_type', $product_type, PDO::PARAM_INT);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':price', $price, PDO::PARAM_INT);
    $statement->bindParam(':stock', $stock, PDO::PARAM_INT);
    $statement->bindParam(':image', $image);
    $statement->execute();
}

