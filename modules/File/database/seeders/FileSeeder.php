<?php

namespace Modules\File\database\seeders;

use Illuminate\Database\Seeder;
use Modules\File\app\Models\File;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::factory()
            ->count(100)
            ->create();
    }
}
