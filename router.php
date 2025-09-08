<?php
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($uri) {
    case '':
        include 'views/home/home.php';
        break;

    case 'login':
        include 'views/auth/login.php';
        break;

    case 'signup':
        include 'views/auth/signup.php';
        break;
        
    case 'logout':
        include 'views/auth/logout.php';
        break;

    case 'signupView':
        include 'views/auth/signupView.php';
        break;
    
    case 'loginView':
        include 'views/auth/loginView.php';
        break;

    case 'admin':
        include 'views/layouts/admin_dashboard.php';
        break;

    case 'stocks':
         include 'views/layouts/admin_stocks.php';
         break;

    case 'test':
         include 'test.php';
         break;

    case 'drinks':
         include 'views/products/drinksView.php';
         break;

    case 'waffles':
         include 'views/products/waffles.php';
         break;

    case 'pastries':
         include 'views/products/pastries.php';
         break;

    case 'merienda':
         include 'views/products/merienda.php';
         break;


    default:
        http_response_code(404);
        echo "Page not found!";
        break;
}
//a