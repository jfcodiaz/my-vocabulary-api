<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Review::factory(100)->create(); // Crea 100 revisiones
    }
}
