<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'The Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password1'),
                'favorite_food' => 'Chop suey',
                'role_id' => 0,
                'created_at' => now()->toDateTimeString()
            ],
            [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password2'),
                'favorite_food' => 'Chicken pizza',
                'role_id' => 1,
                'created_at' => now()->toDateTimeString()
            ],
            [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password3'),
                'favorite_food' => 'Spaghetti and meatballs',
                'role_id' => 1,
                'created_at' => now()->toDateTimeString()
            ]
        ]);
    }
}
