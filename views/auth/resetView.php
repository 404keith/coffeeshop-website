<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    try {
        require APP_ROOT . '/config/dbhandler.php';
        require APP_ROOT . '/models/userModel.php';
        require APP_ROOT . '/models/passwordResetModel.php';
        require APP_ROOT . '/controllers/passwordController.php';
        require_once APP_ROOT . '/config/session.php';

        $errors = [];

        if (empty($token)) {
            $errors['missing_token'] = 'Reset token is missing!';
        }

        if (empty($password) || empty($confirmPassword)) {
            $errors['empty_password'] = 'Password fields cannot be empty!';
        }

        if ($password !== $confirmPassword) {
            $errors['password_mismatch'] = 'Passwords do not match!';
        }

        if ($errors) {
            $_SESSION['errors_reset'] = $errors;
            header('Location: ' . FILE_ROOT . '/reset?token=' . urlencode($token));
            exit;
        }

        // Call controller function
        $success = handle_reset_password($pdo, $token, $password);

        if ($success) {
            $_SESSION['reset_success'] = 'success';
            header('Location: ' . FILE_ROOT . '/login');
            exit;
        } else {
            $_SESSION['errors_reset'] = ['invalid_token' => 'Invalid or expired reset link.'];
             abort(401);
            exit;
        }

    } catch (PDOException $e) {
        die('Query Failed: ' . $e->getMessage());
    }

} else {
    // If not POST, block direct access without token
    $token = $_GET['token'] ?? '';
    if (empty($token)) {
        require_once APP_ROOT . '/config/session.php';
        $_SESSION['errors_reset'] = ['missing_token' => 'Invalid reset link.'];
        header('Location: ' . FILE_ROOT . '/forgot');
        exit;
    }

}
