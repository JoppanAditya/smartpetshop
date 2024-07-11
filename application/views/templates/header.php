<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Smart Petshop Website" />
    <meta name="author" content="Smart Petshop" />
    <title><?= $title; ?> | Smart Petshop Admin</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Element untuk menampilkan pesan alert -->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>" data-flashdatastatus="<?= $this->session->flashdata('status'); ?>"></div>

    <nav class="sb-topnav navbar navbar-expand navbar-dark d-flex align-items-center justify-content-between px-3" style="background: #3468C0; color: #eee;">
        <div>
            <!-- Navbar Brand-->
            <a class="navbar-brand pe-4" href="<?= base_url('dashboard') ?>"><img src="<?= base_url('assets/') ?>img/logo-white.png" alt="Logo Smart Petshop"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </div>

        <div>
            <!-- Title -->
            <h3 class="m-0 text-center"><?= $title; ?></h3>
        </div>

        <div>
            <!-- Navbar-->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle me-2" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="profile picture" width="30">
                        <p class="m-0"><?= $user['fullname']; ?></p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= base_url() ?>"><i class="fas fa-home fa-fw me-2"></i>Homepage</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                        <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="fas fa-user-circle fa-fw me-2"></i>My Profile</a></li>
                        <!-- Logout Button trigger modal -->
                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#LogoutModal">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                </li>
            </ul>
            </li>
            </ul>
        </div>
    </nav>

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