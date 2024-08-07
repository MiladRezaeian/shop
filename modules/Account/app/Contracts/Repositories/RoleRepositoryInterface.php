<?php

namespace Modules\Account\app\Contracts\Repositories;

use Modules\Account\app\Models\Role;

interface RoleRepositoryInterface
{

    public function getAllWithPermissionsAndSearchCriteria($params);

    public function getDataWithPermissions(Role $role);

    public function create(array $data);

    public function update(array $data, Role $role);

    public function destroy(Role $role);

}
