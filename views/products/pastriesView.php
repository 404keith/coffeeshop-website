<?php
require_once APP_ROOT . '/config/config.php';

try {
    require APP_ROOT . '/config/dbhandler.php';
    require APP_ROOT . '/models/productModel.php';
    require APP_ROOT . '/controllers/productController.php';
    require APP_ROOT . '/controllers/categoryController.php';

    $category_name = 'pastry';

    if (isset($_GET['search'])) {
        $products = product_search_by_category($pdo, $_GET['search'], $category_name);
    } else {
        $products = category_show($pdo, $category_name);
    }

    if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
        // If it is, only return the product list HTML
        require APP_ROOT . '/views/products/_product_list.php';
    } else {
        // Otherwise, load the entire page as usual
        require APP_ROOT . '/views/products/products.php';
    }

    // Load HTML layout
    require APP_ROOT . '/views/products/products.php';

} catch (PDOException $e) {
    die('Query Failed: ' . $e->getMessage());
}
