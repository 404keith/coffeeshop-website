<?php if (empty($products)): ?>
    <p style="color:red">Product is empty</p>
<?php else: ?>
    <?php foreach ($products as $product):
        $is_in_stock = $product['stock'] > 0;
        $stock_text = $is_in_stock ? 'Available' : 'Not Available';
        $stock_color = $is_in_stock ? 'text-success' : 'text-danger';
        ?>
        <div class="col-12 col-sm-6 col-md-4 d-flex">
            <div class="card flex-fill shadow-sm">
                <img src="<?= FILE_ROOT . htmlspecialchars($product['image']) ?>" class="card-img-top"
                    alt="<?= htmlspecialchars($product['name']) ?>">

                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center card-text">
                        <h5 class="card-title mb-0 fw-bold"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="fw-bold mb-0 price">₱ <?= number_format($product['price'], 2) ?></p>
                    </div>
                    <p class="fs-6 flex-grow-1"><?= htmlspecialchars($product['description']) ?></p>

                    <p class="stock mb-2 fw-semibold <?= $stock_color ?>">
                        <?= $stock_text ?>
                    </p>

                    <form method="POST" action="<?= FILE_ROOT ?>/cart-actions">
                        <input type="hidden" name="redirect"
                            value="<?= htmlspecialchars(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) ?>">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <div class="d-flex gap-2 star mb-1">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h5 class="card-title product_type">
                            <?= strtoupper(htmlspecialchars($product['product_type'])) ?>
                        </h5>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-rounded w-75" <?= $is_in_stock ? '' : 'disabled' ?>>
                                <?= $is_in_stock ? 'Add to Cart' : 'Out of Stock' ?>
                            </button>
                            <?php
                            require_once APP_ROOT . '/models/cartModel.php';
                            $in_cart_qty = getCartQuantity($pdo, $_SESSION['user_id'] ?? 0, $product['id']);
                            $remaining_stock = $product['stock'] - $in_cart_qty;
                            ?>
                            <input type="number" name="quantity" value="1" min="1"
                                max="<?= $remaining_stock > 0 ? $remaining_stock : 1 ?>" class="form-control w-25"
                                <?= $is_in_stock && $remaining_stock > 0 ? '' : 'disabled' ?>>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>