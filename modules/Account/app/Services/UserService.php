<?php

namespace Modules\Account\app\Services;

use Illuminate\Support\Facades\Hash;
use Modules\Account\app\Http\Requests\Auth\RegisterRequest;
use Modules\Account\app\Models\User;

class UserService
{

    public function register(RegisterRequest $request)
    {
        $user = $this->createUser($request->validated());
    }

    protected function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}
