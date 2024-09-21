<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });
        Schema::table(table: 'texts', callback: function (Blueprint $table) {
            $table->foreignId('text_type_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(table: 'texts', callback: function (Blueprint $table) {
            $table->dropForeign(['text_type_id']);
        });
        Schema::dropIfExists('text_types');
    }
}
