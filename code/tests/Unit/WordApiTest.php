<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::where('email', 'user@serv.com')->firstOrFail();
        $this->actingAs($this->user, 'web');
    }

    public function test_create_word_successfully()
    {
        $data = [
            'word' => $this->faker->word
        ];

        $response = $this->postJson('/api/v1/word', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Word created successfully',
                     'data' => [
                         'word' => [
                             'id' => 1,
                             'word' => $data['word'],
                             'creator_id' => $this->user->id,
                             'creator' => [
                                 'id' => $this->user->id,
                                 'name' => $this->user->name,
                             ],
                         ],
                     ],
                 ]);
    }

    public function test_create_word_validation_error()
    {
        $data = [];
        $response = $this->postJson('/api/v1/word', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['word']);
    }

    public function test_create_word_unauthenticated()
    {
        Auth::logout();
        $data = [
            'word' => 'example'
        ];
        $response = $this->postJson('/api/v1/word', $data);
        $response->assertStatus(401);
    }

    public function test_create_word_already_exists()
    {
            $existingWord = Word::create([
                'word' => 'example',
                'creator_id' => $this->user->id,
            ]);

            $data = [
                'word' => $existingWord->word
            ];

            $response = $this->postJson('/api/v1/word', $data);

            $response->assertStatus(status: 409)
                     ->assertJson([
                         'success' => false,
                         'errors' => [
                             'word' => [
                                 'Creation failed: "' . $existingWord->word . '" already exists.'
                             ]
                         ],
                         'data' => [
                             'word' => [
                                 'id' => $existingWord->id,
                                 'word' => $existingWord->word,
                                 'creator_id' => $this->user->id,
                                 'creator' => [
                                     'id' => $this->user->id,
                                     'name' => $this->user->name,
                                 ],
                             ],
                         ],
                     ]);
    }

}
