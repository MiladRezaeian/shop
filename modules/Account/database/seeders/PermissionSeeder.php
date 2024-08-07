<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Account\app\Models\Permission;
use Modules\Account\database\factories\PermissionFactory;

class PermissionSeeder extends Seeder
{

    protected $names;
    protected $translations;

    public function __construct()
    {
        $this->names = [
            'View Posts',
            'Create Posts',
            'Update Posts',
            'Delete Posts',
            'View Users',
            'Manage Users'
        ];

        $this->translations = [
            'View Posts',
            'Create Posts',
            'Update Posts',
            'Delete Posts',
            'View Users',
            'Manage Users'
        ];
    }

    public function run()
    {
        foreach ($this->names as $index => $name) {
            $translation = $this->translations[$index] ?? '';
            Permission::create([
                'name' => $name,
                'translated_name' => $translation,
            ]);
        }
    }

}
