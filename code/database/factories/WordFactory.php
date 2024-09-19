<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    protected $model = \App\Models\Word::class;

    public function definition()
    {
        return [
            'text' => $this->faker->word(),
            'type' => $this->faker->randomElement(['noun', 'verb', 'adjective']),
            'definition' => $this->faker->sentence(),
            'example' => $this->faker->sentence()
        ];
    }
}
