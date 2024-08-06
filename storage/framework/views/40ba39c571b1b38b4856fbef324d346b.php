

<?php $__env->startSection('content'); ?>
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-body pt-3">
                        <h5 class="mb-2 text-center">Partners</h5>
                        <div class="text-center p-4 pb-sm-2">
                            <a href="<?php echo e(route('admin.partners.create')); ?>" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2 small">
                                <i class="ti ti-plus f-18"></i>
                                Add New Partner
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Brand Name')); ?></th>
                                        <th><?php echo e(__('Brand Image')); ?></th>
                                        <th><?php echo e(__('Date/Time')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($partner->brand_name); ?></td>
                                        <td><img src="<?php echo e(asset('storage/partner/' . $partner->brand_image)); ?>" alt="Brand Image" class="img-radius wid-40"></td>
                                        <td>
	                                        <?php echo e(formatCreatedAt($partner->created_at)['date']); ?>

											<span class="text-muted text-sm d-block">
												<?php echo e(formatCreatedAt($partner->created_at)['time']); ?>

											</span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.partners.edit', $partner->id)); ?>" class="avtar avtar-xs btn-light-primary">
                                                <i class="ti ti-edit f-20 text-primary"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.partners.delete', $partner->id)); ?>" method="POST" style="display:inline-block;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="avtar avtar-xs btn-light-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="ti ti-trash f-20 text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($partners->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/partners/index.blade.php ENDPATH**/ ?>