<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="Version" content="v1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="theme-color" content="#0E159A">
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

	<!-- start favicon -->
	<link type="image/x-icon" rel="shortcut icon" href="{{ asset('storage/general/'.gs()->favicon) }}" />
	<!-- end favicon -->
	{!! SEOMeta::generate() !!}
	{!! OpenGraph::generate() !!}
	{!! Twitter::generate() !!}
	{!! JsonLd::generate() !!}
	{!! SEO::generate() !!}

</head>
<!-- [Head] end -->

<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
	<!-- [ Pre-loader ] start -->
	<div class="page-loader">
		<div class="bar"></div>
	</div>
	<!-- [ Pre-loader ] End -->

	<div class="maintenance-block">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="card error-card">
						<div class="card-body">
							<div class="error-image-block">
								<div class="row justify-content-center">
									<div class="col-10">
										<img class="img-fluid" src="{{asset('storage/general/img-cunstruct-2.svg')}}" alt="img">
									</div>
								</div>
							</div>
							<div class="text-center">
								<h1 class="mt-4"><b>Page Expired</b></h1>
								<p class="mt-2 mb-4 text-sm text-muted">
									Sorry, your session has expired. Please refresh and try again.
								</p>
								<a href="{{ url('/') }}" class="btn btn-primary mb-3">
									Go to homepage
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ Main Content ] end --><!-- Required Js -->

	<!-- Footer Start -->
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

	<script>
		layout_change('light');
	</script>
	<script>
		change_box_container('false');
	</script>
	<script>
		layout_caption_change('true');
	</script>
	<script>
		layout_rtl_change('false');
	</script>
	<script>
		preset_change('preset-1');
	</script>
	<script>
		main_layout_change('vertical');
	</script>

</body>
<!-- [Body] end -->

</html>