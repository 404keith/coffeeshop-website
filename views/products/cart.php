<?php
include APP_ROOT . '/views/products/cartView.php';
// include APP_ROOT . '/views/products/alerts.php';

?>

<style>
    .title {
        font-family: 'pacifico';
        color: #D68421;
        font-size: 3rem;
    }
</style>

<?php include APP_ROOT . '/views/layouts/header.php'; ?>
<?php if (empty($cartItems)): ?>

    <body class="d-flex flex-column min-vh-100" style="height:80rem">
        <main class="flex-fill">
            <div class="container mt-5">
                <h2 class="mb-4 text-center title">Your Cart</h2>
                <div class="alert-info text-center" role="alert">
                    Your cart is empty. Please add some items before checking out.
                    <br>
                    <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3">Buy Now</a>
                </div>
        </main>
    </body>

<?php else: ?>

    <body class="d-flex flex-column min-vh-100" style="height:80rem">
        <main class="flex-fill">
            <div class="container mt-5">
                <h2 class="mb-4 text-center title">Your Cart</h2>

                <!-- ALERTS -->
                <?php printCartAlerts(); ?>



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
                                            <small class="text-muted">P <?= number_format($item['price'], 2) ?>
                                                each</small>
                                        </div>

                                        <!-- col2: Price (centered column, text left aligned) -->
                                        <div class="col-md-3 d-flex justify-content-center">
                                            <span class="text-muted w-100 text-start">
                                                P <?= number_format($itemTotal, 2) ?>
                                            </span>

                                            <span class="text-muted w-100 text-start">
                                                x <?= number_format($item['quantity']) ?>
                                            </span>
                                        </div>

                                        <!-- col3: Actions -->
                                        <div class="col-md-4 d-flex justify-content-end">
                                            <form method="POST" action="<?= FILE_ROOT ?>/cart-actions"
                                                class="d-flex align-items-center">

                                                <!-- SAVE URI -->
                                                <input type="hidden" name="redirect"
                                                    value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">

                                                <input type="hidden" name="cart_item_id" value="<?= (int) $item['id'] ?>">

                                                <!-- Quantity input (hidden by default) -->
                                                <input type="number" name="quantity" value="<?= (int) $item['quantity'] ?>"
                                                    min="1" class="form-control me-2 quantity-input d-none"
                                                    style="width: 80px;">

                                                <!-- INITIAL Update button  -->
                                                <button type="button" class="btn btn-primary btn-sm me-2 start-update"
                                                    style="width:auto;">
                                                    Update
                                                </button>

                                                <!-- Save button (hidden by default) -->
                                                <button type="submit" name="action" value="update"
                                                    class="btn btn-success btn-sm me-2 save-btn d-none"
                                                    style="width:30px; height:30px;">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>

                                                <!-- Delete button (hidden by default) -->
                                                <button type="submit" name="action" value="remove"
                                                    class="btn btn-danger btn-sm delete-btn d-none"
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

                        <a href="<?= FILE_ROOT ?>/checkout" class="btn btn-primary btn-lg w-100 mt-4">Proceed to
                            Checkout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".start-update").forEach(button => {
            button.addEventListener("click", function () {
                const form = this.closest("form");
                const input = form.querySelector(".quantity-input");
                const saveBtn = form.querySelector(".save-btn");
                const deleteBtn = form.querySelector(".delete-btn");

                // Show input + Save/Delete
                input.classList.remove("d-none");
                saveBtn.classList.remove("d-none");
                deleteBtn.classList.remove("d-none");

                // Hide "Update" button
                this.classList.add("d-none");

                // Autofocus quantity field
                input.focus();
            });
        });
    });
</script>



<?php include APP_ROOT . '/views/layouts/footer.php'; ?>