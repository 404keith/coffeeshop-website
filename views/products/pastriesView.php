<?php
require_once APP_ROOT . '/config/config.php';

try {
    require APP_ROOT . '/config/dbhandler.php';
    require APP_ROOT . '/models/productModel.php';
    require APP_ROOT . '/controllers/productController.php';
    require APP_ROOT . '/controllers/categoryController.php';

    $category_id = 2; //
    $products = category_show($pdo, $category_id);

    // Load HTML layout
    require APP_ROOT . '/views/products/pastries.php';

} catch (PDOException $e) {
    die('Query Failed: ' . $e->getMessage());
}
