<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\address;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\address>
 */
class AddressFactory extends Factory
{
   
    public function definition()
    {
        $faker = (new \Faker\Factory ())::create();
        return [
            'address_line_1' => $faker->address,
            'user_id' => User::inRandomOrder()->first()->id,
            'city' => $faker->city,
            'default' => 0,
            'country' => $faker->country,
            'postcode' => $faker->numberBetween(1000, 1020),
            'phone' => $faker->phoneNumber,

        ];
    }
}
