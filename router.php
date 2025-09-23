<?php
require_once APP_ROOT . '/config/session.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$publicRoutes = [
    '' => 'views/home/home.php',
    'login' => 'views/auth/login.php',
    'signup' => 'views/auth/signup.php',
    'logout' => 'views/auth/logout.php',
    'forgot' => 'views/auth/forgot_password.php',
    'forgot_passwordView' => 'views/auth/forgotView.php',
    'reset' => 'views/auth/reset_password.php',
    'reset_pass' => 'views/auth/resetView.php',
    'signupView' => 'views/auth/signupView.php',
    'loginView' => 'views/auth/loginView.php',
    'drinks' => 'views/products/drinksView.php',
    'waffles' => 'views/products/wafflesView.php',
    'pastries' => 'views/products/pastriesView.php',
    'merienda' => 'views/products/meriendaView.php',
    'cart' => 'views/products/cart.php',
    'cartView' => 'views/products/cartView.php',
    'cart-actions' => 'views/products/cart-actions.php',
    'checkout' => 'views/products/checkout.php',
    'checkoutView' => 'views/products/checkoutView.php',
    'test' => 'test.php',
    'test2' => 'test2.php',
    'test4' => 'test4.php',
    'test5' => 'test5.php',
];

$adminRoutes = [
    'admin' => 'views/admin/index.php',
    'dashboard' => 'views/layouts/admin_dashboard.php',
    'stocks' => 'views/layouts/admin_stocks.php',
    'sales' => 'views/layouts/admin_sales.php',
    'orders' => 'views/layouts/admin_orders.php',
    'adminNav' => 'views/layouts/adminNav.php',
    'createAdmin' => 'views/auth/createAdmin.php',
    'createAdminView' => 'views/auth/createAdminView.php',
    'signupAdmin' => 'views/admin/signup.php',
];

// Combine all routes for easy lookup
$allRoutes = array_merge($publicRoutes, $adminRoutes);

function route($uri, $publicRoutes, $adminRoutes)
{
    if (array_key_exists($uri, $adminRoutes)) {

        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            require $adminRoutes[$uri];
        } else {
            header('Location: /');
            exit;
        }
    } elseif (array_key_exists($uri, $publicRoutes)) {
        require $publicRoutes[$uri];
    } else {
        abort(404);
    }
}

function abort($code)
{
    http_response_code($code);
    require 'views/response_status/' . $code . '.php';
    die();
}


route($uri, $publicRoutes, $adminRoutes);