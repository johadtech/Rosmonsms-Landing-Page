<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
        <meta name="Version" content="v1.0">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<meta name="theme-color" content="#0E159A">
	    <title></title>
	
		<!-- ===== All CSS files ===== -->
        <link rel="stylesheet" href="/template/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/template/assets/css/animate.css" />
		<link rel="stylesheet" href="/template/assets/css/lineicons.css" />
		<link rel="stylesheet" href="/template/assets/css/ud-styles.css?v=<?php echo e(time()); ?>" />
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Montserrat:wght@700&family=Lato:wght@700&family=Oswald:wght@700&family=Raleway:wght@700&family=Poppins:wght@700&family=Playfair+Display:wght@700&family=Bebas+Neue&family=Anton&family=Nunito:wght@700&display=swap">
        
        
        <?php echo getHeaderScript(); ?>

        <?php echo $__env->yieldContent('seo'); ?>
	    
		<style>.whatsapp-cta-container,.whatsapp-icon{position:fixed;z-index:999;width:50px;height:50px;border-radius:50%;text-align:center;line-height:50px}.whatsapp-cta-container strong{color:#000}.whatsapp-icon{background-color:#25d366;font-size:24px;color:#fff;cursor:pointer}.whatsapp-icon a i{transition:transform .3s ease-in-out}.whatsapp-cta-container:hover i,.whatsapp-icon a:hover i{transform:rotateZ(360deg)}.whatsapp-icon--left{left:20px;top:88%}.whatsapp-icon--right{right:20px;top:70%}</style>
	</head>
	<body style="font-size:0.8em;">
		
		<?php echo $__env->make('pages.partial.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('partials.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<?php echo $__env->yieldContent('content'); ?>
		
		<!-- WhatsApp Floating Icons -->
		<div class="whatsapp-cta-container left">
			<a href="<?php echo e(gs()->whatsapp_support); ?>" target="_blank" class="whatsapp-icon whatsapp-icon--left">
			    <i class="lni lni-whatsapp"></i>
			</a>
			
		</div>
		<div class="whatsapp-cta-container right d-none">
			<a href="<?php echo e(gs()->whatsapp_support); ?>" target="_blank" class="whatsapp-icon whatsapp-icon--right">
			    <i class="icofont-whatsapp"></i>
			</a>
			<strong style="position: fixed;z-index: 999;text-align: center;right: 20px;top: 76%;color: #000000;">Support</strong>
		</div>
		
		<!-- ====== Footer Start ====== -->
		<footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
			<div class="shape shape-1">
				<img src="/template/assets/images/footer/shape-1.svg" alt="shape" />
			</div>
			<div class="shape shape-2">
				<img src="/template/assets/images/footer/shape-2.svg" alt="shape" />
			</div>
			<div class="shape shape-3">
				<img src="/template/assets/images/footer/shape-3.svg" alt="shape" />
			</div>
			<div class="ud-footer-widgets">
				<div class="container">
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-6">
							<div class="ud-widget">
								<a href="<?php echo e(url('/')); ?>" class="ud-footer-logo">
									<img src="<?php echo e(asset('storage/general/'.gs()->logo)); ?>" alt="logo" />
								</a>
								<p class="ud-widget-desc">
									<?php echo e(front_setting('footer_description')); ?>

								</p>
								<ul class="ud-widget-socials">
									<li>
										<a href="<?php echo e(gs()->social_facebook); ?>">
											<i class="lni lni-facebook-filled"></i>
										</a>
									</li>
									<li>
										<a href="<?php echo e(gs()->social_twitter); ?>">
											<i class="lni lni-twitter-filled"></i>
										</a>
									</li>
									<li>
										<a href="<?php echo e(gs()->social_instagram); ?>">
											<i class="lni lni-instagram-filled"></i>
										</a>
									</li>
									<li>
										<a href="mailto:<?php echo e(gs()->site_email); ?>">
											<i class="lni lni-linkedin-original"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
	
						<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
							<div class="ud-widget">
								<h5 class="ud-widget-title"><?php echo e(__('Quick link')); ?></h5>
								<ul class="ud-widget-links">
									<li>
										<a href="<?php echo e(url('/')); ?>">Home</a>
									</li>
									<li>
										<a href="#features">Features</a>
									</li>
									<li>
										<a href="<?php echo e(url('/about-us')); ?>">About</a>
									</li>
									<li>
										<a href="#testimonials">Testimonial</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
							<div class="ud-widget">
								<h5 class="ud-widget-title"><?php echo e(__('Our Company')); ?></h5>
								<ul class="ud-widget-links">
									<li>
										<a href="#about">How it works</a>
									</li>
									<li>
										<a href="<?php echo e(route('privacypolicy')); ?>">Privacy policy</a>
									</li>
									<li>
										<a href="<?php echo e(route('termcondition')); ?>">Terms of service</a>
									</li>
									<li>
										<a href="javascript:void(0)">Refund policy</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
							<div class="ud-widget">
								<h5 class="ud-widget-title"><?php echo e(__('Our Products')); ?></h5>
								<ul class="ud-widget-links">
									<li>
										<a href="" rel="nofollow noopner" target="_blank" >Lineicons
										</a>
									</li>
									<li>
										<a href="" rel="nofollow noopner" target="_blank" >Ecommerce HTML</a
										>
									</li>
									<li>
										<a href="" rel="nofollow noopner" target="_blank" >Ayro UI</a
										>
									</li>
									<li>
										<a href="" rel="nofollow noopner" target="_blank" >Plain Admin</a
										>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-8 col-sm-10">
							<div class="ud-widget">
								<h5 class="ud-widget-title"><?php echo e(__('Partners')); ?></h5>
								<ul class="ud-widget-brands">
									<?php $__currentLoopData = App\Models\Partner::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
										<a href="Javascript:void(0);" rel="nofollow noopner" target="_blank">
											<img src="<?php echo e(asset('storage/partner/' . $partner->brand_image)); ?>" alt="<?php echo e($partner->brand_name); ?>" />
										</a>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ud-footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<ul class="ud-footer-bottom-left">
								<li>
									<a href="<?php echo e(route('privacypolicy')); ?>">Privacy policy</a>
								</li>
								<li>
									<a href="javascript:void(0)">Support policy</a>
								</li>
								<li>
									<a href="<?php echo e(route('termcondition')); ?>">Terms of service</a>
								</li>
							</ul>
						</div>
						<div class="col-md-4">
							<p class="ud-footer-bottom-right">
								© <script>document.write(new Date().getFullYear())</script> <?php echo e(gs()->site_name); ?>.
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- ====== Footer End ====== -->
			
		<!-- ====== Back To Top Start ====== -->
		<a href="javascript:void(0)" class="back-to-top">
			<i class="lni lni-chevron-up"> </i>
		</a>
		<!-- ====== Back To Top End ====== -->
			
		<!--Start of Tawk.to Script-->
		<script type="text/javascript">
			var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
	
			(function() {
			    var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
			    s1.async = true;
			    s1.src = 'https://embed.tawk.to/<?php echo e(gs()->tawk_widget_id); ?>/<?php echo e(gs()->tawk_property_id); ?>';
			    s1.charset = 'UTF-8';
			    s1.setAttribute('crossorigin', '*');
			    s0.parentNode.insertBefore(s1, s0);
			})();
		</script>
		<!--End of Tawk.to Script-->
	
		<!-- ====== All Javascript Files ====== -->
		<script src="/template/assets/js/bootstrap.bundle.min.js"></script>
		<script src="/template/assets/js/wow.min.js"></script>
		<script src="/template/assets/js/main.js"></script>
		<script>
			// ==== for menu scroll
			const pageLink = document.querySelectorAll(".ud-menu-scroll");
			
			pageLink.forEach((elem) => {
				elem.addEventListener("click", (e) => {
					const href = elem.getAttribute("href");
					if (href.startsWith('#')) {
						e.preventDefault();
						document.querySelector(href).scrollIntoView({
							behavior: "smooth",
							offsetTop: 1 - 60,
						});
					}
				});
			});
			
			// section menu active
			function onScroll(event) {
				const sections = document.querySelectorAll(".ud-menu-scroll");
				const scrollPos =
					window.pageYOffset ||
					document.documentElement.scrollTop ||
					document.body.scrollTop;
			
				for (let i = 0; i < sections.length; i++) {
					const currLink = sections[i];
					const val = currLink.getAttribute("href");
					const refElement = document.querySelector(val);
					const scrollTopMinus = scrollPos + 73;
					if (
						refElement &&
						refElement.offsetTop <= scrollTopMinus &&
						refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
					) {
						document.querySelector(".ud-menu-scroll.active")?.classList.remove("active");
						currLink.classList.add("active");
					} else {
						currLink.classList.remove("active");
					}
				}
			}
			
			window.document.addEventListener("scroll", onScroll);
			
			// ==== for menu scroll
			/**
			const pageLink = document.querySelectorAll(".ud-menu-scroll");
	
			pageLink.forEach((elem) => {
				elem.addEventListener("click", (e) => {
					e.preventDefault();
					document.querySelector(elem.getAttribute("href")).scrollIntoView({
						behavior: "smooth",
						offsetTop: 1 - 60,
					});
				});
			});
			**/
	
			// section menu active
			/**
			function onScroll(event) {
				const sections = document.querySelectorAll(".ud-menu-scroll");
				const scrollPos =
				window.pageYOffset ||
				document.documentElement.scrollTop ||
				document.body.scrollTop;
	
				for (let i = 0; i < sections.length; i++) {
					const currLink = sections[i];
					const val = currLink.getAttribute("href");
					const refElement = document.querySelector(val);
					const scrollTopMinus = scrollPos + 73;
					if (
						refElement.offsetTop <= scrollTopMinus &&
						refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
					) {
						document
						.querySelector(".ud-menu-scroll")
						.classList.remove("active");
						currLink.classList.add("active");
					} else {
						currLink.classList.remove("active");
					}
				}
			}
	
			window.document.addEventListener("scroll", onScroll);
			**/
		</script>
		
		<script>
			window.addEventListener('scroll', function () {
			    const ud_header = document.querySelector(".ud-header");
			    const logo = document.querySelector(".navbar-brand img");
			
			    if (ud_header.classList.contains("sticky")) {
			        logo.src = "<?php echo e(asset('storage/general/'.gs()->logo)); ?>";
			    } else {
			        logo.src = "<?php echo e(asset('storage/general/'.gs()->logo)); ?>";
			    }
			});
			
		</script>
        
        
        
        <?php echo getFooterScript(); ?>

        
    </body>
</html><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/layouts/main.blade.php ENDPATH**/ ?>