<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Panel\V1;

use App\Http\Controllers\BaseController;
use Modules\Account\app\Contracts\Services\PermissionServiceInterface;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\PermissionRequest;

class PermissionController extends BaseController
{

    private PermissionServiceInterface $permissionService;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }


    public function index()
    {
        $permissions = $this->permissionService->index();

        return $this->successWithData($permissions);
    }

    public function store(PermissionRequest $request)
    {
        $roles = $this->permissionService->store($request);

        return $this->successWithData($roles);
    }

}
