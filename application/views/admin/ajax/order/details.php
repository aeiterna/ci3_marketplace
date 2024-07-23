<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                        <li class="breadcrumb-item active"><?php echo isset($action) ? $action : ''; ?></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
            <h4 class="text-primary mb-3">Detail Order</h4>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_items as $index => $item): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $item->product_name; ?></td>
                                <td><?php echo $item->quantity; ?></td>
                                <td><?php echo $item->price; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
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
        new DataTable('#datatable');
    });
</script>
