<?php

namespace App\Http\Controllers;

use App\Dto\UserDTO;
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

    public function login(Request $request)
    {
        $userDTO = UserDTO::fromRequest($request);

        try {
            $token = $this->userService->authenticate($userDTO);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['token' => $token]);
    }

    public function register(Request $request)
    {
        // Создаём DTO из данных запроса
        $userDTO = UserDTO::fromRequest($request);

        try {
            // Регистрируем нового пользователя через сервис
            $user = $this->userService->createUser($userDTO);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }
}
