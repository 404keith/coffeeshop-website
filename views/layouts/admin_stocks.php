

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
    .table-light{
      border: 2px solid #000;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      background: #fff;
    }
    tr{
      border: 1px solid #000;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      background: #fff;
    }
    
  </style>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-2 sidebar">
      <h4 class="text-center">Admin Panel</h4>
      <a href="admin">Dashboard</a>
      <a href="stocks">Stocks</a>
      <a href="#">Sales</a>
      <a href="#">Orders</a>
    </div>


    <div class="col-md-10 content">
      <h3>Stock Management</h3>
      <p>Manage your inventory and track stock levels</p>
      <a href="#" class="btn btn-warning mb-3 float-end" >Add Product</a>
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Current Stock</th>
            <th>Min Stock</th>
            <th>Status</th>
            <th>Last Restocked</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($stocks as $item): ?>
          <tr>
            <td><?= $item["name"] ?></td>
            <td><?= $item["category"] ?></td>
            <td><?= $item["current"] ?></td>
            <td><?= $item["min"] ?></td>
            <td><?= $item["status"] ?></td>
            <td><?= $item["last"] ?></td>
            <td><a href="#" class="btn btn-sm btn-dark">✎ Edit</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


