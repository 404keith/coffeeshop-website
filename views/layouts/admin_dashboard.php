<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/DashboardController.php';

$controller = new DashboardController($conn);
$data = $controller->index();

$total_sales   = $data['total_sales'];
$total_orders  = $data['total_orders'];
$low_stock     = $data['low_stock'];
$active_orders = $data['active_orders'];
$recent_orders = $data['recent_orders'];
$low_stock_list = $data['low_stock_list'];

?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
  body {
    background-color: #fff6eb;
  }

  .sidebar {
    background: #281A11;
    min-height: 100vh;
    padding-top: 20px;
    color: #fff;
  }

  .sidebar a {
    color: #D48423;
    text-decoration: none;
    display: block;
    padding: 12px;
  }

  .sidebar a:hover {
    background: rgba(145, 106, 83, 0.4);
  }

  .content {
    padding: 20px;
  }

  .card-custom {
    border: 2px solid #000;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    background: #fff;
  }
</style>
<?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>
<div class="container-fluid">
  <div class="row">

    <div class="col-md-2 sidebar">
      <i class="fas fa-house"></i><a href="admin">Dashboard</a>
      <i class="fas fa-box"></i><a href="stocks">Stocks</a>
      <i class="fas fa-chart-line"></i><a href="sales">Sales</a>
      <i class="fas fa-cart-shopping"></i><a href="orders">Orders</a>
    </div>


    <div class="col-md-10 content">
      <h3>Dashboard Overview</h3>
      <p>Welcome back! Here's what's happening at your coffee shop today.</p>
      <div class="row">
        <div class="col-md-3">
          <div class="card-custom">Total Sales: <?= $total_sales ?></div>
        </div>
        <div class="col-md-3">
          <div class="card-custom">Total Orders: <?= $total_orders ?></div>
        </div>
        <div class="col-md-3">
          <div class="card-custom">Low Stock Products: <?= $low_stock ?></div>
        </div>
        <div class="col-md-3">
          <div class="card-custom">Active Orders: <?= $active_orders ?></div>
        </div>
      </div>

<div class="row">
  <div class="col-md-6">
    <div class="card-custom">
      <h5>Recent Orders</h5>
      <table class="table table-sm">
        <thead>
          <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recent_orders as $order): ?>
            <tr>
              <td><?= $order['id'] ?></td>
              <td><?= htmlspecialchars($order['full_name']) ?></td>
              <td>₱<?= number_format($order['total'], 2) ?></td>
              <td><?= ucfirst($order['status']) ?></td>
              <td><?= date("M d, Y H:i", strtotime($order['created_at'])) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card-custom">
      <h5>Low Stock Alerts</h5>
      <table class="table table-sm">
        <thead>
          <tr>
            <th>Product</th>
            <th>Stock</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($low_stock_list as $product): ?>
            <tr>
              <td><?= htmlspecialchars($product['name']) ?></td>
              <td><?= $product['stock'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>