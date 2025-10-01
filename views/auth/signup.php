<?php
require_once 'config/config.php';
require_once APP_ROOT . '/config/session.php';
include APP_ROOT . '/views/layouts/header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/signup.css" />
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">

        <div class="container-fluid d-flex justify-content-center">
            <!-- ACTION UPDATED to point to the correct controller file -->
            <form class="p-5 form-width" action="<?= FILE_ROOT ?>/signupView" method="post">

                <div class="form-padding">
                    <div>
                        <h1 class="welcome-text">Sign up</h1>
                    </div>

                    <h1 class="login-text">Please enter the details below:</h1>

                    <!-- First and Last Name -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" value="<?= signupInput('first_name') ?>" name="first_name"
                                    class="form-control" required />
                                <label class="form-label" for="first_name">First name</label>
                            </div>
                        </div>

                        <div class="col d-flex justify-content-center">
                            <div data-mdb-input-init class="form-outline">
                                <input type="text" value="<?= signupInput('last_name') ?>" name="last_name"
                                    class="form-control" required />
                                <label class="form-label" for="last_name">Last name</label>
                            </div>
                        </div>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" value="<?= signupInput('email') ?>" name="email" class="form-control"
                            required />
                        <label class="form-label" for="email">Email</label>
                    </div>

                    <!-- Username input: Added HTML5 validation for char and length -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" value="<?= signupInput('username') ?>" name="username" class="form-control"
                            minlength="3" maxlength="30" pattern="[a-zA-Z0-9_]+"
                            title="Username must be 3-30 characters long and contain only letters, numbers, and underscores."
                            required />
                        <label class="form-label" for="username">Username (3-30 chars, A-z, 0-9, _)</label>
                    </div>

                    <!-- Password input with Show/Hide Toggle -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" name="password" id="passwordInput" class="form-control" minlength="8"
                            maxlength="64" title="Password must be 8-64 characters long." required />
                        <label class="form-label" for="passwordInput">Password (8-64 characters)</label>
                        <!-- Toggle button positioned inside the form-outline. -->
                        <span class="input-group-text position-absolute end-0 top-0 bottom-0 cursor-pointer"
                            style="border: none; background: transparent; padding-right: 15px;"
                            onclick="togglePasswordVisibility()">
                            <i id="togglePasswordIcon" class="fas fa-eye"></i>
                        </span>
                    </div>


                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Already signed up? <a href="/login">Login here</a></p>
                    </div>


                </div>

            </form>
        </div>
    </main>
</body>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>

</html>