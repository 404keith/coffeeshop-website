<?php
require_once '../../config/config.php';
require_once APP_ROOT . '/config/session.php';
include APP_ROOT . '/views/layouts/header.php';

if (!isset($_SESSION['signup_data'])) {
    header('Location: ' . FILE_ROOT . '/signup');
    die();
}

$tries = $_SESSION['verification_tries'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/signup.css" />
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container-fluid d-flex justify-content-center">
            <form class="p-5 form-width" action="<?= FILE_ROOT ?>/views/auth/verifyView.php" method="post">
                <div class="form-padding">
                    <div>
                        <h1 class="welcome-text">Verify Your Email</h1>
                    </div>

                    <h1 class="login-text">Please enter the 6-digit code sent to your email.</h1>

                    <!-- Verification Code Input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" name="verification_code" id="verification_code" class="form-control"
                            required />
                        <label class="form-label" for="verification_code">Verification Code</label>
                    </div>

                    <?php if (isset($_SESSION['errors_verify']['invalid_code'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['errors_verify']['invalid_code'] ?>
                        </div>
                    <?php endif; ?>

                    <!-- <p>Tries left: <?= 4 - $tries ?></p> -->

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Verify</button>
                </div>
            </form>
        </div>
    </main>
</body>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>

</html>