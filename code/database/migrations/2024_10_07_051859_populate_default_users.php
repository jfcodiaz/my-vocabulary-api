<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    private string $defaultUser;

    public function __construct()
    {
        $this->defaultUser = config('app.defaults.users.defaultUser');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            'email' => $this->defaultUser,
            'name' => 'Default User',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('email', '=', $this->defaultUser)->delete();
    }
};
