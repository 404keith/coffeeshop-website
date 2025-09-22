<?php
declare(strict_types=1); //enable type declaration

function get_email(object $pdo, string $email)
{
	$query = "SELECT * FROM users WHERE email = :email;";

	$statement = $pdo->prepare($query);
	$statement->bindParam(':username', $email);
	$statement->execute();

	$result = $statement->fetch(PDO::FETCH_ASSOC);
	return $result;
}

