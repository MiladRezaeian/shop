<?php

namespace Modules\Account\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Account\app\Models\User;
use Modules\File\app\Models\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<File>
 */
class FileFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $faker->word,
            'description' => $faker->sentence,
            'path' => 'files/'.$faker->unixTime(),
            'is_public' => $faker->boolean,
            'verified' => $faker->boolean,
            'size' => $faker->randomNumber(),
            'mime_type' => $faker->mimeType,
            'polymorphic_type' => 'App\Models\Post',
            'polymorphic_id' => 1,
            'user_id' => function() {
                return User::factory();
            },
        ];
    }

}
