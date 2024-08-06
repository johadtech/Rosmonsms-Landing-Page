@extends('layouts.admin')

@section('content')

<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->

			<div class="col-sm-12">
				<div class="card border-0 shadow-none drp-upgrade-card" style="background-image: url({{asset('admin/assets/images/layout/img-profile-card.jpg')}})">
					<div class="card-header d-none">
						<h5 class="mb-0 text-center small"></h5>
					</div>
					<div class="card-body pt--1">
						<h5 class="mb-3 text-center">About System</h5>
						@foreach($applicationInfo as $key => $value)
						<div class="alert alert-success d-block text-center text-uppercase">
							<i class="feather icon-check-circle mx-2"></i>
							{{ $key }}   ---   {{ $value }}
						</div>
						@endforeach
						
						<div class="mt-3 text-center small text-secondary">
							<a class="btn btn-sm btn-light-dark rounded-pill px-2 text-secondary" role="button" target="_blank" href="https://johadtech.com.ng">
								<i class="ti ti-external-link me-1"></i>
								by Johadtech.
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- [ sample-page ] start -->
		</div>
	</div>
	<!-- [ Main Content ] end -->
</div>
<!-- [ Main Content ] end -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css">
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
<script src="{{asset('admin/assets/js/plugins/clipboard.min.js')}}"></script>
<script src="{{asset('admin/assets/js/plugins/dropzone-amd-module.min.js')}}"></script>
<script src="{{asset('admin/assets/js/plugins/quill.min.js')}}"></script>
<script>
	new ClipboardJS('[data-clipboard=true]').on('success', function (e) {
		e.clearSelection();
		alertify.set('notifier', 'position', 'top-right');
		alertify.success("Copied!");
		//alert('Copied!');
	});
</script>
<script>
	document.getElementById('clearButton1').addEventListener('click', function() {
		document.getElementById('myForm1').reset();
	});
	document.getElementById('clearButton2').addEventListener('click', function() {
		document.getElementById('myForm2').reset();
	});
</script>
@endsection