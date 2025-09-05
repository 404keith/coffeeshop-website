<?php
//used for communication to DATABASE (MYSQL)
declare (strict_types=1); // for putting datatype in parameters

function get_user(object $pdo, string $username){
	$query = "SELECT * FROM users WHERE username = :username;";

	$statement = $pdo-> prepare ($query);
	$statement -> bindParam(':username' , $username);
	$statement -> execute();

	$result = $statement -> fetch(PDO::FETCH_ASSOC);
	return $result;
}
