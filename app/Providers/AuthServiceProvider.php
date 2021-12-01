<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;

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

        // grant superuser all access
        // Gate::before(function ($user) {
        //     return $user->role_id === ROLE::IS_SUPER;
        // });

        // check if the user is a superuser or admin inorder to view the users
        Gate::define('view-users', function (User $user) {
            return $user->role_id === ROLE::IS_SUPER || $user->role_id === ROLE::IS_ADMIN;
        });

        // check if the user is a superuser before creating a new user
        Gate::define('create-user', function (User $user) {
            return $user->role_id === ROLE::IS_SUPER;
        });

        // // check if user is from org or
        // Gate::define('view-organisation', function (User $user) {
        //     return $user->role_id === ROLE::IS_SUPER || $user->role_id === ROLE::IS_ADMIN || $user->role_id === ROLE::IS_ORG;
        // });

        Gate::define('add-organisation', function (User $user) {
            return $user->role_id === ROLE::IS_SUPER || $user->role_id === ROLE::IS_ADMIN;
        });

        Gate::define('is-organisation', function (User $user) {
            return $user->role_id === ROLE::IS_ORG || $user->role_id === ROLE::IS_SUPER;
        });

        Gate::define('is-general', function (User $user) {
            return $user->role_id === ROLE::IS_GENERAL || $user->role_id === ROLE::IS_SUPER;
        });

        Gate::define('can-revert', function (User $user) {
            return $user->role_id === ROLE::IS_REVERT || $user->role_id === ROLE::IS_SUPER;
        });

        Gate::define('can-approve', function (User $user) {
            return $user->role_id === ROLE::IS_APPROVAL || $user->role_id === ROLE::IS_SUPER;
        });
    }
}
