<?php
require_once __DIR__ . '/config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/productModel.php';

if (isset($_GET['search']) && isset($_GET['category'])) {
    $search_term = $_GET['search'];
    $category_name = $_GET['category'];

    if ($category_name === 'drinks') {
        $category_name = 'drink';
    } else if ($category_name === 'waffles') {
        $category_name = 'waffle';
    } else if ($category_name === 'pastries') {
        $category_name = 'pastry';
    }

    $products = search_products_by_category($pdo, $search_term, $category_name);

    if (empty($products)) {
        echo '<p style="color:red">No products found</p>';
    } else {
        foreach ($products as $product) {
            $is_in_stock = $product['stock'] > 0;
            $stock_text = $is_in_stock ? 'Available' : 'Not Available';
            $stock_color = $is_in_stock ? 'text-success' : 'text-danger';

            echo '<div class="col-12 col-sm-6 col-md-4 d-flex">';
            echo '    <div class="card flex-fill shadow-sm">';
            echo '        <img src="' . FILE_ROOT . htmlspecialchars($product['image']) . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '">';
            echo '        <div class="card-body d-flex flex-column">';
            echo '            <div class="d-flex justify-content-between align-items-center card-text">';
            echo '                <h5 class="card-title mb-0 fw-bold">' . htmlspecialchars($product['name']) . '</h5>';
            echo '                <p class="fw-bold mb-0 price">P ' . number_format($product['price'], 2) . '</p>';
            echo '            </div>';
            echo '            <p class="fs-6 flex-grow-1">' . htmlspecialchars($product['description']) . '</p>';
            echo '            <p class="stock mb-2 fw-semibold ' . $stock_color . '">' . $stock_text . '</p>';
            echo '            <form method="POST" action="' . FILE_ROOT . '/cart-actions">';
            echo '                <input type="hidden" name="redirect" value="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '">';
            echo '                <input type="hidden" name="action" value="add">';
            echo '                <input type="hidden" name="product_id" value="' . $product['id'] . '">';
            echo '                <div class="d-flex gap-2 star mb-1">';
            echo '                    <i class="bi bi-star-fill"></i>';
            echo '                    <i class="bi bi-star-fill"></i>';
            echo '                    <i class="bi bi-star-fill"></i>';
            echo '                    <i class="bi bi-star-fill"></i>';
            echo '                    <i class="bi bi-star-fill"></i>';
            echo '                </div>';
            echo '                <h5 class="card-title product_type">' . strtoupper(htmlspecialchars($product['product_type'])) . '</h5>';
            echo '                <div class="d-flex gap-2">';
            echo '                    <button type="submit" class="btn btn-primary btn-rounded w-75" ' . ($is_in_stock ? '' : 'disabled') . '>' . ($is_in_stock ? 'Add to Cart' : 'Out of Stock') . '</button>';
            require_once APP_ROOT . '/models/cartModel.php';
            $in_cart_qty = getCartQuantity($pdo, $_SESSION['user_id'] ?? 0, $product['id']);
            $remaining_stock = $product['stock'] - $in_cart_qty;
            echo '                    <input type="number" name="quantity" value="1" min="1" max="' . ($remaining_stock > 0 ? $remaining_stock : 1) . '" class="form-control w-25" ' . ($is_in_stock && $remaining_stock > 0 ? '' : 'disabled') . '>';
            echo '                </div>';
            echo '            </form>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        }
    }
}
