<?php
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/accountSettingsModel.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . FILE_ROOT . '/login');
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $zipCode = $_POST['zip_code'] ?? '';

    if (updateUser($pdo, $userId, $firstName, $lastName, $phone, $address, $city, $zipCode)) {
        $_SESSION['success_message'] = 'Your account information has been updated successfully.';
    } else {
        $_SESSION['error_message'] = 'There was an error updating your account information.';
    }

    header('Location: ' . FILE_ROOT . '/account-settings');
    exit();
}

$user = getUserById($pdo, $userId);
