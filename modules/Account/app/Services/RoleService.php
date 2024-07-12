<?php

namespace Modules\Account\app\Services;


use Illuminate\Http\Request;
use Modules\Account\app\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Account\app\Contracts\Services\RoleServiceInterface;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\RoleRequest;
use Modules\Account\app\Http\Resources\RoleCollection;
use Modules\Account\app\Http\Resources\RoleResource;
use Modules\Account\app\Models\Role;

class RoleService implements RoleServiceInterface
{

    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return $this->roleRepository->getAllWithPermissions();
    }

    public function store(RoleRequest $request)
    {
        return $this->roleRepository->create($request->validated());
    }

    public function show(Role $role)
    {
        $role = $this->roleRepository->getDataWithPermissions($role);

        return resolve(RoleResource::class, [
            'resource' => $role
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        return $this->roleRepository->update($request->all(), $role);
    }

    public function destroy(Role $role)
    {
        return $this->roleRepository->destroy($role);
    }

}
