<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) {
    	if (auth()->check() && auth()->user()->status == 0) {
	        return $next($request);
	    }
		return abort(403, 'Unauthorized action.');
	    //return redirect('/');
    }
}
