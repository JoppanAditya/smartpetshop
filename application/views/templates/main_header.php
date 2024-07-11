<?php
$isLoggedIn = false;
if ($this->session->userdata('username')) {
    $isLoggedIn = true;
}

$isCustomer = true;
if ($this->session->userdata('level_id') == 1 || $this->session->userdata('level_id') == 2) {
    $isCustomer = false;
}

$currentController = $this->uri->segment(1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Petshop</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>bootstrap-5.3.3-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/home.css" />
</head>

<body>
    <!-- Element untuk menampilkan pesan alert -->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>" data-flashdatastatus="<?= $this->session->flashdata('status'); ?>"></div>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg border-bottom">
        <div class="container">
            <div class="d-flex align-items-center w-100">
                <div class="mb-0">
                    <a class="navbar-brand me-0 me-lg-3" href="<?= base_url() ?>">
                        <img src="<?= base_url('assets/') ?>img/logo.png" alt="logo smart petshop" style="max-height: 40px !important;" />
                    </a>
                </div>

                <form class="d-flex nav-search w-100 mx-lg-5" role="search" action="<?= base_url('shop') ?>" method="get">
                    <div class="position-relative w-100 d-none d-lg-block">
                        <input class="form-control pe-5" type="search" name="q" placeholder="Search a product..." aria-label="Search" required value="<?= isset($_GET['q']) ? $_GET['q'] : ''; ?>" autocomplete="off" />
                        <button class="btn border-0 position-absolute end-0 top-0 text-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>

                <div class="order-lg-2 d-flex">
                    <button class="btn border-0 d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#search-collapse" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-search"></i>
                    </button>

                    <?php if ($isLoggedIn) { ?>
                        <div class="btn-group align-items-center me-lg-4">
                            <a href="<?= base_url('cart') ?>" type="button" class="btn border-0 position-relative d-lg-none">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2" style="margin-left: -7px;"><?= $this->session->userdata['total_cart']; ?></span>
                            </a>
                            <button type="button" class="btn border-0 position-relative d-none d-lg-block" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2" style="margin-left: -7px;"><?= $this->session->userdata['total_cart']; ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="width: 500px;">
                                <div class="d-flex justify-content-between align-items-center dropdown-header">
                                    <h6 class="text-dark m-0">Cart <span id="cart-total" class="text-secondary">(<?= $this->session->userdata['total_cart']; ?>)</span></h6>
                                    <a href="<?= base_url('cart') ?>" class="text-decoration-none" style="color: #ff9843;">See All</a>
                                </div>
                                <hr class="dropdown-divider" />
                                <?php if ($this->session->userdata['carts']) : ?>
                                    <?php foreach ($this->session->userdata['carts'] as $index => $c) : ?>
                                        <?php if ($c) : ?>
                                            <li>
                                                <a href=<?= base_url('shop/product/') . $c['product_id'] ?> class="dropdown-item d-flex justify-content-between text-reset text-decoration-none">
                                                    <div class="d-flex align-items-start gap-3">
                                                        <img src="<?= base_url('assets/img/product/') . $c['product_image'] ?>" alt="<?= $c['product_name'] ?>" class="rounded img-thumbnail" width="56" height="56">
                                                        <p class="d-inline-block text-wrap text-decoration-none fw-medium" style="max-width: 250px;"><?= $c['product_name'] ?></p>
                                                    </div>
                                                    <p class="fw-semibold"><span><?= $c['quantity'] ?></span> &times; Rp<?= number_format($c['product_price'], 0, ',', '.'); ?></p>
                                                </a>
                                            </li>
                                        <?php else : ?>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-3 p-3">
                                        <img src="<?= base_url('assets/') ?>img/empty-cart.png" alt="empty cart" class="img-thumbnail" width="200" height="200">
                                        <h4 class="mb-0">Your cart is empty</h4>
                                        <p class="mb-0">Want something? Add it to your cart now!</p>
                                        <a href="<?= base_url('shop') ?>" class="btn btn-primary px-5 py-2">Shop Now</a>
                                    </div>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="vr d-none d-lg-block"></div>

                        <button type="button" class="btn position-relative dropdown border-0" id="loggedIn">
                            <a class="dropdown-toggle text-decoration-none text-dark d-inline-flex align-items-center" id="navbarUserDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-none d-lg-block"><?= $user['username']; ?></span>
                                <img class="rounded-circle ms-2" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="profile picture" style="max-height: 30px;">
                            </a>
                            <ul class=" dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                                <?php if (!$isCustomer) { ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('dashboard') ?>">
                                            <i class="fa fa-tachometer-alt fa-fw me-2"></i>Go to Dashboard
                                        </a>
                                    </li>
                                <?php } ?>

                                <li><a class="dropdown-item" href="<?= base_url('settings') ?>"><i class="fas fa-cog fa-fw me-2"></i>Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#LogoutModal"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</a></li>
                            </ul>
                        </button>
                    <?php } else { ?>
                        <a type="button" href="<?= base_url('auth/') ?>" class="btn border-0 d-lg-none" id="loggedOut"><i class="fas fa-user"></i></a>
                        <a type="button" href="<?= base_url('auth/') ?>" class="btn position-relative btn-primary me-2 d-none d-lg-block" id="loggedOut">Login</a>
                        <a type="button" href="<?= base_url('auth/register') ?>" class="btn position-relative btn-outline-primary d-none d-lg-block" id="loggedOut">Register</a>
                    <?php } ?>

                    <button class="btn border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-bars"></i></button>
                </div>
            </div>

            <form class="d-flex d-lg-none nav-search w-100" role="search" action="<?= base_url('shop') ?>" method="get">
                <div class="collapse position-relative w-100 mt-2" id="search-collapse">
                    <input class="form-control pe-5" type="search" name="q" placeholder="Search a product..." aria-label="Search" required value="<?= isset($_GET['q']) ? $_GET['q'] : ''; ?>" autocomplete="off" />
                    <button class="btn border-0 position-absolute end-0 top-0 text-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

        </div>
    </nav>

    <div class="offcanvas offcanvas-end text-white border-white border-opacity-10" style="backdrop-filter: blur(8px); background-color: rgba(52, 104, 192, .5)!important;" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header justify-content-between">
            <a class="navbar-brand mb-0" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/') ?>img/logo-home-white.png" alt="logo smart petshop" height="40" />
            </a>
            <button type="button" class="btn border-0" data-bs-dismiss="offcanvas"><i class="fas fa-times text-white fs-6"></i></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav mb-2 nav-underline">
                <li class="nav-item">
                    <a class="nav-link mx-auto text-center <?= $currentController == '' ? 'active' : ''; ?> text-light" aria-current="page" href="<?= base_url() ?>" style="width: fit-content;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-auto text-center <?= $currentController == 'shop' ? 'active' : ''; ?> text-light" href="<?= base_url('shop') ?>" style="width: fit-content;">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-auto text-center <?= $currentController == 'contact' ? 'active' : ''; ?> text-light" href="<?= base_url('contact') ?>" style="width: fit-content;">Contact</a>
                </li>
            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-primary p-0 d-none d-lg-block">
        <div class="container">
            <ul class="navbar-nav mb-2 mb-lg-0 nav-underline">
                <li class="nav-item pe-4">
                    <a class="nav-link <?= $currentController == '' ? 'active' : ''; ?> text-light" aria-current="page" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item pe-4">
                    <a class="nav-link <?= $currentController == 'shop' ? 'active' : ''; ?> text-light" href="<?= base_url('shop') ?>">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentController == 'contact' ? 'active' : ''; ?> text-light" href="<?= base_url('contact') ?>">Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Logout Modal -->
    <div class="modal fade" id="LogoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="LogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="LogoutModalLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger px-5" onclick="logout()">Yes</button>
                    <button type="button" class="btn btn-primary px-5" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function logout() {
            window.location.href = '<?= base_url('auth/logout') ?>';
        }
    </script>