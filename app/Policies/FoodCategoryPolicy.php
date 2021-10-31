<?php

namespace App\Policies;

use App\Models\FoodCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\FoodCategory $foodCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FoodCategory $foodCategory)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\FoodCategory $foodCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FoodCategory $foodCategory)
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\FoodCategory $foodCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FoodCategory $foodCategory)
    {
        return $user->hasRole('admin');
    }
}