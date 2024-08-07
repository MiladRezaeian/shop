<?php

namespace Modules\Account\app\Contracts\Services;

use Illuminate\Http\Request;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\PermissionRequest;
use Modules\Account\app\Models\Permission;

interface PermissionServiceInterface
{

    public function index(Request $request);

    public function store(PermissionRequest $request);

    public function show(Permission $permission);

    public function update(PermissionRequest $request, Permission $permission);

    public function destroy(Permission $permission);

}
