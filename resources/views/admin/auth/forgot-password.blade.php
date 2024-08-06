 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- [Head] start -->

<head>
	<title></title>
	<!-- [Meta] -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- [Favicon] icon -->
	<link rel="icon" href="{{asset('admin/assets/images/favicon.svg')}}" type="image/x-icon">
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
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light" oncontextmenu="return false;">
	<!-- [ Pre-loader ] start -->
	<div class="page-loader">
		<div class="bar"></div>
	</div>
	<!-- [ Pre-loader ] End -->
	<div class="auth-main">
		<div class="auth-wrapper v1">
			<div class="auth-form">
				<div class="card my-5">
					<div class="card-body">
						<div class="text-center">
							<a href="{{url('/')}}">
								<img src="{{ asset('storage/general/'.gs()->logo) }}" alt="logo" width="200px">
							</a>
							
							<form action="{{ route('admin.forgot-password.post') }}" method="POST" id="reset-form" class="mt-5">
								@include('partials.alert')
								@csrf
								<h4 class="text-center f-w-500 mb-3">Forgot Password?</h4>
								<div class="mb-3">
									<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
								</div>
								
								<div class="d-grid mt-4">
									<button type="submit" class="btn btn-primary">Send Password Reset Link</button>
								</div>
								<div class="d-flex justify-content-between align-items-end mt-4">
									<h6 class="f-w-500 mb-0">Already have an Account?</h6>
									<a href="{{route('adminloginform')}}" class="link-primary">Login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- [ Main Content ] end --><!-- Required Js -->
		<script src="{{asset('admin/assets/js/plugins/popper.min.js')}}"></script>
		<script src="{{asset('admin/assets/js/plugins/simplebar.min.js')}}"></script>
		<script src="{{asset('admin/assets/js/plugins/bootstrap.min.js')}}"></script>
		<script src="{{asset('admin/assets/js/fonts/custom-font.js')}}"></script>
		<script src="{{asset('admin/assets/js/pcoded.js')}}"></script>
		<script src="{{asset('admin/assets/js/plugins/feather.min.js')}}"></script>
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