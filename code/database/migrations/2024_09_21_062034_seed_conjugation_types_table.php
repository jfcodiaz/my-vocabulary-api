<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SeedConjugationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = Carbon::now();

        $conjugationTypes = [
            // Present Simple Forms
            [
                'name' => 'Present Simple (First Person Singular)',
                'description' => 'Describes an action in the present for "I".',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Simple (Second Person Singular)',
                'description' => 'Describes an action in the present for "You" (singular).',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Simple (Third Person Singular)',
                'description' => 'Describes an action in the present for "He/She/It".',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Simple (First Person Plural)',
                'description' => 'Describes an action in the present for "We".',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Simple (Second Person Plural)',
                'description' => 'Describes an action in the present for "You" (plural).',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Simple (Third Person Plural)',
                'description' => 'Describes an action in the present for "They".',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Other Tenses
            [
                'name' => 'Past Simple',
                'description' => 'Describes an action that occurred in the past.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Future Simple',
                'description' => 'Describes an action that will occur in the future.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Continuous',
                'description' => 'Describes an action that is happening now and is ongoing.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Past Continuous',
                'description' => 'Describes an action that was ongoing in the past.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Future Continuous',
                'description' => 'Describes an action that will be ongoing in the future.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Perfect',
                'description' => 'Describes an action that has been completed at some point in the past.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Past Perfect',
                'description' => 'Describes an action that was completed before another action in the past.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Future Perfect',
                'description' => 'Describes an action that will be completed by a certain point in the future.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Perfect Continuous',
                'description' => 'Describes an ongoing action that started in the past and continues to the present.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Past Perfect Continuous',
                'description' => 'Describes an ongoing action that was happening up until another action in the past.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Future Perfect Continuous',
                'description' => 'Describes an ongoing action that will happen up until a point in the future.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Modal Verbs
            [
                'name' => 'Can',
                'description' => 'Expresses ability or possibility.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Could',
                'description' => 'Expresses past ability or possibility.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'May',
                'description' => 'Expresses permission or possibility.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Might',
                'description' => 'Expresses less certain possibility.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Must',
                'description' => 'Expresses necessity or obligation.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Shall',
                'description' => 'Expresses future action or suggestion.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Should',
                'description' => 'Expresses advice or expectation.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Will',
                'description' => 'Expresses future intent.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Would',
                'description' => 'Expresses hypothetical or conditional situations.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Subjunctive Mood
            [
                'name' => 'Present Subjunctive',
                'description' => 'Describes a hypothetical situation or wish in the present.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Past Subjunctive',
                'description' => 'Describes a hypothetical situation or wish in the past.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Imperative Mood
            [
                'name' => 'Imperative Mood',
                'description' => 'Used to give commands or requests.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Conditional
            [
                'name' => 'First Conditional',
                'description' => 'Describes a real situation in the present or future.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Second Conditional',
                'description' => 'Describes a hypothetical situation in the present or future.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Third Conditional',
                'description' => 'Describes a hypothetical situation in the past.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Passive Voice
            [
                'name' => 'Present Simple Passive',
                'description' => 'Describes a present action where the subject receives the action.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Past Simple Passive',
                'description' => 'Describes a past action where the subject receives the action.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Present Perfect Passive',
                'description' => 'Describes a completed action where the subject received the action.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('conjugation_types')->insert($conjugationTypes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the table
        DB::table('conjugation_types')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
