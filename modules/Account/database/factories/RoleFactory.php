<?php

namespace Modules\Account\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\app\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Role>
 */
class RoleFactory extends Factory
{

    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Admin',
            'Editor',
            'Author',
            'Moderator',
            'Reviewer',
            'Contributor'
        ];

        $translations = [
            'Administrator',
            'Editor',
            'Author',
            'Moderator',
            'Reviewer',
            'Contributor'
        ];

        return [
            'name' => $names[rand(0, count($names) - 1)],
            'translated_name' => $translations[rand(0, count($translations) - 1)]
        ];
    }
}
