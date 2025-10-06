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
    <style>
        body {
            background-color: #fff6eb;
            font-family: 'Inter', sans-serif;
        }
        .sidebar { background: #281A11; min-height: 100vh; padding-top: 20px; color: #fff; }
        .sidebar a { color: #D48423; text-decoration: none; display: block; padding: 12px; }
        .sidebar a:hover, .active { background: rgba(145,106,83,0.4); }

        img {
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <a href="admin">Dashboard</a>
                <a href="stocks">Stocks</a>
                <a href="sales">Sales</a>
                <a href="orders">Orders</a>
                <a href="archived_products" class="active"> Archived Products</a>

            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Archived Products</h3>
                </div>

                <p>These products are currently archived and hidden from your menu. Click restore to bring them back.</p>

                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Restore</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($archived)): ?>
                            <?php foreach ($archived as $item): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= FILE_ROOT . htmlspecialchars($item['image']) ?>" width="50" height="50" style="object-fit:cover;">
                                        <?php else: ?>
                                            <span class="text-muted">No image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($item["name"]) ?></td>
                                    <td><?= htmlspecialchars($item["category_id"]) ?></td>
                                    <td><?= htmlspecialchars($item["stock"]) ?></td>
                                    <td>₱<?= number_format((float)$item["price"], 2) ?></td>
                                    <td>
                                        <form method="post" action="archived_products">
                                            <input type="hidden" name="restore_id" value="<?= $item['id'] ?>">
                                            <button type="submit" name="restore_product" class="btn btn-success btn-sm">
                                                Restore
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center text-muted">No archived products found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

                                 