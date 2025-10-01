<?php
if (!isset($order) || !isset($orderItems) || !isset($error_message)) {
    $error_message = $error_message ?? 'View variables not initialized.';
    $order = $order ?? null;
}
?>

<?php include APP_ROOT . '/views/layouts/header.php'; ?>

<body class="d-flex flex-column min-vh-100" style="height:80rem">
    <main class="flex-fill">
        <div class="container my-5">
            <?php if ($error_message): ?>
                <div class="alert alert-danger shadow-sm mx-auto" style="max-width: 800px;">
                    <?= htmlspecialchars($error_message) ?>
                </div>
                <div class="text-center mt-4">
                    <a href="<?= FILE_ROOT ?>/my-orders" class="btn btn-secondary">Back to My Orders</a>
                </div>
            <?php elseif ($order): ?>
                <h2 class="text-center mb-4">Order Details</h2>
                <div class="card shadow-lg mx-auto border-0" style="max-width: 800px;">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                            <h5 class="card-title mb-0 fw-bold">Order #<?= htmlspecialchars($order['id']) ?></h5>
                            <small class="text-muted">Status: <span
                                    class="badge bg-primary fs-6"><?= htmlspecialchars(ucfirst($order['status'] ?? 'pending')) ?></span></small>
                        </div>

                        <p><strong>Order Date:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
                        <p><strong>Order Type:</strong> <?= htmlspecialchars(ucfirst($order['order_type'])) ?></p>

                        <!-- Delivery/Pickup Info -->
                        <?php if ($order['order_type'] === 'delivery'): ?>
                            <hr>
                            <h6>Delivery Information</h6>
                            <p class="mb-1"><strong>Recipient:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
                            <p class="mb-1"><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                            <p class="mb-1"><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                            <hr>
                        <?php else: ?>
                            <p><strong>Name:</strong> <?= htmlspecialchars($fullName) ?></p>
                            <p class="mt-2 mb-0">
                                <strong>Pickup Location:</strong> "Coffee by Monday Mornings" Unit 3, 853 M. Naval St, Navotas
                            </p>
                            <hr>
                        <?php endif; ?>

                        <h6>Items Ordered:</h6>
                        <ul class="list-group mb-4 shadow-sm border">
                            <?php if (empty($orderItems)): ?>
                                <li class="list-group-item text-center text-muted">No items found for this order.</li>
                            <?php else: ?>
                                <?php foreach ($orderItems as $item): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-medium"><?= htmlspecialchars($item['name']) ?></span>
                                            <span class="text-muted">(x<?= $item['quantity'] ?>)</span>

                                            <?php
                                            $options_display = !empty($item['options']) ? htmlspecialchars($item['options']) : '';
                                            if ($options_display): ?>
                                                <small class="text-secondary d-block ms-3 fst-italic">Options:
                                                    <?= $options_display ?></small>
                                            <?php endif; ?>
                                        </div>
                                        <span class="fw-bold">P <?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <li
                                class="list-group-item d-flex justify-content-between fw-bold bg-light text-primary fs-5 py-3">
                                <span>Order Total</span>
                                <span>P <?= number_format($order['total'], 2) ?></span>
                            </li>
                        </ul>

                        <a href="<?= FILE_ROOT ?>/my-orders" class="btn btn-secondary w-100">Back to My Orders</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>