<?php

namespace App\Http\Middleware;

use Closure;

/**
 * The two factor verify middleware.
 */
class TwoFactorVerification
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
        if (session()->has('tf.session')) {
            return $next($request);
        }
        return redirect('/two-factor/verify');
    }
}
