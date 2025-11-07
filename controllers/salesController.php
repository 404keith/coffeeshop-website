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
        $today = date('Y-m-d');
        
        $year = $_GET['year'] ?? date('Y');
        $month = $_GET['month'] ?? 'all'; 

        $sql = "SELECT SUM(total) FROM orders WHERE DATE(created_at) = ? AND status='completed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$today]);
        $todayRevenue = $stmt->fetchColumn() ?? 0;

        $sql = "SELECT AVG(total) FROM orders WHERE status='completed'";
        $avgOrder = $this->db->query($sql)->fetchColumn() ?? 0;

        $weekStart = date('Y-m-d', strtotime('monday this week'));
        $weekEnd   = date('Y-m-d', strtotime('sunday this week'));
        $sql = "SELECT SUM(total) FROM orders WHERE DATE(created_at) BETWEEN ? AND ? AND status='completed'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$weekStart, $weekEnd]);
        $weekRevenue = $stmt->fetchColumn() ?? 0;

        $lastWeekStart = date('Y-m-d', strtotime('monday last week'));
        $lastWeekEnd   = date('Y-m-d', strtotime('sunday last week'));
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$lastWeekStart, $lastWeekEnd]);
        $lastWeekRevenue = $stmt->fetchColumn() ?? 0;

        $growthRate = $lastWeekRevenue > 0
            ? (($weekRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100
            : ($weekRevenue > 0 ? 100 : 0);

        $sql = "SELECT DATE_FORMAT(created_at, '%M %d, %Y') as day, SUM(total) as revenue
                FROM orders
                WHERE DATE(created_at) BETWEEN ? AND ? AND status='completed'
                GROUP BY DATE(created_at), day
                ORDER BY day ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$weekStart, $weekEnd]);
        $dailySales = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT order_type, SUM(total) as total
                FROM orders
                WHERE status='completed'
                GROUP BY order_type";
        $categorySales = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $chart_title = "";
        $chart_params = [$year];

        if (empty($month) || $month == 'all') {
            $chart_title = "Monthly Sales ($year)";
            $sql = "SELECT DATE_FORMAT(created_at, '%M') AS label, SUM(total) AS revenue
                    FROM orders
                    WHERE YEAR(created_at) = ? AND status='completed'
                    GROUP BY MONTH(created_at), label
                    ORDER BY MONTH(created_at)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($chart_params);
            $chart_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } else {
            $monthName = date('F', mktime(0, 0, 0, $month, 1)); 
            $chart_title = "Daily Sales ($monthName $year)";
            
            array_push($chart_params, $month); 
            
            $sql = "SELECT DATE_FORMAT(created_at, '%b %d') AS label, SUM(total) AS revenue
                    FROM orders
                    WHERE YEAR(created_at) = ? AND MONTH(created_at) = ? AND status='completed'
                    GROUP BY DATE(created_at), label
                    ORDER BY DATE(created_at)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($chart_params);
            $chart_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $chartLabels = array_column($chart_data, 'label');
        $chartData = array_column($chart_data, 'revenue');

        return [
            'todayRevenue'  => $todayRevenue,
            'avgOrder'      => $avgOrder,
            'weekRevenue'   => $weekRevenue,
            'growthRate'    => $growthRate,
            'dailySales'    => $dailySales,   
            'categorySales' => $categorySales, 
            
            'chartLabels'   => $chartLabels,
            'chartData'     => $chartData,
            'chart_title'   => $chart_title,
            
            'year'          => $year,
            'month'         => $month 
        ];
    }
}
?>