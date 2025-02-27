<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private AuthService $authService;
    private UserService $userService;

    public function __construct(AuthService $authService, UserService $userService){
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * Handles user login authentication.
     *
     * @param LoginRequest $request The login request containing user credentials.
     * @return \Illuminate\Http\JsonResponse JSON response with authentication result.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if(!$this->authService->authenticateUser($request)){
            return response()->json([
                'message' => 'unauthorized'
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->userService->getUserByEmail($request->email);

        $token = $this->authService->getToken($user);

        return new JsonResponse([
            'message' => 'authorized',
            'accessToken' => $token,
            'tokenType' => 'Bearer',
            'user' => new UserResource($user),
        ], Response::HTTP_OK);
    }
}
