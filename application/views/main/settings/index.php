<main>
    <div class="container mt-4">

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 active" aria-current="true" href="<?= base_url('settings'); ?>" style="color: #FF9843; font-weight: 500;">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 text-dark" href="<?= base_url('settings/address'); ?>">Address List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 text-dark" href="<?= base_url('settings/transaction'); ?>">Order List</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?= form_open_multipart('settings/updateImage', ['id' => 'imageUploadForm']); ?>
                        <div class="card card-body mb-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="rounded mb-3 w-auto ratio-1x1">
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <?= form_close(); ?>
                        <button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#changePasmdodal">Change Password</button>
                    </div>
                    <div class="col-md-8">
                        <h5 class="text-start mb-3 mt-3 mt-md-0">Change Profile Info</h5>
                        <div class="mb-2 row py-md-2">
                            <label for="username" class="col-md-3 col-form-label text-start fw-medium py-0">Username</label>
                            <div class="col-md-9">
                                <input type="text" readonly class="form-control-plaintext py-0" id="username" value="<?= $user['username'] ?>">
                            </div>
                        </div>
                        <div class="mb-2 row py-md-2">
                            <label for="fullname" class="col-md-3 col-form-label text-start fw-medium py-0">Full Name</label>
                            <div class="col-md-9 d-flex">
                                <input type="text" readonly class="form-control-plaintext w-auto py-0" id="fullname" value="<?= $user['fullname'] ?>">
                                <button type="button" class="btn btn-link py-0" data-title="Fullname Update Form" data-bs-toggle="modal" data-bs-target="#updateModal" data-field="fullname" data-value="<?= $user['fullname'] ?>">
                                    <i class="fas fa-edit me-2"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-2 row py-md-2">
                            <label for="email" class="col-md-3 col-form-label text-start fw-medium py-0">Email</label>
                            <div class="col-md-9 d-flex">
                                <input type="text" readonly class="form-control-plaintext w-auto py-0" id="email" value="<?= $user['email'] ?>">
                                <button type="button" class="btn btn-link py-0" data-title="Email Update Form" data-bs-toggle="modal" data-bs-target="#updateModal" data-field="email" data-value="<?= $user['email'] ?>">
                                    <i class="fas fa-edit me-2"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-2 row py-md-2">
                            <label for="phone" class="col-md-3 col-form-label text-start fw-medium py-0">Phone Number</label>
                            <div class="col-md-9 d-flex">
                                <input type="text" readonly class="form-control-plaintext w-auto py-0" id="phone" value="<?= $user['phone'] ?>">
                                <button type="button" class="btn btn-link py-0" data-title="Phone Update Form" data-bs-toggle="modal" data-bs-target="#updateModal" data-field="phone" data-value="<?= $user['phone'] ?>">
                                    <i class="fas fa-edit me-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open_multipart('settings'); ?>
                <input type="hidden" id="user_id" name="user_id" value="<?= $user['user_id'] ?>">
                <input type="hidden" id="update_field" name="field">
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="update_value" name="value" placeholder="Enter new value">
                        <label for="update_value">New Value</label>
                        <small class="form-text text-danger" id="value-error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="save-changes" class="btn btn-success">Save changes</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePassModal" tabindex="-1" aria-labelledby="changePassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="changePassModalLabel">Change Password Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('settings/change_pass'); ?>
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
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- JavaScript to handle modal data population and form submission -->
<script>
    const togglePasswordVisibility = (inputId) => {
        const input = $(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    $(document).ready(() => {
        $('#updateModal').on('show.bs.modal', (e) => {
            const button = $(e.relatedTarget);
            const title = button.data('title');
            const field = button.data('field');
            const value = button.data('value');

            $('#updateModalLabel').text(title);
            $('#update_field').val(field);
            $('#update_value').val(value);
        });

        // Auto-submit form on file selection
        const imageInput = $('#image');
        const imageUploadForm = $('#imageUploadForm');

        imageInput.on('change', function() {
            if (this.files.length > 0) {
                imageUploadForm.submit();
            }
        });

    });
</script>