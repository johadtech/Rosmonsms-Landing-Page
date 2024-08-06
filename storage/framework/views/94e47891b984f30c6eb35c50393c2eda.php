<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="Version" content="v1.0">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="theme-color" content="#0E159A">
	<title></title>

	<!-- [Font] Family -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/fonts/inter/inter.css')); ?>" id="main-font-link">
	<!-- [phosphor Icons] https://phosphoricons.com/ -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/fonts/phosphor/duotone/style.css')); ?>">
	<!-- [Tabler Icons] https://tablericons.com -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/fonts/tabler-icons.min.css')); ?>">
	<!-- [Feather Icons] https://feathericons.com -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/fonts/feather.css')); ?>">
	<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/fonts/fontawesome.css')); ?>">
	<!-- [Material Icons] https://fonts.google.com/icons -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/fonts/material.css')); ?>">
	<!-- [Template CSS Files] -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/css/style.css')); ?>" id="main-style-link">
	<link rel="stylesheet" href="<?php echo e(asset('admin/assets/css/style-preset.css')); ?>">

	<!-- start favicon -->
	<link type="image/x-icon" rel="shortcut icon" href="<?php echo e(asset('storage/general/'.gs()->favicon)); ?>" />
	<!-- end favicon -->
	<?php echo SEOMeta::generate(); ?>

	<?php echo OpenGraph::generate(); ?>

	<?php echo Twitter::generate(); ?>

	<?php echo JsonLd::generate(); ?>

	<?php echo SEO::generate(); ?>


</head>
<!-- [Head] end -->

<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
	<!-- [ Pre-loader ] start -->
	<div class="page-loader">
		<div class="bar"></div>
	</div>
	<!-- [ Pre-loader ] End -->

	<div class="maintenance-block">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="card error-card">
						<div class="card-body">
							<div class="error-image-block">
								<img class="img-fluid" src="<?php echo e(asset('storage/general/img-error-404.svg')); ?>" alt="img">
							</div>
							<div class="text-center">
								<h1 class="mt-5"><b>Page Not Found</b></h1>
								<p class="mt-2 mb-4 text-muted">
									The page you are looking for was moved, removed, renamed or might never exist!
								</p>
								<a href="<?php echo e(url('/')); ?>" class="btn btn-primary mb-3">
									Go to home
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ Main Content ] end --><!-- Required Js -->

	<!-- Footer Start -->
	<!-- Footer End -->

	<!-- Required Js -->
	<script data-cfasync="false" src=""></script>
	<script src="<?php echo e(asset('admin/assets/js/plugins/popper.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin/assets/js/plugins/simplebar.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin/assets/js/plugins/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin/assets/js/fonts/custom-font.js')); ?>"></script>
	<script src="<?php echo e(asset('admin/assets/js/pcoded.js')); ?>"></script>
	<script src="<?php echo e(asset('admin/assets/js/plugins/feather.min.js')); ?>"></script>
	<!-- chart js -->
	<script src="<?php echo e(asset('admin/assets/js/plugins/apexcharts.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admin/assets/js/pages/membership-dashboard.js')); ?>"></script>

	<script>
		layout_change('light');
	</script>
	<script>
		change_box_container('false');
	</script>
	<script>
		layout_caption_change('true');
	</script>
	<script>
		layout_rtl_change('false');
	</script>
	<script>
		preset_change('preset-1');
	</script>
	<script>
		main_layout_change('vertical');
	</script>

</body>
<!-- [Body] end -->

</html><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/errors/404.blade.php ENDPATH**/ ?>