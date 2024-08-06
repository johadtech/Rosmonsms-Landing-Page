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
<!-- Hero Start -->
	
@php
	$team = \App\Models\TeamMember::where('status', 1)->get();
@endphp

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

<!-- ====== About Start ====== -->
<section id="about" class="ud-about">
	<div class="container">
		<div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
			<div class="ud-about-content-wrapper">
				<div class="ud-about-content">
					<span class="tag">{{ $page->title }}</span>
					<h2><span class="text-dark">Last Revised :</span> {{ $page->formatted_created_at }}</h2>
					<p>
						{!! $page->content !!}
					</p>
					<a href="javascript:window.print()" class="ud-main-btn d--none">Print a Copy</a>
				</div>
			</div>
			<div class="ud-about-image">
				<img src="{{ asset('storage/general/' . front_setting('about_us_image')) }}" alt="about-image" />
			</div>
		</div>
	</div>
</section>
<!-- ====== About End ====== -->
	
<!-- ====== Team Start ====== -->
@if($team->isNotEmpty())
<section id="team" class="ud-team">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-section-title mx-auto text-center">
					<span>Our Team</span>
					<h2>Meet The Team</h2>
					<p>
						{{ __(front_setting('about_us_team_text', 'Here is our teams')) }}
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			@foreach(App\Models\TeamMember::active()->get() as $item)
			<div class="col-xl-3 col-lg-3 col-sm-6">
				<div class="ud-single-team wow fadeInUp" data-wow-delay=".1s">
					<div class="ud-team-image-wrapper">
						<div class="ud-team-image">
							<img src="{{ asset('storage/team/'.$item->team_image) }}" alt="team" />
						</div>
						<img src="/template/assets/images/team/dotted-shape.svg" alt="shape" class="shape shape-1">
						<img src="/template/assets/images/team/shape-2.svg" alt="shape" class="shape shape-2">
					</div>
					<div class="ud-team-info">
						<h5>{{ __($item->team_fullname) }}</h5>
						<h6>{{ __($item->team_position) }}</h6>
					</div>
					<ul class="ud-team-socials">
						<li>
							<a href="{{ $item->team_fb_url }}">
								<i class="lni lni-facebook-filled"></i>
							</a>
						</li>
						<li>
							<a href="{{ $item->team_tw_url }}">
								<i class="lni lni-twitter-filled"></i>
							</a>
						</li>
						<li>
							<a href="{{ $item->team_ig_url }}">
								<i class="lni lni-instagram-filled"></i>
							</a>
						</li>
						<li>
							<a href="{{ $item->team_lk_url }}">
								<i class="lni lni-linkedin-original"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endif
<!-- ====== Team End ====== -->

@endsection