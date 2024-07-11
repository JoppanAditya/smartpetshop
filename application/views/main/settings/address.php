<main>
    <div class="container mt-4">

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 text-dark" href="<?= base_url('settings'); ?>">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 active" aria-current="true" href="<?= base_url('settings/address'); ?>" style="color: #FF9843; font-weight: 500;">Address List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 text-dark" href="<?= base_url('settings/transaction'); ?>">Order List</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">

                    <!-- Add Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-1"></i>
                        Add New Address
                    </button>
                </div>
                <?php foreach ($address as $a) : ?>
                    <div class="card mt-3 <?= $a['is_selected'] == 1 ? 'border-primary' . '"' . 'style="background-color: rgba(52, 104, 192, .1);"' : ''; ?>">
                        <div class="card-body text-start row" style="font-size: 14px;">
                            <div class="col-sm-9 col-md-10">
                                <h5 class="fs-6">
                                    <?= $a['label']; ?>
                                    <span class="badge text-bg-secondary fw-normal ms-2" <?= $a['is_default'] == 1 ? '' : 'style="display:none;"'; ?>>Primary</span>
                                </h5>
                                <h5 class="mb-1 fs-6"><?= $a['name']; ?></h5>
                                <p class="mb-1"><?= $a['phone']; ?></p>
                                <p class="mb-1"><?= $a['full_address'] . ', ' . $a['city']; ?> <span><?= $a['notes'] ? '(' . $a['notes'] . ')' : ''; ?></span></p>
                            </div>
                            <div class="col-sm-3 col-md-2 d-flex justify-content-center align-items-center gap-2" style="color: #3468c0;">
                                <?php if ($a['is_selected'] == 1) : ?>
                                    <i class="fas fa-check-circle fs-3 ms-auto ms-sm-0"></i>
                                <?php else : ?>
                                    <button type="button" class="btn btn-primary w-100 py-2 select-button mt-2">Select</button>
                                    <input type="hidden" class="address-id" value="<?= $a['id'] ?>">
                                    <input type="hidden" class="user-id" value="<?= $a['user_id'] ?>">
                                <?php endif; ?>
                            </div>
                            <div class="d-inline-flex mt-2 align-items-end">
                                <button type="button" class="btn btn-link text-decoration-none border-0 p-0 pe-3 d-none d-sm-block" style="font-size: 14px;" data-id="<?= $a['id'] ?>" data-bs-toggle="modal" data-bs-target="#updateModal">Edit Address</button>

                                <button type="button" class="btn btn-light w-100 py-2 text-decoration-none d-sm-none" style="font-size: 14px;" data-id="<?= $a['id'] ?>" data-bs-toggle="modal" data-bs-target="#updateModal">Edit Address</button>

                                <?php if ($a['is_selected'] == 0 && $a['is_default'] == 0) : ?>
                                    <button class="btn btn-light ms-2 d-sm-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#option-<?= $a['id'] ?>" aria-controls="option-<?= $a['id'] ?>"><i class="fas fa-ellipsis-v"></i></button>
                                    <!-- Offcanvas -->
                                    <div class="offcanvas offcanvas-bottom rounded-top-4 d-sm-none" tabindex="-1" id="option-<?= $a['id'] ?>" aria-labelledby="optionLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="optionLabel">Another Options</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body d-flex flex-column gap-3 align-items-start small">
                                            <button type="button" class="btn btn-link text-decoration-none border-0 p-0 primary-button d-sm-none" style="font-size: 14px;">Make it Primary Address & Select</button>
                                            <button type="button" class="btn btn-link text-decoration-none border-0 p-0 d-sm-none" style="font-size: 14px;" data-id="<?= $a['id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-link text-decoration-none border-0 border-start p-0 px-3 primary-button d-none d-sm-block" style="font-size: 14px;">Make it Primary Address & Select</button>
                                    <input type="hidden" class="address-id" value="<?= $a['id'] ?>">
                                    <input type="hidden" class="user-id" value="<?= $a['user_id'] ?>">
                                    <button type="button" class="btn btn-link text-decoration-none border-0 border-start p-0 ps-3 d-none d-sm-block" style="font-size: 14px;" data-id="<?= $a['id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                <?php elseif ($a['is_selected'] == 1 && $a['is_default'] == 0) : ?>
                                    <button class="btn btn-light ms-2 d-sm-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#option-<?= $a['id'] ?>" aria-controls="option-<?= $a['id'] ?>"><i class="fas fa-ellipsis-v"></i></button>
                                    <!-- Offcanvas -->
                                    <div class="offcanvas offcanvas-bottom rounded-top-4 d-sm-none" tabindex="-1" id="option-<?= $a['id'] ?>" aria-labelledby="optionLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="optionLabel">Another Options</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body small">
                                            <button type="button" class="btn btn-link text-decoration-none border-0 p-0 primary-button d-sm-none" style="font-size: 14px;">Make it Primary Address</button>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-link text-decoration-none border-0 border-start p-0 px-3 primary-button d-none d-sm-block" style="font-size: 14px;">Make it Primary Address</button>
                                    <input type="hidden" class="address-id" value="<?= $a['id'] ?>">
                                    <input type="hidden" class="user-id" value="<?= $a['user_id'] ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add Address Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <input type="hidden" name="add_user_id" id="add_user_id" value="<?= $user['user_id'] ?>">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="add_user_name" name="name" value="<?= $user['fullname']; ?>" placeholder="Recipient Name">
                            <label for="add_user_name">Recipient Name</label>
                            <small class="form-text text-danger" id="add-name-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="add_user_phone" name="phone" value="<?= $user['phone']; ?>" placeholder="Phone Number">
                            <label for="add_user_phone">Phone Number</label>
                            <small class="form-text text-danger" id="add-phone-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="add_address_label" name="label" placeholder="Address Label">
                            <label for="add_address_label">Address Label</label>
                            <small class="form-text text-danger" id="add-label-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="add_address_city" name="city" placeholder="City & Province">
                            <label for="add_address_city">City & Province</label>
                            <small class="form-text text-danger" id="add-city-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Full Address" id="add_address_full" name="address" style="height: 100px"></textarea>
                            <label for="add_address_full">Full Address</label>
                            <small class="form-text text-danger" id="add-address-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="add_address_notes" name="notes" placeholder="Notes for Courier">
                            <label for="add_address_notes">Notes for Courier</label>
                            <small class="form-text text-danger" id="add-notes-error"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save-add" class="btn btn-primary w-100">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Address Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <input type="hidden" name="update_address_id" id="update_address_id">
                    <input type="hidden" name="update_user_id" id="update_user_id" value="<?= $user['user_id'] ?>">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_user_name" name="name" placeholder="Recipient Name">
                            <label for="update_user_name">Recipient Name</label>
                            <small class="form-text text-danger" id="update-name-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_user_phone" name="phone" placeholder="Phone Number">
                            <label for="update_user_phone">Phone Number</label>
                            <small class="form-text text-danger" id="update-phone-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_address_label" name="label" placeholder="Address Label">
                            <label for="update_address_label">Address Label</label>
                            <small class="form-text text-danger" id="update-label-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_address_city" name="city" placeholder="City & Province">
                            <label for="update_address_city">City & Province</label>
                            <small class="form-text text-danger" id="update-city-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Full Address" id="update_address_full" name="address" style="height: 100px"></textarea>
                            <label for="update_address_full">Full Address</label>
                            <small class="form-text text-danger" id="update-address-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_address_notes" name="notes" placeholder="Notes for Courier">
                            <label for="update_address_notes">Notes for Courier</label>
                            <small class="form-text text-danger" id="update-notes-error"></small>
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this address?</p>
                    <p>This action can't be undone</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Keep It</button>
                    <button type="button" class="btn btn-outline-danger" id="deleteButton">Yes, Delete It</button>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    $(document).ready(function() {
        // Handel Add
        $('#save-add').click(function(e) {
            e.preventDefault();

            const user_id = $('#add_user_id').val();
            const name = $('#add_user_name').val();
            const phone = $('#add_user_phone').val();
            const label = $('#add_address_label').val();
            const city = $('#add_address_city').val();
            const full_address = $('#add_address_full').val();
            const notes = $('#add_address_notes').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('settings/saveAddress') ?>',
                data: {
                    user_id: user_id,
                    name: name,
                    phone: phone,
                    label: label,
                    city: city,
                    full_address: full_address,
                    notes: notes
                },
                success: function(response) {
                    if (response.error) {
                        if (response.errors) {
                            for (let field in response.errors) {
                                if (response.errors.hasOwnProperty(field)) {
                                    const errorElement = $(`#add-${field}-error`);
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
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Handle Update
        const updateModal = $('#updateModal');
        updateModal.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');

            // Reset form values
            $('#update_address_id').val();
            $('#update_user_id').val();
            $('#update_user_name').val();
            $('#update_user_phone').val();
            $('#update_address_label').val();
            $('#update_address_city').val();
            $('#update_address_full').val();
            $('#update_address_notes').val();

            $.ajax({
                url: '<?= base_url('settings/getAddressDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#update_address_id').val(data[0].id);
                        $('#update_user_id').val(data[0].user_id);
                        $('#update_user_name').val(data[0].name);
                        $('#update_user_phone').val(data[0].phone);
                        $('#update_address_label').val(data[0].label);
                        $('#update_address_city').val(data[0].city);
                        $('#update_address_full').val(data[0].full_address);
                        $('#update_address_notes').val(data[0].notes);
                    } else {
                        console.error('No data received');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching address details:', error);
                }
            });
        });

        // Handle Save Changes
        $('#save-changes').click(function(e) {
            e.preventDefault();

            const id = $('#update_address_id').val();
            const user_id = $('#update_user_id').val();
            const name = $('#update_user_name').val();
            const phone = $('#update_user_phone').val();
            const label = $('#update_address_label').val();
            const city = $('#update_address_city').val();
            const full_address = $('#update_address_full').val();
            const notes = $('#update_address_notes').val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('settings/saveAddress/') ?>' + id,
                data: {
                    user_id: user_id,
                    name: name,
                    phone: phone,
                    label: label,
                    city: city,
                    full_address: full_address,
                    notes: notes
                },
                success: function(response) {
                    if (response.error) {
                        if (response.errors) {
                            for (let field in response.errors) {
                                if (response.errors.hasOwnProperty(field)) {
                                    const errorElement = $(`#update-${field}-error`);
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
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Handle Select
        $('.select-button').click(function(event) {
            const button = $(this);
            const cardBody = button.closest('.card-body');
            const id = cardBody.find('.address-id').val();
            const userId = cardBody.find('.user-id').val();

            console.log('ID:', id);
            console.log('User ID:', userId);

            if (typeof id === 'undefined' || typeof userId === 'undefined') {
                console.error('ID or user ID is undefined.');
                return;
            }

            $.ajax({
                url: '<?= base_url('settings/updateSelect/') ?>' + id,
                method: 'POST',
                data: {
                    user_id: userId
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating selection:', error);
                }
            });
        });

        // Handle Primary Select
        $('.primary-button').click(function(event) {
            const button = $(this);
            const cardBody = button.closest('.card-body');
            const id = cardBody.find('.address-id').val();
            const userId = cardBody.find('.user-id').val();

            console.log('ID:', id);
            console.log('User ID:', userId);

            if (typeof id === 'undefined' || typeof userId === 'undefined') {
                console.error('ID or user ID is undefined.');
                return;
            }

            $.ajax({
                url: '<?= base_url('settings/updatePrimarySelect/') ?>' + id,
                method: 'POST',
                data: {
                    user_id: userId
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating selection:', error);
                }
            });
        });

        // Handle Delete
        const deleteModal = $('#deleteModal');
        deleteModal.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');

            $('#deleteButton').off('click').on('click', function() {
                window.location.href = '<?= base_url('settings/deleteAddress/') ?>' + id;
            });
        });

    });
</script>