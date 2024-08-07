<?php

namespace Modules\Account\app\Contracts\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Account\app\Http\Requests\Api\Web\Panel\V1\RoleRequest;
use Modules\Account\app\Models\Role;

interface RoleServiceInterface
{

    public function index(Request $request);

    public function store(RoleRequest $request);

    public function show(Role $role);

    public function update(RoleRequest $request, Role $role);

    public function destroy(Role $role);

}
