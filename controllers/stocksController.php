<?php

class StockController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit_product'])) {
                $this->addProduct();
            } elseif (isset($_POST['update_product'])) {
                $this->updateProduct();
            } elseif (isset($_POST['delete_product'])) {
                $this->deleteProduct();
            }
        }
    }

    public function getStocks() {
        try {
            // Correct table name here
            $sql = "SELECT id, category_id, product_type, name, description, price, stock, image FROM products";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // In a real application, you'd log this error instead of echoing
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    private function addProduct() {
        // Correct table name here
        $sql = "INSERT INTO products (category_id, product_type, name, description, price, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $_POST['category_id'],
                $_POST['product_type'] ?? null,
                $_POST['name'],
                $_POST['description'] ?? null,
                $_POST['price'],
                $_POST['stock'],
                $_POST['image'] ?? null
            ]);
            header("Location: stocks"); // Redirect to the same page to show changes
            exit();
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }

    private function updateProduct() {
        // Correct table name here
        $sql = "UPDATE products SET category_id = ?, product_type = ?, name = ?, description = ?, price = ?, stock = ?, image = ? WHERE id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $_POST['category_id'],
                $_POST['product_type'] ?? null,
                $_POST['name'],
                $_POST['description'] ?? null,
                $_POST['price'],
                $_POST['stock'],
                $_POST['image'] ?? null,
                $_POST['product_id']
            ]);
            header("Location: stocks");
            exit();
        } catch (PDOException $e) {
            echo "Error updating product: " . $e->getMessage();
        }
    }

    private function deleteProduct() {
        // Correct table name here
        $sql = "DELETE FROM products WHERE id = ?";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$_POST['delete_id']]);
            header("Location: stocks");
            exit();
        } catch (PDOException $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }
}