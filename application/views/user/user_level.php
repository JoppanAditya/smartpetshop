<main>
    <div class="container-fluid px-4 z-0 position-relative">
        <!-- Element untuk menampilkan pesan alert -->
        <?= $this->session->flashdata('message'); ?>

        <div class="card my-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    User Level Data
                </div>
                <div>
                    <!-- Add Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-1"></i>
                        Add New Level
                    </button>

                    <!-- Add Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addModalLabel">Add Level Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-floating">
                                        <input type="text" class="form-control" id="add_user_level" name="level" placeholder="Level name">
                                        <label for="add_user_level">Level name</label>
                                        <small class="form-text text-danger" id="add-level-error"></small>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" id="save-add" class="btn btn-success">Add Level</button>
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
                            <th>Level</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($level as $l) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $l['level_name']; ?></td>
                                <td>
                                    <!-- Access Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-success" data-id="<?= $l['level_id']; ?>" data-bs-toggle="modal" data-bs-target="#accessModal">
                                        <i class="fas fa-user-lock me-2"></i>Menu Access Permissions
                                    </button>
                                </td>
                                <td>
                                    <!-- Detail Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-primary" data-id="<?= $l['level_id']; ?>" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>

                                    <!-- Update Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-warning" data-id="<?= $l['level_id']; ?>" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>

                                    <!-- Delete Button trigger modal -->
                                    <?php if ($l['level_id'] == 1 || $l['level_id'] == 2) : ?>
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

    <!-- Access Modal -->
    <div class="modal fade" id="accessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="accessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="accessModalLabel">Menu Permissions <span id="access_level_name"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Menu</th>
                                <th>Access</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($menu as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $m['menu']; ?></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="access-check-<?= $m['menu_id']; ?>" data-menu-id="<?= $m['menu_id']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary px-5" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Level Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Level Id:</strong></p>
                        <p id="detail-level-id"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Level:</strong></p>
                        <p id="detail-level-name"></p>
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
                    <p>Are you sure you want to delete this level?</p>
                    <p>This action can't be undone</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete(<?= $l['level_id'] ?>)">Yes, Delete It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Level Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <input type="hidden" id="level_id" name="level_id">
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="level-name" name="level_name" placeholder="Level name">
                            <label for="level-name">Level name</label>
                            <small class="form-text text-danger" id="level-error"></small>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Handle access modal
        const accessModal = document.getElementById('accessModal');
        accessModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            // Clear previous data
            document.getElementById('access_level_name').textContent = '';

            // Fetch user details using AJAX
            fetch('<?= base_url('user/getLevelDetail/') ?>' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('access_level_name').textContent = data.level_name;

                    // Fetch access permissions for each menu
                    const checkboxes = document.querySelectorAll('.form-check-input');
                    checkboxes.forEach(checkbox => {
                            const menuId = checkbox.getAttribute('data-menu-id');
                            if ((data.level_id == 1 && menuId == 1) || (data.level_id == 1 && menuId == 2) || (data.level_id == 1 && menuId == 3) || (data.level_id == 1 && menuId == 6)) {
                                checkbox.disabled = true;
                                checkbox.checked = true;
                            } else {
                                fetch('<?= base_url('user/checkAccess') ?>', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            level_id: data.level_id,
                                            menu_id: menuId
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        checkbox.disabled = false;
                                        checkbox.checked = data.access;
                                    })
                                    .catch(error => console.error('Error checking access:', error));
                            }

                            // Add event listener for checkbox change
                            checkbox.addEventListener('change', function() {
                                fetch('<?= base_url('user/updateAccess') ?>', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            level_id: data.level_id,
                                            menu_id: menuId,
                                            access: checkbox.checked
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            console.log('Access updated successfully');
                                        } else {
                                            console.error('Error updating access:', data.error);
                                        }
                                    })
                                    .catch(error => console.error('Error updating access:', error));
                            });
                        })
                        .catch(error => console.error('Error fetching level details:', error));
                });
        });

        // Handle detail modal
        const detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            // Clear previous data
            document.getElementById('detail-level-id').textContent = '';
            document.getElementById('detail-level-name').textContent = '';

            // Fetch user details using AJAX
            fetch('<?= base_url('user/getLevelDetail/') ?>' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-level-id').textContent = data.level_id;
                    document.getElementById('detail-level-name').textContent = data.level_name;
                })
                .catch(error => console.error('Error fetching level details:', error));
        });

        // Handle add user
        document.getElementById('save-add').addEventListener('click', function() {
            const level = document.getElementById('add_user_level').value;

            fetch('<?= base_url('user/saveLevel') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        level_name: level
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById('add-level-error').textContent = data.error;
                    } else {
                        document.getElementById('add-level-error').textContent = '';
                        location.reload();
                    }
                })
                .catch(error => console.error('Error adding level:', error));
        });

        // Handle update modal
        const updateModal = document.getElementById('updateModal');
        updateModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            // Clear previous data
            document.getElementById('level-name').value = '';

            // Fetch level details using AJAX
            fetch('<?= base_url('user/getLevelDetail/') ?>' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('level_id').value = data.level_id;
                    document.getElementById('level-name').value = data.level_name;
                })
                .catch(error => console.error('Error fetching level details:', error));
        });

        // Handle save changes button click
        document.getElementById('save-changes').addEventListener('click', function() {
            const id = document.getElementById('level_id').value;
            const level = document.getElementById('level-name').value;

            fetch('<?= base_url('user/saveLevel/') ?>' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        level_name: level
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById('level-error').textContent = data.error;
                    } else {
                        document.getElementById('level-error').textContent = '';
                        location.reload();
                    }
                })
                .catch(error => console.error('Error updating level:', error));
        });
    });

    function confirmDelete(levelId) {
        window.location.href = '<?= base_url('user/deleteLevel/') ?>' + levelId;
    }
</script>