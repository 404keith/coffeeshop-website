<?php
declare(strict_types=1); //enable type declaration

function signup_inputs()
{
	//username
	if (
		isset($_SESSION['signup_data']['username']) &&
		!isset($_SESSION['errors_signup']['username_taken'])
	) {

		echo '<input type="text" name="username" placeholder="Enter username"
			 	value="' . $_SESSION['signup_data']['username'] . '">';
	} else {
		echo '<input type="text" name="username" placeholder="Enter username">';
	}

	//password
	echo '<input type="password" name="password" placeholder="Enter password">';

	//email
	if (
		isset($_SESSION['signup_data']['email']) &&
		!isset($_SESSION['errors_signup']['email_used']) &&
		!isset($_SESSION['errors_signup']['invalid_email'])
	) {

		echo '<input type="email" name="email" placeholder="Enter email"
				value="' . $_SESSION['signup_data']['email'] . '">';
	} else {
		echo '	<input type="email" name="email" placeholder="Enter email">';
	}

}


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
	} else if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
		echo "<br>";
		echo '<div class="alert alert-success" role="alert"> Sign-up Success!</div>';
	}
}
