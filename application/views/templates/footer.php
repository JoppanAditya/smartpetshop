<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                &copy; <?= date("Y"); ?>
                <a class="text-decoration-none" href="<?= base_url(); ?>" style="color: #3468c0">Smart Petshop Indonesia. </a>
                All rights reserved.
            </div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>js/datatables-simple-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>
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
</script>
</body>

</html>