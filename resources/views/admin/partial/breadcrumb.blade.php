<!-- [ breadcrumb ] start -->
@php
    $currentUrl = url()->current();
    $routeName = Route::currentRouteName();
    $path = Request::path();
@endphp
	<div class="page-header">
        <div class="page-block">
              <div class="row align-items-center">
                    <div class="col-md-12">
                          <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url()->current() }}">{{ $routeName }}</a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $path }}</li>
                          </ul>
                    </div>
                    <div class="col-md-12 d-none">
                          <div class="page-header-title d-none">
                                <h2 class="mb-0">Student Apply</h2>
                          </div>
                    </div>
              </div>
        </div>
  </div>
<!-- [ breadcrumb ] end -->