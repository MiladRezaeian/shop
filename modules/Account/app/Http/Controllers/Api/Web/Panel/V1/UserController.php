<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Panel\V1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Account\app\Contracts\Services\UserServiceInterface;
use Modules\Account\app\Http\Requests\Auth\RegisterRequest;
use Modules\Account\app\Models\User;

class UserController extends BaseController
{

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->index($request);

        return $this->successWithData($users);
    }

    public function store(RegisterRequest $request)
    {
        $users = $this->userService->store($request);

        return $this->successWithData($users, Response::HTTP_CREATED);
    }

    public function show(Request $request, User $user)
    {
        $userData = $this->userService->getUserData($user);

        return $this->successWithData($userData);
    }

    public function update(RegisterRequest $request, User $user)
    {
        $users = $this->userService->update($request, $user);

        return $this->successWithData($users);
    }

    public function destroy(User $user)
    {
        $users = $this->userService->destroy($user);

        return $this->successWithData($users);
    }

}
