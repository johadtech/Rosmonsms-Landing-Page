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
	$postCheck = \App\Models\Post::where('status', 1)->get();
@endphp

<!-- ====== Banner Start ====== -->
<section class="ud-page-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-banner-content">
					<h1>{{ __('Blog Page') }}</h1>
				</div>
			</div>
			<div class="container text-center justify-content-center">

				<div class="position-breadcrumb">
					<nav aria-label="breadcrumb" class="d-inline-block bg-white bg-light">
						<ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
							<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Page</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{ __('Blog') }}</li>
						</ul>
					</nav>
				</div>
			</div>
			<!--end container-->
		</div>
	</div>
</section>
<!-- ====== Banner End ====== -->
	
<!-- ====== Blog Start ====== -->
@if($postCheck->isNotEmpty())
<section class="ud-blog-grids">
	<div class="container">
		<div class="row">
			@foreach($posts as $post)
			
				<div class="col-lg-4 col-md-6">
					<div class="ud-single-blog">
						<div class="ud-blog-image">
							<a href="{{ route('showblogpost', $post->slug) }}">
								<img src="{{ asset('storage/post/'.$post->thumbnail) }}" alt="{{ __($post->title) }}">
							</a>
						</div>
						<div class="ud-blog-content">
							<span class="ud-blog-date">{{ __(\Carbon\Carbon::parse($post->created_at)->format('jS \of F, Y')) }}</span>
							<h3 class="ud-blog-title">
								<a href="{{ route('showblogpost', $post->slug) }}">
									{{ __($post->title) }}
								</a>
							</h3>
							<p class="ud-blog-desc">
								{{ __($post->description ?? str_limit(strip_tags($post->content), 100, '...')) }}
							</p>
						</div>
					</div>
				</div>
			
			@endforeach
		</div>
	</div>
</section>
@endif
<!-- ====== Blog End ====== -->


@endsection