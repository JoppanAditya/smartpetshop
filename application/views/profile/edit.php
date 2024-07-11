<main>
    <div class="container-fluid px-4 mt-4">
        <div class="card mb-4 col-5 mx-auto">
            <div class="card-body d-flex flex-column justify-content-center gap-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="<?= base_url('profile'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div>
                        <h3>Edit Profile</h3>
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
                    <?= form_open_multipart('profile/edit'); ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= $user['username'] ?>" readonly>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="fullname" placeholder="Full name" name="fullname" value="<?= $user['fullname'] ?>">
                        <label for="fullname">Full name</label>
                        <?= form_error('fullname', '<small class="text-danger p-2">', '</small>'); ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?= $user['email'] ?>">
                        <label for="email">Email address</label>
                        <?= form_error('email', '<small class="text-danger p-2">', '</small>'); ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="phone" placeholder="Phone number" name="phone" value="<?= $user['phone'] ?>">
                        <label for="phone">Phone number</label>
                    </div>
                    <div class="form-floating mb-3 row align-items-center">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
                            <label><?= $user['image']; ?></label>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4 py-2">Save Changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>