@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 text-center">Edit Team Member</h5>
                        <form action="{{ route('admin.team-members.update', $teamMember->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="team_fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="team_fullname" name="team_fullname" value="{{ $teamMember->team_fullname }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="team_position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="team_position" name="team_position" value="{{ $teamMember->team_position }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="team_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="team_image" name="team_image">
                                <img src="{{ asset('storage/team/' . $teamMember->team_image) }}" alt="Team Image" class="img-radius wid-40 mt-2">
                            </div>
                            <div class="mb-3">
                                <label for="team_fb_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control" id="team_fb_url" name="team_fb_url" value="{{ $teamMember->team_fb_url }}">
                            </div>
                            <div class="mb-3">
                                <label for="team_tw_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control" id="team_tw_url" name="team_tw_url" value="{{ $teamMember->team_tw_url }}">
                            </div>
                            <div class="mb-3">
                                <label for="team_ig_url" class="form-label">Instagram URL</label>
                                <input type="url" class="form-control" id="team_ig_url" name="team_ig_url" value="{{ $teamMember->team_ig_url }}">
                            </div>
                            <div class="mb-3">
                                <label for="team_lk_url" class="form-label">LinkedIn URL</label>
                                <input type="url" class="form-control" id="team_lk_url" name="team_lk_url" value="{{ $teamMember->team_lk_url }}">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" {{ $teamMember->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $teamMember->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Team Member</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection