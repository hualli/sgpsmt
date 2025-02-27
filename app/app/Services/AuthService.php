<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class AuthService
{
    /**
     * Authenticates a user based on their email and password.
     *
     * @param LoginRequest $request The login request containing user credentials.
     * @return bool Returns true if authentication is successful, otherwise false.
     */
    public function authenticateUser(LoginRequest $request): bool
    {
        if(Auth::attempt($request->only('email','password'))){
            return true;
        }
        return false;
    }

    /**
     * Generates an authentication token for the given user.
     *
     * @param User $user The authenticated user.
     * @return string The generated authentication token.
     */
    public function getToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
