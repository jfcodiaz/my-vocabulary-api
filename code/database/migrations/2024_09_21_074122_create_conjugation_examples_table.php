<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConjugationExamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conjugation_type_examples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('conjugation_type_id')->unsigned();
            $table->string('example_sentence');
            $table->timestamps();

            // Foreign key to the ConjugationType table
            $table->foreign('conjugation_type_id')
                  ->references('id')
                  ->on('conjugation_types')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conjugation_type_examples');
    }
}
