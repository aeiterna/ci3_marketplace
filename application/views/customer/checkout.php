<?php $this->load->view('customer/header'); ?>

<div class="container mt-4">
    <h2>Checkout</h2>
    <form action="<?php echo base_url('customer/checkout'); ?>" method="post">
        <div class='form-group mb-3'>
            <label>Name</label>
            <input type='text' class='form-control' name='name' id='name' value="<?php echo $this->session->userdata('name'); ?>" readonly />
            <input type='hidden' class='form-control' name='id' id='id' value="<?php echo $this->session->userdata('customer_id'); ?>" required>
            <?php echo form_error('name', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $this->session->userdata('email'); ?>" readonly>
            <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo set_value('address'); ?></textarea>
            <?php echo form_error('address', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="provinsi" class="form-label">Province</label>
            <input class="form-control" id="province" name="province" required><?php echo set_value('province'); ?></input>
            <?php echo form_error('province', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo set_value('city'); ?>" required>
            <?php echo form_error('city', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="mb-3">
            <label for="post_code" class="form-label">Post Code</label>
            <input type="text" class="form-control" id="post_code" name="post_code" value="<?php echo set_value('post_code'); ?>" required>
            <?php echo form_error('post_code', '<div class="text-danger">', '</div>'); ?>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" name="checkout" class="btn btn-primary">Checkout</button>
        </div>
    </form>
</div>

<?php $this->load->view('customer/footer'); ?>
