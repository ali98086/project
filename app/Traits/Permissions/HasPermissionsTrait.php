<?php

namespace App\Traits\Permissions;

trait HasPermissionsTrait{


    public function hasPermission($permission){

        return $this->permissions->where('name' , $permission->name)->count();

    }


    public function hasRole(...$roles){

        foreach($roles as $role){

            if($this->roles->contains('name', $role)){

                return true;

            }
        }

        return false;

    }


    public function hasPermissionTo($permission){

        return $this->hasPermission($permission) || $this->hasPermissionAtRoles($permission);

    }


    public function hasPermissionAtRoles($permission){

        foreach($permission->roles as $role){

            if($this->roles->contains($role)){

                return true;

            }
        }
        return false;
    }

}