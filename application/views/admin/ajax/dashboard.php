<div class="page-content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-sm-6">
				<div class="page-title-box">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="row">
			<h6>Text</h6>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>assets/libs/morris.js/morris.min.js"></script>
<script src="<?php echo base_url();?>assets/libs/raphael/raphael.min.js"></script>

<script src="<?php echo base_url();?>assets/js/pages/dashboard.init.js"></script>
<script>
	$('#header-chart-1').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
		type: 'bar',
		height: '32',
		barWidth: '5',
		barSpacing: '3',
		barColor: '#7A6FBE'
	});
	$('#header-chart-2').sparkline([8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12], {
		type: 'bar',
		height: '32',
		barWidth: '5',
		barSpacing: '3',
		barColor: '#29bbe3'
	});
</script>