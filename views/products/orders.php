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
} catch (PDOException $e) {
    // Log database errors and set a user-friendly error message
    error_log("Error fetching user orders: " . $e->getMessage());
    $error_message = 'An error occurred while retrieving your orders. Please try again later.';
}

// --- PAGINATION LOGIC ---
$orders_per_page = 5;
$total_orders = count($orders);
$total_pages = ceil($total_orders / $orders_per_page);

// Get the current page number from the URL, default to 1
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Calculate the offset for the array slice
$offset = ($current_page - 1) * $orders_per_page;

// Get the subset of orders for the current page
$paginated_orders = array_slice($orders, $offset, $orders_per_page);
// --- END PAGINATION LOGIC ---

include APP_ROOT . '/views/layouts/header.php';
?>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container my-5">
            <div class="card shadow-lg border-0 rounded-3 p-4 p-md-5 mx-auto" style="max-width: 800px;">
                <h2 class="text-center mb-4 fw-bold">My Orders</h2>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error_message) ?>
                    </div>
                <?php elseif (empty($orders)): ?>
                    <div class="alert alert-info text-center py-4">
                        You have no orders yet.
                        <br>
                        <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3">Shop Now</a>
                    </div>
                <?php else: ?>
                    <!-- Display the list of orders for the current page -->
                    <div class="list-group mb-4">
                        <?php foreach ($paginated_orders as $order): ?>
                            <div class="list-group-item list-group-item-action mb-3 rounded-3 shadow-sm p-3">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h5 class="mb-1 fw-bold">Order #<?= htmlspecialchars($order['id']) ?></h5>
                                    <span class="badge bg-primary rounded-pill fs-6 px-3 py-2">
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

                    <!-- Pagination Navigation -->
                    <?php if ($total_pages > 1): ?>
                        <nav aria-label="Order pages">
                            <ul class="pagination justify-content-center">
                                <!-- Previous Page Link -->
                                <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link btn-outline-primary" href="?page=<?= $current_page - 1 ?>">Previous</a>
                                </li>

                                <!-- Page Number Links -->
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                        <a class="page-link btn-outline-primary"" href=" ?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>

                        <!-- Next Page Link -->
                        <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                                    <a class="page-link btn-outline-primary"" href=" ?page=<?= $current_page + 1 ?>">Next</a>
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