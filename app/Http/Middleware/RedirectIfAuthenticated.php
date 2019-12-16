<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * The redirect if authenticated middleware.
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     * @param \Closure                 $next    The next middleware.
     * @param string|null              $guard   The auth guard.
     *
     * @return mixed Returns the response.
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }
        return $next($request);
    }
}
