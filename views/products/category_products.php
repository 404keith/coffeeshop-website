<?php
require_once APP_ROOT . 'config/dbhandler.php';
require_once __DIR__ . '/../../models/productModel.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $products = get_products_by_category($pdo, $category);

    foreach ($products as $product) {
        $is_in_stock = $product['stock'] > 0;
        $stock_text = $is_in_stock ? 'In Stock' : 'Out of Stock';
        $stock_color = $is_in_stock ? 'text-success' : 'text-danger';
        echo '<div class="col-md-4 d-flex">
                <div class="card flex-fill shadow-sm">
                    <img src="' . FILE_ROOT . htmlspecialchars($product['image']) . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center card-text">
                            <h5 class="card-title mb-0 fw-bold">' . htmlspecialchars($product['name']) . '</h5>
                            <p class="fw-bold mb-0 price">P ' . number_format($product['price'], 2) . '</p>
                        </div>
                        <p class="fs-6">' . htmlspecialchars($product['description']) . '</p>
                        <p class="mb-2 fw-semibold ' . $stock_color . '">
                            ' . $stock_text . ' (' . $product['stock'] . ' available)
                        </p>
                        <form method="POST" action="' . FILE_ROOT . '/cart-actions">
                            <input type="hidden" name="redirect" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="product_id" value="' . $product['id'] . '">
                            <div class="d-flex gap-2 star mb-1">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h5 class="card-title product_type">
                                ' . strtoupper(htmlspecialchars($product['product_type'])) . '
                            </h5>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-rounded w-75" ' . ($is_in_stock ? '' : 'disabled') . '>
                                    ' . ($is_in_stock ? 'Add to Cart' : 'Out of Stock') . '
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="' . $product['stock'] . '" class="form-control w-25" ' . ($is_in_stock ? '' : 'disabled') . '>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
    }
}
?>