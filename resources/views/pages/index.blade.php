@extends('layouts.main')

@section('seo')
    <!-- start favicon -->
    <link type="image/x-icon" rel="shortcut icon" href="{{ asset('storage/general/'.gs()->favicon) }}"/>
    <!-- end favicon -->
	{!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    {!! SEO::generate() !!}
@endsection

@section('content')
@php
    $faqs = \App\Models\Faq::where('status', 1)->get();
    $tes = \App\Models\Testimony::where('status', 1)->get();
@endphp

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

	@include('pages.partial.hero')
	{{--@include('pages.partial.partner')--}}
	
	<style>.text-content,.video-content{text-align:center;max-width:100%}.info-section{padding:50px 5%;background-color:#f6e4cc}.info-content{display:flex;align-items:center;justify-content:space-between;flex-direction:column}.text-content{flex:1;order:1}.video-content{flex:1;order:2;margin-top:20px}.text-content h2{font-size:28px;color:#2b3990;margin-bottom:20px;line-height:1.2;font-family:Montserrat,sans-serif}.text-content p{font-size:16px;color:#333;line-height:1.6;font-family:Nunito,Arial,sans-serif}.video-content video{max-width:100%;height:auto;border-radius:10px}.institution-info-section{padding:50px 5%;background-color:#2b3990;text-align:center;color:#fff}.institution-info-content{display:flex;flex-wrap:wrap;justify-content:space-between}.info-box{flex:1 1 calc(25% - 20px);background-color:#fff;color:#2b3990;margin:10px;padding:20px;border-radius:10px;text-align:center;transition:transform .3s}.info-box:hover{transform:scale(1.05)}.info-box ion-icon{font-size:32px;color:#ff9000;margin-bottom:10px}.info-box h3{margin-bottom:10px;font-family:Montserrat,sans-serif}.info-box p{color:#333;font-family:Nunito,Arial,sans-serif}@media (max-width:768px){.institution-info-content{flex-direction:row;flex-wrap:wrap}.info-box{flex:1 1 calc(50% - 20px);margin:10px 5px;animation:1s ease-in-out bounceInFromBelow}.info-box h3{font-size:16px}.info-box p{font-size:12px}}@media (min-width:769px){.info-content{flex-direction:row}.text-content{max-width:50%;order:2;text-align:left;padding-left:5%}.text-content p{font-size:.8em}.video-content{max-width:50%;order:1;margin-top:0}.info-box ion-icon{font-size:3em}.info-box h3{font-size:18px}.info-box p{padding:5px;font-size:14px}}@media (min-width:1024px){.info-content{flex-direction:row}.info-section .text-content{max-width:50%;order:2;text-align:left;padding-left:5%}.info-section .text-content p{font-size:.8em}.info-section .video-content{max-width:50%;order:1;margin-top:0}.info-section .info-content .text-content h2{font-size:32px}.info-section .info-content .text-content p{font-size:20px}}.parent-activities-section{padding:50px 5%;background-color:#f9f9f9;display:flex;justify-content:center;align-items:center;text-align:center}.parent-activities-content{max-width:800px;margin:0 auto}.parent-activities-section h2{color:#2b3990;margin-bottom:20px;line-height:1.2;font-family:Montserrat,sans-serif}.parent-activities-section p{color:#333;font-family:Nunito,Arial,sans-serif}@media (max-width:768px){.parent-activities-section{padding:30px 20px}.parent-activities-section h2{font-size:22px}.parent-activities-section p{font-size:16px}}@media (min-width:769px){.parent-activities-section h2{font-size:26px}.parent-activities-section p{font-size:18px}}@media (min-width:1024px){.parent-activities-section h2{font-size:28px}.parent-activities-section p{font-size:20px}}</style>
	<!-- ====== Features Start ====== -->
	<section id="features" class="ud-features d--none">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="ud-section-title">
						{{--<span>Features</span>--}}
						<h2>Why use {{ __(gs()->site_name) }}</h2>
						<p>
							You have at your disposal, world class software made to upscale your school.
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 col-lg-3 col-sm-6">
					<div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
						<div class="ud-feature-icon">
							<i class="lni lni-smile"></i>
						</div>
						<div class="ud-feature-content">
							<h3 class="ud-feature-title">Customizable Experience</h3>
							<p class="ud-feature-desc">
								Customize {{ __(gs()->site_name) }} to suit your unique school needs, curriculum and pedagogy seamlessly.
							</p>
							<a href="javascript:void(0)" class="ud-feature-link">
							</a>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-sm-6">
					<div class="ud-single-feature wow fadeInUp" data-wow-delay=".15s">
						<div class="ud-feature-icon">
							<i class="lni lni-support"></i>
						</div>
						<div class="ud-feature-content">
							<h3 class="ud-feature-title">Heroic Customer Support</h3>
							<p class="ud-feature-desc">
								Our customer care representatives are ever ready to assist you and your school through an exciting {{ __(gs()->site_name) }} journey.
							</p>
							<a href="javascript:void(0)" class="ud-feature-link">
							</a>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-sm-6">
					<div class="ud-single-feature wow fadeInUp" data-wow-delay=".2s">
						<div class="ud-feature-icon">
							<i class="lni lni-swift"></i>
						</div>
						<div class="ud-feature-content">
							<h3 class="ud-feature-title">Innovation & Artificial Intelligence(AI)</h3>
							<p class="ud-feature-desc">
								{{ __(gs()->site_name) }} uses AI to deliver an innovative product that solves all your school needs.
							</p>
							<a href="javascript:void(0)" class="ud-feature-link">
							</a>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-sm-6 d-none">
					<div class="ud-single-feature wow fadeInUp" data-wow-delay=".25s">
						<div class="ud-feature-icon">
							<i class="lni lni-layers"></i>
						</div>
						<div class="ud-feature-content">
							<h3 class="ud-feature-title">All Essential Elements</h3>
							<p class="ud-feature-desc">
								Lorem Ipsum is simply dummy text of the printing and industry.
							</p>
							<a href="javascript:void(0)" class="ud-feature-link">
								Learn More
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ====== Features End ====== -->
		
	<!-- ====== MY-About Start ====== -->
	<section id="about" class="ud-about" style="margin-bottom: -7em; margin-padding: -7em;">
		<div class="container">
			<div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
				<div class="info-section">
					<div class="info-content">
				        <div class="video-content">
				            <video controls>
				                <source src="{{ asset('storage/general/'.front_setting('below_hero_video'))}}" type="video/mp4">
				                {{ __('Your browser does not support the video tag.') }}
				            </video>
				        </div>
				        <div class="text-content">
				            <h2>{{ __(front_setting('below_hero_heading')) }}</h2>
				            <p>{{ __(front_setting('below_hero_description')) }}</p>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</section>
	<!-- ====== My-About End ====== -->
		
	<!-- ====== About Start ====== -->
	<section id="about" class="ud-about">
		<div class="container">
			<div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
				<div class="ud-about-content-wrapper">
					<div class="ud-about-content">
						<span class="tag">About Us</span>
						<h2>{{ __(front_setting('home_about_heading')) }}</h2>
						<p>
							{{ __(front_setting('home_about_description_one')) }}
						</p>

						<p>
							{{ __(front_setting('home_about_description_two')) }}
						</p>
						<a href="/about-us" class="ud-main-btn">{{ __(front_setting('home_about_button')) }}</a>
					</div>
				</div>
				<div class="ud-about-image">
					<img src="{{ asset('storage/general/'.front_setting('home_about_image'))}}" alt="about-image" />
				</div>
			</div>
		</div>
	</section>
	<!-- ====== About End ====== -->
		
	<!-- ====== P Start ====== -->
	<section class="parent-activities-section">
	    <div class="parent-activities-content">
	        <h2>Easily manage all activities involving parents</h2>
	        <p>Our software simplifies communication and coordination with parents, ensuring they are always informed and involved in their child's education.</p>
	    </div>
	</section>
	<!-- ====== P End ====== -->
		
	<!-- ====== Icon Section Start ====== -->
	<section class="institution-info-section">
	    <div class="institution-info-content">
	        <div class="info-box">
	            <ion-icon name="school-outline"></ion-icon>
	            <h3>Institute Info</h3>
	            <p>You can set your all institute info like logo, name, and header title, which will display on every printable documents and reports.</p>
	        </div>
	        <div class="info-box">
	            <ion-icon name="book-outline"></ion-icon>
	            <h3>Class Management</h3>
	            <p>The school management software manages your classes in an easy way, starting from students to subjects, courses to marks.</p>
	        </div>
	        <div class="info-box">
	            <ion-icon name="create-outline"></ion-icon>
	            <h3>Exams Management</h3>
	            <p>Globally has a complete solution for exams management starting from new exams to final results, reports and result cards.</p>
	        </div>
	        <div class="info-box">
	            <ion-icon name="checkmark-done-outline"></ion-icon>
	            <h3>Attendance System</h3>
	            <p>Our free school software has outstanding online attendance management system for students and staff.</p>
	        </div>
	        <div class="info-box">
	            <ion-icon name="wallet-outline"></ion-icon>
	            <h3>Fee Management</h3>
	            <p>Our school software opens an account for every student to manage its fees and dues, efficiently manages everything automatically.</p>
	        </div>
	        <div class="info-box">
	            <ion-icon name="clipboard-outline"></ion-icon>
	            <h3>Tests Management</h3>
	            <p>Managing class tests is a piece of cake with the free school management software. It keeps records of every class test.</p>
	        </div>
	        <div class="info-box">
	            <ion-icon name="calculator-outline"></ion-icon>
	            <h3>Accounts</h3>
	            <p>Managing income, expenses, and staff salaries is no more difficult. By using our software you can manage quite easily.</p>
	        </div>
	        <div class="info-box">
	            <ion-icon name="print-outline"></ion-icon>
	            <h3>Printable Reports</h3>
	            <p>You can print all the reports and letters like admission letter, fee slip, salary slip, job letter and result cards etc.</p>
	        </div>
	    </div>
	</section>
	<!-- ====== Icon Section End ====== -->
		
	<!-- ====== FAQ Start ====== -->
	@if($faqs->isNotEmpty())
	<section id="faq" class="ud-faq">
		<div class="shape">
			<img src="/template/assets/images/faq/shape.svg" alt="shape" />
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="ud-section-title text-center mx-auto">
						<span>FAQ</span>
						<h2>{{ __(front_setting('home_faq_heading')) }}</h2>
						<p>
							{{ __(front_setting('home_faq_description')) }}
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					@foreach(\App\Models\Faq::where('status', 1)->take(3)->get() as $item)
					<div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
						<div class="accordion">
							<button
								class="ud-faq-btn collapsed"
								data-bs-toggle="collapse"
								data-bs-target="#collapseOne"
								>
								<span class="icon flex-shrink-0">
									<i class="lni lni-chevron-down"></i>
								</span>
								<span>{{ __($item->title) }}</span>
							</button>
							<div id="collapseOne" class="accordion-collapse collapse">
								<div class="ud-faq-body">
									{!! __($item->content) !!}
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="col-lg-6">
					@foreach(\App\Models\Faq::where('status', 1)->skip(3)->take(3)->get() as $item)
					<div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
						<div class="accordion">
							<button
								class="ud-faq-btn collapsed"
								data-bs-toggle="collapse"
								data-bs-target="#collapseFour"
								>
								<span class="icon flex-shrink-0">
									<i class="lni lni-chevron-down"></i>
								</span>
								<span>{{ __($item->title) }}</span>
							</button>
							<div id="collapseFour" class="accordion-collapse collapse">
								<div class="ud-faq-body">
									{!! __($item->content) !!}
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
	@endif
	<!-- ====== FAQ End ====== -->
	
	<!-- ====== Testimonials Start ====== -->
	@if($tes->isNotEmpty())
	<section id="testimonials" class="ud-testimonials">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="ud-section-title mx-auto text-center">
						<span>Testimonials</span>
						<h2>{{ __(front_setting('home_testimony_heading')) }}</h2>
						<p>
							{{ __(front_setting('home_testimony_description')) }}
						</p>
					</div>
				</div>
			</div>

			<div class="row">
				@foreach(App\Models\Testimony::active()->get() as $item)
				<div class="col-lg-4 col-md-6">
					<div class="ud-single-testimonial wow fadeInUp" data-wow-delay=".1s">
						<div class="ud-testimonial-ratings">
							<i class="lni lni-star-filled"></i>
							<i class="lni lni-star-filled"></i>
							<i class="lni lni-star-filled"></i>
							<i class="lni lni-star-filled"></i>
							<i class="lni lni-star-filled"></i>
						</div>
						<div class="ud-testimonial-content">
							<p>
								“{!! __($item->content) !!}"
							</p>
						</div>
						<div class="ud-testimonial-info">
							<div class="ud-testimonial-image">
								<img src="{{ generate_avater($item->full_name) }}" alt="author" />
							</div>
							<div class="ud-testimonial-meta">
								<h4>{{$item->full_name}}</h4>
								<p>
									{{$item->occupation}}
								</p>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="ud-brands wow fadeInUp" data-wow-delay=".2s">
						<div class="ud-title">
							<h6>Trusted and Used by</h6>
						</div>
						<div class="ud-brands-logo">
							@foreach(App\Models\Partner::all() as $partner)
							<div class="ud-single-logo">
								<img src="{{ asset('storage/partner/' . $partner->brand_image) }}" alt="{{ $partner->brand_name }}" />
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
	<!-- ====== Testimonials End ====== -->
		
	<!-- ====== Contact Start ====== -->
	<section id="contact" class="ud-contact">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-8 col-lg-7">
					<div class="ud-contact-content-wrapper">
						<div class="ud-contact-title">
							<span>CONTACT US</span>
							<h2>
								{{ __(front_setting('home_contact_text')) }}
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
				<div class="col-xl-4 col-lg-5">
					<div
						class="ud-contact-form-wrapper wow fadeInUp"
						data-wow-delay=".2s"
						>
						<h3 class="ud-contact-form-title">Send us a Message</h3>
						<form class="ud-contact-form">
							<div class="ud-form-group">
								<label for="fullName">Full Name*</label>
								<input
								type="text"
								name="fullName"
								placeholder="Adam Gelius"
								/>
							</div>
							<div class="ud-form-group">
								<label for="email">Email*</label>
								<input
								type="email"
								name="email"
								placeholder="example@yourmail.com"
								/>
							</div>
							<div class="ud-form-group">
								<label for="phone">Phone*</label>
								<input
								type="text"
								name="phone"
								placeholder="+885 1254 5211 552"
								/>
							</div>
							<div class="ud-form-group">
								<label for="message">Message*</label>
								<textarea
									name="message"
									rows="1"
									placeholder="type your message here"
									></textarea>
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
	
@endsection