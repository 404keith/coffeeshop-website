<?php
require_once APP_ROOT . '/models/AdminOrderModel.php';

class OrdersController {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function handleRequest() {
        if (isset($_POST['update_order'], $_POST['order_id'], $_POST['status'])) {
            try {
                $status = trim(strtolower($_POST['status']));
                $sql = "UPDATE orders SET status = ? WHERE id = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$status, $_POST['order_id']]);

                header("Location: orders");
                exit();
            } catch (PDOException $e) {
                die("Error updating order: " . $e->getMessage());
            }
        }
    }

    public function getAllOrders(): array {
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($data as $orderData) {
            $orders[] = new AdminOrderModel($orderData);
        }
        return $orders;
    }

    public function getStatusCounts(): array {
        $sql = "SELECT status, COUNT(*) as count FROM orders GROUP BY status";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $counts = [
            'pending'    => 0,
            'processing' => 0,
            'completed'  => 0,
            'cancelled'  => 0
        ];

        foreach ($data as $row) {
            $status = trim(strtolower($row['status']));
            if (isset($counts[$status])) {
                $counts[$status] = (int)$row['count'];
            }
        }

        return $counts;
    }
}
