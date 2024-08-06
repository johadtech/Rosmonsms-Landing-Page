<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminAuthController extends Controller
{
    /**
     * Show the login form for admin.
     *
     * @return \Illuminate\View\View
     */
    public function admin_login() {
        return view('admin.auth.login');
    }

    /**
     * Handle the admin login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit_admin_login(Request $request) {
        // Validate the login form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();
        
        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'These credentials do not match our records.');
        }

        // Check if the user is blocked
        if ($user->status == 1) {
            return redirect()->back()->with('error', 'Your account is blocked. Please contact support.');
        }

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
        	$request->session()->regenerate();
            //$this->saveLogDetails($user);
            $user = auth()->user();
            return redirect()->route('admin.dashboard', compact('user'));
        }

        // Authentication failed
        return redirect()->back()->with('error', 'These credentials do not match our records or you do not have admin access.');
    }
    
    /**
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showForgotPasswordForm() {
        return view('admin.auth.forgot-password');
    }
    
    /**
     * Handle sending the password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request) {
        $request->validate(['email' => 'required|email']);

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'We can\'t find a user with that email address.');
        }
        
        // Check if the user is blocked
        if ($user->status == 1) {
            return redirect()->back()->with('error', 'Your account is blocked. Please contact support.');
        }

        // Generate a password reset token
        $token = Str::random(60);

        // Store the token in the database
        PasswordReset::updateOrCreate(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Send the reset link via email
        Mail::send('emails.password-reset', ['token' => $token, 'user' => $user], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject(gs()->site_name.' Account Password Reset Link');
        });

        return redirect()->back()->with('success', 'We have emailed your password reset link!');
    }

    /**
     * Show the form to reset the password.
     *
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function showResetForm($token) {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle resetting the password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Retrieve the password reset record
        $passwordReset = PasswordReset::where('token', $request->token)->where('email', $request->email)->first();

        // Check if the token is valid
        if (!$passwordReset) {
            return redirect()->back()->with('error', 'This password reset token is invalid.');
        }

        // Check if the token has expired (valid for 60 minutes)
        if (Carbon::parse($passwordReset->created_at)->addMinutes(1)->isPast()) {
            return redirect()->back()->with('error', 'This password reset token has expired.');
        }

        // Retrieve the user and update their password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset record
        $passwordReset->delete();

        // Redirect to the login page with a success message
        return redirect()->route('adminlogin')->with('success', 'Your password has been reset!');
    }

    /**
     * Handle admin logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('adminloginform');
    }
    
    private function saveLogDetails($user) {
        $ip = $this->getUserIpAddress(Request::capture()) ?? request()->ip();
        $timezone = request()->header('HTTP_TIMEZONE', 'Africa/Lagos');
        save_log_details($user, $ip, $timezone);
    }
    
    public function getUserIpAddress(Request $request) {
    	$ip = $request->ip();
        // Check if the user is using a proxy
        if ($request->server('HTTP_X_FORWARDED_FOR')) {
            $proxies = explode(',', $request->server('HTTP_X_FORWARDED_FOR'));
            if (strpos($request->server('HTTP_X_FORWARDED_FOR'), ',') !== false) {
				$uip = rand(0, 1) ? trim(end($proxies)) : trim($proxies[0]);
				if (filter_var($uip, FILTER_VALIDATE_IP)) {
					$ip = $uip;
				}
            }
        }
        
        // Check if the user is using a VPN
        if ($request->server('HTTP_X_REAL_IP')) {
        	if (filter_var($request->server('HTTP_X_REAL_IP'), FILTER_VALIDATE_IP)) {
	            $ip = $request->server('HTTP_X_REAL_IP');
            }
        }
        
        // Check if the user is using a VPN
        if ($request->server('HTTP_CLIENT_IP')) {
        	if (filter_var($request->server('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP)) {
	            $ip = $request->server('HTTP_CLIENT_IP');
			}
        }

        return $ip;
    }
    
}