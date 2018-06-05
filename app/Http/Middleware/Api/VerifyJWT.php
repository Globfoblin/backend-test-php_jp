<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWT extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            $errors[] = 'Authorization error';

            return response()->json($errors, 403);
        }

        return $next($request);
    }
}
