<?php

namespace Modules\Account\app\Contracts\Services;

use Illuminate\Http\Request;
use Modules\Account\app\Http\Requests\Auth\RegisterRequest;
use Modules\Account\app\Models\User;

interface UserServiceInterface
{

    public function index(Request $request);

    public function store(RegisterRequest $request);

    public function show(User $user);

    public function update(RegisterRequest $request, User $user);

    public function destroy(User $user);

    public function search(Request $request);


}
