<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
      <!-- Local Bootstrap CSS -->
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  <!-- Local Bootstrap Icons -->
  <link rel="stylesheet" href="../public/assets/css/bootstrap-icons.css">
  <style>
.footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
  background-color: #3a2412; /* dark brown */
  color: #e68a00; /* orange text */
  padding: 30px 20px;
  text-align: center;
}

.footer .connect-text {
  font-size: 14px;
  margin-bottom: 15px;
  font-weight: 500;
  letter-spacing: 1px;
}

.footer .social-icons {
  margin-bottom: 15px;
}

.footer .social-icons a {
  color: #e68a00;
  font-size: 24px;
  margin: 0 15px;
  transition: color 0.3s ease, transform 0.3s ease;
}

.footer .social-icons a:hover {
  color: #ffae42;
  transform: scale(1.2);
}

.footer hr {
  border: none;
  border-top: 1px solid #e68a00;
  width: 80%;
  margin: 15px auto;
}

.footer .copyright {
  font-size: 12px;
  margin: 0;
  color: #e68a00;
}


  </style>
</head>

<footer class="footer">
  <div class="footer-content">
    <p class="connect-text">CONNECT WITH US</p>
    <div class="social-icons">
      <a href="https://www.facebook.com/search/top?q=coffee%20by%20monday%20mornings"><i class="facebook"></i></a>
      <a href="#"><i class="instagram"></i></a>
      <a href="#"><i class="tiktok"></i></a>
    </div>
    
    <p class="copyright">© 2025 Coffee by Monday Mornings. All rights reserved</p>
  </div>

  <script src="../public/assets/js/bootstrap.bundle.min.js"></script>
</footer>

