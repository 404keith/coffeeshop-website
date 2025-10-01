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

        // 1. Check if token exists
        if (empty($token)) {
            $errors['missing_token'] = 'Reset token is missing!';
        }

        // 2. Validate password length
        if (strlen($password) < 8 || strlen($password) > 64) {
            $errors['invalid_password_length'] = 'Password must be between 8 and 64 characters.';
        }

        // 3. Check empty fields
        if (empty($password) || empty($confirmPassword)) {
            $errors['empty_password'] = 'Password fields cannot be empty!';
        }

        // 4. Check match
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
            header('Location: ' . FILE_ROOT . '/forgot');
            exit;
        }

    } catch (PDOException $e) {
        error_log('Query Failed: ' . $e->getMessage());
        die('A database error occurred. Please try again later.');
    }

} else {
    // Block direct access without token
    $token = $_GET['token'] ?? '';
    if (empty($token)) {
        require_once APP_ROOT . '/config/session.php';
        $_SESSION['errors_reset'] = ['missing_token' => 'Invalid reset link.'];
        header('Location: ' . FILE_ROOT . '/forgot');
        exit;
    }
}
