<?php $__env->startSection('seo'); ?>
<!-- start favicon -->
<link type="image/x-icon" rel="shortcut icon" href="<?php echo e(asset('storage/general/'.gs()->favicon)); ?>" />
<!-- end favicon -->
<?php echo SEOMeta::generate(); ?>

<?php echo OpenGraph::generate(); ?>

<?php echo Twitter::generate(); ?>

<?php echo JsonLd::generate(); ?>

<?php echo SEO::generate(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Start -->
<?php
	$postCheck = \App\Models\Post::where('status', 1)->get();
?>

<!-- ====== Banner Start ====== -->
<section class="ud-page-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-banner-content">
					<h1><?php echo e(__('Blog Page')); ?></h1>
				</div>
			</div>
			<div class="container text-center justify-content-center">

				<div class="position-breadcrumb">
					<nav aria-label="breadcrumb" class="d-inline-block bg-white bg-light">
						<ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Page</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Blog')); ?></li>
						</ul>
					</nav>
				</div>
			</div>
			<!--end container-->
		</div>
	</div>
</section>
<!-- ====== Banner End ====== -->
	
<!-- ====== Blog Start ====== -->
<?php if($postCheck->isNotEmpty()): ?>
<section class="ud-blog-grids">
	<div class="container">
		<div class="row">
			<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<div class="col-lg-4 col-md-6">
					<div class="ud-single-blog">
						<div class="ud-blog-image">
							<a href="<?php echo e(route('showblogpost', $post->slug)); ?>">
								<img src="<?php echo e(asset('storage/post/'.$post->thumbnail)); ?>" alt="<?php echo e(__($post->title)); ?>">
							</a>
						</div>
						<div class="ud-blog-content">
							<span class="ud-blog-date"><?php echo e(__(\Carbon\Carbon::parse($post->created_at)->format('jS \of F, Y'))); ?></span>
							<h3 class="ud-blog-title">
								<a href="<?php echo e(route('showblogpost', $post->slug)); ?>">
									<?php echo e(__($post->title)); ?>

								</a>
							</h3>
							<p class="ud-blog-desc">
								<?php echo e(__($post->description ?? str_limit(strip_tags($post->content), 100, '...'))); ?>

							</p>
						</div>
					</div>
				</div>
			
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>
<?php endif; ?>
<!-- ====== Blog End ====== -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/public_html/resources/views/pages/blog.blade.php ENDPATH**/ ?>