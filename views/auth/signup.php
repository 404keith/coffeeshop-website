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
      
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/mdb.min.css" />  
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap.min.css" />
    <!-- Local Bootstrap Icons
    <link rel="stylesheet" href="../public/assets/css/bootstrap-icons.css" /> -->
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/header.css" />

    <style>
        @font-face{
        font-family:'campana';
        src:url('<?php echo URL_ROOT; ?>/public/assets/fonts/campana.otf') format('opentype');
        font-weight:normal;
        font-style:normal;
        }

        body{
            background-color: #FFF6EB;      
        }

        /* .background-img{
            position: fixed;    
            top: 0;
            left: 0;
            width: 110%;
            height: 100%;
            background-image: url('../public/assets/images/login-background.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(3px);  
            z-index: -1;           
            transform: translate(-5%, 2%); 
               
        }

         .background-img::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: #00000067;
         } */

        .form-width{
            max-width: 700px; 
            width: 80%;     
            background-color: #FFF6EB;  
        }

        .form-outline .form-control:focus~.form-notch .form-notch-leading {

        border-top: .125rem solid #D48423;
        border-bottom: .125rem solid #D48423;
        border-left: .125rem solid #D48423;
        box-shadow:-1px 0px 0px 0px #D48423, 0px 1px 0px 0px #D48423, 0px -1px 0px 0px #D48423;
        }
        .form-outline .form-control:focus~.form-notch .form-notch-middle {
           
            border-bottom: .125rem solid;
            border-color: #D48423;
            border-top:none;
            box-shadow: 0 1px 0 0 #D48423;
            
        }

        .form-outline .form-control:focus {
            background-color: #FFF6EB; 
        }

        .form-outline .form-control:focus~.form-notch .form-notch-trailing {
           background-color: rgba(255, 246, 235, 0);  
            border-color: currentcolor currentcolor currentcolor #E4A11B;
            border-bottom: .125rem solid #D48423;
            border-right: .125rem solid #D48423;
            border-top: .125rem solid #D48423;
            box-shadow: 1px 0 0 0 #D48423, 0 -1px 0 0 #D48423, 0 1px 0 0 #D48423;
        }

        .form-outline .form-control:focus~.form-label {
            color: #D48423;
        }		

        .form-outline .form-control.active~.form-notch .form-notch-middle, .form-outline .form-control:focus~.form-notch .form-notch-middle {
        border-top: 1px transparent;
        }

        .form-check-input:checked {
        background-color: #D48423!important;
        border-color: #D48423!important;
        }

       .btn-primary {
        background-color: #D48423!important;
        border-color: #D48423!important;
        }

        .btn-primary:hover {
        background-color: #C3680B !important;
        border-color: #C3680B !important;
        }

        .text-center a {
        color: #D48423; 
        text-decoration: none; 
        }

        .text-center a:hover {
        color: #C3680B; 
        text-decoration: underline;
        }

        .form-padding{
            padding-top: 6rem;
            padding-left:6rem;
            padding-right:5rem;
        }
    
        .alert{
            text-align: center;
        }

           .welcome-text{
           color: #D48423; 
            text-align: center;
            font-size: 9rem;
            font-family: campana;
            margin-top:-6rem;
            padding-bottom: 1rem;
        }
        

        .login-text{
            color: #C3680B ;
            font-size: 15px;
            font-family: inter;
            font-weight:bolder;
            text-align: center;
            margin-top: -2rem;
            margin-bottom: 1.5rem;
        }
        
    </style>

</head>

<body>
        
    <?php require_once 'signupAlerts.php'; ?>

    <!-- <div class="background-img"></div> -->

     <div class="container-fluid d-flex justify-content-center ">
    <form class="p-5 form-width" action="<?php echo URL_ROOT; ?>/views/auth/signupView.php" method="post">
        <div class="form-padding">

            <div class="row  ">
                <h1 class="welcome-text">Sign up</h1>
            </div>
                <h1 class="login-text">Please enter the details below:</h1>

 <!--
             <div class="row mb-4 ">
                <div class="col d-flex justify-content-center ">
                nme 
                    <div data-mdb-input-init class="form-outline  ">
                          <input type="text" name="firstname" class="form-control" />
                          <label class="form-label" for="firstname">First name</label>
                    </div>
                </div>

                <div class="col d-flex justify-content-center">
                 name 
                    <div data-mdb-input-init class="form-outline ">
                          <input type="text" name="lastname" class="form-control" />
                          <label class="form-label" for="lastname">Last name</label>
                    </div>
                </div>

            </div> -->

            
               
                    <!-- email input -->
          <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="email" name="email" class="form-control" />
                <label class="form-label" for="email">Email</label>
            </div>

                    <!-- Username input -->
          <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="text" name="username" class="form-control" />
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
                <p>Already signed up? <a href="login.php">Login here</a></p>
            </div>

        <div><?php
           check_signup_errors();
        ?></div>

     </form>  

               </div>  
          </div>
    </div>

<script src="<?php echo URL_ROOT; ?>/public/assets/js/mdb.umd.min.js"></script>

</body>
</html>