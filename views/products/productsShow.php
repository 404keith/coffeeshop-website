<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/views/products/productsView.php';

// Call the dynamic controller with the "merienda" category name
showProductsByCategory($pdo, 'drink');
