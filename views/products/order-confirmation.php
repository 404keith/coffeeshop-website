<?php
include APP_ROOT . '/views/layouts/header.php';

// Retrieve and clear the success message from the session if it exists.
$success_message = '';
if (isset($_SESSION['order_success'])) {
    $success_message = $_SESSION['order_success'];
    unset($_SESSION['order_success']); // Clear it so it doesn't show on refresh
}
?>


<div class="container mt-5">
    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php elseif ($order): ?>

        <!-- ACTUAL ORDER CONFIRMATION MESSAGE -->
        <?php if ($success_message): ?>
            <div class="alert bg-primary text-white text-center shadow-lg mb-5 mx-auto p-4 rounded-3" style="max-width: 800px;">
                <h4 class="alert-heading fw-bold"><i class="bi bi-check-circle-fill me-2"></i>Order Placed Successfully!</h4>
                <p class="mb-0"><?= htmlspecialchars($success_message) ?></p>
            </div>
        <?php endif; ?>
        <!-- END ORDER CONFIRMATION MESSAGE -->

        <h2 class="text-center mb-4">Order Summary</h2>
        <div class="card shadow-sm mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <h5 class="card-title mb-3">Order #<?= htmlspecialchars($order['id']) ?></h5>
                <p><strong>Order Type:</strong> <?= htmlspecialchars(ucfirst($order['order_type'])) ?></p>

                <?php if ($order['order_type'] === 'delivery'): ?>
                    <p><strong>Recipient:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                <?php endif; ?>

                <p><strong>Order Date:</strong> <?= htmlspecialchars($order['created_at']) ?></p>

                <hr>

                <h6>Items:</h6>
                <ul class="list-group mb-3">
                    <?php foreach ($orderItems as $item): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <div><?= htmlspecialchars($item['name']) ?> (x<?= $item['quantity'] ?>)</div>
                            <span>P <?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>P <?= number_format($order['total'], 2) ?></span>
                    </li>
                </ul>
                <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary w-100">Back to Shop</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>