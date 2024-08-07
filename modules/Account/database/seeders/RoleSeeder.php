<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Account\app\Models\Role;
use Modules\Account\database\factories\RoleFactory;

class RoleSeeder extends Seeder
{

    protected $names;
    protected $translations;

    public function __construct()
    {
        $this->names = [
            'Admin',
            'Editor',
            'Author',
            'Moderator',
            'Reviewer',
            'Contributor'
        ];

        $this->translations = [
            'Administrator',
            'Editor',
            'Author',
            'Moderator',
            'Reviewer',
            'Contributor'
        ];
    }


    public function run()
    {
        foreach ($this->names as $index => $name) {
            $translation = $this->translations[$index] ?? '';
            Role::create([
                'name' => $name,
                'translated_name' => $translation,
            ]);
        }
    }

}
