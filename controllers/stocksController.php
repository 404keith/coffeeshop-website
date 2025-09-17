<?php
require_once APP_ROOT . '/models/stockModel.php';
require_once APP_ROOT . '/models/productModel.php'; 

class StockController {
    private $stock;
    private $pdo; 
    // Initialize with PDO instance
     function __construct($pdo) {
        $this->stock = new stockModel($pdo);
        $this->pdo = $pdo; 
    }
    // Handling form submissions
     function handleRequest() {
    // Add product
    if (isset($_POST['submit_product'])) {
        $status = $this->calculateStockStatus($_POST['current'], $_POST['min']);
        $this->stock->add(
            $_POST['name'],
            $_POST['category'],
            $_POST['current'],
            $_POST['min'],
            $status,
            date('Y-m-d')
        );
        add_product(
            $this->pdo,
            $_POST['category_id'] ?? 1,
            $_POST['name'],
            $_POST['description'] ?? '',
            $_POST['price'] ?? 0,
            $_POST['current'],
            $_POST['image'] ?? ''
        );
        header("Location: stocks");
        exit();
    }
    if (isset($_POST['update_product']) && isset($_POST['product_id'])) {
        // Update stocks table
        $status = $this->calculateStockStatus($_POST['current'], $_POST['min']);
        $this->stock->update(
            $_POST['product_id'],
            $_POST['name'],
            $_POST['category'],
            $_POST['current'],
            $_POST['min'],
            $status
        );

        // Update products table by name (assuming name is unique)
        $stmt = $this->pdo->prepare("UPDATE products SET name = ?, category_id = ?, description = ?, price = ?, stock = ?, image = ? WHERE name = ?");
        $stmt->execute([
            $_POST['name'],
            $_POST['category_id'] ?? 1,
            $_POST['description'] ?? '',
            $_POST['price'] ?? 0,
            $_POST['current'],
            $_POST['image'] ?? '',
            $_POST['name'] // match by name
        ]);

        header("Location: stocks");
        exit();
    }
    // Delete product
    if (isset($_POST['delete_product']) && isset($_POST['delete_id'])) {
        // Get product name from stocks table
        $stockItem = $this->stock->getById($_POST['delete_id']);
        if ($stockItem) {
            $productName = $stockItem['name'];
            $this->stock->delete($_POST['delete_id']); // Delete from stocks
            $this->deleteProductByName($productName);  // Delete from products
        }
        header("Location: stocks");
        exit();
        }
    }
    // Fetch all stocks
    public function getStocks() {
        return $this->stock->getAll();
    }
    // Calculate stock status based on current and minimum values
     function calculateStockStatus($current, $min) {
        if ($min == 0) return 'In Stock';
        $percentage = ($current / $min) * 100;
        if ($percentage >= 90) return 'High';
        elseif ($percentage >= 20) return 'Medium';
        else return 'Low';
    }
    //deleting a product from products table
    public function deleteProduct($id) {
    $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    }
    public function deleteProductByName($name) {
    $stmt = $this->pdo->prepare("DELETE FROM products WHERE name = ?");
    $stmt->execute([$name]);
    }
}