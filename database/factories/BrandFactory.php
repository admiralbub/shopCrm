<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'h1_ua' => $this->faker->sentence(3),
            'h1_ru' => $this->faker->sentence(3),
            'name_ru' => $this->faker->company,
            'name_ua' => $this->faker->company,
            'images' => $this->faker->image(storage_path('app/public/images_brand'), 50, 50),
            'description_ru' => $this->faker->paragraph,
            'description_ua' => $this->faker->paragraph,
            'slug' => Str::slug($this->faker->company),
            'status' => 1,
            'meta_description_ru' => $this->faker->sentence,
            'meta_description_ua' => $this->faker->sentence,
            'meta_title_ru' => $this->faker->sentence(3),
            'meta_title_ua' => $this->faker->sentence(3),
            'created_at' => now(),
            'meta_keywords_ua' => $this->faker->words(5, true),
            'meta_keywords_ru' => $this->faker->words(5, true),
        ];
    }
}
