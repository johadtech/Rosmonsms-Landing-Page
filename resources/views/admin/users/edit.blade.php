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
							
							<h5 class="mb-3 text-center small">Edit User - {{ __($user->fullname()) }}</h5>
							
							<form id="myForm" action="{{ route('admin.users.update', $user->id) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="row mb-5">
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">First Name</label>
											<input type="text" class="form-control form-control-sm" placeholder="First name" id="first_name" name="first_name" required value="{{ $user->first_name }}">
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Last Name</label>
											<input type="text" class="form-control form-control-sm" placeholder="Last name" id="last_name" name="last_name" required value="{{ $user->last_name }}">
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Mobile Number</label>
											<input type="tel" class="form-control form-control-sm" placeholder="Mobile number" id="mobile" name="mobile" required value="{{ $user->mobile }}" readonly>
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="input-group mb-3">
											<label class="form-label">Email Address</label>
											<div class="input-group">
												<input type="email" class="form-control form-control-sm" id="pc-clipboard-1" placeholder="Email address" readonly value="{{ $user->email }}">
												<a href="#" class="btn btn-sm btn-primary" data-clipboard="true" data-clipboard-target="#pc-clipboard-1">
													<i class="feather icon-copy"></i>
												</a>
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="mb-3">
									<div class="input-group">
										<button class="btn btn-sm btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('login-form').submit();">Login as User</button>
										<form action="{{ route('admin.users.login', $user->id) }}" method="POST" style="display:none;" id="login-form">
											@csrf
										</form>
										
										@if($user->is_admin = 0)
										<button class="btn btn-sm btn-secondary" type="button">Make User as Admin</button>
										@else
										<button class="btn btn-sm btn-secondary" type="button">Remove User as Admin</button>
										@endif
										
										@if($user->status == 0)
										<button class="btn btn-sm btn-danger" type="button">Block User</button>
										@else
										<button class="btn btn-sm btn-danger" type="button">UnBlock User</button>
										@endif
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

