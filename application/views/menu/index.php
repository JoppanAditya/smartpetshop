<main>
    <div class="container-fluid px-4 z-0 position-relative">

        <div class="card my-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Menu Data
                </div>
                <div>
                    <!-- Add Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-1"></i>
                        Add New Menu
                    </button>

                    <!-- Add Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addModalLabel">Add Menu Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-floating">
                                        <input type="text" class="form-control" id="add_menu" name="menu" placeholder="Menu title">
                                        <label for="menu">Menu title</label>
                                        <small class="form-text text-danger" id="add-menu-error"></small>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" id="save-add" class="btn btn-success">Add Menu</button>
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
                            <th>Menu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $m['menu']; ?></td>
                                <td>
                                    <!-- Detail Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-primary" data-id="<?= $m['menu_id']; ?>" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>

                                    <!-- Update Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-warning" data-id="<?= $m['menu_id']; ?>" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>

                                    <!-- Delete Button trigger modal -->
                                    <?php if ($m['menu_id'] == 1 || $m['menu_id'] == 2 || $m['menu_id'] == 3) : ?>
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
                    <h1 class="modal-title fs-5" id="detailModalLabel">Menu Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Menu Id:</strong></p>
                        <p id="detail-menu-id"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Menu:</strong></p>
                        <p id="detail-menu-title"></p>
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
                    <p>Are you sure you want to delete this menu?</p>
                    <p>This action can't be undone</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(<?= $m['menu_id'] ?>)">Yes, Delete It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Menu Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update-form" method="post">
                    <input type="hidden" id="update_menu_id" name="menu_id">
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="update_menu" name="menu" placeholder="Menu title">
                            <label for="update_menu">Menu title</label>
                            <small class="form-text text-danger" id="menu-error"></small>
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
            $('#detail-menu-id').text('');
            $('#detail-menu-title').text('');

            // Fetch menu details using AJAX
            $.ajax({
                url: '<?= base_url('menu/getMenuDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#detail-menu-id').text(data.menu_id);
                    $('#detail-menu-title').text(data.menu);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching menu details:', error);
                }
            });
        });

        // Handle add modal
        $('#addModal').on('show.bs.modal', (e) => {
            $('#add_menu').val('');
            $('#add-menu-error').text('');

            $('#save-add').click(() => {
                const menu = $('#add_menu').val();

                $.ajax({
                    url: '<?= base_url('menu/saveMenu') ?>',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        menu: menu
                    },
                    success: (response) => {
                        console.log(response.data);
                        if (response.error) {
                            $('#add-menu-error').text(response.message);
                        } else {
                            $('#add-menu-error').text('');
                            location.reload();
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error adding menu:', error);
                    }
                });
            });
        });

        // Handle update modal
        $('#updateModal').on('show.bs.modal', (e) => {
            const button = $(e.relatedTarget);
            const id = button.data('id');

            // Clear previous data
            $('#update_menu_id').val('');
            $('#update_menu').val('');
            $('#menu-error').text('');

            // Fetch menu details using AJAX
            $.ajax({
                url: '<?= base_url('menu/getMenuDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#update_menu_id').val(data.menu_id);
                    $('#update_menu').val(data.menu);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching menu details:', error);
                }
            });

            // Handle save changes button click
            $('#save-changes').click(() => {
                const id = $('#update_menu_id').val();
                const menu = $('#update_menu').val();

                $.ajax({
                    url: '<?= base_url('menu/saveMenu/') ?>' + id,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        menu: menu
                    },
                    success: (response) => {
                        console.log(response.data);
                        if (response.error) {
                            $('#menu-error').text(response.message);
                        } else {
                            $('#menu-error').text('');
                            location.reload();
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error updating menu:', error);
                    }
                });
            });
        });

    });

    const confirmDelete = (menuId) => {
        window.location.href = '<?= base_url('menu/deleteMenu/') ?>' + menuId;
    };
</script>