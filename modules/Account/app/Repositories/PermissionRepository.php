<?php

namespace Modules\Account\app\Repositories;

use Illuminate\Http\Request;
use Modules\Account\app\Contracts\Repositories\PermissionRepositoryInterface;
use Modules\Account\app\Http\Resources\PermissionResource;
use Modules\Account\app\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{

    protected Permission $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getAllWithRolesAndSearchCriteria($params)
    {
        $permissions = $this->applySearchFilters($params);

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

    private function applySearchFilters($params)
    {
        $query = $this->permission->newQuery();

        $name = $params['name'] ?? null;
        $translated_name = $params['translated_name'] ?? null;


        if (!empty($name)) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (!empty($translated_name)) {
            $query->where('translated_name', 'like', '%' . $params['translated_name'] . '%');
        }

        return $query->paginate();
    }

}
