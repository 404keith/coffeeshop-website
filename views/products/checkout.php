<?php
require APP_ROOT . '/views/products/checkoutView.php';
include APP_ROOT . '/views/layouts/header.php';
?>

<head>
    <style>
        .option-btn {
            border: 2px solid #D68421;
            border-radius: 1rem;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        /* Pickup button - orange */
        .option-pickup {
            background-color: #D68421;
            color: white;
        }

        .option-pickup:hover {
            background-color: #b76615;
            /* darker shade */
            color: white;
        }

        /* Delivery button - complementary dark teal */
        .option-delivery {
            background-color: #155E63;
            color: white;
            border-color: #155E63;
        }

        .option-delivery:hover {
            background-color: #0f4347;
            /* darker teal */
            color: white;
        }

        .dimmed {
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <main class="flex-fill">
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Checkout</h2>

            <?php if (empty($cartItems)): ?>
                <div class="alert alert-info text-center" role="alert">
                    Your cart is empty. Please add some items before checking out.
                    <br>
                    <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3">Buy Now</a>
                </div>
            <?php else: ?>
                <!-- Choose Option First -->
                <div class="d-flex justify-content-center align-items-center mb-5" style="height:20rem;">
                    <div class="row text-center w-100" style="max-width: 1000px;">
                        <div class="col-md-6" id="pickupBtn">
                            <button class="btn btn-lg w-100 p-5 option-btn option-pickup">
                                <i class="bi bi-shop fs-1"></i><br>
                                Pickup
                            </button>
                        </div>
                        <div class="col-md-6" id="deliveryBtn">
                            <button class="btn btn-lg w-100 p-5 option-btn option-delivery">
                                <i class="bi bi-truck fs-1"></i><br>
                                Delivery
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Hidden Checkout Form -->
                <div id="checkoutForm" class="card shadow-sm mx-auto d-none" style="max-width:1000px; margin-top:-5rem">
                    <div class="card-body p-5">
                        <h5 class="card-title">Order Summary</h5>
                        <ul class="list-group list-group-flush">
                            <?php $total = 0; ?>
                            <?php foreach ($cartItems as $item): ?>
                                <?php $itemTotal = $item['price'] * $item['quantity']; ?>
                                <?php $total += $itemTotal; ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="my-0"><?= htmlspecialchars($item['name']) ?></h6>
                                        <small class="text-muted">Quantity: <?= htmlspecialchars($item['quantity']) ?></small>
                                    </div>
                                    <span class="text-muted">P <?= number_format($itemTotal, 2) ?></span>
                                </li>
                            <?php endforeach; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                <span>Total</span>
                                <span>P <?= number_format($total, 2) ?></span>
                            </li>
                        </ul>

                        <hr class="my-4">

                        <!-- Extra: Hidden input for option -->
                        <form method="POST" action="<?= FILE_ROOT ?>/place-order">
                            <input type="hidden" name="order_type" id="orderType" value="">
                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Place Order</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include APP_ROOT . '/views/layouts/footer.php'; ?>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const pickupBtn = document.getElementById("pickupBtn");
        const deliveryBtn = document.getElementById("deliveryBtn");
        const checkoutForm = document.getElementById("checkoutForm");
        const orderType = document.getElementById("orderType");

        function resetColumns() {
            pickupBtn.classList.remove("col-md-9", "col-md-3", "dimmed");
            deliveryBtn.classList.remove("col-md-9", "col-md-3", "dimmed");

            pickupBtn.classList.add("col-md-6");
            deliveryBtn.classList.add("col-md-6");
        }

        pickupBtn?.addEventListener("click", function () {
            resetColumns();
            checkoutForm.classList.remove("d-none");

            pickupBtn.classList.replace("col-md-6", "col-md-9");
            deliveryBtn.classList.replace("col-md-6", "col-md-3");

            deliveryBtn.classList.add("dimmed");

            orderType.value = "pickup";
        });

        deliveryBtn?.addEventListener("click", function () {
            resetColumns();
            checkoutForm.classList.remove("d-none");

            deliveryBtn.classList.replace("col-md-6", "col-md-9");
            pickupBtn.classList.replace("col-md-6", "col-md-3");

            pickupBtn.classList.add("dimmed");

            orderType.value = "delivery";
        });
    });
</script>