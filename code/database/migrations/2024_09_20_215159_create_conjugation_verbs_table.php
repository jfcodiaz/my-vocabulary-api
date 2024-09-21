<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConjugationVerbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conjugation_verbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('word_id')->unsigned();
            $table->bigInteger('conjugation_type_id')->unsigned();
            $table->string('conjugated_form');
            $table->timestamps();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
            $table->foreign('conjugation_type_id')->references('id')->on('conjugation_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conjugation_verbs');
    }
}
