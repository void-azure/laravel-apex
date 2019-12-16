<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * The auth service provider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /** @var array $policy The policy mappings for the application. */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void Returns nothing.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
