<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Retrieves a user by their email address.
     *
     * @param string $email The email address of the user.
     * @return \App\Models\User The user instance.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If no user is found.
     */
    public function getUserByEmail($email): User
    {
        return User::where('email',$email)->firstOrFail();
    }
}
