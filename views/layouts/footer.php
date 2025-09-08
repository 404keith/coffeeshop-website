<style>
  .footer {
    /* background-color: #FFF6EB; */
       background-color:#281A11;
    color: #e68a00;
    padding: 30px 20px;
    margin-top: 50px;
  }

  .btn-primary {
    background-color: #D48423 !important;
    border: none;
    box-shadow: none;
  }

  .btn-primary:hover {
    background-color: #C3680B !important;
    box-shadow: none;
    border: none;
  }

  .nav-link {
    color: #e68a00;
    font-size: 12px;
  }

  .footer h6,
  .footer p,
  .footer a,
  .footer i {
    color: #e68a00;
  }

  .footer h6 {
    font-weight: 600;
  }

  .footer .connect-title {
    letter-spacing: 1px;
  }

  /* Social icon hover effect */
  .transition {
    transition: color 0.3s ease, transform 0.3s ease;
  }
  .transition:hover {
    color: #ffae42 !important;
    transform: scale(1.2);
  }

  /* Newsletter input text */
  .footer input {
    color: #000;
  }

  .footer-logo {
    height: 20px;
  }

  p{
    font-size:12px;
  }
</style>

<footer class="footer">
  <div class="container">
    <div class="row">
      <!-- Column 1: About -->
      <div class="col-12 col-md-2 ms-5 mb-3 text-center text-md-start">
        <h6 class="small fw-semibold mb-2">ABOUT US</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Our Story</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Team</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Careers</a></li>
        </ul>
      </div>

      <!-- Column 2: Services -->
      <div class="col-12 col-md-1 mb-3 text-center text-md-start">
        <h6 class="small fw-semibold mb-2">SERVICES</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Menu</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Catering</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small">Events</a></li>
        </ul>
      </div>

      <!-- Spacer Column (empty) -->
      <div class="col-12 col-md-1 ms-2"></div>
  
      <!-- Column 3: Social (centered) -->
      <div class="col-12 col-md-3 mb-3 text-center">
        <h6 class="small fw-semibold mb-2 connect-title">CONNECT WITH US</h6>
        <div class="d-flex justify-content-center gap-3">
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

      <!-- Spacer Column (empty) -->
      <div class="col-12 col-md-1"></div>

      <!-- Column 4: Newsletter Subscription -->
      <div class="col-12 col-md-3 mb-3 text-center text-md-start">
        <form>
          <h6 class="fw-semibold mb-2">Subscribe to our newsletter</h6>
          <p class="mb-2">Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input
              id="newsletter1"
              type="email"
              class="form-control"
              placeholder="Email address"
            />
            <button class="btn btn-primary" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>

    <hr class="border-warning">

    <div class="text-center mb-3">
      <img src="<?php echo FILE_ROOT; ?>/public/assets/images/logo.png" alt="Coffee by Monday Mornings" class="footer-logo">
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
      <p class="mb-0">&copy; 2025 Coffee by Monday Mornings. All rights reserved</p>
      <!-- <ul class="list-unstyled d-flex mb-0">
        <li class="ms-3">
          <a href="https://www.instagram.com/coffeebymondaymornings/" class="fs-5 transition">
            <i class="bi bi-instagram"></i>
          </a>
        </li>
        <li class="ms-3">
          <a href="https://www.facebook.com/profile.php?id=100092605117539" class="fs-5 transition">
            <i class="bi bi-facebook"></i>
          </a>
        </li>
        <li class="ms-3">
          <a href="https://www.tiktok.com/@coffeebymondaymornings" class="fs-5 transition">
            <i class="bi bi-tiktok"></i>
          </a>
        </li>
      </ul> -->
       <img src="<?php echo FILE_ROOT; ?>/public/assets/images/logo.png" alt="Coffee by Monday Mornings" class="footer-logo">
  </div>

</footer>

<script src="<?= FILE_ROOT ?>/public/assets/js/mdb.umd.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/all.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/functions.js"></script>
