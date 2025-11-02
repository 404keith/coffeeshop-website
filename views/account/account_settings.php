<?php
require_once APP_ROOT . '/controllers/accountSettingsController.php';
include APP_ROOT . '/views/layouts/header.php';
?>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container my-5">
            <div class="card shadow-none border-0 rounded-3 p-4 p-md-5 mx-auto" style="max-width: 800px;">
                <h2 class="text-center mb-4" style="font-family: campana; color: #d48423; font-size: 4rem;">Account Settings</h2>

                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success_message'] ?>
                        <?php unset($_SESSION['success_message']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error_message'] ?>
                        <?php unset($_SESSION['error_message']); ?>
                    </div>
                <?php endif; ?>

                <ul class="nav nav-tabs" id="accountTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="edit-profile-tab" data-bs-toggle="tab" data-bs-target="#edit-profile" type="button" role="tab" aria-controls="edit-profile" aria-selected="true">Edit Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="edit-address-tab" data-bs-toggle="tab" data-bs-target="#edit-address" type="button" role="tab" aria-controls="edit-address" aria-selected="false">Edit Address</button>
                    </li>
                </ul>

                <div class="tab-content" id="accountTabsContent">
                    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                        <form action="" method="POST" class="mt-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly>
                            </div>

                            <input type="hidden" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                            <input type="hidden" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>">
                            <input type="hidden" name="city" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
                            <input type="hidden" name="zip_code" value="<?= htmlspecialchars($user['zip_code'] ?? '') ?>">

                            <button type="submit" class="btn btn-primary w-100">Save Profile</button>
                        </form>

                        <hr class="my-4">

                        <h4 class="mb-3">Change Password</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            Change Password
                        </button>
                    </div>

                    <div class="tab-pane fade" id="edit-address" role="tabpanel" aria-labelledby="edit-address-tab">
                        <form action="" method="POST" class="mt-4">
                            <input type="hidden" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
                            <input type="hidden" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="zip_code" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?= htmlspecialchars($user['zip_code'] ?? '') ?>">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save Address</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<?php include APP_ROOT . '/views/layouts/footer.php'; ?>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION['change_password_error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['change_password_error'] ?>
                        <?php unset($_SESSION['change_password_error']); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= FILE_ROOT ?>/change-password" method="POST">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Verification Code</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    <?php if (isset($_SESSION['open_change_password_modal']) && $_SESSION['open_change_password_modal']): ?>
        var changePasswordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
        changePasswordModal.show();
        <?php unset($_SESSION['open_change_password_modal']); ?>
    <?php endif; ?>
});
</script>
