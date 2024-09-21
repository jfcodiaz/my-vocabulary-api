<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert examples for each conjugation type
        $conjugationTypes = [
            'Present Simple (First Person Singular)' => [
                'I walk to school every day.',
                'I read books often.',
                'I eat lunch at noon.',
                'I enjoy movies.',
                'I run every morning.',
            ],
            'Present Simple (Second Person Singular)' => [
                'You walk to the store.',
                'You drink coffee every day.',
                'You play soccer on weekends.',
                'You eat vegetables.',
                'You drive a car.',
            ],
            'Present Simple (Third Person Singular)' => [
                'He walks to school.',
                'She eats an apple.',
                'It rains in winter.',
                'He reads a book.',
                'She drinks tea.',
            ],
            'Present Simple (First Person Plural)' => [
                'We walk together.',
                'We eat lunch at 1 PM.',
                'We enjoy hiking.',
                'We play basketball.',
                'We cook dinner.',
            ],
            'Present Simple (Second Person Plural)' => [
                'You all walk fast.',
                'You cook together.',
                'You play sports.',
                'You visit museums.',
                'You write letters.',
            ],
            'Present Simple (Third Person Plural)' => [
                'They walk to school.',
                'They read books.',
                'They play soccer.',
                'They drink coffee.',
                'They visit us.',
            ],
            'Past Simple' => [
                'I walked to the store.',
                'He ate breakfast.',
                'We watched a movie.',
                'They played football.',
                'She read a book.',
            ],
            'Future Simple' => [
                'I will walk to the park.',
                'He will eat dinner.',
                'We will watch a movie.',
                'They will travel soon.',
                'She will cook tomorrow.',
            ],
            'Present Continuous' => [
                'I am walking to work.',
                'He is reading a book.',
                'She is cooking dinner.',
                'We are watching TV.',
                'They are playing outside.',
            ],
            'Past Continuous' => [
                'I was reading a book.',
                'He was walking to school.',
                'They were playing football.',
                'She was cooking dinner.',
                'We were watching TV.',
            ],
            'Future Continuous' => [
                'I will be walking to school.',
                'He will be reading a book.',
                'She will be cooking dinner.',
                'We will be watching TV.',
                'They will be playing football.',
            ],
            'Present Perfect' => [
                'I have eaten breakfast.',
                'She has read the book.',
                'We have watched that movie.',
                'They have played soccer.',
                'He has cooked dinner.',
            ],
            'Past Perfect' => [
                'I had eaten before you arrived.',
                'She had read the book.',
                'We had watched the movie.',
                'They had played football.',
                'He had cooked dinner.',
            ],
            'Future Perfect' => [
                'I will have finished my homework.',
                'He will have cooked dinner.',
                'She will have read the book.',
                'We will have watched the movie.',
                'They will have played football.',
            ],
            'Present Perfect Continuous' => [
                'I have been reading for two hours.',
                'She has been cooking.',
                'He has been running.',
                'We have been waiting.',
                'They have been playing.',
            ],
            'Past Perfect Continuous' => [
                'I had been reading before you arrived.',
                'She had been cooking dinner.',
                'He had been running all morning.',
                'We had been watching TV.',
                'They had been playing football.',
            ],
            'Future Perfect Continuous' => [
                'I will have been reading for two hours.',
                'She will have been cooking dinner.',
                'He will have been running for an hour.',
                'We will have been watching TV.',
                'They will have been playing football.',
            ],
            'Can' => [
                'I can swim.',
                'She can cook.',
                'He can play the guitar.',
                'They can speak French.',
                'We can go out tonight.',
            ],
            'Could' => [
                'I could swim when I was a kid.',
                'He could play football.',
                'She could cook very well.',
                'We could go to the park.',
                'They could solve the problem.',
            ],
        ];

        foreach ($conjugationTypes as $type => $examples) {
            $conjugationTypeId = DB::table('conjugation_types')->where('name', $type)->value('id');
            foreach ($examples as $example) {
                DB::table('conjugation_type_examples')->insert([
                    'conjugation_type_id' => $conjugationTypeId,
                    'example_sentence' => $example,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('conjugation_type_examples')->truncate();
    }

};
