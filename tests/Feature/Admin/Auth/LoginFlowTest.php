<?php

namespace Tests\Feature\Admin\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_open_admin_login_page(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk();
        $response->assertSee('Sign In', false);
    }

    public function test_user_can_login_with_email(): void
    {
        $user = User::factory()->create([
            'password' => 'secret123',
        ]);

        $response = $this->post(route('admin.login.process'), [
            'login' => $user->email,
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_can_login_with_phone(): void
    {
        $user = User::factory()->create([
            'phone' => '+12345678901',
            'password' => 'secret123',
        ]);

        $response = $this->post(route('admin.login.process'), [
            'login' => '+12345678901',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_returns_error_for_invalid_credentials(): void
    {
        User::factory()->create([
            'password' => 'secret123',
        ]);

        $response = $this->from(route('admin.login'))->post(route('admin.login.process'), [
            'login' => 'wrong@example.com',
            'password' => 'bad-password',
        ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHasErrors('login');
        $this->assertGuest();
    }

    public function test_authenticated_user_is_redirected_away_from_login_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.login'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
