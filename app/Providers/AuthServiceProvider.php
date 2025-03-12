<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    // In the boot method of AuthServiceProvider.php
    public function boot()
    {
        $this->registerPolicies();
        
        // Define permissions for doctors
        Gate::define('doctor_access', function ($user) {
            return $user->hasPermission('doctor_access');
        });
        
        Gate::define('doctor_create', function ($user) {
            return true; // Temporarily allow all users
        });
        
        Gate::define('doctor_edit', function ($user) {
            return $user->hasPermission('doctor_edit');
        });
        
        Gate::define('doctor_show', function ($user) {
            return $user->hasPermission('doctor_show');
        });
        
        Gate::define('doctor_delete', function ($user) {
            return $user->hasPermission('doctor_delete');
        });
        
        // Instead of Passport::routes()
        Passport::tokensCan([
            // Your scopes here
        ]);
        
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
