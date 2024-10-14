<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Word;
use App\Models\UserWord;
use Illuminate\Database\Seeder;

class UserWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $allWords = Word::all();

        foreach ($allWords as $word) {
            UserWord::create([
                'user_id' => $word->creator_id,
                'word_id' => $word->id,
            ]);
        }

        $usersWithoutWords = $users->filter(function ($user) {
            return Word::where('creator_id', $user->id)->doesntExist();
        });

        foreach ($usersWithoutWords as $user) {
            for ($i = 0; $i < random_int(1, 10); $i++) {
                $word = Word::inRandomOrder()->first();
                UserWord::create([
                    'user_id' => $user->id,
                    'word_id' => $word->id,
                ]);
            }
        }

        foreach ($users as $user) {
            for ($i = 0; $i < random_int(1, 5); $i++) {
                $word = Word::where('creator_id', '!=', $user->id)->inRandomOrder()->first();
                UserWord::create([
                    'user_id' => $user->id,
                    'word_id' => $word->id,
                ]);
            }
        }
    }
}
