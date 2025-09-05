<?php

require_once '../../config/config.php';
 require_once APP_ROOT .  '/config/session.php'; 
include APP_ROOT . '/views/layouts/header.php';
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/mdb.min.css" />  
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/bootstrap.min.css" />
    <!-- Local Bootstrap Icons
    <link rel="stylesheet" href="../public/assets/css/bootstrap-icons.css" /> -->
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/header.css" />
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/login.css" />

</head>

<body>
        
    <?php require_once 'loginAlerts.php'; ?>
  

    <!-- <div class="background-img"></div> -->

     <div class="container-fluid d-flex justify-content-center ">
    <form class="p-5 form-width " action="<?= FILE_ROOT ?>/views/auth/loginView.php" method="post">
        <div class="form-padding">

            <div class="row ">
                <h1 class="welcome-text">Welcome</h1>
            </div>

            <h1 class="login-text">Login</h1>


                    <!-- Username input -->
          <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="text" name="username" class="form-control" />
                <label class="form-label" for="username">Username</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="

                    <?php

                    ?>  
                    " 
                    id="form2Example34" />
                    <label class="form-check-label" for="form2Example34"> Remember me </label>
                </div>
                </div>

                <div class="col text-center">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not yet registered? <a href="signup.php">Register here</a></p>
            </div>

            <div><?php  check_login_errors(); ?></div>


        </form>  

         </div>  
       </div>
    </div>

<script src="<?= FILE_ROOT ?>/public/assets/js/mdb.umd.min.js"></script>
   <?php include APP_ROOT . '/views/layouts/footer.php'; ?>


</body>
</html>