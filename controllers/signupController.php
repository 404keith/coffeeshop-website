<?php
declare(strict_types=1); //enable type declaration

function is_input_empty(string $first_name, string $last_name, string $username, string $password, string $email)
{
	if (empty($first_name) || empty($last_name) || empty($username) || empty($password) || empty($email)) {
		return true;
	} else {
		return false;
	}
}


function is_email_invalid(string $email)
{
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

function is_username_taken(object $pdo, string $username)
{
	if (get_username($pdo, $username)) {
		return true;
	} else {
		return false;
	}
}


function is_email_registered(object $pdo, string $email)
{
	if (get_email($pdo, $email)) {
		return true;
	} else {
		return false;
	}
}

function create_user(object $pdo, string $first_name, string $last_name, string $username, string $password, string $email)
{
	set_user($pdo, $first_name, $last_name, $username, $password, $email);
}

