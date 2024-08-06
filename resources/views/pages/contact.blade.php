@extends('layouts.main')

@section('seo')
<!-- start favicon -->
<link type="image/x-icon" rel="shortcut icon" href="{{ asset('storage/general/'.gs()->favicon) }}" />
<!-- end favicon -->
{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!}
{!! SEO::generate() !!}
@endsection

@section('content')

<!-- ====== Banner Start ====== -->
<section class="ud-page-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-banner-content">
					<h1>{{ $page->title }}</h1>
				</div>
			</div>
			<div class="container text-center justify-content-center">

				<div class="position-breadcrumb">
					<nav aria-label="breadcrumb" class="d-inline-block bg-white bg-light">
						<ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
							<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Page</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
						</ul>
					</nav>
				</div>
			</div>
			<!--end container-->
		</div>
	</div>
</section>
<!-- ====== Banner End ====== -->

<!-- ====== Contact Start ====== -->
<section id="contact" class="ud-contact">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-xl-8 col-lg-7">
				<div class="ud-contact-content-wrapper">
					<div class="ud-contact-title">
						<span>CONTACT US</span>
						<h2>
							{{ __(front_setting('contact_us_text')) }}
						</h2>
					</div>
					<div class="ud-contact-info-wrapper">
						<div class="ud-single-info">
							<div class="ud-info-icon">
								<i class="lni lni-map-marker"></i>
							</div>
							<div class="ud-info-meta">
								<h5>Our Location</h5>
								<p>
									{{ gs()->site_address }}
								</p>
							</div>
						</div>
						<div class="ud-single-info">
							<div class="ud-info-icon">
								<i class="lni lni-envelope"></i>
							</div>
							<div class="ud-info-meta">
								<h5>How Can We Help?</h5>
								<p>
									<a href="tel:{{ gs()->site_mobile }}" class="read-more">{{ gs()->site_mobile }}</a>
								</p>
								<p>
									<a href="mailto:{{ gs()->site_email }}" class="read-more">{{ gs()->site_email }}</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Map Section Start -->
            <div class="col-xl-4 col-lg-5 mb-3">
                <div class="ud-map-wrapper wow fadeInUp" data-wow-delay=".2s">
                    <h3 class="ud-map-title">Our Location on Map</h3>
                    <div class="ud-map">
                        <iframe src="{{ gs()->map_url }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
            <!-- Map Section End -->
			
			<div class="col-xl-4 col-lg-5">
				<div class="ud-contact-form-wrapper wow fadeInUp" data-wow-delay=".2s">
					<h3 class="ud-contact-form-title">Send us a Message</h3>
					<form class="ud-contact-form" action="" method="POST">
						<div class="ud-form-group">
							<label for="fullName">Full Name*</label>
							<input type="text" name="fullName" placeholder="Adam Gelius" />
						</div>
						<div class="ud-form-group">
							<label for="email">Email*</label>
							<input type="email" name="email" placeholder="example@yourmail.com" />
						</div>
						<div class="ud-form-group">
							<label for="phone">Phone*</label>
							<input type="text" name="phone" placeholder="+885 1254 5211 552" />
						</div>
						<div class="ud-form-group">
							<label for="message">Message*</label>
							<textarea name="message" rows="1" placeholder="type your message here"></textarea>
						</div>
						<div class="ud-form-group mb-0">
							<button type="submit" class="ud-main-btn">
								Send Message
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ====== Contact End ====== -->





<!-- Call To Action Start -->
<section class="section bg---light" style="display:none;">
	<div class="container mt-100 mt-60">
		<div class="row justify-content-center">
			<div class="col-12 text-center">
				<div class="section-title">
					<h4 class="title mb-4">Get Started Today with a Free Demo!</h4>
					<p class="text-muted para-desc mx-auto">
						Book a demo now and see how our platform can transform your school's operations, improve communication and enhance learning outcomes.
					</p>

					<div class="mt-4">
						<a href="{{route('bookdemo')}}" class="btn btn-primary mt-2 me-2">Get Started Now</a>
						<a href="{{url('/')}}" class="btn btn-outline-primary mt-2">Home</a>
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
<!-- Call To Action End -->

<!-- End Privacy -->
@endsection