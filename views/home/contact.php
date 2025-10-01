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

    <style>

        body {
  background-image: url("../images/login-background.png");
  background-color: #fae5cc;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.container-fluid.d-flex.justify-content-center {
  flex-grow: 1;
}

.form-width {
  max-width: 600px;
  width: 100%;
  height: auto;
  border-radius: 3rem;
  background-color: #fff6eb;
  margin: 3rem auto 5rem;
}

.form-outline .form-control:focus ~ .form-label {
  color: #d48423;
}

.form-outline .form-control:focus {
  background-color: #fff6eb;
  border: 1px solid #d48423;
}

.form-check-input:checked {
  background-color: #d48423 !important;
  border-color: #d48423 !important;
}

.btn-primary {
  background-color: #d48423 !important;
  border-color: #d48423 !important;
}

.btn-primary:hover {
  background-color: #c3680b !important;
  border-color: #c3680b !important;
}

.text-center a {
  color: #d48423;
  text-decoration: none;
}

.text-center a:hover {
  color: #c3680b;
  text-decoration: underline;
}

.form-padding {
  padding-top: 6rem;
  padding-left: 6rem;
  padding-right: 6rem;
}

.alert {
  text-align: center;
}

.welcome-text {
  color: #d48423;
  text-align: center;
  font-size: 5rem;
  font-family: campana;
  margin: -4rem 1.3rem 0 0;
  padding-bottom: 1rem;
}

.login-text {
  color: #c3680b;
  font-size: 15px;
  font-family: inter;
  font-weight: bolder;
  text-align: center;
  margin-top: -1.5rem;
  margin-bottom: 1.5rem;
}

    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">

        <div class="container-fluid d-flex justify-content-center">
            <form class="p-5 form-width" action="<?= FILE_ROOT ?>/contactSubmit" method="post">

                <div class="form-padding">
                    <div>
                        <h1 class="welcome-text">Contact Us</h1>
                    </div>

                    <h1 class="login-text">We’d love to hear from you!</h1>

                    <!-- Name -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <div class="form-outline">
                                <input type="text" name="name" class="form-control" required />
                                <label class="form-label" for="name">Full Name</label>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-outline mb-4">
                        <input type="email" name="email" class="form-control" required />
                        <label class="form-label" for="email">Email</label>
                    </div>

                    <!-- Subject -->
                    <div class="form-outline mb-4">
                        <input type="text" name="subject" class="form-control" required />
                        <label class="form-label" for="subject">Subject</label>
                    </div>

                    <!-- Message -->
                    <div class="form-outline mb-4">
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                        <label class="form-label" for="message">Your Message</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Send Message</button>

                    <!-- Extra Info -->
                    <div class="text-center">
                        <p>Or reach us at <a href="mailto:support@yourcompany.com">mondaymornings.test123@gmail.com</a></p>
                    </div>

                </div>

            </form>
        </div>
    </main>
</body>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>
