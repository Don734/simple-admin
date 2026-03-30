<?php

namespace Tests\Feature\Admin\Navigation;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_user_can_open_main_admin_pages(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('admin.settings'))
            ->assertOk();
    }
}
