<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">

        <main>
            <div class="container min-vh-100 d-flex">
                <div class="row justify-content-center m-auto">
                    <div class="text-center mb-4">
                        <img src="<?= base_url('assets/'); ?>img/logo.png" height="60" />
                    </div>

                    <div class="col-lg">
                        <div class="card shadow-lg border-0 rounded-lg mt-3 bg-form w-100 position-relative">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="javascript:history.back()" class="text-decoration-none position-absolute start-0 ps-4 h5 py-5 my-4 text-black"><i class="fas fa-arrow-left me-2"></i></a>
                                <h3 class="text-center my-4"><strong>Login</strong></h3>
                            </div>

                            <div class="card-body">
                                <form id="loginForm">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?= set_value('username') ?>" />
                                        <label for="username"><i class="bx bxs-user"></i> Username</label>
                                        <small class="form-text text-danger ps-4" id="username-error"></small>
                                    </div>
                                    <div class="form-floating mb-3 position-relative">
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                                        <label for="password"><i class="bx bxs-lock-alt"></i> Password</label>
                                        <small class="form-text text-danger ps-4" id="password-error"></small>
                                        <button type="button" class="btn position-absolute end-0 top-0 p-3 border-0" onclick="togglePasswordVisibility('password')"><i class="fas fa-eye"></i></button>
                                    </div>

                                    <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>

                                    <div class="mt-3 mb-0">
                                        <div class="d-grid"><button type="button" id="loginButton" class="btn btn-submit btn-block">Login</button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="text-center pb-4">
                                <div class="small">
                                    Don't have an account?
                                    <a href="<?= base_url('auth/register'); ?>">Register</a>
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

    $(document).ready(() => {
        $('#loginButton').click((e) => {
            e.preventDefault();

            const username = $('#username').val();
            const password = $('#password').val();

            const formData = new FormData();
            formData.append('username', username);
            formData.append('password', password);

            $.ajax({
                url: '<?= base_url('auth/login') ?>',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: (response) => {
                    if (response.error) {
                        if (response.errors) {
                            for (let field in response.errors) {
                                if (response.errors.hasOwnProperty(field)) {
                                    const errorElement = $(`#${field}-error`);
                                    if (errorElement.length) {
                                        errorElement.text(response.errors[field]);
                                    }
                                }
                            }
                        }
                    } else {
                        if (response.level_id == "1" || response.level_id == "2") {
                            window.location.href = '<?= base_url('dashboard'); ?>';
                        } else {
                            window.history.back();
                        }
                    }
                },
                error: (xhr, status, error) => {
                    window.location.reload();
                    console.error('AJAX request error:', xhr.responseText);
                }
            });
        });
    });
</script>