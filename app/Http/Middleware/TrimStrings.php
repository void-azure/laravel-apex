<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * The trim strings middleware.
 */
class TrimStrings extends Middleware
{
    /** @var array $except The names of the attributes that should not be trimmed. */
    protected $except = [
        'password',
        'password_confirmation',
        'two_factor_token',
    ];
}
