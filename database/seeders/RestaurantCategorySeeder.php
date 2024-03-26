<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RestaurantCategory;
use Illuminate\Support\Facades\DB;

class RestaurantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Fast Food'],
            ['name' => 'Persian Food'],
            ['name' => 'Sea Food'],
            ['name' => 'Café']
        ];

        DB::table('restaurant_categories')->insert($data);
    }
}
