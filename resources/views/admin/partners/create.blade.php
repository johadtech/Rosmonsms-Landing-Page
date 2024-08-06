@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 text-center">Create New Partner</h5>
                        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="brand_name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="brand_image" class="form-label">Brand Image</label>
                                <input type="file" class="form-control" id="brand_image" name="brand_image" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Create Partner</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection