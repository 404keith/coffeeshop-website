<?php

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$routes = [
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
    'admin' => 'views/admin/index.php',
    'stocks' => 'views/layouts/admin_stocks.php',
    'sales' => 'views/layouts/admin_sales.php',
    'orders' => 'views/layouts/admin_orders.php',
    'drinks' => 'views/products/drinksView.php',
    'waffles' => 'views/products/wafflesView.php',
    'pastries' => 'views/products/pastriesView.php',
    'merienda' => 'views/products/meriendaView.php',
    'test' => 'test.php',   
    'test2' => 'test2.php',   
    'test4' => 'test4.php',   
    'test5' => 'test5.php',   
    'createAdmin' => 'views/auth/createAdmin.php',   
    'createAdminView' => 'views/auth/createAdminView.php',   
    'signupAdmin' => 'views/admin/signup.php',

];

function route ($uri, $routes){
    if (array_key_exists($uri, $routes)) {
      require $routes[$uri];    
    } 
    else {
    abort(404);
    }
}

function abort($code){
    http_response_code($code);
    require 'views/response_status/'.$code.'.php';
    die();
}


route($uri, $routes);