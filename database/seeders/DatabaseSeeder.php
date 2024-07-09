<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public static $seeders = [];

    public static function addSeeders(array $seeders)
    {
        foreach (self::$seeders as $seeder) {
            if (!in_array($seeder, $seeders)) {
                $seeders[] = $seeder;
            }
        }

        self::$seeders = $seeders;
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (self::$seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
