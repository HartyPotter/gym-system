<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'fullname' => 'Admin User',
                'image' => null,
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456789'),
                'phone' => '0123456789',
                'gender' => 'male',
                'user_type' => 'admin',
                'specialization' => null,
                'status' => 'online',
                'is_open' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Customer User',
                'image' => null,
                'username' => 'customer1',
                'email' => 'customer1@example.com',
                'password' => Hash::make('123456789'),
                'phone' => '0123456790',
                'gender' => 'female',
                'user_type' => 'customer',
                'specialization' => null,
                'status' => 'offline',
                'is_open' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Customer',
                'image' => null,
                'username' => 'customer2',
                'email' => 'customer2@example.com',
                'password' => Hash::make('123456789'),
                'phone' => '01033251393',
                'gender' => 'male',
                'user_type' => 'customer',
                'specialization' => null,
                'status' => 'offline',
                'is_open' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Trainer User',
                'image' => null,
                'username' => 'trainer1',
                'email' => 'trainer1@example.com',
                'password' => Hash::make('123456789'),
                'phone' => '0123456791',
                'gender' => 'prefer not to say',
                'user_type' => 'trainer',
                'specialization' => 'Fitness',
                'status' => 'online',
                'is_open' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
