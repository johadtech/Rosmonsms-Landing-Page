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
						
						<h5 class="mb-2 text-center small">Testimony</h5>

						<div class="table-responsive">
							<table class="table table-hover" id="pc-dt-simple">
								<thead>
									<tr>
										<th>{{ __('Name') }}</th>
										<th>{{ __('Occupation') }}</th>
										<th>{{ __('Testimony') }}</th>
										<th>{{ __('Date/Time') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($testimonies as $testimony)
									<tr>
										<td>
											<h6 class="mb-0">{{ __($testimony->full_name) }}</h6>
										</td>
										<td>{{ __($testimony->occupation) }}</td>
										<td>{!! __($testimony->content) !!}</td>
										<td>
											{{ formatCreatedAt($testimony->created_at)['date'] }}
											<span class="text-muted text-sm d-block">
												{{ formatCreatedAt($testimony->created_at)['time'] }}
											</span>
										</td>
										<td>
											
											<a href="{{ route('admin.testimonies.edit', $testimony->id) }}" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-{{ $testimony->id }}').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="{{ route('admin.testimonies.delete', $testimony->id) }}" method="POST" style="display:none;" id="block-{{$testimony->id}}">
												@csrf
												@method('DELETE')
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $testimonies->links() }}
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
