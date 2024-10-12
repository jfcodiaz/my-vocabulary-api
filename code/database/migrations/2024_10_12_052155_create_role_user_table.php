<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userRoleId = DB::table('roles')->where('name', 'USER')->value('id');
        $adminRoleId = DB::table('roles')->where('name', 'ADMIN')->value('id');

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('users')->get()->each(function ($user) use ($userRoleId) {
            DB::table('role_user')->insert([
                'user_id' => $user->id,
                'role_id' => $userRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        DB::table('users')->insert([
            'name' => 'Default Admin',
            'email' => 'admin@serv.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $adminUserId = DB::table('users')->where('email', 'admin@serv.com')->value('id');

        DB::table('role_user')->insert([
            'user_id' => $adminUserId,
            'role_id' => $adminRoleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('email', 'admin@serv.com')->delete();
        Schema::dropIfExists('role_user');
    }
}

return new CreateRoleUserTable();
