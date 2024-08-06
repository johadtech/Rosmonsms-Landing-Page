

<?php $__env->startSection('seo'); ?>
    <!-- start favicon -->
    <link type="image/x-icon" rel="shortcut icon" href="<?php echo e(asset('storage/general/'.gs()->favicon)); ?>"/>
    <!-- end favicon -->
	<?php echo SEOMeta::generate(); ?>

    <?php echo OpenGraph::generate(); ?>

    <?php echo Twitter::generate(); ?>

    <?php echo JsonLd::generate(); ?>

    <?php echo SEO::generate(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
    	
    <!-- ====== Terms&Conditions Start ====== -->
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
            <img src="<?php echo e(asset('storage/general/' . front_setting('terms_and_conditions_image'))); ?>" alt="about-image" />
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Terms&Conditions End ====== -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/public_html/resources/views/pages/terms-and-conditions.blade.php ENDPATH**/ ?>