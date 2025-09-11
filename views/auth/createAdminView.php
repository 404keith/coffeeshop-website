<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $username = $_POST['username'];
 $password = $_POST['password'];
 $first_name = $_POST['first_name'];
 $last_name = $_POST['last_name'];
 $email = $_POST['email'];

 try {
            require APP_ROOT .'/config/dbhandler.php';
			require APP_ROOT .'/models/signupModel.php';
			require APP_ROOT .'/controllers/signupController.php';

   //ERROR HANDLERS:
	 // functions in controller file
	     $errors = [];
	   if (is_input_empty($first_name, $last_name, $username, $password, $email)){
			$errors['empty_input'] = 'Fill in all fields!';
	   }


		 if (is_username_taken($pdo,$username)) {
		  	 $errors['username_taken'] = 'Username already taken!';
		 }
	


		  require_once APP_ROOT .  '/config/session.php'; 


		 if ($errors) {
			 $_SESSION['errors_signup'] = $errors;

				$signupData = [  // save signup data even refreshed
					'username'   => $username !== '' ? trim($username) : null,
					'first_name' => $first_name !== '' ? trim($first_name) : null,
					'last_name'  => $last_name !== '' ? trim($last_name) : null,
				];
				 $_SESSION['signup_data'] = $signupData;
		


		     header ('Location: '.FILE_ROOT.'/createAdmin');


				die(); 
		 }

		 set_admin( $pdo,  $first_name,  $last_name,  $email, $username, $password);

		 //done:
				$_SESSION['signup_success'] = true;
		 
			 	header ('Location: '.FILE_ROOT.'/createAdmin');

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
