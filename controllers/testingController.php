<?php
require_once APP_ROOT . '/models/testingModel.php';

class TestingController {
    private $model;

    public function __construct($pdo) {
        $this->model = new TestingModel($pdo);
    }

    public function handleRequest() {
        if (!isset($_SESSION['test_results'])) {
            $_SESSION['test_results'] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['generate_products'])) {
                $num_products = (int)$_POST['num_products'];
                $duration = $this->model->generateProducts($num_products);
                
                $_SESSION['test_results'][] = [
                    'count' => $num_products,
                    'duration' => $duration
                ];

                header('Location: testing?status=generated');
                exit;
            } elseif (isset($_POST['delete_products'])) {
                $this->model->deleteGeneratedProducts();
                header('Location: testing?status=deleted');
                exit;
            } elseif (isset($_POST['clear_results'])) {
                $_SESSION['test_results'] = [];
                header('Location: testing?status=cleared');
                exit;
            }
        }
    }
}


