<?php

namespace Modules\Account\app\Contracts\Repositories;

use Modules\Account\app\Models\User;

interface UserRepositoryInterface
{

    public function create(array $data);

}
