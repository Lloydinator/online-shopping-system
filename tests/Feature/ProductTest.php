<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_admin_can_view_all_products()
    {
        $admin = User::factory()->admin()->make();

        $response = $this->actingAs($admin)->get(route('all-products'));

        $response->assertStatus(200);
    }

    public function test_customer_cannot_view_all_products()
    {
        $customer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $response = $this->actingAs($customer)->get(route('all-products'));

        $response->assertStatus(403);
    }

    public function test_anyone_can_create_products()
    {
        $producer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $response = $this->actingAs($producer)->post(route('create-product'), [
            'user_id' => $producer->id,
            'description' => 'Hi',
            'price' => 2.99,
        ]);

        $response->assertRedirect(route('all-products'));
    }

    public function test_anyone_can_edit_products()
    {
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $product = Product::create([
            'user_id' => $user->id,
            'description' => 'Hi',
            'price' => 2.99,
        ]);

        $response = $this->actingAs($user)->post(route('edit-product', $product->id), [
            'description' => $this->faker->sentence()
        ]);

        $response->assertRedirect(route('all-products'));
    }

    public function test_anyone_can_delete_products()
    {
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $product = Product::create([
            'user_id' => $user->id,
            'description' => 'Hi',
            'price' => 2.99,
        ]);

        $response = $this->actingAs($user)->post(route('delete-product', $product->id));

        $response->assertRedirect(route('all-products'));
    }
}
