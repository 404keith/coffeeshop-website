# coffeeshop-website

#STRUCTURE:
coffee-shop/
├── config/
│   ├── database.php          # Database connection configuration
│   ├── config.php            # General app configuration (site name, URLs, etc.)
│   └── constants.php         # Define constants (paths, roles, etc.)
│
├── controllers/
│   ├── BaseController.php    # Base controller with common methods
│   ├── HomeController.php    # Homepage and product display
│   ├── AuthController.php    # Login, logout, register
│   ├── CartController.php    # Shopping cart operations
│   ├── OrderController.php   # Order processing and history
│   ├── ProductController.php # Product CRUD operations
│   └── AdminController.php   # Admin dashboard and management
│
├── models/
│   ├── Database.php          # Database connection class
│   ├── User.php             # User model (customers & admins)
│   ├── Product.php          # Coffee products model
│   ├── Cart.php             # Shopping cart model
│   ├── Order.php            # Orders model
│   └── OrderItem.php        # Order items model
│
├── views/
│   ├── layouts/
│   │   ├── header.php       # Common header with navigation
│   │   ├── footer.php       # Common footer
│   │   └── admin_layout.php # Admin panel layout
│   │
│   ├── auth/
│   │   ├── login.php        # Login form
│   │   ├── register.php     # Registration form
│   │   └── logout.php       # Logout confirmation
│   │
│   ├── home/
│   │   ├── index.php        # Homepage with featured products
│   │   └── menu.php         # Full coffee menu
│   │
│   ├── cart/
│   │   ├── view.php         # Shopping cart page
│   │   └── checkout.php     # Checkout form
│   │
│   ├── orders/
│   │   ├── history.php      # User order history
│   │   └── details.php      # Order details page
│   │
│   └── admin/
│       ├── dashboard.php    # Admin dashboard overview
│       ├── products/
│       │   ├── index.php    # Product list
│       │   ├── create.php   # Add new product
│       │   ├── edit.php     # Edit product
│       │   └── delete.php   # Delete confirmation
│       ├── orders/
│       │   ├── index.php    # All orders list
│       │   └── details.php  # Order management
│       └── users/
│           └── index.php    # User management
│
├── public/
│   ├── index.php            # Front controller (entry point)
│   ├── .htaccess           # URL rewriting rules
│   │
│   ├── assets/
│   │   ├── css/
│   │   │   ├── bootstrap.min.css
│   │   │   └── custom.css   # Your custom styles
│   │   │
│   │   ├── js/
│   │   │   ├── bootstrap.bundle.min.js
│   │   │   ├── jquery.min.js
│   │   │   └── app.js       # Custom JavaScript
│   │   │
│   │   └── images/
│   │       ├── products/    # Product images
│   │       └── logo.png     # Site logo
│   │
│   └── uploads/            # User uploaded files
│       └── products/       # Product images uploaded by admin
│
├── core/
│   ├── Router.php          # URL routing system
│   ├── Controller.php      # Base controller class
│   ├── Model.php          # Base model class
│   └── Session.php        # Session management
│
├── helpers/
│   ├── functions.php      # Utility functions
│   ├── validation.php     # Form validation helpers
│   └── auth.php          # Authentication helpers
│
├── middleware/
│   ├── AuthMiddleware.php    # Check if user is logged in
│   └── AdminMiddleware.php   # Check if user is admin
│
└── sql/
    └── coffee_shop.sql      # Database schema and sample data