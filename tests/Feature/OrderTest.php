<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    public function test_customers_can_make_order()
    {
        $seller = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $buyer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $product = Product::create([
            'user_id' => $seller->id,
            'description' => 'Hi',
            'price' => 2.99,
        ]);

        $response = $this->actingAs($buyer)->post(route('create-order'), [
            'user_id' => $buyer->id,
            'product_id' => $product->id,
            'amount_paid' => $product->price,
            'notes' => 'Hi'
        ]);

        $response->assertRedirect(route('show-product', $product->id));
    }

    public function test_customers_can_give_themselves_discounts()
    {
        $seller = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $buyer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $product = Product::create([
            'user_id' => $seller->id,
            'description' => 'Hi',
            'price' => 2.99,
        ]);

        $discount = 1.2;

        $response = $this->actingAs($buyer)->post(route('create-order'), [
            'user_id' => $buyer->id,
            'product_id' => $product->id,
            'discount' => $discount,
            'amount_paid' => $product->price - $discount,
            'notes' => 'Hi'
        ]);

        $response->assertRedirect(route('show-product', $product->id));
    }

    /*public function test_admin_can_change_discount_after_order()
    {
        $seller = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $buyer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $admin = User::factory()->admin()->make();

        $product = Product::create([
            'user_id' => $seller->id,
            'description' => 'Hi',
            'price' => 2.99,
        ]);

        $order = Order::create([
            'user_id' => $buyer->id,
            'product_id' => $product->id,
            'discount' => 1.2,
            'amount_paid' => $product->price - 1.2,
            'notes' => 'Hi'
        ]);

        $response = $this->actingAs($admin)->post(route('edit-order', $order->id), [
           'discount' => 0.9,
           'amount_paid' => $product->price - 0.9 
        ]);

        $response->assertRedirect(route('all-orders'));
    }*/
}
