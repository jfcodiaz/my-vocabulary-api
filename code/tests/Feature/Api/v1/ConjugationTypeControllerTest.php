<?php

namespace Tests\Feature\Api\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ConjugationType;
use App\Models\User;

class ConjugationTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_conjugation_type_list()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user, 'web');

        // Count the conjugation types in the database
        $conjugationTypeCount = ConjugationType::count();

        // Make a GET request to the conjugation types endpoint
        $response = $this->getJson('/api/v1/conjugation-types');

        // Assert the response status is 200
        $response->assertStatus(200);

        // Assert the response contains the correct structure
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'examples' => [
                        '*' => [
                            'id',
                            'conjugation_type_id',
                            'example_sentence',
                        ],
                    ],
                ],
            ],
        ]);

        // Assert the response contains the correct number of conjugation types
        $this->assertCount($conjugationTypeCount, $response->json('data'));
    }
}
