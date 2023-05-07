<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
      public function definition()
    {
        $faker = (new \Faker\Factory())::create();

        return [
        'name'=>$faker->name(),
        'description'=>$faker->paragraph(), 
        'image'=>$faker->imageUrl($width = 400, $height = 400), 
        ];
    }
}
