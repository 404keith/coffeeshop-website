<?php
class SalesController
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function index()
    {
        // Today's revenue
        $today = date('Y-m-d');
        $sql = "SELECT SUM(total) as total FROM orders WHERE DATE(created_at) = ? AND status='completed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$today]);
        $todayRevenue = $stmt->fetchColumn() ?? 0;

        // Average order
        $sql = "SELECT AVG(total) as avgOrder FROM orders WHERE status='completed'";
        $avgOrder = $this->db->query($sql)->fetchColumn() ?? 0;

        // This week revenue
        $weekStart = date('Y-m-d', strtotime('monday this week'));
        $weekEnd   = date('Y-m-d', strtotime('sunday this week'));
        $sql = "SELECT SUM(total) as total FROM orders WHERE DATE(created_at) BETWEEN ? AND ? AND status='completed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$weekStart, $weekEnd]);
        $weekRevenue = $stmt->fetchColumn() ?? 0;

        // Growth rate (compare this week vs last week)
        $lastWeekStart = date('Y-m-d', strtotime('monday last week'));
        $lastWeekEnd   = date('Y-m-d', strtotime('sunday last week'));
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$lastWeekStart, $lastWeekEnd]);
        $lastWeekRevenue = $stmt->fetchColumn() ?? 0;

        $growthRate = $lastWeekRevenue > 0 
            ? (($weekRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100 
            : 0;

        // Daily sales this week
        $sql = "SELECT DATE(created_at) as day, SUM(total) as revenue
                FROM orders
                WHERE DATE(created_at) BETWEEN ? AND ? AND status='completed'
                GROUP BY DATE(created_at)
                ORDER BY day ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$weekStart, $weekEnd]);
        $dailySales = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Sales by category
        $sql = "SELECT order_type, SUM(total) as total
                FROM orders
                WHERE status='completed'
                GROUP BY order_type";
        $categorySales = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        // Pass data to view
        include APP_ROOT . '/views/sales.php';
    }
}
