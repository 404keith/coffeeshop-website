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

  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/mdb.min.css" />
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/all.min.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/flaticon/css/all/all.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/fonts.css">
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/header.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>


<body>
  <nav class="navbar navbar-expand-md navbar-color  py-3 navbar-color shadow">
    <div class="container-fluid">

      <!-- Left (desktop) -->
      <ul class="navbar-nav navbar-left d-none d-md-flex ms-5 text-color">
        <li class="nav-item ms-5 textLeft">
          <a class="nav-link d-flex align-items-center" href="/">
            <i class="bi bi-house icon fs-7 house-icon ms-5"></i></a>
        </li>

        <li class="nav-item ms-5">
          <a class="nav-link" <?php
          if ($uri === '/') {
            echo 'onclick="scrollToSection(\'section-menu\')"';
          } else {
            echo 'href="/drinks"';
          }
          ?>><i class=" bi bi-cup-hot icon fs-7"></i></a>
        </li>


        <li class="nav-item ms-5 nav-text"><a class="nav-link" onclick="scrollToSection('section-about')">ABOUT US</a>
        </li>
      </ul>

      <!-- Logo desktop (center) -->
      <a class="navbar-brand fw-bold text-primary d-none d-md-block" href="/">
        <img src="<?= FILE_ROOT ?>/public/assets/images/logo.png" alt="logo" class="logo">
      </a>

      <!-- Logo mobile (right) -->
      <a class="navbar-brand fw-bold text-primary d-md-none ms-5" href="/">
        <img src="<?= FILE_ROOT ?>/public/assets/images/logo.png" alt="logo" class="logo">
      </a>

      <!-- Right (desktop) -->
      <ul class="navbar-nav navbar-right d-none d-md-flex align-items-center me-5 text-color">
        <!-- Contact -->
        <li class="nav-item me-5 nav-text">
          <a class="nav-link d-flex align-items-center" href="#">CONTACT US</a>
        </li>

        <!-- Cart Dropdown -->
        <li class="nav-item dropdown textRight">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="cartDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-cart2 icon fs-7"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cartDropdown">
            <?php renderCartMenu(FILE_ROOT, $pdo); ?>
          </ul>
        </li>

        <!-- Account Dropdown -->
        <li class="nav-item dropdown me-5 textRight">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="accountDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person icon fs-7"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end ms-4" aria-labelledby="accountDropdown">
            <i class="bi bi-person-circle dropdown-account-icon"></i>
            <?php renderAccountMenu(FILE_ROOT); ?>
          </ul>
        </li>

        <li class="me-5"></li>
      </ul>

      <?php
      //  data-bs-toggle="offcanvas"
      //     data-bs-target="#mobileMenu"
      //     aria-controls="mobileMenu"
      //     aria-label="Toggle navigation"
      ?>
      <!-- Hamburger toggles OFFCANVAS on mobile -->
      <button class="navbar-toggler btn me-5" id="openMobileMenu"> <span class="navbar-toggler-icon"></span> </button>

    </div>
  </nav>

  <!-- Offcanvas Sidebar (Mobile) -->
  <div class="offcanvas offcanvas-end offcanvas-custom" data-bs-scroll="true" tabindex="-1" id="mobileMenu"
    aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
      <h6 class="offcanvas-title" id="mobileMenuLabel"></h6>
      <button type="button" class="btn-close me-5" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav d-md-none ms-3 me-3">
        <li class="nav-item"><a class="nav-link" href="/"><i class="bi bi-house icon"></i> Home</a></li>

        <li class="nav-item">
          <a class="nav-link" <?php
          if ($uri === '/') {
            echo 'onclick="scrollToSection(\'section-menu\')"';
          } else {
            echo 'href="/"';
          }
          ?>><i class="bi bi-cup-hot icon"></i> Menu</a>
        </li>


        <li class="nav-item "><a class="nav-link" href="#" data-bs-dismiss="offcanvas">About Us</a></li>
        <li class="nav-item "><a class="nav-link" href="#" data-bs-dismiss="offcanvas">Contact Us</a></li>
        <li class="nav-item "><a class="nav-link" href="/cart"><i class="bi bi-cart"></i>
            Cart</a></li>
        <li class="nav-item dropdown me-5 textRight">
          <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="bi bi-person icon"></i> Account
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            <i class="bi bi-person-circle dropdown-account-icon"></i>
            <?php renderAccountMenu(FILE_ROOT); ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <div class="cart-alerts sticky-alerts mt-3 w-50 mx-auto">
    <?php

    if ($uri == '/forgot') {
      forgotPasswordAlert();
    } else {
      // emailSubscribeAlert();
      printCartAlerts();
      check_signup_errors();
      check_login_errors();
      resetPasswordAlert();
      logoutAlert();
    }

    ?>
  </div>




</body>

</html>