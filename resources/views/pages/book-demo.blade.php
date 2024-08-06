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

<!-- ====== Banner Start ====== -->
<section class="ud-page-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-banner-content">
					<h1>{{ $page->title }}</h1>
				</div>
			</div>
			<div class="container text-center justify-content-center d-none">

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
	
<section id="about" class="ud-about d-none">
	<div class="container">
		<div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
			<div class="ud-about-content-wrapper">
				<div class="ud-about-content">
					<p>
						{!! $page->content !!}
					</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ====== Contact Start ====== -->
<section id="contact" class="ud-contact">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-xl-4 col-lg-5">
				<div class="ud-contact-form-wrapper wow fadeInUp" data-wow-delay=".2s">
					<h3 class="ud-contact-form-title text-center small">Book a demo !</h3>
					{{--<p class="mb-3 mt-2 ud-about-content">{!! $page->content !!}</p>--}}
					<form class="ud-contact-form" action="{{route('storebooking')}}" method="POST">
						@csrf
						<div class="ud-form-group">
							<label for="fullName">Enter Fullname *</label>
							<input type="text" name="fullname" id="fullname" placeholder="eg John Doe" required value="{{ old('fullname') }}"/>
						</div>
						<div class="ud-form-group">
							<label for="email">Enter Email Address *</label>
							<input type="email" id="email" name="email" placeholder="eg example@gmail.com" value="{{ old('email') }}" required/>
						</div>
						<div class="ud-form-group">
							<label for="phone">Enter Mobile Number *</label>
							<input type="tel"  name="mobile" id="mobile" placeholder="eg +233 7065355315" required value="{{ old('mobile') }}"/>
						</div>
						<div class="ud-form-group">
							<label for="email">Choose Appointment Date *</label>
							<input type="date" name="appointment_date" id="appointment-date" placeholder="choose a date" required value="{{ old('appointment_date') }}"/>
						</div>
						<div class="ud-form-group">
							<label for="phone">Choose Appointment Time *</label>
							<input type="time" name="appointment_time" id="appointment-time" placeholder="choose a time" required value="{{ old('appointment_time') }}"/>
						</div>
						<div class="ud-form-group">
							<label for="message">Enter Message/Reason *</label>
							<textarea name="reason" id="reason" rows="4" placeholder="eg why you needed a demo/meeting" required>{{ old('reason') }}</textarea>
						</div>
						<div class="ud-form-group mb-0">
							<button type="submit" class="ud-main-btn">
								Schedule a Demo
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