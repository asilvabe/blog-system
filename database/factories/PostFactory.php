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
            'title'=> $this->faker->word(),
            'body'=> $this->faker->paragraph(),
            'user_id' => User::factory(),
            'approved_at' => null,
            'approved_by' => null,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
