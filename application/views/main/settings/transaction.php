<?php $status = [
    1 => 'Awaiting Confirmation',
    2 => 'Processed',
    3 => 'Shipping',
    4 => 'Delivered'
]; ?>

<main>
    <div class="container mt-4">

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 text-dark" href="<?= base_url('settings'); ?>">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 text-dark" href="<?= base_url('settings/address'); ?>">Address List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-1 px-2 py-sm-2 px-sm-3 rounded-top-3 active" aria-current="true" href="<?= base_url('settings/transaction'); ?>" style="color: #FF9843; font-weight: 500;">Order List</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- <form class="d-flex nav-search w-50" role="search" action="<?= base_url('shop/search') ?>" method="post">
                        <div class="position-relative w-100">
                            <input class="form-control pe-5" type="search" name="q" placeholder="Search your transaction" aria-label="Search" required value="<?= isset($keyword) ? $keyword : ''; ?>" autocomplete="off" />
                            <button class="btn border-0 position-absolute end-0 top-0 text-secondary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form> -->
                </div>
                <?php foreach ($transactions as $t) : ?>
                    <div class="card mt-3">
                        <div class="card-body text-start row" style="font-size: 14px;">
                            <div class="d-flex gap-2 align-items-center">
                                <p class="mb-0"><?= date('F d, Y', $t['date_created']); ?></p>
                                <span class="badge <?= $t['status'] == 4 ? 'text-bg-success' : 'text-bg-warning'; ?> fw-normal">
                                    <?php foreach ($status as $key => $value) : ?>
                                        <?php if ($key == $t['status']) : ?>
                                            <?= $value; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </span>
                                <a href="<?= base_url('invoice?id=' . urlencode($t['invoice'])); ?>" target="blank" class="mb-0 text-decoration-none" style="color: #3468c0;"><?= $t['invoice']; ?></a>
                            </div>
                            <div class="d-flex mt-3">
                                <img src="<?= base_url('assets/img/product/') . $t['image'] ?>" alt="<?= $t['product_name'] ?>" class="rounded" width="75" height="75">
                                <div class="row w-100 fs-6 ms-2">
                                    <div class="col-md-9 d-flex flex-column">
                                        <a href=<?= base_url('shop/product/') . $t['product_id'] ?> class="text-decoration-none fw-medium text-reset"><?= $t['product_name']; ?></a>
                                        <span class="text-secondary" style="font-size: 14px;"><?= $t['quantity'] . ' &times; ' . number_format($t['product_price'], 0, ',', '.'); ?></span>
                                    </div>
                                    <div class="col-md-3 border-start d-flex justify-content-center flex-column">
                                        <span class="text-secondary" style="font-size: 14px;">Shopping Total</span>
                                        <p class="fw-semibold m-0" style="color: #3468c0;">Rp<?= number_format($t['shopping_total'], 0, ',', '.'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex"></div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

</main>