<?php

namespace Tests\Unit\Http\Middleware;

use Mockery;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\EnsureEmailIsVerified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedTest extends TestCase
{
    public function test_handle_with_verified_email()
    {
        // Mock the user with a verified email
        $mockUser = Mockery::mock(MustVerifyEmail::class);
        $mockUser->shouldReceive('hasVerifiedEmail')->andReturn(true);

        // Mock the request and return the mock user
        $mockRequest = Mockery::mock(Request::class);
        $mockRequest->shouldReceive('user')->andReturn($mockUser);

        // Pass an actual closure, don't mock it
        $next = function () {
            return new Response('OK', 200);
        };

        // Instantiate the middleware and call the handle method
        $middleware = new EnsureEmailIsVerified();
        $response = $middleware->handle($mockRequest, $next);

        // Assert that the response is 200 (success)
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getContent());
    }

    public function test_handle_with_unverified_email()
    {
        // Mock the user with an unverified email
        $mockUser = Mockery::mock(MustVerifyEmail::class);
        $mockUser->shouldReceive('hasVerifiedEmail')->andReturn(false);

        // Mock the request and return the mock user
        $mockRequest = Mockery::mock(Request::class);
        $mockRequest->shouldReceive('user')->andReturn($mockUser);

        // Pass an actual closure
        $next = function () {
            return new Response('OK', 200);
        };

        // Instantiate the middleware and call the handle method
        $middleware = new EnsureEmailIsVerified();
        $response = $middleware->handle($mockRequest, $next);

        // Assert that the response is 409 (email not verified)
        $this->assertEquals(409, $response->getStatusCode());
        $this->assertEquals('Your email address is not verified.', $response->getData()->message);
    }

    public function test_handle_with_no_user()
    {
        // Mock the request where no user is logged in
        $mockRequest = Mockery::mock(Request::class);
        $mockRequest->shouldReceive('user')->andReturn(null);

        // Pass an actual closure
        $next = function () {
            return new Response('OK', 200);
        };

        // Instantiate the middleware and call the handle method
        $middleware = new EnsureEmailIsVerified();
        $response = $middleware->handle($mockRequest, $next);

        // Assert that the response is 409 (no user)
        $this->assertEquals(409, $response->getStatusCode());
        $this->assertEquals('Your email address is not verified.', $response->getData()->message);
    }
}
