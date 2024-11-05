<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ua' => $this->faker->word(),
            'name_ru' => $this->faker->word(),
            'h1_ua' => $this->faker->sentence(),
            'h1_ru' => $this->faker->sentence(),
            'meta_title_ua' => $this->faker->sentence(),
            'meta_title_ru' => $this->faker->sentence(),
            'meta_description_ua' => $this->faker->paragraph(),
            'meta_description_ru' => $this->faker->paragraph(),
            'meta_keywords_ua' => $this->faker->words(5, true),
            'meta_keywords_ru' => $this->faker->words(5, true),
            'image' => '/storage/app/public/images_product/2024/10/06/d6cad4d9f4f6065e15264a427a51eb5a47138c02.png',
            'description_ua' => $this->faker->paragraph(),
            'description_ru' => $this->faker->paragraph(),
            'brand_id' =>  \App\Models\Brand::factory(),
            'stock_id' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'price_stock' => $this->faker->randomFloat(2, 5, 450),
            'status' => 1,
            'is_new' => $this->faker->boolean(),
            'old_price' => $this->faker->randomFloat(2, 20, 600),
            'is_top' => $this->faker->boolean(),
            'unit' => 1,
            'is_recommender' => $this->faker->boolean(),
            'wholesale' => $this->faker->randomFloat(2, 50, 200),
            'is_publish' => 1,
            'is_sale' => $this->faker->boolean(),
            'slug' => Str::slug($this->faker->unique()->word, '-'),
            'hide_from_categories' => $this->faker->boolean(),
        ];
    }
}
