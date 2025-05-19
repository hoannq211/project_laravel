<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_user_can_register_with_valid(): void
    {
        $role = \App\Models\Role::factory()->create(['id' => 2, 'name' => 'user']);

        $response = $this->post('/register', [
            'name' => 'Hoàn',
            'email' => 'hoan@gmail.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'terms' => 'on',
        ]);
        $response->dump();

        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', [
            'email' => 'hoan@gmail.com',
        ]);
    }
}
