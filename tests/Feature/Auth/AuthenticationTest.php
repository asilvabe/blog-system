<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_screen_can_be_rendered(): void
    {
        $this
            ->get('/login')
            ->assertOk();
    }

    /** @test */
    public function users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $this
            ->post('/login', $data)
            ->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();
    }

    /** @test */
    public function users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => 'wrong-password',
        ];

        $this
            ->post('/login', $data)
            ->assertSessionHasErrors();

        $this->assertGuest();
    }
}
