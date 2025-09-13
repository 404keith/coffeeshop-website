<?php require_once APP_ROOT . '/config/session.php';


if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    require_once APP_ROOT . '/views/layouts/admin_dashboard.php';

} else {
    header('Location: /login');
    $pdo = null;
    $statement = null;
    die();
}


?>