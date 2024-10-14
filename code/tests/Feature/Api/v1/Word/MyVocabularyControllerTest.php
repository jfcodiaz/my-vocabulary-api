<?php
namespace Tests\Feature\Http\Controllers\Api\v1\Word;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\Repositories\IUserWordRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Word;
use App\Models\UserWord;
use Illuminate\Support\Facades\Config;

class MyVocabularyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoke_returns_paginated_user_words_for_authenticated_user()
    {
        $user = $this->loginAsDefaultUser();
        $otherUser = User::factory()->create();

        Word::factory()->count(15)->create(['creator_id' => $user->id]);
        Word::factory()->count(10)->create(['creator_id' => $otherUser->id]);

        Word::all()->each(function ($word) use ($user) {
            UserWord::create([
                'user_id' => $user->id,
                'word_id' => $word->id,
            ]);
        });

        $this->app['config']->set('app.pagination.default_limit', 5);
        $cofiguredUrl = Config::get('app.url');

        $response = $this->getJson(route('api.v1.my-vocabulary', ['page' => 2]));

        $meta = $response->json('meta');
        $basePath = $response->baseRequest->fullUrlWithoutQuery(['page']);

        $this->assertEquals("$cofiguredUrl/api/v1/my-vocabulary", $basePath);
        $this->assertEquals([
            "current_page" => 2,
            "first_page_url" => "$basePath?page=1",
            "from" => 6,
            "last_page" => 5,
            "last_page_url" => "$basePath?page=5",
            "next_page_url" => "$basePath?page=3",
            "path" => $basePath,
            "per_page" => 5,
            "prev_page_url" => "$basePath?page=1",
            "to" => 10,
            "total" => 25
        ], $meta);

        $response->assertOk();
        $response->assertExactJsonStructure([
            'data' => [
                '*' => [
                    'word' => [
                        'id',
                        'word',
                        'creator_id',
                        'creator' => [
                            'id',
                            'name'
                        ],
                    ],
                    'mine',
                    'created_at',
                ],
            ],
            'meta' => [
                "current_page",
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total"
            ]
        ]);
    }

    public function test_invoke_forbids_guest_user()
    {
        $response = $this->getJson(route('api.v1.my-vocabulary'));
        $response->assertStatus(401);
    }
}
