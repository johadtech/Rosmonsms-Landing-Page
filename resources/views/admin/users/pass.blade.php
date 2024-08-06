@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->

			<div class="col-md-6 col-xl-3">

				<div class="card table-card border-0 shadow-none drp-upgrade-card" style="background-image: url({{asset('admin/assets/images/layout/img-profile-card.jpg')}})">
					<div class="card-body pt--1">
						<div class="container text-primary mb-3">
							<h5 class="mb-3 text-center small d-none">Page Settings</h5>

							<div class="col-md-6">
								<div class="card shadow-none border mb-0 h-100">
									<div class="card-body">
										<h6 class="mb-2">Change Password</h6>
										<form method="POST" action="{{ route('admin.users.updatePass') }}">
											@csrf
											<input type="text" name="user_id" id="user_id" class="form-control" value="{{ auth()->user()->id }}" required style="display:none;">
											<div class="row">
												<div class="col-sm-6">
													<div class="mb-3">
														<label class="form-label">Old Password</label>
														<input type="password" class="form-control" placeholder="Enter Old Password" name="old_password" id="old_password">
													</div>
												</div>
	
												<div class="col-sm-6">
													<div class="mb-3">
														<label class="form-label">New Password</label>
														<input type="password" class="form-control" placeholder="Enter New Password" name="password" id="password">
													</div>
												</div>
	
												<div class="col-sm-6">
													<div class="mb-3">
														<label class="form-label">Current Password</label>
														<input type="password" class="form-control" placeholder="Confirm New Password" name="password_confirmation" id="password_confirmation">
													</div>
												</div>
											</div>
											<button class="btn btn-primary text-center" type="submit">
												Update 
											</button>
										</form>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>

			<!-- [ sample-page ] end -->
		</div>
	</div>
	<!-- [ Main Content ] end -->
</div>
<!-- [ Main Content ] end -->

@endsection