<?php $index = [
    1 => 'Awaiting Confirmation',
    2 => 'Processed',
    3 => 'Shipping',
    4 => 'Delivered'
] ?>

<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <!-- Element untuk menampilkan pesan alert -->
        <?= $this->session->flashdata('message'); ?>

        <div class="card my-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Transaction Data
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Id</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Shopping Total</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Status</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transactions as $t) : ?>
                            <?php $status = isset($index[$t['status']]) ? $index[$t['status']] : 'Unknown Status'; ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $t['id']; ?></td>
                                <td><?= $t['name']; ?></td>
                                <td>Rp<?= number_format($t['shopping_total'], 0, ',', '.'); ?></td>
                                <td><?= $t['payment_method']; ?></td>
                                <td><span class="badge <?= $status == 'Delivered' ? 'bg-success' : 'bg-warning text-dark'; ?>"><?= $status; ?></span></td>
                                <td><a href="<?= base_url('invoice?id=' . urlencode($t['invoice'])); ?>" target="blank"><?= $t['invoice']; ?></a></td>
                                <td><?= date('F d, Y', $t['date_created']); ?></td>
                                <td>
                                    <a href="<?= base_url('transaction/detail/' . $t['id']); ?>" type="button" class="me-2 mb-2 btn btn-outline-primary" data-id="<?= $t['id']; ?>">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </a>

                                    <!-- Update Button trigger modal -->
                                    <button type="button" class="me-2 mb-2 btn btn-outline-success" data-id="<?= $t['id']; ?>" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fas fa-edit me-2"></i>Status
                                    </button>

                                    <!-- Delete Button trigger modal -->
                                    <button type="button" class="mb-2 btn btn-outline-danger" data-id="<?= $t['id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">
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

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" id="update_id">
                        <div class="form-floating">
                            <select class="form-select" id="statusSelect" aria-label="Status">
                                <?php foreach ($index as $key => $value) : ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="statusSelect">Status</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success w-100" id="save-changes">Update Status</button>
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
                    <p>Are you sure you want to delete this product?</p>
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
        // Handle update modal
        $('#updateModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');

            // Clear previous data
            $('#update_id').val('');
            $('#statusSelect').val('');

            $.ajax({
                url: '<?= base_url('transaction/getTransById/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#update_id').val(data.id);
                    $('#statusSelect').val(data.status);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching transaction status:', error);
                }
            })
        });

        // Handle save changes button click
        $('#save-changes').click(function() {
            const id = $('#update_id').val();
            const status = $('#statusSelect').val();

            $.ajax({
                url: '<?= base_url('transaction/updateStatus/') ?>' + id,
                method: 'POST',
                data: {
                    status: status
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error updating selection:', error);
                }
            });
        });
    });
</script>