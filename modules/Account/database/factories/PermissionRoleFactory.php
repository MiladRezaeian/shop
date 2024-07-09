<?php

namespace Modules\Account\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\app\Models\Permission;
use Modules\Account\app\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<PermissionRoleFactory>
 */
class PermissionRoleFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'permission_id' => Permission::factory(),
            'role_id' => Role::factory()
        ];
    }

}
