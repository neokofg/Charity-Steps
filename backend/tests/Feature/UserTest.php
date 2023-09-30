<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            "name" => "testUser"
        ]);
    }

    public function test_getToken()
    {
        $token = $this->user->createToken('')->plainTextToken;
        $response = $this->json('GET', '/api/user/get', [],['Authorization' => 'Bearer '. $token]);
        $response->assertStatus(200);
        $response->assertJson([
            "user" => [
                "name" => "testUser"
            ]
        ]);
    }
}
