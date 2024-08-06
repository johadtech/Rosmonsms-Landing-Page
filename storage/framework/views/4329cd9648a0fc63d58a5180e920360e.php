

<?php $__env->startSection('content'); ?>
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header d-none">
                        <h5 class="mb-0 text-center d-none">FAQs</h5>
                    </div>
                    <div class="card-body pt-3">
                        <h5 class="mb-2 text-center small">Frequently Asked Questions</h5>
                        <div class="text-center p-4 pb-sm-2">
							<a href="<?php echo e(route('admin.faqs.create')); ?>" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-plus f-18"></i>
								Create New FAQ
							</a>

							<a href="<?php echo e(route('admin.faqs.index', ['status' => 0])); ?>" class="btn btn-sm btn-danger mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-writing f-18"></i>
								Pending FAQ
							</a>

							<a href="<?php echo e(route('admin.faqs.index', ['status' => 1])); ?>" class="btn btn-sm btn-success mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-writing-sign f-18"></i>
								Active FAQ
							</a>
						</div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Content')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Date/Time')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(__($faq->title)); ?></td>
                                        <td><?php echo __($faq->content); ?></td>
                                        <td><?php echo e($faq->status == 1 ? 'Active' : 'Pending'); ?></td>
                                        <td>
                                            <?php echo e(formatCreatedAt($faq->created_at)['date']); ?>

                                            <span class="text-muted text-sm d-block">
                                                <?php echo e(formatCreatedAt($faq->created_at)['time']); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.faqs.edit', $faq->id)); ?>" class="avtar avtar-xs btn-light-danger">
                                                <i class="ti ti-edit f-20 text-primary"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('delete-<?php echo e($faq->id); ?>').submit();">
                                                <i class="ti ti-trash f-20 text-danger"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.faqs.delete', $faq->id)); ?>" method="POST" style="display:none;" id="delete-<?php echo e($faq->id); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($faqs->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/faqs/index.blade.php ENDPATH**/ ?>