<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Authorization
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed|string
     */
    public function handle(Request $request, Closure $next)
    {
        $routePrefix = Route::current()->getPrefix();
        if ($routePrefix == 'admin') {
            if (Auth::guard('admin')->user()) {
                return $next($request);
            } else {
                return redirect()->route('admin.login');
            }
        } else {
            if (Auth::user()) {
                return $next($request);
            } else {
                return route('login');
            }
        }
    }
}
