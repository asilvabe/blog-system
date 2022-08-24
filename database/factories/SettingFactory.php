<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'objective'=> "Manejar Post de Participantes",
            'purpose'=> "La idea es crear un proyecto que sea capaz de competir con las redes de mercado",
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
