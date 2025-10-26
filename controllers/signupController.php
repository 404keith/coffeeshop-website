<?php
declare(strict_types=1); //enable type declaration

function is_username_char_allowed(string $username): bool
{
	return (bool) preg_match('/^[a-zA-Z0-9_]+$/', $username);
}

function is_username_length_valid(string $username): bool
{
	$length = strlen($username);
	return $length >= 3 && $length <= 30;
}

function is_password_length_valid(string $password): bool
{
	$length = strlen($password);
	return $length >= 8 && $length <= 64;
}


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

function is_code_correct(string $code)
{
    return isset($_SESSION['verification_code']) && $code === $_SESSION['verification_code'];
}

function create_user(object $pdo, string $first_name, string $last_name, string $username, string $password, string $email)
{
	set_user($pdo, $first_name, $last_name, $username, $password, $email);
}

