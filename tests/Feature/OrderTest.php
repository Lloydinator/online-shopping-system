<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_customers_can_give_themselves_discounts()
    {
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        //$response->assertStatus(200);
    }

    public function test_admin_can_change_discount_after_order()
    {
        //
    }
}
