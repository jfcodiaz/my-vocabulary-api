<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_type_examples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('word_type_id')->unsigned();
            $table->string('example');
            $table->timestamps();

            // Foreign key to the ConjugationType table
            $table->foreign('word_type_id')
                  ->references('id')
                  ->on('word_types')
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
        Schema::dropIfExists('word_type_examples');
    }
};
