<?php $index = [
    1 => 'Awaiting Confirmation',
    2 => 'Processed',
    3 => 'Shipping',
    4 => 'Delivered'
] ?>

<script>
    $(document).ready(function() {
        $('#period-select').change(function() {
            var period = $(this).val();
            window.location.href = "<?= site_url('dashboard/index/'); ?>" + period;
        });

        // Konfigurasi Chart.js untuk menampilkan total penjualan per bulan
        var ctx = document.getElementById("myAreaChart").getContext('2d');

        // Data penjualan bulanan
        var monthlySales = <?php echo json_encode($monthly_sales); ?>;

        // Nilai maksimum
        var maxSales = Math.max.apply(Math, monthlySales);

        // Membulatkan ke atas
        var roundedMaxSales = Math.ceil(maxSales / 100000) * 100000;

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: "Total Sales",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: monthlySales,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: roundedMaxSales,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    });
</script>

<main>
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4 py-3" style="background: #4daa57;">
                    <div class="card-body overflow-hidden position-relative">
                        <i class="fas fa-dollar-sign position-absolute top-50 translate-middle-y end-0" style="font-size: 5rem; margin-right: -10px; color: rgba(239, 239, 239, .4);"></i>
                        <label>Total Sales</label>
                        <h3>Rp <?= number_format($total_sales, 0, ',', '.'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4 py-3" style="background: #54c0f2;">
                    <div class="card-body overflow-hidden position-relative">
                        <i class="fas fa-shopping-cart position-absolute top-50 translate-middle-y end-0" style="font-size: 5rem; margin-right: -10px; color: rgba(239, 239, 239, .4);"></i>
                        <label>Total Orders</label>
                        <h3><?= $total_transaction; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4 py-3" style="background: #ff9843;">
                    <div class="card-body overflow-hidden position-relative">
                        <i class="fas fa-boxes position-absolute top-50 translate-middle-y end-0" style="font-size: 5rem; margin-right: -10px; color: rgba(239, 239, 239, .4);"></i>
                        <label>Total Products</label>
                        <h3><?= $total_product; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-white mb-4 py-3" style="background: #AB3428;">
                    <div class="card-body overflow-hidden position-relative">
                        <i class="fas fa-user position-absolute top-50 translate-middle-y end-0" style="font-size: 5rem; margin-right: -10px; color: rgba(239, 239, 239, .4);"></i>
                        <label>Total Customers</label>
                        <h3><?= $total_customer; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Sales Summary
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="25"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    <label>Orders</label>
                </div>
                <div class="d-inline-flex align-items-center gap-2">
                    <label for="period-select">Period </label>
                    <select id="period-select" class="form-select w-auto">
                        <option value="all-time" <?= ($selected_period == 'all-time') ? 'selected' : ''; ?>>All Time</option>
                        <option value="daily" <?= ($selected_period == 'daily') ? 'selected' : ''; ?>>Today</option>
                        <option value="weekly" <?= ($selected_period == 'weekly') ? 'selected' : ''; ?>>This Week</option>
                        <option value="monthly" <?= ($selected_period == 'monthly') ? 'selected' : ''; ?>>This Month</option>
                        <option value="yearly" <?= ($selected_period == 'yearly') ? 'selected' : ''; ?>>This Year</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Payment Method</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Payment Method</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($transactions as $t) : ?>
                            <?php $status = isset($index[$t['status']]) ? $index[$t['status']] : 'Unknown Status'; ?>
                            <tr>
                                <td><?= $t['id']; ?></td>
                                <td><?= $t['fullname']; ?></td>
                                <td><?= $t['payment_method']; ?></td>
                                <td><?= date('F d, Y H:i:s', $t['date_created']); ?></td>
                                <td><span class="badge <?= $status == 'Delivered' ? 'bg-success' : 'bg-warning text-dark'; ?>"><?= $status; ?></span></td>
                                <td>Rp<?= number_format($t['shopping_total'], 0, ',', '.'); ?></td>
                                <td><a href="<?= base_url('transaction/detail/' . $t['id']); ?>" type="button" class="me-2 mb-2 btn btn-outline-primary" data-id="<?= $t['id']; ?>">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>