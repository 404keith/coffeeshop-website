<?php include APP_ROOT . '/views/layouts/header.php'; ?>

<div class="container mt-5">
  <div class="row align-items-center justify-content-center mb-4">
    <div class="col-auto">
      <a href="/pastries" class="product-toggle">
        <i class="bi bi-caret-left-fill fs-5"></i>
      </a>
    </div>
    <div class="col-auto">
      <h2 class="mb-0 product-title">Waffles</h2>
    </div>
    <div class="col-auto">
      <a href="/drinks" class="product-toggle">
        <i class="bi bi-caret-right-fill fs-5 "></i>
      </a>
    </div>
  </div>
  
  <div class="row g-4">
    <?php if (empty($products)) {
        echo '<p style="color:red">Product is empty</p>';
    } ?>

    <?php foreach ($products as $product): ?>
      <div class="col-md-3 d-flex">
        <div class="card flex-fill shadow-sm">
          <img src="<?= htmlspecialchars($product['image']) ?>" 
              class="card-img-top" 
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
