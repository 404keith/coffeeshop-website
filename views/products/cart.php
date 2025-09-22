<?php
include APP_ROOT . '/views/products/cartView.php';
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Your Cart</h2>

    <?php if (isset($_SESSION['add_to_cart_error'])): ?>
        <div class="alert alert-danger w-75 mx-auto" role="alert">
            <?= htmlspecialchars($_SESSION['add_to_cart_error']); ?>
        </div>
        <?php unset($_SESSION['add_to_cart_error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['add_to_cart_success'])): ?>
        <div class="alert alert-success w-75 mx-auto" role="alert">
            <?= htmlspecialchars($_SESSION['add_to_cart_success']); ?>
        </div>
        <?php unset($_SESSION['add_to_cart_success']); ?>
    <?php endif; ?>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info text-center" role="alert">
            Your cart is empty. Please add some items before checking out.
            <br>
            <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3">Buy Now</a>
        </div>
    <?php else: ?>
        <?php include APP_ROOT . '/views/layouts/header.php'; ?>
        <div class="card shadow-sm mx-auto" style="max-width:1000px">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php $total = 0; ?>
                    <?php foreach ($cartItems as $item): ?>
                        <?php $itemTotal = $item['price'] * $item['quantity']; ?>
                        <?php $total += $itemTotal; ?>

                        <!-- col1 -->
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <!-- col1: Product Info -->
                                <div class="col-md-5">
                                    <h6 class="my-0"><?= htmlspecialchars($item['name']) ?></h6>
                                    <small class="text-muted">P <?= number_format($item['price'], 2) ?> each</small>
                                </div>

                                <!-- col2: Price (centered column, text left aligned) -->
                                <div class="col-md-3 d-flex justify-content-center">
                                    <span class="text-muted w-100 text-start">
                                        P <?= number_format($itemTotal, 2) ?>
                                    </span>
                                </div>

                                <!-- col3: Actions -->
                                <div class="col-md-4 d-flex justify-content-end">
                                    <form method="POST" action="<?= FILE_ROOT ?>/cart-actions"
                                        class="d-flex align-items-center">
                                        <input type="hidden" name="cart_item_id" value="<?= (int) $item['id'] ?>">
                                        <input type="number" name="quantity" value="<?= (int) $item['quantity'] ?>" min="1"
                                            class="form-control me-2" style="width: 80px;">

                                        <!-- buttons -->
                                        <button type="submit" name="action" value="update" class="btn btn-primary btn-sm me-2"
                                            style="width:30px; height:30px;">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="submit" name="action" value="remove" class="btn btn-danger btn-sm"
                                            style="width:29px; height:29px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>

                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                        <span>Total</span>
                        <span>P <?= number_format($total, 2) ?></span>
                    </li>
                </ul>

                <hr class="my-4">

                <a href="<?= FILE_ROOT ?>/checkout" class="btn btn-primary btn-lg w-100 mt-4">Proceed to Checkout</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>