<?php $__env->startSection('content'); ?>
<?php
$pageContent = \App\Models\ContentPage::where('slug', $page)->first();
?>

<link rel="stylesheet" href="<?php echo e(asset('admin/assets/css/plugins/quill.core.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('admin/assets/css/plugins/quill.snow.css')); ?>">

<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<div class="row">
			<!-- [ sample-page ] start -->

			<div class="col-sm-12">

				<div class="card border-0 shadow-none drp-upgrade-card" style="background-image: url(<?php echo e(asset('admin/assets/images/layout/img-profile-card.jpg')); ?>)">
					<div class="card-body pt--1">
						<div class="container text-primary mb-3">
							<h5 class="mb-4 text-center">Edit <?php echo e(ucfirst($page)); ?> Page Details</h5>

							<form id="<?php echo e($page); ?>" action="<?php echo e(route('admin.pages.update')); ?>" method="POST" enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
								<?php echo method_field('PUT'); ?>
								<input type="hidden" name="page" value="<?php echo e($page); ?>">
								<div class="row">
									<?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-sm-6">
										<?php if(str_contains($key, 'image')): ?>
										<div class="col-sm-auto mb-3 mb-sm-0">
											<div class="d-sm-inline-block d-flex align-items-center">
												<?php if(str_contains($key, 'hero')): ?>
												<img class="wid-80 img--radius mb-2" src="<?php echo e(asset('storage/hero/'.$value)); ?>" alt="<?php echo e($key); ?>">
												<?php else: ?>
												<img class="wid-80 img--radius mb-2" src="<?php echo e(asset('storage/general/'.$value)); ?>" alt="<?php echo e($key); ?>">
												<?php endif; ?>
											</div>
										</div>
										<?php endif; ?>
										<?php if(str_contains($key, 'video')): ?>
										<div class="col-sm-auto mb-3 mb-sm-0">
											<div class="d-sm-inline-block d-flex align-items-center">
												<video controls class="mb-1 mt-2" style="width:80%;">
													<source src="<?php echo e(asset('storage/general/'.$value)); ?>" type="video/mp4">
												</video>
											</div>
										</div>
										<?php endif; ?>
										<div class="mb-3">
											<label class="form-label" for="<?php echo e($key); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?></label>
											<?php if(str_contains($key, 'image')): ?>
											<input type="file" class="form-control form-control-sm mb-2" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" accept="image/png, image/jpeg, image/jpg">
											<?php elseif(str_contains($key, 'video')): ?>
											<input type="file" class="form-control form-control-sm mb-2" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" accept="video/mp4, video/x-m4v, video/*">
											<?php elseif(str_contains($key, 'description')): ?>
											<textarea class="form-control form-control-sm mb-2" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" rows="5" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>"><?php echo e(old($key, $value)); ?></textarea>
											<?php else: ?>
											<input type="text" class="form-control form-control-sm mb-2" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" placeholder="<?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>" value="<?php echo e(old($key, $value)); ?>" required>
											<?php endif; ?>
										</div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<button type="submit" class="btn btn-warning btn-sm w-100 mt-4">Submit</button>
							</form>
							
							<?php if($page != 'home'): ?>
							<hr class="my-4 border-top border-secondary border-opacity-50 mb-3 mt-3">
								
							<style>.ql-container{font-family:Arial,sans-serif}.ql-toolbar{border:1px solid #ccc;background-color:#f3f4f6;padding:5px}.ql-editor{min-height:150px;overflow: auto;border:1px solid #ccc;padding:10px;background-color:#fff}</style>
							<form id="page-form" action="<?php echo e(route('admin.pages.modify', $page)); ?>" method="POST" class="small mt-4" enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
								<?php
								
								?>
								<div class="mb-3">
									<label class="form-label" for="">Content</label>
									<div id="tinymce-editor" style="height: 300px;"></div>
									<textarea id="content" name="content" style="display: none;">
									</textarea>
									
								</div>
								<button type="submit" class="btn btn-warning btn-sm w-100 mt-4">Submit</button>
							</form>
							<?php endif; ?>

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

<?php if($page != 'home'): ?>
<script src="<?php echo e(asset('admin/assets/js/plugins/quill.min.js')); ?>"></script>

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
      //var content = `<?php echo htmlspecialchars($pageContent->content ? $pageContent->content : ''); ?>`;
      //quill.clipboard.dangerouslyPasteHTML(content);
      
      const parser = new DOMParser();
      const doc = parser.parseFromString(`<?php echo $pageContent->content; ?>`, 'text/html');
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
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rosmonsm/test.rosmonsms.com/resources/views/admin/pages/edit.blade.php ENDPATH**/ ?>