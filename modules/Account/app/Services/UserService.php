<?php

namespace Modules\Account\app\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Account\app\Contracts\Repositories\UserRepositoryInterface;
use Modules\Account\app\Contracts\Services\UserServiceInterface;
use Modules\Account\app\Http\Requests\Auth\RegisterRequest;
use Modules\Account\app\Models\User;
use Modules\Account\app\Repositories\UserRepository;

class UserService implements UserServiceInterface, UserRepositoryInterface
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index(Request $request)
    {
        return $this->userRepository->getAllWithRoles($request);
    }

    public function update(Request $request, User $user)
    {
        return $this->userRepository->update($request->all(), $user);
    }

    public function store(RegisterRequest $request)
    {
        return $this->userRepository->create($request->validated());
    }

    public function destroy(User $user)
    {
        return $this->userRepository->destroy($user);
    }

    public function getUserData(User $user)
    {
        return $this->userRepository->getUserDataWithRolesAndPermissions($user);
    }

}
