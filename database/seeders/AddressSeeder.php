<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return address::factory()->count(50)->create();
    }
}
