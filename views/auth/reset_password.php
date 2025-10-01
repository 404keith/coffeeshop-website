<?php
require_once 'config/config.php';
require_once APP_ROOT . '/config/session.php';
include APP_ROOT . '/views/layouts/header.php';

// Get token from query string
$token = $_GET['token'] ?? '';
$errors = $_SESSION['errors_reset'] ?? [];
unset($_SESSION['errors_reset']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/signup.css" />
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">

        <div class="container-fluid d-flex justify-content-center">
            <!-- ACTION points to reset password controller -->
            <form class="p-5 form-width" action="<?= FILE_ROOT ?>/reset_pass" method="post">

                <div class="form-padding">
                    <div>
                        <h1 class="welcome-text">Reset Password</h1>
                    </div>

                    <h1 class="login-text">Enter your new password below:</h1>

                    <!-- Hidden token -->
                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                    <!-- New Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" name="password" id="passwordInput" class="form-control" minlength="8"
                            maxlength="64" title="Password must be 8-64 characters long." required />
                        <label class="form-label" for="passwordInput">New Password (8-64 characters)</label>

                        <!-- Toggle button -->
                        <span class="input-group-text position-absolute end-0 top-0 bottom-0 cursor-pointer"
                            style="border: none; background: transparent; padding-right: 15px;"
                            onclick="togglePasswordVisibility()">
                            <i id="togglePasswordIcon" class="fas fa-eye"></i>
                        </span>
                    </div>

                    <!-- Confirm Password -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" name="confirm_password" class="form-control" required />
                        <label class="form-label">Confirm Password</label>
                    </div>

                    <!-- Error messages -->
                    <?php if ($errors): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <p><?= htmlspecialchars($error) ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Reset Password</button>

                    <!-- Back to login -->
                    <div class="text-center">
                        <p>Remembered your password? <a href="/login">Login here</a></p>
                    </div>
                </div>

            </form>
        </div>
    </main>
</body>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>

</html>