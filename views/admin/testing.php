<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/testingController.php';

$controller = new TestingController($pdo);
$controller->handleRequest();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
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
                <a href="archived_products"><i class="fas fa-archive"></i>Archived</a>
                <a href="testing" class="active"><i class="fas fa-vial"></i>Testing</a>
            </div>

            <div class="col-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0"><i class="fas fa-vial me-2"></i>Testing</h4>
                </div>

                <div class="ui-card">
                    <div class="card-header">
                        <h5 class="mb-0">Product Generation</h5>
                    </div>
                    <div class="card-body">
                        <form action="testing" method="post">
                            <div class="mb-3">
                                <label for="num_products" class="form-label">Number of products to generate</label>
                                <input type="number" class="form-control" id="num_products" name="num_products" value="100" min="1">
                            </div>
                            <button type="submit" name="generate_products" class="btn btn-primary">Generate Products</button>
                        </form>
                    </div>
                </div>

                <div class="ui-card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Test Results</h5>
                        <form action="testing" method="post">
                            <button type="submit" name="clear_results" class="btn btn-sm btn-light">Clear Results</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Number of Products</th>
                                    <th>Time Taken (seconds)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($_SESSION['test_results'])): ?>
                                    <?php foreach ($_SESSION['test_results'] as $result): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($result['count']) ?></td>
                                            <td><?= number_format($result['duration'], 4) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center">No test results yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="ui-card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Delete Generated Products</h5>
                    </div>
                    <div class="card-body">
                        <p>This will delete all products that were automatically generated.</p>
                        <form action="testing" method="post" onsubmit="return confirm('Are you sure you want to delete all auto-generated products?');">
                            <button type="submit" name="delete_products" class="btn btn-danger">Delete Generated Products</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
