<?php
include APP_ROOT . '/views/layouts/header.php';
?>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container my-5">
            <div class="card shadow-lg border-0 rounded-3 p-4 p-md-5 mx-auto" style="max-width: 500px;">
                <h2 class="text-center mb-4 fw-bold">Verify Password Change</h2>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error_message'] ?>
                        <?php unset($_SESSION['error_message']); ?>
                    </div>
                <?php endif; ?>

                <p>A verification code has been sent to your email. Please enter the code below to complete your password change.</p>

                <form action="<?= FILE_ROOT ?>/verify-password-change" method="POST">
                    <div class="mb-3">
                        <label for="verification_code" class="form-label">Verification Code</label>
                        <input type="text" class="form-control" id="verification_code" name="verification_code" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Verify and Change Password</button>
                </form>
            </div>
        </div>
    </main>
</body>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>
