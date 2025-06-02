<?php

namespace Tests\Feature\Auth;

use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_usuarios_can_authenticate_using_the_login_screen(): void
    {
        $usuario = Usuario::factory()->create();

        $response = $this->post('/login', [
            'email' => $usuario->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_usuarios_can_not_authenticate_with_invalid_password(): void
    {
        $usuario = Usuario::factory()->create();

        $this->post('/login', [
            'email' => $usuario->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_usuarios_can_logout(): void
    {
        $usuario = Usuario::factory()->create();

        $response = $this->actingAs($usuario)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
