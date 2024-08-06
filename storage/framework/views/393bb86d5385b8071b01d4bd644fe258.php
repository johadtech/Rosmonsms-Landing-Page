

<?php $__env->startSection('content'); ?>
<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->
				
			

			<div class="col-12">
				<div class="card table-card">
					<div class="card-header d-none">
						<h5 class="mb-0 text-center d-none">Users</h5>
					</div>
					<div class="card-body pt-3">
						
						<h5 class="mb-2 text-center small">Testimony</h5>

						<div class="table-responsive">
							<table class="table table-hover" id="pc-dt-simple">
								<thead>
									<tr>
										<th><?php echo e(__('Name')); ?></th>
										<th><?php echo e(__('Occupation')); ?></th>
										<th><?php echo e(__('Testimony')); ?></th>
										<th><?php echo e(__('Date/Time')); ?></th>
										<th><?php echo e(__('Action')); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $testimonies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimony): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<h6 class="mb-0"><?php echo e(__($testimony->full_name)); ?></h6>
										</td>
										<td><?php echo e(__($testimony->occupation)); ?></td>
										<td><?php echo __($testimony->content); ?></td>
										<td>
											<?php echo e(formatCreatedAt($testimony->created_at)['date']); ?>

											<span class="text-muted text-sm d-block">
												<?php echo e(formatCreatedAt($testimony->created_at)['time']); ?>

											</span>
										</td>
										<td>
											
											<a href="<?php echo e(route('admin.testimonies.edit', $testimony->id)); ?>" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-<?php echo e($testimony->id); ?>').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="<?php echo e(route('admin.testimonies.delete', $testimony->id)); ?>" method="POST" style="display:none;" id="block-<?php echo e($testimony->id); ?>">
												<?php echo csrf_field(); ?>
												<?php echo method_field('DELETE'); ?>
											</form>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
							<?php echo e($testimonies->links()); ?>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- [ Main Content ] end -->
</div>
<!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/testimonies/index.blade.php ENDPATH**/ ?>