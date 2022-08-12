<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_customers_can_give_themselves_discounts()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_can_change_discount_after_order()
    {
        //
    }
}
