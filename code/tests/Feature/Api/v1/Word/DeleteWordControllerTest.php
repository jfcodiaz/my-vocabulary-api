<?php

namespace Tests\Feature\Api\v1\Word;

use Tests\TestCase;
use App\Models\User;
use App\Models\Word;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteWordControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $word;
    protected $parameters;

    protected function setUp(): void
    {
        parent::setUp();
        $user = $this->loginAsDefaultUser();
        $this->loginAsDefaultUser();
        $this->word = Word::factory()->create([
            'creator_id' => $user->id
        ]);
        $this->parameters = ['word' => $this->word->id];
    }

    public function test_delete_word_successfully()
    {
        $response = $this->deleteJson(route('api.v1.word.delete', $this->parameters));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('words', ['id' => $this->word->id]);
    }

    public function test_delete_word_not_found()
    {
        $response = $this->deleteJson(route('api.v1.word.delete', ['word' => 999]));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_delete_word_unauthenticated()
    {
        $this->logout();

        $response = $this->deleteJson(route('api.v1.word.delete', $this->parameters));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_delete_word_for_no_owner_user_forbidden()
    {
        $anotherUser = User::factory()->create();
        $this->actingAs($anotherUser);

        $response = $this->deleteJson(route('api.v1.word.delete', $this->parameters));

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $response->assertStatus(403);
    }

    public function test_delete_word_as_admin()
    {
        $this->logout();
        $this->loginAsDefaultAdmin();

        $response = $this->deleteJson(route('api.v1.word.delete', $this->parameters));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('words', ['id' => $this->word->id]);
    }

}
