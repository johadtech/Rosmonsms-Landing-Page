@extends('layouts.admin')

@section('content')
@php
$pageContent = \App\Models\ContentPage::where('slug', $page)->first();
@endphp

<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.core.css')}}">
<link rel="stylesheet" href="{{asset('admin/assets/css/plugins/quill.snow.css')}}">

<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->

			<div class="col-sm-12">

				<div class="card border-0 shadow-none drp-upgrade-card" style="background-image: url({{asset('admin/assets/images/layout/img-profile-card.jpg')}})">
					<div class="card-body pt--1">
						<div class="container text-primary mb-3">
							<h5 class="mb-4 text-center">Edit {{ ucfirst($page) }} Page Details</h5>

							<form id="{{ $page }}" action="{{ route('admin.pages.update') }}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<input type="hidden" name="page" value="{{ $page }}">
								<div class="row">
									@foreach($settings as $key => $value)
									<div class="col-sm-6">
										@if(str_contains($key, 'image'))
										<div class="col-sm-auto mb-3 mb-sm-0">
											<div class="d-sm-inline-block d-flex align-items-center">
												@if(str_contains($key, 'hero'))
												<img class="wid-80 img--radius mb-2" src="{{ asset('storage/hero/'.$value)}}" alt="{{ $key }}">
												@else
												<img class="wid-80 img--radius mb-2" src="{{ asset('storage/general/'.$value)}}" alt="{{ $key }}">
												@endif
											</div>
										</div>
										@endif
										@if(str_contains($key, 'video'))
										<div class="col-sm-auto mb-3 mb-sm-0">
											<div class="d-sm-inline-block d-flex align-items-center">
												<video controls class="mb-1 mt-2" style="width:80%;">
													<source src="{{ asset('storage/general/'.$value)}}" type="video/mp4">
												</video>
											</div>
										</div>
										@endif
										<div class="mb-3">
											<label class="form-label" for="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
											@if(str_contains($key, 'image'))
											<input type="file" class="form-control form-control-sm mb-2" name="{{ $key }}" id="{{ $key }}" accept="image/png, image/jpeg, image/jpg">
											@elseif(str_contains($key, 'video'))
											<input type="file" class="form-control form-control-sm mb-2" name="{{ $key }}" id="{{ $key }}" accept="video/mp4, video/x-m4v, video/*">
											@elseif(str_contains($key, 'description'))
											<textarea class="form-control form-control-sm mb-2" name="{{ $key }}" id="{{ $key }}" rows="5" placeholder="{{ ucfirst(str_replace('_', ' ', $key)) }}">{{ old($key, $value) }}</textarea>
											@else
											<input type="text" class="form-control form-control-sm mb-2" name="{{ $key }}" id="{{ $key }}" placeholder="{{ ucfirst(str_replace('_', ' ', $key)) }}" value="{{ old($key, $value) }}" required>
											@endif
										</div>
									</div>
									@endforeach
								</div>
								<button type="submit" class="btn btn-warning btn-sm w-100 mt-4">Submit</button>
							</form>
							
							@if($page != 'home')
							<hr class="my-4 border-top border-secondary border-opacity-50 mb-3 mt-3">
								
							<style>.ql-container{font-family:Arial,sans-serif}.ql-toolbar{border:1px solid #ccc;background-color:#f3f4f6;padding:5px}.ql-editor{min-height:150px;overflow: auto;border:1px solid #ccc;padding:10px;background-color:#fff}</style>
							<form id="page-form" action="{{ route('admin.pages.modify', $page) }}" method="POST" class="small mt-4" enctype="multipart/form-data">
								@csrf
								@php
								
								@endphp
								<div class="mb-3">
									<label class="form-label" for="">Content</label>
									<div id="tinymce-editor" style="height: 300px;"></div>
									<textarea id="content" name="content" style="display: none;">
									</textarea>
									{{--{!! htmlspecialchars($pageContent->content ? $pageContent->content : '') !!}--}}
								</div>
								<button type="submit" class="btn btn-warning btn-sm w-100 mt-4">Submit</button>
							</form>
							@endif

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

@if($page != 'home')
<script src="{{asset('admin/assets/js/plugins/quill.min.js')}}"></script>

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
      //var content = `{!! htmlspecialchars($pageContent->content ? $pageContent->content : '') !!}`;
      //quill.clipboard.dangerouslyPasteHTML(content);
      
      const parser = new DOMParser();
      const doc = parser.parseFromString(`{!! $pageContent->content !!}`, 'text/html');
      quill.clipboard.dangerouslyPasteHTML(doc.body.innerHTML);
      
      // Sync content to textarea on form submission
      //var form = document.querySelector('form');
      var form = document.getElementById('page-form');
      form.onsubmit = function() {
      	document.getElementById('content').value = quill.root.innerHTML;
          //document.querySelector('textarea[name="content"]').value = quill.root.innerHTML;
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
@endif
@endsection