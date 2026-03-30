<?php

namespace Tests\Feature\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersDataEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_users_data_endpoint(): void
    {
        $response = $this->getJson(route('admin.users.data'));

        $response->assertStatus(401);
    }

    public function test_authenticated_user_gets_datatable_payload(): void
    {
        $authUser = User::factory()->create();
        User::factory()->count(3)->create();

        $response = $this->actingAs($authUser)->getJson(route('admin.users.data', [
            'draw' => 2,
            'start' => 0,
            'length' => 10,
            'order' => [
                ['column' => 0, 'dir' => 'desc'],
            ],
            'search' => [
                'value' => '',
            ],
        ]));

        $response->assertOk();
        $response->assertJsonStructure([
            'draw',
            'recordsTotal',
            'recordsFiltered',
            'data' => [
                ['id', 'name', 'email', 'registered', 'status', 'actions'],
            ],
        ]);
        $response->assertJsonPath('draw', 2);
        $this->assertGreaterThanOrEqual(4, $response->json('recordsTotal'));
    }

    public function test_users_data_endpoint_applies_search_filter(): void
    {
        $authUser = User::factory()->create();
        User::factory()->create([
            'first_name' => 'Target',
            'last_name' => 'User',
            'email' => 'target@example.com',
        ]);
        User::factory()->create([
            'first_name' => 'Another',
            'last_name' => 'Person',
            'email' => 'another@example.com',
        ]);

        $response = $this->actingAs($authUser)->getJson(route('admin.users.data', [
            'draw' => 1,
            'start' => 0,
            'length' => 10,
            'search' => [
                'value' => 'Target',
            ],
        ]));

        $response->assertOk();
        $this->assertSame(1, $response->json('recordsFiltered'));
        $this->assertCount(1, $response->json('data'));
        $this->assertStringContainsString('Target User', (string) data_get($response->json('data'), '0.name'));
    }
}
