<!-- ====== Hero Start ====== -->
	<section class="ud-hero" id="home">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
						<h1 class="ud-hero-title">
							<?php echo e(front_setting('hero_tagline', 'Empowering schools with premium All in on School management software')); ?>

						</h1>
						<p class="ud-hero-desc">
							<?php echo e(front_setting('hero_description', 'We empower schools and government agencies with digital infrastructure for enhanced learning outcomes.')); ?>

						</p>
						<ul class="ud-hero-buttons">
							<li>
								<a href="<?php echo e(route('bookdemo')); ?>" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-white-btn">
									<?php echo e(__(front_setting('hero_button_one'))); ?>

								</a>
							</li>
							<li>
								<a href="#about" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-link-btn" style="border: 2px solid #fff;">
								    <?php echo e(__(front_setting('hero_button_two'))); ?> <i class="lni lni-arrow-right"></i>
								</a>
							</li>
						</ul>
					</div>
					
					<div class="ud-hero-image wow fadeInUp" data-wow-delay=".25s">
						
						<img src="<?php echo e(asset('storage/hero/' . front_setting('hero_image'))); ?>" alt="hero-image" />
						<img src="/template/assets/images/hero/dotted-shape.svg" alt="shape" class="shape shape-1" />
						<img src="/template/assets/images/hero/dotted-shape.svg" alt="shape" class="shape shape-2" />
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- ====== Hero End ====== -->
<?php /**PATH /home/rosmonsm/public_html/resources/views/pages/partial/hero.blade.php ENDPATH**/ ?>