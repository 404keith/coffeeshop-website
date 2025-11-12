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

$chartLabels = $data['chartLabels'];
$chartData   = $data['chartData'];
$chart_title = $data['chart_title'];

$year  = $data['year'];
$month = $data['month'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Analytics Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #FFF6EB;
      font-family: 'Poppins', sans-serif;
      background: url('<?php echo FILE_ROOT; ?>/public/assets/images/background-2.png') no-repeat top center / cover;
      background-attachment: fixed;
    }

    /* Sidebar */
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

    /* Creative Stat Card */
    .card-box {
        padding: 20px 24px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(40, 26, 17, 0.1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        min-height: 120px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }
    .card-box-icon {
        font-size: 2.5rem;
        margin-right: 1.25rem;
        line-height: 1;
        width: 40px;
        color: #D48423;
    }
    .card-box .h5 {
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 0;
        color: #281A11;
    }
    .card-box .h6 {
        font-weight: 600;
        color: #555;
        margin-bottom: 0;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .ui-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .ui-card .card-header {
        background-color: #281A11;
        color: white;
        border-bottom: 0;
        font-weight: 600;
        padding: 1rem 1.5rem;
    }
    
    .table-custom thead th {
        background-color: #281A11 !important;
        color: white;
        border-bottom-width: 0;
    }
    .table-custom {
      vertical-align: middle;
    }

    .form-select-themed {
        background-color: rgba(255,255,255,0.2);
        color: white;
        border-color: rgba(255,255,255,0.3);
        width: auto;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    }
    .form-select-themed option {
        color: #000; /* Para makita ang options kapag binuksan */
    }
  </style>
</head>

<body>
  <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 sidebar">
      <a href="admin" ><i class="fas fa-house"></i>Dashboard</a>
      <a href="stocks"><i class="fas fa-box"></i>Stocks</a>
      <a href="sales" class="active"><i class="fas fa-chart-line"></i>Sales</a>
      <a href="orders"><i class="fas fa-cart-shopping"></i>Orders</a>
      <a href="archived_products"><i class="fas fa-archive"></i>Archived</a>
    </div>

      <div class="col-10 p-4">
        <h4 class="fw-bold">SALES ANALYTICS DASHBOARD</h4>
        <p class="text-muted">Track your coffee shop’s sales performance and trends</p>

        <div class="row g-4 mb-3">
          <div class="col-xl-3 col-md-6">
            <div class="card-box">
              <i class="fas fa-dollar-sign card-box-icon"></i>
              <div>
                <h6 class="h6">Today's Revenue</h6>
                <h5 class="h5">₱<?= number_format($todayRevenue, 2) ?></h5>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card-box">
              <i class="fas fa-receipt card-box-icon"></i>
              <div>
                <h6 class="h6">Average Order</h6>
                <h5 class="h5">₱<?= number_format($avgOrder, 2) ?></h5>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card-box">
              <i class="fas fa-calendar-week card-box-icon"></i>
              <div>
                <h6 class="h6">This Week</h6>
                <h5 class="h5">₱<?= number_format($weekRevenue, 2) ?></h5>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card-box">
              <i class="fas fa-chart-line card-box-icon"></i>
              <div>
                <h6 class="h6">Growth Rate</h6>
                <h5 class="h5 <?= $growthRate >= 0 ? 'text-success' : 'text-danger' ?>">
                    <?= $growthRate >= 0 ? '+' : '' ?><?= number_format($growthRate, 2) ?>%
                </h5>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="ui-card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i><?= htmlspecialchars($chart_title) ?></h6>
                
                <form method="GET" class="d-flex align-items-center" id="salesFilterForm">
                  
                  <select name="month" class="form-select form-select-sm form-select-themed me-2" onchange="document.getElementById('salesFilterForm').submit();">
                    <option value="all" <?= ($month == 'all' || empty($month)) ? 'selected' : '' ?>>All Months</option>
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                      <option value="<?= $m ?>" <?= ($month == $m) ? 'selected' : '' ?>>
                        <?= date('F', mktime(0,0,0, $m, 1)) ?>
                      </option>
                    <?php endfor; ?>
                  </select>

                  <select name="year" class="form-select form-select-sm form-select-themed" onchange="document.getElementById('salesFilterForm').submit();">
                    <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                      <option value="<?= $y ?>" <?= $year == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                  </select>
                </form>
              </div>
              <div class="card-body">
                <?php if (empty($chartData)): ?>
                  <p class="text-center text-muted p-5">No sales data found for this period.</p>
                <?php else: ?>
                  <canvas id="mainSalesChart" height="400"></canvas>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-7">
            <div class="ui-card h-100">
              <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Sales by Order Type</h6>
              </div>
              <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 350px;">
                <?php if (!empty($categorySales) && array_sum(array_column($categorySales, 'total')) > 0): ?>
                  <canvas id="categorySalesChart" style="max-height: 300px;"></canvas>
                <?php else: ?>
                  <p class="text-muted mb-0">No sales data by type yet.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="ui-card h-100">
              <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Daily Sales This Week</h6>
              </div>
              <div class="card-body p-0">
                <table class="table table-hover table-custom mb-0">
                  <thead>
                    <tr>
                      <th class="ps-3">Date</th>
                      <th>Revenue (₱)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($dailySales)): ?>
                      <?php foreach ($dailySales as $row): ?>
                        <tr>
                          <td class="ps-3"><?= htmlspecialchars($row['day']) ?></td>
                          <td><?= number_format($row['revenue'], 2) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr><td colspan="2" class="text-center p-3">No sales this week</td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    // --- Dynamic Main Sales Chart (Monthly/Daily) ---
    <?php if (!empty($chartData)): ?>
      const chartLabels = <?= json_encode($chartLabels) ?>;
      const chartData = <?= json_encode($chartData) ?>;

      new Chart(document.getElementById('mainSalesChart'), {
        type: 'bar',
        data: {
          labels: chartLabels,
          datasets: [{
            label: 'Revenue (₱)',
            data: chartData,
            backgroundColor: '#D48423',
            borderColor: '#A35D21',
            borderWidth: 1,
            borderRadius: 5
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false, 
          scales: {
            y: { 
              beginAtZero: true,
              ticks: {
                  callback: function(value) { return '₱' + new Intl.NumberFormat().format(value); }
              }
            },
            x: { 
              grid: { display: false }
            }
          },
          plugins: { 
            legend: { display: false },
            tooltip: {
              callbacks: {
                  label: function(context) {
                      return ` Revenue: ₱${new Intl.NumberFormat().format(context.parsed.y)}`;
                  }
              }
            }
          }
        }
      });
    <?php endif; ?>

    // --- Category Donut Chart (Order Type) ---
    <?php if (!empty($categorySales) && array_sum(array_column($categorySales, 'total')) > 0): ?>
      const orderTypeLabels = <?= json_encode(array_column($categorySales, 'order_type')) ?>;
      const orderTypeData = <?= json_encode(array_column($categorySales, 'total')) ?>;

      new Chart(document.getElementById('categorySalesChart'), {
        type: 'doughnut',
        data: {
          labels: orderTypeLabels.map(label => label.charAt(0).toUpperCase() + label.slice(1)), 
          datasets: [{
            label: 'Total Sales',
            data: orderTypeData,
            backgroundColor: [
              '#D48423', // Theme Orange
              '#A35D21', // Theme Dark Orange
              '#281A11', // Theme Dark Brown
              '#E8A04D'  // Theme Light Orange
            ],
            borderColor: '#fff',
            borderWidth: 3
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  let label = context.label || '';
                  let value = context.raw || 0;
                  return ` ${label}: ₱${new Intl.NumberFormat('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(value)}`;
                }
              }
            }
          }
        }
      });
    <?php endif; ?>
  </script>
</body>
</html>