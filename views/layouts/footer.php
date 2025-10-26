<style>
  .footer {
    background-color: #281A11;
    /* background-color: #fff6eb; */

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

  @media (max-width: 767.98px) {
    .footer .row {
      --bs-gutter-x: 0.75rem;
    }

    .footer .text-center-xs {
      text-align: center;
    }
  }

  @media (min-width: 768px) {
    .footer-gap {
      margin-bottom: 2.5rem;
      /* gap only for desktop */
    }
  }
</style>

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-4 col-md-2 ms-md-5 mb-3 text-center text-md-start order-1 order-md-1">
        <h6 class="small fw-semibold mb-2">ABOUT US</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Our Story</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Team</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Careers</a></li>
        </ul>
      </div>

      <div class="col-4 col-md-1 mb-3 text-center text-md-start order-3 order-md-2">
        <h6 class="small fw-semibold mb-2">SERVICES</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Menu</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Catering</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Events</a></li>
        </ul>
      </div>

      <div class="d-none d-md-block col-md-1 ms-2 order-md-3"></div>


      <div class="col-4 col-md-3 mb-1 text-center order-2 order-md-4 footer-gap">
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

      <!-- email subscription -->
      <div class="col-12 col-md-3 mb-3 text-center text-md-start order-4 order-md-6">
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