<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <div class="card mb-4 col-5 mx-auto">
            <div class="card-body d-flex flex-column justify-content-center gap-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="<?= base_url('profile'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div>
                        <h3>Change Password</h3>
                    </div>
                    <div class="btn-group px-4">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" hidden>
                            <i class="fas fa-gear"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="<?= base_url('profile/edit'); ?>" class="dropdown-item" type="button"><i class="fas fa-user-edit me-2"></i>Edit Profile</a></li>
                            <li><a href="<?= base_url('profile/change_pass'); ?>" class="dropdown-item" type="button"><i class="fas fa-edit me-2"></i>Change Password</a></li>
                        </ul>
                    </div>
                </div>

                <div>
                    <?= form_open_multipart('profile/change_pass'); ?>
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="current_password" placeholder="Current password" name="current_password">
                        <label for="current_password">Current password</label>
                        <?= form_error('current_password', '<small class="text-danger p-2">', '</small>'); ?>
                        <button type="button" class="btn position-absolute end-0 top-0 p-3" onclick="togglePasswordVisibility('current_password')"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="new_password1" placeholder="New password" name="new_password1">
                        <label for="new_password1">New password</label>
                        <?= form_error('new_password1', '<small class="text-danger p-2">', '</small>'); ?>
                        <button type="button" class="btn position-absolute end-0 top-0 p-3" onclick="togglePasswordVisibility('new_password1')"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="new_password2" placeholder="Repeat new password" name="new_password2">
                        <label for="new_password2">Repeat new password</label>
                        <?= form_error('new_password2', '<small class="text-danger p-2">', '</small>'); ?>
                        <button type="button" class="btn position-absolute end-0 top-0 p-3" onclick="togglePasswordVisibility('new_password2')"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4 py-2">Save Changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>