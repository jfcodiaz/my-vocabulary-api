<?php

namespace Tests;

use Mockery;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    protected function loginAsDefaultUser(): User
    {
        $user = User::where('email', 'user@serv.com')->first();
        $this->actingAs($user);

        return $user;
    }

    protected function loginAsDefaultAdmin(): User
    {
        $admin = User::where('email', 'admin@serv.com')->first();
        $this->actingAs($admin);

        return $admin;
    }

    public function logout(): self
    {
        auth()->logout();

        return $this;
    }
}
