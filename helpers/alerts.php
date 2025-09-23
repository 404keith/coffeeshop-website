<?php

declare(strict_types=1); // Enable strict type declarations


function printFailed(string $message, bool $raw = false): void
{
    echo '<div class="alert alert-danger text-center alert-dismissible fade show popup-alert w-75 mx-auto" role="alert">'
        . ($raw ? $message : htmlspecialchars($message))
        . '</div>';
}

function printSuccess(string $message, bool $raw = false): void
{
    echo '<div class="alert alert-success text-center alert-dismissible fade show popup-alert w-75 mx-auto" role="alert">'
        . ($raw ? $message : htmlspecialchars($message))
        . '</div>';
}


function displayAlertTimeJs($seconds)
{
    $time = $seconds * 1000;
    echo ' <script>
  document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
      document.querySelectorAll(".alert").forEach(alert => {
        let bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      });
    }, ' . $time . '); 
  });
</script>';
}
// ----- CART -------
function printCartAlerts()
{
    if (isset($_SESSION['add_to_cart_error'])) {
        printFailed($_SESSION['add_to_cart_error'], true);
        unset($_SESSION['add_to_cart_error']);
    }

    if (isset($_SESSION['add_to_cart_success'])) {
        printSuccess($_SESSION['add_to_cart_success']);

        unset($_SESSION['add_to_cart_success']);
    }
}


// ---- LOGOUT -----
function logoutAlert(): void
{
    if (isset($_SESSION['logout_success'])) {
        printSuccess($_SESSION['logout_success']);
        unset($_SESSION['logout_success']);
    }
}


// ---- LOGIN AND SIGNUP -------



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
                printFailed($error);
                break;
            }
            printFailed($error);

        }
        unset($_SESSION['errors_login']);

    } elseif (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
        printSuccess('Login Success!');
        unset($_SESSION['login_success']); // clear so it shows only once
    }
}

function displayName()
{
    if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
        echo '<div class="alert alert-success" role="alert">Hello! ' . $_SESSION['user_username'] . '</div>';

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
                printFailed($error);
                break;
            }
            printFailed($error);

        }

        unset($_SESSION['errors_signup']);

    } elseif (isset($_SESSION['signup_success']) && $_SESSION['signup_success'] === true) {
        echo "<br>";
        printSuccess('Sign up success!');
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
        if (
            $field === 'first_name' && isset($_SESSION['signup_data']['first_name'])
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

function forgotPasswordAlert(): void
{

    if (isset($_SESSION['errors_reset'])) {
        $errors = $_SESSION['errors_reset'];

        echo "<br>";

        foreach ($errors as $key => $message) {
            switch ($key) {
                case 'empty_email':
                case 'reset_failed':
                    printFailed($message);
                    break;
            }
        }
        unset($_SESSION['errors_reset']);

    } else if (isset($_SESSION['reset_success']) && $_SESSION['reset_success'] === true) {
        printSuccess('A reset link has been sent to your email!');
        unset($_SESSION['reset_success']);
        unset($_SESSION['errors_reset']);
    }

}


// ------------------------------------------ RESET PASSWORD  ------------------------------------------------------

function resetPasswordAlert(): void
{

    if (isset($_SESSION['errors_reset'])) {
        $errors = $_SESSION['errors_reset'];

        echo "<br>";

        foreach ($errors as $key => $message) {
            switch ($key) {
                case 'password_mismatch':
                case 'empty_password':
                case 'invalid_token':
                    printFailed($message);
                    break 2;

            }
        }
        unset($_SESSION['errors_reset']);


    } else if (isset($_SESSION['reset_success']) && $_SESSION['reset_success'] === 'success') {
        printSuccess('Successfully changed your password, you can log in now!');
        unset($_SESSION['errors_reset']);
        unset($_SESSION['reset_success']);

    }

}



