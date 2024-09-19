<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreWordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test storing a word.
     *
     * @return void
     */
    public function test_store_word()
    {
        // Arrange: Prepare the data
        $data = [
            'word' => $this->faker->word,
        ];

        // Act: Make a POST request to the named route
        $response = $this->postJson(route('words.store'), $data);

        // Assert: Check the response
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Word stored successfully',
                     'word' => $data['word'],
                 ]);

        // Assert: Check the database
        $this->assertDatabaseHas('words', [
            'text' => $data['word'],
        ]);
    }
}
