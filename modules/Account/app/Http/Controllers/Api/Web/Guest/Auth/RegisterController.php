<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Guest\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Account\app\Http\Requests\Auth\RegisterRequest;
use Modules\Account\app\Models\User;
use Modules\Account\app\Services\UserService;

class RegisterController extends BaseController
{

    public function register(RegisterRequest $request)
    {
        (new UserService)->register($request);

        return $this->successWithData('Registration successful! Welcome aboard.');
    }

}
