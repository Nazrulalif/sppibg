<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->access_code == 1 || Auth::user()->access_code == 2 || Auth::user()->access_code == 3 || Auth::user()->access_code == 6) {
                return $next($request);
            } else {
                return redirect('/laman-utama')->with('message', 'error');
            }
        } else {
            return redirect('/login')->with('message', 'error');
        }

        return $next($request);
    }
}
