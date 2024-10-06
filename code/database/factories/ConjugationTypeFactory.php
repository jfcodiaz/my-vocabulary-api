<?php

namespace Database\Factories;

use App\Models\ConjugationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConjugationTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConjugationType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
