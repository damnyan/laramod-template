<?php

namespace Modules\Administrator\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Administrator\Models\Administrator;
use Modules\File\Tests\Helpers\FakeFile;

class AdministratorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Administrator::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'email' => fake()->email,
            'password' => '123123123',
            'face_url' => FakeFile::uploadImage(),
            'first_name' => fake()->firstName,
            'middle_name' => fake()->lastName,
            'last_name' => fake()->lastName,
            'suffix' => fake()->suffix,
        ];
    }
}

