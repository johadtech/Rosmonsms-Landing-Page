@extends('layouts.admin')

@section('content')
	<!-- [ Main Content ] start -->
	<div class="pc-container">
		<div class="pc-content">
			<div class="row">
				<!-- [ sample-page ] start -->

				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-dark">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($adminCount)) }} </h3><span class="m-t-10">{{ __('Total Admin User') }}</span> <i class="fa fa-user-secret"></i>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-danger">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($nonAdminCount)) }} </h3><span class="m-t-10">{{ __('Total User') }}</span> <i class="fa fa-users"></i>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-primary">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($postCount)) }} </h3><span class="m-t-10">{{ __('Total Blog Post') }}</span> <i class="fa fa-blog"></i>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-info">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($totalBookings)) }} </h3><span class="m-t-10">{{ __('Total Booking') }}</span> <i class="fa fa-swatchbook"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-7 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-start justify-content-between">
								<h5 class="mb-0 text-center">{{ __('Revenue analytics') }}</h5>
								<select class="form-select rounded-3 form-select-sm w-auto d-none">
									<option>Today</option>
									<option>Weekly</option>
									<option selected="selected">Monthly</option>
								</select>
							</div>
							<div id="revenue-analytics-chart"></div>
						</div>
					</div>
				</div>

				<div class="col-xl-8 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-center text-center mb-3">
								<h5 class="mb-0">{{ __('Recent Login Activities') }}</h5>
							</div>
							<div class="table-responsive">
								<table class="table table-hover" id="pc-dt-simple">
									<thead>
										<tr>
											<th>Fullname</th>
											<th>IP Address</th>
											<th class="text--end">Country Code</th>
											<th>Country</th>
											<th>City</th>
											<th>Latitude</th>
											<th>Browser</th>
											<th>Longitude</th>
											<th>Operating System</th>
										</tr>
									</thead>
									<tbody>
										@if (!$recentLogs->isEmpty())
										@foreach($recentLogs as $item)
										<tr>
											<td>
												<h6 class="mb-2">{{ $item->user->fullname() }}</h6>
											</td>
											<td>{{ $item->user_ip }}</td>
											<td class="text--end f-w-600">{{ $item->country_code }}</td>
											<td class="f-w-600">{{ $item->country }}</td>
											<td class="f-w-600">{{ $item->city }}</td>
											<td>{{ $item->latitude }}</td>
											<td class="text--end f-w-600">{{ $item->browser }}</td>
											<td class="f-w-600">{{ $item->longitude }}</td>
											<td class="f-w-600">{{ $item->os }}</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>


				<div class="col-xl-8 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-center text-center mb-3">
								<h5 class="mb-0">{{ __('Latest Pending Bookings') }}</h5>
							</div>
							<div class="table-responsive">
								<table class="table table-hover" id="pc-dt-simple">
									<thead>
										<tr>
											<th>Fullname</th>
											<th>IP Address</th>
											<th>Email Address</th>
											<th>Mobile Number</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if (!$bookings->isEmpty())
										@foreach($bookings as $item)
										<tr>
											<td>
												<h6 class="mb-2">{{ $item->fullname }}</h6>
											</td>
											<td>{{ $item->ip_address }}</td>
											<td class="text--end f-w-600">{{ $item->email }}</td>
											<td class="f-w-600">{{ $item->mobile }}</td>
											<td class="f-w-600"><i class="fas fa-circle f-10 {{ $item->status == 1 ? 'text-success' : 'text-info' }} m-r-10"></i> {{ $item->status == 1 ? 'Active' : 'Pending' }}</td>
											<td>
												<button onclick="#" class="avtar avtar-xs btn-link-secondary">
													<i class="ti ti-eye f-20"></i>
												</button>
												<button onclick="" class="avtar avtar-xs btn-link-secondary">
													<i class="ti ti-trash f-20"></i>
												</button>
											</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
		<!-- [ Main Content ] end -->
	</div>
	<!-- [ Main Content ] end -->
@endsection
