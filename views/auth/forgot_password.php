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
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/login.css" />
</head>

<body>     
    <?php require_once 'alerts.php'; ?>
    
    <div class="container-fluid d-flex justify-content-center">
        <form class="p-5 form-width" action="<?= FILE_ROOT ?>/forgot_passwordView" method="post">
                <img src="<?php echo FILE_ROOT; ?>/public/assets/images/sad-face.png" alt="Sad face" class="img-fluid mb-2 mx-auto d-block" style="max-width: 200px;">
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
                <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                    Enter email
                </button>

            
                <div>
                    <?php check_input_errors(); ?>
                </div>

            </div>
        </form>
    </div> 
</body>
</html>
    <?php include APP_ROOT . '/views/layouts/footer.php'; ?>