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
					<div class="card-header">
						<h5 class="mb-0 text-center">Posts</h5>
					</div>
					<div class="card-body pt-3">

						<div class="text-center p-4 pb-sm-2">
							<a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-plus f-18"></i>
								Create New Post
							</a>

							<a href="{{ route('admin.posts.index', ['status' => 0]) }}" class="btn btn-sm btn-danger mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-writing f-18"></i>
								Draft Posts
							</a>

							<a href="{{ route('admin.posts.index', ['status' => 1]) }}" class="btn btn-sm btn-success mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-writing-sign f-18"></i>
								Published Posts
							</a>
						</div>

						<div class="table-responsive">
							<table class="table table-hover" id="pc-dt-simple">
								<thead>
									<tr>
										<th>{{ __('Title') }}</th>
										<th>{{ __('Author') }}</th>
										<th>{{ __('Category') }}</th>
										<th>{{ __('Status') }}</th>
										<th>{{ __('Views') }}</th>
										<th>{{ __('Date/Time') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($posts as $post)
									<tr>
										<td>
											<h6 class="mb-0">{{ __($post->title) }}</h6>
										</td>
										<td>{{ __($post->author->fullname()) }}</td>
										<td>{{ __($post->category->name) }}</td>
										<td>
											<span class="badge {{ $post->status == 1 ? 'bg-light-success' : 'bg-light-primary' }} rounded-pill f-12"> {{ $post->status == 1 ? 'Active' : 'Draft' }} </span>
										</td>
										<td>{{ __(digits_formatter($post->views)) }}</td>
										<td>
											{{ formatCreatedAt($post->created_at)['date'] }}
											<span class="text-muted text-sm d-block">
												{{ formatCreatedAt($post->created_at)['time'] }}
											</span>
										</td>
										<td>
											<a href="{{ route('showblogpost', $post->slug) }}" class="avtar avtar-xs btn-light-success">
												<i class="ti ti-eye f-20 text-success"></i>
											</a>
											<a href="{{ route('admin.posts.edit', $post->id) }}" class="avtar avtar-xs btn-light-danger">
												<i class="ti ti-edit f-20 text-primary"></i>
											</a>
											<a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('block-{{ $post->id }}').submit();">
												<i class="ti ti-trash f-20 text-danger"></i>
											</a>
											<form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" style="display:none;" id="block-{{$post->id}}">
												@csrf
												@method('DELETE')
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							{{ $posts->links() }}
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
