 <!-- Content Start -->
 <div class="my-4">
     <!-- Banner -->
     <section class="mb-4">
         <div class="container"><img src="<?= base_url('assets/') ?>img/home/Banner1.png" class="w-100" alt="Banner" /></div>
     </section>
     <!-- Banner -->

     <!-- Services -->
     <section>
         <div class="container">
             <div class="d-lg-flex gap-2">
                 <div>
                     <img src="<?= base_url('assets/') ?>img/home/grooming.png" class="mb-3 mb-lg-0 w-100" alt="Layanan Grooming" />
                 </div>
                 <div>
                     <img src="<?= base_url('assets/') ?>img/home/clinic.png" class="w-100" alt="Layanan Clinic" />
                 </div>
             </div>
         </div>
     </section>
     <!-- Services -->

     <!-- Categories -->
     <section class="my-4">
         <div class="container">
             <div class="d-lg-flex gap-2">
                 <div>
                     <img src="<?= base_url('assets/') ?>img/home/anjing.png" class="mb-3 mb-lg-0 w-100" alt="Kategori Anjing" data-category="1" style="cursor: pointer;" />
                 </div>
                 <div>
                     <img src="<?= base_url('assets/') ?>img/home/kucing.png" class="w-100" alt="Kategori Kucing" data-category="2" style="cursor: pointer;" />
                 </div>
             </div>
         </div>
     </section>
     <!-- Categories -->

     <!-- Recommendations -->
     <section style="padding: 3rem 0">
         <div class="container">
             <h2 class="mb-3"><strong>Recommendations For You</strong></h2>

             <div class="row mb-4">
                 <!-- Card -->
                 <?php foreach ($product as $p) : ?>
                     <div class="col-lg px-3 px-lg-1">
                         <a href="<?= base_url('shop/product/') . $p['id']; ?>" class="text-decoration-none card mb-3 w-100">
                             <div class="row g-0">
                                 <div class="home-img col-md-4 d-flex align-items-center">
                                     <img src="<?= base_url('assets/img/product/') . $p['image']; ?>" class="img-fluid rounded-start" alt="<?= $p['name']; ?>" style="height: 150px !important;" />
                                 </div>
                                 <div class="col-md-8 home-card">
                                     <div class="card-body d-flex flex-column h-100 justify-content-between py-3">
                                         <div class="card-title-wrapper">
                                             <h5 class="card-title mb-1 text-break" style="font-size: 18px;"><?= $p['name']; ?></h5>
                                         </div>
                                         <p class="card-text price mb-1" style="color: #3468c0; font-size: 24px"><strong>Rp<?= number_format($p['sell_price'], 0, ',', '.'); ?></strong></p>
                                         <p class="card-text">
                                             <span><i class="fa fa-star" style="color: #ff9843"></i> <?= round($p['rating'], 1); ?> | </span>100+ terjual
                                         </p>
                                     </div>
                                 </div>
                             </div>
                         </a>
                     </div>
                 <?php endforeach; ?>
                 <!-- Card -->
             </div>
         </div>
     </section>
     <!-- Recommendations -->
 </div>
 <!-- Content End -->

 <script>
     $(document).ready(function() {
         $('img[data-category]').click(function() {
             var category = $(this).data('category');
             var baseUrl = '<?= base_url('shop') ?>';
             window.location.href = baseUrl + '?sc=' + encodeURIComponent(category);
         });
     });
 </script>