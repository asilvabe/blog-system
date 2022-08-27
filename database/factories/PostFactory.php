<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence(3),
            'body'=> $this->faker->paragraph(),
            'created_by' => User::factory(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
