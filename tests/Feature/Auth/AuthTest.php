<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    private $user;
    protected function setUp(): void
    {
        parent::setUp();
        User::truncate();
        $this->user = User::factory()->create(['password' => bcrypt('heri')]);
    }

    public function test_login(){
        $response = $this->post('/api/login', [
            'email' => $this->user->email,
            'password' => 'heri'
        ]);
        $response->dump();
        $response->assertJsonStructure([
            'data'
        ]);
    }

    public function test_register(){
        $response = $this->post('/api/register', [
            'name' => 'admin',
            'email' => 'admin@cc.cc',
            'password' => bcrypt('admin')
        ]);

        $response->dump();
        $response->assertJson([
            'message' => "User created successfully"
        ]);
    }

    public function test_get_user_data(){
        $token = \JWTAuth::fromUser($this->user);
        $response = $this->get('api/who', [
            'HTTP_Authorization' => 'Bearer ' . $token
        ]);
        $response->dump();
        $response->assertJson([
            'data' => [
                'name' => $this->user->name
            ]
        ]);
    }

    public function test_logout(){
        $token = \JWTAuth::fromUser($this->user);
        $response = $this->get('api/logout', [
            'HTTP_Authorization' => 'Bearer ' . $token
        ]);
        $response->dump();
        $response->assertJson([
            'message' => 'User Logout'
        ]);
    }
}
