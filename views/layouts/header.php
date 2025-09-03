<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Responsive Header</title>
  <!-- Local Bootstrap CSS -->
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  <!-- Local Bootstrap Icons -->
  <link rel="stylesheet" href="../public/assets/css/bootstrap-icons.css">

<style>
  @font-face {
    font-family: 'inter';
    src: url('../public/assets/fonts/Inter_18pt-Regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
  }

  * {
    font-family: 'inter';
  }

  .navbar-color {
    background-color: #fff6eb;
  }

  .text-color .nav-link {
    color: rgba(212, 132, 35, 1);
    font-size: 13px;

  }

  .text-color .nav-link:hover {
    color: rgba(123, 61, 0, 1);
  }

  /* Logo is always responsive */
  .logo {
    max-width: 125px;  /* max width constraint */
    height: 49px;      /* keeps aspect ratio */
  }

  @media (min-width: 768px) {
    .navbar .container-fluid {
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
    }
    .navbar-brand {
      grid-column: 2;
      margin: 0 auto;
    }
    .navbar-left {
      justify-content: flex-start;
    }
    .navbar-right {
      justify-content: flex-end;
    }
  }

  .navbar-toggler {
  border-color: rgba(212, 132, 35, 1);
  background-color: transparent;      
}

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(212, 132, 35, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

   /*when clicked*/
        .navbar-toggler[aria-expanded="true"] +  .navbar-collapse .nav-link {
        color: rgba(212, 132, 35, 1); 
      }

    /*REMOVE WHITE */
   .navbar-toggler:focus,
  .navbar-toggler:active,
  .navbar-toggler-icon:focus {
      outline: none;
      box-shadow: none;
  }


</style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-color py-3">
  <div class="container-fluid">

    <!-- Left Nav (desktop only) -->
    <ul class="navbar-nav navbar-left d-none d-md-flex ms-5 text-color">
      <li class="nav-item ms-5"><a class="nav-link" href="index.php">HOME</a></li>
      <li class="nav-item ms-5"><a class="nav-link" href="#">MENU</a></li>
      <li class="nav-item ms-5"><a class="nav-link" href="#">ABOUT US</a></li>
    </ul>

   <!-- Logo for desktop (centered) -->
    <a class="navbar-brand fw-bold text-primary d-none d-md-block" href="../public/index.php">
      <img src="../public/assets/images/logo.png" alt="logo" class="logo">
    </a>

    <!-- Logo for mobile (with ms-5) -->
    <a class="navbar-brand fw-bold text-primary d-md-none ms-5" href="../public/index.php">
      <img src="../public/assets/images/logo.png" alt="logo" class="logo">
    </a>


    <!-- Right Nav (desktop only) -->
    <ul class="navbar-nav navbar-right d-none d-md-flex align-items-center me-5 text-color">
      <li class="nav-item me-5"><a class="nav-link" href="#">CONTACT US</a></li>
      <li class="nav-item me-5"><a class="nav-link" href="#">CART</a></li>
      <li class="nav-item me-5"><a class="nav-link" href="#">ACCOUNT</a></li>
    </ul>

    <!-- Hamburger toggle -->
    <button class="navbar-toggler me-5 navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"
      aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible Mobile Menu -->
    <div class="collapse navbar-collapse" id="mobileMenu">
      <ul class="navbar-nav text-center w-100 d-md-none">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-cart"></i> Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-person"></i> Account</a></li>
      </ul>
    </div>

  </div>
</nav>

<!-- Local Bootstrap JS -->
<script src="../public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
