<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Enums\UserRoleEnum;

class FoodPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discounts')->insert([
            'name'=> 'Food Party',
            'user_id' => User::query()->whereRole(UserRoleEnum::ADMIN->value)->first()->id,
            'percentage' => '25'
        ]);
    }
}
