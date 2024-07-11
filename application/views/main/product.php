<?php
$isLoggedIn = false;
if ($this->session->userdata('username')) {
    $isLoggedIn = true;
}

function formatDate($date)
{
    return date('F j', strtotime($date));
}

$today = date('Y-m-d');
$startDate = date('Y-m-d', strtotime($today . ' +1 day'));
$endDate = date('Y-m-d', strtotime($today . ' +4 days'));

$formattedStartDate = formatDate($startDate);
$formattedEndDate = formatDate($endDate);
?>

<main>
    <div class="container my-4 px-0">
        <!-- Row -->
        <div class="row px-lg-3 mx-0">
            <!-- Left Col -->
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-5">
                        <img src=" <?= base_url('assets/img/product/') . $product['image'] ?>" alt="name" class="rounded-4 ratio-1x1 w-100">
                    </div>
                    <div class="col-lg-7">
                        <h5 class="d-none d-lg-block fw-semibold fs-4"><?= $product['name']; ?></h5>
                        <div class="mt-2 d-none d-lg-inline-flex text-secondary">
                            <p class="me-2"><span class="fw-medium text-dark">100+</span> Sold</p>
                            &VerticalLine;
                            <p class="mx-2"><span class="fw-medium text-dark"><i class="fas fa-star me-2" style="color: #ff9843;"></i><?= round($product['rating'], 1); ?></span> (250 Ratings)</p>
                            &VerticalLine;
                            <p class="ms-2"><span class="fw-medium text-dark">100+</span> Discussions</p>
                        </div>
                        <h5 class="fw-bold mt-4 mt-lg-0 fs-2">Rp<?= number_format($product['sell_price'], 0, ',', '.'); ?></h5>

                        <div class="mt-2 d-lg-none d-inline-flex text-secondary">
                            <p class="me-2 mb-0"><span class="fw-medium text-dark">100+</span> Sold</p>
                            &VerticalLine;
                            <p class="mx-2 mb-0"><span class="fw-medium text-dark"><i class="fas fa-star me-2" style="color: #ff9843;"></i><?= round($product['rating'], 1); ?></span> (250)</p>
                            &VerticalLine;
                            <p class="ms-2 mb-0"><span class="fw-medium text-dark">100+</span> Discussions</p>
                        </div>

                        <h4 class="fw-medium fs-5 mt-4 mb-3 pt-3 border-top">Product Description</h4>
                        <p><?= $product['description']; ?></p>

                        <h4 class="fw-medium fs-5 mt-2 mb-3 pt-3 border-top">Shipping</h4>
                        <div class="d-flex flex-column">
                            <p><i class="fas fa-map-marker-alt fa-fw me-2"></i>Shipped from <span class="fw-medium">West Jakarta</span></p>
                            <div>
                                <p class="mb-1"><i class="fas fa-truck fa-fw me-2"></i>Shipping fee <span class="fw-medium">Rp11.500</span></p>
                                <p class="text-secondary"><i class="fas fa-truck fa-fw me-2" style="color: transparent;"></i>Estimated arrival <?= $formattedStartDate ?> - <?= $formattedEndDate ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-4">
                    <h3>Product Ratings</h3>
                    <div class="col-lg-4">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star fa-fw fs-2 me-4" style="color: #ff9843;"></i>
                                <p class="mb-0" style="font-size: 5rem;"><?= round($product['rating'], 1); ?> <span class="fs-5 text-secondary mt-auto" style="margin-left: -1.5rem;">/ 5.0</span> </p>
                            </div>
                            <p class="fw-medium mb-1">96% buyers are satisfied</p>
                            <div class="d-flex">
                                <p class="mb-0 me-2">250 ratings</p>
                                &VerticalSeparator;
                                <p class="mb-0 ms-2">100 reviews</p>
                            </div>
                        </div>
                        <table class="mt-4">
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-1 me-3">
                                        <i class="fas fa-star fa-fw" style="color: #ff9843;"></i>
                                        <p class="fw-medium mb-0 mx-auto">5</p>
                                    </div>
                                </td>
                                <td class="w-100">
                                    <div class="progress w-100" role="progressbar" aria-label="Basic example" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 95%"></div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-secondary mb-0 ms-3">200</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-1 me-3">
                                        <i class="fas fa-star fa-fw" style="color: #ff9843;"></i>
                                        <p class="fw-medium mb-0 mx-auto">4</p>
                                    </div>
                                </td>
                                <td class="w-100">
                                    <div class="progress w-100" role="progressbar" aria-label="Basic example" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-secondary mb-0 ms-3">45</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-1 me-3">
                                        <i class="fas fa-star fa-fw" style="color: #ff9843;"></i>
                                        <p class="fw-medium mb-0 mx-auto">3</p>
                                    </div>
                                </td>
                                <td class="w-100">
                                    <div class="progress w-100" role="progressbar" aria-label="Basic example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 10%"></div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-secondary mb-0 ms-3">3</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-1 me-3">
                                        <i class="fas fa-star fa-fw" style="color: #ff9843;"></i>
                                        <p class="fw-medium mb-0 mx-auto">2</p>
                                    </div>
                                </td>
                                <td class="w-100">
                                    <div class="progress w-100" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 0%"></div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-secondary mb-0 ms-3">0</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-1 me-3">
                                        <i class="fas fa-star fa-fw" style="color: #ff9843;"></i>
                                        <p class="fw-medium mb-0 mx-auto">1</p>
                                    </div>
                                </td>
                                <td class="w-100">
                                    <div class="progress w-100" role="progressbar" aria-label="Basic example" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: 3%"></div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-secondary mb-0 ms-3">2</p>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-8">
                        <?php $i = 1; ?>
                        <?php while ($i <= 3) : ?>
                            <div class="py-3 border-bottom border-top" style="font-size: 14px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-secondary">
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star me-2" style="color: #ff9843;"></i>
                                        &VerticalLine;
                                        <span class="ms-2">Yesterday</span>
                                    </div>
                                    <button class="btn border-0 p-0"><i class="fas fa-ellipsis-v"></i></button>
                                </div>
                                <div class="d-flex gap-2 align-items-center my-2">
                                    <img src="<?= base_url('assets/img/profile/image.jpg') ?>" alt="name" class="rounded-circle" width="40" height="40">
                                    <p class="mb-0 fw-semibold">Name</p>
                                </div>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem, possimus pariatur magni laboriosam beatae nobis!</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <button class="btn p-0 border-0 text-secondary" style="font-size: 14px;">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span class="ms-2">Very Helpful</span>
                                    </button>
                                    <button class="btn p-0 border-0 text-primary" style="font-size: 14px;" type="button" data-bs-toggle="collapse" data-bs-target="#reply-<?= $i ?>" aria-expanded="false" aria-controls="reply-<?= $i ?>">
                                        View Replies
                                    </button>
                                </div>

                                <div class="collapse mt-2" id="reply-<?= $i ?>">
                                    <div class="card card-body bg-body-secondary">
                                        <div class="d-inline-flex gap-2 align-items-center" style="font-size: 14px;">
                                            <img src="<?= base_url('assets/img/profile/myprofile.jpg') ?>" alt="name" class="rounded-circle" width="40" height="40">
                                            <p class="mb-0 fw-semibold">Name</p>
                                            <span class="badge text-bg-primary fw-medium">Seller</span>
                                            &VerticalLine;
                                            <span class="text-secondary">June 1</span>
                                        </div>
                                        <p class="mb-0 mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique inventore praesentium officiis nostrum, ipsam ab?</p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-3 border-bottom border-top" style="font-size: 14px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-secondary">
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star" style="color: #ff9843;"></i>
                                        <i class="fas fa-star me-2" style="color: #ff9843;"></i>
                                        &VerticalLine;
                                        <span class="ms-2">1 month ago</span>
                                    </div>
                                    <button class="btn border-0 p-0"><i class="fas fa-ellipsis-v"></i></button>
                                </div>
                                <div class="d-flex gap-2 align-items-center my-2">
                                    <img src="<?= base_url('assets/img/profile/default.jpg') ?>" alt="name" class="rounded-circle" width="40" height="40">
                                    <p class="mb-0 fw-semibold">Name</p>
                                </div>
                                <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem, possimus pariatur magni laboriosam beatae nobis!</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <button class="btn p-0 border-0 text-secondary" style="font-size: 14px;">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span class="ms-2">Very Helpful</span>
                                    </button>
                                    <button class="btn p-0 border-0 text-primary" style="font-size: 14px;" type="button" data-bs-toggle="collapse" data-bs-target="#reply-<?= $i + 5 ?>" aria-expanded="false" aria-controls="reply-<?= $i + 5 ?>">
                                        View Replies
                                    </button>
                                </div>

                                <div class="collapse mt-2" id="reply-<?= $i + 5 ?>">
                                    <div class="card card-body bg-body-secondary">
                                        <div class="d-inline-flex gap-2 align-items-center" style="font-size: 14px;">
                                            <img src="<?= base_url('assets/img/profile/myprofile.jpg') ?>" alt="name" class="rounded-circle" width="40" height="40">
                                            <p class="mb-0 fw-semibold">Name</p>
                                            <span class="badge text-bg-primary fw-medium">Seller</span>
                                            &VerticalLine;
                                            <span class="text-secondary">June 1</span>
                                        </div>
                                        <p class="mb-0 mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique inventore praesentium officiis nostrum, ipsam ab?</p>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="row py-4">
                    <h3>Discussions</h3>
                    <?php $j = 1; ?>
                    <?php while ($j <= 6) : ?>
                        <div class="card p-0 my-2">
                            <div class="card-body py-0">
                                <div class="row my-4">
                                    <div class="col-lg-10 d-flex gap-3">
                                        <img src="<?= base_url('assets/img/profile/image.jpg') ?>" alt="name" class="rounded-circle" width="50" height="50">
                                        <div style="font-size: 14px;">
                                            <div class="d-inline-flex gap-2">
                                                <p class="mb-0 fw-semibold">Name</p>
                                                &VerticalLine;
                                                <span class="text-secondary">June 1</span>
                                            </div>
                                            <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique inventore praesentium officiis nostrum, ipsam ab?</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex justify-content-end align-items-start">
                                        <button class="btn border-0 p-0"><i class="fas fa-ellipsis-v"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-0" style="padding-left: 5rem;">
                                <div class="row my-4">
                                    <div class="col-lg-10 d-flex gap-3">
                                        <img src="<?= base_url('assets/img/profile/myprofile.jpg') ?>" alt="name" class="rounded-circle" width="50" height="50">
                                        <div style="font-size: 14px;">
                                            <div class="d-inline-flex gap-2">
                                                <p class="mb-0 fw-semibold">Name</p>
                                                <span class="badge text-bg-primary fw-medium">Seller</span>
                                                &VerticalLine;
                                                <span class="text-secondary">June 1</span>
                                            </div>
                                            <p class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime, ratione!</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex justify-content-end align-items-start">
                                        <button class="btn border-0 p-0"><i class="fas fa-ellipsis-v"></i></button>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="d-flex gap-3">
                                        <img src="<?= base_url('assets/img/profile/default.jpg') ?>" alt="name" class="rounded-circle" width="50" height="50">
                                        <input type="text" class="form-control w-100" placeholder="Type your comments here..." style="font-size: 14px; height: 2rem;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $j++; ?>
                    <?php endwhile; ?>
                </div>

            </div>

            <!-- Right Col -->
            <div class="col-lg-3 pb-4 d-none d-lg-block">
                <div class="card my-card position-sticky" style="top: 2rem;">
                    <div class="card-body">
                        <form action="<?= base_url('shop/addCart') ?>" method="post">
                            <h5>Set amounts and notes</h5>
                            <div class="my-4">
                                <div class="d-flex align-items-center gap-4 mb-1">
                                    <div class="align-items-center input-group border rounded-2 fs-6" style="width: 7rem;">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-sm border-0" style="color: #ff9843;" onclick="decrementValue(event)"><i class="fas fa-minus"></i></button>
                                        </span>
                                        <input type="number" id="inputValue" name="quantity" class="form-control text-center border-0 fs-6" value="1" min="1" max="20" oninput="updateSubtotal()" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-sm border-0" style="color: #ff9843;" onclick="incrementValue(event)"><i class="fas fa-plus"></i></button>
                                        </span>
                                    </div>
                                    <p class="card-text">Stock: <strong class="ms-auto"><?= $product['stock']; ?></strong></p>
                                </div>
                                <small class="text-secondary">Max. purchase 20</small>
                            </div>

                            <button class="btn btn-link text-decoration-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-pen me-2"></i>Add Note</button>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body mt-1">
                                    <input type="text" name="notes" placeholder="Ex. White Color, M Size" class="border-0" style="outline: unset;">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center my-4">
                                <p class="card-text m-0">Subtotal:</p>
                                <strong id="subtotal">Rp<?= number_format($product['sell_price'], 0, ',', '.'); ?></strong>
                            </div>
                            <?php if (!$isLoggedIn) : ?>
                                <a type="button" href="<?= base_url('auth/') ?>" class="btn btn-primary w-100 py-2"><i class="fas fa-cart-plus me-2"></i>Add To Cart</a>
                            <?php else : ?>
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" class="btn btn-primary w-100 py-2" <?= $product['stock'] <= 0 ? 'disabled' : ''; ?>><i class="fas fa-cart-plus me-2"></i>Add To Cart</button>
                            <?php endif; ?>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <button type="button" class="btn border-0"><i class="fas fa-heart me-2"></i>Add To Wishlist</button>
                                &VerticalLine;
                                <button type="button" class="btn border-0"><i class="fas fa-share-alt me-2"></i>Share</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container d-lg-none d-inline-flex justify-content-between align-items-center position-fixed fixed-bottom w-100 bg-body-tertiary py-2 border border-top shadow">
                <div class="d-flex align-items-center mt-2">
                    <button type="button" class="btn border-0"><i class="fas fa-heart me-2"></i></button>
                    &VerticalLine;
                    <button type="button" class="btn border-0"><i class="fas fa-share-alt me-2"></i></button>
                </div>
                <?php if (!$isLoggedIn) : ?>
                    <a type="button" href="<?= base_url('auth/') ?>" class="btn btn-primary py-2"><i class="fas fa-cart-plus me-2"></i>Add To Cart</a>
                <?php else : ?>
                    <form action="<?= base_url('shop/addCart') ?>" method="post">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="notes" value="">
                        <button type="submit" class="btn btn-primary py-2" <?= $product['stock'] <= 0 ? 'disabled' : ''; ?>><i class="fas fa-cart-plus me-2"></i>Add To Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>


        <div class="pt-4 w-100 container">
            <h3 class="py-3">Similar Products</h3>
            <!-- Card Start -->
            <div class="product-card d-flex align-content-start justify-content-center flex-wrap gap-2 mb-4">
                <!-- Card -->
                <?php foreach ($similarProducts as $p) : ?>
                    <div class="card" style="width: 13rem">
                        <a href="<?= base_url('shop/product/') . $p['id'] ?>" class="text-decoration-none text-dark">
                            <img src="<?= base_url('assets/img/product/') . $p['image'] ?>" class="card-img-top" alt="<?= $p['name'] ?> Image" />

                            <div class="card-body">
                                <p class="card-title mb-1 text-break"><?= $p['name'] ?></p>
                                <p class="card-text mb-1" style="color: #3468c0; font-size: 18px"><strong>Rp<?= number_format($p['sell_price'], 0, ',', '.'); ?></strong></p>
                                <p class="card-text" style="font-size: 15px">
                                    <span><i class="fa fa-star" style="color: #ff9843"></i><?= round($p['rating'], 1); ?> | </span>100+ terjual
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Card End -->
        </div>
    </div>
</main>

<script>
    const unitPrice = <?= $product['sell_price']; ?>;

    function updateSubtotal() {
        const input = document.getElementById('inputValue');
        const subtotalElement = document.getElementById('subtotal');
        let currentValue = parseInt(input.value);

        if (currentValue > 20) {
            currentValue = 20;
            input.value = 20;
        }

        const subtotal = currentValue * unitPrice;
        subtotalElement.textContent = 'Rp' + subtotal.toLocaleString('id-ID');
    }

    function incrementValue(event) {
        event.preventDefault();
        const input = document.getElementById('inputValue');
        const currentValue = parseInt(input.value);
        if (!isNaN(currentValue) && currentValue < <?= $product['stock']; ?> && currentValue < 20) {
            input.value = currentValue + 1;
            updateSubtotal();
        }
    }

    function decrementValue(event) {
        event.preventDefault();
        const input = document.getElementById('inputValue');
        const currentValue = parseInt(input.value);
        if (!isNaN(currentValue) && currentValue > 1) {
            input.value = currentValue - 1;
            updateSubtotal();
        }
    }

    updateSubtotal();
</script>