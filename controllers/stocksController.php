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
            } elseif (isset($_POST['archive_product'])) {
                $this->archiveProduct();
            } elseif (isset($_POST['restore_product'])) {
                $this->restoreProduct();
            }
        }
    }

    public function getStocks()
    {
        require_once APP_ROOT . '/models/categoryModel.php';
        $categories = get_all_categories($this->pdo);
        $category_map = [];
        foreach ($categories as $category) {
            $category_map[$category['id']] = $category['name'];
        }

        try {
            $sql = "SELECT id, category_id, product_type, name, description, price, stock, image 
                    FROM products 
                    WHERE is_archived = 0";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return [$stocks, $category_map];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [[], []];
        }
    }

    public function getCategoryMap()
    {
        require_once APP_ROOT . '/models/categoryModel.php';
        $categories = get_all_categories($this->pdo);
        $category_map = [];
        foreach ($categories as $category) {
            $category_map[$category['id']] = $category['name'];
        }
        return $category_map;
    }

    private function addProduct()
    {
        try {
            // 🔹 Step 1: Check if product already exists
            $check = $this->pdo->prepare("SELECT COUNT(*) FROM products WHERE name = ? AND is_archived = 0");
            $check->execute([$_POST['name']]);
            $exists = $check->fetchColumn();

            if ($exists > 0) {
                echo "<script>alert('⚠️ Product already exists!'); window.location.href='stocks';</script>";
                exit();
            }

            $imagePath = '/public/uploads/default.png'; 
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = APP_ROOT . '/public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imagePath = '/public/uploads/' . $filename;
                }
            }

            // 🔹 Step 3: Insert product
            $sql = "INSERT INTO products (category_id, product_type, name, description, price, stock, image, is_archived)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
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
            $imagePath = $_POST['current_image'] ?? null;

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

    public function getArchived()
    {
        try {
            $sql = "SELECT id, category_id, product_type, name, description, price, stock, image 
                    FROM products 
                    WHERE is_archived = 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching archived: " . $e->getMessage();
            return [];
        }
    }

    private function archiveProduct()
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE products SET is_archived = 1 WHERE id = ?");
            $stmt->execute([$_POST['archive_id']]);
            header("Location: stocks");
            exit();
        } catch (PDOException $e) {
            echo "Error archiving product: " . $e->getMessage();
        }
    }

    private function restoreProduct()
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE products SET is_archived = 0 WHERE id = ?");
            $stmt->execute([$_POST['restore_id']]);
            header("Location: archived_products");
            exit();
        } catch (PDOException $e) {
            echo "Error restoring product: " . $e->getMessage();
        }
    }
}
