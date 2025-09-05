<?php

declare (strict_types=1); //enable type declaration


function output_username (){
		if (isset($_SESSION['user_id'])) {
				echo "You are logged in as " .$_SESSION['user_username'];
		} else {
			echo "You are not logged in";
		}
}


function check_login_errors(){
		if (isset($_SESSION['errors_login'])) {
				$errors = $_SESSION['errors_login'];

				echo "<br>";

				foreach ($errors as $error) {
                    if($error=='Fill in all fields!'){
                         echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                         break;
                    } 
                   echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
				}

				unset($_SESSION['errors_login'] );
		} else if ( isset($_GET['login']) && $_GET['login'] === 'success'){
			echo "<br>";
            echo '<div class="alert alert-success" role="alert">  Login Success!</div>';
		}
}

