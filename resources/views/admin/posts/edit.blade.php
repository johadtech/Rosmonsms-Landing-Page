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
							
							<h5 class="mb-3 text-center small">Edit Post - {{ __($post->title) }}</h5>
							
							<form id="myForm" action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="row">
									
									<div class="col-sm-6">
										<div class="input-group mb-3">
											<label class="form-label">Slug</label>
											<div class="input-group">
												<input type="text" class="form-control form-control-sm" id="pc-clipboard-1" placeholder="Post slug" readonly value="{{ url('/') }}/{{ $post->slug }}">
												<a href="#" class="btn btn-sm btn-primary" data-clipboard="true" data-clipboard-target="#pc-clipboard-1">
													<i class="feather icon-copy"></i>
												</a>
											</div>
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Title</label>
											<input type="text" class="form-control form-control-sm" id="" placeholder="Post title" name="title" value="{{ $post->title }}" required>
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="mb-3">
											<label class="form-label">Category</label>
											<select class="mb-3 form-select form-select-sm" name="category_id" required>
												{{--<option selected disabled>-- Choose Category --</option>--}}
												@foreach($categories as $category)
												<option value="{{ $category->id }}" @if($post->category->id == $category->id) selected @endif> {{ $category->name }} </option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								
								<style>.card .editor-box,.card .toolbar button{border:1px solid #ccc;display:flex}.card .editor-box{flex-direction:column}.card #editor{border-top:1px solid #ccc;padding:10px;min-height:300px;flex-grow:1}.card .toolbar{display:flex;flex-wrap:wrap;padding:5px;background:#f7f7f7}.card .toolbar button{margin-right:5px;margin-bottom:5px;padding:5px 10px;background:#fff;cursor:pointer;text-align:center;align-items:center;justify-content:center}.card .toolbar button.active{background:#007bff;color:#fff}.card .toolbar button:hover{background:#e0e0e0}.card #wordCount{margin-top:10px}.card #editor img{max-width:100%;height:auto}.card .img-delete-button{position:absolute;background:red;color:#fff;border:none;border-radius:50%;cursor:pointer}</style>
								<div class="mb-3">
									<label class="form-label" for="">Content</label>
									<div class="editor-box small">
										<div class="toolbar small">
											<button type="button" id="bold"><i class="fas fa-bold"></i></button>
											<button type="button" id="italic"><i class="fas fa-italic"></i></button>
											<button type="button" id="underline"><i class="fas fa-underline"></i></button>
											<button type="button" id="link"><i class="fas fa-link"></i></button>
											<button type="button" id="heading1">H1</button>
											<button type="button" id="heading2">H2</button>
											<button type="button" id="heading3">H3</button>
											<button type="button" id="ulist"><i class="fas fa-list-ul"></i></button>
											<button type="button" id="olist"><i class="fas fa-list-ol"></i></button>
											<button type="button" id="leftAlign"><i class="fas fa-align-left"></i></button>
											<button type="button" id="centerAlign"><i class="fas fa-align-center"></i></button>
											<button type="button" id="rightAlign"><i class="fas fa-align-right"></i></button>
											<button type="button" id="addImage"><i class="fas fa-image"></i></button>
											<input type="file" id="imageUpload" style="display:none;">
											<button type="button" id="codeBlock"><i class="fas fa-code"></i></button>
											<button type="button" id="removeFormat"><i class="fas fa-eraser"></i></button>
										</div>
										<div id="editor" contenteditable="true"></div>
									</div>
									<textarea id="content" name="content" required style="display:none;">{!! htmlspecialchars($post->content) !!}</textarea>
									<div id="wordCount" class="small">
										Sentence count: 0
									</div>
								</div>
								<script>document.addEventListener("DOMContentLoaded",function(){let e=document.getElementById("editor"),t=document.getElementById("content"),n=document.getElementById("wordCount"),d=()=>{let t=e.innerText||"";n.textContent=`Word count: ${t.trim().split(/\s+/).filter(e=>e.length>0).length}`},l=()=>{let e=document.querySelectorAll(".toolbar button");e.forEach(e=>{let t=e.getAttribute("data-command");document.queryCommandState(t)?e.classList.add("active"):e.classList.remove("active")})},i=(t,n=null)=>{document.execCommand(t,!1,n),e.focus(),l()};document.getElementById("bold").addEventListener("click",()=>i("bold")),document.getElementById("italic").addEventListener("click",()=>i("italic")),document.getElementById("underline").addEventListener("click",()=>i("underline")),document.getElementById("link").addEventListener("click",()=>{let e=prompt("Enter the link here: ","http://");i("createLink",e)}),document.getElementById("heading1").addEventListener("click",()=>i("formatBlock","H1")),document.getElementById("heading2").addEventListener("click",()=>i("formatBlock","H2")),document.getElementById("heading3").addEventListener("click",()=>i("formatBlock","H3")),document.getElementById("ulist").addEventListener("click",()=>i("insertUnorderedList")),document.getElementById("olist").addEventListener("click",()=>i("insertOrderedList")),document.getElementById("leftAlign").addEventListener("click",()=>i("justifyLeft")),document.getElementById("centerAlign").addEventListener("click",()=>i("justifyCenter")),document.getElementById("rightAlign").addEventListener("click",()=>i("justifyRight")),document.getElementById("addImage").addEventListener("click",()=>{document.getElementById("imageUpload").click()}),document.getElementById("imageUpload").addEventListener("change",e=>{let t=e.target.files[0],n=new FileReader;n.onload=function(e){let t=new Image;t.onload=function(){let e=document.createElement("canvas"),n=e.getContext("2d"),d=t.width,l=t.height;d>l?d>1280&&(l*=1280/d,d=1280):l>720&&(d*=720/l,l=720),e.width=d,e.height=l,n.drawImage(t,0,0,d,l);let i=e.toDataURL("image/jpeg");a(i)},t.src=e.target.result},n.readAsDataURL(t)});let a=t=>{let n=document.createElement("div");n.style.position="relative";let d=document.createElement("img");d.src=t,d.style.maxWidth="100%",d.style.height="auto";let l=document.createElement("button");l.className="img-delete-button",l.textContent="X",l.style.position="absolute",l.style.top="10px",l.style.right="10px",l.addEventListener("click",()=>{n.remove()}),n.appendChild(d),n.appendChild(l),e.appendChild(n)};document.getElementById("codeBlock").addEventListener("click",()=>{let t=prompt("Enter your code here: "),n=document.createElement("pre");n.textContent=t,e.appendChild(n)}),document.getElementById("removeFormat").addEventListener("click",()=>i("removeFormat")),e.addEventListener("input",()=>{t.value=e.innerHTML,d(),localStorage.setItem("editorContent",e.innerHTML)}),e.addEventListener("keyup",l),e.addEventListener("mouseup",l),l()});</script>
								
								<div class="mb-3">
									<label class="form-label" for="">Description</label>
									<textarea class="form-control form-control-sm mb-2" id="" rows="6" name="description" required> {{ $post->description }} </textarea>
								</div>
								
								<div class="mb-3">
									<div class="" style="width: 80px;">
										<img src="{{ asset('storage/post/'.$post->thumbnail)}}" class="w-100 h-80">
									</div>
								</div>
								
								<div class="dropzone mb-3">
									<label class="form-label" for="">Thumbnail</label>
									<p class="small"><span class="text-danger">*</span> Recommended resolution is 1200 * 628 of image size</p>
									<div class="fallback">
										<input name="thumbnail" type="file" accept="image/jpeg,image/png,image/jpg" class="form-control form-control-sm" style="background-image:{{ asset('storage/post/'.$post->thumbnail) }};">
									</div>
								</div>
								
								<div class="mb-3">
									<label class="form-label">Tags</label>
									<input type="text" class="form-control form-control-sm" id="" name="tags" placeholder="Post tags" value="{{ $post->tags }}">
									<small class="form-text text-muted text-secondary">Separated with comma (eg. davido, wizkid, music)</small>
								</div>
								
								<div class="mb-5">
									<label class="form-label">Post Status</label>
									<select class="form-select form-select-sm" name="status" required>
										<option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Publish</option>
										<option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Draft</option>
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
    
    document.addEventListener('DOMContentLoaded', function () {
    	const content = document.getElementById('content');
        const editor = document.getElementById('editor');
	    //content.value = `{!! addslashes($post->content) !!}`;
	    //editor.innerText = `{!! addslashes($post->content) !!}`;
	
	    const parser = new DOMParser();
		const doc = parser.parseFromString(`{!! $post->content !!}`, 'text/html');
		editor.innerHTML = doc.body.innerHTML;
		
		editor.addEventListener('input', function() {
	        content.value = editor.innerHTML;
	    });
    });
</script>
@endsection



