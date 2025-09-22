<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    try {
        // load db + models + controller
        require APP_ROOT . '/config/dbhandler.php';
        require APP_ROOT . '/models/userModel.php';
        require APP_ROOT . '/models/passwordResetModel.php';
        require APP_ROOT . '/controllers/passwordController.php';

        // ERROR HANDLING
        $errors = [];

        if (is_email_empty($email)) {
            $errors['empty_email'] = 'Email field cannot be empty!';
        }

        $user = get_user_by_email($pdo, $email);

        if (is_user_not_found($user)) {
            // we don’t tell the user the email doesn’t exist
            // but we still log the error for debugging
            $errors['reset_failed'] = 'Reset request failed!';
        }

        // if there are errors, save them to session + redirect back
        require_once APP_ROOT . '/config/session.php';

        if ($errors) {
            $_SESSION['errors_reset'] = $errors;
            header('Location: ' . FILE_ROOT . '/forgot');
            die();
        }

        // no errors -> send reset link
        handle_send_reset_link($pdo, $email);
        unset($_SESSION['errors_reset']);

        $_SESSION['reset_success'] = true;
        header('Location: ' . FILE_ROOT . '/forgot');
        die();

    } catch (PDOException $e) {
        die('Query Failed: ' . $e->getMessage());
    }

} else {
    header('Location: /');
    die();
}
