<?php

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'mondaymornings');
define('DB_USER', 'root');
define('DB_PASS', '');


// for file path!
define('URL_ROOT', 'http://localhost/projects/coffeeshop-website');    //for src and href (HTML)

define('APP_ROOT', dirname(dirname(__FILE__))); // for define or require (PHP)


// define('FILE_ROOT', '/projects/coffeeshop-website/' ); // REMOVE COMMENT IF GOING BACK TO XAMPP LOCALHOST
define('FILE_ROOT', '');


define('SITE_NAME', 'Coffee By Monday Mornings');

// Email Credentials
define('EMAIL_USERNAME', 'mondaymornings.test123@gmail.com');
define('EMAIL_PASSWORD', 'lwik oyjs xrbq etxl');

$uri = $_SERVER['REQUEST_URI'];

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// // Get project folder name dynamically
// $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
// // Remove base path
// $uri = preg_replace("#^" . preg_quote($basePath) . "#", '', $uri);

define('CREATE_ADMIN', '444');
