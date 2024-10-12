<?php

namespace Tests\Feature\Api\v1\Word;

use Tests\TestCase;
use App\Models\User;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateWordControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Word $word;
    private array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->loginAsDefaultUser();
        $this->word = Word::factory()->create([
            'word' => 'aWord',
            'creator_id' => $this->user->id,
        ]);
        $this->data = [
            'word' => 'updatedWord',
        ];
    }

    public function test_update_word_successfully()
    {
        $response = $this->putJson("/api/v1/word/{$this->word->id}", $this->data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Word updated successfully',
                'data' => [
                    'word' => [
                        'id' => $this->word->id,
                        'word' => 'updatedWord',
                        'creator_id' => $this->user->id,
                        'creator' => [
                            'id' => $this->user->id,
                            'name' => $this->user->name,
                        ],
                    ],
                ],
            ]);
        $this->assertDatabaseHas('words', [
            'id' => $this->word->id,
            'word' => $this->data['word'],
            'creator_id' => $this->user->id,
        ]);
    }

    public function test_update_word_validation_error_missing_word_key()
    {
        $response = $this->putJson("/api/v1/word/{$this->word->id}", []);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['word']);
    }

    public function test_update_word_unauthenticated()
    {
        $this->logout();
        $response = $this->putJson("/api/v1/word/{$this->word->id}", $this->data);
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test_update_word_not_found()
    {
        $response = $this->putJson("/api/v1/word/9999", $this->data);
        $response->assertStatus(404);
    }

    public function test_update_word_no_owner()
    {
        $anotherUser = User::factory()->create();

        $this->actingAs($anotherUser);
        $response = $this->putJson("/api/v1/word/{$this->word->id}", $this->data);
        $response->assertStatus(403)
            ->assertJson([
                'message' => 'This action is unauthorized.',
            ]);
    }

    public function test_admin_update_any_word_successfully()
    {
        $this->logout()->loginAsDefaultAdmin();

        $response = $this->putJson("/api/v1/word/{$this->word->id}", $this->data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Word updated successfully',
                'data' => [
                    'word' => [
                        'id' => $this->word->id,
                        'word' => 'updatedWord',
                        'creator_id' => $this->user->id,
                        'creator' => [
                            'id' => $this->user->id,
                            'name' => $this->user->name,
                        ],
                    ],
                ],
            ]);
        $this->assertDatabaseHas('words', [
            'id' => $this->word->id,
            'word' => $this->data['word'],
            'creator_id' => $this->user->id,
        ]);
    }
}
