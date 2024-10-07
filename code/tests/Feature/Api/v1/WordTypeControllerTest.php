<?php

namespace Tests\Feature\Api\v1;

use Tests\TestCase;
use App\Models\WordType;
use Illuminate\Foundation\Testing\RefreshDatabase;


class WordTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the __invoke method of WordTypeController.
     *
     * @return void
     */
    public function test_can_list_default_word_types(): void
    {
        // Autenticar al usuario con el correo user@serv.com
        $user = \App\Models\User::where('email', 'user@serv.com')->first();
        $this->actingAs($user);
        // Hacer una solicitud GET a la ruta que lista los WordTypes
        $response = $this->getJson(route('api.v1.word_types'));

        // Verificar que la respuesta sea exitosa y que contenga la estructura y datos correctos
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'name', 'description']
                     ]
                 ])
                 ->assertJsonFragment([
                     'name' => 'Noun',
                     'description' => 'A word that identifies a person, place, thing, or idea.'
                 ])
                 ->assertJsonFragment([
                     'name' => 'Verb',
                     'description' => 'A word that expresses an action, occurrence, or state of being.'
                 ]);
    }
}
