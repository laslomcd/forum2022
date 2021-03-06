<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => rtrim($this->faker->sentence(rand(5,10)), "."),
            'body' => $this->faker->paragraphs(rand(3,7), true),
            'views' => rand(0,10),
//            'answers_count' => rand(0,10),
//            'votes_count' => rand(-3,10),
            'user_id' => User::pluck('id')->random()
        ];
    }
}
