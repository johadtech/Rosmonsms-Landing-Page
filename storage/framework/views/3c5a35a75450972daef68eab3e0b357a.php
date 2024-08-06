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
						
						<h5 class="mb-2 text-center small">Users</h5>
						
						<div class="text-center p-4 pb-sm-2">
							<a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-plus f-18"></i>
								All Users
							</a>

							<a href="<?php echo e(route('admin.users.index', ['status' => 1])); ?>" class="btn btn-sm btn-danger mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-user-off f-18"></i>
								Banned Users
							</a>

							<a href="<?php echo e(route('admin.users.index', ['status' => 0])); ?>" class="btn btn-sm btn-success mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-users f-18"></i>
								Active Users
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
										<th><?php echo e(__('Date/Time')); ?></th>
										<th><?php echo e(__('Action')); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div class="flex-shrink-0">
													<img src="../assets/images/user/avatar-1.jpg" alt="user image" class="img-radius wid-40">
												</div>
												<div class="flex-grow-1 ms-3">
													<h6 class="mb-0"><?php echo e(__($user->fullname())); ?></h6>
												</div>
											</div>
										</td>
										<td><?php echo e(__($user->mobile)); ?></td>
										<td><?php echo e(__($user->email)); ?></td>
										<td>
											<span class="badge <?php echo e($user->status == 1 ? 'bg-light-danger' : 'bg-light-success'); ?> rounded-pill f-12"> <?php echo e($user->status == 1 ? 'Banned' : 'Active'); ?> </span>
										</td>
										<td>
											<?php echo e(formatCreatedAt($user->created_at)['date']); ?>

											<span class="text-muted text-sm d-block">
												<?php echo e(formatCreatedAt($user->created_at)['time']); ?>

											</span>
										</td>
										<td>
											<a href="#" class="avtar avtar-xs btn-light-success" onclick="event.preventDefault(); document.getElementById('form-<?php echo e($user->id); ?>').submit();">
												<i class="ti ti-eye f-20 text-success"></i>
											</a>
											<form action="<?php echo e(route('admin.users.login', $user->id)); ?>" method="POST" style="display:none;" id="form-<?php echo e($user->id); ?>">
												<?php echo csrf_field(); ?>
											</form>
											<a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-<?php echo e($user->id); ?>').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="<?php echo e(route('admin.users.login', $user->id)); ?>" method="POST" style="display:none;" id="block-<?php echo e($user->id); ?>">
												<?php echo csrf_field(); ?>
											</form>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
							<?php echo e($users->links()); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/users/index.blade.php ENDPATH**/ ?>