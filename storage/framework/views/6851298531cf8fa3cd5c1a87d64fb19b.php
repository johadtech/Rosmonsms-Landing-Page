<?php $__env->startSection('content'); ?>

<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->

			<div class="col-sm-12">
				<div class="card border-0 shadow-none drp-upgrade-card" style="background-image: url(<?php echo e(asset('admin/assets/images/layout/img-profile-card.jpg')); ?>)">
					<div class="card-header d-none">
						<h5 class="mb-0 text-center small"></h5>
					</div>
					<div class="card-body pt--1">
						<h5 class="mb-3 text-center">About System</h5>
						<?php $__currentLoopData = $applicationInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="alert alert-success d-block text-center text-uppercase">
							<i class="feather icon-check-circle mx-2"></i>
							<?php echo e($key); ?>   ---   <?php echo e($value); ?>

						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
						<div class="mt-3 text-center small text-secondary">
							<a class="btn btn-sm btn-light-dark rounded-pill px-2 text-secondary" role="button" target="_blank" href="https://johadtech.com.ng">
								<i class="ti ti-external-link me-1"></i>
								by Johadtech.
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- [ sample-page ] start -->
		</div>
	</div>
	<!-- [ Main Content ] end -->
</div>
<!-- [ Main Content ] end -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css">
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
<script src="<?php echo e(asset('admin/assets/js/plugins/clipboard.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/assets/js/plugins/quill.min.js')); ?>"></script>
<script>
	new ClipboardJS('[data-clipboard=true]').on('success', function (e) {
		e.clearSelection();
		alertify.set('notifier', 'position', 'top-right');
		alertify.success("Copied!");
		//alert('Copied!');
	});
</script>
<script>
	document.getElementById('clearButton1').addEventListener('click', function() {
		document.getElementById('myForm1').reset();
	});
	document.getElementById('clearButton2').addEventListener('click', function() {
		document.getElementById('myForm2').reset();
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/system/about.blade.php ENDPATH**/ ?>