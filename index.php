<?php
require_once 'config/config.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


if ($uri == FILE_ROOT) {
 require APP_ROOT . '/views/layouts/body.php';
}





