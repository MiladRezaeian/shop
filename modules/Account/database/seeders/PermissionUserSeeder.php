<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Modules\Account\database\factories\PermissionUserFactory;

class PermissionUserSeeder extends Seeder
{

    public function run()
    {
        $data = [
            ['user_id' => 1, 'permission_id' => 1],
            ['user_id' => 2, 'permission_id' => 2],
            ['user_id' => 3, 'permission_id' => 3],
            ['user_id' => 4, 'permission_id' => 4],
            ['user_id' => 5, 'permission_id' => 5]
        ];

        DB::table('permission_user')->insert($data);

//        $factory = PermissionUserFactory::new();
//        $factory->count(5)->create();
    }

}
