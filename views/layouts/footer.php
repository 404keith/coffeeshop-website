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
  flex-direction: column; 
  align-items: center;   
  text-align: center; 
  gap: 15px;              
}

.footer .logo img {
  height: 20px;   
   
}


  .footer .logo {
    margin: -5px auto;      
    margin-bottom: -2rem;
    text-align: center;   
    width: 100%;         
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
  width: 90%;
  margin: 0 auto;
}

.footer .copyright {
  font-size: 12px;
  margin:0;
  padding: 0;
  color: #e68a00;
  text-align: center;

}


@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    text-align: center;
  }

  .footer .logo {
    margin-bottom: -2.5rem;
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

  
    <div>
      <p class="connect-text">CONNECT WITH US</p>
      <div class="social-icons">
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

  <hr>

    <div class="logo">
      <img src="<?php echo FILE_ROOT; ?>/public/assets/images/logo.png" alt="Coffee by Monday Mornings">
    </div>
    
  <p class="copyright">© 2025 Coffee by Monday Mornings. All rights reserved</p>

</footer>

<script src="<?= FILE_ROOT ?>/public/assets/js/mdb.umd.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo FILE_ROOT; ?>/public/assets/js/all.min.js"></script>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
