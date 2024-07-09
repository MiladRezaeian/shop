<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Account\database\factories\PermissionFactory;

class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermissionFactory::new()->count(6)->create();
    }

}
