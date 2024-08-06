<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     
     public function handle(Request $request, Closure $next) {
     	// Check for the custom headers
     	if (!$request->hasHeader('Authorization') || !$request->hasHeader('X-Custom-Header')) {
	     	return response()->json(['success' => false, 'status' => 'failed', 'message' => 'Unauthorized: Missing custom headers'], 401);
     	}
         
         // Validate the Authorization header (e.g., check token validity)
         $authorizationHeader = $request->header('Authorization');
        if ($authorizationHeader !== 'Bearer your_token_here') {
            return response()->json(['success' => false, 'status' => 'failed', 'message' => 'Unauthorized: Invalid token'], 401);
        }
        
        // Validate the X-Custom-Header (if necessary)
        $customHeader = $request->header('X-Custom-Header');
        if ($customHeader !== 'your_custom_value') {
            return response()->json(['success' => false, 'status' => 'failed', 'message' => 'Unauthorized: Invalid custom header'], 401);
        }

        return $next($request);
     }
}
