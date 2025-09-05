<?php
// for interacting w/ DATABASE

declare (strict_types=1); //enable type declaration

function get_username(object $pdo, string $username){
	$query = "SELECT username FROM users WHERE username = :username;";

	$statement = $pdo-> prepare ($query);
	$statement -> bindParam(':username' , $username);
	$statement -> execute();

	$result = $statement -> fetch(PDO::FETCH_ASSOC);

	return $result;
}


function get_email(object $pdo, string $email){
	$query = "SELECT email FROM users WHERE email = :email;";

	$statement = $pdo-> prepare ($query);
	$statement -> bindParam(':email' , $email);
	$statement -> execute();

	$result = $statement -> fetch(PDO::FETCH_ASSOC);

	return $result;
}

 function set_user(object $pdo, string $username, string $password, string $email, string $first_name, string $last_name)
 {
	 $query = "INSERT INTO users (username, pswd, email, first_name, last_name) VALUES (:username, :password, :email, :first_name, :last_name)";
 	$statement = $pdo-> prepare ($query);

	$options = [ 'cost' => 12 ];
	$hashedPassword = password_hash ($password, PASSWORD_BCRYPT, $options);

	$statement -> bindParam(':username' , $username);
	$statement -> bindParam(':password' , $hashedPassword);
 	$statement -> bindParam(':email' , $email);
 	$statement -> bindParam(':first_name' , $first_name);
 	$statement -> bindParam(':last_name' , $last_name);
 	$statement -> execute();

 }
