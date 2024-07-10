<?php

namespace Modules\Account\app\Services;

use Illuminate\Http\Request;
use Modules\Account\app\Contracts\Repositories\PermissionRepositoryInterface;
use Modules\Account\app\Contracts\Services\PermissionServiceInterface;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\PermissionRequest;
use Modules\Account\app\Http\Resources\PermissionCollection;
use Modules\Account\app\Http\Resources\PermissionResource;
use Modules\Account\app\Models\Permission;

class PermissionService implements PermissionServiceInterface
{

    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        return $this->permissionRepository->getAllWithRoles();
    }

    public function store(PermissionRequest $request)
    {
        return $this->permissionRepository->create($request->validated());
    }

    public function show(Permission $permission)
    {
        $permission = $this->permissionRepository->getDataWithRoles($permission);

        return resolve(PermissionResource::class, [
            'resource' => $permission
        ]);

    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        return $this->permissionRepository->update($request->all(), $permission);
    }

    public function destroy(Permission $permission)
    {
        return $this->permissionRepository->destroy($permission);
    }

}
