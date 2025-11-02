<?php
require_once '../config/config.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/userModel.php';
require_once APP_ROOT . '/models/passwordResetModel.php';
require_once APP_ROOT . '/controllers/passwordController.php';
require_once APP_ROOT . '/config/session.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $response = [];

    try {
        $errors = [];

        if (empty($token)) {
            $errors[] = 'Reset token is missing!';
        }
        if (strlen($password) < 8 || strlen($password) > 64) {
            $errors[] = 'Password must be between 8 and 64 characters.';
        }
        if (empty($password) || empty($confirmPassword)) {
            $errors[] = 'Password fields cannot be empty!';
        }
        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match!';
        }

        if ($errors) {
            $response['success'] = false;
            $response['message'] = implode("\n", $errors);
            echo json_encode($response);
            die();
        }

        $success = handle_reset_password($pdo, $token, $password);

        if ($success) {
            $response['success'] = true;
            $response['message'] = 'Password has been reset successfully!';
            echo json_encode($response);
            die();
        } else {
            $response['success'] = false;
            $response['message'] = 'Invalid or expired reset link. Please request a new one.';
            echo json_encode($response);
            die();
        }

    } catch (PDOException $e) {
        error_log('Query Failed: ' . $e->getMessage());
        $response['success'] = false;
        $response['message'] = 'A database error occurred. Please try again later.';
        echo json_encode($response);
        die();
    }

} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    die();
}
?>
