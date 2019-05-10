<?php

namespace App\Policies;

use App\Recipe;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Recipe $recipe)
    {
        if ($user->id !== $recipe->user_id) {
            throw new AuthorizationException('このレシピは編集できません。');
        }

        return true;
    }
}
