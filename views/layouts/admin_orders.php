<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/adminOrderController.php';

$controller = new OrdersController($pdo);
$controller->handleRequest(); 

$orders = $controller->getAllOrders();
$counts = $controller->getStatusCounts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #FFF6EB; font-family: Arial, sans-serif; }
        .sidebar { background: #281A11; min-height: 100vh; padding-top: 20px; color: #fff; }
        .sidebar a { color: #D48423; text-decoration: none; display: block; padding: 12px; }
        .sidebar a:hover, .active { background: rgba(145,106,83,0.4); }
        .card-box { border: 1px solid #ddd; padding: 20px; border-radius: 8px; text-align: center; background: #fff; height: 100px; font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 sidebar">
            <a href="admin">Dashboard</a>
            <a href="stocks">Stocks</a>
            <a href="sales">Sales</a>
            <a href="orders" class="active">Orders</a>
        </div>

        <div class="col-10 p-4">
            <h4>ORDER MANAGEMENT</h4>
            <p>Track and manage customer orders in real-time</p>

            <div class="row g-3">
              <div class="col-md-3"><div class="card-box">Pending <br><?= $counts['pending'] ?></div></div>
              <div class="col-md-3"><div class="card-box">Processing <br><?= $counts['processing'] ?></div></div>
              <div class="col-md-3"><div class="card-box">Completed <br><?= $counts['completed'] ?></div></div>
              <div class="col-md-3"><div class="card-box">Cancelled <br><?= $counts['cancelled'] ?></div></div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h6>All Orders</h6>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Order Type</th>
                                <th>Status</th>
                                <th>Order Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="7" class="text-center">No orders found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($order->id) ?></td>
                                    <td><?= htmlspecialchars($order->full_name) ?></td>
                                    <td>₱<?= number_format($order->total, 2) ?></td>
                                    <td>
                                        <?php
                                        $typeBadgeClass = 'bg-secondary';
                                        if (strtolower($order->order_type) === 'deliver') $typeBadgeClass = 'bg-primary';
                                        if (strtolower($order->order_type) === 'pickup')  $typeBadgeClass = 'bg-info text-dark';
                                        ?>
                                        <span class="badge <?= $typeBadgeClass ?>">
                                            <?= htmlspecialchars(ucfirst($order->order_type)) ?>
                                        </span>
                                    </td>
                                    <td>
                                      <?php
                                        $status = trim(strtolower($order->status));
                                        $badgeClass = 'bg-secondary text-white'; 

                                        switch ($status) {
                                            case 'pending':    $badgeClass = 'bg-secondary text-white'; break;
                                            case 'processing': $badgeClass = 'bg-warning text-dark'; break;
                                            case 'completed':  $badgeClass = 'bg-success text-white'; break;
                                            case 'cancelled':  $badgeClass = 'bg-danger text-white'; break;
                                        }
                                      ?>
                                      <span class="badge <?= $badgeClass ?>">
                                          <?= ucfirst($status) ?>
                                      </span>
                                    </td>
                                  <td><?= date("M d, Y H:i", strtotime($order->created_at)) ?></td>
                                  <td>
                                      <form method="post" class="d-flex">
                                          <input type="hidden" name="order_id" value="<?= $order->id ?>">
                                            <select name="status" class="form-select form-select-sm me-2">
                                              <option value="pending"   <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                              <option value="processing"<?= $status === 'processing' ? 'selected' : '' ?>>Processing</option>
                                              <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                                              <option value="cancelled" <?= $status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                            </select> 
                                          <button type="submit" name="update_order" class="btn btn-sm btn-primary">Update</button>
                                      </form>
                                  </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
