@extends('layouts.admin')

@section('content')

{{--<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/dropzone.min.css')}}">--}}
<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.core.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.snow.css')}}">
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" rel="stylesheet">--}}

<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->
				
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header d-none">
						<h5 class="mb-0 text-center small">Create Post</h5>
					</div>
					<div class="card-body pt--1">

						<div class="container">
							
							<h5 class="mb-3 text-center small">Edit Booking - {{ __($booking->fullname) }}</h5>
							
							<form id="myForm" action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="row mb-3">
									
									<div class="col-sm-6">
										<div class="input-group mb-3">
											<label class="form-label">IP Address</label>
											<div class="input-group">
												<input type="text" class="form-control form-control-sm" name="ip_address" id="pc-clipboard-1" placeholder="IP Address" readonly value="{{ __($booking->ip_address) }}">
												<a href="#" class="btn btn-sm btn-primary" data-clipboard="true" data-clipboard-target="#pc-clipboard-1">
													<i class="feather icon-copy"></i>
												</a>
											</div>
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Fullname</label>
											<input type="text" class="form-control form-control-sm" placeholder="Fullname" id="fullname" name="fullname" required value="{{ $booking->fullname }}" readonly>
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Mobile Number</label>
											<input type="tel" class="form-control form-control-sm" placeholder="Mobile number" id="mobile" name="mobile" required value="{{ $booking->mobile }}">
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Email Address</label>
											<input type="email" class="form-control form-control-sm" placeholder="Email address" id="email" name="email" required value="{{ $booking->email }}">
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Reasons</label>
											<textarea class="form-control form-control-sm mb-2" rows="6" id="description" name="reason" required readonly> {{ $booking->reason }} </textarea>
										</div>
									</div>
									
								</div>
								
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-outline-secondary" id="clearButton">Clear</button>
									
									<button type="submit" class="btn btn-primary text-end">Update</button></div>
								</div>
							
							</form>
							
						</div>

						<div class="table-responsive">
							
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
		alertify.set('notifier','position', 'top-right');
		alertify.success("Copied!");
		//alert('Copied!');
	});
</script>
<script>
    document.getElementById('clearButton').addEventListener('click', function() {
      document.getElementById('myForm').reset();
    });
</script>
@endsection

