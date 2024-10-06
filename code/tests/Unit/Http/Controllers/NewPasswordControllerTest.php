<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class NewPasswordControllerTest extends TestCase
{
    public function test_store_successful_password_reset()
    {
        // Simula la creación del usuario
        $user = $this->createMock(\App\Models\User::class);
        $user->expects($this->once())
            ->method('forceFill')
            ->with($this->callback(function ($data) {
                return $data['password'] === 'hashed-new-password' && Str::length($data['remember_token']) === 60;
            }))
            ->willReturnSelf();

        $user->expects($this->once())->method('save');

        // Mockea el evento de reset de contraseña
        Event::fake();

        // Mockea el proceso de reseteo de contraseña
        Password::shouldReceive('reset')
            ->once()
            ->with(
                $this->callback(function ($data) {
                    return $data['email'] === 'test@example.com' &&
                        $data['password'] === 'new-password' &&
                        $data['password_confirmation'] === 'new-password' &&
                        $data['token'] === 'valid-token';
                }),
                $this->callback(function ($callback) use ($user) {
                    $callback($user);
                    return true;
                })
            )
            ->andReturn(Password::PASSWORD_RESET);

        // Mockea la generación de hash para la contraseña
        Hash::shouldReceive('make')
            ->once()
            ->with('new-password')
            ->andReturn('hashed-new-password');

        // Simula la solicitud
        $request = Request::create('/password/reset', 'POST', [
            'token' => 'valid-token',
            'email' => 'test@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        // Instanciar el controlador y ejecutar la acción
        $controller = new NewPasswordController();
        $response = $controller->store($request);

        // Verifica la respuesta HTTP y los datos
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['status' => 'Your password has been reset.'], $response->getData(true));

        // Verifica que el evento de reset de contraseña fue lanzado
        Event::assertDispatched(PasswordReset::class, function ($event) use ($user) {
            return $event->user === $user;
        });
    }

}
