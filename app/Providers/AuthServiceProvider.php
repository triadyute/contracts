<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-contract', function ($user) {
            return $user->hasRole('Admin') || $user->hasRole('SuperUser');
        });

        Gate::define('manage-contract', function ($user) {
            return $user->hasRole('Admin') || $user->hasRole('Editor') || $user->hasRole('SuperUser');
        });

        Gate::define('update-contract', function ($user, Contract $contract) {
            return ($user->hasRole('Admin') && $user->company_id == $contract->company_id) || ($user->hasRole('Editor') && $user->company_id == $contract->company_id) || $user->hasRole('SuperUser');
        });

        Gate::define('view-contract', function ($user, Contract $contract) {
            return $user->hasRole('SuperUser') || $contract->users->contains($user) || $contract->requires_special_privileges == 0;
        });

        Gate::define('manage-users', function ($user) {
            return $user->hasRole('SuperUser') || $user->hasRole('Admin');
        });
    }
}
