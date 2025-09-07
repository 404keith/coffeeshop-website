<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Management - Coffee by Monday Mornings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #FFF6EB;
      font-family: Arial, sans-serif;
    }
    .sidebar {
      background-color: #4A2C2A;
      height: 100vh;
      color: #fff;
      padding-top: 20px;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 12px 20px;
      margin-bottom: 5px;
    }
    .sidebar a:hover, .active {
      background-color: #6B3E3A;
      border-radius: 5px;
    }
    .card-box {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      background: #fff;
      height: 100px;
    }
    footer {
      background-color: #4A2C2A;
      color: white;
      text-align: center;
      padding: 15px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-2 sidebar">
        <h5 class="text-center mb-4">Monday Mornings</h5>
        <a href="dashboard.html">Dashboard</a>
        <a href="stocks.html">Stocks</a>
        <a href="sales.html">Sales</a>
        <a href="orders.html" class="active">Orders</a>
      </div>

      <!-- Main Content -->
      <div class="col-10 p-4">
        <h4>ORDER MANAGEMENT</h4>
        <p>Track and manage customer orders in real-time</p>
        <div class="row g-3">
          <div class="col-md-3"><div class="card-box">Pending</div></div>
          <div class="col-md-3"><div class="card-box">Preparing</div></div>
          <div class="col-md-3"><div class="card-box">Ready</div></div>
          <div class="col-md-3"><div class="card-box">Completed</div></div>
        </div>

        <!-- Orders Table -->
        <div class="card mt-4">
          <div class="card-body">
            <h6>All Orders</h6>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Items</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Order Time</th>
                  <th>Payment</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#001</td>
                  <td>John Doe</td>
                  <td>2 Coffees</td>
                  <td>₱300</td>
                  <td><span class="badge bg-warning">Pending</span></td>
                  <td>10:15 AM</td>
                  <td>Cash</td>
                  <td><button class="btn btn-sm btn-primary">Update</button></td>
                </tr>
                <!-- More sample rows -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>© 2025 Coffee by Monday Mornings. All rights reserved.</p>
  </footer>
</body>
</html>
