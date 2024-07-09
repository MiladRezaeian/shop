<?php

namespace Modules\Account\app\Services;

use Modules\Account\app\Contracts\Services\PermissionServiceInterface;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\PermissionRequest;
use Modules\Account\app\Models\Permission;

class PermissionService implements PermissionServiceInterface
{

    public function index()
    {
        return Permission::all();
    }

    public function store(PermissionRequest $request)
    {
        return Permission::create($request->only('name', 'translated_name'));
    }

}
