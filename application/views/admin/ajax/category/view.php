<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                        <li class="breadcrumb-item active"><?php echo $action;?></li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="text-primary mb-3">Category</h4>
                <a href='<?php echo base_url('admin/category/add'); ?>' class='btn btn-primary mb-3'><i class="mdi mdi-plus"></i></a>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Picture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $index => $category): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $category->name; ?></td>
                                <td><img src="<?php echo base_url('uploads/category/' . $category->image); ?>" alt="<?php echo $category->name; ?>" width="50"></td>
                                <td>
                                    <a href="<?php echo site_url('admin/category/edit/' . $category->id); ?>" class="btn btn-outline-secondary btn-sm edit"><i class="mdi mdi-pencil"></i></a>
                                    <a href="<?php echo site_url('admin/category/delete/' . $category->id); ?>" class="btn btn-outline-secondary btn-sm delete"><i class="mdi mdi-delete"></i></a>
                                </td>
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