<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'h1_ua' => $this->faker->sentence(3),
            'h1_ru' => $this->faker->sentence(3),
            'name_ru' => $this->faker->word,
            'name_ua' => $this->faker->word,
            'description_ru' => $this->faker->paragraph,
            'description_ua' => $this->faker->paragraph,
            'slug' => Str::slug($this->faker->word),
            'sort' => $this->faker->numberBetween(1, 100),
            'category_id' => null, // или присвоить id родительской категории, если требуется
            'is_top' => $this->faker->boolean,
            'icon' => '',
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
