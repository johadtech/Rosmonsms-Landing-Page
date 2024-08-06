
<!-- Include AlertifyJS CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css">
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            alertify.set('notifier','position', 'top-right');
            alertify.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            alertify.set('notifier','position', 'top-right');
            alertify.error("{{ session('error') }}");
        @endif
        @if(session('info'))
            alertify.set('notifier','position', 'top-right');
            alertify.message("{{ session('info') }}");
        @endif
    });
</script>



@if ($errors->any())
	@foreach ($errors->all() as $error)
	<script>
	    document.addEventListener("DOMContentLoaded", function() {
            alertify.set('notifier','position', 'top-right');
            alertify.error("{{ $error }}");
		});
	</script>
	@endforeach
@endif
