<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Sub Menu Data
                </div>
                <div>
                    <!-- Add Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-1"></i>
                        Add New Sub Menu
                    </button>

                    <!-- Add Modal -->
                    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addModalLabel">Add Menu Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3 form-floating">
                                            <input type="text" class="form-control" id="add_submenu_title" name="title" placeholder="Sub menu title">
                                            <label for="add_submenu_title">Sub menu title</label>
                                            <small class="form-text text-danger" id="title-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <select class="form-select" name="menu" id="add_submenu_menu">
                                                <option selected disabled value="">Select one</option>
                                                <?php foreach ($menu as $m) : ?>
                                                    <option value="<?= $m['menu_id']; ?>"><?= $m['menu']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="add_submenu_menu">Menu</label>
                                            <small class="form-text text-danger" id="menu_id-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="text" class="form-control" id="add_submenu_url" name="url" placeholder="URL">
                                            <label for="add_submenu_url">URL</label>
                                            <small class="form-text text-danger" id="url-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <input type="text" class="form-control" id="add_submenu_icon" name="icon" placeholder="Icon">
                                            <label for="add_submenu_icon">Icon</label>
                                            <small class="form-text text-danger" id="icon-error"></small>
                                        </div>
                                        <div class="mb-3 form-floating">
                                            <select class="form-select" name="is_active" id="add_submenu_active">
                                                <option selected disabled value="">Select one</option>
                                                <option value="1">Active</option>
                                                <option value="0">Not Active</option>
                                            </select>
                                            <label for="add_submenu_active">Active?</label>
                                            <small class="form-text text-danger" id="is_active-error"></small>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" id="save-add-submenu" class="btn btn-success">Add Sub Menu</button>
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
                            <th>Sub Menu</th>
                            <th>Menu</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($submenu as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $sm['title']; ?></td>
                                <td><?= $sm['menu']; ?></td>
                                <td><?= $sm['url']; ?></td>
                                <td><?= $sm['icon']; ?></td>
                                <td>
                                    <?php foreach ($isActive as $key => $value) {
                                        if ($key == $sm['is_active']) {
                                            echo $value;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- Detail Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-primary" data-id="<?= $sm['submenu_id']; ?>" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>

                                    <!-- Update Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-warning" data-id="<?= $sm['submenu_id']; ?>" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>

                                    <!-- Delete Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fas fa-trash-alt me-2"></i>Delete
                                    </button>
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
                    <h1 class="modal-title fs-5" id="detailModalLabel">Sub Menu Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Submenu Id:</strong></p>
                        <p id="detail-submenu-id"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Submenu:</strong></p>
                        <p id="detail-submenu-title"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Menu Id:</strong></p>
                        <p id="detail-submenu-menu"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>URL:</strong></p>
                        <p id="detail-submenu-url"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Icon:</strong></p>
                        <p id="detail-submenu-icon"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Active:</strong></p>
                        <p id="detail-submenu-active"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Ok</button>
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
                    <p>Are you sure you want to delete this submenu?</p>
                    <p>This action can't be undone</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(<?= $sm['submenu_id'] ?>)">Yes, Delete It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Sub Menu Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <input type="hidden" id="submenu_id" name="submenu_id">
                    <div class="modal-body">
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="update-submenu-title" name="title" placeholder="Sub menu title">
                            <label for="update-submenu-title">Sub menu title</label>
                            <small class="form-text text-danger" id="update-title-error"></small>
                        </div>
                        <div class="mb-3 form-floating">
                            <select class="form-select" name="menu_id" id="update-submenu-menu">
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($m['menu_id'] == $sm['menu_id']) : ?>
                                        <option value="<?= $m['menu_id']; ?>" selected><?= $m['menu']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $m['menu_id']; ?>"><?= $m['menu']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label for="update-submenu-menu">Select Menu</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="update-submenu-url" name="url" placeholder="URL">
                            <label for="update-submenu-url">URL</label>
                            <small class="form-text text-danger" id="update-url-error"></small>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="update-submenu-icon" name="icon" placeholder="Icon">
                            <label for="update-submenu-icon">Icon</label>
                            <small class="form-text text-danger" id="update-icon-error"></small>
                        </div>
                        <div class="mb-3 form-floating">
                            <select class="form-select" name="is_active" id="update-submenu-active">
                                <?php foreach ($isActive as $key => $value) : ?>
                                    <?php if ($key == $sm['is_active']) : ?>
                                        <option value="<?= $key; ?>" selected><?= $value; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <label for="update-submenu-active">Is Active?</label>
                            <small class="form-text text-danger" id="update-active-error"></small>
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
    $(document).ready(() => {
        // Handle detail modal
        $('#detailModal').on('show.bs.modal', (e) => {
            const button = $(e.relatedTarget);
            const id = button.data('id');

            // Clear previous data
            $('#detail-submenu-id').text('');
            $('#detail-submenu-title').text('');
            $('#detail-submenu-menu').text('');
            $('#detail-submenu-url').text('');
            $('#detail-submenu-icon').text('');
            $('#detail-submenu-active').text('');

            // Fetch menu details using AJAX
            $.ajax({
                url: '<?= base_url('menu/getSubmenuDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#detail-submenu-id').text(data.submenu_id);
                    $('#detail-submenu-title').text(data.title);
                    $('#detail-submenu-menu').text(data.menu_id);
                    $('#detail-submenu-url').text(data.url)
                    $('#detail-submenu-icon').text(data.icon);
                    $('#detail-submenu-active').text(data.is_active);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching submenu details:', error);
                }
            });
        });

        // Handle add modal
        $('#addModal').on('shown.bs.modal', () => {
            $('#title-error').text('');
            $('#menu_id-error').text('');
            $('#url-error').text('');
            $('#icon-error').text('');
            $('#is_active-error').text('');
            $('#add_submenu_title').val('');
            $('#add_submenu_menu').val('');
            $('#add_submenu_url').val('');
            $('#add_submenu_icon').val('');
            $('#add_submenu_active').val('');
        });

        // Handle add submenu
        $('#save-add-submenu').click(() => {
            const title = $('#add_submenu_title').val();
            const menu = $('#add_submenu_menu').val();
            const url = $('#add_submenu_url').val();
            const icon = $('#add_submenu_icon').val();
            const active = $('#add_submenu_active').val();

            $.ajax({
                url: '<?= base_url('menu/saveSubmenu') ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    title: title,
                    menu_id: menu,
                    url: url,
                    icon: icon,
                    is_active: active
                },
                success: (response) => {
                    if (response.error) {
                        if (response.errors) {
                            for (let field in response.errors) {
                                if (response.errors.hasOwnProperty(field)) {
                                    const errorElement = $(`#${field}-error`);
                                    if (errorElement.length) {
                                        errorElement.text(response.errors[field]);
                                    } else {
                                        console.error(`No element found for ${field}-error`);
                                    }
                                }
                            }
                        }
                    } else {
                        location.reload();
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error adding submenu:', error);
                }
            });
        });

        // Handle update modal
        $('#updateModal').on('show.bs.modal', (e) => {
            const button = $(e.relatedTarget);
            const id = button.data('id');

            $('#submenu_id').val('');
            $('#update-submenu-title').val('');
            $('#update-submenu-menu').val('');
            $('#update-submenu-url').val('');
            $('#update-submenu-icon').val('');
            $('#update-submenu-active').val('');
            $('#update-title-error').text('');
            $('#update-url-error').text('');
            $('#update-icon-error').text('');

            // Fetch menu details using AJAX
            $.ajax({
                url: '<?= base_url('menu/getSubmenuDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#submenu_id').val(data.submenu_id);
                    $('#update-submenu-title').val(data.title);
                    $('#update-submenu-menu').val(data.menu_id);
                    $('#update-submenu-url').val(data.url)
                    $('#update-submenu-icon').val(data.icon);
                    $('#update-submenu-active').val(data.is_active);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching submenu details:', error);
                }
            });
        });

        // Handle save changes button click
        $('#save-changes').click(() => {
            const id = $('#submenu_id').val();
            const title = $('#update-submenu-title').val();
            const menu = $('#update-submenu-menu').val();
            const url = $('#update-submenu-url').val();
            const icon = $('#update-submenu-icon').val();
            const active = $('#update-submenu-active').val();

            $.ajax({
                url: '<?= base_url('menu/saveSubmenu/') ?>' + id,
                method: 'POST',
                dataType: 'json',
                data: {
                    title: title,
                    menu_id: menu,
                    url: url,
                    icon: icon,
                    is_active: active
                },
                success: (response) => {
                    if (response.error) {
                        if (response.errors) {
                            for (let field in response.errors) {
                                if (response.errors.hasOwnProperty(field)) {
                                    const errorElement = $(`#update-${field}-error`);
                                    if (errorElement.length) {
                                        errorElement.text(response.errors[field]);
                                    } else {
                                        console.error(`No element found for update-${field}-error`);
                                    }
                                }
                            }
                        }
                    } else {
                        location.reload();
                    }
                },
                error: (xhr, status, error) => {
                    console.error('Error updating submenu:', error);
                }
            });
        });
    });

    const confirmDelete = (submenuId) => {
        window.location.href = '<?= base_url('menu/deleteSubmenu/') ?>' + submenuId;
    }
</script>