<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
        });

        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn(['type_id', 'definition', 'example']);
            $table->foreignId('creator')
                ->constrained('users')
                ->onDelete('cascade')
                ->after('word');
        });
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->text('definition')->nullable();
            $table->text('example')->nullable();
            $table->foreignId('type_id')->after('word')
                ->constrained('word_types')
                ->onDelete('cascade');
            $table->dropForeign(['creator']);
        });
    }
};
