<?php

namespace Modules\Account\app\Services\Permission\Traits;

use Illuminate\Support\Arr;
use Modules\Account\app\Models\Role;

trait HasRoles
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function giveRolesTo(...$roles)
    {
        $roles = $this->getAllRoles($roles);

        if($roles->isEmpty()) return $this;

        $this->roles()->syncWithoutDetaching($roles);

        return $this;
    }

    public function withdrawRoles(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        $this->roles()->detach($roles);

        return $this;
    }

    public function refreshRoles(...$roles){
        $roles = $this->getAllRoles($roles);
        $this->roles()->sync($roles);

        return $this;
    }

    public function hasRole(string $role)
    {
        return $this->roles->contains('name', $role);
    }

    protected function getAllRoles(array $roles)
    {
        return Role::whereIn('name', Arr::flatten($roles))->get();
    }

}
