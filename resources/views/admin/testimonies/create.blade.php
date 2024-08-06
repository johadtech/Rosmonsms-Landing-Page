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
							
							<h5 class="mb-3 text-center small">Create Testimony</h5>
							
							<form id="myForm" action="{{ route('admin.testimonies.store') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="row">
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Fullname</label>
											<input type="text" class="form-control form-control-sm" id="full_name" placeholder="Fullname" name="full_name" required>
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Occupation</label>
											<input type="text" class="form-control form-control-sm" id="occupation" placeholder="Occupation" name="occupation" required>
										</div>
									</div>
									
								</div>
								
								<style>.ql-container{font-family:Arial,sans-serif}.ql-toolbar{border:1px solid #ccc;background-color:#f3f4f6;padding:5px}.ql-editor{min-height:150px;overflow: auto;border:1px solid #ccc;padding:10px;background-color:#fff}</style>
								<div class="mb-3">
									<label class="form-label" for="">Content</label>
									<div id="tinymce-editor" style="height: 150px;"></div>
									<textarea id="content" name="content" style="display: none;">
										{!! htmlspecialchars(old('content') ? old('content') : '') !!}
									</textarea>
								</div>
								
								<div class="mb-3" style="display:none;">
									<label class="form-label">Status</label>
									<select class="form-select form-select-sm" name="status" required>
										<option value="1" selected>Publish</option>
										<option value="0">Draft</option>
									</select>
								</div>
								
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-outline-secondary" id="clearButton">Clear</button>
									
									<button type="submit" class="btn btn-primary text-end">Submit</button></div>
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
<!-- Initialize Quill editor -->
  <script type="text/javascript">
    (function () {
      var quill = new Quill('#tinymce-editor', {
        modules: {
          toolbar: [
            [{ header: [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ script: 'sub' }, { script: 'super' }],
            [{ indent: '-1' }, { indent: '+1' }],
            [{ direction: 'rtl' }],
            [{ size: ['small', false, 'large', 'huge'] }],
            [{ color: [] }, { background: [] }],
            [{ font: [] }],
            [{ align: [] }],
            ['clean'],
            ['link', 'image', 'video'],
            ['code-block']
          ]
        },
        placeholder: 'Type your text here...',
        theme: 'snow'
      });
      
      // Set initial content
      //var content = `{!! htmlspecialchars(old('content') ? old('content') : '') !!}`;
      //quill.clipboard.dangerouslyPasteHTML(content);
      
      const parser = new DOMParser();
      const doc = parser.parseFromString(`{!! old('content') ? old('content') : '' !!}`, 'text/html');
      quill.clipboard.dangerouslyPasteHTML(doc.body.innerHTML);
      
      // Sync content to textarea on form submission
      //var form = document.querySelector('form');
      var form = document.getElementById('myForm');
      form.onsubmit = function() {
          //document.querySelector('textarea[name="content"]').value = quill.root.innerHTML;
          document.getElementById('content').value = quill.root.innerHTML;
      };

      // Optionally, you can add custom handling for features like media embedding
      quill.getModule('toolbar').addHandler('image', () => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = () => {
          const file = input.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
              const base64Image = e.target.result;
              const range = quill.getSelection();
              quill.insertEmbed(range.index, 'image', base64Image);
            };
            reader.readAsDataURL(file);
          }
        };
      });
    })();
  </script>
@endsection


