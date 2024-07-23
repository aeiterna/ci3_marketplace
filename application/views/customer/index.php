<?php $this->load->view('customer/header'); ?>

<div class="container mt-4">
<h2 class="mb-3">Category</h2>
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-2">
                <div class="card mb-4 shadow-sm" onclick="location.href='<?php echo base_url('customer/product/' . $category->id); ?>'">
                    <img src="<?php echo base_url('uploads/category/' . $category->image); ?>" class="card-img-top" alt="<?php echo $category->name; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $category->name; ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<h2>Recent Products</h2>
    <div class="row">
        <?php foreach ($recent_products as $product): ?>
            <div class="col-md-3">
                <div class="card mb-4 shadow-sm" onclick="location.href='<?php echo base_url('customer/product_detail/' . $product->id); ?>'">
                    <img src="<?php echo base_url('uploads/product/' . $product->image); ?>" class="card-img-top" alt="<?php echo $product->name; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->name; ?></h5>
                        <p class="card-text"><?php echo $product->description; ?></p>
                        <p class="card-text">Rp <?php echo number_format($product->price, 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


<h2>Best Sellers</h2>
    <div class="row">
    <?php foreach ($best_sellers as $product): ?>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm" onclick="location.href='<?php echo base_url('customer/product_detail/' . $product->id); ?>'">
                <img src="<?php echo base_url('uploads/product/' . $product->image); ?>" class="card-img-top" alt="<?php echo $product->name; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product->name; ?></h5>
                    <p class="card-text"><?php echo $product->description; ?></p>
                    <p class="card-text">Rp <?php echo number_format($product->price, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

<h2>Most Viewed</h2>
    <div class="row">
    <?php foreach ($most_viewed as $product): ?>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm" onclick="location.href='<?php echo base_url('customer/product_detail/' . $product->id); ?>'">
                <img src="<?php echo base_url('uploads/product/' . $product->image); ?>" class="card-img-top" alt="<?php echo $product->name; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product->name; ?></h5>
                    <p class="card-text"><?php echo $product->description; ?></p>
                    <p class="card-text">Rp <?php echo number_format($product->price, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

<?php $this->load->view('customer/footer'); ?>
