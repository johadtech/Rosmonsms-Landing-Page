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
			<div class="container text-center justify-content-center d--none">

				<div class="position-breadcrumb">
					<nav aria-label="breadcrumb" class="d-inline-block bg-white bg-light">
						<ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
							@if($post && $post->category)
							<li class="breadcrumb-item"><a href="Javascript:void(0)">Category: {{ $post->category->name }}</a></li>
							@endif
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
<section class="ud-blog-details">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="ud-blog-details-image">
					<img src="{{ asset('storage/post/'.$post->thumbnail) }}" alt="{{ __($post->title) }}">
					<div class="ud-blog-overlay">
						<div class="ud-blog-overlay-content">
							@if($post && $post->author)
							<div class="ud-blog-author">
								<img src="{{ generate_avater($post->full_name) }}" alt="author" />
								<span>
									By <a href="javascript:void(0)"> {{ __($post->author->fullname()) }} </a>
								</span>
							</div>
							@endif
							<div class="ud-blog-meta">
								<p class="date">
									<i class="lni lni-calendar"></i>
									<span class="small">
										{{ __(\Carbon\Carbon::parse($post->created_at)->format('jS \of F, Y')) }}
									</span>
								</p>
								<p class="comment">
									<i class="lni lni-comments"></i>
									<span>
										{{ digits_formatter(count($post->comments)) }}
									</span>
								</p>
								<p class="view">
									<i class="lni lni-eye"></i>
									<span>
										{{ __(digits_formatter($post->views)) }}
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			
			</div>
			<div class="col-lg-8">
				<div class="ud-blog-details-content">
					<h2 class="ud-blog-details-title">
						{{ __(ucfirst($post->title)) }}
					</h2>
					{{--<p class="ud-blog-details-para d-none">
						<div class="ud-blog-quote">
							{!! toc($post->content) !!}
						</div>
					</p>--}}
					<p class="ud-blog-details-para" id="blog-content">
						{!!  $post->content ? $post->content : '' !!}
					</p>
					<div class="ud-blog-details-action">
						<ul class="ud-blog-tags">
							@foreach($post->tags() as $tag)
							<li>
								<a href="javascript:void(0)">{{ __($tag) }}</a>
							</li>
							@endforeach
						</ul>
						<div class="ud-blog-share">
							<h6>Share This Post</h6>
							<ul class="ud-blog-share-links">
								<li>
									<a href="https://www.facebook.com/sharer.php?u={{url('/')}}/{{$post->slug}}" target="_blank" class="facebook">
										<i class="lni lni-facebook-filled"></i>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/intent/tweet?url={{url('/')}}/{{$post->slug}}&text={{$post->title}}" target="_blank" class="twitter">
										<i class="lni lni-twitter-filled"></i>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="linkedin">
										<i class="lni lni-linkedin-original"></i>
									</a>
								</li>
								<li>
									<a href="https://plus.google.com/share?url={{url('/')}}/{{$post->slug}}&text={{$post->title}}&hl=english" target="_blank" class="google">
										<i class="lni lni-google-plus-filled"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="ud-blog-sidebar">
					<div class="ud-newsletter-box">
						<img src="/template/assets/images/blog/dotted-shape.svg" alt="shape" class="shape shape-1">
						<img src="/template/assets/images/blog/dotted-shape.svg" alt="shape" class="shape shape-2">
						<h3 class="ud-newsletter-title">Wants to see how powerful our tool is?</h3>
						<p>Book a session below.</p>
						<form class="ud-newsletter-form">
							<button onclick="goToPage()" class="ud-main-btn">Book a Demo Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ====== Blog End ====== -->

<script>
	function goToPage() {
		window.location.href = "{{ route('bookdemo') }}";
	}
	
document.addEventListener("DOMContentLoaded", function() {
    // Select the paragraph containing the blog content
    var contentElement = document.getElementById('blog-content');
    
    if (contentElement) {
        // Get the content as text
        var content = contentElement.innerHTML;

        // Regular expression to match quotes (this assumes quotes are enclosed in double quotes)
        var quoteRegex = /"(.*?)"/g;

        // Replace the quotes with the desired HTML structure
        var newContent = content.replace(quoteRegex, function(match, quote) {
            return '<div class="ud-blog-quote"><i class="lni lni-quotation"></i><p>' + quote + '</p></div>';
        });

        // Set the new content back to the paragraph
        contentElement.innerHTML = newContent;
    }
});
</script>
@endsection