<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Admin" role all permissions
        // This works in the frontend by using gate-related functions like auth()->user->can() and @can()
        // Learn when to use this instead: https://docs.spatie.be/laravel-permission/v3/basic-usage/super-admin/#gate-after
        Gate::before(function ($user) {
            return $user->hasRole(config('boilerplate.auth.role.admin')) ? true : null;
        });
    }
}
