<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Panel\V1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Account\app\Contracts\Services\PermissionServiceInterface;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\PermissionRequest;
use Modules\Account\app\Models\Permission;

class PermissionController extends BaseController
{

    private PermissionServiceInterface $permissionService;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }


    public function index(Request $request)
    {
        $permissions = $this->permissionService->index($request);

        return $this->successWithData($permissions);
    }

    public function store(PermissionRequest $request)
    {
        $permissions = $this->permissionService->store($request);

        return $this->successWithData($permissions);
    }

    public function show(Permission $permission)
    {
        $permissions = $this->permissionService->show($permission);

        return $this->successWithData($permissions);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permissions = $this->permissionService->update($request, $permission);

        return $this->successWithData($permissions);
    }

    public function edit(PermissionRequest $request)
    {
        $permissions = $this->permissionService->edit($request);

        return $this->successWithData($permissions);
    }

    public function destroy(Permission $permission)
    {
        $permission = $this->permissionService->destroy($permission);

        return $this->successWithData($permission);
    }

}
