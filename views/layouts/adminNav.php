<?php
require APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/helpers/header_dropdowns.php';
include APP_ROOT . '/helpers/alerts.php';

$uri = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= SITE_NAME ?></title>

  <!-- CSS -->
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/fonts.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/adminheader.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-color py-3 shadow">
    <div class="container-fluid">

      <!-- ✅ Logo (moved from middle to left, always here for desktop & mobile) -->
      <a class="navbar-brand fw-bold text-primary ms-5" href="/">
        <img src="<?= FILE_ROOT ?>/public/assets/images/logo.png" alt="logo" class="logo">
      </a>

      <!-- ✅ Right side (Account icon only) -->
      <ul class="navbar-nav ms-auto me-3 d-flex align-items-center text-color">
        <li class="nav-item dropdown textRight">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="accountDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person icon fs-5"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            <i class="bi bi-person-circle dropdown-account-icon"></i>
            <?php renderAccountMenu(FILE_ROOT); ?>
          </ul>
        </li>
      </ul>

    </div>
  </nav>

  <!-- Alerts -->
  <div class="cart-alerts sticky-alerts mt-3 w-50 mx-auto">
    <?php
    if ($uri == '/forgot') {
      forgotPasswordAlert();
    } else {
      check_signup_errors();
      check_login_errors();
      resetPasswordAlert();
      logoutAlert();
    }
    ?>
  </div>

  <!-- JS -->
  <script src="<?= FILE_ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= FILE_ROOT ?>/public/assets/js/mdb.min.js"></script>
</body>
</html>
