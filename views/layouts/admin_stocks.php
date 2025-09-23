<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/stocksController.php';

$controller = new StockController($pdo);
$controller->handleRequest();
$stocks = $controller->getStocks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
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

        .sidebar a:hover,
        .active {
            background: rgba(145, 106, 83, 0.4);
        }

        .content {
            padding: 20px;
        }

        .table-light {
            border: 2px solid #000;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
        }

        tr {
            border: 1px solid #000;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
        }
    </style>
</head>

<body>
    <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-2 sidebar">
                <a href="admin">Dashboard</a>
                <a href="stocks" class="active">Stocks</a>
                <a href="sales">Sales</a>
                <a href="orders">Orders</a>
            </div>

            <div class="col-md-10 content">
                <h3>Stock Management</h3>
                <p>Manage your inventory and track stock levels</p>

                <button type="button" class="btn btn-warning mb-3 float-end" data-bs-toggle="modal"
                    data-bs-target="#addProductModal">
                    Add Product
                </button>

                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($stocks)): ?>
                        <?php foreach ($stocks as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item["name"]) ?></td>
                            <td><?= htmlspecialchars($item["category_id"]) ?></td>
                            <td><?= htmlspecialchars($item["stock"]) ?></td>
                            <td><?= htmlspecialchars($item["price"]) ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-dark edit-btn" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal"
                                    data-id="<?= htmlspecialchars($item['id']) ?>"
                                    data-name="<?= htmlspecialchars($item['name']) ?>"
                                    data-category-id="<?= htmlspecialchars($item['category_id']) ?>"
                                    data-product-type="<?= htmlspecialchars($item['product_type']) ?>"
                                    data-description="<?= htmlspecialchars($item['description']) ?>"
                                    data-price="<?= htmlspecialchars($item['price']) ?>"
                                    data-stock="<?= htmlspecialchars($item['stock']) ?>"
                                    data-image="<?= htmlspecialchars($item['image']) ?>">
                                    ✎ Edit
                                </a>
                                <form action="stocks" method="post" style="display:inline;">
                                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($item['id']) ?>">
                                    <button type="submit" name="delete_product" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?');">🗑
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No stock items found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
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
                            <label for="category_id" class="form-label">Category ID (1 drinks, 2 pastries, 3 waffles,
                                4 merienda)</label>
                            <input type="number" class="form-control" id="category_id" name="category_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_type" class="form-label">Product Type</label>
                            <input type="text" class="form-control" id="product_type" name="product_type">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Current Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image URL</label>
                            <input type="text" class="form-control" id="image" name="image">
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

    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
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
                            <label for="edit-category-id" class="form-label">Category ID</label>
                            <input type="number" class="form-control" id="edit-category-id" name="category_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-product-type" class="form-label">Product Type</label>
                            <input type="text" class="form-control" id="edit-product-type" name="product_type">
                        </div>
                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edit-description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="edit-price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="edit-price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-stock" class="form-label">Current Stock</label>
                            <input type="number" class="form-control" id="edit-stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-image" class="form-label">Image URL</label>
                            <input type="text" class="form-control" id="edit-image" name="image">
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
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editProductModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const categoryId = button.getAttribute('data-category-id');
                const productType = button.getAttribute('data-product-type');
                const description = button.getAttribute('data-description');
                const price = button.getAttribute('data-price');
                const stock = button.getAttribute('data-stock');
                const image = button.getAttribute('data-image');

                editModal.querySelector('#edit-product-id').value = id;
                editModal.querySelector('#edit-name').value = name;
                editModal.querySelector('#edit-category-id').value = categoryId;
                editModal.querySelector('#edit-product-type').value = productType;
                editModal.querySelector('#edit-description').value = description;
                editModal.querySelector('#edit-price').value = price;
                editModal.querySelector('#edit-stock').value = stock;
                editModal.querySelector('#edit-image').value = image;
            });
        });
    </script>
</body>
</html>