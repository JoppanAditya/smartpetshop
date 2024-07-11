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

<body class="min-vh-100 d-flex flex-column">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand m-0" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#ConfirmModal">
                <img src="<?= base_url('assets/') ?>img/logo.png" alt="logo smart petshop" height="50" />
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <main>
        <div class="container my-4">
            <div class="row">
                <h2 class="mb-4">Delivery</h2>
                <div class="col-sm-8">
                    <section class="mb-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="fs-5 text-secondary">Delivery Address</h4>
                                <?php if (!empty($address)) : ?>
                                    <?php foreach ($address as $a) : ?>
                                        <?php if ($a['is_selected'] == 1) : ?>
                                            <form method="post">
                                                <input type="hidden" id="user_id" value="<?= $a['user_id'] ?>">
                                                <input type="hidden" id="address_id" value="<?= $a['id'] ?>">
                                            </form>
                                            <div class="d-flex gap-2 align-items-center mb-2">
                                                <i class="fas fa-map-marker-alt" style="color: #3468c0;"></i>
                                                <p class="mb-0 fw-medium">
                                                    <?= $a['label']; ?>
                                                    &VerticalLine;
                                                    <?= $a['name']; ?>
                                                </p>
                                            </div>
                                            <p>
                                                <?= $a['full_address']; ?>
                                                <?= $a['notes'] ? ' (' . $a['notes'] . '), ' : ''; ?>
                                                <?= $a['city'] . ', ' . $a['phone']; ?>
                                            </p>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addressModal">Change Address</button>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <!-- Add Button trigger modal -->
                                    <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="fas fa-plus me-1"></i>
                                        Add New Address
                                    </button>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group list-group-flush my-3">
                                    <?php $subtotal = 0 ?>
                                    <?php $totalPrice = 0 ?>
                                    <?php $deliveryFee = 0 ?>
                                    <?php $serviceFee = 1000 ?>
                                    <?php $shoppingTotal = 0 ?>
                                    <?php foreach ($carts as $index => $c) : ?>
                                        <?php $subtotal = $c['quantity'] * $c['product_price'] ?>
                                        <form method="post">
                                            <input type="hidden" name="items[<?= $index ?>][id]" value="<?= $c['product_id'] ?>">
                                            <input type="hidden" name="items[<?= $index ?>][price]" value="<?= $c['product_price'] ?>">
                                            <input type="hidden" name="items[<?= $index ?>][quantity]" value="<?= $c['quantity'] ?>">
                                            <input type="hidden" name="items[<?= $index ?>][name]" value="<?= $c['product_name'] ?>">
                                        </form>
                                        <li class="list-group-item border-0 rounded-4">
                                            <div class="dropdown-item d-flex justify-content-between text-reset text-decoration-none">
                                                <div class="d-flex align-items-start gap-3">
                                                    <img src="<?= base_url('assets/img/product/') . $c['product_image'] ?>" alt="<?= $c['product_name'] ?>" class="rounded" width="75" height="75">
                                                    <p class="d-inline-block text-wrap text-decoration-none fw-medium" style="max-width: 250px;"><?= $c['product_name'] ?></p>
                                                </div>
                                                <p class="fw-semibold"><span><?= $c['quantity'] ?></span> &times; Rp<?= number_format($c['product_price'], 0, ',', '.'); ?></p>
                                            </div>
                                        </li>
                                        <hr>
                                        <?php $totalPrice += $subtotal ?>
                                    <?php endforeach; ?>

                                    <select class="form-select my-2" aria-label="Delivery select" id="deliverySelect">
                                        <option selected disabled>Select Delivery</option>
                                        <option value="50000">Instant 3 hours</option>
                                        <option value="30000">Same Day 8 hours</option>
                                        <option value="20500">Next Day</option>
                                        <option value="11500">Regular</option>
                                    </select>

                                    <select class="form-select mt-2" aria-label="Payment select" id="paymentSelect">
                                        <option selected disabled>Select Payment Method</option>
                                        <option value="1">COD</option>
                                        <option value="2">E-Wallet</option>
                                        <option value="3">Bank Transfer</option>
                                        <option value="4">Credit or Debit Card</option>
                                    </select>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-sm-4">
                    <div class="card my-card position-sticky" style="top: 2rem;">
                        <div class="card-body">
                            <h5>Shopping summary</h5>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="card-text text-muted mb-0">Total Price</p>
                                <p class="mb-0">Rp<?= number_format($totalPrice, 0, ',', '.'); ?></p>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="card-text text-muted mb-0">Total Delivery Fee</p>
                                <p class="mb-0" id="deliveryFee">-</p>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <p class="card-text text-muted mb-0">App Services Fee</p>
                                <p class="mb-0" id="serviceFee">-</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="card-text text-muted mb-0">Payment Method</p>
                                <p class="mb-0" id="paymentMethod">-</p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="card-text mb-0">Shopping Total</p>
                                <p class="fw-semibold mb-0" id="shoppingTotal">-</p>
                            </div>
                            <hr>

                            <form id="transactionForm" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="serviceFee" id="serviceFeeInput" value="<?= $serviceFee ?>">
                                <input type="hidden" name="deliveryFee" id="deliveryFeeInput">
                                <input type="hidden" name="shoppingTotal" id="shoppingTotalInput">
                                <input type="hidden" name="paymentMethod" id="paymentMethodInput">
                                <button type="submit" class="btn btn-primary w-100 py-2" id="pay-button">Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="ConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <h4 class="fw-semibold">Back To Cart?</h4>
                    <p style="font-size: 14px;">Discard all changes and return to cart?</p>
                    <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Stay On This Page</button>
                    <a type="button" class="btn btn-link text-decoration-none mt-2" href="<?= base_url('cart') ?>">Back and Discard Changes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Modal -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addressModalLabel">Add Address Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="add_user_id" id="add_user_id" value="<?= $user['user_id'] ?>">
                <div class="modal-body">
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

    <!-- Copyright -->
    <div class="text-center py-3 bg-body-tertiary mt-auto">
        &copy; <?= date("Y"); ?> Smart Petshop Indonesia. All rights reserved.
    </div>
    <!-- Copyright -->

    <script src="<?= base_url('assets/') ?>bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(() => {
            $('#pay-button').attr('disabled', 'disabled');

            const checkButtonState = () => {
                const deliverySelected = $('#deliverySelect').val();
                const paymentSelected = $('#paymentSelect').val();
                const address = JSON.parse('<?= json_encode($address) ?>');

                const addressSelected = address.some(a => a.is_selected == 1);

                if (deliverySelected && paymentSelected && addressSelected) {
                    $('#pay-button').removeAttr('disabled');
                } else {
                    $('#pay-button').attr('disabled', 'disabled');
                }
            }


            $('#deliverySelect').change((e) => {
                const selectedValue = parseInt(e.target.value);
                const deliveryFee = selectedValue;
                const totalPrice = <?= $totalPrice ?>;
                const serviceFee = <?= $serviceFee ?>;
                const shoppingTotal = totalPrice + deliveryFee + serviceFee;

                $('#deliveryFee').text('Rp' + deliveryFee.toLocaleString('id-ID'));
                $('#serviceFee').text('Rp' + serviceFee.toLocaleString('id-ID'));
                $('#shoppingTotal').text('Rp' + shoppingTotal.toLocaleString('id-ID'));
                $('#deliveryFeeInput').val(deliveryFee);
                $('#shoppingTotalInput').val(shoppingTotal);

                checkButtonState();
            });

            $('#paymentSelect').change((e) => {
                const selectedValue = parseInt(e.target.value);
                let paymentMethod = '';
                if (selectedValue == 1) {
                    paymentMethod = 'COD';
                } else if (selectedValue == 2) {
                    paymentMethod = 'E-Wallet';
                } else if (selectedValue == 3) {
                    paymentMethod = 'Bank Transfer';
                } else if (selectedValue == 4) {
                    paymentMethod = 'Credit or Debit Card';
                }

                $('#paymentMethod').text(paymentMethod);
                $('#paymentMethodInput').val(paymentMethod);

                checkButtonState();
            });

            $('#pay-button').click((e) => {
                e.preventDefault();
                const deliveryFee = $('#deliveryFeeInput').val();
                const serviceFee = $('#serviceFeeInput').val();
                const shoppingTotal = $('#shoppingTotalInput').val();
                const user_id = $('#user_id').val();
                const address_id = $('#address_id').val();
                const paymentMethod = $('#paymentMethodInput').val();

                const items = [];
                $('input[name^="items"]').each(function() {
                    const name = $(this).attr('name');
                    const value = $(this).val();
                    const nameParts = name.match(/items\[(\d+)\]\[(\w+)\]/);
                    const index = nameParts[1];
                    const key = nameParts[2];

                    if (!items[index]) {
                        items[index] = {};
                    }
                    items[index][key] = value;
                });

                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?= base_url('cart/payment') ?>',
                    data: {
                        deliveryFee: deliveryFee,
                        serviceFee: serviceFee,
                        shoppingTotal: shoppingTotal,
                        user_id: user_id,
                        address_id: address_id,
                        paymentMethod: paymentMethod,
                        items: items
                    },
                    success: (response) => {
                        if (response.status === "success") {
                            window.location.href = '<?= base_url('shop') ?>';
                        } else {
                            window.location.href = '<?= base_url('cart') ?>';
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                        window.location.href = '<?= base_url('cart') ?>';
                    }
                });
            });

            // Handle Add
            $('#save-add').click((e) => {
                e.preventDefault();

                const user_id = $('#add_user_id').val();
                const name = $('#add_user_name').val();
                const phone = $('#add_user_phone').val();
                const label = $('#add_address_label').val();
                const city = $('#add_address_city').val();
                const full_address = $('#add_address_full').val();
                const notes = $('#add_address_notes').val();

                $.ajax({
                    method: 'POST',
                    dataType: 'json',
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
                    success: (response) => {
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
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Handle Update
            $('#updateModal').on('show.bs.modal', (e) => {
                const button = $(e.relatedTarget);
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
                    success: (data) => {
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
                    error: (xhr, status, error) => {
                        console.error('Error fetching address details:', error);
                    }
                });
            });

            // Handle Save Changes
            $('#save-changes').click((e) => {
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
                    success: (response) => {
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
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Handle Select
            $('.select-button').click((e) => {
                const button = $(e.target);
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
                    success: (response) => {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error updating selection:', error);
                    }
                });
            });

            // Handle Primary Select
            $('.primary-button').click((e) => {
                const button = $(e.target);
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
                    success: (response) => {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error updating selection:', error);
                    }
                });
            });

            // Handle Delete
            $('#deleteModal').on('show.bs.modal', (e) => {
                const button = $(e.relatedTarget);
                const id = button.data('id');

                $('#deleteButton').off('click').on('click', () => {
                    location.reload();
                });
            });
        });
    </script>

</body>

</html>