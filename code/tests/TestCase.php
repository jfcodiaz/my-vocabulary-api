<?php

namespace Tests;

use Mockery;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $faker;

    private User|null $defaultUser = null;
    private User|null $defaultAdmin = null;

    private string $defaultUserEmail;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->defaultUserEmail = config('app.defaults.users.defaultUser');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    protected function getDefaultUser(): User
    {
        if ($this->defaultUser === null) {
            $this->defaultUser = User::where('email', $this->defaultUserEmail)->first();
        }

        return $this->defaultUser;
    }

    protected function loginAsDefaultUser(): User
    {
        $this->actingAs($this->getDefaultUser());

        return $this->getDefaultUser();
    }

    protected function getDefaultAdmin(): User
    {
        $adminEmail = config('app.defaults.users.defaultAdmin');
        if ($this->defaultAdmin === null) {
            $this->defaultAdmin = User::where('email', $adminEmail)->first();
        }

        return $this->defaultAdmin;
    }

    protected function loginAsDefaultAdmin(): User
    {
        $this->actingAs($this->getDefaultAdmin());

        return $this->getDefaultAdmin();
    }

    public function logout(): self
    {
        auth()->logout();

        return $this;
    }
}
