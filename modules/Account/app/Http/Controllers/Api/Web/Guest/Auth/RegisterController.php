<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Guest\Auth;

use App\Http\Controllers\BaseController;
use Modules\Account\app\Contracts\Services\UserServiceInterface;
use Modules\Account\app\Http\Requests\Auth\RegisterRequest;

class RegisterController extends BaseController
{

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $this->userService->store($request);

        return $this->successWithData('Registration successful! Welcome aboard.');
    }

}
