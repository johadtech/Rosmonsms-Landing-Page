<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Version" content="v1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	{{--<meta name="theme-color" content="#0a0a33">--}}
    <title></title>

	<!-- [Font] Family -->
	<link rel="stylesheet" href="{{asset('admin/assets/fonts/inter/inter.css')}}" id="main-font-link">
	<!-- [phosphor Icons] https://phosphoricons.com/ -->
	<link rel="stylesheet" href="{{asset('admin/assets/fonts/phosphor/duotone/style.css')}}">
	<!-- [Tabler Icons] https://tablericons.com -->
	<link rel="stylesheet" href="{{asset('admin/assets/fonts/tabler-icons.min.css')}}">
	<!-- [Feather Icons] https://feathericons.com -->
	<link rel="stylesheet" href="{{asset('admin/assets/fonts/feather.css')}}">
	<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
	<link rel="stylesheet" href="{{asset('admin/assets/fonts/fontawesome.css')}}">
	<!-- [Material Icons] https://fonts.google.com/icons -->
	<link rel="stylesheet" href="{{asset('admin/assets/fonts/material.css')}}">
	<!-- [Template CSS Files] -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}" id="main-style-link">
	<link rel="stylesheet" href="{{asset('admin/assets/css/style-preset.css')}}">
</head>
<!-- [Head] end -->
	
<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
	<!-- [ Pre-loader ] start -->
	<div class="page-loader">
		<div class="bar"></div>
	</div>
	<!-- [ Pre-loader ] End -->
		
		@include('admin.partial.navbar')
		@include('admin.partial.header')
		@include('partials.alert')
		
		@yield('content')
	
    <!-- Footer Start -->
	<footer class="pc-footer">
		<div class="footer-wrapper container-fluid">
			<div class="row">
				<div class="col my-1">
					<p class="m-0 text-center">
						© <script>document.write(new Date().getFullYear())</script> {{ gs()->site_name }}. <a href="https://johadtech.com.ng" target="_blank" class="d-none">by Johadtech</a>
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer End -->
		
	<!-- Required Js -->
	<script data-cfasync="false" src=""></script>
	<script src="{{asset('admin/assets/js/plugins/popper.min.js')}}"></script>
	<script src="{{asset('admin/assets/js/plugins/simplebar.min.js')}}"></script>
	<script src="{{asset('admin/assets/js/plugins/bootstrap.min.js')}}"></script>
	<script src="{{asset('admin/assets/js/fonts/custom-font.js')}}"></script>
	<script src="{{asset('admin/assets/js/pcoded.js')}}"></script>
	<script src="{{asset('admin/assets/js/plugins/feather.min.js')}}"></script>
	<!-- chart js -->
	<script src="{{asset('admin/assets/js/plugins/apexcharts.min.js')}}"></script>
	<script src="{{asset('admin/assets/js/pages/membership-dashboard.js')}}"></script>
	
	<script>layout_change('light');</script>
    <script>change_box_container('false');</script>
    <script>layout_caption_change('true');</script>
    <script>layout_rtl_change('false');</script>
    <script>preset_change('preset-1');</script>
    <script>main_layout_change('vertical');</script>

</body>
<!-- [Body] end -->

</html>