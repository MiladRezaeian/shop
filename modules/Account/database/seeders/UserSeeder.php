<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Account\app\Models\User;
use Modules\Account\database\factories\UserFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::factory()->count(5)->create();
//        UserFactory::class->count(5)->create();
        $factory = UserFactory::new();

        $factory->count(10)->create();
    }
}
