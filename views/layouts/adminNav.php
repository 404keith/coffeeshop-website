<link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/fonts.css">


<style>
  body {
    margin: 0;
  }

  .admin-navbar {
    background: #fdf3e6;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 0 0 0;
    min-height: 80px;
    border-bottom: 1px solid #e5e0da;
    margin: 0;
    width: 100vw;
    box-sizing: border-box;
  }

  .admin-navbar .logo {
    height: 40px;
    margin-left: 80px;
  }

  .admin-navbar .user-icon {
    font-size: 2rem;
    color: #d4842c;
    cursor: pointer;
    margin-right: 24px;
  }

  .admin-navbar a {
    margin-right: 80px;
  }
</style>


<nav class="admin-navbar">
  <div>
    <a href="/"><img src="<?= FILE_ROOT ?>/public/assets/images/logo.png" alt="Monday Mornings" class="logo"></a>
  </div>
  <div>
    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="" data-bs-toggle="dropdown"
      aria-expanded="false">
      <i class="bi bi-person icon"></i>
    </a>

  </div>
</nav>