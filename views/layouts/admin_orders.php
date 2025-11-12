<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/adminOrderController.php';

$controller = new OrdersController($pdo);
$controller->handleRequest(); 

$orders = $controller->getAllOrders();
$counts = $controller->getStatusCounts();

$total_orders = array_sum($counts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            background-color: #FFF6EB; 
            font-family: 'Poppins', Arial, sans-serif;
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

        .navbar-themed {
            background-color: #281A11 !important;
        }
        .logo {
            height: 40px;
        }
        .account-dropdown .nav-link {
            color: #D48423;
            font-size: 1.6rem;
            padding: 0;
            transition: color 0.2s ease;
        }
        .account-dropdown .nav-link:hover {
            color: #fff;
        }
        .dropdown-menu-creative {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            padding: 0.5rem 0;
            margin-top: 10px !important;
        }
        .dropdown-menu-creative .dropdown-item {
            color: #281A11;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
        }
        .dropdown-menu-creative .dropdown-item:hover {
            background-color: rgba(212, 132, 35, 0.15);
            color: #281A11;
        }
        .dropdown-menu-creative .dropdown-divider {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        .sticky-alerts .alert {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(0,0,0,0.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            font-weight: 500;
            border-left-width: 5px;
        }
        .sticky-alerts .alert-success { color: #0f5132; border-left-color: #198754; }
        .sticky-alerts .alert-danger { color: #842029; border-left-color: #dc3545; }
        .sticky-alerts .alert-info { color: #055160; border-left-color: #0dcaf0; }

        .card-box {
            padding: 24px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(40, 26, 17, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            min-height: 120px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }
        .card-box.active-filter {
            box-shadow: 0 0 0 3px #D48423; 
            transform: translateY(-5px);
        }
        .card-box-icon {
            font-size: 2.5rem;
            margin-right: 1.25rem;
            line-height: 1;
            width: 40px;
        }
        .card-box .h5, .card-box h5 {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0;
        }
        .card-box .h6, .card-box h6 {
            font-weight: 400;
            color: #555;
            margin-bottom: 0;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .ui-card {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            overflow: hidden;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .ui-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }
        .ui-card .card-header {
            background-color: #281A11;
            color: white;
            border-bottom: 0;
            font-weight: 600;
            padding: 1rem 1.5rem; 
        }

        .header-search .input-group-text {
            background-color: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-right: 0;
            color: #D48423;
        }
        .header-search .form-control {
            background-color: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-left: 0;
            color: white;
        }
        .header-search .form-control::placeholder { color: rgba(255,255,255,0.6); }
        .header-search .form-control:focus {
            background-color: rgba(255,255,255,0.2);
            box-shadow: none;
            border-color: rgba(255,255,255,0.2);
            color: white;
        }
        
        /* --- Table Styles --- */
        .table-wrapper {
            max-height: 65vh;
            overflow-y: auto;
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #281A11 !important;
            color: white;
            border-bottom-width: 0;
        }
        
        /* --- Theme Button --- */
        .btn-theme {
            background-color: #A35D21;
            color: white;
            border: 0;
        }
        .btn-theme:hover {
            background-color: #281A11;
            color: white;
        }
        
        .action-form {
            display: flex;
            width: 260px;
        }
        .action-form .form-select {
            margin-right: 8px;
        }

        .search-form {
            display: flex;
            justify-content: center;
            margin-bottom: 5px; /* Adjusted for better spacing in header */
        }

        .search-input {
            border-radius: 2rem 0 0 2rem;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
            width: 300px;
        }

        .search-button {
            border-radius: 0 2rem 2rem 0;
            border: 1px solid #d48423;
            background-color: #d48423;
            color: white;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .form-select-tailwind {
            position: relative;
            z-index: 1;
            background-color: rgba(255,255,255,0.1); /* Match search input */
            border: 1px solid rgba(255,255,255,0.2); /* Match search input */
            border-left: 0; /* Match search input */
            color: white; /* Match search input */
            padding-left: 0.75rem; /* Adjust padding */
            font-weight: normal; /* Reset font-weight */
            -webkit-appearance: menulist-button; /* Restore default dropdown arrow */
            -moz-appearance: menulist-button;
            appearance: menulist-button;
            background-image: none; /* Remove custom arrow image */
            border-radius: 0 0.375rem 0.375rem 0; /* Match search input border-radius */
        }

        .form-select-tailwind:focus {
            background-color: rgba(255,255,255,0.2); /* Match search input focus */
            box-shadow: none; /* Remove custom box-shadow */
            border-color: rgba(255,255,255,0.2); /* Match search input focus */
        }
    </style>
</head>
<body>
    <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-2 sidebar">
      <a href="admin" ><i class="fas fa-house"></i>Dashboard</a>
      <a href="stocks" ><i class="fas fa-box"></i>Stocks</a>
      <a href="sales"><i class="fas fa-chart-line"></i>Sales</a>
      <a href="orders" class="active"><i class="fas fa-cart-shopping"></i>Orders</a>
      <a href="archived_products"><i class="fas fa-archive"></i>Archived</a>
      <a href="testing"><i class="fas fa-vial"></i>Testing</a>
    </div>

        <div class="col-10 p-4">
            <h4 class="fw-bold">ORDER MANAGEMENT</h4>
            <p class="text-muted">Track and manage customer orders in real-time</p>

            <div class="row g-4 mb-4">
                <div class="col">
                    <div class="card-box filter-card active-filter" data-status-filter="all">
                        <i class="fas fa-box-open card-box-icon text-dark"></i>
                        <div>
                            <h6>All Orders</h6>
                            <h5><?= $total_orders ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card-box filter-card" data-status-filter="pending">
                        <i class="fas fa-clock card-box-icon text-secondary"></i>
                        <div>
                            <h6>Pending</h6>
                            <h5><?= $counts['pending'] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card-box filter-card" data-status-filter="processing">
                        <i class="fas fa-hourglass-half card-box-icon text-warning"></i>
                        <div>
                            <h6>Processing</h6>
                            <h5><?= $counts['processing'] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card-box filter-card" data-status-filter="completed">
                        <i class="fas fa-check-circle card-box-icon text-success"></i>
                        <div>
                            <h6>Completed</h6>
                            <h5><?= $counts['completed'] ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card-box filter-card" data-status-filter="cancelled">
                        <i class="fas fa-times-circle card-box-icon text-danger"></i>
                        <div>
                            <h6>Cancelled</h6>
                            <h5><?= $counts['cancelled'] ?></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 me-3"><i class="fas fa-box-seam me-2"></i>All Orders</h5>
                        <div class="me-2">
                            <select class="form-select form-select-tailwind" id="orderTypeFilter">
                                <option value="all">All Order Types</option>
                                <option value="deliver">Deliver</option>
                                <option value="pickup">Pickup</option>
                            </select>
                        </div>
                        <div class="me-2">
                            <select class="form-select form-select-tailwind" id="sort">
                                <option value="date_desc">Sort by Date (Newest)</option>
                                <option value="date_asc">Sort by Date (Oldest)</option>
                                <option value="name_asc">Sort by Name (A-Z)</option>
                                <option value="name_desc">Sort by Name (Z-A)</option>
                                <option value="total_desc">Sort by Total (Highest)</option>
                                <option value="total_asc">Sort by Total (Lowest)</option>
                            </select>
                        </div>
                    </div>
                    <form action="" method="GET" class="search-form">
                        <input type="text" name="search" id="orderSearch"
                            placeholder="Search products..." class="search-input">
                        <button type="submit" class="search-button">Search</button>
                    </form>
                </div>
                <div class="table-wrapper">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Order Type</th>
                                <th>Status</th>
                                <th>Order Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="7" class="text-center p-5">No orders found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($orders as $order): ?>
                                    <?php $status = trim(strtolower($order->status)); ?>
                                    <tr data-status="<?= $status ?>">
                                        <td><strong>#<?= htmlspecialchars($order->id) ?></strong></td>
                                        <td><?= htmlspecialchars($order->full_name) ?></td>
                                        <td>₱<?= number_format($order->total, 2) ?></td>
                                        <td>
                                            <?php
                                            $orderTypeLower = strtolower($order->order_type ?? ''); 
                                            
                                            if ($orderTypeLower === 'deliver') {
                                                $typeBadgeStyle = 'background-color: #281A11; color: white;'; 
                                                $typeIcon = 'fa-truck';
                                            } elseif ($orderTypeLower === 'pickup') {
                                                $typeBadgeStyle = 'background-color: #D48423; color: #281A11;';
                                                $typeIcon = 'fa-bag-shopping';
                                            } else {
                                                $typeBadgeStyle = 'background-color: #6c757d; color: white;';
                                                $typeIcon = 'fa-question';
                                            }
                                            ?>
                                            <span class="badge rounded-pill" style="<?= $typeBadgeStyle ?>">
                                                <i class="fas <?= $typeIcon ?> me-1"></i>
                                                <?= htmlspecialchars(ucfirst($order->order_type)) ?>
                                            </span>
                                        </td>
                                        <td>
                                          <?php
                                            $badgeClass = 'bg-secondary text-white'; // Default
                                            switch ($status) {
                                                case 'pending':    $badgeClass = 'bg-secondary text-white'; break;
                                                case 'processing': $badgeClass = 'bg-warning text-dark'; break;
                                                case 'completed':  $badgeClass = 'bg-success text-white'; break;
                                                case 'cancelled':  $badgeClass = 'bg-danger text-white'; break;
                                            }
                                          ?>
                                          <span class="badge rounded-pill <?= $badgeClass ?>">
                                              <?= ucfirst($status) ?>
                                          </span>
                                        </td>
                                        <td><?= date("M d, Y H:i", strtotime($order->created_at)) ?></td>
                                        <td>
                                            <form method="post" class="action-form">
                                                <input type="hidden" name="order_id" value="<?= $order->id ?>">
                                                <select name="status" class="form-select form-select-sm">
                                                    <option value="pending"   <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="processing"<?= $status === 'processing' ? 'selected' : '' ?>>Processing</option>
                                                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                                                    <option value="cancelled" <?= $status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select> 
                                                <button type="submit" name="update_order" class="btn btn-sm btn-theme">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterCards = document.querySelectorAll('.filter-card');
    const searchInput = document.getElementById('orderSearch');
    const orderTypeFilter = document.getElementById('orderTypeFilter');
    const sort = document.getElementById('sort');
    const tableBody = document.getElementById('orderTableBody');
    const allTableRows = Array.from(tableBody.querySelectorAll('tr'));
    const noOrdersRow = allTableRows.find(row => row.querySelector('td[colspan="7"]'));

    function filterAndSort() {
        let searchTerm = searchInput.value.toLowerCase();
        let activeStatusFilter = document.querySelector('.card-box.active-filter').getAttribute('data-status-filter');
        let orderType = orderTypeFilter.value;
        let sortValue = sort.value;

        let filteredRows = allTableRows.filter(row => {
            if (row === noOrdersRow) return false;

            const rowStatus = row.getAttribute('data-status');
            const rowOrderType = row.cells[3].textContent.trim().toLowerCase();
            const orderId = row.cells[0].textContent.toLowerCase();
            const customerName = row.cells[1].textContent.toLowerCase();

            let statusMatch = (activeStatusFilter === 'all' || rowStatus === activeStatusFilter);
            let orderTypeMatch = (orderType === 'all' || rowOrderType.includes(orderType));
            let searchMatch = (orderId.includes(searchTerm) || customerName.includes(searchTerm));

            return statusMatch && orderTypeMatch && searchMatch;
        });

        filteredRows.sort((a, b) => {
            const [sortBy, sortDir] = sortValue.split('_');

            let valA, valB;

            switch (sortBy) {
                case 'date':
                    valA = new Date(a.cells[5].textContent);
                    valB = new Date(b.cells[5].textContent);
                    break;
                case 'name':
                    valA = a.cells[1].textContent;
                    valB = b.cells[1].textContent;
                    break;
                case 'total':
                    valA = parseFloat(a.cells[2].textContent.replace('₱', '').replace(',', ''));
                    valB = parseFloat(b.cells[2].textContent.replace('₱', '').replace(',', ''));
                    break;
            }

            if (sortDir === 'asc') {
                if (valA < valB) return -1;
                if (valA > valB) return 1;
            } else {
                if (valA > valB) return -1;
                if (valA < valB) return 1;
            }

            return 0;
        });

        tableBody.innerHTML = '';
        filteredRows.forEach(row => tableBody.appendChild(row));

        if (noOrdersRow) {
            if (filteredRows.length === 0) {
                noOrdersRow.style.display = '';
                noOrdersRow.querySelector('td').textContent = "No orders match your filter.";
                tableBody.appendChild(noOrdersRow);
            } else {
                noOrdersRow.style.display = 'none';
            }
        }
    }

    filterCards.forEach(card => {
        card.addEventListener('click', function() {
            filterCards.forEach(c => c.classList.remove('active-filter'));
            this.classList.add('active-filter');
            filterAndSort();
        });
    });

    searchInput.addEventListener('keyup', filterAndSort);
    orderTypeFilter.addEventListener('change', filterAndSort);
    sort.addEventListener('change', filterAndSort);

    // Initial sort
    filterAndSort();
});
</script>

</body>
</html>