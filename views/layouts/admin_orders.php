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
  <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>
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
          <div class="col-md-3">
            <div class="card-box">Pending</div>
          </div>
          <div class="col-md-3">
            <div class="card-box">Preparing</div>
          </div>
          <div class="col-md-3">
            <div class="card-box">Ready</div>
          </div>
          <div class="col-md-3">
            <div class="card-box">Completed</div>
          </div>
        </div>

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
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>