<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?php echo $page_title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">

	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css" />

	<style>
		.mdi-account{
			font-size: large;
		}
	</style>

</head>

<body data-sidebar="dark">
	<div id="layout-wrapper">
		<header id="page-topbar">
			<div class="navbar-header">
				<div class="d-flex">
					<div class="navbar-brand-box">
						<a href="index.html" class="logo logo-dark">
							<span class="logo-sm">
								<img src="<?php echo base_url();?>assets/images/logo-sm.png" alt="" height="22">
							</span>
							<span class="logo-lg">
								<img src="<?php echo base_url();?>assets/images/logo-dark.png" alt="" height="17">
							</span>
						</a>

						<a href="index.html" class="logo logo-light">
							<span class="logo-sm">
								<img src="<?php echo base_url();?>assets/images/logo-sm.png" alt="" height="22">
							</span>
							<span class="logo-lg">
								<img src="<?php echo base_url();?>assets/images/logo-light.png" alt="" height="18">
							</span>
						</a>
					</div>

					<button type="button"
						class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
						<i class="mdi mdi-menu"></i>
					</button>
				</div>

				<div class="d-flex">

					<div class="dropdown d-none d-lg-inline-block">
						<button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
							<i class="mdi mdi-fullscreen font-size-24"></i>
						</button>
					</div>

					<div class="dropdown d-inline-block">
						<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account"></i> <?php echo $this->session->userdata('name'); ?>
						</button>
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item text-danger" href="<?php echo base_url('admin/logout'); ?>"><i
									class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i>
								Logout</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="vertical-menu">
			<div data-simplebar class="h-100">
				<div id="sidebar-menu">
					<ul class="metismenu list-unstyled" id="side-menu">
						<li class="menu-title">Main</li>
						
						<li>
							<a href="<?php echo base_url();?>admin/category" class="waves-effect">
								<i class="mdi mdi-view-list"></i>
								<span>Category</span>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url();?>admin/product" class="waves-effect">
								<i class="mdi mdi-cube-outline"></i>
								<span>Product</span>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url();?>admin/order" class="waves-effect">
								<i class="mdi mdi-cart-outline"></i>
								<span>Order</span>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url();?>admin/customer" class="waves-effect">
								<i class="mdi mdi-account-outline"></i>
								<span>Customer</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>admin/profit" class="waves-effect">
								<i class="mdi mdi-cash-multiple"></i>
								<span>Profit</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="main-content" id="result"><?php require "ajax/".$page.".php."; ?></div>
        <footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						©
						<script>document.write(new Date().getFullYear())</script><span>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="rightbar-overlay"></div>

	<script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
	<script src="<?php echo base_url();?>assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

	<script src="<?php echo base_url();?>assets/js/aapp.js"></script>
</body>
</html>