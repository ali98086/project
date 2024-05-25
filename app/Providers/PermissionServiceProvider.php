<?php

namespace App\Providers;

use App\Models\User\Permission;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        try{

            $permissions= Permission::all();
            foreach($permissions as $permission){

                Gate::define($permission->name, function($user) use ($permission){

                    return $user->hasPermissionTo($permission);

                });
            }
        }
        catch(Exception $e){

            report($e);
            return false;

        }
    }
}
