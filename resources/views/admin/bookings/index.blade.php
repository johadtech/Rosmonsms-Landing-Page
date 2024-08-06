@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->
				
			{{--@include('admin.partial.breadcrumb')--}}

			<div class="col-12">
				<div class="card table-card">
					<div class="card-header d-none">
						<h5 class="mb-0 text-center d-none">Users</h5>
					</div>
					<div class="card-body pt-3">
						
						<h5 class="mb-2 text-center small">Bookings</h5>
						
						<div class="text-center p-4 pb-sm-2">
							<a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-plus f-18"></i>
								All Bookings
							</a>

							<a href="{{ route('admin.bookings.index', ['status' => 1]) }}" class="btn btn-sm btn-success mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-check f-18"></i>
								Approved Bookings
							</a>

							<a href="{{ route('admin.bookings.index', ['status' => 0]) }}" class="btn btn-sm btn-danger mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-x f-18"></i>
								Pending Bookings
							</a>
						</div>

						<div class="table-responsive">
							<table class="table table-hover" id="pc-dt-simple">
								<thead>
									<tr>
										<th>{{ __('Name') }}</th>
										<th>{{ __('Mobile') }}</th>
										<th>{{ __('Email') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Appointment Day') }}</th>
										<th>{{ __('Appointment Time') }}</th>
										<th>{{ __('IP Address') }}</th>
										<th>{{ __('Date/Time') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($bookings as $booking)
									<tr>
										<td>
											<h6 class="mb-0">{{ __($booking->fullname) }}</h6>
										</td>
										<td>{{ __($booking->mobile) }}</td>
										<td>{{ __($booking->email) }}</td>
										<td>
											<span class="badge {{ $booking->status == 1 ? 'bg-light-success' : 'bg-light-danger' }} rounded-pill f-12"> {{ $booking->status == 1 ? 'Approved' : 'Pending' }} </span>
										</td>
										<td>{{ __(\Carbon\Carbon::parse($booking->appointment_date)->format('jS \of F, Y')) }}</td>
										<td>{{ __(\Carbon\Carbon::parse($booking->appointment_time)->format('g:ia')) }}</td>
										<td>{{ __($booking->ip_address) }}</td>
										<td>
											{{ formatCreatedAt($booking->created_at)['date'] }}
											<span class="text-muted text-sm d-block">
												{{ formatCreatedAt($booking->created_at)['time'] }}
											</span>
										</td>
										<td>
											@if($booking->status == 0)
											<a href="{{ route('admin.bookings.review', $booking->id) }}" class="avtar avtar-xs btn-light-success">
												<i class="ti ti-check f-20 text-success"></i>
											</a>
											{{--<a href="#" class="avtar avtar-xs btn-light-success d-none" onclick="event.preventDefault(); document.getElementById('form-{{ $booking->id }}').submit();">
												<i class="ti ti-check f-20 text-success"></i>
											</a>--}}
											<form action="{{ route('admin.bookings.review', $booking->id) }}" method="POST" style="display:none;" id="form-{{$booking->id}}">
												@csrf
												{{--@method('PUT')--}}
											</form>
											@else
											<a href="{{ route('admin.bookings.edit', $booking->id) }}" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											@endif
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-{{ $booking->id }}').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="{{ route('admin.bookings.delete', $booking->id) }}" method="POST" style="display:none;" id="block-{{$booking->id}}">
												@csrf
												@method('DELETE')
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $bookings->links() }}
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
