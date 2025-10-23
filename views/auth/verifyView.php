<?php
require_once '../../config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/controllers/signupController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['verification_code'];
    $tries = $_SESSION['verification_tries'] ?? 0;

    if ($tries >= 4) {
        unset($_SESSION['signup_data']);
        unset($_SESSION['verification_code']);
        unset($_SESSION['verification_tries']);
        $_SESSION['errors_signup'] = ['max_tries' => 'You have exceeded the maximum number of tries.'];
        header('Location: ' . FILE_ROOT . '/signup');
        die();
    }

    if (is_code_correct($code)) {
        require APP_ROOT . '/config/dbhandler.php';
        require APP_ROOT . '/models/signupModel.php';

        $signupData = $_SESSION['signup_data'];
        create_user($pdo, $signupData['first_name'], $signupData['last_name'], $signupData['username'], $signupData['password'], $signupData['email']);

        unset($_SESSION['signup_data']);
        unset($_SESSION['verification_code']);
        unset($_SESSION['verification_tries']);

        $_SESSION['signup_success'] = true;
        header('Location: ' . FILE_ROOT . '/login');
        die();
    } else {
        $_SESSION['verification_tries'] = $tries + 1;
        $_SESSION['errors_verify'] = ['invalid_code' => 'Invalid verification code.'];
        header('Location: ' . FILE_ROOT . '/views/auth/verify.php');
        die();
    }
} else {
    header('Location: ' . FILE_ROOT . '/signup');
    die();
}
?>