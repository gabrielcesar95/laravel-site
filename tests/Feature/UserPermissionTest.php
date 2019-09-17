<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPermissionTest extends TestCase
{
    /** @test */
    public function normal_user_cannot_show_users()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('admin.user.index'));

        $response->assertForbidden();
    }

    /** @test */
    public function allowed_admin_user_can_show_users()
    {
        $user = factory(User::class)->create();

        $user->assignRole('admin');
        $user->givePermissionTo('user@index');

        $this->actingAs($user);

        $response = $this->get(route('admin.user.index'));

        $response->assertOk();
    }

    /** @test */
    public function unallowed_admin_user_cannot_show_users()
    {
        $user = factory(User::class)->create();

        $user->assignRole('admin');

        $this->actingAs($user);

        $response = $this->get(route('admin.user.index'));

        $response->assertForbidden();
    }
}
