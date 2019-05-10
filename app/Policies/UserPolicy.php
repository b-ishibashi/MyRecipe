<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    /**
     *
     * ユーザーがプロフィールを更新できるか
     *
     * @param User $me
     * @param User $user
     */
    public function update(User $me, User $user): bool
    {
        return $user->is($me);
    }
}
