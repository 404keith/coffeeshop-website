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

    default:
        http_response_code(404);
        echo "Page not found!";
        break;
}
