<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Question $question
     * @return Response
     */
    public function update(User $user, Question $question)
    {
        return $user->id === $question->user_id ? Response::allow() : Response::deny('Access Denied | You are not the author of this question');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Question $question
     * @return bool
     */
    public function delete(User $user, Question $question)
    {
        return $user->id === $question->user_id && $question->answers->count() < 1;
    }

}
