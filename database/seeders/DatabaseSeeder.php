<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(3)->create()->each(function($user) {
             $user->questions()
                 ->saveMany(
                     Question::factory(rand(1,5))->make()
                 )
                 ->each(function($question) {
                     $question->answers()
                         ->saveMany(
                             Answer::factory(rand(1,5)))->create();
                 });
         });
//        $this->call(QuestionsSeeder::class);
//        User::factory(3)->has(Question::factory()->count(rand(1,5)))->create();
    }
}
