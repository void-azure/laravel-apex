<?php

namespace App\Http\Middleware;

use Closure;

/**
 * The admin check middleware.
 */
class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     * @param \Closure                 $next    The next middleware.
     *
     * @return mixed Returns the response.
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('home')->with('warning', trans('flash.user_is_not_admin'));
        }
        return $next($request);
    }
}
