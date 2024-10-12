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
        Schema::rename('user_word', 'user_words');
        Schema::table('user_words', function (Blueprint $table) {
            $table->integer('proficiency_level')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_words', function (Blueprint $table) {
            $table->dropColumn('proficiency_level');
        });
        Schema::rename('user_words', 'user_word');
    }
};
