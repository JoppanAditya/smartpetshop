<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <!-- Element untuk menampilkan pesan alert -->
        <?= $this->session->flashdata('message'); ?>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Users Data
                </div>
                <div>
                    <!-- Add Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-plus me-1"></i>
                        Add New User
                    </button>

                    <!-- Add Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addUserModalLabel">Add User Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3 form-floating">
                                            <input type="text" class="form-control" id="add_user_fullname" name="fullname" placeholder="Full name">
                                            <label for="add_user_fullname">Full name</label>
                                            <small class="form-text text-danger" id="fullname-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="text" class="form-control" id="add_user_username" name="username" placeholder="Username">
                                            <label for="add_user_username">Username</label>
                                            <small class="form-text text-danger" id="username-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="text" class="form-control" id="add_user_email" name="email" placeholder="Email">
                                            <label for="add_user_email">Email address</label>
                                            <small class="form-text text-danger" id="email-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="text" class="form-control" id="add_user_phone" name="phone" placeholder="Phone number">
                                            <label for="add_user_phone">Phone number</label>
                                            <small class="form-text text-danger" id="phone-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <select class="form-select" name="user_level" id="add_user_level">
                                                <option selected disabled value="">Select one</option>
                                                <?php foreach ($user_level as $ul) : ?>
                                                    <option value="<?= $ul['level_id']; ?>"><?= $ul['level_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="add_user_level">User level</label>
                                            <small class="form-text text-danger" id="level_id-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="password" class="form-control" id="add_user_password" name="password" placeholder="Password">
                                            <label for="add_user_password">Password</label>
                                            <small class="form-text text-danger" id="password-error"></small>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" id="save-add-user" class="btn btn-success">Add User</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($users as $u) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $u['fullname']; ?></td>
                                <td><?= $u['username']; ?></td>
                                <td><?= $u['email']; ?></td>
                                <td><?= $u['level_name']; ?></td>
                                <td><img class="rounded" src="<?= base_url('assets/img/profile/') . $u['image']; ?>" alt="<?= $u['fullname']; ?> Photo Profile" height="100" width="100"></td>
                                <td><?php if ($u['is_active'] == 1) : ?>
                                        Active <?php else : ?>
                                        Not Active
                                    <?php endif; ?></td>
                                <td><?= date('F d, Y', $u['date_created']); ?></td>
                                <td>
                                    <!-- Detail Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-primary" data-id="<?= $u['user_id']; ?>" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>

                                    <!-- Update Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-warning" data-id="<?= $u['user_id']; ?>" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>

                                    <!-- Delete Button trigger modal -->
                                    <?php if ($u['username'] == 'admin') : ?>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" disabled>
                                            <i class="fas fa-trash-alt me-2"></i>Delete
                                        </button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fas fa-trash-alt me-2"></i>Delete
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">User Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>User Id:</strong></p>
                        <p id="detail-user-id"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Full Name:</strong></p>
                        <p id="detail-user-fullname"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Username:</strong></p>
                        <p id="detail-user-username"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Email:</strong></p>
                        <p id="detail-user-email"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Phone Number:</strong></p>
                        <p id="detail-user-phone"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Password:</strong></p>
                        <p class="text-break" id="detail-user-password"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Level Id:</strong></p>
                        <p id="detail-user-level"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Photo:</strong></p>
                        <p id="detail-user-photo"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Active:</strong></p>
                        <p id="detail-user-active"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Date Created:</strong></p>
                        <p id="detail-user-created"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary px-5" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                    <p>This action can't be undone</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(<?= $u['user_id'] ?>)">Yes, Delete It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update User Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_user_username" name="username" placeholder="Username" disabled>
                            <label for="update_user_username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_user_fullname" name="fullname" placeholder="Full name">
                            <label for="update_user_fullname">Full name</label>
                            <small class="form-text text-danger" id="update-fullname-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_user_email" name="email" placeholder="Email address">
                            <label for="update_user_email">Email address</label>
                            <small class="form-text text-danger" id="update-email-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="update_user_password" name="password" placeholder="Password">
                            <label for="update_user_password">Password</label>
                            <small class="form-text text-danger" id="update-password-error"></small>
                            <button type="button" class="btn position-absolute end-0 top-0 p-3" onclick="togglePasswordVisibility('update_user_password')"><i class="fas fa-eye"></i></button>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_user_phone" name="phone" placeholder="Phone number">
                            <label for="update_user_phone">Phone number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="user_level" id="update_user_level">
                                <option selected disabled value="">Select one</option>
                                <?php foreach ($user_level as $ul) : ?>
                                    <?php if ($ul['user_id'] == $u['user_id']) : ?>
                                        <option value="<?= $ul['level_id']; ?>" selected><?= $ul['level_name']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $ul['level_id']; ?>"><?= $ul['level_name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label for="update_user_level">User level</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <select class="form-select" name="is_active" id="update_user_active">
                                <?php foreach ($isActive as $a) : ?>
                                    <?php if ($a == $sm['is_active']) : ?>
                                        <option value="<?= $a; ?>" selected>
                                            <?php if ($a == 1) : ?>
                                                Active
                                            <?php else : ?>
                                                Not Active
                                            <?php endif; ?>
                                        </option>
                                    <?php else : ?>
                                        <option value="<?= $a; ?>">
                                            <?php if ($a == 1) : ?>
                                                Active
                                            <?php else : ?>
                                                Not Active
                                            <?php endif; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label for="update_user_active">Is Active?</label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="save-changes" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- JavaScript to handle modal data population -->
<script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Handle detail modal
        const detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            // Clear previous data
            document.getElementById('detail-user-id').textContent = '';
            document.getElementById('detail-user-fullname').textContent = '';
            document.getElementById('detail-user-username').textContent = '';
            document.getElementById('detail-user-email').textContent = '';
            document.getElementById('detail-user-phone').textContent = '';
            document.getElementById('detail-user-password').textContent = '';
            document.getElementById('detail-user-level').textContent = '';
            document.getElementById('detail-user-photo').textContent = '';
            document.getElementById('detail-user-active').textContent = '';
            document.getElementById('detail-user-created').textContent = '';

            // Fetch user details using AJAX
            fetch('<?= base_url('user/getUserDetail/') ?>' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-user-id').textContent = data.user_id;
                    document.getElementById('detail-user-fullname').textContent = data.fullname;
                    document.getElementById('detail-user-username').textContent = data.username;
                    document.getElementById('detail-user-email').textContent = data.email;
                    document.getElementById('detail-user-phone').textContent = data.phone;
                    document.getElementById('detail-user-password').textContent = data.password;
                    document.getElementById('detail-user-level').textContent = data.level_id;
                    document.getElementById('detail-user-photo').textContent = data.image;
                    document.getElementById('detail-user-active').textContent = data.is_active;
                    document.getElementById('detail-user-created').textContent = new Date(data.date_created * 1000).toLocaleDateString('en-US', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                })
                .catch(error => console.error('Error fetching user details:', error));
        });

        // Handle add submenu
        document.getElementById('save-add-user').addEventListener('click', function() {
            const username = document.getElementById('add_user_username').value;
            const fullname = document.getElementById('add_user_fullname').value;
            const email = document.getElementById('add_user_email').value;
            const phone = document.getElementById('add_user_phone').value;
            const level = document.getElementById('add_user_level').value;
            const password = document.getElementById('add_user_password').value;

            fetch('<?= base_url('user/addUser') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username: username,
                        fullname: fullname,
                        email: email,
                        password: password,
                        phone: phone,
                        level_id: level
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text)
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Clear any previous error messages
                    document.getElementById('username-error').textContent = '';
                    document.getElementById('fullname-error').textContent = '';
                    document.getElementById('email-error').textContent = '';
                    document.getElementById('password-error').textContent = '';
                    document.getElementById('level_id-error').textContent = '';

                    if (data.error) {
                        if (data.errors) {
                            for (let field in data.errors) {
                                if (data.errors.hasOwnProperty(field)) {
                                    document.getElementById(`${field}-error`).textContent = data.errors[field];
                                }
                            }
                        }
                    } else {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error adding user:', error);
                });
        });

        // Handle update modal
        const updateModal = document.getElementById('updateModal');
        updateModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            // Clear previous data
            document.getElementById('update_user_fullname').value = '';
            document.getElementById('update_user_username').value = '';
            document.getElementById('update_user_email').value = '';
            document.getElementById('update_user_phone').value = '';
            document.getElementById('update_user_level').value = '';
            document.getElementById('update_user_active').value = '';

            // Fetch user details using AJAX
            fetch('<?= base_url('user/getUserDetail/') ?>' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user_id').value = data.user_id;
                    document.getElementById('update_user_fullname').value = data.fullname;
                    document.getElementById('update_user_username').value = data.username;
                    document.getElementById('update_user_email').value = data.email;
                    document.getElementById('update_user_phone').value = data.phone;
                    document.getElementById('update_user_level').value = data.level_id;
                    document.getElementById('update_user_active').value = data.is_active;
                })
                .catch(error => console.error('Error fetching user details:', error));
        });

        // Handle save changes button click
        document.getElementById('save-changes').addEventListener('click', function() {
            const id = document.getElementById('user_id').value;
            const fullname = document.getElementById('update_user_fullname').value;
            const email = document.getElementById('update_user_email').value;
            const password = document.getElementById('update_user_password').value;
            const phone = document.getElementById('update_user_phone').value;
            const level = document.getElementById('update_user_level').value;
            const active = document.getElementById('update_user_active').value;

            // Debugging log
            console.log("Sending data:", {
                id,
                fullname,
                email,
                password,
                phone,
                level,
                active
            });

            fetch('<?= base_url('user/updateUser/') ?>' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        user_id: id,
                        fullname: fullname,
                        email: email,
                        password: password,
                        phone: phone,
                        level_id: level,
                        is_active: active
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        if (data.errors) {
                            for (let field in data.errors) {
                                if (data.errors.hasOwnProperty(field)) {
                                    document.getElementById(`update-${field}-error`).textContent = data.errors[field];
                                }
                            }
                        }
                    } else {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error updating user:', error));
        });
    });

    function confirmDelete(userId) {
        window.location.href = '<?= base_url('user/deleteUser/') ?>' + userId;
    }
</script>