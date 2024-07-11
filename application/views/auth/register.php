<!-- Registration Page -->
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container min-vh-100 d-flex pb-5 pb-lg-0">
                <div class="row justify-content-center m-auto">
                    <div class="text-center my-4">
                        <img src="<?= base_url('assets/'); ?>img/logo.png" height="60" />
                    </div>

                    <div class="col-lg">
                        <div class="card shadow-lg border-0 rounded-lg mt-3 bg-form w-100 position-relative">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="javascript:history.back()" class="text-decoration-none position-absolute start-0 ps-4 h5 py-5 my-4 text-black"><i class="fas fa-arrow-left me-2"></i></a>
                                <h3 class="text-center my-4"><strong>Register</strong></h3>
                            </div>
                            <div class="card-body">
                                <form method="post" action="<?= base_url('auth/register'); ?>">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="fullname" name="fullname" type="text" placeholder="Enter your first name" value="<?= set_value('fullname') ?>" />
                                                <label for="fullname"><i class="bx bxs-user"></i> Full name</label>
                                                <?= form_error('fullname', '<small class="text-danger p-2">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Enter your first name" value="<?= set_value('username') ?>" />
                                                <label for="username"><i class="bx bxs-user"></i> Username</label>
                                                <?= form_error('username', '<small class="text-danger p-2">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="email" name="email" type="text" placeholder="name@example.com" value="<?= set_value('email') ?>" />
                                                <label for="email"><i class="bx bxs-envelope"></i> Email address</label>
                                                <?= form_error('email', '<small class="text-danger p-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input class="form-control" id="phone" name="phone" type="text" placeholder="081..." />
                                                <label for="phone"><i class="bx bxs-phone"></i> Phone number</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0 position-relative">
                                                <input class="form-control" id="password1" name="password1" type="password" placeholder="Create a password" />
                                                <label for="password1"><i class="bx bxs-lock-alt"></i> Password</label>
                                                <?= form_error('password1', '<small class="text-danger p-3">', '</small>'); ?>
                                                <button type="button" class="btn position-absolute end-0 top-0 p-3" onclick="togglePasswordVisibility('password1')"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-0 position-relative">
                                                <input class="form-control" id="password2" name="password2" type="password" placeholder="Confirm password" />
                                                <label for="password2"><i class="bx bxs-lock-alt"></i> Confirm Password</label>
                                                <button type="button" class="btn position-absolute end-0 top-0 p-3" onclick="togglePasswordVisibility('password2')"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">

                                        <label class="form-check-label" for="agreement">By signing up to this website, you agree to our Privacy Policy.</label>


                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit" class="btn btn-submit btn-block">Register</button></div>
                                        </div>
                                </form>
                            </div>
                            <div class="text-center py-3">
                                <div class="small">
                                    <p>Already have an account? <a href="<?= base_url('auth'); ?>">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>

<script>
    const togglePasswordVisibility = (inputId) => {
        const input = $('#' + inputId);
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    }
</script>