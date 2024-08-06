@extends('layouts.admin')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header d-none">
                        <h5 class="mb-0 text-center d-none">FAQs</h5>
                    </div>
                    <div class="card-body pt-3">
                        <h5 class="mb-2 text-center small">Frequently Asked Questions</h5>
                        <div class="text-center p-4 pb-sm-2">
							<a href="{{ route('admin.faqs.create') }}" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-plus f-18"></i>
								Create New FAQ
							</a>

							<a href="{{ route('admin.faqs.index', ['status' => 0]) }}" class="btn btn-sm btn-danger mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-writing f-18"></i>
								Pending FAQ
							</a>

							<a href="{{ route('admin.faqs.index', ['status' => 1]) }}" class="btn btn-sm btn-success mb-2 d-inline-flex align-items-center gap-2">
								<i class="ti ti-writing-sign f-18"></i>
								Active FAQ
							</a>
						</div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Content') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Date/Time') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqs as $faq)
                                    <tr>
                                        <td>{{ __($faq->title) }}</td>
                                        <td>{!! __($faq->content) !!}</td>
                                        <td>{{ $faq->status == 1 ? 'Active' : 'Pending' }}</td>
                                        <td>
                                            {{ formatCreatedAt($faq->created_at)['date'] }}
                                            <span class="text-muted text-sm d-block">
                                                {{ formatCreatedAt($faq->created_at)['time'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="avtar avtar-xs btn-light-danger">
                                                <i class="ti ti-edit f-20 text-primary"></i>
                                            </a>
                                            <a href="#" class="avtar avtar-xs btn-light-secondary" onclick="event.preventDefault(); document.getElementById('delete-{{ $faq->id }}').submit();">
                                                <i class="ti ti-trash f-20 text-danger"></i>
                                            </a>
                                            <form action="{{ route('admin.faqs.delete', $faq->id) }}" method="POST" style="display:none;" id="delete-{{ $faq->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $faqs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection