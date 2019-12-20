<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * The authenticate middleware.
 */
class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request   The incoming HTTP request.
     * @param  \Closure                 $next      The next middleware.
     * @param  string[]                 ...$guards A list of guards.
     *
     * @return mixed Returns the response.
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, $next, ...$guards)
    {
        $this->authenticate($request, $guards);
        if (session("isVerified")) {
            return $next($request);
        }
        return redirect('verify');
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request.
     *
     * @return string Returns the login route name.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
