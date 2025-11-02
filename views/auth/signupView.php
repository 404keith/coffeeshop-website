<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = trim($_POST['username']);
	$password = $_POST['password'];
	$email = trim($_POST['email']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);

	try {
		require APP_ROOT . '/config/dbhandler.php';
		require APP_ROOT . '/models/signupModel.php';
		require APP_ROOT . '/controllers/signupController.php';

		// ERROR HANDLERS:
		$errors = [];

		// 1. Check for empty fields
		if (is_input_empty($first_name, $last_name, $username, $password, $email)) {
			$errors['empty_input'] = 'Fill in all fields!';
		}

		// 2. Validate email format
		if (is_email_invalid($email)) {
			$errors['invalid_email'] = 'Invalid Email address!';
		}

		// 3. NEW: Validate username character set
		if (!is_username_char_allowed($username)) {
			$errors['invalid_username_char'] = 'Username can only contain letters, numbers, and underscores!';
		}

		// 4. NEW: Validate username length (3 to 30 characters)
		if (!is_username_length_valid($username)) {
			$errors['invalid_username_length'] = 'Username must be between 3 and 30 characters long!';
		}

		// 5. NEW: Validate password length (8 to 64 characters)
		if (!is_password_length_valid($password)) {
			$errors['invalid_password_length'] = 'Password must be between 8 and 64 characters long!';
		}

		// Only check for DB conflicts if basic validation passed
		if (!$errors) {
			if (is_username_taken($pdo, $username)) {
				$errors['username_taken'] = 'Username already taken!';
			}
			if (is_email_registered($pdo, $email)) {
				$errors['email_used'] = 'Email already used!';
			}
		}

        require_once APP_ROOT . '/controllers/emailController.php';
		if ($errors) {
			$_SESSION['errors_signup'] = $errors;

			// save signup data even refreshed
			$signupData = [
				'username' => $username,
				'email' => $email,
				'first_name' => $first_name,
				'last_name' => $last_name,
			];
			$_SESSION['signup_data'] = $signupData;

			header('Location: ' . FILE_ROOT . '/signup');
			die();
		}

		        require_once APP_ROOT . '/controllers/emailController.php';
		
		        // Generate and send verification code
		        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
		        $_SESSION['verification_code'] = $code;
		        $_SESSION['verification_tries'] = 0;
		
		        send_verification_email($email, $code);
		
		        // Save signup data and redirect to verification page
		        $signupData = [
		            'username' => $username,
		            'password' => $password, // Note: Storing password in session is not recommended for production
		            'email' => $email,
		            'first_name' => $first_name,
		            'last_name' => $last_name,
		        ];
		        $_SESSION['signup_data'] = $signupData;
		
		        header('Location: ' . FILE_ROOT . '/verify-signup');
		        die();
	} catch (PDOException $e) {
		// Log the error for debugging, but show a generic message to the user
		error_log('Query Failed: ' . $e->getMessage());
		die('A database error occurred. Please try again later.');
	}

} else {
	header('Location: ' . APP_ROOT . '/public/index.php');

	die();
}
