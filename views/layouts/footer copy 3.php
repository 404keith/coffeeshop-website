<style>
  .btn-primary {
    background-color: #D48423 !important;
    border-color: #D48423 !important;
  }

  .btn-primary:hover {
    background-color: #C3680B !important;
    border-color: #C3680B !important;
  }
</style>

<footer class="footer" style="background-color: #3a2412; color: #e68a00; padding: 30px 20px; margin-top: 50px;">
  <div class="container">
    <div class="row">
      <!-- Column 1: Social -->
      <div class="col-6 col-md-3 mb-3 text-center text-md-start">
        <h6 class="small fw-semibold mb-2" style="letter-spacing: 1px; color: #e68a00;">CONNECT WITH US</h6>
        <div class="d-flex justify-content-center justify-content-md-start gap-3">
          <a href="https://www.facebook.com/profile.php?id=100092605117539" target="_blank" class="fs-5 transition"
            style="color: #e68a00;">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="https://www.instagram.com/coffeebymondaymornings/" target="_blank" class="fs-5 transition"
            style="color: #e68a00;">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="https://www.tiktok.com/@coffeebymondaymornings" target="_blank" class="fs-5 transition"
            style="color: #e68a00;">
            <i class="bi bi-tiktok"></i>
          </a>
        </div>
      </div>

      <!-- Column 2: About -->
      <div class="col-6 col-md-3 mb-3 text-center text-md-start">
        <h6 class="small fw-semibold mb-2" style="color: #e68a00;">ABOUT US</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small" style="color: #e68a00;">Our Story</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small" style="color: #e68a00;">Team</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small" style="color: #e68a00;">Careers</a></li>
        </ul>
      </div>

      <!-- Column 3: Services -->
      <div class="col-6 col-md-3 mb-3 text-center text-md-start">
        <h6 class="small fw-semibold mb-2" style="color: #e68a00;">SERVICES</h6>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small" style="color: #e68a00;">Menu</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small" style="color: #e68a00;">Catering</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 small" style="color: #e68a00;">Events</a></li>
        </ul>
      </div>

      <!-- Column 4: Newsletter Subscription -->
      <div class="col-6 col-md-3 mb-3 text-center text-md-start">
        <form>
          <h6 class="fw-semibold mb-2" style="color: #e68a00;">Subscribe to our newsletter</h6>
          <p class="small mb-2" style="color: #e68a00;">Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" type="email" class="form-control" placeholder="Email address" />
            <button class="btn btn-primary" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>

    <hr class="border-warning">

    <div class="text-center mb-3">
      <img src="<?php echo FILE_ROOT; ?>/public/assets/images/logo.png" alt="Coffee by Monday Mornings"
        style="height: 20px;">
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
      <p class="small mb-0" style="color: #e68a00;">&copy; 2025 Coffee by Monday Mornings. All rights reserved</p>
      <ul class="list-unstyled d-flex mb-0">
        <li class="ms-3">
          <a href="https://www.instagram.com/coffeebymondaymornings/" class="fs-5 transition" style="color: #e68a00;">
            <i class="bi bi-instagram"></i>
          </a>
        </li>
        <li class="ms-3">
          <a href="https://www.facebook.com/profile.php?id=100092605117539" class="fs-5 transition"
            style="color: #e68a00;">
            <i class="bi bi-facebook"></i>
          </a>
        </li>
        <li class="ms-3">
          <a href="https://www.tiktok.com/@coffeebymondaymornings" class="fs-5 transition" style="color: #e68a00;">
            <i class="bi bi-tiktok"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>

</footer>

<style>
  /* Social icon hover effect */
  .transition {
    transition: color 0.3s ease, transform 0.3s ease;
  }

  .transition:hover {
    color: #ffae42 !important;
    transform: scale(1.2);
  }

  /* Make all input text inside newsletter white for visibility */
  .footer input {
    color: #000;
  }
</style>

<script src="<?= FILE_ROOT ?>/public/assets/js/mdb.umd.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/all.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/functions.js"></script>