<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

/**
 * The maintenance mode middleware.
 */
class CheckForMaintenanceMode extends Middleware
{
    /** @var array $except The URIs that should be reachable while maintenance mode is enabled. */ 
    protected $except = [];
}
