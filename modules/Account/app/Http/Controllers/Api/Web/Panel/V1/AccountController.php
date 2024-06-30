<?php

namespace Modules\Account\app\Http\Controllers\Api\Web\Panel\V1;

use App\Http\Controllers\BaseController;
use Modules\Account\app\Contracts\AccountServiceInterface;

class AccountController extends BaseController
{

    private AccountServiceInterface $accountService;

    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index()
    {
        $result = $this->accountService->index();

        return $this->successWithData($result);
    }

}
