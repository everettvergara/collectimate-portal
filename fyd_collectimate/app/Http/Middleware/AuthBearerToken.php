<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthBearerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() && Auth::guard('api')->check()) {
            return $next($request);
        }

        return response()->json([
            'code'      => '401',
            'message'   => 'Unauthorized',
            'details'     => [],
        ], 401);
    }
}
