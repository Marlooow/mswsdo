<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function create(User $user)
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, User $model)
    {
        return $user->hasRole('super_admin') || $user->id === $model->id;
    }
}
