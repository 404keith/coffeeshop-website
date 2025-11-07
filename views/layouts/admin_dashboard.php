<?php
// PHP block is unchanged
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
  body {
    background-color: #FFF6EB;
    font-family: 'Poppins', sans-serif; 
    background:
      url('<?php echo FILE_ROOT; ?>/public/assets/images/background-2.png');
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
    background-attachment: fixed; 
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
    display: flex; 
    align-items: center;
    padding: 12px 16px;
    font-weight: 500;
    border-radius: 8px;
    margin: 4px 8px;
  }
  .sidebar a:hover,
  .sidebar a.active {
    background: rgba(145, 106, 83, 0.4);
  }
  .sidebar a .fas {
    width: 20px;
    margin-right: 10px;
    font-size: 1.1rem;
    line-height: 1;
  }

  .content {
    padding: 25px;
  }

  .ui-card {
      border: 0;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(8px);
      overflow: hidden;
      margin-bottom: 20px;
      height: 100%; 

      transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
  }

  .ui-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
  }
  
  .ui-card-header {
      background-color: #281A11;
      color: white;
      border-bottom: 0;
      font-weight: 600;
      padding: 1rem 1.5rem;
  }

  .stat-card-body {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem; 
  }
  .stat-icon {
    font-size: 2.8rem;
    color: #D48423;
    opacity: 0.8;
  }
  .stat-text {
    text-align: right;
  }
  .stat-number {
    font-size: 2.2rem;
    font-weight: 700;
    color: #281A11;
  }
  .stat-label {
    font-size: 0.9rem;
    color: #555;
    text-transform: uppercase;
    font-weight: 600;
  }

  .table thead th {
    background-color: #281A11 !important;
    color: white;
    border-bottom-width: 0;
  }
  .table {
    margin-bottom: 0; 
  }
</style>

<?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-2 sidebar">
      <a href="admin" class="active"><i class="fas fa-house"></i>Dashboard</a>
      <a href="stocks"><i class="fas fa-box"></i>Stocks</a>
      <a href="sales"><i class="fas fa-chart-line"></i>Sales</a>
      <a href="orders"><i class="fas fa-cart-shopping"></i>Orders</a>
      <a href="archived_products"><i class="fas fa-archive"></i>Archived</a>
    </div>

    <div class="col-md-10 content">
      <div class="mb-4">
        <h3 class="fw-bold">Dashboard Overview</h3>
        <p class="text-muted">Welcome back! Here's what's happening at your coffee shop today.</p>
      </div>

      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="ui-card">
            <div class="stat-card-body">
              <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <div class="stat-text">
                <div class="stat-label">Total Sales</div>
                <div class="stat-number">₱<?= number_format($total_sales, 2) ?></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="ui-card">
            <div class="stat-card-body">
              <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <div class="stat-text">
                <div class="stat-label">Total Orders</div>
                <div class="stat-number"><?= $total_orders ?></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="ui-card">
            <div class="stat-card-body">
              <div class="stat-icon">
                <i class="fas fa-boxes-stacked"></i>
              </div>
              <div class="stat-text">
                <div class="stat-label">Low Stock</div>
                <div class="stat-number"><?= $low_stock ?></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6">
          <div class="ui-card">
            <div class="stat-card-body">
              <div class="stat-icon">
                <i class="fas fa-shipping-fast"></i>
              </div>
              <div class="stat-text">
                <div class="stat-label">Active Orders</div>
                <div class="stat-number"><?= $active_orders ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-lg-7">
          <div class="ui-card">
            <div class="ui-card-header">
              <h5 class="mb-0">Recent Orders</h5>
            </div>
            <div class="card-body p-0">
              <table class="table table-hover">
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
                      <td class="ps-3"><?= $order['id'] ?></td>
                      <td><?= htmlspecialchars($order['full_name']) ?></td>
                      <td>₱<?= number_format($order['total'], 2) ?></td>
                      <td>
                        <?php
                          $status = trim(strtolower($order['status']));
                          $badgeClass = 'bg-secondary text-white'; // Default
                          switch ($status) {
                              case 'pending':    $badgeClass = 'bg-secondary text-white'; break;
                              case 'processing': $badgeClass = 'bg-warning text-dark'; break;
                              case 'completed':  $badgeClass = 'bg-success text-white'; break;
                              case 'cancelled':  $badgeClass = 'bg-danger text-white'; break;
                          }
                        ?>
                        <span class="badge rounded-pill <?= $badgeClass ?>">
                          <?= ucfirst($status) ?>
                        </span>
                      </td>
                      <td class="pe-3"><?= date("M d, Y H:i", strtotime($order['created_at'])) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="ui-card">
            <div class="ui-card-header">
              <h5 class="mb-0">Low Stock Alerts</h5>
            </div>
            <div class="card-body p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Stock Left</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($low_stock_list as $product): ?>
                    <tr>
                      <td class="ps-3"><?= htmlspecialchars($product['name']) ?></td>
                      <td class="pe-3">
                        <span class="badge rounded-pill bg-danger"><?= $product['stock'] ?></span>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>