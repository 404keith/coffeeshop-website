<?php

class TestingModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function generateProducts(int $count) {
        $stmt = $this->pdo->query('SELECT id FROM categories');
        $category_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($category_ids)) {
            // Handle case where there are no categories
            return;
        }

        $stmt = $this->pdo->prepare(
            'INSERT INTO products (name, category_id, product_type, description, price, stock, image) 
             VALUES (:name, :category_id, :product_type, :description, :price, :stock, :image)'
        );

        for ($i = 0; $i < $count; $i++) {
            $name = '[AUTO] Product ' . uniqid();
            $category_id = $category_ids[array_rand($category_ids)];
            $product_type = 'Auto-generated';
            $description = 'This is an auto-generated product.';
            $price = mt_rand(100, 1000) / 10;
            $stock = mt_rand(0, 100);
            $image = ''; // No image for generated products

            $stmt->execute([
                ':name' => $name,
                ':category_id' => $category_id,
                ':product_type' => $product_type,
                ':description' => $description,
                ':price' => $price,
                ':stock' => $stock,
                ':image' => $image,
            ]);
        }
    }

    public function deleteGeneratedProducts() {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE name LIKE '[AUTO]%'");
        $stmt->execute();
    }
}
