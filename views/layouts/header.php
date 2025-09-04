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

  <style>
    @font-face{
      font-family:'inter';
      src:url('../public/assets/fonts/Inter_18pt-Regular.ttf') format('truetype');
      font-weight:normal;
      font-style:normal;
    }

    * { font-family:'inter'; }

    .navbar-color { background-color:#fff6eb; }

    .text-color .nav-link{
      color:rgba(212,132,35,1);
      font-size:13px;
    }
    .text-color .nav-link:hover{ color:rgba(123,61,0,1); }

    .logo{ max-width:125px; height:49px; }

    @media (min-width:768px){
      .navbar .container-fluid{
        display:grid;
        grid-template-columns:1fr auto 1fr;
        align-items:center;
    
      }
      .navbar-brand{ grid-column:2; margin: auto; }
      .navbar-left{  justify-content:flex-start; }
      .navbar-right{ justify-content:flex-end; }
    }

    .navbar-toggler{
      border-color:rgba(212,132,35,1);
      background-color:transparent;
    }
    .navbar-toggler-icon{
      background-image:url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(212,132,35,1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
    .navbar-toggler:focus,
    .navbar-toggler:active,
    .navbar-toggler-icon:focus{
      outline:none; box-shadow:none;
    }

    /* Offcanvas (sidebar) look & feel */
    .offcanvas-custom{
     --bs-offcanvas-width: 13rem;            /* sidebar width */
      background:#fff6eb;       /* match navbar */
    }
    .offcanvas-custom .nav-link{
      color:rgba(212,132,35,1);
      font-size:20px;
      padding:.6rem 0;
      margin-top:5px;
    }
    .offcanvas-custom .nav-link:hover{
      color:rgba(123,61,0,1);
     
    }
    .offcanvas-custom .offcanvas-header{
      border-bottom:1px solid rgba(0,0,0,.06); 
       padding-bottom: 1.8rem;
       padding-top: 1.8rem;
    }

   .btn-close {
    width: 2rem;
    height: 2rem;
    background-size: 2rem;
    opacity:1;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23d48423'><path d='M2.146 2.854a.5.5 0 0 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854z'/></svg>");
  }


  </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-color py-3">
  <div class="container-fluid">

    <!-- Left (desktop) -->
    <ul class="navbar-nav navbar-left d-none d-md-flex ms-5 text-color">
      <li class="nav-item ms-5"><a class="nav-link" href="index.php">HOME</a></li>
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
      <li class="nav-item me-5"><a class="nav-link" href="#">ACCOUNT</a></li>
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
