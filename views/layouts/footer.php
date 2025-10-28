<style>
  .footer {
    background-color: #281A11;
    color: #D68421;
    padding: 30px 20px;
    box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
  }

  .btn-primary {
    background-color: #D68421 !important;
    border: none;
    box-shadow: none;
  }

  .btn-primary:hover {
    background-color: #D68421 !important;
    box-shadow: none;
    border: none;
  }

  .nav-link {
    color: #D68421;
    font-size: 12px;
  }

  .footer h6,
  .footer p,
  .footer a,
  .footer i {
    color: #D68421;
  }

  .footer h6 {
    font-weight: 600;
  }

  .footer .connect-title {
    letter-spacing: 1px;
  }

  .transition {
    transition: color 0.3s ease, transform 0.3s ease;
  }

  .transition:hover {
    color: #ffae42 !important;
    transform: scale(1.2);
  }

  .footer input {
    color: #000;
  }

  .footer-logo {
    height: 20px;
  }

  .copyright {
    font-size: 12px;
  }

  /* Default for extra small devices (mobile <576px) */
  .footer .mobile-footer-section>.row>div {
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .footer .mobile-footer-section .d-flex.flex-column.flex-sm-row.w-100.gap-2 {
    flex-direction: column !important;
    align-items: center;
  }

  .footer .mobile-footer-section .d-flex.flex-column.flex-sm-row .form-control {
    width: 80% !important;
    margin-bottom: 10px;
  }

  .footer .mobile-footer-section .d-flex.flex-column.flex-sm-row .btn {
    width: 80% !important;
  }

  /* Small devices (sm) - phones, some tablets */
  @media (min-width: 576px) and (max-width: 767.98px) {
    .footer .mobile-footer-section .d-flex.flex-column.flex-sm-row.w-100.gap-2 {
      flex-direction: row !important;
      justify-content: center;
    }

    .footer .mobile-footer-section .d-flex.flex-column.flex-sm-row .form-control {
      width: auto !important;
      margin-bottom: 0;
    }

    .footer .mobile-footer-section .d-flex.flex-column.flex-sm-row .btn {
      width: auto !important;
    }
  }

  /* Medium devices (md) - tablets, small desktops (iPad view) */
  @media (min-width: 768px) and (max-width: 1024px) {
    .footer .row {
      justify-content: center;
      align-items: flex-start;
    }

    .footer .col-12.col-md-2.ms-md-5.mb-3.text-center.text-md-start.order-1.order-md-1 {
      order: 1;
      flex: 0 0 25%;
      max-width: 25%;
      margin-left: 0 !important;
      margin-right: 1rem;
      text-align: start !important;
    }

    .footer .col-12.col-md-1.mb-3.text-center.text-md-start.order-3.order-md-2 {
      order: 2;
      flex: 0 0 25%;
      max-width: 25%;
      margin-left: 1rem !important;
      margin-right: 1rem !important;
      text-align: start !important;
    }

    .footer .col-12.col-md-3.mb-1.text-center.order-2.order-md-4.footer-gap {
      order: 3;
      flex: 0 0 25%;
      max-width: 25%;
      margin-left: 1rem !important;
      margin-right: 0 !important;
      text-align: center !important;
    }

    /* Hide the empty spacer columns */
    .footer .d-none.d-md-block.col-md-1.ms-2.order-md-3,
    .footer .d-none.d-md-block.col-md-1.ms-2.order-md-4 {
      display: none !important;
    }

    /* Newsletter input wider for iPad */
    .footer #newsletter1 {
      width: 70% !important;
      margin-right: 10px;
    }

    .footer .d-flex.flex-column.flex-sm-row.w-100.gap-2 {
      flex-direction: row !important;
      justify-content: center;
    }

    .footer .d-flex.flex-column.flex-sm-row .btn {
      width: auto !important;
    }

    /* New row for subscription form */
    .footer .subscription-row .col-12 {
      flex: 0 0 80%;
      max-width: 80%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
  }

  /* Large devices (lg) and up - web/PC view */
  @media (min-width: 1025px) {
    .footer .row>div {
      text-align: start;
      margin-bottom: 0;
    }

    .footer .col-md-2.ms-md-5 {
      margin-left: 3rem !important;
    }

    .footer .d-none.d-md-block {
      display: block !important;
    }

    .footer .d-flex.flex-column.flex-sm-row.w-100.gap-2 {
      flex-direction: row !important;
      justify-content: flex-start;
    }

    .footer .d-flex.flex-column.flex-sm-row .form-control {
      width: auto !important;
      margin-bottom: 0;
    }

    .footer .d-flex.flex-column.flex-sm-row .btn {
      width: auto !important;
    }
  }
</style>

<footer id="main-footer" class="footer">
  <div class="container">
    <!-- Desktop and iPad Layout -->
    <div class="row d-none d-md-flex">
      <div class="col-12 col-md-2 ms-md-5 mb-3 text-center text-md-start order-1 order-md-1">
        <h6 class="small fw-semibold mb-2">ABOUT US</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Our Story</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Team</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Careers</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-1 mb-3 text-center text-md-start order-3 order-md-2">
        <h6 class="small fw-semibold mb-2">SERVICES</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Menu</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Catering</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Events</a></li>
        </ul>
      </div>

      <div class="d-none d-md-block col-md-1 ms-2 order-md-3"></div>


      <div class="col-12 col-md-3 mb-1 text-center order-2 order-md-4 footer-gap">
        <h6 class="small mb-2">ORDER NOW</h6>
        <div class="d-flex justify-content-center gap-3">
          <a href="#" target="_blank" class="fs-5 transition text-decoration-none">
            <p class="nav-link p-0 small">FoodPanda</p></i>
          </a>
          <p>*</p>
          <a href="#" target="_blank" class="fs-5 transition text-decoration-none">
            <p class="nav-link p-0 small ">GrabFood</p></i>
          </a>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-2">
          <a href="https://www.facebook.com/profile.php?id=100092605117539" target="_blank" class="fs-5 transition">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="https://www.instagram.com/coffeebymondaymornings/" target="_blank" class="fs-5 transition">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="https://www.tiktok.com/@coffeebymondaymornings" target="_blank" class="fs-5 transition">
            <i class="bi bi-tiktok"></i>
          </a>
        </div>
      </div>

      <div class="d-none d-md-block col-md-1 ms-2 order-md-4"></div>

      <div class="col-12 col-md-3 mb-3 text-center text-md-start order-4 order-md-6 d-none d-lg-block">
        <form method="post">
          <h6 class="fw-semibold mb-2">Subscribe to our newsletter</h6>
          <p class="mb-2 p-0 small">Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" name="email" type="email" class="form-control" placeholder="Email address" />
            <button class="btn btn-primary" type="submit">Subscribe</button>
          </div>
        </form>

        <?php
        require_once APP_ROOT . '/controllers/emailController.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
          $email = trim($_POST['email']);
          if (sendSubscriptionEmail($email)) {
            $_SESSION['subscription_success'] = "Thank you for subscribing!";
          } else {
            $_SESSION['subscription_error'] = "Could not send subscription email.";
          }
          exit;
        }
        ?>
      </div>
    </div>



    <!-- Mobile Layout -->
    <div class="mobile-footer-section d-md-none">
      <div class="row">
        <div class="col-6 mb-3 text-center">
          <h6 class="small fw-semibold mb-2">ABOUT US</h6>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Our Story</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Team</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Careers</a></li>
          </ul>
        </div>

        <div class="col-6 mb-3 text-center">
          <h6 class="small fw-semibold mb-2">SERVICES</h6>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Menu</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Catering</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Events</a></li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-12 mb-3 text-center">
          <h6 class="small mb-2">ORDER NOW</h6>
          <div class="d-flex justify-content-center gap-3">
            <a href="#" target="_blank" class="fs-5 transition text-decoration-none">
              <p class="nav-link p-0 small">FoodPanda</p></i>
            </a>
            <p>*</p>
            <a href="#" target="_blank" class="fs-5 transition text-decoration-none">
              <p class="nav-link p-0 small ">GrabFood</p></i>
            </a>
          </div>

          <div class="d-flex justify-content-center gap-3 mt-2">
            <a href="https://www.facebook.com/profile.php?id=100092605117539" target="_blank" class="fs-5 transition">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="https://www.instagram.com/coffeebymondaymornings/" target="_blank" class="fs-5 transition">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.tiktok.com/@coffeebymondaymornings" target="_blank" class="fs-5 transition">
              <i class="bi bi-tiktok"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- email subscription in its own row for mobile/tablet -->
      <div class="row subscription-row mt-4">
        <div class="col-12 text-center">
          <form method="post">
            <h6 class="fw-semibold mb-2">Subscribe to our newsletter</h6>
            <p class="mb-2 p-0 small">Monthly digest of what's new and exciting from us.</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2 justify-content-center">
              <label for="newsletter1" class="visually-hidden">Email address</label>
              <input id="newsletter1" name="email" type="email" class="form-control" placeholder="Email address" />
              <button class="btn btn-primary" type="submit">Subscribe</button>
            </div>
          </form>

          <?php
          require_once APP_ROOT . '/controllers/emailController.php';

          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = trim($_POST['email']);
            if (sendSubscriptionEmail($email)) {
              $_SESSION['subscription_success'] = "Thank you for subscribing!";
            } else {
              $_SESSION['subscription_error'] = "Could not send subscription email.";
            }
            exit;
          }

          ?>
        </div>
      </div>


      <!-- <div class="text-center mb-3">
      <img src="<?php echo FILE_ROOT; ?>/public/assets/images/logo.png" alt="Coffee by Monday Mornings" class="footer-logo">
    </div> -->
      <hr class="border-warning">

      <div class="text-center ">
        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/logo.png" alt="Coffee by Monday Mornings"
          class="footer-logo mb-2">
        <p class="mb-0 copyright">&copy; 2025 Coffee by Monday Mornings. All rights reserved</p>
      </div>



</footer>

<!-- alert time in seconds -->
<?php
$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
  case '/my-orders':
    $alertTimeSeconds = 20;
    break;
  default:
    $alertTimeSeconds = 5;
    break;
}

displayAlertTimeJs($alertTimeSeconds);
?>


<script src="<?= FILE_ROOT ?>/public/assets/js/mdb.umd.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/all.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/functions.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/password.js"></script>


<!-- alerts -->