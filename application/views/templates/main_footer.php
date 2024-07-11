<!-- Footer Start -->
<footer class="text-center text-lg-start border-top mt-5 p-4" style="border-color: rgba(0, 0, 0, 0.1) !important">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!-- Section: Links -->
        <section>
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <div>
                        <img src="<?= base_url('assets/') ?>img/logo.png" alt="Logo Smart Petshop" class="w-100" />
                    </div>
                    <h5 class="text-primary mt-3" style="font-weight: 500">PT Smart Petshop Indonesia</h5>
                    <p>Jl. Kemerdekaan Petshop No. 12, Kecamatan, Kota, Provinsi, 1110</p>

                    <!-- Social media -->
                    <div class="mb-4">
                        <!-- Facebook -->
                        <a class="btn btn-social m-1" style="background-color: #bbb; border-radius: 50%" target="_blank" href="https://facebook.com" role="button"><i class="fab fa-facebook-f"></i></a>
                        <!-- Instagram -->
                        <a class="btn btn-social m-1" style="background-color: #bbb; border-radius: 50%" target="_blank" href="https://instagram.com" role="button"><i class="fab fa-instagram"></i></a>
                        <!-- X -->
                        <a class="btn btn-social m-1" style="background-color: #bbb; border-radius: 50%" target="_blank" href="https://x.com" role="button"><i class="fab fa-twitter"></i></a>
                        <!-- Tiktok -->
                        <a class="btn btn-social m-1" style="background-color: #bbb; border-radius: 50%" target="_blank" href="https://tiktok.com" role="button"><i class="fab fa-tiktok"></i></a>
                        <!-- Youtube -->
                        <a class="btn btn-social m-1" style="background-color: #bbb; border-radius: 50%" target="_blank" href="https://youtube.com" role="button"><i class="fab fa-youtube"></i></a>
                    </div>
                    <!-- Social media -->
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-primary mb-3" style="font-weight: 500">Smart Petshop</h5>

                    <ul class="list-unstyled mb-0 footer-links">
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">About Us</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Career</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Blog</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark text-decoration-none">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-primary mb-3" style="font-weight: 500">E-Commerce</h5>

                    <ul class="list-unstyled mb-0 footer-links">
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Tokopedia</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Tiktok Shop</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Shopee</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Blibli</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Lazada</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark text-decoration-none">Bukalapak</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-primary mb-3" style="font-weight: 500">Our Services</h5>

                    <ul class="list-unstyled mb-0 footer-links">
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Pet Care</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Pet Clinic</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Pet Training</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark text-decoration-none">Pet Hotel</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-primary mb-3" style="font-weight: 500">Help and Guidance</h5>

                    <ul class="list-unstyled mb-0 footer-links">
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Smart Petshope Care</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-dark text-decoration-none">Terms and Conditions</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark text-decoration-none">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->
</footer>

<!-- Copyright -->
<div class="text-center text-white p-2 bg-primary">
    &copy; <?= date("Y"); ?>
    <a class="text-decoration-none" href="<?= base_url(); ?>" style="color: #ffdd95">Smart Petshop Indonesia. </a>
    All rights reserved.
</div>
<!-- Copyright -->
<!-- Footer End -->
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
<script src="<?= base_url('assets/') ?>bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</html>