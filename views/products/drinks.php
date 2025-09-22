<?php
include APP_ROOT . '/views/layouts/header.php';
require_once APP_ROOT . '/helpers/product_icons.php';
?>

<div class="container mt-3">
  <div class="row align-items-center mb-4">
    <div class="col">
      <div class="d-flex align-items-center">

        <?php displayProductIcons(); ?>

      </div>
    </div>
  </div>

  <div class="row g-4">
    <?php if (empty($products)) {
      echo '<p style="color:red">Product is empty</p>';
    } ?>
    <div class="container mt-3" style="max-width: 1100px;"> <!-- narrowed container -->
      <div class="row g-4 justify-content-center"> <!-- center columns -->
        <?php foreach ($products as $product): ?>
          <div class="col-md-4 d-flex"> <!-- exactly 3 per row on md+ -->
            <div class="card flex-fill shadow-sm">
              <img src="<?php echo FILE_ROOT; ?>/public/assets/images/DRINKSs.png" alt="Sad face"
                class="img-fluid mx-auto" style="max-width: 150px;">

              <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top"
                alt="<?= htmlspecialchars($product['name']) ?>">

              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                <p class="fw-bold">$<?= number_format($product['price'], 2) ?></p>
                <form method="POST" action="<?= FILE_ROOT ?>/cart">
                  <input type="hidden" name="action" value="add">
                  <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                  <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                  <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>


    <script src="<?= FILE_ROOT ?>/public/assets/js/mdb.umd.min.js"></script>
    <script src="<?php echo FILE_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
    <script src="<?php echo FILE_ROOT; ?>/public/assets/js/all.min.js"></script>
    <script src="<?php echo FILE_ROOT; ?>/public/assets/js/functions.js"></script>