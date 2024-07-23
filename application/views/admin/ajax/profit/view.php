<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <h2 class="text-primary mb-2"><b>Profit</b></h2>
                    <div class="col-md-9">
                        <form action="<?php echo site_url('admin/profit'); ?>" method="POST">
                            <table>
                                <tr>
                                    <td><input type="date" name="date1" class="form-control" value="<?= $date1; ?>"></td>
                                    <td>&nbsp; - &nbsp;</td>
                                    <td><input type="date" name="date2" class="form-control" value="<?= $date2; ?>"></td>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="submit" class="btn btn-primary" value="Show"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="exp_profit.php" method="POST">
                            <table>
                                <tr>
                                    <td><input type="hidden" name="date1" class="form-control" value="<?= $date1; ?>"></td>
                                    <td><input type="hidden" name="date2" class="form-control" value="<?= $date2; ?>"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (isset($profits) && count($profits) > 0) {
                                    $no = 1;
                                    $total = 0;
                                    foreach ($profits as $profit) {
                                        ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $profit->customer_name; ?></td>
                                            <td><?= $profit->product_name; ?></td>
                                            <td><?= number_format($profit->price, 2); ?></td>
                                            <td><?= $profit->quantity; ?></td>
                                            <td><?= number_format($profit->total_price, 2); ?></td>
                                            <td><?= $profit->created_at; ?></td>
                                        </tr>
                                        <?php 
                                        $total += $profit->total_price * $profit->quantity;
                                        $no++;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-right"><b>Total Pendapatan = <?= number_format($total, 2); ?></b></td>
                                    </tr>
                                    <?php 
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No data Available.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo base_url();?>assets/table/dataTables.bootstrap4.css">

<script src="<?php echo base_url();?>assets/table/jquery.js"></script>
<script src="<?php echo base_url();?>assets/table/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/table/dataTables.js"></script>
<script src="<?php echo base_url();?>assets/table/dataTables.bootstrap4.js"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>
