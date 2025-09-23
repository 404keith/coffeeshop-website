<?php
// models/stockModel.php
class Stock
{
    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // fetching all products (now acting as stocks)
    function getAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // adding a product
    function add($name, $category_id, $current_stock, $min_stock, $description, $price, $image)
    {
        $sql = "INSERT INTO products (name, category_id, stock, min_stock, description, price, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $category_id, $current_stock, $min_stock, $description, $price, $image]);
    }

    // updating a product
    function update($id, $name, $category_id, $current_stock, $min_stock, $description, $price, $image)
    {
        $sql = "UPDATE products SET name=?, category_id=?, stock=?, min_stock=?, description=?, price=?, image=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name, $category_id, $current_stock, $min_stock, $description, $price, $image, $id]);
    }

    // deleting a product
    function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    // fetching a product by id
    function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}