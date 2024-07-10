<?php

namespace Modules\Account\app\Repositories;

use Illuminate\Http\Request;
use Modules\Account\app\Contracts\Repositories\PermissionRepositoryInterface;
use Modules\Account\app\Http\Resources\PermissionResource;
use Modules\Account\app\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{

    public function getAllWithRoles()
    {
        $permissions = Permission::paginate();
        $permissions->load('roles');

        return $permissions;
    }

    public function getDataWithRoles(Permission $permission)
    {
        $permission->load(['roles']);

        return $permission;
    }

    public function create(array $data): Permission
    {
        return Permission::create([
            'name' => $data['name'],
            'translated_name' => $data['translated_name']
        ]);
    }

    public function update(array $data, Permission $permission): Permission
    {
        $permission->name = $data['name'];
        $permission->translated_name = $data['translated_name'];

        $permission->save();

        return $permission;
    }

    public function destroy(Permission $permission)
    {
        return $permission->delete();
    }

}
