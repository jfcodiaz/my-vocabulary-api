<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    protected $model = \App\Models\Word::class;

    public function definition()
    {
        return [
            'word' => $this->faker->unique()->word(),
            'creator' => \App\Models\User::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
