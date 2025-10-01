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
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/login.css" />
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <!-- <div class="background-img"></div> -->

        <div class="container-fluid d-flex justify-content-center">

            <form class="p-5 form-width" action="<?= FILE_ROOT ?>/loginView" method="post">
                <div class="form-padding">

                    <div>
                        <h1 class="welcome-text">Welcome</h1>
                    </div>

                    <h1 class="login-text">Login</h1>

                    <!-- Username input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" name="username" class="form-control" />
                        <label class="form-label" for="username">Username</label>
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" name="password" id="passwordInput" class="form-control" />
                        <label class="form-label" for="passwordInput">Password</label>
                        <!-- Toggle button positioned inside the form-outline. -->
                        <span class="input-group-text position-absolute end-0 top-0 bottom-0 cursor-pointer"
                            style="border: none; background: transparent; padding-right: 15px;"
                            onclick="togglePasswordVisibility()">
                            <i id="togglePasswordIcon" class="fas fa-eye"></i>
                        </span>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-2">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form2Example34" />
                                <label class="form-check-label" for="form2Example34">Remember me</label>
                            </div> -->
                        </div>

                        <div class="text-center mb-2">
                            <!-- Simple link -->
                            <a href="/forgot">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                        Sign in
                    </button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Not yet registered? <a href="/signup">Register here</a></p>
                    </div>



                </div> <!-- /.form-padding -->
            </form>

        </div>
    </main>
</body>

</html>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>