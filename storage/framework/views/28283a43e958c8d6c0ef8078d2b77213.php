
<!-- Include AlertifyJS CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css">
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if(session('success')): ?>
            alertify.set('notifier','position', 'top-right');
            alertify.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(session('error')): ?>
            alertify.set('notifier','position', 'top-right');
            alertify.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>
        <?php if(session('info')): ?>
            alertify.set('notifier','position', 'top-right');
            alertify.message("<?php echo e(session('info')); ?>");
        <?php endif; ?>
    });
</script>



<?php if($errors->any()): ?>
	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<script>
	    document.addEventListener("DOMContentLoaded", function() {
            alertify.set('notifier','position', 'top-right');
            alertify.error("<?php echo e($error); ?>");
		});
	</script>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /home/rosmonsm/public_html/resources/views/partials/alert.blade.php ENDPATH**/ ?>