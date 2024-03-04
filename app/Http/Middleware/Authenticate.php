<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate
{
    // /**
    //  * Get the path the user should be redirected to when they are not authenticated.
    //  */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }
    public function handle(Request $request, Closure $next)
    {
        if (!JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'You must be logged in.'], 401);
        }

        return $next($request);
    }
}
