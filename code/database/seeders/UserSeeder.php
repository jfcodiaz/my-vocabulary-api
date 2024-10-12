<?php

namespace Database\Seeders;

use \App\Models\{ User, Role };
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', Role::ADMIN)->first());
        });

        User::factory(10)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', Role::USER)->first());
        });
    }
}
