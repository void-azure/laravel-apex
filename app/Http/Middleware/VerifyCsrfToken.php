<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * The verify CSRF middleware.
 */
class VerifyCsrfToken extends Middleware
{
    /** @var bool $addHttpCookie Indicates whether the XSRF-TOKEN cookie should be set on the response. */
    protected $addHttpCookie = true;

    /** @var array $except The URIs that should be excluded from CSRF verification. */
    protected $except = [];
}
