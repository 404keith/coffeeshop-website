<?php
declare(strict_types=1); //enable type declaration


function check_signup_errors()
{
	if (isset($_SESSION['errors_signup'])) {
		$errors = $_SESSION['errors_signup'];

		echo "<br>";

				foreach ($errors as $error) {
                    if($error=='Fill in all fields!'){
                         echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                         break;
                    } 
                   echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
				}

		unset($_SESSION['errors_signup']);
	
	} else if (isset($_SESSION['signup_success']) && $_SESSION['signup_success'] === true) {
		echo "<br>";
		echo '<div class="alert alert-success" role="alert"> Sign-up Success!</div>';
		unset($_SESSION['signup_success']);
	}
}


function signupInput($field) {
    $value = '';

    // First name
    if ($field === 'first_name' &&
        isset($_SESSION['signup_data']['first_name'])) {
        $value = htmlspecialchars($_SESSION['signup_data']['first_name']);
    }

    // Last name
    if ($field === 'last_name' &&
        isset($_SESSION['signup_data']['last_name'])) {
        $value = htmlspecialchars($_SESSION['signup_data']['last_name']);
    }

    // Username
    if ($field === 'username' &&
        isset($_SESSION['signup_data']['username']) &&
        !isset($_SESSION['errors_signup']['username_taken'])) {
        $value = htmlspecialchars($_SESSION['signup_data']['username']);
    }

    // Email
    if ($field === 'email' &&
        isset($_SESSION['signup_data']['email']) &&
        !isset($_SESSION['errors_signup']['email_used'])) {
        $value = htmlspecialchars($_SESSION['signup_data']['email']);
    }

	//unset($_SESSION['signup_data']);

    return $value;
}
