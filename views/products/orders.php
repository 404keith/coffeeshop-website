<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/orderModel.php';

// Redirect user if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}

$userId = $_SESSION['user_id'];
$orders = [];
$error_message = '';

try {
    // Fetch all orders for the logged-in user
    $orders = getOrdersByUserId($pdo, (int) $userId);
    // Sort orders to show the latest first
    $orders = array_reverse($orders);

} catch (PDOException $e) {
    // Log database errors and set a user-friendly error message
    error_log("Error fetching user orders: " . $e->getMessage());
    $error_message = 'An error occurred while retrieving your orders. Please try again later.';
}


// --- FILTERING LOGIC ---
$current_status = isset($_GET['status']) && in_array($_GET['status'], ['pending', 'completed', 'cancelled']) ? $_GET['status'] : 'all';

$filtered_orders = [];
if ($current_status !== 'all') {
    foreach ($orders as $order) {
        if ($order['status'] === $current_status) {
            $filtered_orders[] = $order;
        }
    }
} else {
    $filtered_orders = $orders;
}
// --- END FILTERING LOGIC ---


// --- PAGINATION LOGIC  ---
$orders_per_page = 5;
$total_orders = count($filtered_orders); // CORRECT: Use filtered orders for total count
$total_pages = ceil($total_orders / $orders_per_page);

$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

$offset = ($current_page - 1) * $orders_per_page;
$paginated_orders = array_slice($filtered_orders, $offset, $orders_per_page); // CORRECT: Slice the filtered array

$pagination_base_url = '?';
if ($current_status !== 'all') {
    $pagination_base_url .= 'status=' . htmlspecialchars($current_status) . '&';
}
// --- END PAGINATION LOGIC ---


include APP_ROOT . '/views/layouts/header.php';
?>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container my-5">
            <div class="card shadow-lg border-0 rounded-3 p-4 p-md-5 mx-auto" style="max-width: 800px;">
                <h2 class="text-center mb-4 fw-bold">My Orders</h2>

                <!-- Filter Buttons -->
                <div class="text-center mb-4">
                    <a href="?status=all"
                        class="btn btn-outline-primary <?= $current_status === 'all' ? 'active' : '' ?>">All</a>
                    <a href="?status=pending"
                        class="btn btn-outline-primary <?= $current_status === 'pending' ? 'active' : '' ?>">Pending</a>
                    <a href="?status=completed"
                        class="btn btn-outline-primary <?= $current_status === 'completed' ? 'active' : '' ?>">Completed</a>
                    <a href="?status=cancelled"
                        class="btn btn-outline-primary <?= $current_status === 'cancelled' ? 'active' : '' ?>">Cancelled</a>
                </div>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php elseif (empty($orders)): ?>
                    <div class="alert alert-info text-center py-4">
                        You have no orders yet.
                        <br>
                        <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3"
                            style="background-color: var(--bs-primary); border-color: var(--bs-primary);">Shop Now</a>
                    </div>
                <?php elseif (empty($filtered_orders)): ?>
                    <div class="alert alert-info text-center py-4">
                        No "<?= htmlspecialchars($current_status) ?>" orders found.
                    </div>
                <?php else: ?>
                    <div class="list-group mb-4">
                        <?php foreach ($paginated_orders as $order): ?>
                            <div class="list-group-item list-group-item-action mb-3 rounded-3 shadow-sm p-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h5 class="mb-1 fw-bold">Order #<?= htmlspecialchars($order['id']) ?></h5>
                                    <span class="badge rounded-pill fs-6 px-3 py-2 fw-normal"
                                        style="background-color: var(--bs-primary);">
                                        <?= htmlspecialchars(ucfirst($order['status'])) ?>
                                    </span>
                                </div>
                                <hr class="my-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong>Date:</strong>
                                            <?= date('F j, Y', strtotime($order['created_at'])) ?></p>
                                        <p class="mb-1"><strong>Type:</strong>
                                            <?= htmlspecialchars(ucfirst($order['order_type'])) ?></p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <p class="mb-1"><strong>Total:</strong> ₱<?= number_format($order['total'], 2) ?></p>
                                    </div>
                                </div>
                                <div class="text-end mt-2">
                                    <a href="<?= FILE_ROOT ?>/order-details?order_id=<?= htmlspecialchars($order['id']) ?>"
                                        class="btn btn-outline-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($total_pages > 1): ?>
                        <nav aria-label="Order pages">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link btn-outline-primary"
                                        href="<?= $pagination_base_url ?>page=<?= $current_page - 1 ?>">Previous</a>
                                </li>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                        <a class="page-link btn-outline-primary"
                                            href="<?= $pagination_base_url ?>page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                                    <a class="page-link btn-outline-primary"
                                        href="<?= $pagination_base_url ?>page=<?= $current_page + 1 ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>


<?php include APP_ROOT . '/views/layouts/footer.php'; ?>