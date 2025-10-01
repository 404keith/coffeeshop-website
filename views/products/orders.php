<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/orderModel.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}

$userId = $_SESSION['user_id'];
$orders = [];
$error_message = '';

try {
    $orders = getOrdersByUserId($pdo, (int) $userId);
} catch (PDOException $e) {
    error_log("Error fetching user orders: " . $e->getMessage());
    $error_message = 'An error occurred while retrieving your orders. Please try again later.';
}

include APP_ROOT . '/views/layouts/header.php';

?>


<body class="d-flex flex-column min-vh-100" style="height:80rem">
    <main class="flex-fill">
        <div class="container my-5 px-5 custom-spacing">
            <div class="card shadow-sm px-5 py-4 custom-spacing">
                <h2 class="text-center mb-4">My Orders</h2>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php elseif (!is_array($orders) || empty($orders)): ?>
                    <div class="alert alert-info text-center py-4 px-5">
                        You have no orders yet.
                        <br>
                        <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3">Buy Now</a>
                    </div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($orders as $order): ?>
                            <div class="list-group-item list-group-item-action mb-3 rounded-2 shadow-sm px-4 py-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 fw-bold">Order
                                        #<?= htmlspecialchars($order['id']) ?></h5>
                                    <small class="text-muted">Status: <span                
                                            class="badge bg-primary px-3 py-2"><?= htmlspecialchars(ucfirst($order['status'])) ?></span></small>
                                </div>
                                <p class="mb-2 mt-2">
                                    <strong>Order Date:</strong>
                                    <?= htmlspecialchars($order['created_at']) ?>
                                </p>
                                <p class="mb-2">
                                    <strong>Order Type:</strong>
                                    <?= htmlspecialchars(ucfirst($order['order_type'])) ?>
                                </p>
                                <p class="mb-3">
                                    <strong>Total:</strong> P
                                    <?= number_format($order['total'], 2) ?>
                                </p>
                                <a href="<?= FILE_ROOT ?>/order-details?order_id=<?= htmlspecialchars($order['id']) ?>"        
                                    class="btn btn-outline-primary btn-sm mt-2">View Details</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </main>

</body>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>