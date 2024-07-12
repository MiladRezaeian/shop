<?php

namespace Modules\Account\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\app\Models\Permission;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Permission>
 */
class PermissionFactory extends Factory
{

    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'View Posts',
            'Create Posts',
            'Update Posts',
            'Delete Posts',
            'View Users',
            'Manage Users'
        ];

        $translations = [
            'View Posts',
            'Create Posts',
            'Update Posts',
            'Delete Posts',
            'View Users',
            'Manage Users'

        ];

        return [
            'name' => $names[rand(0, count($names) - 1)],
            'translated_name' => $translations[rand(0, count($translations) - 1)]
        ];
    }
}
