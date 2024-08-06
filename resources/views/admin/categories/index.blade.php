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
						<h5 class="mb-0 text-center">Posts</h5>
					</div>
					<div class="card-body pt-3">

						<div class="text-center p-4 pb-sm-2">
							<h5 class="mb-3 text-center small"> Category </h5>
						</div>

						<div class="table-responsive">
							<table class="table table-hover" id="pc-dt-simple">
								<thead>
									<tr>
										<th>{{ __('Name') }}</th>
										<th>{{ __('Description') }}</th>
										<th>{{ __('Date/Time') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($categories as $category)
									<tr>
										<td>
											<h6 class="mb-0">{{ $category->name }}</h6>
										</td>
										<td>{{ $category->description }}</td>
										<td>
											{{ formatCreatedAt($category->created_at)['date'] }}
											<span class="text-muted text-sm d-block">
												{{ formatCreatedAt($category->created_at)['time'] }}
											</span>
										</td>
										<td>
											<a href="{{ route('admin.categories.edit', $category->id) }}" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-{{ $category->id }}').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="display:none;" id="block-{{$category->id}}">
												@csrf
												@method('DELETE')
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $categories->links() }}
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
