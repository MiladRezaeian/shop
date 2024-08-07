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

    protected Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAllWithPermissionsAndSearchCriteria($params)
    {
        $roles = $this->applySearchFilters($params);

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

    private function applySearchFilters($params)
    {
        $query = $this->role->newQuery();

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
