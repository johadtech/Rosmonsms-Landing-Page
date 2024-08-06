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
							
							<h5 class="mb-3 text-center small">Edit Category - {{ __($category->name) }}</h5>
							
							<form id="myForm" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="row mb-5">
									
									<div class="col-sm-6">
										<div class="input-group mb-3">
											<label class="form-label">Slug</label>
											<div class="input-group">
												<input type="text" class="form-control form-control-sm" id="pc-clipboard-1" placeholder="Categories slug" readonly value="{{ url('/') }}/{{ $category->slug }}">
												<a href="#" class="btn btn-sm btn-primary" data-clipboard="true" data-clipboard-target="#pc-clipboard-1">
													<i class="feather icon-copy"></i>
												</a>
											</div>
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Name</label>
											<input type="text" class="form-control form-control-sm" placeholder="Category name" id="name" name="name" required value="{{ $category->name }}">
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Description</label>
											<textarea class="form-control form-control-sm mb-2" rows="6" id="description" name="description" required> {{ $category->description }} </textarea>
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

