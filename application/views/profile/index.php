<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <div class="card mb-4 col-5 mx-auto">
            <div class="card-body d-flex flex-column justify-content-center gap-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="<?= base_url('profile'); ?>" class="btn" hidden><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-gear"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="<?= base_url('profile/edit'); ?>" class="dropdown-item" type="button"><i class="fas fa-user-edit me-2"></i>Edit Profile</a></li>
                            <li><a href="<?= base_url('profile/change_pass'); ?>" class="dropdown-item" type="button"><i class="fas fa-edit me-2"></i>Change Password</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mx-auto">
                    <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" alt="Profile Picture" height="250" width="250" class="rounded-circle">
                </div>
                <div>
                    <h3 class="text-center"><strong><?= $user['fullname']; ?></strong></h3>
                    <p class="text-center"><?= $user['username']; ?></p>
                    <p class="text-center"><?= $user['email']; ?></p>
                    <p class="text-center"><?= $user['phone']; ?></p>
                    <p class="text-center">Member Since <?= date('F d, Y', $user['date_created']); ?></p>
                </div>

            </div>
        </div>
    </div>


</main>