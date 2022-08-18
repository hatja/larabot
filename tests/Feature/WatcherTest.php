<?php

namespace Tests\Feature;

use App\Models\Watcher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WatcherTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_db()
    {
        Watcher::factory()->count(10)->make();
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_update()
    {

    }

    public function test_user_watcher()
    {
    }

    public function test_price_change()
    {

    }

}
