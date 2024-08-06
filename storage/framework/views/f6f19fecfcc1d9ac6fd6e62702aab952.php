

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
						
						<h5 class="mb-2 text-center small">Bookings</h5>
						
						<div class="text-center p-4 pb-sm-2">
							<a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-plus f-18"></i>
								All Bookings
							</a>

							<a href="<?php echo e(route('admin.bookings.index', ['status' => 1])); ?>" class="btn btn-sm btn-success mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-check f-18"></i>
								Approved Bookings
							</a>

							<a href="<?php echo e(route('admin.bookings.index', ['status' => 0])); ?>" class="btn btn-sm btn-danger mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-x f-18"></i>
								Pending Bookings
							</a>
						</div>

						<div class="table-responsive">
							<table class="table table-hover" id="pc-dt-simple">
								<thead>
									<tr>
										<th><?php echo e(__('Name')); ?></th>
										<th><?php echo e(__('Mobile')); ?></th>
										<th><?php echo e(__('Email')); ?></th>
										<th><?php echo e(__('Status')); ?></th>
										<th><?php echo e(__('Appointment Day')); ?></th>
										<th><?php echo e(__('Appointment Time')); ?></th>
										<th><?php echo e(__('IP Address')); ?></th>
										<th><?php echo e(__('Date/Time')); ?></th>
										<th><?php echo e(__('Action')); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<h6 class="mb-0"><?php echo e(__($booking->fullname)); ?></h6>
										</td>
										<td><?php echo e(__($booking->mobile)); ?></td>
										<td><?php echo e(__($booking->email)); ?></td>
										<td>
											<span class="badge <?php echo e($booking->status == 1 ? 'bg-light-success' : 'bg-light-danger'); ?> rounded-pill f-12"> <?php echo e($booking->status == 1 ? 'Approved' : 'Pending'); ?> </span>
										</td>
										<td><?php echo e(__(\Carbon\Carbon::parse($booking->appointment_date)->format('jS \of F, Y'))); ?></td>
										<td><?php echo e(__(\Carbon\Carbon::parse($booking->appointment_time)->format('g:ia'))); ?></td>
										<td><?php echo e(__($booking->ip_address)); ?></td>
										<td>
											<?php echo e(formatCreatedAt($booking->created_at)['date']); ?>

											<span class="text-muted text-sm d-block">
												<?php echo e(formatCreatedAt($booking->created_at)['time']); ?>

											</span>
										</td>
										<td>
											<?php if($booking->status == 0): ?>
											<a href="<?php echo e(route('admin.bookings.review', $booking->id)); ?>" class="avtar avtar-xs btn-light-success">
												<i class="ti ti-check f-20 text-success"></i>
											</a>
											
											<form action="<?php echo e(route('admin.bookings.review', $booking->id)); ?>" method="POST" style="display:none;" id="form-<?php echo e($booking->id); ?>">
												<?php echo csrf_field(); ?>
												
											</form>
											<?php else: ?>
											<a href="<?php echo e(route('admin.bookings.edit', $booking->id)); ?>" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											<?php endif; ?>
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-<?php echo e($booking->id); ?>').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="<?php echo e(route('admin.bookings.delete', $booking->id)); ?>" method="POST" style="display:none;" id="block-<?php echo e($booking->id); ?>">
												<?php echo csrf_field(); ?>
												<?php echo method_field('DELETE'); ?>
											</form>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
							<?php echo e($bookings->links()); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/bookings/index.blade.php ENDPATH**/ ?>