<!-- Hero Start -->
<section class="bg-half-170 d-table w-100 overflow-hidden">
	<div class="container">
		<div class="row align-items-center pt-5">
			<div class="col-lg-7 col-md-6">
				<div class="title-heading text-center">
					<span class="badge text-bg-primary rounded-pill mb-2">{{ front_setting('hero_tagline', 'Modern Apps') }}</span>
					<h1 class="heading fw-bold mb-3" style="font-family: 'Montserrat', sans-serif;">Enhance education with our all in <span class="text-primary">one LMS software.</span></h1>
					{{--<h1 class="heading fw-bold mb-3 d-none" style="font-family: 'Montserrat', sans-serif;">The AI Content Plaform <br> for <span class="text-primary typewrite" data-period="2000" data-type='[ "Videos", "Modern Teams", "Social Media" ]'> <span class="wrap"></span> </span></h1>--}}
					<p class="para-desc text-muted text-center">
						{{ front_setting('hero_description', 'We empower schools and government agencies with digital infrastructure for enhanced learning outcomes.') }}
					</p>
					<div class="mt-4 pt-2">
						<a href="{{route('bookdemo')}}" class="btn btn-primary w-50"><i class="uil uil-bookmark"></i> Book a demo</a>
						<a href="#about" class="btn btn-outline-primary btn-soft--primary mt-2 w-100">How it works<span class="badge rounded-pill bg-danger ms-2">v1.0.0</span></a>
						<p class="text-muted small mb-0 mt-1 text-center">
							No credit card required. Free 14-days trial
						</p>
					</div>
				</div>
			</div>
			<!--end col-->

			<div class="col-lg-5 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
				<div class="ai-hero position-relative">
					<div class="image position-relative">
						<img src="{{ asset('storage/hero/' . front_setting('hero_image', 'default.jpg')) }}" class="mx-auto d-block" alt="">
					</div>
				</div>
			</div>
			<!--end col-->
		</div>
		<!--end row-->
	</div>
	<!--end container-->
</section>
<!--end section-->
<!-- Hero End -->