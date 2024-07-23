<?php
$this->load->view('customer/header');
?>

<style>
    .card-img-top {
        width: 100%;
        height: auto;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-5">Products</h2>
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
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
        <?php else: ?>
            <div class="col-12">
                <p>No products found for this category.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$this->load->view('customer/footer');
?>
