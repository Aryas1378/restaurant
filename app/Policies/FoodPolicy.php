<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Food $food)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Food $food)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Food $food)
    {
        return $user->hasRole('admin');
    }
}
