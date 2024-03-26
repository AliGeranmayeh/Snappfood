<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hasAdmin = User::whereRole('admin')->whereEmail('admin@admin.com')->exists();
        if (!$hasAdmin) {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'phone_number' => rand(10000000000, 99999999999),
                'role' => 'admin',
                'password' => Hash::make('admin'), // password
                'remember_token' => Str::random(10),
            ]);
        }
        dump('The admin specifications is:');
        dump('email: admin@admin.com');
        dump('password: admin');

    }
}
