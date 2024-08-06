@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-body pt-3">
                        <h5 class="mb-2 text-center">Team Members</h5>
                        <div class="text-center p-4 pb-sm-2">
                            <a href="{{ route('admin.team-members.create') }}" class="btn btn-sm btn-primary mb-2 d-inline-flex align-items-center gap-2 small">
                                <i class="ti ti-plus f-18"></i>
                                Add New Team Member
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>{{ __('Full Name') }}</th>
                                        <th>{{ __('Position') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Date/Time') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teamMembers as $teamMember)
                                    <tr>
                                        <td>{{ $teamMember->team_fullname }}</td>
                                        <td>{{ $teamMember->team_position }}</td>
                                        <td><img src="{{ asset('storage/team/' . $teamMember->team_image) }}" alt="Team Image" class="img-radius wid-40"></td>
                                        <td>
                                            {{ formatCreatedAt($teamMember->created_at)['date'] }}
                                            <span class="text-muted text-sm d-block">
                                                {{ formatCreatedAt($teamMember->created_at)['time'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.team-members.edit', $teamMember->id) }}" class="avtar avtar-xs btn-light-primary">
                                                <i class="ti ti-edit f-20 text-primary"></i>
                                            </a>
                                            <form action="{{ route('admin.team-members.delete', $teamMember->id) }}" method="POST" style="display:inline-block;">
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
                            {{ $teamMembers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection