<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 2],
            ['permission_id' => 3, 'role_id' => 3],
            ['permission_id' => 4, 'role_id' => 4],
            ['permission_id' => 5, 'role_id' => 5]
        ];

        DB::table('permission_role')->insert($data);
    }

}
