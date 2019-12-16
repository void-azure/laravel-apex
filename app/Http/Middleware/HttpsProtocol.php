<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

/**
 * The https protocol middleware.
 */
class HttpsProtocol
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
        if (!$request->secure() && App::environment() === 'production') {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request); 
    }
}
