<main>
    <div class="container my-4">

        <div class="row">
            <h2 class="mb-4">Cart</h2>
            <div class="col-lg-8">
                <section class="mb-4">
                    <div class="card w-100">
                        <ul class="list-group list-group-flush my-3">
                            <?php if ($carts) : ?>
                                <?php $count = count($carts); ?>
                                <?php $subtotal = 0 ?>
                                <?php $total = 0 ?>
                                <?php foreach ($carts as $index => $c) : ?>
                                    <?php $subtotal = $c['quantity'] * $c['product_price'] ?>
                                    <input type="hidden" id="product_id-<?= $index ?>" value="<?= $c['product_id'] ?>">
                                    <input type="hidden" id="user_id-<?= $index ?>" value="<?= $user['user_id'] ?>">
                                    <li class="list-group-item border-0 rounded-4">
                                        <div class="d-flex">
                                            <img src="<?= base_url('assets/img/product/') . $c['product_image'] ?>" alt="<?= $c['product_name'] ?>" class="rounded" width="75" height="75">
                                            <div class="d-flex flex-column w-100 justify-content-between cart-card">
                                                <div class="d-flex justify-content-between w-100 ps-3 fs-5">
                                                    <div class="cart-card-title">
                                                        <a href=<?= base_url('shop/product/') . $c['product_id'] ?> class="text-decoration-none fw-medium text-reset"><?= $c['product_name']; ?></a>
                                                    </div>
                                                    <p class="fw-semibold m-0 cart-price" style="color: #3468c0; height: fit-content;">Rp<?= number_format($c['product_price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <div class="ps-3">
                                                    <?php if ($c['notes']) : ?>
                                                        <p class="fs-6 mb-0 text-secondary">
                                                            Note: <span id="note-text-<?= $index ?>"><?= $c['notes']; ?></span>
                                                            <button class="btn btn-link text-decoration-none p-0 ms-2" style="font-size: 14px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $index ?>" aria-expanded="false" aria-controls="collapse-<?= $index ?>"><i class="fas fa-edit me-1"></i>Change</button>
                                                        </p>

                                                        <div class="collapse" id="collapse-<?= $index ?>">
                                                            <div class="card card-body my-1 form-control form-control-sm">
                                                                <input type="text" id="note-input-<?= $index ?>" name="notes" placeholder="Ex. White Color, M Size" value="<?= $c['notes']; ?>" class="border-0 border-bottom form-control" style="outline: unset;" autofocus>
                                                                <button type="button" class="btn btn-primary mt-3" onclick="updateCart(<?= $index ?>)">Save</button>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <p class="fs-6 mb-0 text-secondary">
                                                            Note: <span id="note-text-<?= $index ?>"><?= $c['notes']; ?></span>
                                                            <button class="btn btn-link text-decoration-none p-0 ms-2" style="font-size: 14px;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $index ?>" aria-expanded="false" aria-controls="collapse-<?= $index ?>"><i class="fas fa-edit me-1"></i>Add notes</button>
                                                        </p>

                                                        <div class="collapse" id="collapse-<?= $index ?>">
                                                            <div class="card card-body my-1 form-control form-control-sm">
                                                                <input type="text" id="note-input-<?= $index ?>" name="notes" placeholder="Ex. White Color, M Size" value="<?= $c['notes']; ?>" class="border-0 border-bottom form-control" style="outline: unset;" autofocus>
                                                                <button type="button" class="btn btn-primary mt-3" onclick="updateCart(<?= $index ?>)">Save</button>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                                <div class="d-flex align-items-center ms-auto fs-5 text-secondary gap-3">
                                                    <button type="button" class="btn border-0 p-0 text-reset fs-6"><i class="fas fa-heart"></i></button>
                                                    <button type="button" onclick="deleteCart(<?= $index ?>)" class="btn border-0 p-0 text-reset fs-6"><i class="fas fa-trash-alt"></i></button>
                                                    <div class="input-group border rounded-2 fs-6 align-items-center">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm border-0" style="color: #ff9843;" onclick="updateCart(<?= $index ?>, 'decrement')"><i class="fas fa-minus"></i></button>
                                                        </span>
                                                        <input type="number" id="inputValue-<?= $index ?>" name="quantity" class="form-control text-center border-0 fs-6" style="width: 3rem; height: 1rem;" value="<?= $c['quantity'] ?>" min="1" max="20" oninput="updateCart(<?= $index ?>)" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm border-0" style="color: #ff9843;" onclick="updateCart(<?= $index ?>, 'increment')"><i class="fas fa-plus"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php if ($index < $count - 1) : ?>
                                        <hr>
                                    <?php endif; ?>
                                    <?php $total += $subtotal ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="d-block d-lg-flex text-center text-lg-start justify-content-center align-items-center gap-4 p-4">
                                    <img src="<?= base_url('assets/') ?>img/empty-cart.png" alt="empty cart" class="img-thumbnail" width="200" height="200">
                                    <div>
                                        <h4 class="mb-3 mt-3">Your cart is empty</h4>
                                        <p class="mb-3">Want something? Add it to your cart now!</p>
                                        <a href="<?= base_url('shop') ?>" class="btn btn-primary px-5 py-2">Shop Now</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </ul>
                    </div>
                </section>
                <section class="my-4">
                    <h2 class="py-4">Recommendation for you</h2>
                    <!-- Card Start -->
                    <div class="d-flex align-content-start justify-content-center flex-wrap gap-2 mb-4 product-card">
                        <!-- Card -->
                        <?php foreach ($products as $p) : ?>
                            <div class="card" style="width: 13rem">
                                <a href="<?= base_url('shop/product/') . $p['id'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?= base_url('assets/img/product/') . $p['image'] ?>" class="card-img-top" alt="<?= $p['name'] ?> Image" />

                                    <div class="card-body">
                                        <div class="card-title-wrapper">
                                            <p class="card-title mb-1 text-break"><?= $p['name'] ?></p>
                                        </div>
                                        <p class="card-text price mb-1" style="color: #3468c0; font-size: 18px"><strong>Rp<?= number_format($p['sell_price'], 0, ',', '.'); ?></strong></p>
                                        <p class="card-text" style="font-size: 15px">
                                            <span><i class="fa fa-star" style="color: #ff9843"></i> <?= round($p['rating'], 1); ?> | </span>100+ terjual
                                        </p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Card End -->
                </section>
            </div>

            <div class="position-fixed fixed-bottom d-lg-none bg-body-tertiary py-3 border border-top">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <p class="card-text mb-1">Total</p>
                        <p class="fw-semibold mb-0">
                            <?php if (isset($total) && $total != 0) : ?>
                                Rp<?= number_format($total, 0, ',', '.'); ?>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </p>
                    </div>
                    <a href="<?= base_url('cart/address') ?>" class="btn btn-primary py-2">Buy
                        <?php if ($this->session->userdata('total_cart')) : ?>
                            <span>(<?= $this->session->userdata('total_cart'); ?>)</span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 mb-4 d-lg-block d-none">
                <div class="card my-card position-sticky" style="top: 2rem;">
                    <div class="card-body">
                        <h5>Shopping summary</h5>
                        <div class="d-flex justify-content-between">
                            <p class="card-text">Total</p>
                            <p class="fw-semibold">
                                <?php if (isset($total) && $total != 0) : ?>
                                    Rp<?= number_format($total, 0, ',', '.'); ?>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </p>
                        </div>
                        <a href="<?= base_url('cart/address') ?>" class="btn btn-primary w-100 py-2">Buy
                            <?php if ($this->session->userdata('total_cart')) : ?>
                                <span>(<?= $this->session->userdata('total_cart'); ?>)</span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        const flashdata = $('.flash-data').data('flashdata');
        const flashdatastatus = $('.flash-data').data('flashdatastatus');

        if (flashdata) {
            Swal.fire({
                position: 'top',
                icon: flashdatastatus === 'success' ? 'success' : 'error',
                title: flashdatastatus === 'success' ? 'Congratulations!' : 'Oops...',
                text: flashdata,
                showConfirmButton: false,
                timer: 2500
            });
        }
    });


    const updateCart = (index, action = null) => {
        let inputQuantity = $('#inputValue-' + index);
        let quantity = parseInt(inputQuantity.val());
        let noteInput = $('#note-input-' + index) ? $('#note-input-' + index).val() : null;
        let productId = $('#product_id-' + index).val();
        let userId = $('#user_id-' + index).val();

        if (action === 'increment' && quantity < 20) {
            quantity += 1;
            inputQuantity.val(quantity);
        } else if (action === 'decrement' && quantity > 1) {
            quantity -= 1;
            inputQuantity.val(quantity);
        }

        $.ajax({
            url: '<?= base_url('cart/updateCart') ?>',
            type: 'POST',
            data: {
                product_id: productId,
                user_id: userId,
                quantity: quantity,
                notes: noteInput
            },
            success: (response) => {
                console.log(response);
                if (noteInput !== null) {
                    $('#note-text-' + index).text(noteInput);
                }
            },
            error: (xhr, status, error) => {
                console.error(xhr.responseText);
            }
        });
    };

    const deleteCart = (index) => {
        const productId = $('#product_id-' + index).val();
        const userId = $('#user_id-' + index).val();

        $.ajax({
            url: '<?= base_url('cart/deleteCart') ?>',
            type: 'POST',
            data: {
                product_id: productId,
                user_id: userId
            },
            success: (response) => {
                console.log(response);
                window.location.reload();
            },
            error: (xhr, status, error) => {
                console.error(xhr.responseText);
            }
        });
    };
</script>