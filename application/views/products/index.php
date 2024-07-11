<main>
    <div class="container-fluid px-4 mt-4 position-relative">
        <div class="card my-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-table me-1"></i>
                    Product Data
                </div>
                <div>
                    <!-- Add Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-1"></i>
                        Add New Product
                    </button>

                    <!-- Add Modal -->
                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addModalLabel">Add Product Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="add_product_id" name="id" placeholder="Product id">
                                            <label for="add_product_id">Product id</label>
                                            <small class="form-text text-danger" id="add-id-error"></small>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="add_product_name" name="name" placeholder="Product name">
                                            <label for="add_product_name">Product name</label>
                                            <small class="form-text text-danger" id="add-name-error"></small>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="add_product_tag" name="tag" placeholder="Tag name">
                                            <label for="add_product_tag">Tag name</label>
                                            <small class="form-text text-danger" id="add-tag-error"></small>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="category_id" id="add_category_id">
                                                <option selected value="" disabled>Select one</option>
                                                <?php foreach ($category as $c) : ?>
                                                    <option value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="add_category_id">Category</label>
                                            <small class="form-text text-danger" id="add-category_id-error"></small>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Product description" id="add_product_description" name="description" style="height: 100px"></textarea>
                                            <label for="add_product_description">Product description</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="add_product_stock" name="stock" placeholder="Stock">
                                            <label for="add_product_stock">Stock</label>
                                            <small class="form-text text-danger" id="add-stock-error"></small>
                                        </div>
                                        <div class="input-group mb-3 has-validation">
                                            <span class="input-group-text">Rp</span>
                                            <div class="form-floating is-invalid">
                                                <input type="text" class="form-control" id="add_product_buy_price" name="buy_price" placeholder="Buy price">
                                                <label for="add_product_buy_price">Buy price</label>
                                            </div>
                                            <div class="invalid-feedback" id="add-buy_price-error">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3 has-validation">
                                            <span class="input-group-text">Rp</span>
                                            <div class="form-floating is-invalid">
                                                <input type="text" class="form-control" id="add_product_sell_price" name="sell_price" placeholder="Sell price">
                                                <label for="add_product_sell_price">Sell price</label>
                                            </div>
                                            <div class="invalid-feedback" id="add-sell_price-error">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <label class="input-group-text" for="add_product_image">Image</label>
                                            <input type="file" class="form-control" id="add_product_image" name="image">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" id="save-add" class="btn btn-success">Add Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Tag</th>
                            <th scope="col">Description</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Buy Price</th>
                            <th scope="col">Sell Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($products as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $p['id']; ?></td>
                                <td><?= $p['name']; ?></td>
                                <td><?= $p['category_name']; ?></td>
                                <td><?= $p['tag']; ?></td>
                                <td><?= $p['description']; ?></td>
                                <td><?= $p['stock']; ?></td>
                                <td>Rp<?= number_format($p['buy_price'], 0, ',', '.'); ?></td>
                                <td>Rp<?= number_format($p['sell_price'], 0, ',', '.'); ?></td>
                                <td><img src="<?= base_url('assets/img/product/') . $p['image']; ?>" alt="<?= $p['name']; ?> image" height="120" class="rounded"></td>
                                <td>
                                    <!-- Detail Button trigger modal -->
                                    <button type="button" class="me-2 mb-2 btn btn-outline-primary" data-id="<?= $p['id']; ?>" data-bs-toggle="modal" data-bs-target="#detailModal">
                                        <i class="fas fa-eye me-2"></i>Detail
                                    </button>

                                    <!-- Update Button trigger modal -->
                                    <button type="button" class="me-2 mb-2 btn btn-outline-warning" data-id="<?= $p['id']; ?>" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </button>

                                    <!-- Delete Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger" data-id="<?= $p['id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">
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

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Product Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Id:</strong></p>
                        <p id="detail-product-id"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Name:</strong></p>
                        <p id="detail-product-name"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Tag:</strong></p>
                        <p id="detail-product-tag"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Category Id:</strong></p>
                        <p id="detail-category-id"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Description:</strong></p>
                        <p id="detail-product-description"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Stock:</strong></p>
                        <p id="detail-product-stock"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Buy Price:</strong></p>
                        <p id="detail-product-buy_price"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Sell Price:</strong></p>
                        <p id="detail-product-sell_price"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="me-2"><strong>Product Image:</strong></p>
                        <p id="detail-product-image"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary px-5" data-bs-dismiss="modal">Ok</button>
                </div>
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

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update Product Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_product_id" name="id" placeholder="Product id">
                            <label for="update_product_id">Product id</label>
                            <small class="form-text text-danger" id="update-id-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_product_name" name="name" placeholder="Product name">
                            <label for="update_product_name">Product name</label>
                            <small class="form-text text-danger" id="update-name-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_product_tag" name="tag" placeholder="Tag name">
                            <label for="update_product_tag">Tag name</label>
                            <small class="form-text text-danger" id="update-tag-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="category_id" id="update_category_id">
                                <option selected value="" disabled>Select one</option>
                                <?php foreach ($category as $c) : ?>
                                    <option value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="update_category_id">Category</label>
                            <small class="form-text text-danger" id="update-category_id-error"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Product description" id="update_product_description" name="description" style="height: 100px"></textarea>
                            <label for="update_product_description">Product description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_product_stock" name="stock" placeholder="Stock">
                            <label for="update_product_stock">Stock</label>
                            <small class="form-text text-danger" id="update-stock-error"></small>
                        </div>
                        <div class="input-group mb-3 has-validation">
                            <span class="input-group-text">Rp</span>
                            <div class="form-floating is-invalid">
                                <input type="text" class="form-control" id="update_product_buy_price" name="buy_price" placeholder="Buy price">
                                <label for="update_product_buy_price">Buy price</label>
                            </div>
                            <div class="invalid-feedback" id="udpate-buy_price-error">
                            </div>
                        </div>
                        <div class="input-group mb-3 has-validation">
                            <span class="input-group-text">Rp</span>
                            <div class="form-floating is-invalid">
                                <input type="text" class="form-control" id="update_product_sell_price" name="sell_price" placeholder="Sell price">
                                <label for="update_product_sell_price">Sell price</label>
                            </div>
                            <div class="invalid-feedback" id="udpate-sell_price-error">
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <div class="col-sm-3">
                                <img id="src_img" class="img-thumbnail">
                                <label id="label_img"></label>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="update_product_image" name="image">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="save-changes" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<!-- JavaScript to handle modal data population -->
<script>
    $(document).ready(() => {
        // Handle detail modal
        $('#detailModal').on('show.bs.modal', (e) => {
            const button = $(e.relatedTarget);
            const id = button.data('id');

            // Clear previous data
            $('#detail-product-id').text('');
            $('#detail-product-name').text('');
            $('#detail-product-tag').text('');
            $('#detail-category-id').text('');
            $('#detail-product-description').text('');
            $('#detail-product-stock').text('');
            $('#detail-product-buy_price').text('');
            $('#detail-product-sell_price').text('');
            $('#detail-product-image').text('');

            // Fetch product details using AJAX
            $.ajax({
                url: '<?= base_url('products/getProductDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#detail-product-id').text(data.id);
                    $('#detail-product-name').text(data.name);
                    $('#detail-product-tag').text(data.tag);
                    $('#detail-category-id').text(data.category_id);
                    $('#detail-product-description').text(data.description);
                    $('#detail-product-stock').text(data.stock);
                    $('#detail-product-buy_price').text(data.buy_price);
                    $('#detail-product-sell_price').text(data.sell_price);
                    $('#detail-product-image').text(data.image);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching product details:', error);
                }
            });

        });

        // Handle add modal
        $('#addModal').on('shown.bs.modal', () => {
            $('#add-id-error').text('');
            $('#add-name-error').text('');
            $('#add-tag-error').text('');
            $('#add-category_id-error').text('');
            $('#add-stock-error').text('');
            $('#add-buy_price-error').text('');
            $('#add-sell_price-error').text('');

            $('#add_product_id').val('');
            $('#add_product_name').val('');
            $('#add_product_tag').val('');
            $('#add_category_id').val('');
            $('#add_product_description').val('');
            $('#add_product_stock').val('');
            $('#add_product_buy_price').val('');
            $('#add_product_sell_price').val('');
            $('#add_product_image').val('');

            // Handle add product
            $('#save-add').click(() => {
                const id = $('#add_product_id').val();
                const name = $('#add_product_name').val();
                const tag = $('#add_product_tag').val();
                const category_id = $('#add_category_id').val();
                const description = $('#add_product_description').val();
                const stock = $('#add_product_stock').val();
                const buy_price = $('#add_product_buy_price').val();
                const sell_price = $('#add_product_sell_price').val();
                const fileInput = $('#add_product_image')[0];
                const image = fileInput.files[0];

                const formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                formData.append('tag', tag);
                formData.append('category_id', category_id);
                formData.append('description', description);
                formData.append('stock', stock);
                formData.append('buy_price', buy_price);
                formData.append('sell_price', sell_price);
                formData.append('image', image);

                $.ajax({
                    url: '<?= base_url('products/saveProduct') ?>',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: (response) => {
                        if (response.error) {
                            if (response.errors) {
                                for (let field in response.errors) {
                                    if (response.errors.hasOwnProperty(field)) {
                                        const errorElement = $(`#add-${field}-error`);
                                        if (errorElement.length) {
                                            errorElement.text(response.errors[field]);
                                        } else {
                                            console.error(`No element found for add-${field}-error`);
                                        }
                                    }
                                }
                            }
                        } else {
                            location.reload();
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error adding product:', error);
                    }
                });
            });
        });


        // Handle update modal
        $('#updateModal').on('show.bs.modal', (e) => {
            const button = $(e.relatedTarget);
            const id = button.data('id');

            // Fetch product details using AJAX
            $.ajax({
                url: '<?= base_url('products/getProductDetail/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: (data) => {
                    $('#product_id').val(data.id);
                    $('#update_product_id').val(data.id);
                    $('#update_product_name').val(data.name);
                    $('#update_product_tag').val(data.tag);
                    $('#update_category_id').val(data.category_id);
                    $('#update_product_description').val(data.description);
                    $('#update_product_stock').val(data.stock);
                    $('#update_product_buy_price').val(data.buy_price);
                    $('#update_product_sell_price').val(data.sell_price);
                    $('#src_img').attr('src', '<?= base_url('assets/img/product/') ?>' + data.image);
                    $('#label_img').text(data.image);
                },
                error: (xhr, status, error) => {
                    console.error('Error fetching product details:', error);
                }
            });

            // Handle save changes button click
            $('#save-changes').click(() => {
                const product_id = $('#product_id').val();
                const id = $('#update_product_id').val();
                const name = $('#update_product_name').val();
                const tag = $('#update_product_tag').val();
                const category_id = $('#update_category_id').val();
                const description = $('#update_product_description').val();
                const stock = $('#update_product_stock').val();
                const buy_price = $('#update_product_buy_price').val();
                const sell_price = $('#update_product_sell_price').val();
                const fileInput = $('#update_product_image')[0];
                const image = fileInput.files[0];

                const formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                formData.append('tag', tag);
                formData.append('category_id', category_id);
                formData.append('description', description);
                formData.append('stock', stock);
                formData.append('buy_price', buy_price);
                formData.append('sell_price', sell_price);
                formData.append('image', image);

                $.ajax({
                    url: '<?= base_url('products/saveProduct/') ?>' + product_id,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: (response) => {
                        console.log(response.data);
                        if (response.error) {
                            if (response.errors) {
                                for (let field in response.errors) {
                                    if (response.errors.hasOwnProperty(field)) {
                                        const errorElement = $(`#update-${field}-error`);
                                        if (errorElement.length) {
                                            errorElement.text(response.errors[field]);
                                        } else {
                                            console.error(`No element found for update-${field}-error`);
                                        }
                                    }
                                }
                            }
                        } else {
                            location.reload();
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error updating product:', error);
                    }
                });
            });
        });

        $('#deleteModal').on('show.bs.modal', (e) => {
            var button = $(e.relatedTarget);
            var id = button.data('id');

            $('#deleteButton').click(() => {
                window.location.href = '<?= base_url('products/deleteProduct/') ?>' + id;
            })
        });
    });
</script>