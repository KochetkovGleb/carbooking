<?php

namespace App\Http\Controllers;

use App\Dto\UserDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function me()
    {
        $user = auth()->user();

        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $userDTO = UserDTO::fromLoginRequest($request);

        try {
            $token = $this->userService->authenticate($userDTO);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['token' => $token]);
    }

    public function register(UserRequest $request)
    {
        $dto = UserDTO::fromRegisterRequest($request);

        $user = $this->userService->createUser($dto);

        return response()->json($user, 201);
    }
}
