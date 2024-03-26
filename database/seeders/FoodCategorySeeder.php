<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Sea Food'],
            ['name' => 'Fast Food'],
            ['name' => 'Steake'],
            ['name' => 'Farengi Food'],
            ['name' => 'Persean Food']
        ];

        DB::table('food_categories')->insert($data);
    }
}
