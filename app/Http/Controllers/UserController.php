<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function logout(Request $request) {
	    Auth::logout();
	    //Auth::logoutOtherDevices($currentPassword)
	 
	    $request->session()->invalidate();
	    $request->session()->regenerateToken();
	 
	    return redirect('/');
	}
}
