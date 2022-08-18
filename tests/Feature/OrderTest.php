<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_db()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_order()
    {

    }

    public function test_watcher_order()
    {

    }

    public function test_open_position()
    {

    }

    public function test_close_position()
    {

    }
}
