<?php

namespace Modules\Account\app\Services;

use Modules\Account\app\Contracts\AccountServiceInterface;

class AccountService implements AccountServiceInterface
{

    public function index()
    {
        return ['key'=>'value'];
    }

}
