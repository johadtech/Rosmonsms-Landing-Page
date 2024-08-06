<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
        <meta name="Version" content="v1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="theme-color" content="#0a0a33">
	    <title></title>
	
		<!-- Css -->
        {{--<link rel="stylesheet" href="assets/css/styles.css">--}}
        {{--<link rel="stylesheet" href="assets/css/main.css">--}}
        <link rel="stylesheet" href="assets/css/confuse.css?v={{ time() }}">
        {{--<link rel="stylesheet" href="assets/css/responsive.css">--}}
	    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Montserrat:wght@700&family=Lato:wght@700&family=Oswald:wght@700&family=Raleway:wght@700&family=Poppins:wght@700&family=Playfair+Display:wght@700&family=Bebas+Neue&family=Anton&family=Nunito:wght@700&display=swap">
        
        {{-- Header Script --}}
        {!! getHeaderScript() !!}
        @yield('seo')
        
        <style>
        </style>
	    
	</head>
	<body style="font-family: 'Poppins', sans-serif;font-size:0.8em;">
		
		@include('pages.partial.navbar')
		@include('partials.alert')
		
		@yield('content')
	
	    <!-- Footer Start -->
        {{--<footer class="footer" style="background-image: url('assets/images/svg-map.svg'); background-repeat: no-repeat; background-position: center; display:none;">--}}
        <footer class="footer-section" style="background-image: url('---assets/images/svg-map.svg'); background-repeat: no-repeat; background-position: center;">
		    <div class="footer-content">
		        <div class="footer-left">
		            <div class="footer-logo">
		                <h2></h2>
		                <a href="{{ url('/') }}" class="logo-footer">
							<img src="{{ asset('storage/general/'.gs()->logo) }}" alt="" width="200px" height="80px">
		                </a>
		            </div>
		            <p>{{ front_setting('footer_description') }}</p>
		        </div>
		        <div class="footer-middle">
		            <h3>{{ __('Quick link') }}</h3>
		            <ul>
		                <li><a href="#">{{ __('Home') }}</a></li>
		                <li><a href="#">{{ __('Pricing') }}</a></li>
		                <li><a href="#">{{ __('Get Started') }}</a></li>
		                <li><a href="#">{{ __('Help') }}</a></li>
		            </ul>
		        </div>
		        <div class="footer-right">
		            <h3>{{ __('Company info') }}</h3>
		            <ul>
		                <li><a href="#">{{ __('Terms of Service') }}</a></li>
		                <li><a href="#">{{ __('Privacy Policy') }}</a></li>
		            </ul>
		        </div>
		    </div>
		    <div class="footer-bottom">
		        <p>© <script>document.write(new Date().getFullYear())</script> {{ gs()->site_name }}.</p>
		        <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4" style="display:none;">
	                <li class="list-inline-item mb-0"><a href="{{ gs()->social_facebook }}" target="_blank" class="rounded"><i class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
	                <li class="list-inline-item mb-0"><a href="{{ gs()->social_instagram }}" target="_blank" class="rounded"><i class="uil uil-instagram align-middle" title="instagram"></i></a></li>
	                <li class="list-inline-item mb-0"><a href="{{ gs()->social_twitter }}" target="_blank" class="rounded"><i class="uil uil-twitter align-middle" title="twitter"></i></a></li>
	                <li class="list-inline-item mb-0"><a href="mailto:{{ gs()->site_email }}" class="rounded"><i class="uil uil-envelope align-middle" title="email"></i></a></li>
	            </ul>
		    </div>
		</footer>
            
        <script src="assets/js/script.js"></script>
        
        
        {{-- Footer Script --}}
        {!! getFooterScript() !!}
        
    </body>
</html>