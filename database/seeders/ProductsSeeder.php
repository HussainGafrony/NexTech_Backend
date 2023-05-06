<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\products;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        products::truncate();
        return products::factory()->count(250)->create();
    }
}
