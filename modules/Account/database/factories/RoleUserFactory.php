<?php

namespace Modules\Account\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\app\Models\Permission;
use Modules\Account\app\Models\Role;
use Modules\Account\app\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<RoleUserFactory>
 */
class RoleUserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id' => Role::factory(),
            'user_id' => User::factory()
        ];
    }

}
