<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Coffee by Monday Mornings</title>

  <!-- Local Bootstrap CSS -->
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css" />
  <!-- Local Bootstrap Icons -->
  <link rel="stylesheet" href="../public/assets/css/bootstrap-icons.css" />

  <link rel="stylesheet" href="../public/assets/css/header.css" />

</head>
<body>

<nav class="navbar navbar-expand-md navbar-color py-3">
  <div class="container-fluid">

    <!-- Left (desktop) -->
    <ul class="navbar-nav navbar-left d-none d-md-flex ms-5 text-color">
      <li class="nav-item ms-5 textLeft"><a class="nav-link" href="index.php">HOME</a></li>
      <li class="nav-item ms-5"><a class="nav-link" href="#">MENU</a></li>
      <li class="nav-item ms-5"><a class="nav-link" href="#">ABOUT US</a></li>
    </ul>

    <!-- Logo desktop (center) -->
    <a class="navbar-brand fw-bold text-primary d-none d-md-block" href="../public/index.php">
      <img src="../public/assets/images/logo.png" alt="logo" class="logo">
    </a>

    <!-- Logo mobile (left) -->
    <a class="navbar-brand fw-bold text-primary d-md-none ms-5" href="../public/index.php">
      <img src="../public/assets/images/logo.png" alt="logo" class="logo">
    </a>

    <!-- Right (desktop) -->
    <ul class="navbar-nav navbar-right d-none d-md-flex align-items-center me-5 text-color">
      <li class="nav-item me-5"><a class="nav-link" href="#">CONTACT US</a></li>
      <li class="nav-item me-5"><a class="nav-link" href="#">CART</a></li>
      <li class="nav-item me-5 textRight"><a class="nav-link" href="../views/auth/login.php">ACCOUNT</a></li>
    </ul>

    <!-- Hamburger toggles OFFCANVAS on mobile -->
    <button
      class="navbar-toggler me-5"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#mobileMenu"
      aria-controls="mobileMenu"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </div>
</nav>

<!-- Offcanvas Sidebar (Mobile) -->
<div class="offcanvas offcanvas-end offcanvas-custom" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
  <div class="offcanvas-header">
    <h6 class="offcanvas-title" id="mobileMenuLabel"></h6>
    <button type="button" class="btn-close me-5" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav text-end d-md-none me-5">
      <li class="nav-item "><a class="nav-link" href="index.php" data-bs-dismiss="offcanvas">Home</a></li>
      <li class="nav-item "><a class="nav-link" href="#" data-bs-dismiss="offcanvas">Menu</a></li>
      <li class="nav-item "><a class="nav-link" href="#" data-bs-dismiss="offcanvas">About Us</a></li>
      <li class="nav-item "><a class="nav-link" href="#" data-bs-dismiss="offcanvas">Contact Us</a></li>
      <li class="nav-item "><a class="nav-link" href="#" data-bs-dismiss="offcanvas"><i class="bi bi-cart"></i> Cart</a></li>
      <li class="nav-item "><a class="nav-link" href="#" data-bs-dismiss="offcanvas"><i class="bi bi-person"></i> Account</a></li>
    </ul>
  </div>
</div>

<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
