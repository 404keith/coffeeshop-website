<?php
// used for communication to DATABASE (MYSQL)
declare(strict_types=1);

function get_all_products(object $pdo): array
{
    // Only show active products
    $query = "SELECT * FROM products WHERE is_archived = 0 ORDER BY created_at DESC";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function get_product_by_id(object $pdo, int $id): array|false
{
    $query = "SELECT * FROM products WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function get_products_by_category(object $pdo, string $category_name): array
{
    // Filter by category and hide archived
    $query = "SELECT p.* FROM products p
              JOIN categories c ON p.category_id = c.id
              WHERE c.name = :category_name
              AND p.is_archived = 0
              GROUP BY p.name
              ORDER BY p.created_at DESC";

    $statement = $pdo->prepare($query);
    $statement->bindParam(':category_name', $category_name, PDO::PARAM_STR);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Decrements the stock of a product by the quantity ordered.
 */
function decrement_product_stock(object $pdo, int $product_id, int $quantity): int
{
    $query = "UPDATE products SET stock = stock - :quantity 
              WHERE id = :id AND stock >= :quantity;";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $statement->bindParam(':id', $product_id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->rowCount();
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

# ARCHIVE a product
function archive_product(object $pdo, int $id): bool
{
    $query = "UPDATE products SET is_archived = 1 WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    return $statement->execute();
}

# RESTORE a product
function restore_product(object $pdo, int $id): bool
{
    $query = "UPDATE products SET is_archived = 0 WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    return $statement->execute();
}

# Get all archived products (for your archived_products.php page)
function get_archived_products(object $pdo): array
{
    $query = "SELECT * FROM products WHERE is_archived = 1 ORDER BY updated_at DESC";
    $statement = $pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
