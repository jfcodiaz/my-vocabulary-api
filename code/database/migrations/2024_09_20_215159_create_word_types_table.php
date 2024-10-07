<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::table('definitions', function (Blueprint $table) {
            $table->foreignId('word_type_id')->constrained()->onDelete('cascade');
        });

        Schema::table('words', function (Blueprint $table) {
            $table->foreignId('type_id')->after('word')  // Añade 'type_id' después de la columna 'word'
                ->constrained('word_types')
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
        Schema::table('definitions', function (Blueprint $table) {
            $table->dropForeign(['word_type_id']);
        });

        Schema::table('words', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });

        Schema::dropIfExists('word_types');
    }
}
