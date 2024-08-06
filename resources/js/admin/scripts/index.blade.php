@extends('layouts.admin')

@section('content')

{{--<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/dropzone.min.css')}}">--}}
<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.core.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.snow.css')}}">
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" rel="stylesheet">--}}
<style>textarea{width:100%;height:250px;padding:15px;background-color:#282c34;color:#abb2bf;border:1px solid #3a3f44;border-radius:4px;font-family:'Courier New',Courier,monospace;font-size:14px;line-height:1.5;resize:none;outline:0;box-shadow:inset 0 0 10px rgba(0,0,0,.5)}.code-editor textarea::selection{background:#3a3f44;color:#fff}</style>

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

						<div class="container mb-5">

							<h5 class="mb-3 text-center small"></h5>

							<form id="myForm1" action="{{ route('admin.scripts.header.update', 1) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="row mb-3">

									<div class="col-sm-6">
										<div class="mb-3 code-editor">
											<label class="form-label">Custom Header Script</label>
											<textarea class="form-control form-control-sm mb-2 small language-markup" rows="8" id="script" name="script" required> {{ $headscript->script }} </textarea>
										</div>
									</div>

								</div>

								<button type="button" class="btn btn-outline-secondary btn-sm w-100 mb-2" id="clearButton1">Clear</button>
								<button type="submit" class="btn btn-primary btn-sm w-100">Submit</button>

							</form>

						</div>

						<div class="container mt-3">

							<h5 class="mb-3 text-center small"></h5>

							<form id="myForm2" action="{{ route('admin.scripts.footer.update', 1) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="row mb-3">

									<div class="col-sm-6">
										<div class="mb-3 code-editor">
											<label class="form-label">Custom Footer Script</label>
											<textarea class="form-control form-control-sm mb-2 small language-markup" rows="8" id="script" name="script" required> {{ $headscript->script }} </textarea>
										</div>
									</div>

								</div>

								<button type="button" class="btn btn-outline-secondary btn-sm w-100 mb-2" id="clearButton2">Clear</button>
								<button type="submit" class="btn btn-primary btn-sm w-100">Submit</button>

							</form>

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
		alertify.set('notifier', 'position', 'top-right');
		alertify.success("Copied!");
		//alert('Copied!');
	});
</script>
<script>
	document.getElementById('clearButton1').addEventListener('click', function() {
		document.getElementById('myForm1').reset();
	});
	document.getElementById('clearButton2').addEventListener('click', function() {
		document.getElementById('myForm2').reset();
	});
</script>
@endsection