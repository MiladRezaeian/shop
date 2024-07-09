<?php

namespace Modules\Account\app\Services\Permission\Traits;

use Illuminate\Support\Arr;
use Modules\Account\app\Models\Permission;

trait HasPermissions
{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        if ($permissions->isEmpty()) return $this;

        $this->permissions()->syncWithoutDetaching($permissions);

        return $this;
    }

    public function withdrawPermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);

        return $this;
    }

    public function refreshPermissions(...$permissions){
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->sync($permissions);

        return $this;
    }

    public function hasPermission(Permission $permission)
    {
        return  $this->hasPermissionsThroughRole($permission) || $this->permissions->contains($permission);
    }

    protected function hasPermissionsThroughRole(Permission $permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) return true;
        }

        return false;
    }

    private function getAllPermissions(array $permissions){
        return Permission::whereIn('name', Arr::flatten($permissions))->get();
    }

}
