<?php
require APP_ROOT . '/views/products/checkoutView.php';
include APP_ROOT . '/views/layouts/header.php';
?>

<head>
    <style>
        #checkoutForm {
            margin-top: 1rem !important;
        }

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

        /* Match the pickup color */
        .btn-pickup {
            background-color: #D68421 !important;
            border-color: #D68421 !important;
            color: white !important;
        }

        .btn-pickup:hover {
            background-color: #b76615 !important;
            border-color: #b76615 !important;
        }

        /* Match the delivery color */
        .btn-delivery {
            background-color: #155E63 !important;
            border-color: #155E63 !important;
            color: white !important;
        }

        .btn-delivery:hover {
            background-color: #0f4347 !important;
            border-color: #0f4347 !important;
        }

        .title {
            font-family: 'pacifico';
            color: #D68421;
            font-size: 3rem;
        }

        @media (max-width: 767.98px) {
            #checkoutForm {
                margin-top: 1rem !important;
            }

            .p-5 {
                padding: 2rem !important;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">

        <div class="container mt-5">
            <h2 class="mt-5 text-center title">Checkout</h2>

            <?php if (empty($cartItems)): ?>
                <div class="alert-info text-center" role="alert">
                    Your cart is empty. Please add some items before checking out.
                    <br>
                    <a href="<?= FILE_ROOT ?>/drinks" class="btn btn-primary mt-3">Buy Now</a>
                </div>
            <?php else: ?>
                <!-- Choose Option First -->
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mb-5 mt-5">
                    <div class="text-center w-100" style="max-width: 800px;">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-0" id="pickupBtn">
                                <button class="btn btn-lg w-100 p-5 option-btn option-pickup">
                                    <i class="bi bi-shop fs-1"></i><br>
                                    Pickup
                                </button>
                            </div>
                            <div class="col-12 col-md-6" id="deliveryBtn">
                                <button class="btn btn-lg w-100 p-5 option-btn option-delivery">
                                    <i class="bi bi-truck fs-1"></i><br>
                                    Delivery
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Hidden Checkout Form -->
                <div id="checkoutForm" class="card shadow-sm mx-auto d-none mb-5" style="max-width:800px; margin-top:-5rem">
                    <div class="card-body p-5">
                        <h4 id="order-type-display" class="text-center mb-4"></h4>
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

                        <!-- Pickup Form -->
                        <form id="pickupForm" method="POST" action="<?= FILE_ROOT ?>/place-order" class="d-none">
                            <input type="hidden" name="order_type" value="pickup">
                            <button type="submit" class="btn btn-lg w-100 mt-4 btn-pickup">Place Order (Pickup)</button>
                        </form>

                        <!-- Delivery Form -->
                        <form id="deliveryForm" method="POST" action="<?= FILE_ROOT ?>/place-order" class="d-none">
                            <input type="hidden" name="order_type" value="delivery">

                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" name="full_name" id="fullName" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <textarea name="address" id="address" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" name="phone" id="phone" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-lg w-100 mt-4 btn-delivery">Place Order (Delivery)</button>
                        </form>
                    </div>
                </div>



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
        const orderTypeDisplay = document.getElementById("order-type-display");

        const pickupForm = document.getElementById("pickupForm");
        const deliveryForm = document.getElementById("deliveryForm");

        function resetButtons() {

        }

        pickupBtn?.addEventListener("click", function () {
            checkoutForm.classList.remove("d-none");

            orderTypeDisplay.innerHTML = "Pickup";
            orderTypeDisplay.style.color = "#D68421";
            orderTypeDisplay.style.fontWeight = "bold";

            pickupForm.classList.remove("d-none");
            deliveryForm.classList.add("d-none");
        });

        deliveryBtn?.addEventListener("click", function () {
            checkoutForm.classList.remove("d-none");

            orderTypeDisplay.innerHTML = "Delivery";
            orderTypeDisplay.style.color = "#155E63";
            orderTypeDisplay.style.fontWeight = "bold";

            deliveryForm.classList.remove("d-none");
            pickupForm.classList.add("d-none");
        });
    });

</script>