<?php
include APP_ROOT . '/views/layouts/header.php';
require APP_ROOT . '/views/products/checkoutView.php';

?>


<div class="container mt-5">
    <h2 class="mb-4 text-center">Checkout</h2>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info text-center" role="alert">
            Your cart is empty. Please add some items before checking out.
            <br>
            <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3">Buy Now</a>
        </div>
    <?php else: ?>
        <div class="card shadow-sm mx-auto" style="max-width:1000px">
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <ul class="list-group list-group-flush">
                    <?php $total = 0; ?>
                    <?php foreach ($cartItems as $item): ?>
                        <?php $itemTotal = $item['price'] * $item['quantity']; ?>
                        <?php $total += $itemTotal; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="my-0"><?= htmlspecialchars($item['name']) ?></h6>
                                <small class="text-muted">Quantity: <?= htmlspecialchars($item['quantity']) ?></small>
                            </div>
                            <span class="text-muted">P <?= number_format($itemTotal, 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        <span>Total</span>
                        <span>P <?= number_format($total, 2) ?></span>
                    </li>
                </ul>

                <hr class="my-4">

                <h5 class="card-title">Shipping Information</h5>
                <form action="<?= FILE_ROOT ?>/place-order" method="POST">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="123 Main St"
                            required>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="zip" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="zip" name="zip" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 mt-4">Place Order</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>