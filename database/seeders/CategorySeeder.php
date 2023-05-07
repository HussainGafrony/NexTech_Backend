<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // category::truncate();
        return category::factory()->count(50)->create();
    }
}
