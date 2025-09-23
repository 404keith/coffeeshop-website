<?php
require_once APP_ROOT . '/config/session.php';

session_unset();

$_SESSION['logout_success'] = "You have been logged out successfully.";

header('Location: /');
exit();
