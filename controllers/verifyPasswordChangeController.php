<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/accountSettingsModel.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $verificationCode = $_POST['verification_code'];

    if (!isset($_SESSION['password_change_code']) || $verificationCode != $_SESSION['password_change_code']) {
        $_SESSION['error_message'] = 'Invalid verification code.';
        header('Location: ' . FILE_ROOT . '/verify-password-change');
        exit();
    }

    $newPassword = $_SESSION['new_password'];

    if (updatePassword($pdo, $userId, $newPassword)) {
        $_SESSION['success_message'] = 'Your password has been changed successfully.';
        unset($_SESSION['password_change_code']);
        unset($_SESSION['new_password']);
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    } else {
        $_SESSION['error_message'] = 'There was an error changing your password.';
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    }
}
