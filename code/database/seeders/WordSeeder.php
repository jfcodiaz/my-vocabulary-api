<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Word::factory(50)->create(); // Crea 50 palabras
    }
}
