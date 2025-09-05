<style>
.footer {
  position: absolute; 
  left: 0; 
  right: 0; 
  background-color: #3a2412; 
  color: #e68a00; 
  padding: 30px 20px; 
  text-align: center; 
  width: 100%; 
  top: 100vh; 
  min-height: 120px;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: auto;
}

.footer .logo img {
  height: 50px;
}

.footer .connect-text {
  font-size: 14px;
  margin-bottom: 10px;
  font-weight: 500;
  letter-spacing: 1px;
}

.footer .social-icons {
  display: flex;
  align-items: center;
  gap: 40px;
}

.footer .social-icons a {
  color: #e68a00;
  font-size: 24px;
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
  text-align: center;
  width: 100%;
  margin-top: 15px;
}


@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    text-align: center;
  }

  .footer .logo {
    margin-bottom: 15px;
    text-align: center;   
    width: 100%;         
  }

  .footer .logo img {
    margin: 0 auto;      
    display: block;      
  }
}
</style>

<footer class="footer">
  <div class="footer-content">

    <div class="logo">
      <img src="<?php echo URL_ROOT; ?>/public/assets/images/logo.png" alt="Coffee by Monday Mornings">
    </div>

    <!-- Social Icons -->
    <div>
      <p class="connect-text">CONNECT WITH US</p>
      <div class="social-icons">
        <!-- Direct link to FB Page -->
        <a href="https://www.facebook.com/profile.php?id=100092605117539" target="_blank">
          <i class="bi bi-facebook"></i>
        </a>
        <a href="https://www.instagram.com/coffeebymondaymornings/" target="_blank">
          <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.tiktok.com/@coffeebymondaymornings" target="_blank">
          <i class="bi bi-tiktok"></i>
        </a>
      </div>
    </div>
  </div>

  <hr>
  <p class="copyright">© 2025 Coffee by Monday Mornings. All rights reserved</p>
</footer>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
