<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <?php
                    $level_id = $this->session->userdata('level_id');

                    $queryMenu = "  SELECT `user_menu`.`menu_id`, `menu` 
                                        FROM `user_menu` 
                                        JOIN `user_access_menu` 
                                        ON `user_menu`.`menu_id` = `user_access_menu`.`menu_id` 
                                        WHERE `user_access_menu`.`level_id` = ? 
                                        ORDER BY `user_access_menu`.`menu_id` ASC";

                    $menu = $this->db->query($queryMenu, array($level_id))->result_array();
                    ?>

                    <?php foreach ($menu as $m) : ?>
                        <div class="sb-sidenav-menu-heading pt-2">
                            <?= $m['menu']; ?>
                        </div>

                        <?php
                        $menuId = $m['menu_id'];
                        $querySubMenu = "   SELECT * 
                                            FROM `user_submenu` 
                                            JOIN `user_menu` 
                                            ON `user_submenu`.`menu_id` = `user_menu`.`menu_id` 
                                            WHERE `user_submenu`.`menu_id` = $menuId 
                                            AND `user_submenu`.`is_active` = 1";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>

                        <?php foreach ($subMenu as $sm) : ?>
                            <?php if ($title == $sm['title']) : ?>
                                <a class="nav-link active sb-sidenav-footer" href="<?= base_url($sm['url']) ?>">
                                <?php else : ?>
                                    <a class="nav-link" href="<?= base_url($sm['url']) ?>">
                                    <?php endif; ?>
                                    <div class="sb-nav-link-icon"><i class="<?= $sm['icon'] ?>"></i></div>
                                    <?= $sm['title'] ?>
                                    </a>
                                <?php endforeach ?>
                            <?php endforeach ?>

                            <!-- Logout Button trigger modal -->
                            <a class="nav-link" href="index.html" data-bs-toggle="modal" data-bs-target="#LogoutModal">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Logout
                            </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: </div>
                <?= $user['username']; ?>
            </div>
        </nav>
    </div>

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

    <div id="layoutSidenav_content">