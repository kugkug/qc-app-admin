<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return redirect('/');
    
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return redirect('/');
    
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return redirect('/');
        }

        return $next($request);
    }
}