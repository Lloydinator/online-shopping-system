<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_customer_is_not_admin()
    {
        $user = User::factory()->make();

        $this->assertFalse($user->is_admin());
    }

    public function test_admin_user_is_admin()
    {
        $admin = User::factory()->admin()->make();

        $this->assertTrue($admin->is_admin());
    }

    public function test_admin_can_view_all_users()
    {
        $admin = User::factory()->admin()->make();

        $response = $this->actingAs($admin)->get(route('all-users'));

        $response->assertStatus(200);
    }

    public function test_admin_can_create_users()
    {
        $admin = User::factory()->admin()->make();
        
        $response = $this->actingAs($admin)->post(route('create-user'), [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $response->assertRedirect(route('all-users'));
    }

    public function test_customer_cannot_create_users()
    {
        $customer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $response = $this->actingAs($customer)->post(route('create-user'), [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_edit_users()
    {
        $customer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $admin = User::factory()->admin()->make();

        $response = $this->actingAs($admin)->post(route('edit-user', $customer->id), [
            'name' => $this->faker->name()
        ]);

        $response->assertRedirect(route('all-users'));
    }

    public function test_customer_cannot_edit_users()
    {
        $customer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $fake_admin = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $response = $this->actingAs($fake_admin)->post(route('edit-user', $customer->id), [
            'name' => $this->faker->name()
        ]);

        $response->assertStatus(403);
        
    }

    public function test_admin_can_delete_users()
    {
        $customer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $admin = User::factory()->admin()->make();

        $response = $this->actingAs($admin)->post(route('delete-user', $customer->id));

        $response->assertRedirect(route('all-users'));
    }

    public function test_customer_cannot_delete_users()
    {
        $customer = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $fake_admin = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'favorite_food' => 'chicken',
            'role_id' => 1,
            'password' => 'passWord_1234',
        ]);

        $response = $this->actingAs($fake_admin)->post(route('edit-user', $customer->id));

        $response->assertStatus(403);
    }

    public function test_admin_can_see_total_spend_per_customer()
    {
        //
    }
}
