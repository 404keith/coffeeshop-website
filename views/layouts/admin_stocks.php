<?php
// --- Database Connection and Processing Logic ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mondaymornings";

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to calculate stock status based on percentages
    function calculateStockStatus($current, $min) {
        if ($min == 0) {
            return 'In Stock';
        }
        $percentage = ($current / $min) * 100;
        if ($percentage >= 90) {
            return 'High';
        } elseif ($percentage >= 20) {
            return 'Medium';
        } else {
            return 'Low';
        }
    }

    // 1. Process the 'Add Product' form submission
    if (isset($_POST['submit_product'])) {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $current = $_POST['current'];
        $min = $_POST['min'];

        $status = calculateStockStatus($current, $min);
        $last_restocked = date('Y-m-d');

        $sql = "INSERT INTO stocks (name, category, current, min, status, last) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $category, $current, $min, $status, $last_restocked]);

        header("Location: stocks");
        exit();
    }

    // 2. Process the 'Update Product' form submission
    if (isset($_POST['update_product'])) {
        $id = $_POST['product_id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $current = $_POST['current'];
        $min = $_POST['min'];

        $status = calculateStockStatus($current, $min);

        $sql = "UPDATE stocks SET name=?, category=?, current=?, min=?, status=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $category, $current, $min, $status, $id]);

        header("Location: stocks");
        exit();
    }

    // 3. Fetch all products from the database for display
    $sql = "SELECT * FROM stocks";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #fff6eb; }
        .sidebar { background: #281A11; min-height: 100vh; padding-top: 20px; color: #fff; }
        .sidebar a { color: #D48423; text-decoration: none; display: block; padding: 12px; }
        .sidebar a:hover { background: rgba(145, 106, 83, 0.4); }
        .content { padding: 20px; }
        .table-light { border: 2px solid #000; border-radius: 8px; padding: 20px; margin-bottom: 20px; background: #fff; }
        tr { border: 1px solid #000; border-radius: 8px; padding: 20px; margin-bottom: 20px; background: #fff; }
    </style>
</head>
<body>

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
            
            <button type="button" class="btn btn-warning mb-3 float-end" data-bs-toggle="modal" data-bs-target="#addProductModal">
              Add Product
            </button>
            
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
                    <?php if (!empty($stocks)): ?>
                        <?php foreach($stocks as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item["name"]) ?></td>
                            <td><?= htmlspecialchars($item["category"]) ?></td>
                            <td><?= htmlspecialchars($item["current"]) ?></td>
                            <td><?= htmlspecialchars($item["min"]) ?></td>
                            <td><?= htmlspecialchars($item["status"]) ?></td>
                            <td><?= htmlspecialchars($item["last"]) ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-dark edit-btn"
                                   data-bs-toggle="modal" 
                                   data-bs-target="#editProductModal"
                                   data-id="<?= htmlspecialchars($item['id']) ?>"
                                   data-name="<?= htmlspecialchars($item['name']) ?>"
                                   data-category="<?= htmlspecialchars($item['category']) ?>"
                                   data-current="<?= htmlspecialchars($item['current']) ?>"
                                   data-min="<?= htmlspecialchars($item['min']) ?>">
                                   ✎ Edit
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No stock items found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="stocks" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="current" class="form-label">Current Stock</label>
                        <input type="number" class="form-control" id="current" name="current" required>
                    </div>
                    <div class="mb-3">
                        <label for="min" class="form-label">Minimum Stock</label>
                        <input type="number" class="form-control" id="min" name="min" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit_product" class="btn btn-warning">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="stocks" method="post">
                <input type="hidden" name="product_id" id="edit-product-id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="edit-category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-current" class="form-label">Current Stock</label>
                        <input type="number" class="form-control" id="edit-current" name="current" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-min" class="form-label">Minimum Stock</label>
                        <input type="number" class="form-control" id="edit-min" name="min" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_product" class="btn btn-dark">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editProductModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const category = button.getAttribute('data-category');
        const current = button.getAttribute('data-current');
        const min = button.getAttribute('data-min');
        
        const modalIdInput = editModal.querySelector('#edit-product-id');
        const modalNameInput = editModal.querySelector('#edit-name');
        const modalCategoryInput = editModal.querySelector('#edit-category');
        const modalCurrentInput = editModal.querySelector('#edit-current');
        const modalMinInput = editModal.querySelector('#edit-min');

        modalIdInput.value = id;
        modalNameInput.value = name;
        modalCategoryInput.value = category;
        modalCurrentInput.value = current;
        modalMinInput.value = min;
    });
});
</script>

</body>
</html>