<?php
include APP_ROOT . '/views/layouts/header.php';

$success_message = '';
if (isset($_SESSION['order_success'])) {
    $success_message = $_SESSION['order_success'];
    unset($_SESSION['order_success']);
}

$orderTimestamp = strtotime($order['created_at']);
$orderDate = date('F j, Y', $orderTimestamp); // date
$orderTime = date('g:i A', $orderTimestamp); // time
?>


<div class="container mt-5">
    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php elseif ($order): ?>

        <?php if ($success_message): ?>
            <div class="alert bg-primary text-white text-center shadow-lg mb-5 mx-auto p-4 rounded-3" style="max-width: 800px;">
                <h4 class="alert-heading fw-bold"><i class="bi bi-check-circle-fill me-2"></i>Order Placed Successfully!</h4>
                <p class="mb-0"><?= htmlspecialchars($success_message) ?></p>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <h2 class="text-center mb-4">Order Confirmation</h2>

                <h5 class="card-title mb-3">Order #<?= htmlspecialchars($order['id']) ?></h5>
                <p><strong>Order Type:</strong> <?= htmlspecialchars(ucfirst($order['order_type'])) ?></p>

                <?php if ($order['order_type'] === 'delivery'): ?>
                    <p><strong>Recipient:</strong> <?= htmlspecialchars($order['full_name']) ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                <?php elseif ($order['order_type'] === 'pickup'): ?>

                    <div class="mt-3 mb-3 p-3 border rounded-3 bg-light">
                        <p class="fw-bold mb-1">Your order is confirmed and will be ready soon!</p>
                        <p class="mb-0">Please show your order number at the counter to retrieve your items.</p>
                        <p class="mt-2 mb-0">
                            <strong>Pickup Location:</strong> Coffee by Monday Mornings" Unit 3, 853 M. Naval St, Navotas
                        </p>
                    </div>
                <?php endif; ?>

                <p><strong>Order Date:</strong> <?= htmlspecialchars($orderDate) ?> | <?= htmlspecialchars($orderTime) ?>
                </p>

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