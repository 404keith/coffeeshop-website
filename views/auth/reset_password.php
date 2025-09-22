<?php
require_once 'config/config.php';
require_once APP_ROOT . '/config/session.php';
include APP_ROOT . '/views/layouts/header.php';

// Get token from query string
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/login.css" />
</head>

<body>
    <?php require_once 'alerts.php'; ?>

    <div class="container-fluid d-flex justify-content-center">
        <form class="p-5 form-width" action="<?= FILE_ROOT ?>/reset_pass" method="post">
            <img src="<?= FILE_ROOT ?>/public/assets/images/remembered_icon.png" alt="Reset"
                class="img-fluid mb-2 mx-auto d-block" style="max-width: 130px;">

            <div class="form-padding">
                <div class="row">
                    <h1 class="welcome-text" style="font-size:5rem;">Reset Password</h1>
                </div>

                <h1 class="login-text">Enter your new password</h1>

                <!-- Hidden token -->
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4  data-mdb-input-init">
                    <input type="password" name="password" class="form-control" required />
                    <label class="form-label">New Password:</label>
                </div>


                <!-- Confirm Password input -->
                <div data-mdb-input-init class="form-outline mb-4  data-mdb-input-init">
                    <input type="password" name="confirm_password" class="form-control" required />
                    <label class="form-label">Confirm Password:</label>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                    Reset Password
                </button>

                <div>
                    <?php
                    resetPasswordAlert();
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>