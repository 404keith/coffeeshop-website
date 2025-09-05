<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST['username'];
	   $password = $_POST['password'];

		try {
		   require APP_ROOT .'/config/dbhandler.php';
			require APP_ROOT .'/models/loginModel.php';
			require APP_ROOT .'/controllers/loginController.php';

			//ERROR HANDLERS:
			// functions in CONTROLLER file
					$errors = [];
				if (is_input_empty($username, $password)){
					 $errors['empty_input'] = 'Fill in all fields!';
				}

		  	$result = get_user($pdo, $username);

				if (is_username_wrong($result)) {
						$errors['login_incorrect'] = 'Incorrect login info!';
				}

				if (!is_username_wrong($result) &&
				     is_password_wrong($password, $result['pswd'])) {
					   $errors['login_incorrect'] = 'Incorrect login info!';
				}

			     // start session i used session.php for more security
			   require_once '../../config/session.php';
			

				if ($errors) { 
					$_SESSION['errors_login'] = $errors;
					 	header ('Location: '.URL_ROOT.'/views/auth/login.php');
					    die(); 
				}

				$newSessionId = session_create_id();
				$sessionId = $newSessionId . "_" .$result['id'];
				session_id($sessionId);

				$_SESSION['user_id'] = $result['id'];
				$_SESSION['user_username'] = htmlspecialchars($result['username']);

			  $_SESSION['last_regeneration'] = time(); //reset time

				header('Location: '.URL_ROOT.'/views/auth/login.php?login=success');  // login sucess,  close script or end
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


