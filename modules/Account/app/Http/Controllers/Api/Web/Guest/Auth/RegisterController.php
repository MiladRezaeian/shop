<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Guest\Auth;

use App\Http\Controllers\BaseController;
use Modules\Account\app\Http\Requests\Auth\RegisterRequest;
use Modules\Account\app\Services\UserService;

class RegisterController extends BaseController
{

    public function register(RegisterRequest $request)
    {
        resolve(UserService::class)->store($request);

        return $this->successWithData('Registration successful! Welcome aboard.');
    }

}
