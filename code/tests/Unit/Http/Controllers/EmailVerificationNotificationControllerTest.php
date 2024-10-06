<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;
use App\Models\User;

class EmailVerificationNotificationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_notification_is_sent_when_not_verified()
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'email_verified_at' => null,
        ]);

        // Mock the request
        $request = Request::create('/email/verification-notification', 'POST');

        // Mock the Notification facade
        Notification::fake();

        // Act as the created user
        $this->actingAs($user);

        // Bind the authenticated user to the request
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        // Create an instance of the controller
        $controller = new EmailVerificationNotificationController();

        // Call the store method
        $response = $controller->store($request);

        // Assert the response
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['status' => 'verification-link-sent'], $response->getData(true));

        // Assert the notification was sent
        Notification::assertSentTo(
            [$user], VerifyEmail::class
        );
    }

    public function test_redirects_when_email_is_already_verified()
    {
        // Create a user with a verified email
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'email_verified_at' => now(),
        ]);

        // Mock the request
        $request = Request::create('/email/verification-notification', 'POST');

        // Act as the created user
        $this->actingAs($user);

        // Bind the authenticated user to the request
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        // Create an instance of the controller
        $controller = new EmailVerificationNotificationController();

        // Call the store method
        $response = $controller->store($request);

        // Assert the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(url('/dashboard'), $response->getTargetUrl());
    }
}
