<?php

namespace Modules\Account\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\app\Models\Permission;
use Modules\Account\app\Models\PermissionUser;
use Modules\Account\app\Models\Role;
use Modules\Account\app\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<PermissionUserFactory>
 */
class PermissionUserFactory extends Factory
{

//    protected $model = [
//        PermissionUser::class => PermissionUserFactory::class,
//    ];


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'permission_id' => Permission::factory(),
            'user_id' => User::factory()
        ];
    }

}
