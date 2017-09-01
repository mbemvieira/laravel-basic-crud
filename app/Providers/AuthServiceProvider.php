<?php

namespace App\Providers;

use App\Permission;
use App\Person;
use App\Role;
use App\User;
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
        'App\Model'     => 'App\Policies\ModelPolicy',
        'App\Person'    => 'App\Policies\PersonPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-person', function ($user, $person) {
        //     return $user->id == $person->user_id;
        // });

        if ( \Schema::hasTable('users') &&
            \Schema::hasTable('roles') &&
            \Schema::hasTable('role_user') &&
            \Schema::hasTable('permissions') &&
            \Schema::hasTable('permission_role')
        ) {
            $permissions = Permission::with('roles')->get();
            foreach ($permissions as $permission) {
                Gate::define($permission->name, function (User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
    }
}
