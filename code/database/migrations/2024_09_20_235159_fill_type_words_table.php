<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = now();
        $wordTypes = [
            [
                'name' => 'Nouns',
                'description' => 'Words that name people, places, things, ideas, or concepts.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Pronouns',
                'description' => 'Words that replace nouns to avoid repetition.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Verbs',
                'description' => 'Words that express action or state of being.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Adjectives',
                'description' => 'Words that describe or modify nouns.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Adverbs',
                'description' => 'Words that modify verbs, adjectives, other adverbs, or entire sentences.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Prepositions',
                'description' => 'Words that show the relationship between nouns or pronouns and other words in a sentence.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Conjunctions',
                'description' => 'Words that connect words, phrases, or clauses.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Interjections',
                'description' => 'Words or phrases that express sudden emotion or sentiment.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Articles',
                'description' => 'Words that define a noun as specific or unspecific.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Phrasal Verbs',
                'description' => 'Phrases consisting of a verb and a preposition or adverb that together create a meaning different from the original verb.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Fixed Phrases',
                'description' => 'Phrases that are used as a single unit of meaning with a fixed and specific definition.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Modal Verbs',
                'description' => 'Auxiliary verbs that express necessity, possibility, permission, or other conditions.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Determiners',
                'description' => 'Words that clarify the nouns they precede.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Participles',
                'description' => 'Forms of verbs used as adjectives or to form compound verb tenses.',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Infinitives',
                'description' => 'The basic form of a verb, not conjugated for tense or subject, often preceded by "to".',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Gerunds',
                'description' => 'Verbal nouns ending in -ing.',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        DB::table('word_types')->insert($wordTypes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $wordTypes = [
            'Nouns',
            'Pronouns',
            'Verbs',
            'Adjectives',
            'Adverbs',
            'Prepositions',
            'Conjunctions',
            'Interjections',
            'Articles',
            'Phrasal Verbs',
            'Fixed Phrases',
            'Modal Verbs',
            'Determiners',
            'Participles',
            'Infinitives',
            'Gerunds'
        ];

        DB::table('word_types')->whereIn('name', $wordTypes)->delete();
    }
};
