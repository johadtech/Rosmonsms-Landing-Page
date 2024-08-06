@extends('layouts.admin')

@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-none drp-upgrade-card" style="background-image: url({{asset('admin/assets/images/layout/img-profile-card.jpg')}})">
                    <div class="card-body pt--1">
                        <div class="container text-primary mb-3">
                            <h5 class="mb-3 text-center">Send  Approval Mail</h5>
                            <form action="{{ route('admin.bookings.send', ['id' => $booking->id]) }}" method="POST" class="text-primary">
                                @csrf
                                <div class="row mb-3">
                                	<div class="col-sm-6 offset-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">User Fullname</label>
                                            <input type="text" class="form-control form-control-sm" name="fullname" required value="{{ __($booking->fullname) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 offset-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">User Email</label>
                                            <input type="email" class="form-control form-control-sm" name="email" required value="{{ __($booking->email) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 offset-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control form-control-sm" name="message" rows="8" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100 text-center">Send Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection