<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    // Admin
    public function test_admin_can_view_all_users()
    {
        
    }

    public function test_admin_can_create_users()
    {
        $admin = User::factory()->admin()->make();
        
        //$response = $this->actingAs($admin)->;
    }

    public function test_admin_can_edit_users()
    {
        //
    }

    public function test_admin_can_delete_users()
    {
        //
    }

    public function test_admin_can_see_total_spend_per_customer()
    {
        //
    }
}
