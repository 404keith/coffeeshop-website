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
    }
    .sidebar { background: #281A11; min-height: 100vh; padding-top: 20px; color: #fff; }
        .sidebar a { color: #D48423; text-decoration: none; display: block; padding: 12px; }
        .sidebar a:hover, .active{ background: rgba(145, 106, 83, 0.4); }
    .card-box {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      background: #fff;
      height: 100px;
    }
    
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-2 sidebar">
        <h5 class="text-center mb-4">Monday Mornings</h5>
        <a href="admin">Dashboard</a>
        <a href="stocks">Stocks</a>
        <a href="sales" class="active">Sales</a>
        <a href="orders">Orders</a>
      </div>

      <!-- Main Content -->
      <div class="col-10 p-4">
        <h4>SALES OVERVIEW</h4>
        <p>Track your coffee shop’s sales performance and analytics</p>
        <div class="row g-3">
          <div class="col-md-3"><div class="card-box">Today's Revenue</div></div>
          <div class="col-md-3"><div class="card-box">Average Order</div></div>
          <div class="col-md-3"><div class="card-box">This Week</div></div>
          <div class="col-md-3"><div class="card-box">Growth Rate</div></div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mt-4">
          <li class="nav-item"><a class="nav-link active" href="#">Daily Sales</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Weekly Sales</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Monthly Sales</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Top Products</a></li>
        </ul>

        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card-box" style="height:300px;">
              <h6>Daily Sales This Week</h6>
              <canvas id="salesChart"></canvas>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card-box" style="height:300px;">
              <h6>Sales by Category</h6>
              <canvas id="categoryChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Bar Chart
    new Chart(document.getElementById("salesChart"), {
      type: "bar",
      data: {
        labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
        datasets: [{
          label: "Revenue",
          data: [1200, 1500, 1600, 1800, 2200, 2600, 2400],
          backgroundColor: "#A0522D"
        }]
      }
    });

    // Pie Chart
    new Chart(document.getElementById("categoryChart"), {
      type: "pie",
      data: {
        labels: ["Coffee", "Pastries", "Sandwiches", "Cold Drinks"],
        datasets: [{
          data: [65, 20, 10, 5],
          backgroundColor: ["#A0522D", "#D2691E", "#C0A060", "#E0B050"]
        }]
      }
    });
  </script>
</body>
</html>
