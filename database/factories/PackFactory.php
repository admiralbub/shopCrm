<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pack>
 */
class PackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'volume' => $this->faker->randomFloat(2, 0.5, 100),  // объем в литрах или килограммах
            'name_ru' => $this->faker->word,
            'name_ua' => $this->faker->word,
            'status' => 1,
        ];
    }
}
