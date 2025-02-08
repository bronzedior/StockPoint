<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('codenya udh sampe middleware');
        if(!Auth::check()){
            return redirect(route('login'));
        }

        // Debugging: Log to ensure middleware is hit
        Log::info('Middleware executed: User is logged in');

        return $next($request);
    }
}
