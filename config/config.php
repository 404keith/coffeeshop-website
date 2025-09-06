<?php
// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'myfirstdatabase');
define('DB_USER', 'root');
define('DB_PASS', '');


// for file path!
define('URL_ROOT', 'http://localhost/projects/coffeeshop-website');    //for src and href (HTML)

define('APP_ROOT', dirname(dirname(__FILE__))); // for define or require (PHP)


// define('FILE_ROOT', '/projects/coffeeshop-website/' ); // REMOVE COMMENT IF GOING BACK TO XAMPP LOCALHOST
 define('FILE_ROOT', '' ); 


define('SITE_NAME', 'Coffee By Monday Mornings');

//$uri = $_SERVER['REQUEST_URI'];
// // Get project folder name dynamically
// $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
// // Remove base path
// $uri = preg_replace("#^" . preg_quote($basePath) . "#", '', $uri);
