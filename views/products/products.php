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
$currentURI = $_SERVER['REQUEST_URI'];
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
    </div>
  </div>
</div>

<?php if (empty($products)) {
  echo '<p style="color:red">Product is empty</p>';
} ?>

<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-lg-11 col-xl-10">
      <div class="row g-4 justify-content-center">
        <?php foreach ($products as $product):
          $is_in_stock = $product['stock'] > 0;
          $stock_text = $is_in_stock ? 'In Stock' : 'Out of Stock';
          $stock_color = $is_in_stock ? 'text-success' : 'text-danger';
          ?>
          <div class="col-12 col-sm-6 col-md-4 d-flex">
            <div class="card flex-fill shadow-sm">
              <img src="<?= FILE_ROOT . htmlspecialchars($product['image']) ?>" class="card-img-top"
                alt="<?= htmlspecialchars($product['name']) ?>">

              <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center card-text">
                  <h5 class="card-title mb-0 fw-bold"><?= htmlspecialchars($product['name']) ?></h5>
                  <p class="fw-bold mb-0 price">P <?= number_format($product['price'], 2) ?></p>
                </div>
                <p class="fs-6 flex-grow-1"><?= htmlspecialchars($product['description']) ?></p>

                <!-- items inside cart: bottom part -->
                <p class="mb-2 fw-semibold <?= $stock_color ?>">
                  <?= $stock_text ?> (<?= $product['stock'] ?> available)
                </p>

                <form method="POST" action="<?= FILE_ROOT ?>/cart-actions">
                  <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                  <input type="hidden" name="action" value="add">
                  <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                  <div class="d-flex gap-2 star mb-1">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                  </div>
                  <h5 class="card-title product_type">
                    <?= strtoupper(htmlspecialchars($product['product_type'])) ?>
                  </h5>
                  <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-rounded w-75" <?= $is_in_stock ? '' : 'disabled' ?>>
                      <?= $is_in_stock ? 'Add to Cart' : 'Out of Stock' ?>
                    </button>
                    <?php
                    require_once APP_ROOT . '/models/cartModel.php';
                    $in_cart_qty = getCartQuantity($pdo, $_SESSION['user_id'] ?? 0, $product['id']);
                    $remaining_stock = $product['stock'] - $in_cart_qty;
                    ?>
                    <input type="number" name="quantity" value="1" min="1"
                      max="<?= $remaining_stock > 0 ? $remaining_stock : 1 ?>" class="form-control w-25" <?= $is_in_stock && $remaining_stock > 0 ? '' : 'disabled' ?>>
                  </div>
                </form>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>