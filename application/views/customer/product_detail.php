<?php $this->load->view('customer/header'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo base_url('uploads/product/' . $product->image); ?>" class="card-img-top img-fluid" alt="<?php echo $product->name; ?>" style="width: 100%; height: auto; aspect-ratio: 1 / 1; object-fit: cover;">
        </div>
        <div class="col-md-8">
            <h2><?php echo $product->name; ?></h2>
            <p class="h4 text-danger"><?php echo $product->price; ?></p>
            <p><?php echo $product->description; ?></p>
            <form action="<?php echo base_url('customer/add_to_cart'); ?>" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                <div class="mb-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="number" name="qty" class="form-control" id="qty" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
                <a href="<?php echo base_url('customer'); ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('customer/footer'); ?>
