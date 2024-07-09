<?php

namespace Modules\Account\app\Services;


use Illuminate\Http\Request;
use Modules\Account\app\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Account\app\Contracts\Services\RoleServiceInterface;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\RoleRequest;
use Modules\Account\app\Models\Role;

class RoleService implements RoleServiceInterface, RoleRepositoryInterface
{

    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleServiceInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
//
//    public function index()
//    {
//        return Role::all();
//    }

    public function index(Request $request)
    {
        return $this->roleRepository->getAll($request);
    }

    public function store(RoleRequest $request)
    {
        return Role::create($request->only('name', 'translated_name'));
    }

    public function edit(RoleRequest $request)
    {
        dd(request()->all());
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->only('name', 'translated_name'));
        $role->refreshPermissions($request->permissions);

        return $role;
    }

}
