<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class PopulateWordTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon::now();

        $wordTypes = [
            ['name' => 'Noun', 'description' => 'A word that identifies a person, place, thing, or idea.', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Verb', 'description' => 'A word that expresses an action, occurrence, or state of being.', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Adjective', 'description' => 'A word that describes or qualifies a noun or pronoun.', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Adverb', 'description' => 'A word that modifies a verb, adjective, or another adverb, often indicating manner, time, or degree.', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Pronoun', 'description' => 'A word that substitutes for a noun, such as \'he,\' \'she,\' \'it,\' or \'they.\'', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Preposition', 'description' => 'A word that shows the relationship of a noun or pronoun to another word in the sentence.', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Conjunction', 'description' => 'A word that connects words, phrases, clauses, or sentences (e.g., \'and,\' \'but,\' \'or\').', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Interjection', 'description' => 'A word or phrase that expresses emotion or exclamation, such as \'wow\' or \'oh.\'', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Determiner', 'description' => 'A word that introduces a noun and provides context such as definiteness, quantity, or possession (e.g., \'the,\' \'a,\' \'my\').', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Modal Verb', 'description' => 'An auxiliary verb that expresses necessity, possibility, permission, or ability (e.g., \'can,\' \'must,\' \'may\').', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false],
            ['name' => 'Quantifier', 'description' => 'A word or phrase that indicates quantity or amount, often used with nouns (e.g., \'many,\' \'few,\' \'several\').', 'created_at' => $now, 'updated_at' => $now, 'conjugation' => false]
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
        DB::table('word_types')->whereIn('name', [
            'Noun', 'Verb', 'Adjective', 'Adverb', 'Pronoun', 'Preposition',
            'Conjunction', 'Interjection', 'Determiner', 'Modal Verb', 'Quantifier'
        ])->delete();
    }
}
