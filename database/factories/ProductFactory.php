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
    public function definition()
    {
        $title = fake()->name();
        return [
            'category_id' => fake()->numberBetween($min = 1, $max = 50),
            'name' => $title,
            'slug' => Str::slug($title),
            'stock' => fake()->randomElement(['instock','outofstock']),
            'SKU' => fake()->text($maxNbChars = 10),
            'quantity' => fake()->numberBetween($min = 1, $max = 50),
            'price' => fake()->numberBetween($min = 1000, $max = 10000),
            'sale_price' => fake()->numberBetween($min = 1000, $max = 10000),
            'rating' => 'rating',
            'short_description' => fake()->text($maxNbChars = 100),
            'options' => fake()->randomElement(['S','M','L']),
            'description' => fake()->text($maxNbChars = 500),
            'tags' => $title,
            'image' => 'No image found',
            'images' => 'No image found',
            'downloaded' => fake()->numberBetween($min = 1, $max = 1000),
            'recommended' => fake()->boolean,
            'condition' => fake()->boolean,
            'status' => fake()->randomElement(['DEACTIVE','ACTIVE', 'UPCOMING']),
        ];
    }
}
