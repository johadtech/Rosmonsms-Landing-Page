<!-- Partners start -->
<style>
	/* Equivalent to .py-4 (padding-top and padding-bottom of 1.5rem) and border-bottom and border-top */
.partners-section {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #dee2e6; /* Equivalent to border-bottom class in Bootstrap */
    border-top: 1px solid #dee2e6; /* Equivalent to border-top class in Bootstrap */
}

/* Equivalent to .container */
.custom-container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

/* Equivalent to .row and .justify-content-center */
.custom-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-right: -15px;
    margin-left: -15px;
}

/* Equivalent to .col-lg-2, .col-md-2, .col-6, .text-center, and .py-4 */
.custom-col {
    flex: 0 0 16.666667%; /* 2 out of 12 columns for col-lg-2 */
    max-width: 16.666667%; /* 2 out of 12 columns for col-lg-2 */
    padding: 1rem;
    text-align: center; /* Equivalent to text-center class in Bootstrap */
}

@media (max-width: 1199.98px) {
    .custom-col {
        flex: 0 0 16.666667%; /* 2 out of 12 columns for col-md-2 */
        max-width: 16.666667%; /* 2 out of 12 columns for col-md-2 */
    }
}

@media (max-width: 575.98px) {
    .custom-col {
        flex: 0 0 50%; /* 6 out of 12 columns for col-6 */
        max-width: 50%; /* 6 out of 12 columns for col-6 */
    }
}

/* Equivalent to .avatar and .avatar-ex-sm */
.custom-avatar {
    width: auto;
    height: auto;
    max-width: 100%;
    border-radius: 50%; /* Equivalent to avatar class in Bootstrap */
    /* You may need additional styles for avatar-ex-sm */
}
</style>
<section class="partners-section">
    <div class="custom-container">
        <div class="custom-row">
            @foreach(App\Models\Partner::all() as $partner)
                <div class="custom-col">
                    <img src="{{ asset('---' . $partner->brand_image) }}" class="custom-avatar" alt="{{ $partner->brand_name }}">
                </div>
                <!--end col-->
            @endforeach
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>

<!-- Partners start -->
<section class="py-4 border-bottom border-top" style="display:none;">
    <div class="container">
        <div class="row justify-content-center">
            @foreach(App\Models\Partner::all() as $partner)
                <div class="col-lg-2 col-md-2 col-6 text-center py-4">
                    <img src="{{ asset($partner->brand_image) }}" class="avatar avatar-ex-sm" alt="{{ $partner->brand_name }}">
                </div>
                <!--end col-->
            @endforeach
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Partners End -->
