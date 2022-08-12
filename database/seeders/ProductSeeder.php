<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'user_id' => 1,
                'description' => "This is a white piece of paper",
                'price' => 10.89,
                'created_at' => now()->toDateTimeString()
            ],
            [
                'user_id' => 2,
                'description' => "This is a black pen",
                'price' => 19.99,
                'created_at' => now()->toDateTimeString()
            ]
        ]);
    }
}
