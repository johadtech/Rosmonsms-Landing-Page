<!-- ====== Header Start ====== -->
<header class="ud-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<nav class="navbar navbar-expand-lg">
					<a class="navbar-brand" href="<?php echo e(url('/')); ?>">
						<img src="<?php echo e(asset('storage/general/'.gs()->logo)); ?>" alt="Logo" />
					</a>
					<button class="navbar-toggler">
						<span class="toggler-icon"> </span>
						<span class="toggler-icon"> </span>
						<span class="toggler-icon"> </span>
					</button>

					<div class="navbar-collapse">
						<ul id="nav" class="navbar-nav mx-auto">
							<li class="nav-item">
								<a class="ud-menu-scroll" href="<?php echo e(url('/')); ?>">Home</a>
							</li>
							<li class="nav-item">
								<a class="ud-menu-scroll" href="<?php echo e(route('blog')); ?>">Blog</a>
							</li>
							<li class="nav-item">
								<a class="ud-menu-scroll" href="<?php echo e(route('about')); ?>">About Us</a>
							</li>
							<li class="nav-item">
								<a class="ud-menu-scroll" href="<?php echo e(route('contact')); ?>">Contact Us</a>
							</li>
							<li class="nav-item">
								<a class="ud-menu-scroll" href="<?php echo e(route('privacypolicy')); ?>">Privacy Policy</a>
							</li>
							<li class="nav-item">
								<a class="ud-menu-scroll" href="<?php echo e(route('termcondition')); ?>">Terms of Services</a>
							</li>
						</ul>
					</div>

					<div class="navbar-btn d-none d-sm-inline-block">
						
						<a class="ud-main-btn ud-white-btn" href="javascript:void(0)">
							Get Demo
						</a>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- ====== Header End ====== --><?php /**PATH /home/rosmonsm/public_html/resources/views/pages/partial/navbar.blade.php ENDPATH**/ ?>