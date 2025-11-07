<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/stocksController.php';

$controller = new StockController($pdo);
$controller->handleRequest();
$archived = $controller->getArchived();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Products</title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fff6eb;
            font-family: 'Poppins', sans-serif;
            background: url('<?php echo FILE_ROOT; ?>/public/assets/images/background-2.png') no-repeat top center / cover;
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

        .ui-card {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            overflow: hidden;
        }
        .ui-card .card-header {
            background-color: #281A11; 
            color: white;
            border-bottom: 0;
            font-weight: 600;
            padding: 1rem 1.5rem;
        }
        .ui-card .card-body {
            padding: 1.5rem;
        }

        .table thead th {
            background-color: #281A11 !important; 
            color: white;
            border-bottom-width: 0;
        }
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid rgba(40, 26, 17, 0.1);
        }
        .image-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background-color: #f0f0ff;
            color: #aaa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
    <div class="col-md-2 sidebar">
      <a href="admin"><i class="fas fa-house"></i>Dashboard</a>
      <a href="stocks"><i class="fas fa-box"></i>Stocks</a>
      <a href="sales"><i class="fas fa-chart-line"></i>Sales</a>
      <a href="orders"><i class="fas fa-cart-shopping"></i>Orders</a>
      <a href="archived_products" class="active"><i class="fas fa-archive"></i>Archived</a>
    </div>

            <div class="col-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0"><i class="bi bi-archive-fill me-2"></i>Archived Products</h4>
                </div>

                <div class="ui-card">
                    <div class="card-header">
                        <i class="bi bi-list-ul me-2"></i>
                        Archived Item List
                    </div>
                    <div class="card-body p-0"> 
                        <p class="text-muted p-4 mb-0">These products are currently archived and hidden from your menu. Click restore to bring them back.</p>
                        
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th style="width: 150px;">Restore</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($archived)): ?>
                                        <?php foreach ($archived as $item): ?>
                                            <tr>
                                                <td class="ps-4"> <?php if (!empty($item['image'])): ?>
                                                        <img src="<?= FILE_ROOT . htmlspecialchars($item['image']) ?>" class="product-image">
                                                    <?php else: ?>
                                                        <div class="image-placeholder">
                                                            <i class="bi bi-image-alt"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><strong><?= htmlspecialchars($item["name"]) ?></strong></td>
                                                
                                                <td><?= htmlspecialchars($item["category_id"]) ?></td>
                                                
                                                <td><?= htmlspecialchars($item["stock"]) ?></td>
                                                <td>₱<?= number_format((float)$item["price"], 2) ?></td>
                                                <td class="pe-4"> <form method="post" action="archived_products" onsubmit="return confirmRestore()">
                                                        <input type="hidden" name="restore_id" value="<?= $item['id'] ?>">
                                                        <button type="submit" name="restore_product" class="btn btn-outline-success btn-sm">
                                                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                                                            Restore
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="6" class="text-center text-muted p-5">No archived products found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmRestore() {
            return confirm('Are you sure you want to restore this product?');
        }
    </script>
</body>
</html>