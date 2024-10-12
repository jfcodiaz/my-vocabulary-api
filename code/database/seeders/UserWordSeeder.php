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

        foreach ($users as $user) {
            $existingWords = Word::where('creator_id', $user->id)->get();
            foreach ($existingWords as $word) {
                UserWord::create([
                    'user_id' => $user->id,
                    'word_id' => $word->id,
                ]);
            }
            $randomWords = Word::where('creator_id', '!=', $user->id)
                ->inRandomOrder()
                ->take(rand(5, 15))
                ->get();

            foreach ($randomWords as $word) {
                UserWord::create([
                    'user_id' => $user->id,
                    'word_id' => $word->id,
                ]);
            }
        }
    }
}
