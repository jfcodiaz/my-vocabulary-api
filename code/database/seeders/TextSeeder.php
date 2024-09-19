<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TextSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Text::factory(30)->create(); // Crea 30 textos
    }
}
