<?php
namespace Tests\Feature\Api\v1\Definition;

use App\Contracts\Repositories\IDefintionRepository;
use App\Contracts\Repositories\IWordTypeRepository;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Word;
use App\Models\WordType;

class DefinitionStoreControllerTest extends TestCase
{
    use RefreshDatabase;

    private WordType $verbType;
    private WordType $nounType;
    private Word $verb;
    private Word $noun;
    private User $user;
    private IWordTypeRepository $wordTypeRepository;
    private WordType $conjugationType;

    public function setUp(): void
    {
        parent::setUp();
        $this->wordTypeRepository = app()->make(IWordTypeRepository::class);
        $this->verbType = $this->wordTypeRepository->getVerbType();
        $this->nounType = $this->wordTypeRepository->getNounType();
        $this->conjugationType = $this->wordTypeRepository->findRandomConjugation();
        $this->noun = Word::factory()->create();
        $this->verb = Word::factory()->create();
        $this->user = $this->loginAsDefaultUser();

    }

    public function test_authenticated_user_can_create_a_non_definition()
    {
        $data = [
            'wordId' => $this->noun->id,
            'definition' => 'A person, place, thing, or idea.',
            'wordTypeId' => $this->nounType->id,
        ];
        $response = $this->postJson(route('api.v1.definitions.store'), $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'definition' => [
                        'id',
                        'wordId',
                        'wordTypeId',
                        'definition',
                        'creatorId',
                        'creator' => [
                            'id',
                            'name'
                        ]
                    ]
                ]
            ]);
            $this->assertDatabaseHas('definitions', [
                'word_id' => $data['wordId'],
                'definition' => $data['definition'],
                'word_type_id' => $data['wordTypeId'],
                'creator_id' => $this->user->id,
            ]);
    }

    public function test_guest_user_cannot_create_definition()
    {
        $this->logout();
        $definitionData = [];
        $response = $this->postJson(route('api.v1.definitions.store'), $definitionData);
        $response->assertStatus(401);
    }

    public function test_this_suld_fail_with_empty_request()
    {
        $response = $this->postJson(route('api.v1.definitions.store'));
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The word id field is required. (and 2 more errors)',
                'errors' => [
                    'wordId' => ['The word id field is required.'],
                    'wordTypeId' => ['The word type id field is required.'],
                    'definition' => ['The definition field is required.'],
                ],
            ]);
    }

    public function test_it_should_fail_when_the_ids_dont_exists()
    {
        $data = [
            'wordId' => 999,
            'definition' => 'A person, place, thing, or idea.',
            'wordTypeId' => 888,
            'verbBaseId' => 777,
        ];
        $response = $this->postJson(route('api.v1.definitions.store'), $data);
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The selected word id is invalid. (and 2 more errors)',
                'errors' => [
                    'wordId' => ['The selected word id is invalid.'],
                    'wordTypeId' => ['The selected word type id is invalid.'],
                    'verbBaseId' => ['The selected verb base id is invalid.'],
                ],
            ]);
    }

    public function test_it_should_fail_when_the_word_type_is_not_a_verb_and_verb_base_id_is_not_null()
    {
        $data = [
            'wordId' => $this->noun->id,
            'definition' => 'A person, place, thing, or idea.',
            'wordTypeId' => $this->nounType->id,
            'verbBaseId' => $this->verb->id,
        ];
        $response = $this->postJson(route('api.v1.definitions.store'), $data);
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The verbBaseId field must be null when the wordType is not a conjugation.',
                'errors' => [
                    'verbBaseId' => ['The verbBaseId field must be null when the wordType is not a conjugation.'],
                ],
            ]);
    }

    public function test_it_should_fail_when_the_word_type_is_a_verb_and_verb_base_id_is_null()
    {
        $word = Word::factory()->create();
        //create definition for verb be cosidered as verb
        $this->createDefinitionForVerb();
        $data = [
            'wordId' => $word->id,
            'definition' => 'A person, place, thing, or idea.',
            'wordTypeId' => $this->conjugationType->id
        ];
        $response = $this->postJson(route('api.v1.definitions.store'), $data);
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The verbBaseId field is required if thew wordType is a conjugation.',
                'errors' => [
                    'verbBaseId' => ['The verbBaseId field is required if thew wordType is a conjugation.'],
                ],
            ]);
    }

    public function test_it_should_fail_when_the_word_type_is_a_verb_and_verb_base_id_is_not_a_verb()
    {
        $word = Word::factory()->create();
        $data = [
            'wordId' => $word->id,
            'definition' => 'A person, place, thing, or idea.',
            'wordTypeId' => $this->conjugationType->id,
            'verbBaseId' => $this->noun->id,
        ];
        $response = $this->postJson(route('api.v1.definitions.store'), $data);
        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The verbBaseId field should be a a verb.',
                'errors' => [
                    'verbBaseId' => ['The verbBaseId field should be a a verb.'],
                ],
            ]);
    }

    private function createDefinitionForVerb()
    {
        $defintionRepository = app()->make(IDefintionRepository::class);
        $definition = $defintionRepository->create([
            'word_id' => $this->verb->id,
            'word_type_id' => $this->conjugationType->id,
            'definition' => 'To perform an action or process.',
            'creator_id' => $this->user->id,
        ]);
    }
}
