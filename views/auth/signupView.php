<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $username = $_POST['username'];
 $password = $_POST['password'];
 $email = $_POST['email'];
 $first_name = $_POST['first_name'];
 $last_name = $_POST['last_name'];

 try {
            require APP_ROOT .'/config/dbhandler.php';
			require APP_ROOT .'/models/signupModel.php';
			require APP_ROOT .'/controllers/signupController.php';

   //ERROR HANDLERS:
	 // functions in controller file
	     $errors = [];
	   if (is_input_empty($username, $password, $email)){
				$errors['empty_input'] = 'Fill in all fields!';
	   }

		 if ( is_email_invalid($email)) {
			 $errors['invalid_email'] = 'Invalid Email adress!';
		 }

		 if (is_username_taken($pdo,$username)) {
		  	 $errors['username_taken'] = 'Username already taken!';
		 }
		 if (is_email_registered($pdo, $email)) {
		 	  $errors['email_used'] = 'Email already used!';
		 }


		  require_once APP_ROOT .  '/config/session.php'; 


		 if ($errors) {
			 $_SESSION['errors_signup'] = $errors;

				$signupData = [  // save signup data even refreshed
					'username'   => $username !== '' ? trim($username) : null,
					'email'      => $email !== '' ? trim($email) : null,
					'first_name' => $first_name !== '' ? trim($first_name) : null,
					'last_name'  => $last_name !== '' ? trim($last_name) : null,
				];
				 $_SESSION['signup_data'] = $signupData;

			 	header ('Location: '.FILE_ROOT.'/views/auth/signup.php');

				die(); 
		 }

		 create_user( $pdo,  $username,  $password,  $email, $first_name, $last_name );

		 //done:
		 
			 	header ('Location: '.FILE_ROOT.'/views/auth/signup.php?signup=success');	//in view, $_GET['signup']=success

		 $pdo = null;
		 $statement = null;
		 die();

 } catch (PDOException $e) {
   die('Query Failed: '. $e->getMessage());
 }


} else {
 	header ('Location: '.APP_ROOT.'/public/index.php');

 die();
}
