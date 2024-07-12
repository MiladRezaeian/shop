<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Panel\V1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Account\app\Contracts\Services\RoleServiceInterface;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\RoleRequest;
use Modules\Account\app\Models\Role;

class RoleController extends BaseController
{

    private RoleServiceInterface $roleService;

    public function __construct(RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }


    public function index()
    {
        $roles = $this->roleService->index();

        return $this->successWithData($roles);
    }

    public function store(RoleRequest $request)
    {
        $roles = $this->roleService->store($request);

        return $this->successWithData($roles, Response::HTTP_CREATED);
    }

    public function show(Role $role)
    {
        $roles = $this->roleService->show($role);

        return $this->successWithData($roles);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $roles = $this->roleService->update($request, $role);

        return $this->successWithData($roles);
    }

    public function edit(RoleRequest $request)
    {
        $roles = $this->roleService->edit($request);

        return $this->successWithData($roles);
    }

    public function destroy(Role $role)
    {
        $role = $this->roleService->destroy($role);

        return $this->successWithData($role);
    }

}
