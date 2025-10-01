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

/**
 * Decrements the stock of a product by the quantity ordered.
 * Uses a conditional update (stock >= :quantity) to prevent setting negative stock.
 */
function decrement_product_stock(object $pdo, int $product_id, int $quantity): int
{
    $query = "UPDATE products SET stock = stock - :quantity WHERE id = :id AND stock >= :quantity;";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $statement->bindParam(':id', $product_id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->rowCount(); // Returns 1 if stock was updated, 0 if not (e.g., failed stock check)
}

function add_product(object $pdo, int $category_id, string $name, string $description, int $price, int $stock, string $image)
{
    $query = "INSERT INTO products (category_id, name, description, price, stock, image)
              VALUES (:category_id, :name, :description, :price, :stock, :image);";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':price', $price, PDO::PARAM_INT);
    $statement->bindParam(':stock', $stock, PDO::PARAM_INT);
    $statement->bindParam(':image', $image);
    $statement->execute();
}
