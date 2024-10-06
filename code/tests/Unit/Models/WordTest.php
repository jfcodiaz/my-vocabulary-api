<?php

namespace Tests\Unit\Models;

use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WordTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_fillable_attributes()
    {
        $word = new Word();

        $this->assertEquals(
            ['text', 'type_word_id', 'definition', 'example', 'base_verb_id', 'present', 'past', 'past_participle'],
            $word->getFillable()
        );
    }

    public function test_it_belongs_to_base_verb()
    {
        $word = new Word();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $word->baseVerb());
    }

    public function test_it_has_many_conjugations()
    {
        $word = new Word();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $word->conjugations());
    }

    public function test_it_belongs_to_many_users()
    {
        $word = new Word();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $word->users());
    }

    public function test_it_has_many_reviews()
    {
        $word = new Word();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $word->reviews());
    }
}
