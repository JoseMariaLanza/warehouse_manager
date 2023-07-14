<?php

namespace App\Http\Middleware;

use Closure;
use Core\Account\Infrastructure\Facades\JWTAuth;
use Core\Account\Infrastructure\IJWTAuth;
use Illuminate\Http\Request;

class JWTDecoderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_DEBUG') === false || env('ACCEPT_JWT')) { // PRD or Accept JWT on debug == true
            $decodedRequest = JWTAuth::decode($request, ['roles', 'permissions']);
            return $next($decodedRequest);
        }
        return $next($request);
    }
}
