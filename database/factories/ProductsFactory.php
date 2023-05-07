<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = (new \Faker\Factory())::create();
        return [
            'name' => $faker->name(),
            'description' => $faker->paragraph(1),
            'price' => $faker->numberBetween(1, 10),
            'image' => $faker->imageUrl($width = 400, $height = 400),
            'category_id' => category::inRandomOrder()->first()->id,
            'QTY' => $faker->numberBetween(1, 10),


        ];
    }
}