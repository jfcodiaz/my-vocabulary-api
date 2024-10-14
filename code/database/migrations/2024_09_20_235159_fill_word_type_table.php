<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

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
            // Present Simple Forms
            [
                'name' => 'Present Simple (First Person Singular)',
                'description' => 'Describes an action in the present for "I".',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Simple (Second Person Singular)',
                'description' => 'Describes an action in the present for "You" (singular).',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Simple (Third Person Singular)',
                'description' => 'Describes an action in the present for "He/She/It".',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Simple (First Person Plural)',
                'description' => 'Describes an action in the present for "We".',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Simple (Second Person Plural)',
                'description' => 'Describes an action in the present for "You" (plural).',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Simple (Third Person Plural)',
                'description' => 'Describes an action in the present for "They".',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],

            // Other Tenses
            [
                'name' => 'Past Simple',
                'description' => 'Describes an action that occurred in the past.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Future Simple',
                'description' => 'Describes an action that will occur in the future.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Continuous',
                'description' => 'Describes an action that is happening now and is ongoing.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Past Continuous',
                'description' => 'Describes an action that was ongoing in the past.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Future Continuous',
                'description' => 'Describes an action that will be ongoing in the future.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Perfect',
                'description' => 'Describes an action that has been completed at some point in the past.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Past Perfect',
                'description' => 'Describes an action that was completed before another action in the past.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Future Perfect',
                'description' => 'Describes an action that will be completed by a certain point in the future.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Perfect Continuous',
                'description' => 'Describes an ongoing action that started in the past and continues to the present.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Past Perfect Continuous',
                'description' => 'Describes an ongoing action that was happening up until another action in the past.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Future Perfect Continuous',
                'description' => 'Describes an ongoing action that will happen up until a point in the future.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Subjunctive',
                'description' => 'Describes a hypothetical situation or wish in the present.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Past Subjunctive',
                'description' => 'Describes a hypothetical situation or wish in the past.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],

            // Imperative Mood
            [
                'name' => 'Imperative Mood',
                'description' => 'Used to give commands or requests.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],

            // Conditional
            [
                'name' => 'First Conditional',
                'description' => 'Describes a real situation in the present or future.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Second Conditional',
                'description' => 'Describes a hypothetical situation in the present or future.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Third Conditional',
                'description' => 'Describes a hypothetical situation in the past.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],

            // Passive Voice
            [
                'name' => 'Present Simple Passive',
                'description' => 'Describes a present action where the subject receives the action.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Past Simple Passive',
                'description' => 'Describes a past action where the subject receives the action.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],
            [
                'name' => 'Present Perfect Passive',
                'description' => 'Describes a completed action where the subject received the action.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => true,
            ],

            // Other Word Types (Non-conjugation)
            [
                'name' => 'Nouns',
                'description' => 'Words that name people, places, things, ideas, or concepts.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Pronouns',
                'description' => 'Words that replace nouns to avoid repetition.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Verbs',
                'description' => 'Words that express action or state of being.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Adjectives',
                'description' => 'Words that describe or modify nouns.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Adverbs',
                'description' => 'Words that modify verbs, adjectives, other adverbs, or entire sentences.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Prepositions',
                'description' => 'Words that show the relationship between nouns or pronouns and other words in a sentence.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Conjunctions',
                'description' => 'Words that connect words, phrases, or clauses.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Interjections',
                'description' => 'Words or phrases that express sudden emotion or sentiment.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Articles',
                'description' => 'Words that define a noun as specific or unspecific.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Phrasal Verbs',
                'description' => 'Phrases consisting of a verb and a preposition or adverb that together create a meaning different from the original verb.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Fixed Phrases',
                'description' => 'Phrases that are used as a single unit of meaning with a fixed and specific definition.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Modal Verbs',
                'description' => 'Auxiliary verbs that express necessity, possibility, permission, or other conditions.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Determiners',
                'description' => 'Words that clarify the nouns they precede.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Participles',
                'description' => 'Forms of verbs used as adjectives or to form compound verb tenses.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Infinitives',
                'description' => 'The basic form of a verb, not conjugated for tense or subject, often preceded by "to".',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ],
            [
                'name' => 'Gerunds',
                'description' => 'Verbal nouns ending in -ing.',
                'created_at' => $now,
                'updated_at' => $now,
                'conjugation' => false,
            ]
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
