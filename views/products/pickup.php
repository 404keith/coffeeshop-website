<?php
include APP_ROOT . '/views/layouts/header.php';
?>

<div class="container mt-5">
    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php elseif ($order): ?>
        <h2 class="text-center mb-4">Order Confirmation</h2>
        <div class="card shadow-sm mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <h5 class="card-title mb-3">Order #<?= htmlspecialchars($order['id']) ?></h5>
                <p><strong>Order Type:</strong> <?= htmlspecialchars(ucfirst($order['order_type'])) ?></p>

                <?php if ($order['order_type'] === 'delivery'): ?>
                    <p><strong>Recipient:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                <?php elseif ($order['order_type'] === 'pickup'): ?>
                    <div>
                        <p class="fw-bold mb-0">Your order is ready for pickup!</p>
                        <p class="mb-0">Please show your order number at the counter to retrieve your items.</p>
                        <p class="mt-2 mb-0">
                            <strong>Pickup Location:</strong> 123 Main Street, Anytown, Philippines
                        </p>
                    </div>
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