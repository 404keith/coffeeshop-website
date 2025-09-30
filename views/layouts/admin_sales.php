<?php 
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/SalesController.php';

$controller = new SalesController($conn);
$data = $controller->index();

$todayRevenue  = $data['todayRevenue'];
$avgOrder      = $data['avgOrder'];
$weekRevenue   = $data['weekRevenue'];
$growthRate    = $data['growthRate'];
$dailySales    = $data['dailySales'];
$categorySales = $data['categorySales'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Overview - Coffee by Monday Mornings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #FFF6EB;
      font-family: Arial, sans-serif;
                  background-color: #FFF6EB;
            background:
                url('<?php echo FILE_ROOT; ?>/public/assets/images/background-2.png');
            background-repeat: no-repeat;
            background-position: top center;
            background-size: cover;
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

    .sidebar a:hover,
    .active {
      background: rgba(145, 106, 83, 0.4);
    }

    .card-box {
      border: 2px solid #000;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      background: #fff;
      height: 120px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-2 sidebar">
        <a href="admin">Dashboard</a>
        <a href="stocks">Stocks</a>
        <a href="sales" class="active">Sales</a>
        <a href="orders">Orders</a>
      </div>

      <div class="col-10 p-4">
        <h4>SALES OVERVIEW</h4>
        <p>Track your coffee shop’s sales performance and analytics</p>
        <div class="row g-3">
          <div class="col-md-3">
            <div class="card-box">
              <h6>Today's Revenue</h6>
              <h5>₱<?= number_format($todayRevenue, 2) ?></h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-box">
              <h6>Average Order</h6>
              <h5>₱<?= number_format($avgOrder, 2) ?></h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-box">
              <h6>This Week</h6>
              <h5>₱<?= number_format($weekRevenue, 2) ?></h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-box">
              <h6>Growth Rate</h6>
              <h5><?= number_format($growthRate, 2) ?>%</h5>
            </div>
          </div>
        </div>

        <!-- Daily Sales Table -->
        <div class="mt-4">
          <h6>Daily Sales This Week</h6>
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr>
                <th>Date</th>
                <th>Revenue (₱)</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($dailySales)): ?>
                <?php foreach ($dailySales as $row): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['day']) ?></td>
                    <td><?= number_format($row['revenue'], 2) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="2" class="text-center">No sales this week</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Sales by Category Graph-->
        <div class="mt-4">
          <h6>Sales by Category</h6>
          <?php 
            $totalSales = array_sum(array_column($categorySales, 'total')); 
            if ($totalSales > 0):
              foreach ($categorySales as $cat): 
                $percent = ($cat['total'] / $totalSales) * 100;
          ?>
            <p class="mb-1"><strong><?= ucfirst($cat['order_type']) ?></strong>: ₱<?= number_format($cat['total'], 2) ?> (<?= number_format($percent, 2) ?>%)</p>
            <div class="progress mb-3" style="height: 20px;">
              <div class="progress-bar bg-success" role="progressbar" 
                style="width: <?= $percent ?>%;" 
                aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100">
                <?= number_format($percent, 1) ?>%
              </div>
            </div>
          <?php endforeach; else: ?>
            <p>No sales by category yet</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
