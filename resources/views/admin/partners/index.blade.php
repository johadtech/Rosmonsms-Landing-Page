@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-body pt-3">
                        <h5 class="mb-2 text-center">Partners</h5>
                        <div class="text-center p-4 pb-sm-2">
                            <a href="{{ route('admin.partners.create') }}" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2 small">
                                <i class="ti ti-plus f-18"></i>
                                Add New Partner
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>{{ __('Brand Name') }}</th>
                                        <th>{{ __('Brand Image') }}</th>
                                        <th>{{ __('Date/Time') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($partners as $partner)
                                    <tr>
                                        <td>{{ $partner->brand_name }}</td>
                                        <td><img src="{{ asset('storage/partner/' . $partner->brand_image) }}" alt="Brand Image" class="img-radius wid-40"></td>
                                        <td>
	                                        {{ formatCreatedAt($partner->created_at)['date'] }}
											<span class="text-muted text-sm d-block">
												{{ formatCreatedAt($partner->created_at)['time'] }}
											</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="avtar avtar-xs btn-light-primary">
                                                <i class="ti ti-edit f-20 text-primary"></i>
                                            </a>
                                            <form action="{{ route('admin.partners.delete', $partner->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="avtar avtar-xs btn-light-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="ti ti-trash f-20 text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $partners->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection