<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index() {
        $bookings = Booking::where('status', 0)->get();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request) {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'ip_address' => 'required',
            'reason' => 'required',
        ]);

        $booking = Booking::create($request->all());

        // Send email to admin
        Mail::raw("New booking request from {$booking->fullname} ({$booking->email})", function ($message) use ($booking) {
            $message->to('admin@example.com')->subject('New Booking Request');
        });

        return back()->with('success', 'Booking request submitted successfully');
    }

    public function update(Request $request, Booking $booking) {
        $booking->update(['status' => 1]);

        // Create user account
        $password = Str::random(8);
        $user = User::create([
            'name' => $booking->fullname,
            'email' => $booking->email,
            'password' => bcrypt($password),
            'is_admin' => 0,
        ]);

        // Send email to user
        Mail::raw("Your demo access has been granted. Login with email: {$user->email} and password: {$password}", function ($message) use ($user) {
            $message->to($user->email)->subject('Demo Access Granted');
        });

        return back()->with('success', 'Booking approved and user created successfully');
    }
}