<?php
class DashboardController {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function index() {
        $data = [];

        // ✅ Total Sales
        $sql = "SELECT COALESCE(SUM(total), 0) AS total_sales 
                FROM orders 
                WHERE status = 'completed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data['total_sales'] = $stmt->fetchColumn();

        // ✅ Total Orders
        $sql = "SELECT COUNT(*) FROM orders";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data['total_orders'] = $stmt->fetchColumn();

        // ✅ Active Orders
        $sql = "SELECT COUNT(*) FROM orders WHERE status = 'pending'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data['active_orders'] = $stmt->fetchColumn();

        // ✅ Low Stock Products Count
        $sql = "SELECT COUNT(*) FROM products WHERE stock < 10";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data['low_stock'] = $stmt->fetchColumn();

        // ✅ Recent Orders (last 5)
        $sql = "SELECT id, full_name, total, status, created_at 
                FROM orders 
                ORDER BY created_at DESC 
                LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data['recent_orders'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // ✅ Low Stock Alerts (products with stock < 10)
        $sql = "SELECT id, name, stock 
                FROM products 
                WHERE stock < 10 
                ORDER BY stock ASC 
                LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data['low_stock_list'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}
