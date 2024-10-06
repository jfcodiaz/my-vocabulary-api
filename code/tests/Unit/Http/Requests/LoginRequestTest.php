<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Event;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequestTest extends TestCase
{
    public function testEnsureIsNotRateLimited()
    {
        Event::fake();
        RateLimiter::shouldReceive('tooManyAttempts')
            ->once()
            ->with('test@example.com|127.0.0.1', 5)
            ->andReturn(true);

        RateLimiter::shouldReceive('availableIn')
            ->once()
            ->with('test@example.com|127.0.0.1')
            ->andReturn(60);

        $request = new LoginRequest();
        $request->merge(['email' => 'test@example.com']);
        $request->server->set('REMOTE_ADDR', '127.0.0.1');

        try {
            $request->ensureIsNotRateLimited();
        } catch (ValidationException $e) {
            $this->assertEquals(
                trans('auth.throttle', ['seconds' => 60, 'minutes' => 1]),
                $e->errors()['email'][0]
            );
        }

        Event::assertDispatched(Lockout::class);
    }
}
