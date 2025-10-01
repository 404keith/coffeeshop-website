<?php

class StockController
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleRequest()
    {
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

    public function getStocks()
    {
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

    private function addProduct()
    {
        try {
            // Handle image upload
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = APP_ROOT . '/public/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $filename = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    // store relative path for loading in frontend
                    $imagePath = '/public/uploads/' . $filename;
                }
            }

            $sql = "INSERT INTO products (category_id, product_type, name, description, price, stock, image) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $_POST['category_id'],
                $_POST['product_type'] ?? null,
                $_POST['name'],
                $_POST['description'] ?? null,
                $_POST['price'],
                $_POST['stock'],
                $imagePath
            ]);

            header("Location: stocks");
            exit();
        } catch (PDOException $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }

    private function updateProduct()
    {
        try {
            // Default to current image
            $imagePath = $_POST['current_image'] ?? null;

            // If new image uploaded, replace it
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = APP_ROOT . '/public/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $filename = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imagePath = '/public/uploads/' . $filename;
                }
            }

            $sql = "UPDATE products 
                SET category_id = ?, product_type = ?, name = ?, description = ?, price = ?, stock = ?, image = ? 
                WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $_POST['category_id'],
                $_POST['product_type'] ?? null,
                $_POST['name'],
                $_POST['description'] ?? null,
                $_POST['price'],
                $_POST['stock'],
                $imagePath,
                $_POST['product_id']
            ]);

            header("Location: stocks");
            exit();
        } catch (PDOException $e) {
            echo "Error updating product: " . $e->getMessage();
        }
    }

    private function deleteProduct()
    {
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