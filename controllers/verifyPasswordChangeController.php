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
    $tries = $_SESSION['password_change_tries'] ?? 0;

    $_SESSION['password_change_tries'] = $tries + 1;

    if ($_SESSION['password_change_tries'] > 4) {
        unset($_SESSION['password_change_code']);
        unset($_SESSION['new_password']);
        unset($_SESSION['password_change_tries']);
        $_SESSION['error_message'] = 'Unable to change password. You have exceeded the maximum number of verification attempts.';
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    }

    if (!isset($_SESSION['password_change_code']) || $verificationCode != $_SESSION['password_change_code']) {
        $_SESSION['error_message'] = 'Invalid verification code.';
        header('Location: ' . FILE_ROOT . '/verify-password-change-form');
        exit();
    }

    $newPassword = $_SESSION['new_password'];

    if (updatePassword($pdo, $userId, $newPassword)) {
        $_SESSION['success_message'] = 'Your password has been changed successfully.';
        unset($_SESSION['password_change_code']);
        unset($_SESSION['new_password']);
        unset($_SESSION['password_change_tries']);
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    } else {
        $_SESSION['error_message'] = 'There was an error changing your password.';
        header('Location: ' . FILE_ROOT . '/account-settings');
        exit();
    }
}
