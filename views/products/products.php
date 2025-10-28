<?php
include APP_ROOT . '/views/layouts/header.php';
require_once APP_ROOT . '/helpers/product_icons.php';
require_once APP_ROOT . '/config/session.php';

// ALERTS 
if (isset($_SESSION['add_to_cart_success'])) {
  echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="position:fixed; top:70px; left:50%; transform:translateX(-50%); z-index:1000;">';
  echo $_SESSION['add_to_cart_success'];
  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
  echo '</div>';
  unset($_SESSION['add_to_cart_success']);
}

// Display error message if it exists 
if (isset($_SESSION['add_to_cart_error'])) {
  echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="position:fixed; top:70px; left:50%; transform:translateX(-50%); z-index:1000;">';
  echo $_SESSION['add_to_cart_error'];
  echo '<button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close" style="width:10px; height:17px;"></button>';
  echo '</div>';
  unset($_SESSION['add_to_cart_error']);
}
?>

<head>
  <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/products.css" />
</head>

<?php
$currentURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($currentURI) {
  case '/drinks':
    $title = 'Drinks';
    break;
  case '/merienda':
    $title = 'Merienda';
    break;
  case '/waffles':
    $title = 'Waffles';
    break;
  case '/pastries':
    $title = 'Pastries';
    break;
  default:
    $title = 'Products'; // A default title
    break;
}
?>
<div class="container">
  <div class="row align-items-center">
    <div class="col">
      <h1 class="welcome-text mt-4 text-center">
        <?php echo htmlspecialchars($title); ?>
      </h1>

      <div class="d-flex justify-content-center align-items-center mb-3">
        <?php displayProductIcons(); ?>
      </div>

      <div class="d-flex justify-content-center align-items-center mb-3">
        <form action="" method="GET" class="search-form">
          <input type="text" name="search" id="search-input" data-category="<?php echo strtolower($title); ?>"
            placeholder="Search products..." class="search-input">
          <button type="submit" class="search-button">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-lg-11 col-xl-10">
      <div class="row g-4 justify-content-center" id="product-list">
        <?php include '_product_list.php'; // Include the new partial ?>
      </div>
    </div>
  </div>
</div>

<script src="<?= FILE_ROOT ?>/public/assets/js/search.js"></script>
<script src="<?= FILE_ROOT ?>/public/assets/js/category-loader.js"></script>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>