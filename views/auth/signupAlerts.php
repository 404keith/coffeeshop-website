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


function signupInputs(){
//first name and last name
	if (isset($_SESSION['signup_data']['first_name']) &&
			 !isset($_SESSION['errors_signup']['username_taken'])) {

			echo '
				<div class="row mb-4 ">
					<div class="col d-flex justify-content-center ">
					
						<div data-mdb-input-init class="form-outline  ">
							<input type="text"
							<input type="text"
						value="'.htmlspecialchars($_SESSION['signup_data']['first_name']).'"
						name="first_name" class="form-control" />
							<label class="form-label" for="first_name">First name</label>
						</div>
					</div>

					
			';
			
		} else {
			echo '
				<div class="row mb-4 ">
					<div class="col d-flex justify-content-center ">
					
						<div data-mdb-input-init class="form-outline  ">
							<input type="text" name="first_name" class="form-control" />
							<label class="form-label" for="first_name">First name</label>
						</div>
					</div>

					
			';
		}

//last name
		if (isset($_SESSION['signup_data']['last_name']) &&
			 !isset($_SESSION['errors_signup']['username_taken'])) {
 
				echo '<div class="col d-flex justify-content-center">
					
						<div data-mdb-input-init class="form-outline ">
							<input type="text"
								value="'.htmlspecialchars($_SESSION['signup_data']['last_name']).'" 
							name="last_name" class="form-control" />
							<label class="form-label" for="last_name">Last name</label>
						</div>
					</div>
					</div>';
			 } else {
				echo '<div class="col d-flex justify-content-center">
					
						<div data-mdb-input-init class="form-outline ">
							<input type="text" name="last_name" class="form-control" />
							<label class="form-label" for="last_name">Last name</label>
						</div>
					</div>
					</div>';
			 }

	//username:
		if (isset($_SESSION['signup_data']['username']) &&
			 !isset($_SESSION['errors_signup']['username_taken'])) {

			echo '
				  <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="text" 
						value="'.htmlspecialchars($_SESSION['signup_data']['username']).'" 
				name="username" class="form-control" />
                <label class="form-label" for="username">Username</label>
        	    </div>
				';
			
		} else {
				echo '
				  <div data-mdb-input-init class="form-outline mb-4 ">
                <input type="text" name="username" class="form-control" />
                <label class="form-label" for="username">Username</label>
        	    </div>
				';	
		}

		//password:
		 echo '<div data-mdb-input-init class="form-outline mb-4">
                <input type="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
           		 </div>';

		//email
		if (isset($_SESSION['signup_data']['email']) &&
				 !isset($_SESSION['errors_signup']['email_used']) 

			 
			) 

		 {

				echo '   <div data-mdb-input-init class="form-outline mb-4 ">
						<input type="email" 
							value="'.htmlspecialchars($_SESSION['signup_data']['email']).'" 
						name="email" class="form-control" />
						<label class="form-label" for="email">Email</label>
						</div>';
			} else {
				
				echo '   <div data-mdb-input-init class="form-outline mb-4 ">
						<input type="email" name="email" class="form-control" />
						<label class="form-label" for="email">Email</label>
						</div>';
			}

	unset($_SESSION['signup_data']);
}