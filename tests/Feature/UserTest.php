<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Watcher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
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

    public function test_auth()
    {
        $user = User::factory()->create();
    }

    public function test_logout()
    {

    }

    public function test_watcher()
    {
        User::factory()
            ->has(Watcher::factory()->count(3))
            ->create();
    }
}
