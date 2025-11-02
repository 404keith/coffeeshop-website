<?php
require_once APP_ROOT . '/config/session.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$publicRoutes = [
    '' => 'views/home/home.php',
    'login' => 'views/auth/login.php',
    'signup' => 'views/auth/signup.php',
    'logout' => 'views/auth/logout.php',
    'forgot' => 'views/auth/forgot_password.php',
    'forgot_pass' => 'views/auth/forgotView.php',
    'reset' => 'views/auth/reset_password.php',
    'reset_pass' => 'controllers/resetPasswordController.php',
    'signupView' => 'views/auth/signupView.php',
    'verify-signup' => 'views/auth/verify_signup.php',
    'verify-signup-process' => 'views/auth/verifyView.php',
    'loginView' => 'views/auth/loginView.php',
    'drinks' => 'views/products/drinksView.php',
    'waffles' => 'views/products/wafflesView.php',
    'pastries' => 'views/products/pastriesView.php',
    'merienda' => 'views/products/meriendaView.php',
    'place-order' => 'controllers/placeOrderController.php',
    'emailController' => 'controllers/emailController.php',
    'order-details' => 'controllers/order-detailsController.php',
    'cart' => 'views/products/cart.php',
    'cartView' => 'views/products/cartView.php',
    'cart-actions' => 'views/products/cart-actions.php',
    'checkout' => 'views/products/checkout.php',
    'checkoutView' => 'views/products/checkoutView.php',
    'my-orders' => 'views/products/orders.php',
    'test' => 'test.php',
    'test2' => 'test2.php',
    'test4' => 'test4.php',
    'test5' => 'test5.php',
    'contact' => 'views/home/contact.php',
    'account-settings' => 'views/account/account_settings.php',
    'change-password' => 'controllers/changePasswordController.php',
    'verify-password-change-form' => 'views/auth/verify_password_change.php',
    'verify-password-change' => 'controllers/verifyPasswordChangeController.php'
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
        'archived_products' => 'views/layouts/archived_products.php',
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