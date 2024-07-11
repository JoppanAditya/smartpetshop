<!-- Content Start -->
<div class="container my-4">
  <div class="row shop-filter">
    <div class="col-lg-2 d-none d-lg-block">
      <div class="d-flex mb-2">
        <i class="fa fa-filter"></i>
        <h2 class="ms-2"><strong>Filter</strong></h2>
      </div>

      <h3>Category</h3>
      <form id="filter-category" action="<?= base_url('shop') ?>" method="get">
        <?php foreach ($category as $c) : ?>
          <div>
            <input class="btn-check filter-category" type="radio" value="<?= $c['id'] ?>" id="category-<?= $c['id'] ?>" name="sc" <?= $selected_category == $c['id'] ? 'checked' : ''; ?> />
            <label class="btn btn-outline-light border-0 text-dark" for="category-<?= $c['id'] ?>"><?= $c['name']; ?></label>
          </div>
        <?php endforeach; ?>
      </form>

      <h3 class="border-top pt-3 mt-3" style="border-color: rgba(0, 0, 0, 0.1) !important">Price</h3>
      <form action="<?= base_url('shop') ?>" method="get" id="filter-price">
        <div class="input-group mb-1">
          <span class="input-group-text" style="font-size: 14px">Rp</span>
          <input type="text" class="form-control filter-price" placeholder="Minimum Price" aria-label="Minimum Price" name="minP" value="<?= $min_price ?>" style="font-size: 14px" />
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" style="font-size: 14px">Rp</span>
          <input type="text" class="form-control filter-price" placeholder="Maximum Price" aria-label="Maximum Price" name="maxP" value="<?= $max_price ?>" style="font-size: 14px" />
        </div>
      </form>

      <h3 class="border-top pt-3 mt-4" style="border-color: rgba(0, 0, 0, 0.1) !important">Rating</h3>
      <form action="<?= base_url('shop') ?>" method="get" id="filter-rating">
        <div>
          <input class="btn-check filter-rating" type="radio" name="r" id="rate4" value="4" <?= ($rating == '4') ? 'checked' : '' ?>>
          <label class="btn btn-outline-light border-0 text-dark" for="rate4"> <i class="fa fa-star" style="color: #ff9843"></i> 4 Keatas </label>
        </div>
        <div>
          <input class="btn-check filter-rating" type="radio" name="r" id="rate3" value="3" <?= ($rating == '3') ? 'checked' : '' ?>>
          <label class="btn btn-outline-light border-0 text-dark" for="rate3"> <i class="fa fa-star" style="color: #ff9843"></i> 3 Keatas </label>
        </div>
        <div>
          <input class="btn-check filter-rating" type="radio" name="r" id="rate2" value="2" <?= ($rating == '2') ? 'checked' : '' ?>>
          <label class="btn btn-outline-light border-0 text-dark" for="rate2"> <i class="fa fa-star" style="color: #ff9843"></i> 2 Keatas </label>
        </div>
        <div>
          <input class="btn-check filter-rating" type="radio" name="r" id="rate1" value="1" <?= ($rating == '1') ? 'checked' : '' ?>>
          <label class="btn btn-outline-light border-0 text-dark" for="rate1"> <i class="fa fa-star" style="color: #ff9843"></i> 1 Keatas </label>
        </div>
      </form>

    </div>

    <!-- Main Start -->
    <div class="col-lg-10">
      <?php if ($products) : ?>
        <div class="row mb-3">
          <?php if ($keyword != '') : ?>
            <h2 class="result-text fs-3">Search result for "<span style="color: #3468c0;"><?= $keyword; ?></span>"</h2>
          <?php endif; ?>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
          <p class="m-0">Showing <?= ++$start; ?> - <?= $total_rows - $start < 20 ? $total_rows : $start + 19 ?> from <?= $total_rows; ?> results.</p>

          <div class="d-lg-none d-flex align-items-center gap-2">
            <button class="btn btn-light py-0 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sort" aria-controls="sort" style="font-size: 14px"><i class="fas fa-sort"></i></button>
            <button class=" btn btn-light py-0 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#filter" aria-controls="filter" style="font-size: 14px"><i class="fas fa-filter"></i></button>
          </div>

          <!-- Dropdown Start -->
          <div class="d-none d-lg-flex align-items-center gap-2 sort">
            <p class="m-0"><strong>Sort by:</strong></p>
            <form>
              <select id="sort-by" class="form-select bg-transparent" style="border-color: #110b11">
                <option value="relevance" <?= $sort_by == 'relevance' ? 'selected' : ''; ?>>Relevance</option>
                <option value="rating" <?= $sort_by == 'rating' ? 'selected' : ''; ?>>Rating</option>
                <option value="highest_price" <?= $sort_by == 'highest_price' ? 'selected' : ''; ?>>Highest Price</option>
                <option value="lowest_price" <?= $sort_by == 'lowest_price' ? 'selected' : ''; ?>>Lowest Price</option>
              </select>
            </form>
          </div>
          <!-- Dropdown End -->
        </div>

        <!-- Card Start -->
        <div class="d-flex align-content-start justify-content-center flex-wrap gap-2 mb-4 product-card">
          <!-- Card -->
          <?php foreach ($products as $p) : ?>
            <div class="card" style="width: 13rem">
              <a href="<?= base_url('shop/product/') . $p['id'] ?>" class="text-decoration-none text-dark">
                <img src="<?= base_url('assets/img/product/') . $p['image'] ?>" class="card-img-top" alt="<?= $p['name'] ?> Image" />

                <div class="card-body">
                  <div class="card-title-wrapper">
                    <p class="card-title mb-1 text-break"><?= $p['name'] ?></p>
                  </div>
                  <p class="card-text price mb-1" style="color: #3468c0; font-size: 18px"><strong>Rp<?= number_format($p['sell_price'], 0, ',', '.'); ?></strong></p>
                  <p class="card-text" style="font-size: 15px">
                    <span><i class="fa fa-star" style="color: #ff9843"></i> <?= round($p['rating'], 1); ?> | </span>100+ terjual
                  </p>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
        <!-- Card End -->

        <!-- Pagination Start -->
        <?= $this->pagination->create_links(); ?>
        <!-- Pagination End -->

      <?php else : ?>
        <div class="h-100">
          <div class="col-3 p-0 d-lg-none d-inline-flex align-items-center gap-1" style="width: fit-content;">
            <div class="">
              <button class="btn btn-light py-0 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sort" aria-controls="sort"><i class="fas fa-sort" style="font-size: 12px"></i></button>
              <button class="btn btn-light py-0 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#filter" aria-controls="filter"><i class="fas fa-filter" style="font-size: 12px"></i></button>
            </div>
          </div>
          <h2 class="fs-2 text-center h-100 d-flex align-items-center justify-content-center">Oops... No product found</h2>
        </div>
      <?php endif; ?>

    </div>
    <!-- Main End -->
  </div>
