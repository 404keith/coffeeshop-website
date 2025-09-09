<?php

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$routes = [
    '' => 'views/home/home.php',
    'login' => 'views/auth/login.php',
    'signup' => 'views/auth/signup.php',
    'logout' => 'views/auth/logout.php',
    'signupView' => 'views/auth/signupView.php',
    'loginView' => 'views/auth/loginView.php',
    'admin' => 'views/layouts/admin_dashboard.php',
    'stocks' => 'views/layouts/admin_stocks.php',
    'drinks' => 'views/products/drinksView.php',
    'waffles' => 'views/products/wafflesView.php',
    'pastries' => 'views/products/pastriesView.php',
    'merienda' => 'views/products/meriendaView.php',
    'test' => 'test.php',    // add ka lang bagong line dito pre kapag may idadagdag ka 
];

function abort($code){
    http_response_code($code);
    require 'views/response_status/'.$code.'.php';
    die();
}

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];    
} else {
  abort(404);
}