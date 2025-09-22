<?php
function renderAccountMenu($fileRoot)
{
    if (isset($_SESSION['user_id'])) {
        echo '<li class="dropdown-item-text text-center mb-2">Hello, ' . htmlspecialchars($_SESSION['user_firstname']) . '</li>';

        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
            echo '<li><a class="btn btn-account " href="' . $fileRoot . '/admin">Dashboard</a></li>';

        }
        echo '<li><a class="btn btn-account " href="' . $fileRoot . '/logout">Logout</a></li>';

    } else {
        echo '<li><a class="btn btn-account  mb-2" href="' . $fileRoot . '/login">Login</a></li>';
        echo '<li><a class="btn  btn-account" href="' . $fileRoot . '/signup">Signup</a></li>';
    }
}


function renderCartMenu($fileRoot, $pdo)
{
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo '<li><span class="dropdown-item-text">Please log in to view your cart.</span></li>';
        return;
    }

    $userId = $_SESSION['user_id'];

    $sql = "SELECT ci.id, ci.quantity, p.name, p.price, p.image FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cartItems)) {
        echo '<li><span class="dropdown-item-text">Your cart is empty.</span></li>';
        echo '<li><hr class="dropdown-divider"></li>';
        echo '<li><a class="dropdown-item" href="' . $fileRoot . '/drinks">Start Shopping</a></li>';
    } else {
        $total = 0;
        echo '<li><h6 class="dropdown-header">Your Cart:</h6></li>';
        // Container for scrollable cart items with fixed dimensions
        echo '<div style="max-height: 200px; overflow-y: auto;">';
        foreach ($cartItems as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $total += $itemTotal;
            echo '<li>';
            echo '<div class="d-flex align-items-center justify-content-between">';
            echo '<div class="dropdown-item-text">';
            echo '<strong>' . htmlspecialchars($item['name']) . '</strong> - P ' . number_format($item['price'], 2);
            echo '</div>';
            echo '<form method="POST" action="' . $fileRoot . '/cart-actions" class="d-flex align-items-center">';
            echo '<input type="hidden" name="cart_item_id" value="' . $item['id'] . '">';
            echo '<input type="number" name="quantity" value="' . htmlspecialchars($item['quantity']) . '" min="1" class="form-control form-control-sm mx-2" style="width: 60px;">';
            echo '<button  style="width:30px; height:30px; type="submit" name="action" value="update" class="btn btn-primary btn-sm me-2"><i class="bi bi-pencil-square"></i>
</button>';
            echo '<button style="width:29px; height:29px; type="submit" name="action" value="remove" class="btn btn-danger btn-sm me-2"><i class="bi bi-trash"></i></button>';
            echo '</form>';
            echo '</div>';
            echo '</li>';
        }
        echo '</div>'; // Close the scrollable container
        echo '<li><hr class="dropdown-divider"></li>';
        echo '<li><span class="dropdown-item-text fw-bold">Total: P ' . number_format($total, 2) . '</span></li>';
        echo '<li><hr class="dropdown-divider"></li>';
        echo '<li><a class="dropdown-item text-primary" href="' . $fileRoot . '/cart">View Cart</a></li>';
        echo '<li><a class="dropdown-item text-primary" href="' . $fileRoot . '/checkout">Checkout</a></li>';
    }
}