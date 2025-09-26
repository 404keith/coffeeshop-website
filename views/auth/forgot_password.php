<?php
require_once 'config/config.php';
require_once APP_ROOT . '/config/session.php';
include APP_ROOT . '/views/layouts/header.php';
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
        <form class="p-5 form-width" action="<?= FILE_ROOT ?>/forgot_pass" method="post" id="forgot-password-form">
            <img src="<?php echo FILE_ROOT; ?>/public/assets/images/forgot_icon.png" alt="Sad face"
                class="img-fluid mb-2 mx-auto d-block" style="max-width: 130px;">
            <div class="form-padding">

                <div class="row">
                    <h1 class="welcome-text" style="font-size:5rem;">Forgot Password</h1>
                </div>

                <h1 class="login-text">Please enter the email you registered with</h1>

                <!-- Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" name="email" class="form-control" />
                    <label class="form-label" for="username">Email:</label>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4"
                    id="submit-btn">
                    Enter email
                </button>


                <div id="loading-spinner" style="display: none;">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/loading-animation.gif" alt="Loading..."
                        class="img-fluid mx-auto d-block" style="max-width: 120px;">
                    <p class="login-text mb-5">Sending email, please wait...</p>
                </div>

            </div>
        </form>
    </div>
</body>

</html>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>


<script>
    //loading animation
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('forgot-password-form');
        const loadingSpinner = document.getElementById('loading-spinner');
        const submitBtn = document.getElementById('submit-btn');
        const alertBox = document.getElementById('alert');

        if (form && loadingSpinner && submitBtn) {
            form.addEventListener('submit', function () {
                if (alertBox) {
                    alertBox.style.display = 'none';
                }

                loadingSpinner.style.display = 'block';

                submitBtn.style.display = 'none';
                submitBtn.disabled = true;
            });
        }
    });
</script>