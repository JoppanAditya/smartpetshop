<?php
$courier = [
    50000 => 'Instant 3 hours',
    30000 => 'Same Day 8 hours',
    20500 => 'Next Day',
    11500 => 'Regular',
]
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice | Smart Petshop</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>bootstrap-5.3.3-dist/css/bootstrap.min.css" />
</head>

<body class="min-vh-100 d-flex flex-column bg-body-tertiary" style="font-family: 'Montserrat', sans-serif;">
    <style>
        .title-invoice {
            width: 120px !important;
        }

        .text-invoice::before {
            content: ': ';
        }
    </style>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2 d-print-none">
        <div class="container">
            <button type="button" class="btn btn-primary ms-auto" id="printButton"><i class="fas fa-print me-2"></i>Print</button>
        </div>
    </nav>
    <!-- Navbar End -->

    <main>
        <div class="container" style="max-width: 800px; font-size: 12px">
            <div class="d-flex justify-content-between">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Smart Petshop Logo" height="45">
                <div class="text-end">
                    <p class="mb-0 fw-bold" style="font-size: 16px;">INVOICE</p>
                    <span style="color: #3468c0;" class="fw-medium"><?= $transaction['invoice']; ?></span>
                </div>
            </div>
            <div class="mt-4">
                <div class="row">
                    <div class="col-sm-5">
                        <p class="mb-2 fw-bold text-uppercase">PT Smart Petshop Indonesia</p>
                        <p class="mb-0">Jl. Kemerdekaan Petshop No. 12, Kecamatan, Kota, Provinsi, 1110</p>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <p class="mb-2 fw-bold text-uppercase">For:</p>
                        <div class="d-flex flex-nowrap">
                            <p class="mb-1 title-invoice">Buyer</p>
                            <p class="mb-0 fw-bold text-invoice"><?= $transaction['fullname']; ?></p>
                        </div>
                        <div class="d-flex flex-nowrap">
                            <p class="mb-1 title-invoice">Purchase Date</p>
                            <p class="mb-0 fw-bold text-invoice"><?= date('F d, Y', $transaction['date_created']); ?></p>
                        </div>
                        <div class="d-flex flex-nowrap row" style="max-width: 376px; padding: 0 12px; margin-right:12px;">
                            <p class="mb-1 title-invoice col-sm-3 px-0">Shipping Address</p>
                            <div class="col-sm-9 px-0">
                                <p class="mb-0 fw-bold text-invoice"><?= $transaction['name'] ?> <span class="fw-normal">(<?= $transaction['phone']; ?>)</span></p>
                                <p class="mb-0" style="margin-left: 6px;"><?= $transaction['full_address'] . ', ' . $transaction['city'] . ($transaction['notes'] ? ' (' . $transaction['notes'] . ')' : '') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <table class="table table-light">
                        <thead class="table-group-divider">
                            <tr class="text-uppercase">
                                <th scope="col">Item Name</th>
                                <th scope="col" class="text-end">Quantity</th>
                                <th scope="col" class="text-end">Unit Price</th>
                                <th scope="col" class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php $totalPrice = 0 ?>
                            <?php foreach ($items as $i) : ?>
                                <tr>
                                    <?php $subtotal = $i['product_price'] * $i['quantity'] ?>
                                    <td class="fw-medium" style="color: #3468c0; font-size: 14px;"><?= $i['product_name']; ?></td>
                                    <td class="text-end"><?= $i['quantity']; ?></td>
                                    <td class="text-end">Rp<?= number_format($i['product_price'], 0, ',', '.'); ?></td>
                                    <td class="text-end">Rp<?= number_format($subtotal, 0, ',', '.'); ?></td>
                                    <?php $totalPrice += $subtotal ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="ms-auto" style="width: 48%;">
                        <div class="d-flex justify-content-between my-2 fw-bold">
                            <p class="mb-0 text-uppercase">Total Price</p>
                            <p class="mb-0" style="font-size: 14px;">Rp<?= number_format($totalPrice, 0, ',', '.'); ?></p>
                        </div>
                        <div class="d-flex justify-content-between my-1">
                            <p class="mb-0">Delivery Fee Total</p>
                            <p class="mb-0">Rp<?= number_format($transaction['delivery_fee'], 0, ',', '.'); ?></p>
                        </div>
                        <div class="d-flex justify-content-between my-1">
                            <p class="mb-0">Service Fee Total</p>
                            <p class="mb-0">Rp<?= number_format($transaction['service_fee'], 0, ',', '.'); ?></p>
                        </div>
                        <div class="d-flex justify-content-between my-2 fw-bold">
                            <p class="mb-0 text-uppercase">Total Bill</p>
                            <p class="mb-0" style="font-size: 14px;">Rp<?= number_format($transaction['shopping_total'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="mb-1">Courier:</p>
                        <p class="mb-0 fw-bold">
                            <?php foreach ($courier as $key => $value) : ?>
                                <?php if ($transaction['delivery_fee'] == $key) : ?>
                                    <?= $value ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-1">Payment Method:</p>
                        <p class="mb-0 fw-bold">
                        <p class="mb-0 fw-bold"><?= $transaction['payment_method']; ?></p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= base_url('assets/') ?>bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#printButton').on('click', function() {
                window.print();
            });
        });
    </script>

</body>

</html>