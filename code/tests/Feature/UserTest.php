<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function test_me_endpoint_returns_authenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson(route('api.v1.user.me'));
        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    public function test_me_endpoint_forbids_guest_user()
    {
        $response = $this->getJson(route('api.v1.user.me'));
        $response->assertStatus(401);
    }
}
