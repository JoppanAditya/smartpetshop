<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/'); ?>js/scripts.js"></script>
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