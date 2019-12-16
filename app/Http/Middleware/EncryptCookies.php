<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * The encrypt cookies middleware.
 */
class EncryptCookies extends Middleware
{
    /** @var array $except The names of the cookies that should not be encrypted. */
    protected $except = [];
}
