<?php

namespace Modules\Account\app\Contracts\Repositories;

use Modules\Account\app\Models\Permission;

interface PermissionRepositoryInterface
{

    public function getAllWithRolesAndSearchCriteria($params);

    public function getDataWithRoles(Permission $permission);

    public function create(array $data);

    public function update(array $data, Permission $permission);

    public function destroy(Permission $permission);

}
