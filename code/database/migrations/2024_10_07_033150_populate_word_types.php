<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PopulateWordTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon::now();  // Crear la variable $now que contiene la fecha y hora actual

        // Array con los tipos de palabras y sus descripciones
        $wordTypes = [
            ['name' => 'Noun', 'description' => 'A word that identifies a person, place, thing, or idea.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Verb', 'description' => 'A word that expresses an action, occurrence, or state of being.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Adjective', 'description' => 'A word that describes or qualifies a noun or pronoun.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Adverb', 'description' => 'A word that modifies a verb, adjective, or another adverb, often indicating manner, time, or degree.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pronoun', 'description' => 'A word that substitutes for a noun, such as \'he,\' \'she,\' \'it,\' or \'they.\'', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Preposition', 'description' => 'A word that shows the relationship of a noun or pronoun to another word in the sentence.', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Conjunction', 'description' => 'A word that connects words, phrases, clauses, or sentences (e.g., \'and,\' \'but,\' \'or\').', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Interjection', 'description' => 'A word or phrase that expresses emotion or exclamation, such as \'wow\' or \'oh.\'', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Determiner', 'description' => 'A word that introduces a noun and provides context such as definiteness, quantity, or possession (e.g., \'the,\' \'a,\' \'my\').', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Modal Verb', 'description' => 'An auxiliary verb that expresses necessity, possibility, permission, or ability (e.g., \'can,\' \'must,\' \'may\').', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Quantifier', 'description' => 'A word or phrase that indicates quantity or amount, often used with nouns (e.g., \'many,\' \'few,\' \'several\').', 'created_at' => $now, 'updated_at' => $now]
        ];

        // Insertar los tipos de palabras en la tabla word_types
        DB::table('word_types')->insert($wordTypes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar los tipos de palabras al hacer rollback
        DB::table('word_types')->whereIn('name', [
            'Noun', 'Verb', 'Adjective', 'Adverb', 'Pronoun', 'Preposition',
            'Conjunction', 'Interjection', 'Determiner', 'Modal Verb', 'Quantifier'
        ])->delete();
    }
}
