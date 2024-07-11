<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <div class="card my-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Transaction Detail Data
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Transaction Id</th>
                            <th scope="col">Product Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($trans_detail as $td) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $td['transaction_id']; ?></td>
                                <td><?= $td['product_id']; ?></td>
                                <td><?= $td['product_name']; ?></td>
                                <td>Rp<?= number_format($td['product_price'], 0, ',', '.'); ?></td>
                                <td><?= $td['quantity']; ?></td>
                                <td>Rp<?= number_format($td['product_price'] * $td['quantity'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>