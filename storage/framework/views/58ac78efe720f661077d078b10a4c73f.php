

<?php $__env->startSection('content'); ?>
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 text-center">Edit Partner</h5>
                        <form action="<?php echo e(route('admin.partners.update', $partner->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label for="brand_name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?php echo e($partner->brand_name); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="brand_image" class="form-label">Brand Image</label>
                                <input type="file" class="form-control" id="brand_image" name="brand_image">
                                <img src="<?php echo e(asset('storage/partner/' . $partner->brand_image)); ?>" alt="Brand Image" class="img-radius wid-40 mt-2">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Partner</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/partners/edit.blade.php ENDPATH**/ ?>