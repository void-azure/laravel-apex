<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

/**
 * The trusted proxies middleware.
 */
class TrustProxies extends Middleware
{
    /** @var array|string $proxies The trusted proxies for this application. */
    protected $proxies;

    /** @var int $headers The headers that should be used to detect proxies. */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
