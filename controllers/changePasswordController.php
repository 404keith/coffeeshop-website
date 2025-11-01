<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/accountSettingsModel.php';
require_once APP_ROOT . '/controllers/emailController.php';
require_once APP_ROOT . '/controllers/signupController.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    if ($newPassword !== $confirmNewPassword) {
        $_SESSION['change_password_error'] = 'New passwords do not match.';
        $_SESSION['open_change_password_modal'] = true;
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    }

    if (!is_password_length_valid($newPassword)) {
        $_SESSION['change_password_error'] = 'Password must be between 8 and 64 characters long.';
        $_SESSION['open_change_password_modal'] = true;
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    }

    $user = getUserById($pdo, $userId);

    if (!password_verify($currentPassword, $user['password'])) {
        $_SESSION['change_password_error'] = 'Incorrect current password.';
        $_SESSION['open_change_password_modal'] = true;
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    }

    $verificationCode = rand(100000, 999999);
    $_SESSION['password_change_code'] = $verificationCode;
    $_SESSION['new_password'] = password_hash($newPassword, PASSWORD_DEFAULT);

    if (sendPasswordChangeEmail($user['email'], $verificationCode)) {
        header('Location: ' . FILE_ROOT . '/verify-password-change');
        exit();
    } else {
        $_SESSION['error_message'] = 'Failed to send verification code. Please try again.';
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    }
}
