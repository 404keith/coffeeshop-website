<?php
ob_start();

require_once 'config/config.php';
require_once APP_ROOT . '/config/session.php';
require_once APP_ROOT . '/views/layouts/header.php';
require_once APP_ROOT . '/views/auth/alerts.php';


if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

if (isset($_POST['password'])) {
    $password = $_POST['password'];

    if ($password === CREATE_ADMIN) {
        header('Location: ' . FILE_ROOT . '/createAdmin');
        unset($_SESSION['failed_attempt']);
        unset($_SESSION['attempts']);
        exit;
    } else {
        $_SESSION['failed_attempt'] = true;
        $_SESSION['attempts']++;
        if ($_SESSION['attempts'] >= 3) {
            header('Location: ' . FILE_ROOT . '/');
            unset($_SESSION['failed_attempt']);
            unset($_SESSION['attempts']);
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/signup.css" />
</head>

<body>

    <div class="container-fluid d-flex justify-content-center">
        <form class="p-5 form-width" method="post">
            <div class="form-padding">
                <div class="row">
                    <h1 class="login-text mb-5 fs-1">ADMIN SIGNUP</h1>
                </div>

                <h1 class="login-text">Please enter the password:</h1>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>
                <div>
                    <?php
                    if (isset($_SESSION['failed_attempt'])) {
                        printFailed('wrong password, remaining attempts: ' . (3 - $_SESSION['attempts']) . '');
                        unset($_SESSION['failed_attempt']);
                    }
                    ?>
                </div>

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
            </div>
        </form>
    </div>



    <?php include APP_ROOT . '/views/layouts/footer.php'; ?>

</body>

</html>
<?php
// End output buffering and send all content to the browser.
ob_end_flush();
?>