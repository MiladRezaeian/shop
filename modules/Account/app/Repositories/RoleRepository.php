<?php

namespace Modules\Account\app\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Modules\Account\app\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Account\app\Http\Resources\RoleCollection;
use Modules\Account\app\Http\Resources\RoleResource;
use Modules\Account\app\Http\Resources\UserCollection;
use Modules\Account\app\Http\Resources\UserResource;
use Modules\Account\app\Models\Permission;
use Modules\Account\app\Models\Role;
use Modules\Account\app\Models\User;

class RoleRepository implements RoleRepositoryInterface
{

    public function getAllWithPermissions()
    {
        $roles = Role::paginate();
        $roles->load('permissions');

        return $roles;
    }

    public function getDataWithPermissions(Role $role)
    {
        $role->load(['permissions']);

        return $role;
    }

    public function create(array $data): Role
    {
        return Role::create([
            'name' => $data['name'],
            'translated_name' => $data['translated_name']
        ]);
    }

    public function update(array $data, Role $role): Role
    {
        $role->name = $data['name'];
        $role->translated_name = $data['translated_name'];

        $role->save();

        return $role;
    }

    public function destroy(Role $role)
    {
        return $role->delete();
    }

}
