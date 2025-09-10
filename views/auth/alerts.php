<?php

declare(strict_types=1); // Enable strict type declarations


// ------------------------------------------ LOGIN  ------------------------------------------------------
function output_username(): void
{
    if (isset($_SESSION['user_id'])) {
        echo "You are logged in as " . $_SESSION['user_username'];
    } else {
        echo "You are not logged in";
    }
}

function check_login_errors(): void
{
    
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        echo "<br>";

        foreach ($errors as $error) {
            if ($error === 'Fill in all fields!') {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                break;
            }
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
        unset($_SESSION['errors_login']);
        
    } elseif (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
        echo '<div class="alert alert-success" role="alert">Login Success!</div>';
        //unset($_SESSION['login_success']); // clear so it shows only once
    }    
}

function displayName (){
    if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
        echo '<div class="alert alert-success" role="alert">Hello! '.$_SESSION['user_username'].'</div>';
        
    }    
}

// ------------------------------------------ SIGNUP  ------------------------------------------------------

function check_signup_errors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            if ($error === 'Fill in all fields!') {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                break;
            }
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }

        unset($_SESSION['errors_signup']);

    } elseif (isset($_SESSION['signup_success']) && $_SESSION['signup_success'] === true) {
        echo "<br>";
        echo '<div class="alert alert-success" role="alert">Sign-up Success!</div>';
        unset($_SESSION['signup_success']);
    }
}

         
function signupInput($field): string
{
    $value = '';

    if (isset($_SESSION['signup_success']) && $_SESSION['signup_success'] === true) {
        unset($_SESSION['signup_data']);
    } else {
        // First name
        if ($field === 'first_name' && isset($_SESSION['signup_data']['first_name'])
            // && !isset($_SESSION['errors_signup']['empty_input'])
        ) {
            $value = htmlspecialchars($_SESSION['signup_data']['first_name']);
        }

        // Last name
        if ($field === 'last_name' && isset($_SESSION['signup_data']['last_name'])) {
            $value = htmlspecialchars($_SESSION['signup_data']['last_name']);
        }

        // Username
        if (
            $field === 'username' &&
            isset($_SESSION['signup_data']['username']) &&
            !isset($_SESSION['errors_signup']['username_taken'])
        ) {
            $value = htmlspecialchars($_SESSION['signup_data']['username']);
        }

        // Email
        if (
            $field === 'email' &&
            isset($_SESSION['signup_data']['email']) &&
            !isset($_SESSION['errors_signup']['email_used'])
        ) {
            $value = htmlspecialchars($_SESSION['signup_data']['email']);
        }
    }

    return $value;
}



// ------------------------------------------ FORGOT PASSWORD  ------------------------------------------------------

function check_input_errors(): void
{
    
    if (isset($_SESSION['errors_reset'])) {
        $errors = $_SESSION['errors_reset'];

        echo "<br>";

        foreach ($errors as $error) {
            if ($error === 'Email field cannot be empty!') {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                break;
            }
            if ($error === 'Reset request failed!') {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
        }
        unset($_SESSION['errors_reset']);
        
    } elseif (isset($_SESSION['reset_success']) && $_SESSION['reset_success'] === true) {
        echo '<div class="alert alert-success" role="alert">a reset link has been sent to your email!</div>';
                unset($_SESSION['reset_success']);

    }    
}


// ------------------------------------------ RESET PASSWORD  ------------------------------------------------------
