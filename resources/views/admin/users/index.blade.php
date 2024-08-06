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
						
						<h5 class="mb-2 text-center small">Users</h5>
						
						<div class="text-center p-4 pb-sm-2">
							<a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-plus f-18"></i>
								All Users
							</a>

							<a href="{{ route('admin.users.index', ['status' => 1]) }}" class="btn btn-sm btn-danger mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-user-off f-18"></i>
								Banned Users
							</a>

							<a href="{{ route('admin.users.index', ['status' => 0]) }}" class="btn btn-sm btn-success mb-2 d-inline-flex align-items-center gap-2 small">
								<i class="ti ti-users f-18"></i>
								Active Users
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
										<th>{{ __('Date/Time') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div class="flex-shrink-0">
													<img src="../assets/images/user/avatar-1.jpg" alt="user image" class="img-radius wid-40">
												</div>
												<div class="flex-grow-1 ms-3">
													<h6 class="mb-0">{{ __($user->fullname()) }}</h6>
												</div>
											</div>
										</td>
										<td>{{ __($user->mobile) }}</td>
										<td>{{ __($user->email) }}</td>
										<td>
											<span class="badge {{ $user->status == 1 ? 'bg-light-danger' : 'bg-light-success' }} rounded-pill f-12"> {{ $user->status == 1 ? 'Banned' : 'Active' }} </span>
										</td>
										<td>
											{{ formatCreatedAt($user->created_at)['date'] }}
											<span class="text-muted text-sm d-block">
												{{ formatCreatedAt($user->created_at)['time'] }}
											</span>
										</td>
										<td>
											<a href="#" class="avtar avtar-xs btn-light-success" onclick="event.preventDefault(); document.getElementById('form-{{ $user->id }}').submit();">
												<i class="ti ti-eye f-20 text-success"></i>
											</a>
											<form action="{{ route('admin.users.login', $user->id) }}" method="POST" style="display:none;" id="form-{{$user->id}}">
												@csrf
											</form>
											<a href="{{ route('admin.users.edit', $user->id) }}" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-{{ $user->id }}').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="{{ route('admin.users.login', $user->id) }}" method="POST" style="display:none;" id="block-{{$user->id}}">
												@csrf
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $users->links() }}
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
