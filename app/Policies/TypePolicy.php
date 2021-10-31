<?php

namespace App\Policies;

use App\Models\RestaurantType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypePolicy
{
    use HandlesAuthorization;

    public function view(User $user, RestaurantType $restaurantType)
    {
        return $user->hasRole('admin');
    }

    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }
}
