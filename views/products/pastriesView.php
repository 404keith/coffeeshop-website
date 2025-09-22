<?php
require_once APP_ROOT . '/config/config.php';

try {
    require APP_ROOT . '/config/dbhandler.php';
    require APP_ROOT . '/models/productModel.php';
    require APP_ROOT . '/controllers/productController.php';
    require APP_ROOT . '/controllers/categoryController.php';

    $category_name = 'pastry';
    $products = category_show($pdo, $category_name);


    // Load HTML layout
    require APP_ROOT . '/views/products/products.php';

} catch (PDOException $e) {
    die('Query Failed: ' . $e->getMessage());
}