</div>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-bottom rounded-top-4 d-lg-none" style="height: fit-content;" tabindex="-1" id="sort" aria-labelledby="sortLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sortLabel">Sort by</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small mb-3">
    <form action="<?= base_url('shop') ?>" method="get" id="sort">
      <div class="form-check d-flex gap-3 pb-2 align-items-center">
        <input class="form-check-input" type="radio" name="sort-by-radio" id="sort-relevance" value="relevance" <?= $sort_by == 'relevance' || $sort_by == '' ? 'checked' : ''; ?>>
        <label class="form-check-label fs-6" for="sort-relevance">
          Relevance
        </label>
      </div>
      <div class="form-check d-flex gap-3 py-2 align-items-center">
        <input class="form-check-input" type="radio" name="sort-by-radio" id="sort-rating" value="rating" <?= $sort_by == 'rating' ? 'checked' : ''; ?>>
        <label class="form-check-label fs-6" for="sort-rating">
          Rating
        </label>
      </div>
      <div class="form-check d-flex gap-3 py-2 align-items-center">
        <input class="form-check-input" type="radio" name="sort-by-radio" id="sort-highest-price" value="highest_price" <?= $sort_by == 'highest_price' ? 'checked' : ''; ?>>
        <label class="form-check-label fs-6" for="sort-highest-price">
          Highest Price
        </label>
      </div>
      <div class="form-check d-flex gap-3 py-2 align-items-center">
        <input class="form-check-input" type="radio" name="sort-by-radio" id="sort-lowest-price" value="lowest_price" <?= $sort_by == 'lowest_price' ? 'checked' : ''; ?>>
        <label class="form-check-label fs-6" for="sort-lowest-price">
          Lowest Price
        </label>
      </div>
    </form>
  </div>
</div>

