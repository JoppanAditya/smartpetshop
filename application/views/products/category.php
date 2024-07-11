<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <div class="card my-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Category Data
                </div>
                <div>
                    <!-- Add Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-1"></i>
                        Add New Category
                    </button>

                    <!-- Add Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addModalLabel">Add Category Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="add_category_name" name="category_name" placeholder="Category name">
                                            <label for="add_category_name">Category name</label>
                                            <small class="form-text text-danger" id="add-name-error"></small>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" id="save-add" class="btn btn-success">Add Category</button>
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
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($category as $c) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $c['name']; ?></td>
                                <td>
                                    <!-- Detail Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-primary" data-id="<?= $c['id']; ?>" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>

                                    <!-- Update Button trigger modal -->
                                    <button type="button" class="me-2 btn btn-outline-warning" data-id="<?= $c['id']; ?>" data-bs-toggle="modal" data-bs-target="#updateModal">
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
                    <h1 class="modal-title fs-5" id="detailModalLabel">Category Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Category Id:</strong></p>
                        <p id="detail-category-id"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Category:</strong></p>
                        <p id="detail-category-name"></p>
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
                    <p>Are you sure you want to delete this category?</p>
                    <p>This action can't be undone</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn btn-outline-danger" onclick="confirmDelete('<?= $c['id']; ?>')">Yes, Delete It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Category Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="update_category_name" name="category_name" placeholder="Category name">
                            <label for="update_category_name">Category name</label>
                            <small class="form-text text-danger" id="update-name-error"></small>
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
            $('#detail-category-id').text('');
            $('#detail-category-name').text('');

            // Fetch menu details using AJAX
            $.ajax({
                url: '<?= base_url('products/getCategoryDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#detail-category-id').text(data.id);
                    $('#detail-category-name').text(data.name);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching category details:', error);
                }
            });
        });

        // Handle add modal
        $('#addModal').on('shown.bs.modal', () => {
            $('#add-name-error').text('');
            $('#add_category_name').val('');

            // Handle add category
            $('#save-add').click(() => {
                const name = $('#add_category_name').val();

                $.ajax({
                    url: '<?= base_url('products/saveCategory') ?>',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: name
                    },
                    success: (response) => {
                        if (response.error) {
                            if (response.errors) {
                                for (let field in response.errors) {
                                    if (response.errors.hasOwnProperty(field)) {
                                        const errorElement = $(`#add-${field}-error`);
                                        if (errorElement.length) {
                                            errorElement.text(response.errors[field]);
                                        } else {
                                            console.error(`No element found for add-${field}-error`);
                                        }
                                    }
                                }
                            }
                        } else {
                            location.reload();
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error adding category:', error);
                    }
                });
            });
        });

        // Handle update modal
        $('#updateModal').on('show.bs.modal', (e) => {
            const button = $(e.relatedTarget);
            const id = button.data('id');

            // Clear previous data
            $('#category_id').val('');
            $('#update_category_name').val('');
            $('#update-name-error').text('');

            // Fetch category details using AJAX
            $.ajax({
                url: '<?= base_url('products/getCategoryDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#category_id').val(data.id);
                    $('#update_category_name').val(data.name);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching category details:', error);
                }
            });

            // Handle update category
            $('#save-changes').click(() => {
                const id = $('#category_id').val();
                const name = $('#update_category_name').val();

                $.ajax({
                    url: '<?= base_url('products/saveCategory/') ?>' + id,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: name
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
                        console.error('Error updating category:', error);
                    }
                });
            });
        });
    });

    const confirmDelete = (id) => {
        window.location.href = '<?= base_url('products/deleteCategory/') ?>' + id;
    }
</script>