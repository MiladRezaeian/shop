<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Account\database\factories\RoleFactory;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleFactory::new()->count(6)->create();
    }
}
