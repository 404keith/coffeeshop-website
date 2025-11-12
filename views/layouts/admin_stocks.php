<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/controllers/stocksController.php';

$controller = new StockController($pdo);
$controller->handleRequest();
[$stocks, $category_map] = $controller->getStocks();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Management</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    body {
      background-color: #FFF6EB;
      background:
        url('<?php echo FILE_ROOT; ?>/public/assets/images/background-2.png');
      background-repeat: no-repeat;
      background-position: top center;
      background-size: cover;
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

    .content {
      padding: 25px;
    }
    
    .ui-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        overflow: hidden; 
        margin-bottom: 20px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .ui-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .ui-card-header {
        background-color: #281A11;
        color: white;
        border-bottom: 0;
        padding: 1rem 1.5rem;
    }
    
    .header-search {
        width: 300px;
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
    .header-search .form-control::placeholder {
        color: rgba(255,255,255,0.6);
    }
    .header-search .form-control:focus {
        background-color: rgba(255,255,255,0.2);
        box-shadow: none;
        border-color: rgba(255,255,255,0.2);
        color: white;
    }

    .modal-header-theme {
      background-color: #281A11;
      color: #FFF6EB;
    }
    .modal-header-theme .btn-close {
      filter: invert(1) grayscale(100) brightness(200%);
    }

    .table-custom {
      vertical-align: middle;
    }
    
    .table-custom thead th {
        background-color: #281A11;
        color: white;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .table-custom img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 25%; 
      border: 2px solid #eee;
    }

    .creative-dropdown {
        position: relative; /* Keep relative for positioning children */
        /* Remove creative styles */
        border-radius: 0; /* Reset border-radius */
        background-color: transparent; /* Reset background */
        transition: none; /* Remove transition */
        box-shadow: none; /* Remove box-shadow */
        border: none; /* Remove border */
    }

    .creative-dropdown:focus-within {
        border-image: none; /* Remove border-image */
    }

    .creative-dropdown:hover {
        box-shadow: none; /* Remove box-shadow */
        transform: none; /* Remove transform */
    }

    .creative-dropdown .form-select-tailwind {
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

    .creative-dropdown .form-select-tailwind:focus {
        background-color: rgba(255,255,255,0.2); /* Match search input focus */
        box-shadow: none; /* Remove custom box-shadow */
        border-color: rgba(255,255,255,0.2); /* Match search input focus */
    }

    .creative-dropdown .input-group-text-tailwind {
        /* Revert to input-group-text styles */
        background-color: rgba(255,255,255,0.1); /* Match search input */
        border: 1px solid rgba(255,255,255,0.2); /* Match search input */
        border-right: 0; /* Match search input */
        color: #D48423; /* Match search input */
        border-radius: 0.375rem 0 0 0.375rem; /* Match search input border-radius */
        padding: 0.5rem 1rem; /* Match search input padding */
        position: static; /* Revert position */
        z-index: auto; /* Revert z-index */
        height: auto; /* Revert height */
        display: inline-flex; /* Revert display */
        align-items: center; /* Revert align-items */
    }

    /* Remove custom arrow styles */
    .creative-dropdown::after {
        content: none;
    }

    .creative-dropdown:focus-within::after {
        transform: none;
    }

    .search-form {
        display: flex;
        justify-content: center;
        margin-bottom: 5px;
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
  </style>
</head>

<body>
  <?php include APP_ROOT . '/views/layouts/adminNav.php'; ?>

  <div class="container-fluid">
    <div class="row">

    <div class="col-md-2 sidebar">
      <a href="admin"><i class="fas fa-house"></i>Dashboard</a>
      <a href="stocks" class="active"><i class="fas fa-box"></i>Stocks</a>
      <a href="sales"><i class="fas fa-chart-line"></i>Sales</a>
      <a href="orders"><i class="fas fa-cart-shopping"></i>Orders</a>
      <a href="archived_products"><i class="fas fa-archive"></i>Archived</a>
      <a href="testing"><i class="fas fa-vial"></i>Testing</a>
    </div>

      <div class="col-md-10 content">

        <div class="ui-card">
          <div class="ui-card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="input-group">
                    <label class="input-group-text input-group-text-tailwind" for="categoryFilter"><i class="fas fa-filter"></i></label>
                    <select class="form-select form-select-tailwind" id="categoryFilter">
                        <option value="">All Categories</option>
                        <?php foreach ($category_map as $id => $name): ?>
                            <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group ms-3">
                    <label class="input-group-text input-group-text-tailwind" for="sortOrder"><i class="fas fa-sort"></i></label>
                    <select class="form-select form-select-tailwind" id="sortOrder">
                        <option value="name_asc">Sort by Name (A-Z)</option>
                        <option value="name_desc">Sort by Name (Z-A)</option>
                        <option value="stock_asc">Sort by Stock (Low-High)</option>
                        <option value="stock_desc">Sort by Stock (High-Low)</option>
                        <option value="price_asc">Sort by Price (Low-High)</option>
                        <option value="price_desc">Sort by Price (High-Low)</option>
                    </select>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <form action="" method="GET" class="search-form me-3">
                    <input type="text" name="search" id="productSearch"
                        placeholder="Search products..." class="search-input">
                    <button type="submit" class="search-button">Search</button>
                </form>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addProductModal">
                  <i class="fas fa-plus"></i> Add Product
                </button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-hover table-custom mb-0">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Stock</th>
                  <th>Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="productTableBody"> <?php if (!empty($stocks)): ?>
                  <?php foreach ($stocks as $item): ?>
                    <tr>
                      <td>
                        <?php if (!empty($item['image'])): ?>
                          <img src="<?= FILE_ROOT . htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item["name"]) ?>">
                        <?php else: ?>
                          <img src="https://via.placeholder.com/50" alt="No image">
                        <?php endif; ?>
                      </td>
                      <td><?= htmlspecialchars($item["name"]) ?></td>
                      <td>
                        <?= htmlspecialchars($category_map[$item["category_id"]] ?? 'Unknown') ?>
                      </td>
                      <td>
                        <?php
                          $stock = (int)$item["stock"];
                          $badge_class = 'bg-success'; // Default
                          if ($stock <= 10) {
                              $badge_class = 'bg-danger';
                          } elseif ($stock <= 25) {
                              $badge_class = 'bg-warning text-dark';
                          }
                        ?>
                        <span class="badge <?= $badge_class ?>"><?= $stock ?></span>
                      </td>
                      <td>
                        ₱<?= number_format($item["price"], 2) ?>
                      </td>
                      <td>
                        <a href="#" class="btn btn-sm btn-dark edit-btn" data-bs-toggle="modal"
                          data-bs-target="#editProductModal" data-id="<?= htmlspecialchars($item['id']) ?>"
                          data-name="<?= htmlspecialchars($item['name']) ?>"
                          data-category-id="<?= htmlspecialchars($item['category_id']) ?>"
                          data-product-type="<?= htmlspecialchars($item['product_type']) ?>"
                          data-description="<?= htmlspecialchars($item['description']) ?>"
                          data-price="<?= htmlspecialchars($item['price']) ?>"
                          data-stock="<?= htmlspecialchars($item['stock']) ?>"
                          data-image="<?= htmlspecialchars($item['image']) ?>">
                          <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="stocks" method="post" style="display:inline;" onsubmit="return confirmArchive()">
                          <input type="hidden" name="archive_id" value="<?= $item['id'] ?>">
                          <button type="submit" name="archive_product" class="btn btn-sm btn-danger">
                            <i class="fas fa-archive"></i> Archive
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No stock items found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header modal-header-theme">
          <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="stocks" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="category_id" class="form-label">Category</label>
              <select class="form-select" id="category_id" name="category_id" required>
                <option value="" selected disabled>Select a category</option>
                <?php foreach ($category_map as $id => $name): ?>
                  <option value="<?= $id ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
              </select>
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
              <label for="image" class="form-label">Upload Image</label>
              <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
              <img id="image-preview" src="#" alt="Image Preview" style="display:none; max-width: 100px; margin-top: 10px;">
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
        <div class="modal-header modal-header-theme">
          <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="stocks" method="post" enctype="multipart/form-data">
          <input type="hidden" name="product_id" id="edit-product-id">
          <input type="hidden" name="current_image" id="edit-current-image">
          <div class="modal-body">
            <div class="mb-3">
              <label for="edit-name" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="edit-name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="edit-category-id" class="form-label">Category</label>
              <select class="form-select" id="edit-category-id" name="category_id" required>
                <?php foreach ($category_map as $id => $name): ?>
                  <option value="<?= $id ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
              </select>
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
              <label for="edit-image-upload" class="form-label">Upload New Image (Leave blank to keep
                current)</label>
              <input type="file" class="form-control" id="edit-image-upload" name="image"
                accept="image/*" onchange="previewEditImage(event)">
              <img id="edit-image-preview" src="#" alt="Image Preview" style="max-width: 100px; margin-top: 10px;">
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

  

  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
      }
      reader.readAsDataURL(event.target.files[0]);
    }

    function previewEditImage(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.getElementById('edit-image-preview');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }

    document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('productSearch');
      const categoryFilter = document.getElementById('categoryFilter');
      const sortOrder = document.getElementById('sortOrder');
      const tableBody = document.getElementById('productTableBody');
      const originalRows = Array.from(tableBody.querySelectorAll('tr'));

      function filterAndSort() {
        const searchTerm = searchInput.value.toLowerCase();
        const category = categoryFilter.value.toLowerCase();
        const sortValue = sortOrder.value;

        let filteredRows = originalRows.filter(row => {
          const rowCategory = row.cells[2].textContent.trim().toLowerCase();
          const rowName = row.cells[1].textContent.trim().toLowerCase();

          const categoryMatch = category === '' || rowCategory === category;
          const searchMatch = rowName.includes(searchTerm) || rowCategory.includes(searchTerm);

          return categoryMatch && searchMatch;
        });

        filteredRows.sort((a, b) => {
          const [key, order] = sortValue.split('_');
          
          let valA, valB;

          switch (key) {
            case 'name':
              valA = a.cells[1].textContent.trim();
              valB = b.cells[1].textContent.trim();
              break;
            case 'stock':
              valA = parseInt(a.cells[3].querySelector('.badge').textContent.trim());
              valB = parseInt(b.cells[3].querySelector('.badge').textContent.trim());
              break;
            case 'price':
              valA = parseFloat(a.cells[4].textContent.replace(/[^0-9.-]+/g, ''));
              valB = parseFloat(b.cells[4].textContent.replace(/[^0-9.-]+/g, ''));
              break;
          }

          if (order === 'asc') {
            return valA > valB ? 1 : -1;
          } else {
            return valA < valB ? 1 : -1;
          }
        });

        tableBody.innerHTML = '';
        if (filteredRows.length > 0) {
          filteredRows.forEach(row => tableBody.appendChild(row));
        } else {
          tableBody.innerHTML = '<tr><td colspan="6" class="text-center">No products match your filters.</td></tr>';
        }
      }

      searchInput.addEventListener('keyup', filterAndSort);
      categoryFilter.addEventListener('change', filterAndSort);
      sortOrder.addEventListener('change', filterAndSort);

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
        editModal.querySelector('#edit-current-image').value = image; 

        const imagePreview = editModal.querySelector('#edit-image-preview');
        if (image && image !== 'null' && image !== '') {
            imagePreview.src = '<?= FILE_ROOT ?>' + image;
        } else {
            imagePreview.src = 'https://via.placeholder.com/100'; // Placeholder
        }
        
        // Clear the file input
        document.getElementById('edit-image-upload').value = '';
      });
    });

    function confirmArchive() {
      return confirm('Are you sure you want to archive this product?');
    }
  </script>
</body>
</html>