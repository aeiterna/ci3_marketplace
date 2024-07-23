<?php $this->load->view('customer/header'); ?>

<div class="container mt-4">
    <?php if (empty($cart_items)): ?>
        <div class="text-center">
            <h2>Shopping Cart is Empty</h2>
            <p>Please add products to your shopping cart.</p>
        </div>
    <?php else: ?>
        <h2>Shopping Cart</h2>
        <?php foreach ($cart_items as $item): ?>
            <div class="card mb-3">
                <div class="row g-0 align-items-center">
                    <div class="col-md-3">
                        <img src="<?php echo base_url('uploads/product/' . $item['image']); ?>" class="card-img-top img-fluid" alt="<?php echo $item['name']; ?>" style="width: 100%; height: auto; aspect-ratio: 1 / 1; object-fit: cover;">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item['name']; ?></h5>
                            <p class="card-text">Price: Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                            <div class="input-group mb-2">
                                <label for="qty_<?php echo $item['product_id']; ?>" class="input-group-text">Quantity</label>
                                <input type="number" name="qty" class="form-control quantity" id="qty_<?php echo $item['product_id']; ?>" value="<?php echo $item['quantity']; ?>" min="1" data-product-id="<?php echo $item['product_id']; ?>">
                            </div>
                            <form action="<?php echo base_url('customer/remove_from_cart'); ?>" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="d-flex justify-content-end">
            <p class="h4">Total: Rp <span id="cart-total"><?php echo number_format(array_reduce($cart_items, function($total, $item) { return $total + $item['price'] * $item['quantity']; }, 0), 0, ',', '.'); ?></span></p>
        </div>
        <div class="d-flex justify-content-end">
            <a href="<?php echo base_url('customer/checkout'); ?>" class="btn btn-success btn-m"><i class="mdi mdi-cart"></i></a>
        </div>
    <?php endif; ?>
</div>

<?php $this->load->view('customer/footer'); ?>

<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.quantity').on('change', function() {
        var qty = $(this).val();
        var productId = $(this).data('product-id');
        
        $.ajax({
            url: '<?php echo base_url('customer/update_cart'); ?>',
            method: 'POST',
            data: { product_id: productId, qty: qty },
            success: function(response) {
                var data = JSON.parse(response);
                $('#cart-total').text(data.updated_total);
            }
        });
    });
});
</script>