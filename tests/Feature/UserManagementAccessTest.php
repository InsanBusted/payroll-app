<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_superadmin_can_access_user_management(): void
    {
        $role = Role::create(['name' => 'superadmin', 'display_name' => 'Super Admin']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertOk();
    }

    public function test_finance_can_access_user_management(): void
    {
        $role = Role::create(['name' => 'finance', 'display_name' => 'Finance']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertOk();
    }

    public function test_other_roles_cannot_access_user_management(): void
    {
        $role = Role::create(['name' => 'staff', 'display_name' => 'Staff']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(403);
    }

    public function test_unassigned_role_cannot_access_user_management(): void
    {
        $user = User::factory()->create(['role_id' => null]);

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(403);
    }
}