<div class="offcanvas offcanvas-bottom rounded-top-4 d-lg-none" style="height: fit-content;" tabindex="-1" id="filter" aria-labelledby="filterLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="filterLabel">Filter</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small mb-3">
    <h3 class="fs-6">Category</h3>
    <form id="filter-category" action="<?= base_url('shop') ?>" method="get">
      <div class="d-inline-flex gap-2">
        <?php foreach ($category as $c) : ?>
          <input class="btn-check filter-category" type="radio" value="<?= $c['id'] ?>" id="category-<?= $c['id'] ?>" name="sc" <?= $selected_category == $c['id'] ? 'checked' : ''; ?> />
          <label class="btn btn-light rounded-4 border-0 text-dark" for="category-<?= $c['id'] ?>" style="font-size: 14px"><?= $c['name']; ?></label>
        <?php endforeach; ?>
      </div>
    </form>

    <h3 class="border-top pt-3 mt-3 fs-6" style="border-color: rgba(0, 0, 0, 0.1) !important">Price</h3>
    <form action="<?= base_url('shop') ?>" method="get" id="filter-price-mob">
      <div class="d-inline-flex gap-1 align-items-center">
        <div class="input-group">
          <span class="input-group-text" style="font-size: 12px">Rp</span>
          <input type="text" class="form-control filter-price-mob" placeholder="Minimum Price" aria-label="Minimum Price" name="min" value="<?= $min_price ?>" style="font-size: 12px" />
        </div>
        <div>-</div>
        <div class="input-group">
          <span class="input-group-text" style="font-size: 12px">Rp</span>
          <input type="text" class="form-control filter-price-mob" placeholder="Maximum Price" aria-label="Maximum Price" name="max" value="<?= $max_price ?>" style="font-size: 12px" />
        </div>
      </div>
    </form>

    <h3 class="border-top pt-3 mt-4 fs-6" style="border-color: rgba(0, 0, 0, 0.1) !important">Rating</h3>
    <form action="<?= base_url('shop') ?>" method="get" id="filter-rating">
      <div class="d-inline-flex gap-2">
        <div>
          <input class="btn-check filter-rating" style="font-size: 14px" type="radio" name="r" id="rate4" value="4" <?= ($rating == '4') ? 'checked' : '' ?>>
          <label class="btn btn-light rounded-4 border-0 text-dark" style="font-size: 14px" for="rate4"> <i class="fa fa-star" style="color: #ff9843"></i> 4 Keatas </label>
        </div>
        <div>
          <input class="btn-check filter-rating" style="font-size: 14px" type="radio" name="r" id="rate3" value="3" <?= ($rating == '3') ? 'checked' : '' ?>>
          <label class="btn btn-light rounded-4 border-0 text-dark" style="font-size: 14px" for="rate3"> <i class="fa fa-star" style="color: #ff9843"></i> 3 Keatas </label>
        </div>
        <div>
          <input class="btn-check filter-rating" style="font-size: 14px" type="radio" name="r" id="rate2" value="2" <?= ($rating == '2') ? 'checked' : '' ?>>
          <label class="btn btn-light rounded-4 border-0 text-dark" style="font-size: 14px" for="rate2"> <i class="fa fa-star" style="color: #ff9843"></i> 2 Keatas </label>
        </div>
        <div>
          <input class="btn-check filter-rating" style="font-size: 14px" type="radio" name="r" id="rate1" value="1" <?= ($rating == '1') ? 'checked' : '' ?>>
          <label class="btn btn-light rounded-4 border-0 text-dark" style="font-size: 14px" for="rate1"> <i class="fa fa-star" style="color: #ff9843"></i> 1 Keatas </label>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Content End -->

<script>
  $(document).ready(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const currentKeyword = urlParams.get('q') || '';
    let params = [];

    urlParams.forEach((value, key) => {
      if (key !== 'q') {
        params.push(`${key}=${encodeURIComponent(value)}`);
      }
    });

    const sendFilterRequest = (sortBy) => {
      params = [];

      let keyword = $('#keyword-input').val() || currentKeyword;
      if (keyword) {
        params.push(`q=${encodeURIComponent(keyword)}`);
      }

      let category = $('#filter-category input:checked').val();
      if (category !== undefined) {
        params.push(`sc=${encodeURIComponent(category)}`);
      }

      let minPriceDesk = $('#filter-price input[name="minP"]').val();
      let minPriceMob = $('#filter-price-mob input[name="min"]').val();
      let minPrice = minPriceDesk || minPriceMob;
      if (minPrice !== '') {
        params.push(`minP=${encodeURIComponent(minPrice)}`);
      }

      let maxPriceDesk = $('#filter-price input[name="maxP"]').val();
      let maxPriceMob = $('#filter-price-mob input[name="max"]').val();
      let maxPrice = maxPriceDesk || maxPriceMob;
      if (maxPrice !== '') {
        params.push(`maxP=${encodeURIComponent(maxPrice)}`);
      }

      let rating = $('#filter-rating input:checked').val();
      if (rating !== undefined) {
        params.push(`r=${encodeURIComponent(rating)}`);
      }

      if (sortBy === 'relevance') {
        params = params.filter(param => !param.startsWith('sb='));
      } else if (sortBy) {
        params.push(`sb=${encodeURIComponent(sortBy)}`);
      }

      let url = '<?= base_url('shop') ?>';
      let queryString = params.join('&');
      let urlWithParams = queryString ? `${url}?${queryString}` : url;

      window.location.href = urlWithParams;
    };

    $('.filter-category, .filter-price, .filter-rating, .filter-price-mob').change(() => {
      sendFilterRequest();
    });

    $('#sort-by').change(() => {
      let sortBySelect = $('#sort-by').val();
      sendFilterRequest(sortBySelect);
    });

    $('input[name="sort-by-radio"]').change(() => {
      let sortByRadio = $('input[name="sort-by-radio"]:checked').val();
      sendFilterRequest(sortByRadio);
    });
  });
</script>