<?php
require_once 'config/config.php';

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
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/signup.css" />


</head>

<body>
        
    <?php require_once 'signupAlerts.php'; ?>

    <!-- <div class="background-img"></div> -->

     <div class="container-fluid d-flex justify-content-center ">
        <form class="p-5 form-width" action="<?= FILE_ROOT ?>/signupView" method="post">
            
        <div class="form-padding">
            <div class="row  ">
                <h1 class="welcome-text">Sign up</h1>
            </div>
                <h1 class="login-text">Please enter the details below:</h1>


               
                

             <div class="row mb-4 ">
                <div class="col d-flex justify-content-center ">
                 
                    <div data-mdb-input-init class="form-outline  ">
                          <input type="text"
                          value="<?= signupInput('first_name') ?>" 
                          name="first_name" class="form-control" />
                          <label class="form-label" for="first_name">First name</label>
                    </div>
                </div>

                <div class="col d-flex justify-content-center">
                 
                    <div data-mdb-input-init class="form-outline ">
                          <input type="text"
                          value="<?= signupInput('last_name') ?>" 
                          name="last_name" class="form-control" />
                          <label class="form-label" for="last_name">Last name</label>
                    </div>
                </div>

            </div>

            
               
                    <!-- email input -->
          <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="email"
                 value="<?= signupInput('email') ?>" 
                name="email" class="form-control" />
                <label class="form-label" for="email">Email</label>
            </div>

                    <!-- Username input -->
          <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="text" 
                value="<?= signupInput('username') ?>" 
                name="username" class="form-control" />
                <label class="form-label" for="username">Username</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
            </div>

          

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Already signed up? <a href="/login">Login here</a></p>
            </div>

        <div><?php
           check_signup_errors();
        ?></div>

     </form>  

               </div>  
          </div>
    </div>

<script src="<?= FILE_ROOT ?>/public/assets/js/mdb.umd.min.js"></script>
   <?php include APP_ROOT . '/views/layouts/footer.php'; ?>

</body>
</html>