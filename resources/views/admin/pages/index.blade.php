@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->

			<div class="col-sm-12">

				<div class="card border-0 shadow-none drp-upgrade-card" style="background-image: url({{asset('admin/assets/images/layout/img-profile-card.jpg')}})">
					<div class="card-body pt--1">
						<div class="container text-primary mb-3">
							<h5 class="mb-3 text-center">Page Settings</h5>
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
										<tr>
											<th>Page Title</th>
											<th>URL</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Home Page</td>
											<td>/home</td>
											<td>
												<a href="#" class="avtar avtar-xs btn-link-secondary" onclick="event.preventDefault(); document.getElementById('home').submit();">
													<i class="ti ti-edit f-20"></i>
												</a>
												<form action="{{ route('admin.pages.edit') }}" method="POST" id="home">
													@csrf
													<input type="text" name="page" value="home" style="display:none;">
												</form>
											</td>
										</tr>
										<tr>
											<td>About Page</td>
											<td>/about</td>
											<td>
												<a href="#" class="avtar avtar-xs btn-link-secondary" onclick="event.preventDefault(); document.getElementById('about-us').submit();">
													<i class="ti ti-edit f-20"></i>
												</a>
												<form action="{{ route('admin.pages.edit') }}" method="POST" id="about-us">
													@csrf
													<input type="text" name="page" value="about-us" style="display:none;">
												</form>
											</td>
										</tr>
										<tr>
											<td>Privacy & Policy Page</td>
											<td>/privacy-and-policy</td>
											<td>
												<a href="#" class="avtar avtar-xs btn-link-secondary" onclick="event.preventDefault(); document.getElementById('privacy-policy').submit();">
													<i class="ti ti-edit f-20"></i>
												</a>
												<form action="{{ route('admin.pages.edit') }}" method="POST" id="privacy-policy">
													@csrf
													<input type="text" name="page" value="privacy-policy" style="display:none;">
												</form>
											</td>
										</tr>
										<tr>
											<td>Termy & Conditions Page</td>
											<td>/terms-and-conditions</td>
											<td>
												<a href="#" class="avtar avtar-xs btn-link-secondary" onclick="event.preventDefault(); document.getElementById('terms-and-conditions').submit();">
													<i class="ti ti-edit f-20"></i>
												</a>
												<form action="{{ route('admin.pages.edit') }}" method="POST" id="terms-and-conditions">
													@csrf
													<input type="text" name="page" value="terms-and-conditions" style="display:none;">
												</form>
											</td>
										</tr>
										<tr>
											<td>Contact Page</td>
											<td>/contact-us</td>
											<td>
												<a href="#" class="avtar avtar-xs btn-link-secondary" onclick="event.preventDefault(); document.getElementById('contact-us').submit();">
													<i class="ti ti-edit f-20"></i>
												</a>
												<form action="{{ route('admin.pages.edit') }}" method="POST" id="contact-us">
													@csrf
													<input type="text" name="page" value="contact-us" style="display:none;">
												</form>
											</td>
										</tr>
										<tr>
											<td>Book a Demo Page</td>
											<td>/book-a-demo</td>
											<td>
												<a href="#" class="avtar avtar-xs btn-link-secondary" onclick="event.preventDefault(); document.getElementById('book-a-demo').submit();">
													<i class="ti ti-edit f-20"></i>
												</a>
												<form action="{{ route('admin.pages.edit') }}" method="POST" id="book-a-demo">
													@csrf
													<input type="text" name="page" value="book-a-demo" style="display:none;">
												</form>
											</td>
										</tr>
									</tbody>
								</table>
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