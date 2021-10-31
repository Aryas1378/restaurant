<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function registerUser($role)
    {
        $role = Role::query()->create([
            'name' => $role,
        ]);
        /** @var User $user */
        $user = User::factory()->create();
        $user->roles()->attach($role->id);
        return $user;
    }
}
