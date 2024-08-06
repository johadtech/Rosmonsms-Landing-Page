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
	$team = \App\Models\TeamMember::where('status', 1)->get();
?>

<!-- ====== Banner Start ====== -->
<section class="ud-page-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-banner-content">
					<h1><?php echo e($page->title); ?></h1>
				</div>
			</div>
			<div class="container text-center justify-content-center">

				<div class="position-breadcrumb">
					<nav aria-label="breadcrumb" class="d-inline-block bg-white bg-light">
						<ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
							<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Page</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo e($page->title); ?></li>
						</ul>
					</nav>
				</div>
			</div>
			<!--end container-->
		</div>
	</div>
</section>
<!-- ====== Banner End ====== -->

<!-- ====== About Start ====== -->
<section id="about" class="ud-about">
	<div class="container">
		<div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
			<div class="ud-about-content-wrapper">
				<div class="ud-about-content">
					<span class="tag"><?php echo e($page->title); ?></span>
					<h2><span class="text-dark">Last Revised :</span> <?php echo e($page->formatted_created_at); ?></h2>
					<p>
						<?php echo $page->content; ?>

					</p>
					<a href="javascript:window.print()" class="ud-main-btn d--none">Print a Copy</a>
				</div>
			</div>
			<div class="ud-about-image">
				<img src="<?php echo e(asset('storage/general/' . front_setting('about_us_image'))); ?>" alt="about-image" />
			</div>
		</div>
	</div>
</section>
<!-- ====== About End ====== -->
	
<!-- ====== Team Start ====== -->
<?php if($team->isNotEmpty()): ?>
<section id="team" class="ud-team">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-section-title mx-auto text-center">
					<span>Our Team</span>
					<h2>Meet The Team</h2>
					<p>
						<?php echo e(__(front_setting('about_us_team_text', 'Here is our teams'))); ?>

					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<?php $__currentLoopData = App\Models\TeamMember::active()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-xl-3 col-lg-3 col-sm-6">
				<div class="ud-single-team wow fadeInUp" data-wow-delay=".1s">
					<div class="ud-team-image-wrapper">
						<div class="ud-team-image">
							<img src="<?php echo e(asset('storage/team/'.$item->team_image)); ?>" alt="team" />
						</div>
						<img src="/template/assets/images/team/dotted-shape.svg" alt="shape" class="shape shape-1">
						<img src="/template/assets/images/team/shape-2.svg" alt="shape" class="shape shape-2">
					</div>
					<div class="ud-team-info">
						<h5><?php echo e(__($item->team_fullname)); ?></h5>
						<h6><?php echo e(__($item->team_position)); ?></h6>
					</div>
					<ul class="ud-team-socials">
						<li>
							<a href="<?php echo e($item->team_fb_url); ?>">
								<i class="lni lni-facebook-filled"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo e($item->team_tw_url); ?>">
								<i class="lni lni-twitter-filled"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo e($item->team_ig_url); ?>">
								<i class="lni lni-instagram-filled"></i>
							</a>
						</li>
						<li>
							<a href="<?php echo e($item->team_lk_url); ?>">
								<i class="lni lni-linkedin-original"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>
<?php endif; ?>
<!-- ====== Team End ====== -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/public_html/resources/views/pages/about.blade.php ENDPATH**/ ?>