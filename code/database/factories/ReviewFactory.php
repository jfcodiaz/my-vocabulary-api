<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Word;

class ReviewFactory extends Factory
{
    protected $model = \App\Models\Review::class;

    public function definition()
    {
        return [
            'word_id' => Word::factory(),  // Esto creará una palabra automáticamente si no se especifica una
            'review_date' => $this->faker->date(),
            'proficiency_level' => $this->faker->numberBetween(1, 5)
        ];
    }
}
