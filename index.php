<?php
require_once 'config/config.php';


$uri = $_SERVER['REQUEST_URI'];


if ($uri == FILE_ROOT) {
 require APP_ROOT . '/views/layouts/body.php';
}





