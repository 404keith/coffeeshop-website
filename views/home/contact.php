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
    <link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/contact.css" />
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
                    <div class="text-center bottom-text">
                        <p>Or reach us at <a href="mailto:support@yourcompany.com">mondaymornings.test123@gmail.com</a>
                        </p>
                    </div>

                </div>

            </form>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize MDBootstrap form components
            document.querySelectorAll('.form-outline').forEach((formOutline) => {
                new mdb.Input(formOutline).init();
            });
        });
    </script>
</body>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>