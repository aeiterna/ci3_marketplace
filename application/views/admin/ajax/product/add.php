<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                        <li class="breadcrumb-item active"><?php echo $action;?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php 
                    if (isset($message)){
                        echo "<div class='alert alert-info'>".$message."</div>";
                    }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class='form-group mb-3'>
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class='form-group mb-3'>
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group mb-3'>
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control">
                    </div>

                    <div class='form-group mb-3'>
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class='form-group mb-3'>
                        <label for="image">Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type='submit' name='submit' class='btn btn-primary' value='Submit' />
                            <a href="<?php echo base_url('admin/product'); ?>"> < Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
