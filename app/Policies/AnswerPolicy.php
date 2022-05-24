<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Answer $answer
     * @return bool
     */
    public function update(User $user, Answer $answer)
    {
        return  $user->id === $answer->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Answer $answer
     * @return bool
     */
    public function delete(User $user, Answer $answer)
    {
        return  $user->id === $answer->user_id;
    }

    public function accept(User $user, Answer $answer)
    {
        return $user->id === $answer->question->user_id;
    }

}
