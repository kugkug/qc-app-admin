<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
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
        } catch (JWTException $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return response()->json(['status' => false,  'response' => 'Invalid Token'], 401);
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return response()->json(['status' => false,  'response' => 'Unauthorized'], 401);
        }
        
        return $next($request);
    }
}