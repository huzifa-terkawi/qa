<?php

namespace App\Policies;

use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
        return auth()->id() == $answer->user_id;
    }

    /**
     * Determine whether the user can delete the Answer.
     *
     * @param  \App\User  $user
     * @param  \App\Answer  $answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
        return auth()->id() == $answer->user_id;
    }


    public function accept(User $user, Answer $answer)
    {
        return auth()->id() == $answer->question->user_id;
    }

}
