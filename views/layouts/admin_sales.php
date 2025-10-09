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
$monthlySales  = $data['monthlySales'];
$year          = $data['year'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Analytics Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background-color: #FFF6EB;
      font-family: Arial, sans-serif;
      background: url('<?php echo FILE_ROOT; ?>/public/assets/images/background-2.png') no-repeat top center / cover;
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
    .sidebar a:hover, .active {
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
  <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-2 sidebar">
        <a href="admin">Dashboard</a>
        <a href="stocks">Stocks</a>
        <a href="sales" class="active">Sales</a>
        <a href="orders">Orders</a>
        <a href="archived_products">Archived Products</a>
      </div>

      <!-- Main Content -->
      <div class="col-10 p-4">
        <h4>SALES ANALYTICS DASHBOARD</h4>
        <p>Track your coffee shop’s sales performance and trends</p>

        <!-- Summary Cards -->
        <div class="row g-3">
          <div class="col-md-3">
            <div class="card-box shadow-sm">
              <h6>Today's Revenue</h6>
              <h5>₱<?= number_format($todayRevenue, 2) ?></h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-box shadow-sm">
              <h6>Average Order</h6>
              <h5>₱<?= number_format($avgOrder, 2) ?></h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-box shadow-sm">
              <h6>This Week</h6>
              <h5>₱<?= number_format($weekRevenue, 2) ?></h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card-box shadow-sm">
              <h6>Growth Rate</h6>
              <h5><?= number_format($growthRate, 2) ?>%</h5>
            </div>
          </div>
        </div>

        <!-- Daily Sales Table -->
        <div class="mt-4">
          <h6><i class="bi bi-calendar-week me-2"></i>Daily Sales This Week</h6>
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr><th>Date</th><th>Revenue (₱)</th></tr>
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

        <!-- Sales by Category -->
        <div class="mt-5">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
              <h6 class="mb-0"><i class="bi bi-pie-chart-fill me-2"></i>Sales by Category</h6>
            </div>
            <div class="card-body">
              <?php 
                $totalSales = array_sum(array_column($categorySales, 'total')); 
                if ($totalSales > 0):
                  foreach ($categorySales as $cat): 
                    $percent = ($cat['total'] / $totalSales) * 100;
              ?>
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="fw-semibold"><?= ucfirst($cat['order_type']) ?></span>
                  <span>₱<?= number_format($cat['total'], 2) ?> (<?= number_format($percent, 2) ?>%)</span>
                </div>
                <div class="progress mb-3" style="height: 18px;">
                  <div class="progress-bar progress-bar-striped" role="progressbar" 
                      style="width: <?= $percent ?>%; background-color: #D48423;"
                      aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100">
                    <?= number_format($percent, 1) ?>%
                  </div>
                </div>
              <?php endforeach; else: ?>
                <p class="text-muted mb-0">No sales by category yet.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Monthly Sales Graph -->
        <div class="mt-5">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
              <h6 class="mb-0"><i class="bi bi-bar-chart-fill me-2"></i>Monthly Sales (<?= $year ?>)</h6>
              <form method="GET" class="d-inline">
                <select name="year" onchange="this.form.submit()" class="form-select form-select-sm w-auto d-inline">
                  <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                    <option value="<?= $y ?>" <?= $year == $y ? 'selected' : '' ?>><?= $y ?></option>
                  <?php endfor; ?>
                </select>
              </form>
            </div>
            <div class="card-body">
              <canvas id="monthlySalesChart" height="120"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Chart.js Script -->
  <script>
    const monthlyLabels = <?= json_encode(array_column($monthlySales, 'month')) ?>;
    const monthlyData = <?= json_encode(array_column($monthlySales, 'revenue')) ?>;

    new Chart(document.getElementById('monthlySalesChart'), {
      type: 'bar',
      data: {
        labels: monthlyLabels,
        datasets: [{
          label: 'Revenue (₱)',
          data: monthlyData,
          backgroundColor: '#D48423',
          borderColor: '#A35D21',
          borderWidth: 1,
          borderRadius: 5
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { 
            beginAtZero: true,
            title: { display: true, text: 'Revenue (₱)' } 
          },
          x: { 
            title: { display: true, text: 'Month' } 
          }
        },
        plugins: { 
          legend: { display: false } 
        }
      }
    });
  </script>
</body>
</html>
