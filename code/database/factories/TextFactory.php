<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TextFactory extends Factory
{
    protected $model = \App\Models\Text::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),  // Esto creará un usuario automáticamente si no se especifica uno
            'content' => $this->faker->paragraph(),
            'source' => $this->faker->sentence()
        ];
    }
}
