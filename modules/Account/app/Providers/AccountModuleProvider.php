<?php

namespace Modules\Account\app\Providers;

use Illuminate\Support\Facades\App;
use Modules\Account\app\Contracts\AccountServiceInterface;
use Modules\Account\app\Services\AccountService;
use Modules\BaseModuleProvider;

class AccountModuleProvider extends BaseModuleProvider
{

    public function register()
    {
        parent::register();

        App::bind(AccountServiceInterface::class, AccountService::class);
    }

}
